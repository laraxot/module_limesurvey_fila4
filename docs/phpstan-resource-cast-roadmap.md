# PHPStan Level 10 Roadmap - Limesurvey Resource and Cast Classes

**Date**: 2026-01-14  
**Module**: Limesurvey  
**Target**: Resource Classes (`Modules/Limesurvey/app/Filament/Resources/*`) and Cast Classes (`Modules/Limesurvey/app/Casts/*`)  
**PHPStan Level**: 10 (max)  
**Status**: 🚀 **IN PROGRESS**

---

## 📊 Current Error Summary

### Resource Files with Issues:
- `SurveyFlipResponseResource.php` - 1 error (form schema return type)
- `SurveyFlipResponseResource/Pages/ListSurveyFlipResponses.php` - 3 errors (property types, return types, parameter types)

### Cast Files with Issues:
- `LimeLangField.php` - 2 errors (return types)

### Total Estimated Errors: ~6

---

## 🎯 Resolution Strategy

### Type 1: Form Schema Return Types (P0 - Critical)
**Files**: Resource classes with getFormSchema methods
**Issue**: `should return array<string, Component> but returns array<int, Component>`
**Pattern**:
```php
// ❌ BEFORE
public function getFormSchema(): array
{
    return [
        DateTimePicker::make('created_at'),
        TextInput::make('field'),
    ];
}

// ✅ AFTER
/** @return array<string, Component> */
public function getFormSchema(): array
{
    return [
        'created_at' => DateTimePicker::make('created_at'),
        'field' => TextInput::make('field'),
    ];
}
```

### Type 2: Page Class Issues (P0 - Critical)
**Files**: ListSurveyFlipResponses.php
**Issues**: Property types, return types, parameter types
**Pattern**:
```php
// ❌ BEFORE
public $survey_id = '';

// ✅ AFTER
protected string $survey_id = '';

// ❌ BEFORE
public function getHeaderActions() {
    return [CreateAction::make(), Action::make(...)];
}

// ✅ AFTER
/** @return array<string, Action> */
public function getHeaderActions(): array
{
    return [
        'create' => CreateAction::make(),
        'custom' => Action::make(...),
    ];
}
```

### Type 3: Cast Return Types (P1 - Important)
**Files**: Cast classes like LimeLangField
**Issue**: Return types should be specific instead of mixed
**Pattern**:
```php
// ❌ BEFORE
public function get($value) {
    return $processed_value;
}

// ✅ AFTER
/** @return array|int|string|null */
public function get($value): array|int|string|null
{
    return $processed_value;
}
```

---

## 📋 Detailed Fix Plan

### Phase 1: Resource Class Fixes (Day 1)

#### File: `SurveyFlipResponseResource.php`
- [ ] Fix `getFormSchema()` return type with string keys
- [ ] Add proper PHPDoc for return type
- [ ] Ensure all components have string keys

#### File: `SurveyFlipResponseResource/Pages/ListSurveyFlipResponses.php`
- [ ] Fix `$survey_id` property type declaration
- [ ] Fix `getHeaderActions()` return type with string keys
- [ ] Fix `populate()` parameter type validation

### Phase 2: Cast Class Fixes (Day 1)

#### File: `LimeLangField.php`
- [ ] Fix `get()` method return types
- [ ] Add proper PHPDoc for return types
- [ ] Ensure consistent return type handling

---

## 🔧 Implementation Patterns

### Pattern 1: Resource Form Schema
```php
class SurveyFlipResponseResource extends XotBaseResource
{
    public static function getFormSchema(): array
    {
        // Use string keys for proper typing
        return [
            'created_at' => DateTimePicker::make('created_at'),
            'updated_at' => DateTimePicker::make('updated_at'),
            'survey_id' => TextInput::make('survey_id')->numeric(),
            'question_id' => TextInput::make('question_id')->numeric(),
            'answer' => TextInput::make('answer'),
            'submitdate' => DateTimePicker::make('submitdate'),
        ];
    }
}
```

### Pattern 2: Page Class with Type Safety
```php
class ListSurveyFlipResponses extends XotBaseListRecords
{
    protected string $survey_id = '';
    
    public function mount(): void
    {
        parent::mount();
        // Initialize survey_id from URL or other source
        $this->survey_id = request()->route('survey_id') ?? '';
    }

    /** @return array<string, Action> */
    public function getHeaderActions(): array
    {
        return [
            'create' => CreateAction::make()
                ->label('Create Survey Flip Response')
                ->url(route('filament.admin.resources.survey-flip-responses.create')),
            'import' => Action::make('import')
                ->label('Import Data')
                ->action(fn () => $this->importData()),
        ];
    }

    /** @param array<string, mixed> $data */
    public function populate(array $data): void
    {
        // Process the data with type safety
        foreach ($data as $key => $value) {
            // Process each item with proper type handling
        }
    }
}
```

### Pattern 3: Cast Class with Proper Types
```php
class LimeLangField
{
    /**
     * @param  mixed  $value
     * @return array<int|string, mixed>|int|string|null
     */
    public function get($value): array|int|string|null
    {
        if (is_null($value)) {
            return null;
        }

        if (is_string($value)) {
            // Handle string value
            $decoded = json_decode($value, true);
            return is_array($decoded) ? $decoded : $value;
        }

        return $value;
    }

    /**
     * @param  mixed  $value
     * @return string|null
     */
    public function set($value): ?string
    {
        if (is_null($value)) {
            return null;
        }

        if (is_array($value)) {
            return json_encode($value);
        }

        return (string) $value;
    }
}
```

---

## 🧠 Self-Analysis & Risk Assessment

### Risk 1: Form Functionality Changes
**Concern**: Changing form schemas from indexed to associative arrays might break form functionality
**Mitigation**: Test forms thoroughly, ensure Filament form system handles associative arrays properly

### Risk 2: Cast Behavior Changes
**Concern**: Adding strict return types to cast classes might break existing data processing
**Mitigation**: Test with various data types, ensure backward compatibility is maintained

---

## 🧪 Validation Strategy

### After Each File Fix:
1. Run: `./vendor/bin/phpstan analyse Modules/Limesurvey/app/Filament/Resources/FileName.php --level=10`
2. Run: `./vendor/bin/phpstan analyse Modules/Limesurvey/app/Casts/FileName.php --level=10`
3. Verify: No PHPStan errors for the specific file
4. Test: Resource/Cast functionality remains intact
5. Document: Changes made

### After Each Phase:
1. Run: `./vendor/bin/phpstan analyse Modules/Limesurvey/app/Filament/Resources --level=10`
2. Run: `./vendor/bin/phpstan analyse Modules/Limesurvey/app/Casts --level=10`
3. Verify: Error count reduced
4. Run: `./vendor/bin/phpmd Modules/Limesurvey/app/Filament/Resources text phpmd.ruleset.xml`
5. Run: `./vendor/bin/phpmd Modules/Limesurvey/app/Casts text phpmd.ruleset.xml`
6. Update: Documentation

---

## 📈 Success Metrics

### Primary:
- [ ] 0 PHPStan errors in resource classes
- [ ] 0 PHPStan errors in cast classes
- [ ] All resource functionality preserved
- [ ] All cast functionality preserved

### Secondary:
- [ ] Proper form schema typing implemented
- [ ] Type safety implemented consistently
- [ ] Code readability enhanced

---

**Created**: 2026-01-14  
**Last Updated**: 2026-01-14  
**Status**: 🚀 **IN PROGRESS**  
**Next Action**: Begin with SurveyFlipResponseResource.php