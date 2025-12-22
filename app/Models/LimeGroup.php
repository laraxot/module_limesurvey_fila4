<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use GeneaLabs\LaravelModelCaching\CachedBuilder;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Modules\Limesurvey\Models\LimeGroup
 *
 * @property int $gid
 * @property int $sid
 * @property int $group_order
 * @property string $randomization_group
 * @property string|null $grelevance
 *
 * @property-read \Modules\Quaeris\Models\Profile|null $creator
 * @property-read \Modules\Limesurvey\Models\Extra|null $extra
 * @property-read string $group_name
 * @property-read \Modules\Limesurvey\Models\LimeGroupL10n|null $labels
 * @property-read \Modules\Quaeris\Models\Profile|null $updater
 *
 * @method static CachedBuilder<static>|LimeGroup all($columns = [])
 * @method static CachedBuilder<static>|LimeGroup avg($column)
 * @method static CachedBuilder<static>|LimeGroup cache(array $tags = [])
 * @method static CachedBuilder<static>|LimeGroup cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder<static>|LimeGroup count($columns = '*')
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeGroup disableCache()
 * @method static CachedBuilder<static>|LimeGroup disableModelCaching()
 * @method static CachedBuilder<static>|LimeGroup exists()
 * @method static CachedBuilder<static>|LimeGroup flushCache(array $tags = [])
 * @method static CachedBuilder<static>|LimeGroup getModelCacheCooldown(\Illuminate\Database\Eloquent\Model $instance)
 * @method static CachedBuilder<static>|LimeGroup inRandomOrder($seed = '')
 * @method static CachedBuilder<static>|LimeGroup insert(array $values)
 * @method static CachedBuilder<static>|LimeGroup isCachable()
 * @method static CachedBuilder<static>|LimeGroup max($column)
 * @method static CachedBuilder<static>|LimeGroup min($column)
 * @method static CachedBuilder<static>|LimeGroup newModelQuery()
 * @method static CachedBuilder<static>|LimeGroup newQuery()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeGroup ofFilterData(\Modules\Quaeris\Datas\AnswersFilterData $answersFilterData)
 * @method static CachedBuilder<static>|LimeGroup query()
 * @method static CachedBuilder<static>|LimeGroup sum($column)
 * @method static CachedBuilder<static>|LimeGroup truncate()
 * @method static CachedBuilder<static>|LimeGroup whereGid($value)
 * @method static CachedBuilder<static>|LimeGroup whereGrelevance($value)
 * @method static CachedBuilder<static>|LimeGroup whereGroupOrder($value)
 * @method static CachedBuilder<static>|LimeGroup whereRandomizationGroup($value)
 * @method static CachedBuilder<static>|LimeGroup whereSid($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeGroup withCacheCooldownSeconds(?int $seconds = null)
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

    /** @var array<int, string> */
    protected $fillable = [
        'language', 'sid', 'group_name', 'group_order', 'description', 'randomization_group', 'grelevance',
    ];

    /** @var array<int, string> */
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
