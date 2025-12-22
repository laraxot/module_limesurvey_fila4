<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

/**
 * @property int $id
 * @property string|null $token
 * @property string|null $submitdate
 * @property int|null $lastpage
 * @property string $startlanguage
 * @property string|null $seed
 * @property string $startdate
 * @property string $datestamp
 * @property string|null $39275X39X465
 * @property string|null $39275X39X466
 * @property string|null $39275X40X539
 * @property string|null $39275X40X467
 * @property string|null $39275X40X468
 * @property string|null $39275X40X469
 * @property string|null $39275X40X470
 * @property string|null $39275X40X471
 * @property string|null $39275X40X472
 * @property string|null $39275X40X473
 * @property string|null $39275X40X474
 * @property string|null $39275X40X475SQ001
 * @property string|null $39275X40X476
 * @property string|null $39275X41X540
 * @property string|null $39275X41X479
 * @property string|null $39275X41X480
 * @property string|null $39275X41X481
 * @property string|null $39275X41X482
 * @property string|null $39275X41X483
 * @property string|null $39275X41X484
 * @property string|null $39275X41X487SQ001
 * @property string|null $39275X41X488
 * @property string|null $39275X41X490SQ001
 * @property string|null $39275X41X492
 * @property string|null $39275X42X541
 * @property string|null $39275X42X493
 * @property string|null $39275X42X660SQ001
 * @property string|null $39275X42X723
 * @property string|null $39275X42X495
 * @property string|null $39275X42X505
 * @property string|null $39275X42X497
 * @property string|null $39275X42X498
 * @property string|null $39275X42X506
 * @property string|null $39275X42X507
 * @property string|null $39275X42X508
 * @property string|null $39275X42X509
 * @property string|null $39275X42X499SQ001
 * @property string|null $39275X42X500
 * @property string|null $39275X43X510
 * @property string|null $39275X43X512
 * @property string|null $39275X43X512other
 * @property string|null $39275X43X514
 * @property string|null $39275X43X516SQ001
 * @property string|null $39275X43X517
 * @property string|null $39275X44X534
 * @property string|null $39275X44X528SQ001
 * @property string|null $39275X44X529
 * @property string|null $39275X44X536SQ001
 * @property string|null $39275X44X538
 * @property string|null $39275X44X530SQ001
 * @property string|null $39275X44X531
 * @property string|null $39275X45X543
 * @property string|null $39275X45X542
 *
 * @property-read \Modules\Quaeris\Models\Profile|null $creator
 * @property-read \Modules\Limesurvey\Models\Extra|null $extra
 * @property-read \Modules\Quaeris\Models\Profile|null $updater
 *
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 all($columns = [])
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 avg($column)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 cache(array $tags = [])
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 cachedValue(array $arguments, string $cacheKey)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 count($columns = '*')
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 disableCache()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 disableModelCaching()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 exists()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 flushCache(array $tags = [])
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 getModelCacheCooldown(\Illuminate\Database\Eloquent\Model $instance)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 inRandomOrder($seed = '')
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 insert(array $values)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 isCachable()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 max($column)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 min($column)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 newModelQuery()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 newQuery()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 ofFilterData(\Modules\Quaeris\Datas\AnswersFilterData $answersFilterData)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 query()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 sum($column)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 truncate()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 where39275X39X465($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 where39275X39X466($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 where39275X40X467($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 where39275X40X468($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 where39275X40X469($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 where39275X40X470($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 where39275X40X471($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 where39275X40X472($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 where39275X40X473($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 where39275X40X474($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 where39275X40X475SQ001($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 where39275X40X476($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 where39275X40X539($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 where39275X41X479($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 where39275X41X480($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 where39275X41X481($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 where39275X41X482($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 where39275X41X483($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 where39275X41X484($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 where39275X41X487SQ001($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 where39275X41X488($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 where39275X41X490SQ001($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 where39275X41X492($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 where39275X41X540($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 where39275X42X493($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 where39275X42X495($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 where39275X42X497($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 where39275X42X498($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 where39275X42X499SQ001($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 where39275X42X500($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 where39275X42X505($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 where39275X42X506($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 where39275X42X507($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 where39275X42X508($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 where39275X42X509($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 where39275X42X541($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 where39275X42X660SQ001($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 where39275X42X723($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 where39275X43X510($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 where39275X43X512($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 where39275X43X512other($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 where39275X43X514($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 where39275X43X516SQ001($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 where39275X43X517($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 where39275X44X528SQ001($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 where39275X44X529($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 where39275X44X530SQ001($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 where39275X44X531($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 where39275X44X534($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 where39275X44X536SQ001($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 where39275X44X538($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 where39275X45X542($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 where39275X45X543($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 whereDatestamp($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 whereId($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 whereLastpage($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 whereSeed($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 whereStartdate($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 whereStartlanguage($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 whereSubmitdate($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 whereToken($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey39275 withCacheCooldownSeconds(?int $seconds = null)
 *
 * @mixin \Eloquent
 */
class LimeSurvey39275 extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    protected $table = 'lime_survey_39275';
}
