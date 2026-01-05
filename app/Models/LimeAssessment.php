<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use GeneaLabs\LaravelModelCaching\CachedBuilder;
use Illuminate\Database\Eloquent\Model;
use Modules\Quaeris\Datas\AnswersFilterData;
use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeAssessment
 *
 * @property int $id
 * @property int $sid
 * @property string $scope
 * @property int $gid
 * @property string $name
 * @property string $minimum
 * @property string $maximum
 * @property string $message
 * @property string $language
 *
 * @property-read Profile|null $creator
 * @property-read Extra|null $extra
 * @property-read Profile|null $updater
 *
 * @method static CachedBuilder|LimeAssessment all($columns = [])
 * @method static CachedBuilder|LimeAssessment avg($column)
 * @method static CachedBuilder|LimeAssessment cache(array $tags = [])
 * @method static CachedBuilder|LimeAssessment cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder|LimeAssessment count($columns = '*')
 * @method static CachedBuilder|LimeAssessment disableCache()
 * @method static CachedBuilder|LimeAssessment disableModelCaching()
 * @method static CachedBuilder|LimeAssessment exists()
 * @method static CachedBuilder|LimeAssessment flushCache(array $tags = [])
 * @method static CachedBuilder|LimeAssessment getModelCacheCooldown(Model $instance)
 * @method static CachedBuilder|LimeAssessment inRandomOrder($seed = '')
 * @method static CachedBuilder|LimeAssessment insert(array $values)
 * @method static CachedBuilder|LimeAssessment isCachable()
 * @method static CachedBuilder|LimeAssessment max($column)
 * @method static CachedBuilder|LimeAssessment min($column)
 * @method static CachedBuilder|LimeAssessment newModelQuery()
 * @method static CachedBuilder|LimeAssessment newQuery()
 * @method static CachedBuilder|LimeAssessment ofFilterData(AnswersFilterData $answersFilterData)
 * @method static CachedBuilder|LimeAssessment query()
 * @method static CachedBuilder|LimeAssessment sum($column)
 * @method static CachedBuilder|LimeAssessment truncate()
 * @method static CachedBuilder|LimeAssessment whereGid($value)
 * @method static CachedBuilder|LimeAssessment whereId($value)
 * @method static CachedBuilder|LimeAssessment whereLanguage($value)
 * @method static CachedBuilder|LimeAssessment whereMaximum($value)
 * @method static CachedBuilder|LimeAssessment whereMessage($value)
 * @method static CachedBuilder|LimeAssessment whereMinimum($value)
 * @method static CachedBuilder|LimeAssessment whereName($value)
 * @method static CachedBuilder|LimeAssessment whereScope($value)
 * @method static CachedBuilder|LimeAssessment whereSid($value)
 * @method static CachedBuilder|LimeAssessment withCacheCooldownSeconds(?int $seconds = null)
 *
 * @mixin \Eloquent
 */
class LimeAssessment extends BaseModel
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_assessments';

    /** @var string */
    protected $primaryKey = 'id';

    /** @var list<string> */
    protected $fillable = [
        'language', 'sid', 'scope', 'gid', 'name', 'minimum', 'maximum', 'message',
    ];

    /** @var list<string> */
    protected $hidden = [
    ];

    /** @return array<string, string>     */
    protected $casts = [
        'id' => 'int', 'language' => 'string', 'sid' => 'int', 'scope' => 'string', 'gid' => 'int', 'name' => 'string', 'minimum' => 'string', 'maximum' => 'string', 'message' => 'string',
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
