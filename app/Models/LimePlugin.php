<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use GeneaLabs\LaravelModelCaching\CachedBuilder;

/**
 * Modules\Limesurvey\Models\LimePlugin
 *
 * @property int $id
 * @property string $name
 * @property int $active
 * @property string|null $version
 * @property int|null $load_error
 * @property string|null $load_error_message
 * @property string|null $plugin_type
 * @property int $priority
 *
 * @property-read \Modules\Quaeris\Models\Profile|null $creator
 * @property-read \Modules\Limesurvey\Models\Extra|null $extra
 * @property-read \Modules\Quaeris\Models\Profile|null $updater
 *
 * @method static CachedBuilder<static>|LimePlugin all($columns = [])
 * @method static CachedBuilder<static>|LimePlugin avg($column)
 * @method static CachedBuilder<static>|LimePlugin cache(array $tags = [])
 * @method static CachedBuilder<static>|LimePlugin cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder<static>|LimePlugin count($columns = '*')
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimePlugin disableCache()
 * @method static CachedBuilder<static>|LimePlugin disableModelCaching()
 * @method static CachedBuilder<static>|LimePlugin exists()
 * @method static CachedBuilder<static>|LimePlugin flushCache(array $tags = [])
 * @method static CachedBuilder<static>|LimePlugin getModelCacheCooldown(\Illuminate\Database\Eloquent\Model $instance)
 * @method static CachedBuilder<static>|LimePlugin inRandomOrder($seed = '')
 * @method static CachedBuilder<static>|LimePlugin insert(array $values)
 * @method static CachedBuilder<static>|LimePlugin isCachable()
 * @method static CachedBuilder<static>|LimePlugin max($column)
 * @method static CachedBuilder<static>|LimePlugin min($column)
 * @method static CachedBuilder<static>|LimePlugin newModelQuery()
 * @method static CachedBuilder<static>|LimePlugin newQuery()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimePlugin ofFilterData(\Modules\Quaeris\Datas\AnswersFilterData $answersFilterData)
 * @method static CachedBuilder<static>|LimePlugin query()
 * @method static CachedBuilder<static>|LimePlugin sum($column)
 * @method static CachedBuilder<static>|LimePlugin truncate()
 * @method static CachedBuilder<static>|LimePlugin whereActive($value)
 * @method static CachedBuilder<static>|LimePlugin whereId($value)
 * @method static CachedBuilder<static>|LimePlugin whereLoadError($value)
 * @method static CachedBuilder<static>|LimePlugin whereLoadErrorMessage($value)
 * @method static CachedBuilder<static>|LimePlugin whereName($value)
 * @method static CachedBuilder<static>|LimePlugin wherePluginType($value)
 * @method static CachedBuilder<static>|LimePlugin wherePriority($value)
 * @method static CachedBuilder<static>|LimePlugin whereVersion($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimePlugin withCacheCooldownSeconds(?int $seconds = null)
 *
 * @mixin \Eloquent
 */
class LimePlugin extends BaseModel
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_plugins';

    /** @var string */
    protected $primaryKey = 'id';

    /** @var array<int, string> */
    protected $fillable = [
        'name', 'active', 'version',
    ];

    /** @var array<int, string> */
    protected $hidden = [
    ];

    /** @return array<string, string>     */
    protected $casts = [
        'id' => 'int', 'name' => 'string', 'active' => 'int', 'version' => 'string',
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
