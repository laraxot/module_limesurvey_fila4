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
 * @method static CachedBuilder<static>|LimeLabelset all($columns = [])
 * @method static CachedBuilder<static>|LimeLabelset avg($column)
 * @method static CachedBuilder<static>|LimeLabelset cache(array $tags = [])
 * @method static CachedBuilder<static>|LimeLabelset cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder<static>|LimeLabelset count($columns = '*')
 * @method static CachedBuilder<static>|LimeLabelset disableCache()
 * @method static CachedBuilder<static>|LimeLabelset disableModelCaching()
 * @method static CachedBuilder<static>|LimeLabelset exists()
 * @method static CachedBuilder<static>|LimeLabelset flushCache(array $tags = [])
 * @method static CachedBuilder<static>|LimeLabelset getModelCacheCooldown(Model $instance)
 * @method static CachedBuilder<static>|LimeLabelset inRandomOrder($seed = '')
 * @method static CachedBuilder<static>|LimeLabelset insert(array $values)
 * @method static CachedBuilder<static>|LimeLabelset isCachable()
 * @method static CachedBuilder<static>|LimeLabelset max($column)
 * @method static CachedBuilder<static>|LimeLabelset min($column)
 * @method static CachedBuilder<static>|LimeLabelset newModelQuery()
 * @method static CachedBuilder<static>|LimeLabelset newQuery()
 * @method static CachedBuilder<static>|LimeLabelset ofFilterData(AnswersFilterData $answersFilterData)
 * @method static CachedBuilder<static>|LimeLabelset query()
 * @method static CachedBuilder<static>|LimeLabelset sum($column)
 * @method static CachedBuilder<static>|LimeLabelset truncate()
 * @method static CachedBuilder<static>|LimeLabelset whereLabelName($value)
 * @method static CachedBuilder<static>|LimeLabelset whereLanguages($value)
 * @method static CachedBuilder<static>|LimeLabelset whereLid($value)
 * @method static CachedBuilder<static>|LimeLabelset withCacheCooldownSeconds(?int $seconds = null)
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

    /** @var array<int, string> */
    protected $fillable = [
        'label_name', 'languages',
    ];

    /** @var array<int, string> */
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
