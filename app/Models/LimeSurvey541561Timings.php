<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use GeneaLabs\LaravelModelCaching\CachedBuilder;
use Illuminate\Database\Eloquent\Model;
use Modules\Limesurvey\Database\Factories\LimeSurvey541561TimingsFactory;
use Modules\Quaeris\Datas\AnswersFilterData;

/**
 * Modules\Limesurvey\Models\LimeSurvey541561Timings
 *
 * @property int $id
 * @property float|null $interviewtime
 * @property float|null $541561X1003time
 * @property float|null $541561X1003X33065time
 * @property float|null $541561X1003X32948time
 * @property float|null $541561X1003X32949time
 * @property float|null $541561X1003X32950time
 * @property float|null $541561X1003X32951time
 * @property float|null $541561X1003X32955time
 * @property float|null $541561X1003X32957time
 * @property float|null $541561X1003X33000time
 * @property float|null $541561X1003X32958time
 * @property float|null $541561X1003X33004time
 * @property float|null $541561X1003X33005time
 * @property float|null $541561X1003X32973time
 * @property float|null $541561X1003X32946time
 * @property float|null $541561X1003X32947time
 *
 * @property-read \Modules\Quaeris\Models\Profile|null $creator
 * @property-read \Modules\Limesurvey\Models\Extra|null $extra
 * @property-read \Modules\Quaeris\Models\Profile|null $updater
 *
 * @method static CachedBuilder<static>|LimeSurvey541561Timings all($columns = [])
 * @method static CachedBuilder<static>|LimeSurvey541561Timings avg($column)
 * @method static CachedBuilder<static>|LimeSurvey541561Timings cache(array $tags = [])
 * @method static CachedBuilder<static>|LimeSurvey541561Timings cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder<static>|LimeSurvey541561Timings count($columns = '*')
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey541561Timings disableCache()
 * @method static CachedBuilder<static>|LimeSurvey541561Timings disableModelCaching()
 * @method static CachedBuilder<static>|LimeSurvey541561Timings exists()
 * @method static CachedBuilder<static>|LimeSurvey541561Timings flushCache(array $tags = [])
 * @method static CachedBuilder<static>|LimeSurvey541561Timings getModelCacheCooldown(\Illuminate\Database\Eloquent\Model $instance)
 * @method static CachedBuilder<static>|LimeSurvey541561Timings inRandomOrder($seed = '')
 * @method static CachedBuilder<static>|LimeSurvey541561Timings insert(array $values)
 * @method static CachedBuilder<static>|LimeSurvey541561Timings isCachable()
 * @method static CachedBuilder<static>|LimeSurvey541561Timings max($column)
 * @method static CachedBuilder<static>|LimeSurvey541561Timings min($column)
 * @method static CachedBuilder<static>|LimeSurvey541561Timings newModelQuery()
 * @method static CachedBuilder<static>|LimeSurvey541561Timings newQuery()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey541561Timings ofFilterData(\Modules\Quaeris\Datas\AnswersFilterData $answersFilterData)
 * @method static CachedBuilder<static>|LimeSurvey541561Timings query()
 * @method static CachedBuilder<static>|LimeSurvey541561Timings sum($column)
 * @method static CachedBuilder<static>|LimeSurvey541561Timings truncate()
 * @method static CachedBuilder<static>|LimeSurvey541561Timings where541561X1003X32946time($value)
 * @method static CachedBuilder<static>|LimeSurvey541561Timings where541561X1003X32947time($value)
 * @method static CachedBuilder<static>|LimeSurvey541561Timings where541561X1003X32948time($value)
 * @method static CachedBuilder<static>|LimeSurvey541561Timings where541561X1003X32949time($value)
 * @method static CachedBuilder<static>|LimeSurvey541561Timings where541561X1003X32950time($value)
 * @method static CachedBuilder<static>|LimeSurvey541561Timings where541561X1003X32951time($value)
 * @method static CachedBuilder<static>|LimeSurvey541561Timings where541561X1003X32955time($value)
 * @method static CachedBuilder<static>|LimeSurvey541561Timings where541561X1003X32957time($value)
 * @method static CachedBuilder<static>|LimeSurvey541561Timings where541561X1003X32958time($value)
 * @method static CachedBuilder<static>|LimeSurvey541561Timings where541561X1003X32973time($value)
 * @method static CachedBuilder<static>|LimeSurvey541561Timings where541561X1003X33000time($value)
 * @method static CachedBuilder<static>|LimeSurvey541561Timings where541561X1003X33004time($value)
 * @method static CachedBuilder<static>|LimeSurvey541561Timings where541561X1003X33005time($value)
 * @method static CachedBuilder<static>|LimeSurvey541561Timings where541561X1003X33065time($value)
 * @method static CachedBuilder<static>|LimeSurvey541561Timings where541561X1003time($value)
 * @method static CachedBuilder<static>|LimeSurvey541561Timings whereId($value)
 * @method static CachedBuilder<static>|LimeSurvey541561Timings whereInterviewtime($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey541561Timings withCacheCooldownSeconds(?int $seconds = null)
 *
 * @mixin \Eloquent
 */
class LimeSurvey541561Timings extends BaseModel
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_survey_541561_timings';

    /** @var string */
    protected $primaryKey = 'id';

    /** @var array<int, string> */
    protected $fillable = [
        'interviewtime', '541561X1003time', '541561X1003X33065time', '541561X1003X32948time', '541561X1003X32949time', '541561X1003X32950time', '541561X1003X32951time', '541561X1003X32955time', '541561X1003X32957time', '541561X1003X33000time', '541561X1003X32958time', '541561X1003X33004time', '541561X1003X33005time', '541561X1003X32973time', '541561X1003X32946time', '541561X1003X32947time',
    ];

    /** @var array<int, string> */
    protected $hidden = [
    ];

    /** @return array<string, string>     */
    protected $casts = [
        'id' => 'int', 'interviewtime' => 'float', '541561X1003time' => 'float', '541561X1003X33065time' => 'float', '541561X1003X32948time' => 'float', '541561X1003X32949time' => 'float', '541561X1003X32950time' => 'float', '541561X1003X32951time' => 'float', '541561X1003X32955time' => 'float', '541561X1003X32957time' => 'float', '541561X1003X33000time' => 'float', '541561X1003X32958time' => 'float', '541561X1003X33004time' => 'float', '541561X1003X33005time' => 'float', '541561X1003X32973time' => 'float', '541561X1003X32946time' => 'float', '541561X1003X32947time' => 'float',
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
