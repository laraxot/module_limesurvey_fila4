<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

// use Laravel\Scout\Searchable;
use Modules\Xot\Contracts\HasRecursiveRelationshipsContract;

/**
 * Base Tree Model for Limesurvey module.
 *
 * Provides recursive relationships using HasRecursiveRelationships trait
 * from staudenmeir/laravel-adjacency-list package.
 */
abstract class BaseTreeModel extends BaseModel implements HasRecursiveRelationshipsContract
{
    use \Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;
}
