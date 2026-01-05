<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use GeneaLabs\LaravelModelCaching\CachedBuilder;
use Illuminate\Database\Eloquent\Model;
use Modules\Quaeris\Datas\AnswersFilterData;
use Modules\Quaeris\Models\Profile;

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
 * @property-read Profile|null $creator
 * @property-read Extra|null $extra
 * @property-read Profile|null $updater
 *
 * @method static CachedBuilder|LimePlugin all($columns = [])
 * @method static CachedBuilder|LimePlugin avg($column)
 * @method static CachedBuilder|LimePlugin cache(array $tags = [])
 * @method static CachedBuilder|LimePlugin cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder|LimePlugin count($columns = '*')
 * @method static CachedBuilder|LimePlugin disableCache()
 * @method static CachedBuilder|LimePlugin disableModelCaching()
 * @method static CachedBuilder|LimePlugin exists()
 * @method static CachedBuilder|LimePlugin flushCache(array $tags = [])
 * @method static CachedBuilder|LimePlugin getModelCacheCooldown(Model $instance)
 * @method static CachedBuilder|LimePlugin inRandomOrder($seed = '')
 * @method static CachedBuilder|LimePlugin insert(array $values)
 * @method static CachedBuilder|LimePlugin isCachable()
 * @method static CachedBuilder|LimePlugin max($column)
 * @method static CachedBuilder|LimePlugin min($column)
 * @method static CachedBuilder|LimePlugin newModelQuery()
 * @method static CachedBuilder|LimePlugin newQuery()
 * @method static CachedBuilder|LimePlugin ofFilterData(AnswersFilterData $answersFilterData)
 * @method static CachedBuilder|LimePlugin query()
 * @method static CachedBuilder|LimePlugin sum($column)
 * @method static CachedBuilder|LimePlugin truncate()
 * @method static CachedBuilder|LimePlugin whereActive($value)
 * @method static CachedBuilder|LimePlugin whereId($value)
 * @method static CachedBuilder|LimePlugin whereLoadError($value)
 * @method static CachedBuilder|LimePlugin whereLoadErrorMessage($value)
 * @method static CachedBuilder|LimePlugin whereName($value)
 * @method static CachedBuilder|LimePlugin wherePluginType($value)
 * @method static CachedBuilder|LimePlugin wherePriority($value)
 * @method static CachedBuilder|LimePlugin whereVersion($value)
 * @method static CachedBuilder|LimePlugin withCacheCooldownSeconds(?int $seconds = null)
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

    /** @var list<string> */
    protected $fillable = [
        'name', 'active', 'version',
    ];

    /** @var list<string> */
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
