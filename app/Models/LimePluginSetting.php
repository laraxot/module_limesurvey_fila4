<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use GeneaLabs\LaravelModelCaching\CachedBuilder;

/**
 * Modules\Limesurvey\Models\LimePluginSetting
 *
 * @property int $id
 * @property int $plugin_id
 * @property string|null $model
 * @property int|null $model_id
 * @property string $key
 * @property string|null $value
 * @property-read \Modules\Quaeris\Models\Profile|null $creator
 * @property-read \Modules\Limesurvey\Models\Extra|null $extra
 * @property-read \Modules\Quaeris\Models\Profile|null $updater
 * @method static CachedBuilder<static>|LimePluginSetting all($columns = [])
 * @method static CachedBuilder<static>|LimePluginSetting avg($column)
 * @method static CachedBuilder<static>|LimePluginSetting cache(array $tags = [])
 * @method static CachedBuilder<static>|LimePluginSetting cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder<static>|LimePluginSetting count($columns = '*')
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimePluginSetting disableCache()
 * @method static CachedBuilder<static>|LimePluginSetting disableModelCaching()
 * @method static CachedBuilder<static>|LimePluginSetting exists()
 * @method static CachedBuilder<static>|LimePluginSetting flushCache(array $tags = [])
 * @method static CachedBuilder<static>|LimePluginSetting getModelCacheCooldown(\Illuminate\Database\Eloquent\Model $instance)
 * @method static CachedBuilder<static>|LimePluginSetting inRandomOrder($seed = '')
 * @method static CachedBuilder<static>|LimePluginSetting insert(array $values)
 * @method static CachedBuilder<static>|LimePluginSetting isCachable()
 * @method static CachedBuilder<static>|LimePluginSetting max($column)
 * @method static CachedBuilder<static>|LimePluginSetting min($column)
 * @method static CachedBuilder<static>|LimePluginSetting newModelQuery()
 * @method static CachedBuilder<static>|LimePluginSetting newQuery()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimePluginSetting ofFilterData(\Modules\Quaeris\Datas\AnswersFilterData $answersFilterData)
 * @method static CachedBuilder<static>|LimePluginSetting query()
 * @method static CachedBuilder<static>|LimePluginSetting sum($column)
 * @method static CachedBuilder<static>|LimePluginSetting truncate()
 * @method static CachedBuilder<static>|LimePluginSetting whereId($value)
 * @method static CachedBuilder<static>|LimePluginSetting whereKey($value)
 * @method static CachedBuilder<static>|LimePluginSetting whereModel($value)
 * @method static CachedBuilder<static>|LimePluginSetting whereModelId($value)
 * @method static CachedBuilder<static>|LimePluginSetting wherePluginId($value)
 * @method static CachedBuilder<static>|LimePluginSetting whereValue($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimePluginSetting withCacheCooldownSeconds(?int $seconds = null)
 * @mixin \Eloquent
 */
class LimePluginSetting extends BaseModel
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_plugin_settings';

    /** @var string */
    protected $primaryKey = 'id';

    /** @var array<int, string> */
    protected $fillable = [
        'plugin_id', 'model', 'model_id', 'key', 'value',
    ];

    /** @var array<int, string> */
    protected $hidden = [
    ];

    /** @return array<string, string>     */
    protected $casts = [
        'id' => 'int', 'plugin_id' => 'int', 'model' => 'string', 'model_id' => 'int', 'key' => 'string', 'value' => 'string',
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
