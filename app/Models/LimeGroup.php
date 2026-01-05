<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use GeneaLabs\LaravelModelCaching\CachedBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Modules\Quaeris\Datas\AnswersFilterData;
use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeGroup
 *
 * @property int $gid
 * @property int $sid
 * @property int $group_order
 * @property string $randomization_group
 * @property string|null $grelevance
 *
 * @property-read Profile|null $creator
 * @property-read Extra|null $extra
 * @property-read string $group_name
 * @property-read LimeGroupL10n|null $labels
 * @property-read Profile|null $updater
 *
 * @method static CachedBuilder|LimeGroup all($columns = [])
 * @method static CachedBuilder|LimeGroup avg($column)
 * @method static CachedBuilder|LimeGroup cache(array $tags = [])
 * @method static CachedBuilder|LimeGroup cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder|LimeGroup count($columns = '*')
 * @method static CachedBuilder|LimeGroup disableCache()
 * @method static CachedBuilder|LimeGroup disableModelCaching()
 * @method static CachedBuilder|LimeGroup exists()
 * @method static CachedBuilder|LimeGroup flushCache(array $tags = [])
 * @method static CachedBuilder|LimeGroup getModelCacheCooldown(Model $instance)
 * @method static CachedBuilder|LimeGroup inRandomOrder($seed = '')
 * @method static CachedBuilder|LimeGroup insert(array $values)
 * @method static CachedBuilder|LimeGroup isCachable()
 * @method static CachedBuilder|LimeGroup max($column)
 * @method static CachedBuilder|LimeGroup min($column)
 * @method static CachedBuilder|LimeGroup newModelQuery()
 * @method static CachedBuilder|LimeGroup newQuery()
 * @method static CachedBuilder|LimeGroup ofFilterData(AnswersFilterData $answersFilterData)
 * @method static CachedBuilder|LimeGroup query()
 * @method static CachedBuilder|LimeGroup sum($column)
 * @method static CachedBuilder|LimeGroup truncate()
 * @method static CachedBuilder|LimeGroup whereGid($value)
 * @method static CachedBuilder|LimeGroup whereGrelevance($value)
 * @method static CachedBuilder|LimeGroup whereGroupOrder($value)
 * @method static CachedBuilder|LimeGroup whereRandomizationGroup($value)
 * @method static CachedBuilder|LimeGroup whereSid($value)
 * @method static CachedBuilder|LimeGroup withCacheCooldownSeconds(?int $seconds = null)
 *
 * @mixin \Eloquent
 */
class LimeGroup extends BaseModel
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_groups';

    /** @var string */
    protected $primaryKey = 'gid';

    /** @var list<string> */
    protected $fillable = [
        'language', 'sid', 'group_name', 'group_order', 'description', 'randomization_group', 'grelevance',
    ];

    /** @var list<string> */
    protected $hidden = [
    ];

    /** @return array<string, string>     */
    protected $casts = [
        'gid' => 'int', 'language' => 'string', 'sid' => 'int', 'group_name' => 'string', 'group_order' => 'int', 'description' => 'string', 'randomization_group' => 'string', 'grelevance' => 'string',
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
    public function labels(): HasOne
    {
        return $this->hasOne(LimeGroupL10n::class, 'gid', 'gid')
            ->where('language', app()->getLocale());
    }

    // Mutators

    public function getGroupNameAttribute(): string
    {
        return $this->labels->group_name;
    }
}
