<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

// use Laravel\Scout\Searchable;
use Modules\Xot\Contracts\HasRecursiveRelationshipsContract;
use Modules\Xot\Models\Traits\TypedHasRecursiveRelationships;

/**
 * Base Tree Model for Limesurvey module.
 *
 * Provides recursive relationships using TypedHasRecursiveRelationships trait
 * which wraps the vendor HasRecursiveRelationships with proper type hints.
 */
abstract class BaseTreeModel extends BaseModel implements HasRecursiveRelationshipsContract
{
    use TypedHasRecursiveRelationships;
}
