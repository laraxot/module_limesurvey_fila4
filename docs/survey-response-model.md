# SurveyResponse Model - Dynamic Table Access Pattern

> **See Also**: [Question Chart Analysis Pattern](file:///var/www/_bases/base_quaeris_fila4_mono/laravel/Modules/Quaeris/docs/question-chart-analysis-pattern.md)

## Overview

The `SurveyResponse` model provides dynamic access to LimeSurvey's response tables (`lime_survey_{SID}`), which have unpredictable column structures based on the survey's questions.

## Key Pattern: Dynamic Table Binding

### Problem

LimeSurvey creates one table per survey with columns like:
- `982763X1165X34197` (Question field)
- `982763X1165X34198001` (Subquestion field)
- `submitdate`, `token`, etc. (Standard fields)

These columns **cannot be known at compile time**.

### Solution

Dynamic table name binding via `setTableForSurvey()`:

```php
public function setTableForSurvey($surveyId): void
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
```

**Usage**:
```php
// Get all responses for survey 982763
$responses = SurveyResponse::getResponsesForSurvey('982763')->get();

// Access dynamic properties
foreach ($responses as $response) {
    echo $response->{'982763X1165X34197'}; // Dynamic field access
    echo $response->submitdate; // Standard field
}
```

## Query Scopes for Analysis

### 1. withAnswersLabel()

**Purpose**: Join answer translation tables to get human-readable labels.

**Location**: [`SurveyResponse.php:152-184`](file:///var/www/_bases/base_quaeris_fila4_mono/laravel/Modules/Limesurvey/app/Models/SurveyResponse.php#L152-L184)

```php
$query = SurveyResponse::getResponsesForSurvey($surveyId)
    ->withAnswersLabel($questionId, $fieldName);

// Adds columns: 'answer' with translated label
```

**SQL Generated**:
```sql
SELECT ..., ask_lang.answer as answer
FROM lime_survey_982763
LEFT JOIN lime_answers AS ask ON ask.code = {field} AND ask.qid = {qid}
LEFT JOIN lime_answer_l10ns AS ask_lang ON ask.aid = ask_lang.aid AND ask_lang.language = 'it'
```

### 2. withAllAnswers()

**Purpose**: Join all question answers for a survey (heavy query).

**Location**: [`SurveyResponse.php:186-212`](file:///var/www/_bases/base_quaeris_fila4_mono/laravel/Modules/Limesurvey/app/Models/SurveyResponse.php#L186-L212)

**Use Case**: ETL processes, not real-time queries.

### 3. withParticipants()

**Purpose**: Join participant data from `lime_tokens_{SID}`.

**Location**: [`SurveyResponse.php:219-229`](file:///var/www/_bases/base_quaeris_fila4_mono/laravel/Modules/Limesurvey/app/Models/SurveyResponse.php#L219-L229)

### 4. ofDashboardFilterData()

**Purpose**: Apply date range filters.

**Location**: [`SurveyResponse.php:231-244`](file:///var/www/_bases/base_quaeris_fila4_mono/laravel/Modules/Limesurvey/app/Models/SurveyResponse.php#L231-L244)

```php
$query->ofDashboardFilterData(DashboardFilterData::from([
    'date_from' => '2024-01-01',
    'date_to' => '2024-12-31',
]));

// WHERE submitdate >= '2024-01-01' AND submitdate <= '2024-12-31'
```

## Integration with QuestionChart Analysis

The `SurveyResponse` model is the **data layer** for the [QuestionChart analysis pattern](file:///var/www/_bases/base_quaeris_fila4_mono/laravel/Modules/Quaeris/docs/question-chart-analysis-pattern.md).

### Complete Query Example (from QuestionChartAnswersTableWidget)

```php
$query = SurveyResponse::getResponsesForSurvey($surveyId)
    ->withAnswersLabel($questionId, $fieldName)
    ->addSelect([
        'submitdate',
        DB::raw($fieldName.' as value'),
        DB::raw('date_format(submitdate, "%Y-%m") as label'),
        DB::raw('SUM('.$fieldName.' = "Y") as Y_count'),
        DB::raw('SUM('.$fieldName.' = "N") as N_count'),
    ])
    ->ofDashboardFilterData($filterData)
    ->groupBy(DB::raw('date_format(submitdate, "%Y-%m")'));
```

**Result**: Monthly aggregated Yes/No counts with date filtering.

## PHPStan Considerations

### Dynamic Property Access

The model uses **magic properties** to access dynamic columns:

```php
$response->{'982763X1165X34197'} // ✅ Works
$response->submitdate             // ✅ Works (known column)
```

**PHPStan Issue**: These properties don't exist in the class definition.

**Solutions**:

1. **PHPDoc annotation** (for known surveys):
   ```php
   /**
    * @property string $submitdate
    * @property string $token
    * @property mixed $982763X1165X34197
    * ...
    */
   ```

2. **Type narrowing before access**:
   ```php
   $value = $response->getAttribute($fieldName);
   if (is_string($value)) {
       // Now PHPStan knows it's a string
   }
   ```

3. **Safe access pattern** (recommended):
   ```php
   use Modules\Xot\Actions\Cast\SafeEloquentCastAction;
   
   $value = SafeEloquentCastAction::get($response, $fieldName, '');
   ```

## Performance Best Practices

### 1. Always Use Query Builder

❌ **Bad**: Loading all, then filtering in PHP
```php
$all = SurveyResponse::getResponsesForSurvey($surveyId)->get();
$filtered = $all->filter(fn($r) => $r->submitdate > '2024-01-01');
```

✅ **Good**: Database-level filtering
```php
$filtered = SurveyResponse::getResponsesForSurvey($surveyId)
    ->where('submitdate', '>', '2024-01-01')
    ->get();
```

### 2. Limit JOINs

The `withAllAnswers()` scope can create **dozens of JOINs**. Use only when necessary:

```php
// ❌ Heavy: joins all answers
$query->withAllAnswers();

// ✅ Light: join only needed answer
$query->withAnswersLabel($qid, $fieldName);
```

### 3. Index Dynamic Columns

If analyzing specific questions frequently:

```sql
CREATE INDEX idx_question_value ON lime_survey_982763 (982763X1165X34197);
CREATE INDEX idx_question_submitdate ON lime_survey_982763 (982763X1165X34197, submitdate);
```

## Testing Patterns

### Testing Dynamic Table Access

```php
use Modules\Limesurvey\Models\SurveyResponse;

it('accesses dynamic survey table', function () {
    $surveyId = '982763';
    
    $query = SurveyResponse::getResponsesForSurvey($surveyId);
    
    expect($query->getModel()->getTable())
        ->toBe('lime_survey_982763');
});

it('filters responses by date', function () {
    $query = SurveyResponse::getResponsesForSurvey('982763')
        ->ofDashboardFilterData(DashboardFilterData::from([
            'date_from' => '2024-01-01',
            'date_to' => '2024-12-31',
        ]));
    
    $sql = $query->toSql();
    
    expect($sql)->toContain('submitdate >= ?');
    expect($sql)->toContain('submitdate <= ?');
});
```

## Related Documentation

- [Complete Question Chart Analysis Pattern](file:///var/www/_bases/base_quaeris_fila4_mono/laravel/Modules/Quaeris/docs/question-chart-analysis-pattern.md) - Full integration guide
- [Database Schema Analysis](file:///var/www/_bases/base_quaeris_fila4_mono/laravel/Modules/Limesurvey/docs/database-schema-analysis.md) - Hybrid access strategy
- [ETL Process](file:///var/www/_bases/base_quaeris_fila4_mono/laravel/Modules/Limesurvey/docs/etl-process.md) - SurveyFlip transformation

---

**Last Updated**: 2026-01-14  
**Maintainer**: Laraxot Team  
**Status**: Production - Core Pattern
