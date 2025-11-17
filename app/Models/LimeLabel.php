<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use GeneaLabs\LaravelModelCaching\CachedBuilder;

/**
 * Modules\Limesurvey\Models\LimeLabel
 *
 * @property int $id
 * @property int $lid
 * @property string $code
 * @property int $sortorder
 * @property int $assessment_value
 * @property-read \Modules\Quaeris\Models\Profile|null $creator
 * @property-read \Modules\Limesurvey\Models\Extra|null $extra
 * @property-read \Modules\Quaeris\Models\Profile|null $updater
 *
 * @method static CachedBuilder<static>|LimeLabel all($columns = [])
 * @method static CachedBuilder<static>|LimeLabel avg($column)
 * @method static CachedBuilder<static>|LimeLabel cache(array $tags = [])
 * @method static CachedBuilder<static>|LimeLabel cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder<static>|LimeLabel count($columns = '*')
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeLabel disableCache()
 * @method static CachedBuilder<static>|LimeLabel disableModelCaching()
 * @method static CachedBuilder<static>|LimeLabel exists()
 * @method static CachedBuilder<static>|LimeLabel flushCache(array $tags = [])
 * @method static CachedBuilder<static>|LimeLabel getModelCacheCooldown(\Illuminate\Database\Eloquent\Model $instance)
 * @method static CachedBuilder<static>|LimeLabel inRandomOrder($seed = '')
 * @method static CachedBuilder<static>|LimeLabel insert(array $values)
 * @method static CachedBuilder<static>|LimeLabel isCachable()
 * @method static CachedBuilder<static>|LimeLabel max($column)
 * @method static CachedBuilder<static>|LimeLabel min($column)
 * @method static CachedBuilder<static>|LimeLabel newModelQuery()
 * @method static CachedBuilder<static>|LimeLabel newQuery()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeLabel ofFilterData(\Modules\Quaeris\Datas\AnswersFilterData $answersFilterData)
 * @method static CachedBuilder<static>|LimeLabel query()
 * @method static CachedBuilder<static>|LimeLabel sum($column)
 * @method static CachedBuilder<static>|LimeLabel truncate()
 * @method static CachedBuilder<static>|LimeLabel whereAssessmentValue($value)
 * @method static CachedBuilder<static>|LimeLabel whereCode($value)
 * @method static CachedBuilder<static>|LimeLabel whereId($value)
 * @method static CachedBuilder<static>|LimeLabel whereLid($value)
 * @method static CachedBuilder<static>|LimeLabel whereSortorder($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeLabel withCacheCooldownSeconds(?int $seconds = null)
 *
 * @mixin \Eloquent
 */
class LimeLabel extends BaseModel
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_labels';

    /** @var string */
    protected $primaryKey = 'id';

    /** @var array<int, string> */
    protected $fillable = [
        'lid', 'code', 'title', 'sortorder', 'language', 'assessment_value',
    ];

    /** @var array<int, string> */
    protected $hidden = [
    ];

    /** @return array<string, string>     */
    protected $casts = [
        'id' => 'int', 'lid' => 'int', 'code' => 'string', 'title' => 'string', 'sortorder' => 'int', 'language' => 'string', 'assessment_value' => 'int',
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
