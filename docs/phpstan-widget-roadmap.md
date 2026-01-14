# PHPStan Level 10 Roadmap - Limesurvey Widget Classes

**Date**: 2026-01-14  
**Module**: Limesurvey  
**Target**: Widget Classes (`Modules/Limesurvey/app/Filament/Widgets/*`)  
**PHPStan Level**: 10 (max)  
**Status**: 🚀 **IN PROGRESS**

---

## 📊 Current Error Summary

### Files with Issues (15+ files):
- `TypeF.php` - 25+ errors (property types, mixed access, method calls)
- `TypeExclamationPoint.php` - 20+ errors (static access, parameters, mixed)
- `RankingChart.php` - 15+ errors (Flowframe\Trend, mixed access)
- `SingleChoiceChart.php` - 12+ errors (Flowframe\Trend, mixed access)
- `TypeB.php` - 12+ errors (Flowframe\Trend, mixed access)
- `TypeL.php` - 15+ errors (static access, mixed access)
- `TypeM.php` - 8+ errors (static access, Flowframe\Trend)
- `TypeN.php` - 12+ errors (parameters, Flowframe\Trend)
- `TypeS.php` - 12+ errors (static access, parameters)
- `TypeT.php` - 18+ errors (property types, mixed access)
- `TypeX.php` - 18+ errors (property types, mixed access)
- `TypeY.php` - 18+ errors (property types, mixed access)
- `MatrixChart.php` - 5+ errors (offset access, string casting)
- `ChartItemWidget.php` - 1 error (return type)

### Total Estimated Errors: ~200+

---

## 🎯 Resolution Strategy by Type

### Type 1: Property Type Declarations (P0 - Critical)
**Files**: All Type* widgets, ChartItemWidget
**Issue**: Properties without type declarations
**Pattern**:
```php
// ❌ BEFORE
public $surveyId;
public $fieldName; 
public $questionId;

// ✅ AFTER  
private string $surveyId;
private string $fieldName;
private int $questionId;
```

### Type 2: Mixed Type Access (P0 - Critical)
**Files**: All chart widgets (TypeF, RankingChart, etc.)
**Issue**: Accessing methods/properties on mixed types
**Pattern**:
```php
// ❌ BEFORE
$stats = $this->getStats();
$total = $stats['total'];  // mixed access

// ✅ AFTER
$stats = $this->getStats();
Assert::isArray($stats);
Assert::keyExists($stats, 'total');
/** @var mixed $totalValue */
$totalValue = $stats['total'];
$total = (int) $totalValue;
```

### Type 3: Static vs Instance Access (P1 - Important)
**Files**: TypeExclamationPoint, TypeL, TypeM, TypeN, TypeS
**Issue**: Static access to instance properties
**Pattern**:
```php
// ❌ BEFORE
static::$heading = 'Title';

// ✅ AFTER
$this->heading = 'Title';
```

### Type 4: Flowframe\Trend Integration (P1 - Important)
**Files**: RankingChart, SingleChoiceChart, TypeB, TypeExclamationPoint, TypeL, TypeM, TypeN, TypeS, TypeT, TypeX, TypeY
**Issue**: `Call to undefined method Flowframe\Trend\Trend::groupBy()`
**Approach**: Research correct API usage or refactor to use Laravel query builder

### Type 5: Return Type Corrections (P2 - Standard)
**Files**: ChartItemWidget, others
**Issue**: Incorrect return types in getData() methods
**Pattern**:
```php
// ❌ BEFORE
public function getData() {
    return $data;
}

// ✅ AFTER
/** @return array<string, mixed> */
public function getData(): array {
    return $data;
}
```

---

## 📋 Detailed Fix Plan

### Phase 1: Property Type Declarations (Days 1-2)

#### File: `TypeF.php`
- [ ] Add type declarations to all properties
- [ ] Fix `baseSurveyQuery()` return type
- [ ] Fix `getTotalAndAverage()` return type and parameter types
- [ ] Fix `getAggregateStats()` parameter types

#### File: `TypeExclamationPoint.php`
- [ ] Add type declarations to all properties
- [ ] Fix static access to instance properties
- [ ] Fix mixed type parameter issues
- [ ] Address Flowframe\Trend integration

#### File: `RankingChart.php`
- [ ] Add type declarations to all properties
- [ ] Fix Flowframe\Trend `groupBy()` method calls
- [ ] Address mixed type method calls

#### File: `SingleChoiceChart.php`
- [ ] Add type declarations to all properties
- [ ] Fix Flowframe\Trend `groupBy()` method calls
- [ ] Address mixed type method calls

#### File: `TypeB.php`
- [ ] Add type declarations to all properties
- [ ] Fix Flowframe\Trend `groupBy()` method calls
- [ ] Address mixed type method calls

#### File: `TypeL.php`
- [ ] Add type declarations to all properties
- [ ] Fix static access to instance properties
- [ ] Address mixed type method calls

#### File: `TypeM.php`
- [ ] Add type declarations to all properties
- [ ] Fix static access to instance properties
- [ ] Address mixed type method calls

#### File: `TypeN.php`
- [ ] Add type declarations to all properties
- [ ] Address mixed type method calls

#### File: `TypeS.php`
- [ ] Add type declarations to all properties
- [ ] Fix static access to instance properties
- [ ] Address mixed type method calls

#### File: `TypeT.php`
- [ ] Add type declarations to all properties
- [ ] Fix mixed type parameter issues

#### File: `TypeX.php`
- [ ] Add type declarations to all properties
- [ ] Fix mixed type parameter issues

#### File: `TypeY.php`
- [ ] Add type declarations to all properties
- [ ] Fix mixed type parameter issues

#### File: `MatrixChart.php`
- [ ] Add type declarations to all properties
- [ ] Fix mixed type offset access

#### File: `ChartItemWidget.php`
- [ ] Fix `getData()` return type

### Phase 2: Mixed Type Resolution (Days 2-3)

#### Address Common Mixed Type Patterns:
- [ ] SurveyResponse data access patterns
- [ ] Chart data aggregation patterns
- [ ] Parameter validation patterns
- [ ] Method call validation patterns

### Phase 3: Flowframe\Trend Research (Days 3-4)

#### Research and Implement Correct Patterns:
- [ ] Research Flowframe\Trend API documentation
- [ ] Find correct method names for aggregation
- [ ] Implement alternative approaches if needed
- [ ] Test with real data to validate

---

## 🔧 Implementation Patterns

### Pattern 1: Safe Mixed Type Access
```php
class TypeF extends Widget
{
    private string $surveyId;
    private string $fieldName;
    private int $questionId;
    private string $title;

    public function getChartWidgets(): array
    {
        static::$heading = strip_tags($this->title);

        // Safe access to mixed data with assertions
        $globalStats = $this->getTotalAndAverage();
        Assert::isArray($globalStats);
        Assert::keyExists($globalStats, 'total');
        Assert::keyExists($globalStats, 'average');

        $total = $globalStats['total'] ?? 0;
        $average = $globalStats['average'] ?? 0;

        return [
            // Widget configuration with proper typing
        ];
    }

    /** @return array{total: int, average: float} */
    protected function getTotalAndAverage(): array
    {
        $result = $this->baseSurveyQuery()
            ->selectRaw('...')
            ->first();

        Assert::isInstanceOf($result, \stdClass::class);
        
        return [
            'total' => $result->total ?? 0,
            'average' => $result->overall_average ?? 0.0,
        ];
    }
}
```

### Pattern 2: Flowframe\Trend Alternative
```php
class RankingChart extends Widget
{
    // Instead of Trend::groupBy(), use Laravel query builder
    protected function getChartData(int $qid): array
    {
        $query = SurveyResponse::withAnswersLabel($qid)
            ->selectRaw('answer, COUNT(*) as count')
            ->groupBy('answer')
            ->orderBy('count', 'desc')
            ->get();

        Assert::isInstanceOf($query, \Illuminate\Support\Collection::class);

        return $query->toArray();
    }
}
```

### Pattern 3: Property Type Safety
```php
class TypeExclamationPoint extends Widget
{
    private string $surveyId;
    private string $fieldName;
    private int $questionId;
    private string $title;
    private string $heading = '';

    public function mount(): void
    {
        $this->heading = strip_tags($this->title);
    }
}
```

---

## 🧠 Self-Analysis & Risk Assessment

### Risk 1: Flowframe\Trend API Changes
**Concern**: The Trend API might have changed or the method names are different
**Mitigation**: Research current documentation, test with alternatives, use Laravel query builder as fallback

### Risk 2: Complex Mixed Type Scenarios
**Concern**: Some data access patterns might be genuinely dynamic
**Mitigation**: Use safe cast actions and proper assertions, document complex patterns

### Risk 3: Performance Impact
**Concern**: Adding too many type checks might slow down chart rendering
**Mitigation**: Use caching where appropriate, optimize critical paths, profile performance

---

## 🧪 Validation Strategy

### After Each File Fix:
1. Run: `./vendor/bin/phpstan analyse Modules/Limesurvey/app/Filament/Widgets/FileName.php --level=10`
2. Verify: No PHPStan errors for the specific file
3. Test: Widget functionality remains intact
4. Document: Changes made

### After Each Phase:
1. Run: `./vendor/bin/phpstan analyse Modules/Limesurvey/app/Filament/Widgets --level=10`
2. Verify: Error count reduced
3. Run: `./vendor/bin/phpmd Modules/Limesurvey/app/Filament/Widgets text phpmd.ruleset.xml`
4. Update: Documentation

---

## 📈 Success Metrics

### Primary:
- [ ] 0 PHPStan errors in widget classes
- [ ] All widget functionality preserved
- [ ] Type safety implemented consistently

### Secondary:
- [ ] Performance maintained or improved
- [ ] Code readability enhanced
- [ ] Patterns documented for reuse

---

**Created**: 2026-01-14  
**Last Updated**: 2026-01-14  
**Status**: 🚀 **IN PROGRESS**  
**Next Action**: Begin Phase 1 with TypeF.php