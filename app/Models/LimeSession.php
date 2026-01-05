<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use GeneaLabs\LaravelModelCaching\CachedBuilder;
use Illuminate\Database\Eloquent\Model;
use Modules\Quaeris\Datas\AnswersFilterData;
use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeSession
 *
 * @property string $id
 * @property int|null $expire
 * @property string|null $data
 *
 * @property-read Profile|null $creator
 * @property-read Extra|null $extra
 * @property-read Profile|null $updater
 *
 * @method static CachedBuilder|LimeSession all($columns = [])
 * @method static CachedBuilder|LimeSession avg($column)
 * @method static CachedBuilder|LimeSession cache(array $tags = [])
 * @method static CachedBuilder|LimeSession cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder|LimeSession count($columns = '*')
 * @method static CachedBuilder|LimeSession disableCache()
 * @method static CachedBuilder|LimeSession disableModelCaching()
 * @method static CachedBuilder|LimeSession exists()
 * @method static CachedBuilder|LimeSession flushCache(array $tags = [])
 * @method static CachedBuilder|LimeSession getModelCacheCooldown(Model $instance)
 * @method static CachedBuilder|LimeSession inRandomOrder($seed = '')
 * @method static CachedBuilder|LimeSession insert(array $values)
 * @method static CachedBuilder|LimeSession isCachable()
 * @method static CachedBuilder|LimeSession max($column)
 * @method static CachedBuilder|LimeSession min($column)
 * @method static CachedBuilder|LimeSession newModelQuery()
 * @method static CachedBuilder|LimeSession newQuery()
 * @method static CachedBuilder|LimeSession ofFilterData(AnswersFilterData $answersFilterData)
 * @method static CachedBuilder|LimeSession query()
 * @method static CachedBuilder|LimeSession sum($column)
 * @method static CachedBuilder|LimeSession truncate()
 * @method static CachedBuilder|LimeSession whereData($value)
 * @method static CachedBuilder|LimeSession whereExpire($value)
 * @method static CachedBuilder|LimeSession whereId($value)
 * @method static CachedBuilder|LimeSession withCacheCooldownSeconds(?int $seconds = null)
 *
 * @mixin \Eloquent
 */
class LimeSession extends BaseModel
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_sessions';

    /** @var string */
    protected $primaryKey = 'id';

    /** @var list<string> */
    protected $fillable = [
        'expire', 'data',
    ];

    /** @var list<string> */
    protected $hidden = [
    ];

    /** @return array<string, string>     */
    protected $casts = [
        'id' => 'string', 'expire' => 'int',
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
