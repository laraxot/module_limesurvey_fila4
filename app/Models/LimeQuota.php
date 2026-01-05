<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use GeneaLabs\LaravelModelCaching\CachedBuilder;
use Illuminate\Database\Eloquent\Model;
use Modules\Quaeris\Datas\AnswersFilterData;
use Modules\Quaeris\Models\Profile;

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
 *
 * @property-read Profile|null $creator
 * @property-read Extra|null $extra
 * @property-read Profile|null $updater
 *
 * @method static CachedBuilder|LimeQuota all($columns = [])
 * @method static CachedBuilder|LimeQuota avg($column)
 * @method static CachedBuilder|LimeQuota cache(array $tags = [])
 * @method static CachedBuilder|LimeQuota cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder|LimeQuota count($columns = '*')
 * @method static CachedBuilder|LimeQuota disableCache()
 * @method static CachedBuilder|LimeQuota disableModelCaching()
 * @method static CachedBuilder|LimeQuota exists()
 * @method static CachedBuilder|LimeQuota flushCache(array $tags = [])
 * @method static CachedBuilder|LimeQuota getModelCacheCooldown(Model $instance)
 * @method static CachedBuilder|LimeQuota inRandomOrder($seed = '')
 * @method static CachedBuilder|LimeQuota insert(array $values)
 * @method static CachedBuilder|LimeQuota isCachable()
 * @method static CachedBuilder|LimeQuota max($column)
 * @method static CachedBuilder|LimeQuota min($column)
 * @method static CachedBuilder|LimeQuota newModelQuery()
 * @method static CachedBuilder|LimeQuota newQuery()
 * @method static CachedBuilder|LimeQuota ofFilterData(AnswersFilterData $answersFilterData)
 * @method static CachedBuilder|LimeQuota query()
 * @method static CachedBuilder|LimeQuota sum($column)
 * @method static CachedBuilder|LimeQuota truncate()
 * @method static CachedBuilder|LimeQuota whereAction($value)
 * @method static CachedBuilder|LimeQuota whereActive($value)
 * @method static CachedBuilder|LimeQuota whereAutoloadUrl($value)
 * @method static CachedBuilder|LimeQuota whereId($value)
 * @method static CachedBuilder|LimeQuota whereName($value)
 * @method static CachedBuilder|LimeQuota whereQlimit($value)
 * @method static CachedBuilder|LimeQuota whereSid($value)
 * @method static CachedBuilder|LimeQuota withCacheCooldownSeconds(?int $seconds = null)
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

    /** @var list<string> */
    protected $fillable = [
        'sid', 'name', 'qlimit', 'action', 'active', 'autoload_url',
    ];

    /** @var list<string> */
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
