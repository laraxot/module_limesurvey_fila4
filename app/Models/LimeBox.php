<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use Modules\Quaeris\Models\Profile;
use Illuminate\Database\Eloquent\Model;
use Modules\Quaeris\Datas\AnswersFilterData;
use GeneaLabs\LaravelModelCaching\CachedBuilder;

/**
 * Modules\Limesurvey\Models\LimeBox
 *
 * @property int $id
 * @property int|null $position
 * @property string $url
 * @property string $title
 * @property string|null $ico
 * @property string $desc
 * @property string $page
 * @property int $usergroup
 *
 * @property-read Profile|null $creator
 * @property-read Extra|null $extra
 * @property-read Profile|null $updater
 *
 * @method static CachedBuilder<static>|LimeBox all($columns = [])
 * @method static CachedBuilder<static>|LimeBox avg($column)
 * @method static CachedBuilder<static>|LimeBox cache(array $tags = [])
 * @method static CachedBuilder<static>|LimeBox cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder<static>|LimeBox count($columns = '*')
 * @method static CachedBuilder<static>|LimeBox disableCache()
 * @method static CachedBuilder<static>|LimeBox disableModelCaching()
 * @method static CachedBuilder<static>|LimeBox exists()
 * @method static CachedBuilder<static>|LimeBox flushCache(array $tags = [])
 * @method static CachedBuilder<static>|LimeBox getModelCacheCooldown(Model $instance)
 * @method static CachedBuilder<static>|LimeBox inRandomOrder($seed = '')
 * @method static CachedBuilder<static>|LimeBox insert(array $values)
 * @method static CachedBuilder<static>|LimeBox isCachable()
 * @method static CachedBuilder<static>|LimeBox max($column)
 * @method static CachedBuilder<static>|LimeBox min($column)
 * @method static CachedBuilder<static>|LimeBox newModelQuery()
 * @method static CachedBuilder<static>|LimeBox newQuery()
 * @method static CachedBuilder<static>|LimeBox ofFilterData(AnswersFilterData $answersFilterData)
 * @method static CachedBuilder<static>|LimeBox query()
 * @method static CachedBuilder<static>|LimeBox sum($column)
 * @method static CachedBuilder<static>|LimeBox truncate()
 * @method static CachedBuilder<static>|LimeBox whereDesc($value)
 * @method static CachedBuilder<static>|LimeBox whereIco($value)
 * @method static CachedBuilder<static>|LimeBox whereId($value)
 * @method static CachedBuilder<static>|LimeBox wherePage($value)
 * @method static CachedBuilder<static>|LimeBox wherePosition($value)
 * @method static CachedBuilder<static>|LimeBox whereTitle($value)
 * @method static CachedBuilder<static>|LimeBox whereUrl($value)
 * @method static CachedBuilder<static>|LimeBox whereUsergroup($value)
 * @method static CachedBuilder<static>|LimeBox withCacheCooldownSeconds(?int $seconds = null)
 *
 * @mixin \Eloquent
 */
class LimeBox extends BaseModel
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_boxes';

    /** @var string */
    protected $primaryKey = 'id';

    /** @var array<int, string> */
    protected $fillable = [
        'position', 'url', 'title', 'ico', 'desc', 'page', 'usergroup',
    ];

    /** @var array<int, string> */
    protected $hidden = [
    ];

    /** @return array<string, string>     */
    protected $casts = [
        'id' => 'int', 'position' => 'int', 'url' => 'string', 'title' => 'string', 'ico' => 'string', 'desc' => 'string', 'page' => 'string', 'usergroup' => 'int',
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
