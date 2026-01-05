<?php

declare(strict_types=1);

/**
 * Created by Reliese Model.
 */

namespace Modules\Limesurvey\Models;

use GeneaLabs\LaravelModelCaching\CachedBuilder;
use Illuminate\Database\Eloquent\Model;
use Modules\Quaeris\Datas\AnswersFilterData;
use Modules\Quaeris\Models\Profile;

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
 *
 * @property-read Profile|null $creator
 * @property-read Extra|null $extra
 * @property-read Profile|null $updater
 *
 * @method static CachedBuilder|LimeQuotum all($columns = [])
 * @method static CachedBuilder|LimeQuotum avg($column)
 * @method static CachedBuilder|LimeQuotum cache(array $tags = [])
 * @method static CachedBuilder|LimeQuotum cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder|LimeQuotum count($columns = '*')
 * @method static CachedBuilder|LimeQuotum disableCache()
 * @method static CachedBuilder|LimeQuotum disableModelCaching()
 * @method static CachedBuilder|LimeQuotum exists()
 * @method static CachedBuilder|LimeQuotum flushCache(array $tags = [])
 * @method static CachedBuilder|LimeQuotum getModelCacheCooldown(Model $instance)
 * @method static CachedBuilder|LimeQuotum inRandomOrder($seed = '')
 * @method static CachedBuilder|LimeQuotum insert(array $values)
 * @method static CachedBuilder|LimeQuotum isCachable()
 * @method static CachedBuilder|LimeQuotum max($column)
 * @method static CachedBuilder|LimeQuotum min($column)
 * @method static CachedBuilder|LimeQuotum newModelQuery()
 * @method static CachedBuilder|LimeQuotum newQuery()
 * @method static CachedBuilder|LimeQuotum ofFilterData(AnswersFilterData $answersFilterData)
 * @method static CachedBuilder|LimeQuotum query()
 * @method static CachedBuilder|LimeQuotum sum($column)
 * @method static CachedBuilder|LimeQuotum truncate()
 * @method static CachedBuilder|LimeQuotum whereAction($value)
 * @method static CachedBuilder|LimeQuotum whereActive($value)
 * @method static CachedBuilder|LimeQuotum whereAutoloadUrl($value)
 * @method static CachedBuilder|LimeQuotum whereId($value)
 * @method static CachedBuilder|LimeQuotum whereName($value)
 * @method static CachedBuilder|LimeQuotum whereQlimit($value)
 * @method static CachedBuilder|LimeQuotum whereSid($value)
 * @method static CachedBuilder|LimeQuotum withCacheCooldownSeconds(?int $seconds = null)
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
