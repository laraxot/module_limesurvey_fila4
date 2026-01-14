# Survey Flip Strategy

## Overview
The Survey Flip strategy is a core architectural pattern in our LimeSurvey integration that transforms LimeSurvey's dynamic, wide-table structure into a static, EAV (Entity-Attribute-Value) model for better analytics and querying capabilities.

## Problem Statement

LimeSurvey creates dynamic tables for each survey in the format `lime_survey_{SID}` with a structure like:

```
lime_survey_123456:
- id
- submitdate
- lastpage
- startlanguage
- 123456X22X487 (Question 487)
- 123456X22X488 (Question 488)
- 123456X22X489_SQ001 (Sub-question 489.1)
- 123456X22X489_SQ002 (Sub-question 489.2)
- ...
```

This creates several challenges:
1. Column names are non-semantic (e.g., `123456X22X487`)
2. Tables can be extremely wide (100+ columns)
3. Difficult to perform cross-survey analytics
4. Not compatible with Eloquent relationships
5. Complex queries for filtering and aggregation

## Solution: EAV Model

The Survey Flip strategy transforms the wide table into an EAV (Entity-Attribute-Value) structure:

```
survey_flip_responses:
- id (primary key)
- survey_id
- question_id
- question_type
- answer (raw value from lime_survey_xxx)
- value (processed value, often from answer labels)
- submitdate
- fieldname (original lime_survey_xxx field name)
- token
- old_id (original id from lime_survey_xxx)
- feedback
```

## Implementation

### 1. PopulateSurveyFlipBySurveyIdAction

The core implementation is in `Modules/Limesurvey/Actions/PopulateSurveyFlipBySurveyIdAction.php`:

```php
public function execute(string $survey_id): void
{
    $survey_response = SurveyResponse::getResponsesForSurvey($survey_id);
    $questions = LimeQuestion::where('sid', $survey_id)->whereNotIn('type', ['X'])->get();
    
    $rows = $survey_response
        ->withParticipants()
        ->where('submitdate', '!=', null)
        ->withAllAnswers('subquery')
        ->get();
    
    foreach ($rows as $row) {
        foreach ($questions as $q) {
            $data = [
                'survey_id' => $survey_id,
                'question_id' => $q->qid,
                'answer' => $row->{$q->fieldname},
                'value' => $row->{$q->fieldname.'answer'},
                'submitdate' => $row->submitdate,
                'fieldname' => $q->fieldname,
                'token' => $row->token,
                'feedback' => $row->getFeedbackByTitle($q),
            ];
            
            // Only insert if answer or value is not empty/null
            if ((! is_null($data['answer']) && trim($data['answer']) !== '') ||
                (! is_null($data['value']) && trim($data['value']) !== '')) {
                $where = Arr::only($data, ['old_id', 'survey_id', 'question_id']);
                SurveyFlipResponse::firstOrCreate($where, $data);
            }
        }
    }
}
```

### 2. Field Name Mapping

The transformation process maps LimeSurvey's field names to semantic data:
- `123456X22X487` → Maps to question ID 487 in survey 123456, group 22
- This is handled by the `get fieldname` attribute in `LimeQuestion` model

### 3. Hierarchical Question Support

The system handles LimeSurvey's hierarchical question structure:
- Parent questions with child sub-questions
- Matrix questions with multiple responses
- Different question types (text, multiple choice, etc.)

## Benefits

### 1. Eloquent Compatibility
```php
// Easy relationships and querying
$questions = SurveyFlipResponse::where('survey_id', $surveyId)
    ->where('question_id', $questionId)
    ->get();
```

### 2. Cross-Survey Analytics
```php
// Compare answers across different surveys
$popularAnswers = SurveyFlipResponse::where('question_id', $questionId)
    ->where('answer', 'Yes')
    ->count();
```

### 3. Simplified Filtering
```php
// Filter by date range, answer values, etc.
$responses = SurveyFlipResponse::whereBetween('submitdate', [$start, $end])
    ->where('answer', 'LIKE', '%value%')
    ->get();
```

### 4. Better Performance for Analytics
- Optimized for aggregation queries
- Proper indexing on survey_id, question_id, etc.
- Easier to implement caching strategies

## Performance Considerations

### 1. Chunking Large Surveys
```php
$survey_response->chunk(1000, function($chunk) {
    // Process in batches to avoid memory issues
});
```

### 2. Upsert Operations
Use efficient upsert operations to avoid duplicate processing:
```php
SurveyFlipResponse::upsert($data, ['old_id', 'survey_id', 'question_id']);
```

### 3. Differential Updates
Store last_sync_timestamp to only process new responses:
```php
$latest_responses = $survey_response
    ->where('submitdate', '>', $lastSync)
    ->get();
```

## Configuration

### 1. Scheduling
The flip process is typically scheduled to run periodically:
```php
// In app/Console/Kernel.php
$schedule->command('limesurvey:flip', ['--survey-id=123456'])
    ->hourly()
    ->withoutOverlapping();
```

### 2. Queue Processing
Heavy flip operations can be queued:
```php
PopulateSurveyFlipBySurveyIdAction::make()->onQueue()
    ->execute($surveyId);
```

## Monitoring and Maintenance

### 1. Sync Status Tracking
Monitor the progress of flip operations:
```php
$max_id = SurveyFlipResponse::where('survey_id', $survey_id)->max('old_id');
$remaining = SurveyResponse::getResponsesForSurvey($survey_id)
    ->where('id', '>', $max_id)
    ->count();
```

### 2. Data Integrity
Verify that all responses have been flipped:
```php
$total_lime_survey = DB::table("lime_survey_$survey_id")->count();
$total_flipped = SurveyFlipResponse::where('survey_id', $survey_id)->count();
```

## Troubleshooting

### 1. Missing Responses
Check if the sync has fallen behind:
- Verify the last processed ID
- Check for any errors in the processing queue
- Ensure the scheduled job is running

### 2. Performance Issues
- Monitor query performance on large surveys
- Check database indexing
- Consider chunking strategies for large datasets

### 3. Data Consistency
- Validate field name mappings
- Verify question metadata is correct
- Check for any special character issues

## Future Improvements

### 1. Real-time Processing
Integrate with LimeSurvey's plugin system for real-time updates using `afterSurveyComplete` event.

### 2. Incremental Processing
Implement more granular differential updates to reduce processing time.

### 3. Enhanced Caching
Cache question metadata to reduce database queries during the flip process.

### 4. Data Validation
Add validation rules to ensure data quality during the transformation process.