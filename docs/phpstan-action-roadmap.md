# PHPStan Level 10 Roadmap - Limesurvey Action Classes

**Date**: 2026-01-14  
**Module**: Limesurvey  
**Target**: Action Classes (`Modules/Limesurvey/app/Actions/*`)  
**PHPStan Level**: 10 (max)  
**Status**: 🚀 **IN PROGRESS**

---

## 📊 Current Error Summary

### Files with Issues (10+ files):
- `GetParticipantModelBySurveyIdAction.php` - 1 error (return type)
- `PopulateSurveyFlipBySurveyIdAction.php` - 3+ errors (collection call, mixed types, array types)
- `PopulateSurveyFlipBySurveyIdAction.php` - Additional issues with trim() and firstOrCreate()

### Total Estimated Errors: ~10-15

---

## 🎯 Resolution Strategy

### Type 1: Return Type Corrections (P0 - Critical)
**Files**: All action classes
**Issue**: Missing or incorrect return type declarations
**Pattern**:
```php
// ❌ BEFORE
public function execute() {
    return $model;
}

// ✅ AFTER
public function execute(): Model
{
    return $model;
}
```

### Type 2: Mixed Type Handling (P0 - Critical)
**Files**: `PopulateSurveyFlipBySurveyIdAction.php`
**Issue**: Using mixed types without validation
**Pattern**:
```php
// ❌ BEFORE
$answerStr = $data['answer'];
$valueStr = $data['value'];
$answerStr = trim($answerStr);  // mixed to trim()

// ✅ AFTER
$answerStr = (string) ($data['answer'] ?? '');
$valueStr = (string) ($data['value'] ?? '');
$answerStr = trim($answerStr);
```

### Type 3: Collection Optimization (P1 - Important)
**Files**: `PopulateSurveyFlipBySurveyIdAction.php`
**Issue**: Using collection methods instead of query builder
**Pattern**:
```php
// ❌ BEFORE
$items = $query->get()->take(100);  // Collection call

// ✅ AFTER
$items = $query->limit(100)->get();  // Query builder call
```

### Type 4: Array Type Corrections (P1 - Important)
**Files**: `PopulateSurveyFlipBySurveyIdAction.php`
**Issue**: `firstOrCreate()` with untyped array
**Pattern**:
```php
// ❌ BEFORE
SurveyFlipResponse::firstOrCreate($where, $data);  // Untyped arrays

// ✅ AFTER
/** @var array<string, mixed> $where */
/** @var array<string, mixed> $data */
SurveyFlipResponse::firstOrCreate($where, $data);
```

---

## 📋 Detailed Fix Plan

### Phase 1: Return Type Corrections (Day 1)

#### File: `GetParticipantModelBySurveyIdAction.php`
- [ ] Verify return type matches implementation
- [ ] Add proper PHPDoc if needed
- [ ] Ensure type safety

#### File: `PopulateSurveyFlipBySurveyIdAction.php`
- [ ] Add proper return type to execute method
- [ ] Address mixed type issues in trim() calls
- [ ] Fix firstOrCreate() array typing

### Phase 2: Mixed Type Resolution (Day 1-2)

#### File: `PopulateSurveyFlipBySurveyIdAction.php`
- [ ] Fix trim() calls with mixed types
- [ ] Address firstOrCreate() array types
- [ ] Optimize collection calls to query builder

---

## 🔧 Implementation Patterns

### Pattern 1: Safe Action Implementation
```php
class GetParticipantModelBySurveyIdAction
{
    public function execute(string $survey_id): Model
    {
        $participant_class = 'Modules\Limesurvey\Models\LimeTokens'.$survey_id;
        if (! class_exists($participant_class)) {
            app(GenerateModelByModelClass::class)
                ->setCustomReplaces(['DummyTable' => 'lime_tokens_'.$survey_id])
                ->execute($participant_class);
        }

        /** @var Model $model */
        $model = app($participant_class);
        
        // Add assertion for type safety
        Assert::isInstanceOf($model, Model::class);
        return $model;
    }
}
```

### Pattern 2: Mixed Type in Action
```php
class PopulateSurveyFlipBySurveyIdAction
{
    public function execute(string $survey_id): void
    {
        $survey_response = SurveyResponse::getResponsesForSurvey($survey_id);
        // ... other code ...

        foreach ($rows as $row) {
            foreach ($questions as $q) {
                /** @var array<string, mixed> $data */
                $data = [
                    'old_id' => $row->old_id,
                    'survey_id' => $survey_id,
                    'question_id' => $q->qid,
                    // ... other fields
                ];

                // Safe string casting for mixed types
                $answerStr = is_string($data['answer']) ? $data['answer'] : (string) ($data['answer'] ?? '');
                $valueStr = is_string($data['value']) ? $data['value'] : (string) ($data['value'] ?? '');
                
                if ((! is_null($data['answer']) && trim($answerStr) !== '') ||
                    (! is_null($data['value']) && trim($valueStr) !== '')) {
                    /** @var array<string, mixed> $where */
                    $where = [
                        'old_id' => $data['old_id'],
                        'survey_id' => $data['survey_id'],
                        'question_id' => $data['question_id'],
                    ];
                    SurveyFlipResponse::firstOrCreate($where, $data);
                }
            }
        }
    }
}
```

### Pattern 3: Collection Optimization
```php
class SomeAction
{
    public function execute(): Collection
    {
        // ❌ Bad: Unnecessary collection call
        // return Model::query()->get()->take(100);
        
        // ✅ Good: Query builder call
        return Model::query()->limit(100)->get();
    }
}
```

---

## 🧠 Self-Analysis & Risk Assessment

### Risk 1: Breaking Data Access Patterns
**Concern**: The dynamic nature of LimeSurvey tables might be affected
**Mitigation**: Test with real survey data, ensure all dynamic access patterns work

### Risk 2: Performance Impact
**Concern**: Adding type checks might slow down data population
**Mitigation**: Profile performance, use efficient type checking, optimize critical paths

---

## 🧪 Validation Strategy

### After Each File Fix:
1. Run: `./vendor/bin/phpstan analyse Modules/Limesurvey/app/Actions/FileName.php --level=10`
2. Verify: No PHPStan errors for the specific file
3. Test: Action functionality remains intact
4. Document: Changes made

### After Each Phase:
1. Run: `./vendor/bin/phpstan analyse Modules/Limesurvey/app/Actions --level=10`
2. Verify: Error count reduced
3. Run: `./vendor/bin/phpmd Modules/Limesurvey/app/Actions text phpmd.ruleset.xml`
4. Update: Documentation

---

## 📈 Success Metrics

### Primary:
- [ ] 0 PHPStan errors in action classes
- [ ] All action functionality preserved
- [ ] Type safety implemented consistently

### Secondary:
- [ ] Performance maintained or improved
- [ ] Code readability enhanced
- [ ] Patterns documented for reuse

---

**Created**: 2026-01-14  
**Last Updated**: 2026-01-14  
**Status**: 🚀 **IN PROGRESS**  
**Next Action**: Begin with GetParticipantModelBySurveyIdAction.php