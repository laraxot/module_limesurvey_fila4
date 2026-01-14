# PHPStan Resolution Roadmap - Limesurvey Module

**Date**: 2026-01-14  
**Total Errors**: 9454 (across Limesurvey and Quaeris modules)  
**PHPStan Level**: 9  
**Status**: Planning Phase

## Error Categories & Resolution Strategy

### Category 1: Missing Type Specifications (~5000 errors) - CRITICAL
**Priority**: HIGH  
**Effort**: Medium  
**Impact**: Blocks all other fixes

#### Subcategories:
1. **Widget Properties** (~2000 errors)
   - `$surveyId`, `$fieldName`, `$questionId`, `$title`, `$heading`
   - Files: All `Limesurvey/app/Filament/Widgets/*.php`
   - Fix: Add `private|protected string|int|array` type declarations
   - Example:
     ```php
     // BEFORE
     public $surveyId;
     
     // AFTER
     private string $surveyId;
     ```

2. **Constructor Parameters** (~1500 errors)
   - Files: Widget `__construct()` methods
   - Fix: Add type hints to all parameters
   - Example:
     ```php
     // BEFORE
     public function __construct($surveyId, $questionId)
     
     // AFTER
     public function __construct(string $surveyId, int $questionId)
     ```

3. **Method Return Types** (~1500 errors)
   - Files: Various methods in widgets and resources
   - Fix: Add explicit return types
   - Example:
     ```php
     // BEFORE
     public function baseSurveyQuery()
     
     // AFTER
     public function baseSurveyQuery(): Builder
     ```

### Category 2: Undefined Properties in Models (~2000 errors) - MEDIUM
**Priority**: MEDIUM  
**Effort**: Low  
**Impact**: Model type safety

#### Subcategories:
1. **Faker Properties** (~20 errors)
   - Files: `Limesurvey/database/factories/*.php`
   - Issue: `Faker\Generator::$seed`, `$format`, `$firstname`, `$lastname`
   - Fix: Use `@phpstan-ignore-next-line` or baseline
   - Reason: Faker uses `__get()` magic method - false positive

2. **SurveyResponse Properties** (~10 errors)
   - Files: `Limesurvey/app/Actions/PopulateSurveyFlipBySurveyIdAction.php`
   - Missing: `$old_id`, `$submitdate`, `$token`
   - Fix: Add PHPDoc `@property` to SurveyResponse class
   - Example:
     ```php
     /**
      * @property string $old_id
      * @property \Carbon\Carbon $submitdate
      * @property string $token
      */
     class SurveyResponse extends BaseModel
     ```

3. **Model Relationships** (~1970 errors)
   - Files: Various model files
   - Fix: Add PHPDoc `@property-read` for relationships
   - Example:
     ```php
     /**
      * @property-read \Illuminate\Database\Eloquent\Collection<int, Answer> $answers
      */
     class Question extends BaseModel
     ```

### Category 3: Undefined Methods (~500 errors) - HIGH
**Priority**: HIGH  
**Effort**: Medium  
**Impact**: Breaks functionality

#### Subcategories:
1. **Trend::groupBy()** (~50 errors)
   - Files: `Limesurvey/app/Filament/Widgets/RankingChart.php`, `SingleChoiceChart.php`, etc.
   - Issue: `Flowframe\Trend\Trend::groupBy()` doesn't exist
   - Fix: Use alternative aggregation methods or refactor query
   - Research: Check Flowframe\Trend documentation for correct API

### Category 4: Return Type Mismatches (~100 errors) - MEDIUM
**Priority**: MEDIUM  
**Effort**: Low  
**Impact**: Type safety

#### Subcategories:
1. **getFormSchema() Return Type**
   - Files: `Limesurvey/app/Filament/Resources/SurveyFlipResponseResource.php`
   - Current: `array<int, Component>`
   - Expected: `array<string, Component>`
   - Fix: Add string keys to array
   - Example:
     ```php
     // BEFORE
     return [
         new DateTimePicker('submitted_at'),
         new TextInput('response_data'),
     ];
     
     // AFTER
     return [
         'submitted_at' => DateTimePicker::make('submitted_at'),
         'response_data' => TextInput::make('response_data'),
     ];
     ```

2. **getHeaderActions() Return Type**
   - Files: `Limesurvey/app/Filament/Resources/SurveyFlipResponseResource/Pages/ListSurveyFlipResponses.php`
   - Current: `array{CreateAction, Action}`
   - Expected: `array<string, Action>`
   - Fix: Add string keys

3. **getFooterWidgets() Return Type** (Quaeris)
   - Files: `Quaeris/app/Filament/Resources/SurveyPdfResource/Resources/QuestionCharts/Pages/ViewQuestionChart.php`
   - Current: `array<int, WidgetConfiguration>`
   - Expected: `array<class-string>`
   - Fix: Return class strings instead of configurations

### Category 5: Static Access to Instance Properties (~50 errors) - LOW
**Priority**: LOW  
**Effort**: Low  
**Impact**: Code style

#### Subcategories:
1. **Widget Heading Property**
   - Files: `TypeExclamationPoint.php`, `TypeL.php`, `TypeM.php`, `TypeN.php`
   - Issue: `static::$heading` used instead of `$this->heading`
   - Fix: Change to instance access
   - Example:
     ```php
     // BEFORE
     static::$heading = 'Title';
     
     // AFTER
     $this->heading = 'Title';
     ```

### Category 6: Collection Calls (~20 errors) - LOW
**Priority**: LOW  
**Effort**: Low  
**Impact**: Performance

#### Subcategories:
1. **Unnecessary Collection Calls**
   - Files: `Limesurvey/app/Actions/PopulateSurveyFlipBySurveyIdAction.php`
   - Issue: `take()` on collection instead of query
   - Fix: Use `limit()` on query builder
   - Example:
     ```php
     // BEFORE
     $responses->take(100);
     
     // AFTER
     $responses->limit(100);
     ```

## Resolution Order

1. **Phase 1: Type Specifications** (Days 1-2)
   - Widget properties
   - Constructor parameters
   - Method return types
   - Validation: PHPStan should drop from 9454 to ~4000 errors

2. **Phase 2: Model Properties** (Days 2-3)
   - SurveyResponse PHPDoc
   - Relationship PHPDoc
   - Faker baseline/ignores
   - Validation: PHPStan should drop to ~2000 errors

3. **Phase 3: Method Issues** (Days 3-4)
   - Trend::groupBy() refactoring
   - Return type corrections
   - Validation: PHPStan should drop to ~500 errors

4. **Phase 4: Code Style** (Days 4-5)
   - Static access fixes
   - Collection call optimizations
   - Validation: PHPStan should reach 0 errors

## Files to Modify (Priority Order)

### Phase 1 - Widget Type Specifications
```
Limesurvey/app/Filament/Widgets/
├── LikertScaleChart.php
├── MatrixChart.php
├── MultipleChoiceChart.php
├── OpenEndedResponses.php
├── RankingChart.php
├── SingleChoiceChart.php
├── TypeB.php
├── TypeExclamationPoint.php
├── TypeF.php
├── TypeL.php
├── TypeM.php
├── TypeN.php
└── TypeS.php

Limesurvey/app/Filament/Resources/
├── SurveyFlipResponseResource.php
└── SurveyFlipResponseResource/Pages/ListSurveyFlipResponses.php
```

### Phase 2 - Model Properties
```
Limesurvey/app/Models/
├── SurveyResponse.php
├── Answer.php
├── Question.php
└── [other models with relationships]

Limesurvey/database/factories/
├── LimeSurveyFactory.php
├── LimeTokens*.php
└── [other factories]
```

### Phase 3 - Method Issues
```
Limesurvey/app/Filament/Widgets/
├── RankingChart.php (Trend::groupBy)
├── SingleChoiceChart.php (Trend::groupBy)
├── TypeB.php (Trend::groupBy)
├── TypeExclamationPoint.php (Trend::groupBy)
├── TypeF.php (return types)
├── TypeL.php (return types)
├── TypeM.php (return types)
└── TypeN.php (return types)

Quaeris/app/Filament/Resources/
└── SurveyPdfResource/Resources/QuestionCharts/Pages/ViewQuestionChart.php
```

### Phase 4 - Code Style
```
Limesurvey/app/Filament/Widgets/
├── TypeExclamationPoint.php (static access)
├── TypeL.php (static access)
├── TypeM.php (static access)
└── TypeN.php (static access)

Limesurvey/app/Actions/
└── PopulateSurveyFlipBySurveyIdAction.php (collection calls)
```

## Validation Strategy

After each phase:
1. Run: `./vendor/bin/phpstan analyse Modules/Limesurvey --level=9`
2. Run: `./vendor/bin/phpstan analyse Modules/Quaeris --level=9`
3. Run: `./vendor/bin/phpmd Modules/Limesurvey text phpmd.xml`
4. Run: `./vendor/bin/phpinsights analyse Modules/Limesurvey`

## Notes

- **Faker False Positives**: Use baseline or `@phpstan-ignore-next-line` for Faker properties
- **Trend API**: Need to research correct Flowframe\Trend API for grouping
- **Laraxot Convention**: All form schema arrays must use string keys
- **Incremental Commits**: Commit after each phase for traceability

## Related Documentation

- `Modules/Limesurvey/docs/phpstan/` - Detailed level-by-level analysis
- `Modules/Activity/docs/phpstan-*.md` - Reference implementations
- `Modules/Chart/docs/phpstan-*.md` - Similar widget fixes
