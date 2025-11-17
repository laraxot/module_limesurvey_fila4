<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use GeneaLabs\LaravelModelCaching\CachedBuilder;

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
 * @property-read \Modules\Quaeris\Models\Profile|null $creator
 * @property-read \Modules\Limesurvey\Models\Extra|null $extra
 * @property-read \Modules\Quaeris\Models\Profile|null $updater
 *
 * @method static CachedBuilder<static>|LimeAssessment all($columns = [])
 * @method static CachedBuilder<static>|LimeAssessment avg($column)
 * @method static CachedBuilder<static>|LimeAssessment cache(array $tags = [])
 * @method static CachedBuilder<static>|LimeAssessment cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder<static>|LimeAssessment count($columns = '*')
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeAssessment disableCache()
 * @method static CachedBuilder<static>|LimeAssessment disableModelCaching()
 * @method static CachedBuilder<static>|LimeAssessment exists()
 * @method static CachedBuilder<static>|LimeAssessment flushCache(array $tags = [])
 * @method static CachedBuilder<static>|LimeAssessment getModelCacheCooldown(\Illuminate\Database\Eloquent\Model $instance)
 * @method static CachedBuilder<static>|LimeAssessment inRandomOrder($seed = '')
 * @method static CachedBuilder<static>|LimeAssessment insert(array $values)
 * @method static CachedBuilder<static>|LimeAssessment isCachable()
 * @method static CachedBuilder<static>|LimeAssessment max($column)
 * @method static CachedBuilder<static>|LimeAssessment min($column)
 * @method static CachedBuilder<static>|LimeAssessment newModelQuery()
 * @method static CachedBuilder<static>|LimeAssessment newQuery()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeAssessment ofFilterData(\Modules\Quaeris\Datas\AnswersFilterData $answersFilterData)
 * @method static CachedBuilder<static>|LimeAssessment query()
 * @method static CachedBuilder<static>|LimeAssessment sum($column)
 * @method static CachedBuilder<static>|LimeAssessment truncate()
 * @method static CachedBuilder<static>|LimeAssessment whereGid($value)
 * @method static CachedBuilder<static>|LimeAssessment whereId($value)
 * @method static CachedBuilder<static>|LimeAssessment whereLanguage($value)
 * @method static CachedBuilder<static>|LimeAssessment whereMaximum($value)
 * @method static CachedBuilder<static>|LimeAssessment whereMessage($value)
 * @method static CachedBuilder<static>|LimeAssessment whereMinimum($value)
 * @method static CachedBuilder<static>|LimeAssessment whereName($value)
 * @method static CachedBuilder<static>|LimeAssessment whereScope($value)
 * @method static CachedBuilder<static>|LimeAssessment whereSid($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeAssessment withCacheCooldownSeconds(?int $seconds = null)
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

    /** @var array<int, string> */
    protected $fillable = [
        'language', 'sid', 'scope', 'gid', 'name', 'minimum', 'maximum', 'message',
    ];

    /** @var array<int, string> */
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
