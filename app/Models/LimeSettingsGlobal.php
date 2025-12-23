<?php

declare(strict_types=1);

/**
 * Created by Reliese Model.
 */

namespace Modules\Limesurvey\Models;

use GeneaLabs\LaravelModelCaching\CachedBuilder;
use Illuminate\Database\Eloquent\Model;
use Modules\Limesurvey\Database\Factories\LimeSettingsGlobalFactory;
use Modules\Quaeris\Datas\AnswersFilterData;

/**
 * Modules\Limesurvey\Models\LimeSettingsGlobal
 *
 * @property-read \Modules\Quaeris\Models\Profile|null $creator
 * @property-read \Modules\Limesurvey\Models\Extra|null $extra
 * @property-read \Modules\Quaeris\Models\Profile|null $updater
 *
 * @method static CachedBuilder<static>|LimeSettingsGlobal all($columns = [])
 * @method static CachedBuilder<static>|LimeSettingsGlobal avg($column)
 * @method static CachedBuilder<static>|LimeSettingsGlobal cache(array $tags = [])
 * @method static CachedBuilder<static>|LimeSettingsGlobal cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder<static>|LimeSettingsGlobal count($columns = '*')
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSettingsGlobal disableCache()
 * @method static CachedBuilder<static>|LimeSettingsGlobal disableModelCaching()
 * @method static CachedBuilder<static>|LimeSettingsGlobal exists()
 * @method static CachedBuilder<static>|LimeSettingsGlobal flushCache(array $tags = [])
 * @method static CachedBuilder<static>|LimeSettingsGlobal getModelCacheCooldown(\Illuminate\Database\Eloquent\Model $instance)
 * @method static CachedBuilder<static>|LimeSettingsGlobal inRandomOrder($seed = '')
 * @method static CachedBuilder<static>|LimeSettingsGlobal insert(array $values)
 * @method static CachedBuilder<static>|LimeSettingsGlobal isCachable()
 * @method static CachedBuilder<static>|LimeSettingsGlobal max($column)
 * @method static CachedBuilder<static>|LimeSettingsGlobal min($column)
 * @method static CachedBuilder<static>|LimeSettingsGlobal newModelQuery()
 * @method static CachedBuilder<static>|LimeSettingsGlobal newQuery()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSettingsGlobal ofFilterData(\Modules\Quaeris\Datas\AnswersFilterData $answersFilterData)
 * @method static CachedBuilder<static>|LimeSettingsGlobal query()
 * @method static CachedBuilder<static>|LimeSettingsGlobal sum($column)
 * @method static CachedBuilder<static>|LimeSettingsGlobal truncate()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSettingsGlobal withCacheCooldownSeconds(?int $seconds = null)
 *
 * @mixin \Eloquent
 */
class LimeSettingsGlobal extends BaseModel
{
    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = ['stg_name', 'stg_value'];

    // protected string $table = 'lime_settings_global';
    protected $primaryKey = 'stg_name';
}
