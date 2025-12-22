<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use Modules\Limesurvey\Contracts\LimeSurveyXXXContract;

/**
 * @property int $id
 * @property string|null $token
 * @property string|null $submitdate
 * @property int|null $lastpage
 * @property string $startlanguage
 * @property string|null $seed
 * @property string $startdate
 * @property string $datestamp
 * @property string|null $946595X2285X48872
 * @property string|null $946595X2253X48241
 * @property string|null $946595X2253X48242
 * @property string|null $946595X2254X48243
 * @property string|null $946595X2254X48244
 * @property string|null $946595X2254X48245
 * @property string|null $946595X2254X48246
 * @property string|null $946595X2254X48247
 * @property string|null $946595X2254X48248
 * @property string|null $946595X2254X48249SQ01
 * @property string|null $946595X2254X48250
 * @property string|null $946595X2255X48251
 * @property string|null $946595X2255X48252
 * @property string|null $946595X2255X48253
 * @property string|null $946595X2255X48254
 * @property string|null $946595X2255X48255
 * @property string|null $946595X2255X48256
 * @property string|null $946595X2255X48257SQ01
 * @property string|null $946595X2255X48258
 * @property string|null $946595X2256X48259
 * @property string|null $946595X2256X48260
 * @property string|null $946595X2256X49371
 * @property string|null $946595X2256X48261
 * @property string|null $946595X2256X48262SQ01
 * @property string|null $946595X2256X48263
 * @property string|null $946595X2257X4826401
 * @property string|null $946595X2257X4826402
 * @property string|null $946595X2257X4826403
 * @property string|null $946595X2257X4826404
 * @property string|null $946595X2257X4826405
 * @property string|null $946595X2257X4826406
 * @property string|null $946595X2257X4826407
 * @property string|null $946595X2257X4826408
 * @property string|null $946595X2257X49372
 * @property string|null $946595X2257X48265SQ01
 * @property string|null $946595X2257X48266
 * @property string|null $946595X2258X48267
 * @property string|null $946595X2258X48268SQ01
 * @property string|null $946595X2258X48274
 * @property string|null $946595X2258X49370
 * @property string|null $946595X2259X48269SQ01
 * @property string|null $946595X2259X48843SQ01
 * @property string|null $946595X2259X48847SQ01
 * @property string|null $946595X2259X48270SQ01
 * @property string|null $946595X2259X48850SQ01
 * @property string|null $946595X2259X48852SQ01
 * @property string|null $946595X2259X48271SQ01
 * @property string|null $946595X2259X48869SQ01
 * @property string|null $946595X2260X48272
 * @property string|null $946595X2260X48273
 *
 * @property-read \Modules\Quaeris\Models\Profile|null $creator
 * @property-read \Modules\Limesurvey\Models\Extra|null $extra
 * @property-read \Modules\Quaeris\Models\Profile|null $updater
 *
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 all($columns = [])
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 avg($column)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 cache(array $tags = [])
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 cachedValue(array $arguments, string $cacheKey)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 count($columns = '*')
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 disableCache()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 disableModelCaching()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 exists()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 flushCache(array $tags = [])
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 getModelCacheCooldown(\Illuminate\Database\Eloquent\Model $instance)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 inRandomOrder($seed = '')
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 insert(array $values)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 isCachable()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 max($column)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 min($column)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 newModelQuery()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 newQuery()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 ofFilterData(\Modules\Quaeris\Datas\AnswersFilterData $answersFilterData)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 query()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 sum($column)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 truncate()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 where946595X2253X48241($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 where946595X2253X48242($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 where946595X2254X48243($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 where946595X2254X48244($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 where946595X2254X48245($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 where946595X2254X48246($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 where946595X2254X48247($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 where946595X2254X48248($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 where946595X2254X48249SQ01($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 where946595X2254X48250($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 where946595X2255X48251($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 where946595X2255X48252($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 where946595X2255X48253($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 where946595X2255X48254($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 where946595X2255X48255($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 where946595X2255X48256($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 where946595X2255X48257SQ01($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 where946595X2255X48258($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 where946595X2256X48259($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 where946595X2256X48260($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 where946595X2256X48261($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 where946595X2256X48262SQ01($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 where946595X2256X48263($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 where946595X2256X49371($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 where946595X2257X4826401($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 where946595X2257X4826402($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 where946595X2257X4826403($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 where946595X2257X4826404($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 where946595X2257X4826405($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 where946595X2257X4826406($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 where946595X2257X4826407($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 where946595X2257X4826408($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 where946595X2257X48265SQ01($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 where946595X2257X48266($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 where946595X2257X49372($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 where946595X2258X48267($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 where946595X2258X48268SQ01($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 where946595X2258X48274($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 where946595X2258X49370($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 where946595X2259X48269SQ01($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 where946595X2259X48270SQ01($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 where946595X2259X48271SQ01($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 where946595X2259X48843SQ01($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 where946595X2259X48847SQ01($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 where946595X2259X48850SQ01($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 where946595X2259X48852SQ01($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 where946595X2259X48869SQ01($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 where946595X2260X48272($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 where946595X2260X48273($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 where946595X2285X48872($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 whereDatestamp($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 whereId($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 whereLastpage($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 whereSeed($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 whereStartdate($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 whereStartlanguage($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 whereSubmitdate($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 whereToken($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey946595 withCacheCooldownSeconds(?int $seconds = null)
 *
 * @mixin \Eloquent
 */
class LimeSurvey946595 extends BaseModel implements LimeSurveyXXXContract
{
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    /** @var string */
    protected $table = 'lime_survey_946595';

    /** @var string */
    protected $primaryKey = 'id';
}
