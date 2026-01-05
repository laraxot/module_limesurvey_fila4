<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use Modules\Quaeris\Models\Profile;
use Illuminate\Database\Eloquent\Model;
use Modules\Quaeris\Datas\AnswersFilterData;
use GeneaLabs\LaravelModelCaching\CachedBuilder;
use Modules\Limesurvey\Contracts\LimeSurveyXXXContract;

/**
 * Modules\Limesurvey\Models\LimeSurvey739792
 *
 * @property int $id
 * @property string|null $token
 * @property string|null $submitdate
 * @property int|null $lastpage
 * @property string $startlanguage
 * @property string|null $seed
 * @property string $startdate
 * @property string $datestamp
 * @property string|null $ipaddr
 * @property string|null $refurl
 * @property string|null $739792X1740X40889
 * @property string|null $739792X1740X40891SQ001
 * @property string|null $739792X1740X40893
 * @property string|null $739792X1740X40890
 * @property string|null $739792X1740X40892SQ001
 * @property string|null $739792X1740X40894
 * @property string|null $739792X1740X40912
 *
 * @property-read Profile|null $creator
 * @property-read Extra|null $extra
 * @property-read Profile|null $updater
 *
 * @method static CachedBuilder<static>|LimeSurvey739792 all($columns = [])
 * @method static CachedBuilder<static>|LimeSurvey739792 avg($column)
 * @method static CachedBuilder<static>|LimeSurvey739792 cache(array $tags = [])
 * @method static CachedBuilder<static>|LimeSurvey739792 cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder<static>|LimeSurvey739792 count($columns = '*')
 * @method static CachedBuilder<static>|LimeSurvey739792 disableCache()
 * @method static CachedBuilder<static>|LimeSurvey739792 disableModelCaching()
 * @method static CachedBuilder<static>|LimeSurvey739792 exists()
 * @method static CachedBuilder<static>|LimeSurvey739792 flushCache(array $tags = [])
 * @method static CachedBuilder<static>|LimeSurvey739792 getModelCacheCooldown(Model $instance)
 * @method static CachedBuilder<static>|LimeSurvey739792 inRandomOrder($seed = '')
 * @method static CachedBuilder<static>|LimeSurvey739792 insert(array $values)
 * @method static CachedBuilder<static>|LimeSurvey739792 isCachable()
 * @method static CachedBuilder<static>|LimeSurvey739792 max($column)
 * @method static CachedBuilder<static>|LimeSurvey739792 min($column)
 * @method static CachedBuilder<static>|LimeSurvey739792 newModelQuery()
 * @method static CachedBuilder<static>|LimeSurvey739792 newQuery()
 * @method static CachedBuilder<static>|LimeSurvey739792 ofFilterData(AnswersFilterData $answersFilterData)
 * @method static CachedBuilder<static>|LimeSurvey739792 query()
 * @method static CachedBuilder<static>|LimeSurvey739792 sum($column)
 * @method static CachedBuilder<static>|LimeSurvey739792 truncate()
 * @method static CachedBuilder<static>|LimeSurvey739792 where739792X1740X40889($value)
 * @method static CachedBuilder<static>|LimeSurvey739792 where739792X1740X40890($value)
 * @method static CachedBuilder<static>|LimeSurvey739792 where739792X1740X40891SQ001($value)
 * @method static CachedBuilder<static>|LimeSurvey739792 where739792X1740X40892SQ001($value)
 * @method static CachedBuilder<static>|LimeSurvey739792 where739792X1740X40893($value)
 * @method static CachedBuilder<static>|LimeSurvey739792 where739792X1740X40894($value)
 * @method static CachedBuilder<static>|LimeSurvey739792 where739792X1740X40912($value)
 * @method static CachedBuilder<static>|LimeSurvey739792 whereDatestamp($value)
 * @method static CachedBuilder<static>|LimeSurvey739792 whereId($value)
 * @method static CachedBuilder<static>|LimeSurvey739792 whereIpaddr($value)
 * @method static CachedBuilder<static>|LimeSurvey739792 whereLastpage($value)
 * @method static CachedBuilder<static>|LimeSurvey739792 whereRefurl($value)
 * @method static CachedBuilder<static>|LimeSurvey739792 whereSeed($value)
 * @method static CachedBuilder<static>|LimeSurvey739792 whereStartdate($value)
 * @method static CachedBuilder<static>|LimeSurvey739792 whereStartlanguage($value)
 * @method static CachedBuilder<static>|LimeSurvey739792 whereSubmitdate($value)
 * @method static CachedBuilder<static>|LimeSurvey739792 whereToken($value)
 * @method static CachedBuilder<static>|LimeSurvey739792 withCacheCooldownSeconds(?int $seconds = null)
 *
 * @mixin \Eloquent
 */
class LimeSurvey739792 extends BaseModel implements LimeSurveyXXXContract
{
    /** @var bool */
    public $timestamps = false;

    /** @var string */
    protected $table = 'lime_survey_739792';

    /** @var string */
    protected $primaryKey = 'id';

    /** @var array<int, string> */
    protected $fillable = [
        0 => 'id',
        1 => 'token',
        2 => 'submitdate',
        3 => 'lastpage',
        4 => 'startlanguage',
        5 => 'seed',
        6 => 'startdate',
        7 => 'datestamp',
        8 => 'ipaddr',
        9 => 'refurl',
        10 => '739792X1740X40889',
        11 => '739792X1740X40891',
        12 => '739792X1740X40893',
        13 => '739792X1740X40890',
        14 => '739792X1740X40892',
        15 => '739792X1740X40894',
        16 => '739792X1740X40912',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array<int, string>
     */
    protected $hidden = [
    ];

    /**
     * The attributes that should be casted to native types.
     * da fare.
     *
     * @var array<string, string>
     */
    protected $casts = [];

    /**
     * The attributes that should be mutated to dates.
     *
     *  da fare
     *
     * @var array<string>
     */
    protected $dates = [
    ];

    // Scopes...

    // Functions ...

    // Relations ...
}
