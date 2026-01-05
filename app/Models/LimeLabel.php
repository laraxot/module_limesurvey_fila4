<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use GeneaLabs\LaravelModelCaching\CachedBuilder;
use Illuminate\Database\Eloquent\Model;
use Modules\Quaeris\Datas\AnswersFilterData;
use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeLabel
 *
 * @property int $id
 * @property int $lid
 * @property string $code
 * @property int $sortorder
 * @property int $assessment_value
 *
 * @property-read Profile|null $creator
 * @property-read Extra|null $extra
 * @property-read Profile|null $updater
 *
 * @method static CachedBuilder|LimeLabel all($columns = [])
 * @method static CachedBuilder|LimeLabel avg($column)
 * @method static CachedBuilder|LimeLabel cache(array $tags = [])
 * @method static CachedBuilder|LimeLabel cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder|LimeLabel count($columns = '*')
 * @method static CachedBuilder|LimeLabel disableCache()
 * @method static CachedBuilder|LimeLabel disableModelCaching()
 * @method static CachedBuilder|LimeLabel exists()
 * @method static CachedBuilder|LimeLabel flushCache(array $tags = [])
 * @method static CachedBuilder|LimeLabel getModelCacheCooldown(Model $instance)
 * @method static CachedBuilder|LimeLabel inRandomOrder($seed = '')
 * @method static CachedBuilder|LimeLabel insert(array $values)
 * @method static CachedBuilder|LimeLabel isCachable()
 * @method static CachedBuilder|LimeLabel max($column)
 * @method static CachedBuilder|LimeLabel min($column)
 * @method static CachedBuilder|LimeLabel newModelQuery()
 * @method static CachedBuilder|LimeLabel newQuery()
 * @method static CachedBuilder|LimeLabel ofFilterData(AnswersFilterData $answersFilterData)
 * @method static CachedBuilder|LimeLabel query()
 * @method static CachedBuilder|LimeLabel sum($column)
 * @method static CachedBuilder|LimeLabel truncate()
 * @method static CachedBuilder|LimeLabel whereAssessmentValue($value)
 * @method static CachedBuilder|LimeLabel whereCode($value)
 * @method static CachedBuilder|LimeLabel whereId($value)
 * @method static CachedBuilder|LimeLabel whereLid($value)
 * @method static CachedBuilder|LimeLabel whereSortorder($value)
 * @method static CachedBuilder|LimeLabel withCacheCooldownSeconds(?int $seconds = null)
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

    /** @var list<string> */
    protected $fillable = [
        'lid', 'code', 'title', 'sortorder', 'language', 'assessment_value',
    ];

    /** @var list<string> */
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
