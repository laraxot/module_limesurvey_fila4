<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use GeneaLabs\LaravelModelCaching\CachedBuilder;
use Illuminate\Database\Eloquent\Model;
use Modules\Quaeris\Datas\AnswersFilterData;
use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeLabelset
 *
 * @property int $lid
 * @property string $label_name
 * @property string $languages
 *
 * @property-read Profile|null $creator
 * @property-read Extra|null $extra
 * @property-read Profile|null $updater
 *
 * @method static CachedBuilder|LimeLabelset all($columns = [])
 * @method static CachedBuilder|LimeLabelset avg($column)
 * @method static CachedBuilder|LimeLabelset cache(array $tags = [])
 * @method static CachedBuilder|LimeLabelset cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder|LimeLabelset count($columns = '*')
 * @method static CachedBuilder|LimeLabelset disableCache()
 * @method static CachedBuilder|LimeLabelset disableModelCaching()
 * @method static CachedBuilder|LimeLabelset exists()
 * @method static CachedBuilder|LimeLabelset flushCache(array $tags = [])
 * @method static CachedBuilder|LimeLabelset getModelCacheCooldown(Model $instance)
 * @method static CachedBuilder|LimeLabelset inRandomOrder($seed = '')
 * @method static CachedBuilder|LimeLabelset insert(array $values)
 * @method static CachedBuilder|LimeLabelset isCachable()
 * @method static CachedBuilder|LimeLabelset max($column)
 * @method static CachedBuilder|LimeLabelset min($column)
 * @method static CachedBuilder|LimeLabelset newModelQuery()
 * @method static CachedBuilder|LimeLabelset newQuery()
 * @method static CachedBuilder|LimeLabelset ofFilterData(AnswersFilterData $answersFilterData)
 * @method static CachedBuilder|LimeLabelset query()
 * @method static CachedBuilder|LimeLabelset sum($column)
 * @method static CachedBuilder|LimeLabelset truncate()
 * @method static CachedBuilder|LimeLabelset whereLabelName($value)
 * @method static CachedBuilder|LimeLabelset whereLanguages($value)
 * @method static CachedBuilder|LimeLabelset whereLid($value)
 * @method static CachedBuilder|LimeLabelset withCacheCooldownSeconds(?int $seconds = null)
 *
 * @mixin \Eloquent
 */
class LimeLabelset extends BaseModel
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_labelsets';

    /** @var string */
    protected $primaryKey = 'lid';

    /** @var list<string> */
    protected $fillable = [
        'label_name', 'languages',
    ];

    /** @var list<string> */
    protected $hidden = [
    ];

    /** @return array<string, string>     */
    protected $casts = [
        'lid' => 'int', 'label_name' => 'string', 'languages' => 'string',
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
