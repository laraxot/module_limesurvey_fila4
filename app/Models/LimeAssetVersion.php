<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use Modules\Quaeris\Models\Profile;
use Illuminate\Database\Eloquent\Model;
use Modules\Quaeris\Datas\AnswersFilterData;
use GeneaLabs\LaravelModelCaching\CachedBuilder;

/**
 * Modules\Limesurvey\Models\LimeAssetVersion
 *
 * @property int $id
 * @property string $path
 * @property int $version
 *
 * @property-read Profile|null $creator
 * @property-read Extra|null $extra
 * @property-read Profile|null $updater
 *
 * @method static CachedBuilder<static>|LimeAssetVersion all($columns = [])
 * @method static CachedBuilder<static>|LimeAssetVersion avg($column)
 * @method static CachedBuilder<static>|LimeAssetVersion cache(array $tags = [])
 * @method static CachedBuilder<static>|LimeAssetVersion cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder<static>|LimeAssetVersion count($columns = '*')
 * @method static CachedBuilder<static>|LimeAssetVersion disableCache()
 * @method static CachedBuilder<static>|LimeAssetVersion disableModelCaching()
 * @method static CachedBuilder<static>|LimeAssetVersion exists()
 * @method static CachedBuilder<static>|LimeAssetVersion flushCache(array $tags = [])
 * @method static CachedBuilder<static>|LimeAssetVersion getModelCacheCooldown(Model $instance)
 * @method static CachedBuilder<static>|LimeAssetVersion inRandomOrder($seed = '')
 * @method static CachedBuilder<static>|LimeAssetVersion insert(array $values)
 * @method static CachedBuilder<static>|LimeAssetVersion isCachable()
 * @method static CachedBuilder<static>|LimeAssetVersion max($column)
 * @method static CachedBuilder<static>|LimeAssetVersion min($column)
 * @method static CachedBuilder<static>|LimeAssetVersion newModelQuery()
 * @method static CachedBuilder<static>|LimeAssetVersion newQuery()
 * @method static CachedBuilder<static>|LimeAssetVersion ofFilterData(AnswersFilterData $answersFilterData)
 * @method static CachedBuilder<static>|LimeAssetVersion query()
 * @method static CachedBuilder<static>|LimeAssetVersion sum($column)
 * @method static CachedBuilder<static>|LimeAssetVersion truncate()
 * @method static CachedBuilder<static>|LimeAssetVersion whereId($value)
 * @method static CachedBuilder<static>|LimeAssetVersion wherePath($value)
 * @method static CachedBuilder<static>|LimeAssetVersion whereVersion($value)
 * @method static CachedBuilder<static>|LimeAssetVersion withCacheCooldownSeconds(?int $seconds = null)
 *
 * @mixin \Eloquent
 */
class LimeAssetVersion extends BaseModel
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_asset_version';

    /** @var string */
    protected $primaryKey = 'id';

    /** @var array<int, string> */
    protected $fillable = [
        'path', 'version',
    ];

    /** @var array<int, string> */
    protected $hidden = [
    ];

    /** @return array<string, string>     */
    protected $casts = [
        'id' => 'int', 'path' => 'string', 'version' => 'int',
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
