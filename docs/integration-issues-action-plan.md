# Limesurvey-Quaeris Integration Issues - Action Plan

**Date**: 2026-01-14  
**Priority**: HIGH  
**Status**: TODO  
**Estimated Effort**: Medium

## Executive Summary

The analysis revealed 11 PHPStan errors indicating integration issues between the Limesurvey and Quaeris modules. While the Limesurvey module itself has Level 10 compliance, integration points with Quaeris module need attention.

## Detailed Issues List

### 1. Missing Relations (4 occurrences)
**Error**: `Relation 'lang' is not found in Modules\Limesurvey\Models\LimeSurvey model`

**Files affected**:
- `Quaeris/app/Actions/Question/GetQuestionsBySurveyIdAction.php:44`
- `Quaeris/app/Actions/Question/GetSurveysAction.php:38` 
- `Quaeris/app/Actions/Question/GetSurveysOptsAction.php:19`
- `Quaeris/app/Models/SurveyPdf.php:164`

**Solution**: Add missing `lang()` relationship method to `LimeSurvey` model

### 2. Missing Methods (2 occurrences)
**Error**: `Call to an undefined method Modules\Limesurvey\Models\LimeSurvey::getTrans()`

**Files affected**:
- `Quaeris/app/Filament/Imports/ContactImporter.php:34`
- `Quaeris/app/Filament/Resources/SurveyPdfResource/Pages/EditSurveyPdf.php:70`

**Solution**: Implement `getTrans()` method in `LimeSurvey` model or update Quaeris code to use correct API

### 3. Class Resolution Issues (2 occurrences)
**Error**: `PHPDoc tag @docs/phpstan_after_ignore_var_fix.xml for variable $limeParentQuestion contains unknown class`

**Files affected**:
- `Quaeris/app/Filament/Resources/SurveyPdfResource/Resources/QuestionCharts/Pages/ViewQuestionChart.php:143-146`

**Solution**: Fix class reference and ensure proper LimeQuestion class resolution

### 4. Type Safety Issues (3 occurrences)
**Errors**: Mixed type handling and undefined method issues

**Files affected**:
- Various files with method_exists() checks and mixed type access

**Solution**: Improve type declarations and handle mixed types properly

## Implementation Plan

### Phase 1: Critical Relations (Day 1)
1. Add `lang()` relationship to `LimeSurvey` model
2. Test relation functionality
3. Update related Quaeris code if needed

### Phase 2: Missing Methods (Day 1-2)
1. Implement `getTrans()` method in `LimeSurvey` model
2. Verify functionality matches Quaeris expectations
3. Update method signatures for type safety

### Phase 3: Class Resolution (Day 2)
1. Fix LimeQuestion class reference issues
2. Ensure proper class imports and namespaces
3. Test ViewQuestionChart functionality

### Phase 4: Type Safety (Day 2-3)
1. Add proper type declarations
2. Handle mixed types with appropriate checks
3. Run comprehensive tests

## Expected Outcomes

- **0 PHPStan errors** across both modules
- **Improved integration** between Limesurvey and Quaeris
- **Better type safety** in cross-module communications
- **Enhanced maintainability** with proper relationships and methods

## Success Criteria

- [ ] All 11 PHPStan errors resolved
- [ ] Integration tests pass
- [ ] No regression in existing functionality
- [ ] Type safety maintained across module boundaries