# LimeSurvey Module: Models and Query Patterns

## Core Models Overview

### LimeSurvey Model
Represents the `lime_surveys` table containing survey metadata.

**Key Methods**:
```php
// Get survey with all relationships
$survey = LimeSurvey::with(['groups.questions.answers'])->find($surveyId);

// Access groups
$groups = $survey->groups;

// Access all questions
$questions = $survey->questions;
```

### LimeGroup Model
Represents `lime_groups` table (question groups/pages).

**Relationships**:
- `survey()` - Parent survey
- `questions()` - Questions in this group

### LimeQuestion Model
Represents `lime_questions` table with hierarchical support.

**Key Features**:
- Uses `Staudenmeir\LaravelAdjacencyList` for tree relationships
- Supports parent/child questions (subquestions)
- Includes question type information

**Methods**:
```php
// Get questions with children
$questions = LimeQuestion::with('children')->get();

// Get parent question
$parent = $question->parent;

// Get all children
$children = $question->children;
```

### LimeAnswer Model
Represents `lime_answers` table (predefined answer options).

**Usage**:
```php
// Get answers for a question
$answers = LimeAnswer::where('qid', $questionId)->get();

// Access localized answer text
$answer = $answers->first()->answer; // Localized via L10n join
```

### SurveyResponse Model
**Dynamic model** for accessing `lime_survey_{SID}` response tables.

**Critical Pattern**: Dynamic table binding

```php
public static function getResponsesForSurvey(string $surveyId): Builder
{
    $instance = new static;
    $instance->setTableForSurvey($surveyId);
    return $instance->newQuery();
}
```

**Usage Examples**:

```php
// Get all responses for a survey
$responses = SurveyResponse::getResponsesForSurvey('982763')
    ->where('submitdate', '!=', null)
    ->get();

// Access dynamic fields
foreach ($responses as $response) {
    $fieldValue = $response->{'982763X1165X34197'}; // Dynamic field
    $submitDate = $response->submitdate; // Standard field
}

// Select specific columns only
$responses = SurveyResponse::getResponsesForSurvey($surveyId)
    ->select(['id', 'submitdate', $fieldName])
    ->get();
```

### SurveyFlipResponse Model
EAV (Entity-Attribute-Value) representation of survey responses.

**Pattern**: "Survey Flip" - Transform dynamic responses to static format

```
Extract (lime_survey_{SID})
    ↓
Transform (Map columns to questions)
    ↓
Load (survey_flip_responses table)
```

**Benefits**:
- Eloquent compatibility for relationships
- Simplified querying for analytics
- Consistent schema across all surveys

## Query Scopes and Methods

### withAnswersLabel()

Joins answer translation tables to get human-readable labels.

```php
$query = SurveyResponse::getResponsesForSurvey($surveyId)
    ->withAnswersLabel($questionId, $fieldName);
```

**Generated SQL**:
```sql
SELECT ..., ask_lang.answer as answer
FROM lime_survey_982763
LEFT JOIN lime_answers AS ask ON ask.code = {field} AND ask.qid = {qid}
LEFT JOIN lime_answer_l10ns AS ask_lang ON ask.aid = ask_lang.aid AND ask_lang.language = 'it'
```

### withAllAnswers()

Joins all question answers for a survey (heavy query).

```php
$query = SurveyResponse::getResponsesForSurvey($surveyId)
    ->withAllAnswers('subquery');
```

**Use Case**: ETL processes, not real-time queries.

### ofDashboardFilterData()

Applies standard date filters from `DashboardFilterData`.

```php
$query = SurveyResponse::getResponsesForSurvey($surveyId)
    ->ofDashboardFilterData($filter);
```

**Filters Applied**:
- `date_from`: Start date filter
- `date_to`: End date filter
- Applies to `submitdate` column

## Performance Optimization Patterns

### 1. Column Selection

```php
// ✅ CORRECT: Select only needed columns
$responses = SurveyResponse::getResponsesForSurvey($surveyId)
    ->select(['id', 'submitdate', $fieldName])
    ->get();

// ❌ AVOID: SELECT * on wide tables
$responses = SurveyResponse::getResponsesForSurvey($surveyId)->get();
```

### 2. Chunking Large Datasets

```php
// ✅ CORRECT: Process in chunks
SurveyResponse::getResponsesForSurvey($surveyId)
    ->chunk(1000, function ($responses) {
        // Process chunk
    });
```

### 3. Caching

Automatic query caching via `GeneaLabs\LaravelModelCaching`:

```php
// Automatically cached
$survey = LimeSurvey::find($surveyId);
$questions = LimeQuestion::where('sid', $surveyId)->get();
```

### 4. Indexing Strategy

Ensure these columns are indexed:
- `lime_survey_{SID}.submitdate` - For date filtering
- `lime_questions.sid` - For survey filtering
- `lime_answers.qid` - For answer lookups

## Common Query Patterns

### Get Survey with Full Structure

```php
$survey = LimeSurvey::with([
    'groups' => function ($query) {
        $query->orderBy('group_order');
    },
    'groups.questions' => function ($query) {
        $query->orderBy('question_order');
    },
    'groups.questions.answers' => function ($query) {
        $query->orderBy('sortorder');
    }
])->find($surveyId);
```

### Get Responses with Answer Labels

```php
$responses = SurveyResponse::getResponsesForSurvey($surveyId)
    ->withAnswersLabel($questionId, $fieldName)
    ->where('submitdate', '!=', null)
    ->orderBy('submitdate', 'desc')
    ->get();
```

### Get Responses for Date Range

```php
$responses = SurveyResponse::getResponsesForSurvey($surveyId)
    ->whereBetween('submitdate', [$dateFrom, $dateTo])
    ->select(['id', 'submitdate', $fieldName])
    ->get();
```

### Get Question Hierarchy

```php
$questions = LimeQuestion::where('sid', $surveyId)
    ->with('children')
    ->whereNull('parent_qid')
    ->orderBy('question_order')
    ->get();
```

## Related Documentation

- `architecture-and-integration.md` - Overall architecture and design
- `survey-response-aggregations.md` - Aggregation methods
- `best-practices.md` - Best practices and patterns
