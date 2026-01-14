# PHPStan Level 10 Master Roadmap - Limesurvey Module

**Date**: 2026-01-14  
**Module**: Limesurvey  
**Target PHPStan Level**: 10 (max)  
**Status**: 🚀 **IN PROGRESS**  

---

## 📊 Current Status Analysis

### Total Errors Identified: ~5000+ (based on PHPStan checkstyle output)
### Progress: Building upon existing roadmaps for comprehensive resolution

---

## 🎯 Master Resolution Strategy

### Phase 1: Critical Type Safety Fixes (Days 1-2)
Focus on blocking issues that prevent other fixes from being implemented.

#### 1.1 Return Type Corrections (P0 - Blocking)
- **Files**: Actions, Widgets, Resources, Casts
- **Errors**: `return.type`, `argument.type`
- **Approach**: Add explicit return types and parameter types
- **Pattern**: Use `webmozarts/assert` for type safety

#### 1.2 Mixed Type Resolution (P0 - Blocking) 
- **Files**: All widget files, actions, models
- **Errors**: `Cannot call method on mixed`, `Cannot access offset on mixed`
- **Approach**: Add type narrowing, assertions, and proper casting

#### 1.3 Property Type Declarations (P1)
- **Files**: Widget classes, action classes
- **Errors**: `Property has no type specified`
- **Approach**: Add proper visibility and types to all properties

### Phase 2: Framework Integration Issues (Days 2-3)
Focus on integration-specific issues with Laravel, Filament, and Eloquent.

#### 2.1 Filament Schema Corrections (P1)
- **Files**: Resource classes with form schemas
- **Errors**: `should return array<string, Component> but returns array<int, Component>`
- **Approach**: Convert indexed arrays to associative arrays with string keys

#### 2.2 Eloquent Query Fixes (P1)
- **Files**: Model queries, relationships
- **Errors**: `Cannot access property on mixed`, `method.nonObject`
- **Approach**: Add proper return types to Eloquent methods

#### 2.3 Flowframe\Trend Integration (P2)
- **Files**: Chart widgets using Trend
- **Errors**: `Call to undefined method Flowframe\Trend\Trend::groupBy()`
- **Approach**: Research correct API usage or refactor

### Phase 3: Model and Factory Fixes (Days 3-4)
Focus on Eloquent models and factory classes.

#### 3.1 Model PHPDoc Enhancements (P2)
- **Files**: All model files
- **Errors**: `PHPDoc type not covariant`, `generics.notGeneric`
- **Approach**: Update PHPDoc to match Laravel conventions

#### 3.2 Factory Corrections (P2)
- **Files**: All factory files
- **Errors**: `Property not found on Faker\Generator`
- **Approach**: Use correct Faker methods or add PHPStan ignores

### Phase 4: Code Quality Improvements (Days 4-5)
Final cleanup and optimization.

#### 4.1 Static Access Fixes (P3)
- **Files**: Widget classes
- **Errors**: `Static access to instance property`
- **Approach**: Replace static access with instance access

#### 4.2 Collection Optimization (P3)
- **Files**: Action classes
- **Errors**: `larastan.noUnnecessaryCollectionCall`
- **Approach**: Optimize collection calls for performance

---

## 🛠️ Implementation Patterns

### Pattern 1: Action Class with Type Safety
```php
// ✅ CORRECTED
class ExampleAction
{
    public function execute(string $surveyId): Model
    {
        // Add assertions for type safety
        Assert::string($surveyId);
        
        $model = $this->getModel($surveyId);
        Assert::isInstanceOf($model, Model::class);
        
        return $model;
    }
    
    /** @return Model */
    private function getModel(string $surveyId): Model
    {
        // Implementation with proper typing
        return SomeModel::find($surveyId);
    }
}
```

### Pattern 2: Widget with Proper Type Declarations
```php
// ✅ CORRECTED
class TypeF extends Widget
{
    protected string $surveyId;      // Instead of public $surveyId;
    protected string $fieldName; 
    protected int $questionId;
    protected string $title;
    
    public function getChartWidgets(): array
    {
        // Ensure all elements have proper types
        $globalStats = $this->getTotalAndAverage(); 
        
        // Add type assertion for mixed data
        Assert::keyExists($globalStats, 'total');
        Assert::keyExists($globalStats, 'average');
        
        $total = $globalStats['total'] ?? 0;
        $average = $globalStats['average'] ?? 0;
        
        // Return properly typed array
        /** @var array<int, array<string, mixed>> */
        return [
            // ... widget configuration
        ];
    }
}
```

### Pattern 3: Filament Resource with Typed Schema
```php
// ✅ CORRECTED
class SurveyFlipResponseResource extends XotBaseResource
{
    public static function getFormSchema(): array
    {
        // Use string keys for proper typing
        return [
            'created_at' => DateTimePicker::make('created_at'),
            'field' => TextInput::make('field'),
        ];
    }
}
```

### Pattern 4: Safe Mixed Type Handling
```php
// ✅ CORRECTED
class SomeAction
{
    public function processMixedData(mixed $data): string
    {
        // Add type checking before operations
        if (!is_string($data) && !is_numeric($data)) {
            throw new InvalidArgumentException('Data must be string or numeric');
        }
        
        return trim((string) $data);
    }
}
```

---

## 🧠 Critical Analysis & Self-Debate

### Issue: Multiple existing roadmaps exist
**Concern**: Are we duplicating effort with existing roadmaps?
**Resolution**: This master roadmap consolidates and extends existing work, providing a single cohesive plan.

### Issue: Complex mixed type handling
**Concern**: How do we handle complex cases where data types are truly dynamic?
**Resolution**: Use `webmozarts/assert` for validation and `/** @var */` annotations where needed, following Laraxot patterns.

### Issue: Performance vs Type Safety balance
**Concern**: Adding too many type checks might impact performance
**Resolution**: Focus on type safety in critical paths, use PHPDoc for documentation where runtime checks aren't needed.

### Issue: Integration with dynamic LimeSurvey tables
**Concern**: How do we type safety dynamic table access?
**Resolution**: Use SafeCast actions and proper PHPDoc for dynamic queries while maintaining type safety.

---

## 📋 Detailed Implementation Plan

### Week 1: Critical Fixes (Days 1-5)

#### Day 1: Action Classes (P0)
- [ ] `GetParticipantModelBySurveyIdAction.php` - Verify return type
- [ ] `PopulateSurveyFlipBySurveyIdAction.php` - Fix mixed type handling
- [ ] All other action classes with return type issues

#### Day 2: Widget Properties (P1) 
- [ ] Add type declarations to all widget properties
- [ ] Fix static access to instance properties
- [ ] Address mixed type access in widget methods

#### Day 3: Filament Resources (P1)
- [ ] Convert indexed arrays to associative arrays in form schemas
- [ ] Add proper return types to all resource methods
- [ ] Fix header/footer action return types

#### Day 4: Model Integration (P2)
- [ ] Update PHPDoc for model relationships
- [ ] Fix dynamic table access patterns
- [ ] Address model caching generics issues

#### Day 5: Chart Widgets (P2)
- [ ] Research and fix Flowframe\Trend integration
- [ ] Add proper type handling for chart data
- [ ] Optimize data access patterns

### Week 2: Advanced Fixes (Days 6-10)

#### Day 6: Factory Classes (P2)
- [ ] Update Faker property access
- [ ] Add proper return types to factory methods
- [ ] Address baseline/ignore patterns

#### Day 7: Cast Classes (P1)
- [ ] Add proper return types to cast methods
- [ ] Fix mixed type handling in cast operations
- [ ] Update PHPDoc for cast methods

#### Day 8: Complex Widget Patterns (P2)
- [ ] Address TypeF with complex aggregation
- [ ] Fix MatrixChart offset access issues
- [ ] Resolve RankingChart method call issues

#### Day 9: Collection Optimization (P3)
- [ ] Optimize unnecessary collection calls
- [ ] Use query builder where appropriate
- [ ] Performance validation

#### Day 10: Integration Testing (P0)
- [ ] Validate all fixes maintain functionality
- [ ] Run complete PHPStan analysis
- [ ] Address remaining errors

---

## 🔧 Laraxot-Specific Patterns

### Safe Cast Actions Usage
```php
// ✅ Use Laraxot safe cast pattern
use Modules\Xot\Actions\Cast\SafeStringCastAction;
use Modules\Xot\Actions\Cast\SafeArrayCastAction;

class SomeAction
{
    public function execute(mixed $data): string
    {
        return app(SafeStringCastAction::class)->execute($data);
    }
}
```

### Model Base Pattern
```php
// ✅ Use module-specific BaseModel
use Modules\Limesurvey\Models\BaseModel;

class SurveyResponse extends BaseModel
{
    // Follow module-specific patterns
}
```

### Webmozarts Assert Pattern
```php
// ✅ Use webmozarts/assert for type safety
use Webmozart\Assert\Assert;

class SomeAction
{
    public function execute(mixed $data): void
    {
        Assert::string($data, 'Expected string, got: %s');
        // Implementation with type safety
    }
}
```

---

## 🧪 Testing Strategy

### Before Each Commit:
1. Run: `./vendor/bin/phpstan analyse Modules/Limesurvey --level=max`
2. Verify: All critical errors are resolved
3. Test: Functionality remains intact
4. Document: Changes in module docs

### After Each Phase:
1. Run: `./vendor/bin/phpmd Modules/Limesurvey text phpmd.ruleset.xml`
2. Run: `./vendor/bin/phpinsights analyse Modules/Limesurvey`
3. Verify: No new issues introduced
4. Update: Documentation and roadmaps

---

## 🎯 Success Criteria

### Primary Goals:
- [ ] PHPStan Level 10 compliance (0 errors) for Limesurvey module
- [ ] All existing functionality preserved
- [ ] Type safety implemented following Laraxot patterns
- [ ] Performance not negatively impacted

### Secondary Goals:
- [ ] Comprehensive documentation updated
- [ ] Consistent patterns across all files
- [ ] Reusable patterns documented for other modules
- [ ] Clean, maintainable codebase

---

## 🚧 Risk Mitigation

### Risk: Breaking existing functionality
**Mitigation**: Test functionality after each change, maintain backward compatibility

### Risk: Performance degradation
**Mitigation**: Profile performance-critical paths, optimize where needed

### Risk: Integration failures
**Mitigation**: Test with real LimeSurvey data, validate API integration

---

## 📈 Progress Tracking

### Weekly Reviews:
- Count remaining PHPStan errors
- Validate functionality
- Update roadmap based on findings
- Document successful patterns

### Final Validation:
- Complete PHPStan analysis pass
- Full functionality test
- Performance validation
- Documentation completeness

---

**Created**: 2026-01-14  
**Last Updated**: 2026-01-14  
**Status**: 🚀 **IN PROGRESS**  
**Next Review**: Daily progress check