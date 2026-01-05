<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use GeneaLabs\LaravelModelCaching\CachedBuilder;
use Illuminate\Database\Eloquent\Model;
use Modules\Quaeris\Datas\AnswersFilterData;
use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeCondition
 *
 * @property int $cid
 * @property int $qid
 * @property int $cqid
 * @property string $cfieldname
 * @property string $method
 * @property string $value
 * @property int $scenario
 *
 * @property-read Profile|null $creator
 * @property-read Extra|null $extra
 * @property-read Profile|null $updater
 *
 * @method static CachedBuilder<static>|LimeCondition all($columns = [])
 * @method static CachedBuilder<static>|LimeCondition avg($column)
 * @method static CachedBuilder<static>|LimeCondition cache(array $tags = [])
 * @method static CachedBuilder<static>|LimeCondition cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder<static>|LimeCondition count($columns = '*')
 * @method static CachedBuilder<static>|LimeCondition disableCache()
 * @method static CachedBuilder<static>|LimeCondition disableModelCaching()
 * @method static CachedBuilder<static>|LimeCondition exists()
 * @method static CachedBuilder<static>|LimeCondition flushCache(array $tags = [])
 * @method static CachedBuilder<static>|LimeCondition getModelCacheCooldown(Model $instance)
 * @method static CachedBuilder<static>|LimeCondition inRandomOrder($seed = '')
 * @method static CachedBuilder<static>|LimeCondition insert(array $values)
 * @method static CachedBuilder<static>|LimeCondition isCachable()
 * @method static CachedBuilder<static>|LimeCondition max($column)
 * @method static CachedBuilder<static>|LimeCondition min($column)
 * @method static CachedBuilder<static>|LimeCondition newModelQuery()
 * @method static CachedBuilder<static>|LimeCondition newQuery()
 * @method static CachedBuilder<static>|LimeCondition ofFilterData(AnswersFilterData $answersFilterData)
 * @method static CachedBuilder<static>|LimeCondition query()
 * @method static CachedBuilder<static>|LimeCondition sum($column)
 * @method static CachedBuilder<static>|LimeCondition truncate()
 * @method static CachedBuilder<static>|LimeCondition whereCfieldname($value)
 * @method static CachedBuilder<static>|LimeCondition whereCid($value)
 * @method static CachedBuilder<static>|LimeCondition whereCqid($value)
 * @method static CachedBuilder<static>|LimeCondition whereMethod($value)
 * @method static CachedBuilder<static>|LimeCondition whereQid($value)
 * @method static CachedBuilder<static>|LimeCondition whereScenario($value)
 * @method static CachedBuilder<static>|LimeCondition whereValue($value)
 * @method static CachedBuilder<static>|LimeCondition withCacheCooldownSeconds(?int $seconds = null)
 *
 * @mixin \Eloquent
 */
class LimeCondition extends BaseModel
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_conditions';

    /** @var string */
    protected $primaryKey = 'cid';

    /** @var array<int, string> */
    protected $fillable = [
        'qid', 'cqid', 'cfieldname', 'method', 'value', 'scenario',
    ];

    /** @var array<int, string> */
    protected $hidden = [
    ];

    /** @return array<string, string>     */
    protected $casts = [
        'cid' => 'int', 'qid' => 'int', 'cqid' => 'int', 'cfieldname' => 'string', 'method' => 'string', 'value' => 'string', 'scenario' => 'int',
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
