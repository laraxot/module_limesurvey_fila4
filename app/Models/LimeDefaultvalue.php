<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use GeneaLabs\LaravelModelCaching\CachedBuilder;

/**
 * Modules\Limesurvey\Models\LimeDefaultvalue
 *
 * @property int $dvid
 * @property int $qid
 * @property int $scale_id
 * @property int $sqid
 * @property string $specialtype
 * @property-read \Modules\Quaeris\Models\Profile|null $creator
 * @property-read \Modules\Limesurvey\Models\Extra|null $extra
 * @property-read \Modules\Quaeris\Models\Profile|null $updater
 *
 * @method static CachedBuilder<static>|LimeDefaultvalue all($columns = [])
 * @method static CachedBuilder<static>|LimeDefaultvalue avg($column)
 * @method static CachedBuilder<static>|LimeDefaultvalue cache(array $tags = [])
 * @method static CachedBuilder<static>|LimeDefaultvalue cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder<static>|LimeDefaultvalue count($columns = '*')
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeDefaultvalue disableCache()
 * @method static CachedBuilder<static>|LimeDefaultvalue disableModelCaching()
 * @method static CachedBuilder<static>|LimeDefaultvalue exists()
 * @method static CachedBuilder<static>|LimeDefaultvalue flushCache(array $tags = [])
 * @method static CachedBuilder<static>|LimeDefaultvalue getModelCacheCooldown(\Illuminate\Database\Eloquent\Model $instance)
 * @method static CachedBuilder<static>|LimeDefaultvalue inRandomOrder($seed = '')
 * @method static CachedBuilder<static>|LimeDefaultvalue insert(array $values)
 * @method static CachedBuilder<static>|LimeDefaultvalue isCachable()
 * @method static CachedBuilder<static>|LimeDefaultvalue max($column)
 * @method static CachedBuilder<static>|LimeDefaultvalue min($column)
 * @method static CachedBuilder<static>|LimeDefaultvalue newModelQuery()
 * @method static CachedBuilder<static>|LimeDefaultvalue newQuery()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeDefaultvalue ofFilterData(\Modules\Quaeris\Datas\AnswersFilterData $answersFilterData)
 * @method static CachedBuilder<static>|LimeDefaultvalue query()
 * @method static CachedBuilder<static>|LimeDefaultvalue sum($column)
 * @method static CachedBuilder<static>|LimeDefaultvalue truncate()
 * @method static CachedBuilder<static>|LimeDefaultvalue whereDvid($value)
 * @method static CachedBuilder<static>|LimeDefaultvalue whereQid($value)
 * @method static CachedBuilder<static>|LimeDefaultvalue whereScaleId($value)
 * @method static CachedBuilder<static>|LimeDefaultvalue whereSpecialtype($value)
 * @method static CachedBuilder<static>|LimeDefaultvalue whereSqid($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeDefaultvalue withCacheCooldownSeconds(?int $seconds = null)
 *
 * @mixin \Eloquent
 */
class LimeDefaultvalue extends BaseModel
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_defaultvalues';

    /** @var string */
    protected $primaryKey = 'qid';

    /** @var array<int, string> */
    protected $fillable = [
        'scale_id', 'sqid', 'language', 'specialtype', 'defaultvalue',
    ];

    /** @var array<int, string> */
    protected $hidden = [
    ];

    /** @return array<string, string>     */
    protected $casts = [
        'qid' => 'int', 'scale_id' => 'int', 'sqid' => 'int', 'language' => 'string', 'specialtype' => 'string', 'defaultvalue' => 'string',
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
