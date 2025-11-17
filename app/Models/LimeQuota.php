<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use GeneaLabs\LaravelModelCaching\CachedBuilder;

/**
 * Modules\Limesurvey\Models\LimeQuota
 *
 * @property int $id
 * @property int|null $sid
 * @property string|null $name
 * @property int|null $qlimit
 * @property int|null $action
 * @property int $active
 * @property int $autoload_url
 * @property-read \Modules\Quaeris\Models\Profile|null $creator
 * @property-read \Modules\Limesurvey\Models\Extra|null $extra
 * @property-read \Modules\Quaeris\Models\Profile|null $updater
 *
 * @method static CachedBuilder<static>|LimeQuota all($columns = [])
 * @method static CachedBuilder<static>|LimeQuota avg($column)
 * @method static CachedBuilder<static>|LimeQuota cache(array $tags = [])
 * @method static CachedBuilder<static>|LimeQuota cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder<static>|LimeQuota count($columns = '*')
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeQuota disableCache()
 * @method static CachedBuilder<static>|LimeQuota disableModelCaching()
 * @method static CachedBuilder<static>|LimeQuota exists()
 * @method static CachedBuilder<static>|LimeQuota flushCache(array $tags = [])
 * @method static CachedBuilder<static>|LimeQuota getModelCacheCooldown(\Illuminate\Database\Eloquent\Model $instance)
 * @method static CachedBuilder<static>|LimeQuota inRandomOrder($seed = '')
 * @method static CachedBuilder<static>|LimeQuota insert(array $values)
 * @method static CachedBuilder<static>|LimeQuota isCachable()
 * @method static CachedBuilder<static>|LimeQuota max($column)
 * @method static CachedBuilder<static>|LimeQuota min($column)
 * @method static CachedBuilder<static>|LimeQuota newModelQuery()
 * @method static CachedBuilder<static>|LimeQuota newQuery()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeQuota ofFilterData(\Modules\Quaeris\Datas\AnswersFilterData $answersFilterData)
 * @method static CachedBuilder<static>|LimeQuota query()
 * @method static CachedBuilder<static>|LimeQuota sum($column)
 * @method static CachedBuilder<static>|LimeQuota truncate()
 * @method static CachedBuilder<static>|LimeQuota whereAction($value)
 * @method static CachedBuilder<static>|LimeQuota whereActive($value)
 * @method static CachedBuilder<static>|LimeQuota whereAutoloadUrl($value)
 * @method static CachedBuilder<static>|LimeQuota whereId($value)
 * @method static CachedBuilder<static>|LimeQuota whereName($value)
 * @method static CachedBuilder<static>|LimeQuota whereQlimit($value)
 * @method static CachedBuilder<static>|LimeQuota whereSid($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeQuota withCacheCooldownSeconds(?int $seconds = null)
 *
 * @mixin \Eloquent
 */
class LimeQuota extends BaseModel
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_quota';

    /** @var string */
    protected $primaryKey = 'id';

    /** @var array<int, string> */
    protected $fillable = [
        'sid', 'name', 'qlimit', 'action', 'active', 'autoload_url',
    ];

    /** @var array<int, string> */
    protected $hidden = [
    ];

    /** @return array<string, string>     */
    protected $casts = [
        'id' => 'int', 'sid' => 'int', 'name' => 'string', 'qlimit' => 'int', 'action' => 'int', 'active' => 'int', 'autoload_url' => 'int',
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
