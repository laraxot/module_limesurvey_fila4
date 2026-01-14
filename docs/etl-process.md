# ETL Process for LimeSurvey Data

## Overview
The ETL (Extract, Transform, Load) process in our LimeSurvey integration is a critical component that transfers data from LimeSurvey's dynamic database structure to our static analytics-ready format. This process is primarily implemented through the Survey Flip strategy.

## ETL Architecture

```
┌─────────────────┐    Extract    ┌─────────────────┐    Transform    ┌─────────────────┐    Load    ┌─────────────────┐
│ LimeSurvey DB   │ ────────────▶ │ Processing      │ ──────────────▶ │ Standardized    │ ──────────▶ │ Analytics DB    │
│ (Dynamic)       │               │ Layer           │                 │ Format (EAV)    │              │ (Static)        │
│ lime_survey_{SID}│               │ (SurveyResponse)│                 │ survey_flip_    │              │ survey_flip_    │
│                 │               │                 │                 │ responses       │              │ responses       │
└─────────────────┘               └─────────────────┘                 └─────────────────┘              └─────────────────┘
```

## 1. Extract Phase

### Data Sources
- **Survey Response Data**: From `lime_survey_{SID}` tables
- **Survey Metadata**: From `lime_surveys`, `lime_groups`, `lime_questions`, `lime_answers`
- **Localization Data**: From `lime_question_l10ns`, `lime_answer_l10ns`
- **Participant Data**: From `lime_tokens_{SID}` tables

### Extraction Methods

#### Direct Database Access
```php
// Example: Accessing dynamic survey table
$survey_response = SurveyResponse::getResponsesForSurvey($survey_id);
$responses = $survey_response
    ->whereNotNull('submitdate')
    ->get();
```

#### Metadata Extraction
```php
// Extract survey structure
$questions = LimeQuestion::where('sid', $survey_id)
    ->whereNotIn('type', ['X']) // Exclude 'X' type questions
    ->get();

// Extract answers with localization
$answers = LimeAnswer::where('qid', $question_id)
    ->join('lime_answer_l10ns', 'lime_answers.aid', '=', 'lime_answer_l10ns.aid')
    ->select('code', 'answer', 'language')
    ->get();
```

### Filtering Criteria
- Only responses with `submitdate != null`
- Exclude test responses (if applicable)
- Apply date range filters from dashboard filters
- Filter by specific question types (excluding 'X' type)

## 2. Transform Phase

### Field Name Mapping
LimeSurvey uses a complex field naming convention: `{SID}X{GID}X{QID}[suffix]`
- `123456X22X487` → Survey 123456, Group 22, Question 487
- `123456X22X487_SQ001` → Sub-question
- `123456X22X487_other` → Other option text

The transformation maps these to semantic data:
```php
// Fieldname attribute in LimeQuestion model
public function getFieldNameAttribute(?string $value): string
{
    if ($value !== null) {
        return $value;
    }
    
    $res = $this->sid.'X'.$this->gid.'X';
    if ($this->type === 'F' && $this->child !== null) {
        return $res.$this->qid.''.$this->child->title;
    }
    // ... more logic
    return $res.$this->qid;
}
```

### Data Type Handling
- Convert LimeSurvey's mixed data types to consistent format
- Handle special cases for different question types (A, B, C, D, etc.)
- Process sub-questions and array responses
- Extract feedback text based on question relevance

### Value Processing
```php
// Extract both raw answer and processed value
$data = [
    'answer' => $row->{$q->fieldname},           // Raw value from lime_survey_xxx
    'value' => $row->{$q->fieldname.'answer'},   // Processed value from answer labels
    'submitdate' => $row->submitdate,
    'fieldname' => $q->fieldname,
];
```

### Data Validation and Cleansing
- Remove null or empty values
- Sanitize special characters
- Validate date formats
- Ensure data type consistency

## 3. Load Phase

### Target Schema
The transformed data is loaded into the `survey_flip_responses` table:

```sql
CREATE TABLE survey_flip_responses (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    survey_id VARCHAR(255),
    question_id VARCHAR(255),
    question_type VARCHAR(10),
    token VARCHAR(255),
    answer TEXT,
    value TEXT,
    submitdate DATETIME,
    fieldname VARCHAR(255),
    old_id VARCHAR(255), -- original id from lime_survey_xxx
    feedback TEXT,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

### Loading Strategies
- **Upsert**: Use `firstOrCreate` or `updateOrCreate` to prevent duplicates
- **Batch Processing**: Insert multiple records in a single query
- **Conflict Resolution**: Handle duplicate data appropriately

## ETL Process Implementation

### Main ETL Action: PopulateSurveyFlipBySurveyIdAction

```php
public function execute(string $survey_id): void
{
    // EXTRACT
    $survey_response = SurveyResponse::getResponsesForSurvey($survey_id);
    $questions = LimeQuestion::where('sid', $survey_id)
        ->whereNotIn('type', ['X'])
        ->get();
    
    // TRANSFORM & LOAD
    $rows = $survey_response
        ->withParticipants()
        ->where('submitdate', '!=', null)
        ->withAllAnswers('subquery')
        ->get();
    
    foreach ($rows as $row) {
        foreach ($questions as $q) {
            // Transform
            $data = [
                'survey_id' => $survey_id,
                'question_id' => $q->qid,
                'question_type' => $q->type,
                'answer' => $row->{$q->fieldname},
                'value' => $row->{$q->fieldname.'answer'},
                'submitdate' => $row->submitdate,
                'fieldname' => $q->fieldname,
                'token' => $row->token,
                'feedback' => $row->getFeedbackByTitle($q),
                'old_id' => $row->id,
            ];
            
            // Load with validation
            if ($this->isValidData($data)) {
                $where = ['old_id' => $data['old_id'], 'survey_id' => $survey_id, 'question_id' => $q->qid];
                SurveyFlipResponse::updateOrCreate($where, $data);
            }
        }
    }
}

private function isValidData(array $data): bool
{
    return (!is_null($data['answer']) && trim($data['answer']) !== '') ||
           (!is_null($data['value']) && trim($data['value']) !== '');
}
```

## Performance Optimization

### 1. Chunking Large Datasets
```php
$survey_response->chunk(1000, function($chunk) use ($questions) {
    foreach ($chunk as $row) {
        foreach ($questions as $q) {
            // Process individual response
        }
    }
});
```

### 2. Selective Loading
```php
// Only load necessary columns
$responses = $survey_response
    ->select(['id', 'submitdate', 'token', $this->getQuestionFieldnames($questions)])
    ->where('submitdate', '!=', null)
    ->get();
```

### 3. Database Indexing
```sql
-- Recommended indexes for performance
CREATE INDEX idx_survey_flip_survey_question ON survey_flip_responses(survey_id, question_id);
CREATE INDEX idx_survey_flip_submitdate ON survey_flip_responses(submitdate);
CREATE INDEX idx_survey_flip_token ON survey_flip_responses(token);
```

### 4. Caching Strategies
- Cache question metadata to avoid repeated queries
- Implement result caching for expensive operations
- Use Laravel's model caching where appropriate

## Scheduling and Automation

### Cron-based Processing
```php
// In app/Console/Kernel.php
$schedule->command('limesurvey:sync-all')
    ->hourly()
    ->withoutOverlapping();
    
$schedule->command('limesurvey:sync-latest')
    ->everyFifteenMinutes()
    ->withoutOverlapping();
```

### Queue-based Processing
```php
// Process large surveys in background
PopulateSurveyFlipBySurveyIdAction::make()
    ->onQueue('limesurvey-etl')
    ->execute($surveyId);
```

## Monitoring and Error Handling

### Progress Tracking
```php
// Track ETL progress
$max_old_id = SurveyFlipResponse::where('survey_id', $surveyId)->max('old_id') ?? 0;
$total_source = DB::table("lime_survey_$surveyId")->count();
$processed = SurveyFlipResponse::where('survey_id', $surveyId)->count();
$progress = ($processed / $total_source) * 100;
```

### Error Handling
- Log all ETL errors with context
- Implement retry mechanisms for transient failures
- Send alerts for critical failures
- Maintain data integrity during partial failures

### Data Quality Checks
```php
// Verify data consistency
public function verifyETL($surveyId) {
    $sourceCount = DB::table("lime_survey_$surveyId")->whereNotNull('submitdate')->count();
    $targetCount = SurveyFlipResponse::where('survey_id', $surveyId)->count();
    
    if ($sourceCount * 0.95 > $targetCount) { // Allow 5% tolerance
        Log::warning("ETL data mismatch for survey $surveyId: source=$sourceCount, target=$targetCount");
    }
}
```

## Incremental ETL

### Differential Loading
Instead of processing all data, only process new or changed records:

```php
public function executeIncremental(string $survey_id, ?DateTime $since = null): void
{
    $since = $since ?? SurveyFlipResponse::where('survey_id', $survey_id)->max('updated_at');
    
    $new_responses = SurveyResponse::getResponsesForSurvey($survey_id)
        ->where('submitdate', '>', $since)
        ->get();
        
    // Process only new responses
}
```

### Change Data Capture
- Track last sync timestamp
- Monitor for updates to existing responses
- Handle response modifications appropriately

## Troubleshooting Common Issues

### 1. Performance Issues
- **Symptom**: ETL process taking too long
- **Solution**: Implement chunking, optimize queries, add indexes

### 2. Data Inconsistencies
- **Symptom**: Missing or duplicate records
- **Solution**: Improve duplicate detection, add unique constraints

### 3. Memory Issues
- **Symptom**: Process running out of memory
- **Solution**: Use chunking, optimize data structures

### 4. Schema Changes
- **Symptom**: ETL failing due to LimeSurvey schema changes
- **Solution**: Implement schema versioning, add compatibility layers

## Future Enhancements

### 1. Real-time ETL
- Integrate with LimeSurvey's plugin system
- Use `afterSurveyComplete` event for immediate processing
- Implement streaming data processing

### 2. Enhanced Transformations
- Add data validation rules
- Implement data quality metrics
- Support for custom transformation logic

### 3. Advanced Monitoring
- Real-time progress tracking
- Automated alerting for failures
- Performance metrics dashboard

### 4. Scalability Improvements
- Parallel processing for multiple surveys
- Distributed ETL architecture
- Cloud-based processing capabilities