<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

// use Laravel\Scout\Searchable;
use Modules\Xot\Contracts\HasRecursiveRelationshipsContract;
<<<<<<< HEAD
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;
=======
>>>>>>> 85a48bc (.)

/**
 * Base Tree Model for Limesurvey module.
 *
 * Provides recursive relationships using HasRecursiveRelationships trait
 * from staudenmeir/laravel-adjacency-list package.
 */
abstract class BaseTreeModel extends BaseModel implements HasRecursiveRelationshipsContract
{
<<<<<<< HEAD
    use HasRecursiveRelationships;
=======
    use \Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;
>>>>>>> 85a48bc (.)
}
