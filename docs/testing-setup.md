# Limesurvey Module Testing

## Overview

This document describes the testing implementation for the Limesurvey module, which integrates with external LimeSurvey systems and provides survey management capabilities.

## Test Structure

The Limesurvey module follows the standard testing structure:

- `tests/Unit/` - Unit tests for individual classes and methods
- `tests/Feature/` - Feature tests for broader functionality
- `tests/Integration/` - Integration tests (if needed)
- `tests/TestCase.php` - Module-specific test case configuration

## Module-specific TestCase

The Limesurvey module includes a dedicated TestCase at `Modules/Limesurvey/tests/TestCase.php` that:

- Extends the base Laravel TestCase
- Uses the `CreatesApplication` trait from Xot module
- Uses `DatabaseTransactions` for database testing
- Registers the LimesurveyServiceProvider for proper module loading

## PestPHP Implementation

All tests in the Limesurvey module use PestPHP syntax following these patterns:

### Unit Tests
```php
<?php

use Modules\Limesurvey\Tests\TestCase;

uses(TestCase::class)->group('limesurvey', 'unit');

it('has Limesurvey models that can be instantiated', function () {
    $limeSurvey = new LimeSurvey();
    expect($limeSurvey)->toBeInstanceOf(LimeSurvey::class);
});
```

### Feature Tests
```php
<?php

use Modules\Limesurvey\Tests\TestCase;

uses(TestCase::class)->group('limesurvey', 'feature');

it('can create and manipulate Limesurvey model instances', function () {
    $limeSurvey = new LimeSurvey();
    
    expect($limeSurvey)->toBeInstanceOf(LimeSurvey::class)
        ->and($limeSurvey)->toHaveProperty('table');
});
```

## Test Coverage

Current test coverage includes:
- Basic model instantiation tests
- Model property verification
- Module service provider registration
- Database transaction handling

## Running Module Tests

To run all Limesurvey module tests:
```bash
./vendor/bin/pest Modules/Limesurvey/tests/
```

To run specific test types:
```bash
./vendor/bin/pest Modules/Limesurvey/tests/Unit/
./vendor/bin/pest Modules/Limesurvey/tests/Feature/
```

## Dependencies

The Limesurvey module tests may depend on:
- External LimeSurvey system (for integration tests)
- Proper database configuration in `.env.testing`
- Module migrations being run before tests
- Required PHP extensions for survey functionality

## Configuration

Tests respect the `.env.testing` configuration and should not override it. The module testing follows the project-wide philosophy of trusting the testing environment configuration.