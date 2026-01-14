# Technical Decisions & Architectural Choices

> **Module**: Limesurvey
> **Date**: 2026-01-14
> **Status**: Living Document

This document records key technical decisions, "tricks," and architectural patterns used to solve specific challenges in the Limesurvey module, particularly for ensuring type safety and PHPStan compliance.

## 1. `CachedBuilder` Generics Stub
**Problem**: The package `genealabs/laravel-model-caching` uses a `CachedBuilder` class that does not natively support generics. This caused ~6600 PHPStan errors because methods like `all()`, `where()`, etc., were returning untyped `mixed` or `CachedBuilder` instances that PHPStan couldn't link back to the specific Model (e.g., `LimeAnswer`).

**Solution**:
We created a "Stub" file at `laravel/stubs/CachedBuilder.stub` that redefines the `CachedBuilder` class with generic template support:

```php
/**
 * @template TModelClass of Model
 * @extends EloquentBuilder<TModelClass>
 */
class CachedBuilder extends EloquentBuilder
{
}
```

**Implementation**:
1. Defined the stub in `laravel/stubs/CachedBuilder.stub`.
2. Registered the stub in `phpstan.neon` under `stubFiles`.

**Impact**:
Instantly resolved ~6600 errors by telling PHPStan that `CachedBuilder` behaves like a generic `EloquentBuilder`, preserving model types in method chains.

---

## 2. Dynamic `LimeSurveyXXXContract` Properties
**Problem**: Limesurvey uses dynamic tables (e.g., `lime_survey_12345`) and models (e.g., `LimeSurvey12345`). We use a Contract `LimeSurveyXXXContract` to type-hint these models, but PHPStan flagged standard properties (like `$id`, `$token`, `$submitdate`) as "undefined" because they aren't statically defined on the interface.

**Solution**:
We applied `@mixin \Illuminate\Database\Eloquent\Model` and comprehensive `@property` annotations directly to the `LimeSurveyXXXContract` interface.

```php
/**
 * @property int $id
 * @property string $token
 * @property string|null $submitdate
 * ...
 * @mixin \Illuminate\Database\Eloquent\Model
 */
interface LimeSurveyXXXContract
{
    // ...
}
```

**Impact**:
Resolved ~3000 errors. PHPStan now understands that any object implementing this contract has these standard properties and methods derived from Eloquent.

---

## 3. `TrendX` Service Type Safety
**Problem**: The `TrendX` service (extending `Flowframe\Trend\Trend`) had methods like `perMonth()`, `between()`, etc., that were typed as returning `Collection`. However, in the builder chain, these methods actually return `$this` (the Builder instance) until `aggregate()` is called. This caused errors when chaining methods.

**Solution**:
We updated the PHPDoc for `TrendX` to correctly reflect the return types:

```php
/**
 * @method static self query(\Illuminate\Database\Eloquent\Builder $builder)
 * @method self perMonth()
 * @method self perYear()
 * @method self between(mixed $start, mixed $end)
 * @method Collection count(?string $column = null) // Terminal operation returns Collection
 */
class TrendX extends Trend
```

**Impact**:
Resolved ~60 "Call to undefined method" errors in Widgets where `TrendX` is heavily used.
