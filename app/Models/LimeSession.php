<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use GeneaLabs\LaravelModelCaching\CachedBuilder;

/**
 * Modules\Limesurvey\Models\LimeSession
 *
 * @property string $id
 * @property int|null $expire
 * @property string|null $data
 *
 * @property-read \Modules\Quaeris\Models\Profile|null $creator
 * @property-read \Modules\Limesurvey\Models\Extra|null $extra
 * @property-read \Modules\Quaeris\Models\Profile|null $updater
 *
 * @method static CachedBuilder<static>|LimeSession all($columns = [])
 * @method static CachedBuilder<static>|LimeSession avg($column)
 * @method static CachedBuilder<static>|LimeSession cache(array $tags = [])
 * @method static CachedBuilder<static>|LimeSession cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder<static>|LimeSession count($columns = '*')
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSession disableCache()
 * @method static CachedBuilder<static>|LimeSession disableModelCaching()
 * @method static CachedBuilder<static>|LimeSession exists()
 * @method static CachedBuilder<static>|LimeSession flushCache(array $tags = [])
 * @method static CachedBuilder<static>|LimeSession getModelCacheCooldown(\Illuminate\Database\Eloquent\Model $instance)
 * @method static CachedBuilder<static>|LimeSession inRandomOrder($seed = '')
 * @method static CachedBuilder<static>|LimeSession insert(array $values)
 * @method static CachedBuilder<static>|LimeSession isCachable()
 * @method static CachedBuilder<static>|LimeSession max($column)
 * @method static CachedBuilder<static>|LimeSession min($column)
 * @method static CachedBuilder<static>|LimeSession newModelQuery()
 * @method static CachedBuilder<static>|LimeSession newQuery()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSession ofFilterData(\Modules\Quaeris\Datas\AnswersFilterData $answersFilterData)
 * @method static CachedBuilder<static>|LimeSession query()
 * @method static CachedBuilder<static>|LimeSession sum($column)
 * @method static CachedBuilder<static>|LimeSession truncate()
 * @method static CachedBuilder<static>|LimeSession whereData($value)
 * @method static CachedBuilder<static>|LimeSession whereExpire($value)
 * @method static CachedBuilder<static>|LimeSession whereId($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSession withCacheCooldownSeconds(?int $seconds = null)
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

    /** @var array<int, string> */
    protected $fillable = [
        'expire', 'data',
    ];

    /** @var array<int, string> */
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
