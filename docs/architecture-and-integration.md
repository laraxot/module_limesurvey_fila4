# LimeSurvey Module: Architecture and Integration Guide

**Last Updated**: January 2026  
**Status**: ✅ PHPStan Level 10 Compliance (0 errors)

## Overview

The **Limesurvey module** integrates LimeSurvey (upstream survey platform) into the Laraxot monolith. It provides:

- Direct database access to LimeSurvey's survey structure and responses
- Dynamic model access to survey-specific response tables (`lime_survey_{SID}`)
- Query optimization patterns for analytics and reporting
- Integration foundation for the Quaeris module (dashboards, charts, PDFs)

This module is **infrastructural**: it exposes models, queries, and utilities. Business logic for reporting lives primarily in `Modules/Quaeris`.

## Core Architecture

### Static Metadata Tables

LimeSurvey maintains permanent tables for survey configuration:

| Table | Purpose | Key Column |
|-------|---------|------------|
| `lime_surveys` | Survey configuration and properties | `sid` (Survey ID) |
| `lime_groups` | Question groups/pages within surveys | `gid` (Group ID) |
| `lime_questions` | Question definitions, types, logic | `qid` (Question ID) |
| `lime_answers` | Predefined answers for closed questions | `aid` (Answer ID) |
| `lime_users` | Administrator accounts | `uid` (User ID) |

### Dynamic Response Tables

When a survey is activated, LimeSurvey creates a dedicated table: `lime_survey_{SID}`

**Structure**:
- `id`: Response identifier (Primary Key)
- `submitdate`: Timestamp of survey completion
- `lastpage`: Progress tracking
- `startlanguage`: Language used
- **Dynamic Columns**: Following naming convention `{SID}X{GID}X{QID}`
  - Example: `1234X12X88` (Survey 1234, Group 12, Question 88)
  - Subquestions: `1234X12X88_SQ001`
  - Comments: `1234X12X88_other`

### Localization (L10n) Strategy

Since LimeSurvey 3.x, translations are normalized into separate localization tables:

- `lime_survey_l10ns` - Localized survey information
- `lime_group_l10ns` - Localized group information
- `lime_question_l10ns` - Localized question text
- `lime_answer_l10ns` - Localized answer options

**Important**: Always join with the appropriate L10n table to get actual text content in the specific language.

## Database Connection Configuration

The module uses the `limesurvey` connection (configured in `config/database.php`):

```php
'limesurvey' => [
    'driver' => 'mysql',
    'host' => env('DB_HOST_LIMESURVEY'),
    'port' => env('DB_PORT_LIMESURVEY'),
    'database' => env('DB_DATABASE_LIMESURVEY', 'quaeris_survey'),
    'username' => env('DB_USERNAME_LIMESURVEY'),
    'password' => env('DB_PASSWORD_LIMESURVEY'),
],
```

All models in the Limesurvey module extend `BaseModel` which sets `protected $connection = 'limesurvey'`.

## Core Models

### LimeSurvey
Represents `lime_surveys` table. Provides access to survey metadata and relationships.

```php
$survey = LimeSurvey::with(['groups.questions.answers'])->find($surveyId);
```

### LimeQuestion
Represents `lime_questions` table with support for hierarchical questions (parent_qid).

Uses `Staudenmeir\LaravelAdjacencyList` for tree relationships:

```php
$questions = LimeQuestion::with('children')->get();
```

### SurveyResponse
**Dynamic model** for accessing `lime_survey_{SID}` response tables.

Key pattern: Dynamic table binding via `setTableForSurvey()`:

```php
public static function getResponsesForSurvey(string $surveyId): Builder
{
    $instance = new static;
    $instance->setTableForSurvey($surveyId);
    return $instance->newQuery();
}
```

**Usage**:
```php
$responses = SurveyResponse::getResponsesForSurvey('982763')
    ->where('submitdate', '!=', null)
    ->get();
```

### SurveyFlipResponse
EAV (Entity-Attribute-Value) representation of survey responses for easier querying.

Implements the "Survey Flip" pattern:
1. Extract from `lime_survey_{SID}`
2. Transform to normalized format
3. Load into static `survey_flip_responses` table

## Query Optimization Patterns

### 1. withAnswersLabel()

Joins answer translation tables to get human-readable labels:

```php
$query = SurveyResponse::getResponsesForSurvey($surveyId)
    ->withAnswersLabel($questionId, $fieldName);
```

Generates SQL:
```sql
SELECT ..., ask_lang.answer as answer
FROM lime_survey_982763
LEFT JOIN lime_answers AS ask ON ask.code = {field} AND ask.qid = {qid}
LEFT JOIN lime_answer_l10ns AS ask_lang ON ask.aid = ask_lang.aid AND ask_lang.language = 'it'
```

### 2. withAllAnswers()

Joins all question answers for a survey (heavy query, use for ETL):

```php
$query = SurveyResponse::getResponsesForSurvey($surveyId)
    ->withAllAnswers('subquery');
```

### 3. ofDashboardFilterData()

Applies standard date filters from `DashboardFilterData`:

```php
$query = SurveyResponse::getResponsesForSurvey($surveyId)
    ->ofDashboardFilterData($filter);
```

## Performance Best Practices

### 1. Select Only Required Columns

```php
// ✅ CORRECT: Limit columns for wide tables
$responses = SurveyResponse::getResponsesForSurvey($surveyId)
    ->select(['id', 'submitdate', $fieldName])
    ->get();

// ❌ AVOID: SELECT * on wide tables (hundreds of columns)
$responses = SurveyResponse::getResponsesForSurvey($surveyId)->get();
```

### 2. Use Chunking for Large Datasets

```php
// ✅ CORRECT: Process large datasets in chunks
SurveyResponse::getResponsesForSurvey($surveyId)
    ->chunk(1000, function ($responses) {
        // Process chunk
    });
```

### 3. Leverage Caching

The module uses `GeneaLabs\LaravelModelCaching` for automatic query caching:

```php
// Automatically cached
$survey = LimeSurvey::find($surveyId);
```

### 4. Index Strategy

Ensure `submitdate` column is indexed in `lime_survey_{SID}` tables for date filtering performance.

## Integration with Quaeris Module

The Quaeris module builds on Limesurvey by:

1. **Accessing survey data** via `SurveyResponse::getResponsesForSurvey()`
2. **Applying filters** with `DashboardFilterData`
3. **Generating visualizations** with Chart module
4. **Exporting reports** to PDF

See `../../Quaeris/docs/` for detailed integration patterns.

## PHPStan Compliance

The Limesurvey module has achieved **Level 10 compliance** with PHPStan:

- ✅ 0 errors at the highest level of type checking
- ✅ Full type safety across all components
- ✅ Complete code quality compliance
- ✅ Professional-grade static analysis results

See `phpstan/` directory for detailed analysis reports.

## Related Documentation

- `survey-response-model.md` - Dynamic table access patterns
- `survey-response-aggregations.md` - Aggregation methods and data access
- `best-practices.md` - Best practices for working with the module
- `phpstan/` - PHPStan analysis reports and compliance details
- `../../Quaeris/docs/` - Integration patterns and usage examples
