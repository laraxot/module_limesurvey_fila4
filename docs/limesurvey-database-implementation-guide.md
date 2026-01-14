# LimeSurvey Database Analysis & Implementation Guide

## Overview

This document provides a comprehensive analysis of the `quaeris_survey` database structure, which is populated by the LimeSurvey system. The database contains both static configuration tables and dynamic response tables that are created automatically when surveys are activated.

## Database Configuration

The database connection is defined in `config/database.php` with the alias `limesurvey`:

```php
'limesurvey' => [
    'driver' => 'mysql',
    'host' => env('DB_HOST', '127.0.0.1'),
    'port' => env('DB_PORT', '3306'),
    'database' => env('DB_DATABASE_LIMESURVEY', 'quaeris_survey'),
    'username' => env('DB_USERNAME_LIMESURVEY', 'forge'),
    'password' => env('DB_PASSWORD_LIMESURVEY', ''),
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'strict' => false,  // Important: LimeSurvey uses non-strict mode
],
```

## Database Structure

### Static Tables (Configuration)

#### 1. `lime_surveys`
Main table containing survey configurations.

**Key Columns**:
- `sid` (int, PK): Survey ID - unique identifier
- `active` (varchar): Status ('Y'/'N')
- `startdate`, `expires`: Survey availability dates
- `template`: Template used
- `language`: Default language
- `datecreated`: Creation timestamp

**Model**: `Modules\Limesurvey\Models\LimeSurvey`

#### 2. `lime_groups`
Contains question groups within a survey.

**Key Columns**:
- `gid` (int, PK): Group ID
- `sid` (int, FK): Survey ID
- `group_order` (int): Order within survey
- `randomization_group` (string): Randomization group name

**Model**: `Modules\Limesurvey\Models\LimeGroup`

#### 3. `lime_questions`
Contains all survey questions.

**Key Columns**:
- `qid` (int, PK): Question ID
- `sid`, `gid`: Survey and Group IDs
- `type` (varchar): Question type
- `title` (varchar): Question title (short code)
- `question` (text): Full question text
- `parent_qid` (int): Parent question for nested questions
- `relevance` (text): Expression for conditional logic
- `mandatory` (varchar): Required ('Y'/'N')

**Question Types**:
- `T`: Text (free input)
- `L`: List (dropdown)
- `M`: Multiple choice
- `1`: Array (numbers)
- `F`: File upload
- `;`: Array (text)
- `!`: Exclamation mark question

**Model**: `Modules\Limesurvey\Models\LimeQuestion`

#### 4. `lime_answers`
Contains answer options for multiple-choice questions.

**Key Columns**:
- `aid` (int, PK): Answer ID
- `qid` (int, FK): Question ID
- `code` (string): Answer code
- `sortorder` (int): Display order
- `assessment_value` (int): Assessment value

**Model**: `Modules\Limesurvey\Models\LimeAnswer`

#### 5. `lime_answer_l10ns` & `lime_question_l10ns`
Translation tables for answers and questions.

**Key Columns**:
- `aid`/`qid`: Foreign key to answer/question
- `language`: Language code (e.g., 'en', 'it')
- `answer`/`question`: Translated text

**Models**: `LimeAnswerL10n`, `LimeQuestionL10n`

### Dynamic Tables (Survey Data)

LimeSurvey creates dynamic tables when surveys are activated:

#### 1. `lime_survey_{surveyId}`
Contains all responses for a specific survey.

**Standard Columns**:
- `id` (int, PK): Response ID
- `token` (string): Participant token
- `submitdate` (datetime): Submission date
- `lastpage` (int): Last page visited
- `startlanguage` (string): Language used
- `datestamp` (datetime): Start timestamp
- `seed` (string): Randomization seed

**Dynamic Columns**:
- `{sid}X{gid}X{qid}`: `{surveyId}X{groupId}X{questionId}`
- `{sid}X{gid}X{qid}SQ001`: Sub-question format

Example for survey ID 39275: `39275X41X487`

**Model**: `Modules\Limesurvey\Models\SurveyResponse`

#### 2. `lime_tokens_{surveyId}`
Contains participant tokens for a specific survey.

**Key Columns**:
- `tid` (int, PK): Token ID
- `token` (string, UNIQUE): Unique token
- `firstname`, `lastname`: Participant name
- `email`: Participant email
- `completed` (datetime): Completion date
- `usesleft` (int): Remaining uses

**Model**: Dynamically generated (e.g., `LimeTokens39275`)

#### 3. `lime_survey_{surveyId}_timings`
Contains timing information for survey completion.

**Key Columns**:
- `id` (int, PK): Timing ID
- `token` (string): Participant token
- `datestamp` (datetime): Timestamp
- Timing data for each page/group

## Implementation Patterns in the Application

### Model Hierarchy

```php
// Base model for all LimeSurvey models
Modules\Limesurvey\Models\BaseModel extends Modules\Xot\Models\XotBaseModel
{
    protected $connection = 'limesurvey';
    // Uses GeneaLabs\LaravelModelCaching for performance
}

// Dynamic survey response model
Modules\Limesurvey\Models\SurveyResponse extends BaseModel
{
    public function setTableForSurvey($surveyId)
    {
        $this->surveyId = $surveyId;
        $this->setTable('lime_survey_'.$surveyId);
    }

    public static function getResponsesForSurvey(string $surveyId): Builder
    {
        $instance = new static;
        $instance->setTableForSurvey($surveyId);
        return $instance->newQuery();
    }
}
```

### Accessing Dynamic Data

```php
// Get survey responses
$responses = SurveyResponse::getResponsesForSurvey('39275')
    ->where('submitdate', '>=', '2024-01-01')
    ->get();

// With participants join
$responses = SurveyResponse::getResponsesForSurvey('39275')
    ->withParticipants()
    ->get();

// With answer labels (translated)
$responses = SurveyResponse::getResponsesForSurvey('39275')
    ->withAnswersLabel($qid, $field_name, $prefix = '', $type = 'join')
    ->get();

// With all answers
$responses = SurveyResponse::getResponsesForSurvey('39275')
    ->withAllAnswers('subquery')
    ->get();
```

### Tree Structure for Questions

LimeSurvey supports nested questions using adjacency list pattern:

```php
// Question tree relationships
$question->parent;      // Parent question (for sub-questions)
$question->children;    // Child questions
$question->brothers;    // Sibling questions (same survey)
$question->ancestors;   // All parent questions up the tree
$question->descendants; // All child questions down the tree
```

### Field Name Generation

Field names follow the pattern `{surveyId}X{groupId}X{questionId}`:

```php
// Field name computed property
public function getFieldNameAttribute(?string $value): string
{
    if ($value !== null) {
        return $value;
    }

    $res = $this->sid.'X'.$this->gid.'X';
    
    if ($this->type === 'F' && $this->child !== null) {
        return $res.$this->qid.''.$this->child->title;
    }
    if ($this->type === 'F') {
        return $res.$this->parent->qid.$this->title;
    }
    if ($this->parent_qid === 0) {
        return $res.$this->qid;
    }

    return $res.$this->parent_qid.''.$this->title;
}
```

## Performance Considerations

### Database Design Notes

1. **No Foreign Key Constraints**: LimeSurvey doesn't use DB-level foreign keys
   - Relies on application-level integrity
   - Better performance for large datasets
   - Requires careful validation in code

2. **Wide Tables**: Dynamic survey tables can have 50+ columns
   - Select only needed columns with `addSelect()`
   - Avoid `SELECT *` on large survey tables

3. **Index Strategy**:
   - Critical: `submitdate` on response tables
   - Important: `token` for joins
   - Consider: frequently filtered columns

### Query Optimization

```php
// ⚠️ Bad: N+1 queries
foreach ($responses as $response) {
    echo $response->token_email; // Separate query each time
}

// ✅ Good: Eager loading
$responses = SurveyResponse::getResponsesForSurvey($surveyId)
    ->withParticipants()
    ->get();

// ✅ Good: Subquery joins for translations
$responses = SurveyResponse::getResponsesForSurvey($surveyId)
    ->withAnswersLabel($qid, $field_name, $prefix, 'subquery')
    ->get();
```

### Caching

The system uses `GeneaLabs\LaravelModelCaching` for performance:

```php
// Models are cached automatically
$survey = LimeSurvey::find(39275); // Cached after first query
```

## Integration with Quaeris Module

The Quaeris module uses LimeSurvey data for:
1. **Question Charts**: Visualizing survey responses
2. **Dashboards**: Real-time survey analytics
3. **PDF Exports**: Professional survey reports
4. **Data Export**: XLS, CSV exports

## Security Considerations

1. **Survey Isolation**: Each survey's data is in separate tables
2. **Token-based Access**: Participants use unique tokens
3. **Permission Checks**: Survey access is controlled by policies
4. **Data Validation**: All input is validated before storage

## Best Practices

### 1. Working with Dynamic Tables
```php
// ✅ Use the static method
SurveyResponse::getResponsesForSurvey($surveyId)

// ❌ Don't access table directly
DB::table('lime_survey_'.$surveyId)
```

### 2. Querying Responses
```php
// ✅ Use scopes for filtering
$response = SurveyResponse::getResponsesForSurvey($surveyId)
    ->ofDashboardFilterData($filterData)
    ->first();

// ❌ Don't build complex where clauses manually
```

### 3. Handling Translations
```php
// ✅ Use provided methods
$question->l10n->question;        // Translated question
$answer->l10n->answer;            // Translated answer

// ✅ Use joins for bulk operations
->withAnswersLabel($qid, $field, $prefix, $type)
```

## Common Patterns

### 1. Survey Analysis
```php
$survey = LimeSurvey::find($surveyId);
$questions = $survey->questions;
$responses = SurveyResponse::getResponsesForSurvey($surveyId)
    ->withParticipants()
    ->get();
```

### 2. Question Filtering
```php
$question = LimeQuestion::find($questionId);
$responses = SurveyResponse::getResponsesForSurvey($question->sid)
    ->where($question->field_name, $value)
    ->get();
```

### 3. Response Aggregation
```php
$counts = SurveyResponse::getResponsesForSurvey($surveyId)
    ->select($field_name, DB::raw('COUNT(*) as count'))
    ->groupBy($field_name)
    ->get();
```

## Troubleshooting

### Common Issues

1. **Table Not Found**: Survey table wasn't created (survey not activated)
   - Verify survey is active in `lime_surveys`
   - Check survey was properly activated

2. **Field Name Issues**: Dynamic field name not matching
   - Use `getFieldNameAttribute()` method
   - Verify question structure (parent/child relations)

3. **Performance Issues**: 
   - Ensure proper indices are created
   - Use `addSelect()` to limit columns
   - Consider using 'subquery' type for joins

This comprehensive guide covers the LimeSurvey database structure as implemented in the quaeris_survey database and how it's integrated into the application.