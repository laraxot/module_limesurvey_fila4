<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use GeneaLabs\LaravelModelCaching\CachedBuilder;

/**
 * Modules\Limesurvey\Models\LimeExpressionError
 *
 * @property int $id
 * @property string|null $errortime
 * @property int|null $sid
 * @property int|null $gid
 * @property int|null $qid
 * @property int|null $gseq
 * @property int|null $qseq
 * @property string|null $type
 * @property string|null $eqn
 * @property string|null $prettyprint
 * @property-read \Modules\Quaeris\Models\Profile|null $creator
 * @property-read \Modules\Limesurvey\Models\Extra|null $extra
 * @property-read \Modules\Quaeris\Models\Profile|null $updater
 * @method static CachedBuilder<static>|LimeExpressionError all($columns = [])
 * @method static CachedBuilder<static>|LimeExpressionError avg($column)
 * @method static CachedBuilder<static>|LimeExpressionError cache(array $tags = [])
 * @method static CachedBuilder<static>|LimeExpressionError cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder<static>|LimeExpressionError count($columns = '*')
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeExpressionError disableCache()
 * @method static CachedBuilder<static>|LimeExpressionError disableModelCaching()
 * @method static CachedBuilder<static>|LimeExpressionError exists()
 * @method static CachedBuilder<static>|LimeExpressionError flushCache(array $tags = [])
 * @method static CachedBuilder<static>|LimeExpressionError getModelCacheCooldown(\Illuminate\Database\Eloquent\Model $instance)
 * @method static CachedBuilder<static>|LimeExpressionError inRandomOrder($seed = '')
 * @method static CachedBuilder<static>|LimeExpressionError insert(array $values)
 * @method static CachedBuilder<static>|LimeExpressionError isCachable()
 * @method static CachedBuilder<static>|LimeExpressionError max($column)
 * @method static CachedBuilder<static>|LimeExpressionError min($column)
 * @method static CachedBuilder<static>|LimeExpressionError newModelQuery()
 * @method static CachedBuilder<static>|LimeExpressionError newQuery()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeExpressionError ofFilterData(\Modules\Quaeris\Datas\AnswersFilterData $answersFilterData)
 * @method static CachedBuilder<static>|LimeExpressionError query()
 * @method static CachedBuilder<static>|LimeExpressionError sum($column)
 * @method static CachedBuilder<static>|LimeExpressionError truncate()
 * @method static CachedBuilder<static>|LimeExpressionError whereEqn($value)
 * @method static CachedBuilder<static>|LimeExpressionError whereErrortime($value)
 * @method static CachedBuilder<static>|LimeExpressionError whereGid($value)
 * @method static CachedBuilder<static>|LimeExpressionError whereGseq($value)
 * @method static CachedBuilder<static>|LimeExpressionError whereId($value)
 * @method static CachedBuilder<static>|LimeExpressionError wherePrettyprint($value)
 * @method static CachedBuilder<static>|LimeExpressionError whereQid($value)
 * @method static CachedBuilder<static>|LimeExpressionError whereQseq($value)
 * @method static CachedBuilder<static>|LimeExpressionError whereSid($value)
 * @method static CachedBuilder<static>|LimeExpressionError whereType($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeExpressionError withCacheCooldownSeconds(?int $seconds = null)
 * @mixin \Eloquent
 */
class LimeExpressionError extends BaseModel
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_expression_errors';

    /** @var string */
    protected $primaryKey = 'id';

    /** @var array<int, string> */
    protected $fillable = [
        'errortime', 'sid', 'gid', 'qid', 'gseq', 'qseq', 'type', 'eqn', 'prettyprint',
    ];

    /** @var array<int, string> */
    protected $hidden = [
    ];

    /** @return array<string, string>     */
    protected $casts = [
        'id' => 'int', 'errortime' => 'string', 'sid' => 'int', 'gid' => 'int', 'qid' => 'int', 'gseq' => 'int', 'qseq' => 'int', 'type' => 'string', 'eqn' => 'string', 'prettyprint' => 'string',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array<string>
     */
    protected $dates = [
    ];

    // Scopes...

    // Functions ...

    // Relations ...
}
