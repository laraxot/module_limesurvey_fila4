<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use GeneaLabs\LaravelModelCaching\CachedBuilder;
use Illuminate\Database\Eloquent\Model;
use Modules\Quaeris\Datas\AnswersFilterData;
use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeMapTutorialUser
 *
 * @property int $tid
 * @property int $uid
 * @property int|null $taken
 *
 * @property-read Profile|null $creator
 * @property-read Extra|null $extra
 * @property-read Profile|null $updater
 *
 * @method static CachedBuilder<static>|LimeMapTutorialUser all($columns = [])
 * @method static CachedBuilder<static>|LimeMapTutorialUser avg($column)
 * @method static CachedBuilder<static>|LimeMapTutorialUser cache(array $tags = [])
 * @method static CachedBuilder<static>|LimeMapTutorialUser cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder<static>|LimeMapTutorialUser count($columns = '*')
 * @method static CachedBuilder<static>|LimeMapTutorialUser disableCache()
 * @method static CachedBuilder<static>|LimeMapTutorialUser disableModelCaching()
 * @method static CachedBuilder<static>|LimeMapTutorialUser exists()
 * @method static CachedBuilder<static>|LimeMapTutorialUser flushCache(array $tags = [])
 * @method static CachedBuilder<static>|LimeMapTutorialUser getModelCacheCooldown(Model $instance)
 * @method static CachedBuilder<static>|LimeMapTutorialUser inRandomOrder($seed = '')
 * @method static CachedBuilder<static>|LimeMapTutorialUser insert(array $values)
 * @method static CachedBuilder<static>|LimeMapTutorialUser isCachable()
 * @method static CachedBuilder<static>|LimeMapTutorialUser max($column)
 * @method static CachedBuilder<static>|LimeMapTutorialUser min($column)
 * @method static CachedBuilder<static>|LimeMapTutorialUser newModelQuery()
 * @method static CachedBuilder<static>|LimeMapTutorialUser newQuery()
 * @method static CachedBuilder<static>|LimeMapTutorialUser ofFilterData(AnswersFilterData $answersFilterData)
 * @method static CachedBuilder<static>|LimeMapTutorialUser query()
 * @method static CachedBuilder<static>|LimeMapTutorialUser sum($column)
 * @method static CachedBuilder<static>|LimeMapTutorialUser truncate()
 * @method static CachedBuilder<static>|LimeMapTutorialUser whereTaken($value)
 * @method static CachedBuilder<static>|LimeMapTutorialUser whereTid($value)
 * @method static CachedBuilder<static>|LimeMapTutorialUser whereUid($value)
 * @method static CachedBuilder<static>|LimeMapTutorialUser withCacheCooldownSeconds(?int $seconds = null)
 *
 * @mixin \Eloquent
 */
class LimeMapTutorialUser extends BaseModel
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_map_tutorial_users';

    /** @var string */
    protected $primaryKey = 'tid';

    /** @var array<int, string> */
    protected $fillable = [
        'uid', 'taken',
    ];

    /** @var array<int, string> */
    protected $hidden = [
    ];

    /** @return array<string, string>     */
    protected $casts = [
        'tid' => 'int', 'uid' => 'int', 'taken' => 'int',
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
