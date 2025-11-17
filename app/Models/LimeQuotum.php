<?php

declare(strict_types=1);

/**
 * Created by Reliese Model.
 */

namespace Modules\Limesurvey\Models;

use GeneaLabs\LaravelModelCaching\CachedBuilder;

/**
 * Modules\Limesurvey\Models\LimeQuotum
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
 * @method static CachedBuilder<static>|LimeQuotum all($columns = [])
 * @method static CachedBuilder<static>|LimeQuotum avg($column)
 * @method static CachedBuilder<static>|LimeQuotum cache(array $tags = [])
 * @method static CachedBuilder<static>|LimeQuotum cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder<static>|LimeQuotum count($columns = '*')
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeQuotum disableCache()
 * @method static CachedBuilder<static>|LimeQuotum disableModelCaching()
 * @method static CachedBuilder<static>|LimeQuotum exists()
 * @method static CachedBuilder<static>|LimeQuotum flushCache(array $tags = [])
 * @method static CachedBuilder<static>|LimeQuotum getModelCacheCooldown(\Illuminate\Database\Eloquent\Model $instance)
 * @method static CachedBuilder<static>|LimeQuotum inRandomOrder($seed = '')
 * @method static CachedBuilder<static>|LimeQuotum insert(array $values)
 * @method static CachedBuilder<static>|LimeQuotum isCachable()
 * @method static CachedBuilder<static>|LimeQuotum max($column)
 * @method static CachedBuilder<static>|LimeQuotum min($column)
 * @method static CachedBuilder<static>|LimeQuotum newModelQuery()
 * @method static CachedBuilder<static>|LimeQuotum newQuery()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeQuotum ofFilterData(\Modules\Quaeris\Datas\AnswersFilterData $answersFilterData)
 * @method static CachedBuilder<static>|LimeQuotum query()
 * @method static CachedBuilder<static>|LimeQuotum sum($column)
 * @method static CachedBuilder<static>|LimeQuotum truncate()
 * @method static CachedBuilder<static>|LimeQuotum whereAction($value)
 * @method static CachedBuilder<static>|LimeQuotum whereActive($value)
 * @method static CachedBuilder<static>|LimeQuotum whereAutoloadUrl($value)
 * @method static CachedBuilder<static>|LimeQuotum whereId($value)
 * @method static CachedBuilder<static>|LimeQuotum whereName($value)
 * @method static CachedBuilder<static>|LimeQuotum whereQlimit($value)
 * @method static CachedBuilder<static>|LimeQuotum whereSid($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeQuotum withCacheCooldownSeconds(?int $seconds = null)
 *
 * @mixin \Eloquent
 */
class LimeQuotum extends BaseModel
{
    public $timestamps = false;

    protected $table = 'lime_quota';

    protected $casts = [
        'sid' => 'int',
        'qlimit' => 'int',
        'action' => 'int',
        'active' => 'int',
        'autoload_url' => 'int',
    ];

    protected $fillable = [
        'sid',
        'name',
        'qlimit',
        'action',
        'active',
        'autoload_url',
    ];
}
