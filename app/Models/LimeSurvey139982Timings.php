<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use GeneaLabs\LaravelModelCaching\CachedBuilder;

/**
 * Modules\Limesurvey\Models\LimeSurvey139982Timings
 *
 * @property int $id
 * @property float|null $interviewtime
 * @property float|null $139982X812time
 * @property float|null $139982X812X30336time
 * @property float|null $139982X812X30337time
 * @property float|null $139982X812X30338time
 * @property float|null $139982X812X30339time
 * @property float|null $139982X812X30340time
 * @property float|null $139982X812X30341time
 *
 * @property-read \Modules\Quaeris\Models\Profile|null $creator
 * @property-read \Modules\Limesurvey\Models\Extra|null $extra
 * @property-read \Modules\Quaeris\Models\Profile|null $updater
 *
 * @method static CachedBuilder<static>|LimeSurvey139982Timings all($columns = [])
 * @method static CachedBuilder<static>|LimeSurvey139982Timings avg($column)
 * @method static CachedBuilder<static>|LimeSurvey139982Timings cache(array $tags = [])
 * @method static CachedBuilder<static>|LimeSurvey139982Timings cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder<static>|LimeSurvey139982Timings count($columns = '*')
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey139982Timings disableCache()
 * @method static CachedBuilder<static>|LimeSurvey139982Timings disableModelCaching()
 * @method static CachedBuilder<static>|LimeSurvey139982Timings exists()
 * @method static CachedBuilder<static>|LimeSurvey139982Timings flushCache(array $tags = [])
 * @method static CachedBuilder<static>|LimeSurvey139982Timings getModelCacheCooldown(\Illuminate\Database\Eloquent\Model $instance)
 * @method static CachedBuilder<static>|LimeSurvey139982Timings inRandomOrder($seed = '')
 * @method static CachedBuilder<static>|LimeSurvey139982Timings insert(array $values)
 * @method static CachedBuilder<static>|LimeSurvey139982Timings isCachable()
 * @method static CachedBuilder<static>|LimeSurvey139982Timings max($column)
 * @method static CachedBuilder<static>|LimeSurvey139982Timings min($column)
 * @method static CachedBuilder<static>|LimeSurvey139982Timings newModelQuery()
 * @method static CachedBuilder<static>|LimeSurvey139982Timings newQuery()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey139982Timings ofFilterData(\Modules\Quaeris\Datas\AnswersFilterData $answersFilterData)
 * @method static CachedBuilder<static>|LimeSurvey139982Timings query()
 * @method static CachedBuilder<static>|LimeSurvey139982Timings sum($column)
 * @method static CachedBuilder<static>|LimeSurvey139982Timings truncate()
 * @method static CachedBuilder<static>|LimeSurvey139982Timings where139982X812X30336time($value)
 * @method static CachedBuilder<static>|LimeSurvey139982Timings where139982X812X30337time($value)
 * @method static CachedBuilder<static>|LimeSurvey139982Timings where139982X812X30338time($value)
 * @method static CachedBuilder<static>|LimeSurvey139982Timings where139982X812X30339time($value)
 * @method static CachedBuilder<static>|LimeSurvey139982Timings where139982X812X30340time($value)
 * @method static CachedBuilder<static>|LimeSurvey139982Timings where139982X812X30341time($value)
 * @method static CachedBuilder<static>|LimeSurvey139982Timings where139982X812time($value)
 * @method static CachedBuilder<static>|LimeSurvey139982Timings whereId($value)
 * @method static CachedBuilder<static>|LimeSurvey139982Timings whereInterviewtime($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey139982Timings withCacheCooldownSeconds(?int $seconds = null)
 *
 * @mixin \Eloquent
 */
class LimeSurvey139982Timings extends BaseModel
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_survey_139982_timings';

    /** @var string */
    protected $primaryKey = 'id';

    /** @var array<int, string> */
    protected $fillable = [
        'interviewtime', '139982X812time', '139982X812X30336time', '139982X812X30337time', '139982X812X30338time', '139982X812X30339time', '139982X812X30340time', '139982X812X30341time',
    ];

    /** @var array<int, string> */
    protected $hidden = [
    ];

    /** @return array<string, string>     */
    protected $casts = [
        'id' => 'int', 'interviewtime' => 'float', '139982X812time' => 'float', '139982X812X30336time' => 'float', '139982X812X30337time' => 'float', '139982X812X30338time' => 'float', '139982X812X30339time' => 'float', '139982X812X30340time' => 'float', '139982X812X30341time' => 'float',
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
