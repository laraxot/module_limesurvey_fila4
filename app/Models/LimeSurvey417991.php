<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use GeneaLabs\LaravelModelCaching\CachedBuilder;
use Illuminate\Support\Carbon;
use Modules\Limesurvey\Contracts\LimeSurveyXXXContract;

/**
 * Modules\Limesurvey\Models\LimeSurvey417991
 *
 * @property int $id
 * @property string|null $token
 * @property Carbon|null $submitdate
 * @property int|null $lastpage
 * @property string $startlanguage
 * @property string|null $seed
 * @property string $startdate
 * @property string $datestamp
 * @property string|null $417991X1025X33130
 * @property string|null $417991X1026X331311
 * @property string|null $417991X1026X331312
 * @property string|null $417991X1026X331313
 * @property string|null $417991X1026X331314
 * @property string|null $417991X1026X331315
 * @property string|null $417991X1026X331316
 * @property string|null $417991X1026X331317
 * @property string|null $417991X1026X331318
 * @property string|null $417991X1026X331319
 * @property string|null $417991X1026X3314110
 * @property string|null $417991X1027X33143
 * @property-read \Modules\Quaeris\Models\Profile|null $creator
 * @property-read \Modules\Limesurvey\Models\Extra|null $extra
 * @property-read \Modules\Quaeris\Models\Profile|null $updater
 *
 * @method static CachedBuilder<static>|LimeSurvey417991 all($columns = [])
 * @method static CachedBuilder<static>|LimeSurvey417991 avg($column)
 * @method static CachedBuilder<static>|LimeSurvey417991 cache(array $tags = [])
 * @method static CachedBuilder<static>|LimeSurvey417991 cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder<static>|LimeSurvey417991 count($columns = '*')
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey417991 disableCache()
 * @method static CachedBuilder<static>|LimeSurvey417991 disableModelCaching()
 * @method static CachedBuilder<static>|LimeSurvey417991 exists()
 * @method static CachedBuilder<static>|LimeSurvey417991 flushCache(array $tags = [])
 * @method static CachedBuilder<static>|LimeSurvey417991 getModelCacheCooldown(\Illuminate\Database\Eloquent\Model $instance)
 * @method static CachedBuilder<static>|LimeSurvey417991 inRandomOrder($seed = '')
 * @method static CachedBuilder<static>|LimeSurvey417991 insert(array $values)
 * @method static CachedBuilder<static>|LimeSurvey417991 isCachable()
 * @method static CachedBuilder<static>|LimeSurvey417991 max($column)
 * @method static CachedBuilder<static>|LimeSurvey417991 min($column)
 * @method static CachedBuilder<static>|LimeSurvey417991 newModelQuery()
 * @method static CachedBuilder<static>|LimeSurvey417991 newQuery()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey417991 ofFilterData(\Modules\Quaeris\Datas\AnswersFilterData $answersFilterData)
 * @method static CachedBuilder<static>|LimeSurvey417991 query()
 * @method static CachedBuilder<static>|LimeSurvey417991 sum($column)
 * @method static CachedBuilder<static>|LimeSurvey417991 truncate()
 * @method static CachedBuilder<static>|LimeSurvey417991 where417991X1025X33130($value)
 * @method static CachedBuilder<static>|LimeSurvey417991 where417991X1026X331311($value)
 * @method static CachedBuilder<static>|LimeSurvey417991 where417991X1026X331312($value)
 * @method static CachedBuilder<static>|LimeSurvey417991 where417991X1026X331313($value)
 * @method static CachedBuilder<static>|LimeSurvey417991 where417991X1026X331314($value)
 * @method static CachedBuilder<static>|LimeSurvey417991 where417991X1026X331315($value)
 * @method static CachedBuilder<static>|LimeSurvey417991 where417991X1026X331316($value)
 * @method static CachedBuilder<static>|LimeSurvey417991 where417991X1026X331317($value)
 * @method static CachedBuilder<static>|LimeSurvey417991 where417991X1026X331318($value)
 * @method static CachedBuilder<static>|LimeSurvey417991 where417991X1026X331319($value)
 * @method static CachedBuilder<static>|LimeSurvey417991 where417991X1026X3314110($value)
 * @method static CachedBuilder<static>|LimeSurvey417991 where417991X1027X33143($value)
 * @method static CachedBuilder<static>|LimeSurvey417991 whereDatestamp($value)
 * @method static CachedBuilder<static>|LimeSurvey417991 whereId($value)
 * @method static CachedBuilder<static>|LimeSurvey417991 whereLastpage($value)
 * @method static CachedBuilder<static>|LimeSurvey417991 whereSeed($value)
 * @method static CachedBuilder<static>|LimeSurvey417991 whereStartdate($value)
 * @method static CachedBuilder<static>|LimeSurvey417991 whereStartlanguage($value)
 * @method static CachedBuilder<static>|LimeSurvey417991 whereSubmitdate($value)
 * @method static CachedBuilder<static>|LimeSurvey417991 whereToken($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey417991 withCacheCooldownSeconds(?int $seconds = null)
 *
 * @mixin \Eloquent
 */
class LimeSurvey417991 extends BaseModel implements LimeSurveyXXXContract
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_survey_417991';

    /** @var string */
    protected $primaryKey = 'id';

    /** @var array<int, string> */
    protected $fillable = [
        'token', 'submitdate', 'lastpage', 'startlanguage', 'seed', '417991X1025X33130', '417991X1026X331312', '417991X1026X331313', '417991X1026X331314', '417991X1026X331315', '417991X1026X331316', '417991X1026X331317', '417991X1026X331318', '417991X1026X331319', '417991X1026X3314110', '417991X1027X33143',
    ];

    /** @var array<int, string> */
    protected $hidden = [
    ];

    /** @return array<string, string>     */
    protected $casts = [
        'id' => 'int', 'token' => 'string', 'submitdate' => 'datetime', 'lastpage' => 'int', 'startlanguage' => 'string', 'seed' => 'string', '417991X1025X33130' => 'string', '417991X1026X331312' => 'string', '417991X1026X331313' => 'string', '417991X1026X331314' => 'string', '417991X1026X331315' => 'string', '417991X1026X331316' => 'string', '417991X1026X331317' => 'string', '417991X1026X331318' => 'string', '417991X1026X331319' => 'string', '417991X1026X3314110' => 'string', '417991X1027X33143' => 'string',
    ];

    // Scopes...

    // Functions ...

    // Relations ...
}
