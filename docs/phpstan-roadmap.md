# Limesurvey Module PHPStan Roadmap

> **Date**: 2026-01-14
> **Status**: Completed
> **Target**: Level 10 Strict
> **Initial Errors**: 9601
> **Current Errors**: 0
> **Reduction**: 100%

## Progress Summary (2026-01-14)

### Major Fixes Completed

#### 1. Dynamic Model PHPDoc Cleanup (Script-Based)
**Files Affected**: 289+ files (`LimeSurvey*.php`, `LimeTokens*.php`)
**Errors Fixed**: ~9300

**Problems Solved:**
- `generics.notGeneric`: Changed `CachedBuilder|ModelName` to `CachedBuilder<ModelName>`
- `phpDoc.parseError`: Removed `@property` annotations for fields starting with numbers (e.g., `$799586X1018X33007`)

**Script Location**: `fix-limesurvey-phpstan.php` (project root)

#### 2. Widget Type Declarations (Manual Fixes)
**Files Fixed:**
- `TypeF.php`: Added return types, fixed static property access, type hints
- `TypeExclamationPoint.php`: Fixed property declarations, type casting, callback typing
- `TypeL.php`: Fixed mixed type handling in map function
- `TypeT.php`: Fixed static access to instance property
- `TypeX.php`: Fixed static access to instance property
- `TypeB.php`: Fixed various issues
- `TypeM.php`: Fixed various issues
- Other Type*.php widgets: Fixed type safety issues

**Pattern Applied:**
```php
// Before
protected static ?string $heading = '';
protected function baseSurveyQuery() { ... }

// After
protected ?string $heading = null;
public function getHeading(): ?string { return strip_tags($this->title); }
protected function baseSurveyQuery(): Builder { ... }
```

#### 3. Action Classes Fixed
- `GetParticipantModelBySurveyIdAction.php`: Fixed return type issue
- `PopulateSurveyFlipBySurveyIdAction.php`: Fixed mixed type and collection issues

#### 4. Resource/Cast Classes Fixed
- `SurveyFlipResponseResource.php`: Fixed form schema return type
- `ListSurveyFlipResponses.php`: Fixed property assignments and return types
- `LimeLangField.php`: Fixed access to l10n property and return type issues

#### 5. Model Classes Fixed
- `BaseModel.php`: Fixed PHPDoc array type to list<string>
- `LimeAnswer.php`: Fixed PHPDoc array type to list<string>
- `LimeQuestion.php`: Fixed PHPDoc array type to list<string>
- `SurveyResponse.php`: Fixed return type issues

### All Work Completed

#### Files Successfully Fixed
| File | Errors Fixed | Status |
|------|--------------|--------|
| TypeL.php | ~17 | ✅ Completed |
| LimeSurvey.php | ~18 | ✅ Completed |
| LimeQuestion.php | ~13 | ✅ Completed |
| SurveyResponse.php | ~11 | ✅ Completed |
| RankingChart.php | ~8 | ✅ Completed |
| SingleChoiceChart.php | ~8 | ✅ Completed |
| TypeB.php | ~8 | ✅ Completed |
| TypeM.php | ~8 | ✅ Completed |
| GetParticipantModelBySurveyIdAction.php | ~1 | ✅ Completed |
| PopulateSurveyFlipBySurveyIdAction.php | ~4 | ✅ Completed |
| SurveyFlipResponseResource.php | ~1 | ✅ Completed |
| ListSurveyFlipResponses.php | ~3 | ✅ Completed |
| LimeLangField.php | ~2 | ✅ Completed |
| Other Type*.php widgets | Various | ✅ Completed |

#### All Error Patterns Resolved
1. **method.nonObject**: Fixed with proper type checking and casting
2. **argument.type**: Fixed with proper parameter validation and casting
3. **property.nonObject**: Fixed with safe property access patterns
4. **return.type**: Fixed with proper return type declarations
5. **offsetAccess.nonOffsetAccessible**: Fixed with proper array/object checking
6. **property.staticAccess**: Fixed by changing static access to instance access
7. **binaryOp.invalid**: Fixed with proper type casting
8. **encapsedStringPart.nonString**: Fixed with proper string casting
9. **Others**: All resolved

### Fix Strategies Applied

#### For Widget Files (Type*.php)
1. Remove `static::$heading` assignments, use `getHeading()` method
2. Add return types to all protected/public methods
3. Cast `$this->questionId` to string where needed
4. Use `(int)` cast for `$res->sum()` assignments
5. Add proper type checking for mixed values

#### For Action Files
1. Add proper return type declarations
2. Use type narrowing for mixed parameters
3. Cast return values when needed

#### For Model Files
1. Use `list<string>` instead of `array<string>` for PHPDoc
2. Add PHPDoc `@var` annotations for complex return types
3. Use type assertions with `is_object()` and `property_exists()`

### Commands to Verify
```bash
# Check specific file
./vendor/bin/phpstan analyse Modules/Limesurvey/app/Filament/Widgets/TypeF.php

# Check all Limesurvey
./vendor/bin/phpstan analyse Modules/Limesurvey

# Clear cache if needed
./vendor/bin/phpstan clear-result-cache
```

### PHPStan Stub Configuration
The project includes a stub for `CachedBuilder` at `stubs/CachedBuilder.stub`:
```php
/**
 * @template TModelClass of Model
 * @extends EloquentBuilder<TModelClass>
 */
class CachedBuilder extends EloquentBuilder {}
```

This resolves `generics.notGeneric` errors for CachedBuilder usage.

## Historical Context

### Error Categories (Initial Analysis)
- `generics.notGeneric`: 6610 (69%) - RESOLVED
- `phpDoc.parseError`: 2686 (28%) - RESOLVED
- `method.nonObject`: 115 - RESOLVED
- `argument.type`: 35 - RESOLVED
- Others: ~100 - RESOLVED

## Success Criteria
- [x] Fix dynamic model PHPDoc errors (9300+ errors)
- [x] Fix TypeF.php (40 errors → 0)
- [x] Fix TypeExclamationPoint.php (20 errors → 0)
- [x] Fix remaining ~200 errors
- [x] PHPStan shows 0 errors at max level
- [x] All functionality preserved
- [x] Consistent typing patterns
- [x] All 289+ files now compliant

---

**Last Updated**: 2026-01-14 22:14
**Maintainer**: AI Assistant (Claude)
**Related**: `fix-limesurvey-phpstan.php`

✅ **Limesurvey module now has 100% PHPStan Level 10 compliance**
