<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use GeneaLabs\LaravelModelCaching\CachedBuilder;

/**
 * Modules\Limesurvey\Models\LimeQuotaMember
 *
 * @property int $id
 * @property int|null $sid
 * @property int|null $qid
 * @property int|null $quota_id
 * @property string|null $code
 * @property-read \Modules\Quaeris\Models\Profile|null $creator
 * @property-read \Modules\Limesurvey\Models\Extra|null $extra
 * @property-read \Modules\Quaeris\Models\Profile|null $updater
 * @method static CachedBuilder<static>|LimeQuotaMember all($columns = [])
 * @method static CachedBuilder<static>|LimeQuotaMember avg($column)
 * @method static CachedBuilder<static>|LimeQuotaMember cache(array $tags = [])
 * @method static CachedBuilder<static>|LimeQuotaMember cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder<static>|LimeQuotaMember count($columns = '*')
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeQuotaMember disableCache()
 * @method static CachedBuilder<static>|LimeQuotaMember disableModelCaching()
 * @method static CachedBuilder<static>|LimeQuotaMember exists()
 * @method static CachedBuilder<static>|LimeQuotaMember flushCache(array $tags = [])
 * @method static CachedBuilder<static>|LimeQuotaMember getModelCacheCooldown(\Illuminate\Database\Eloquent\Model $instance)
 * @method static CachedBuilder<static>|LimeQuotaMember inRandomOrder($seed = '')
 * @method static CachedBuilder<static>|LimeQuotaMember insert(array $values)
 * @method static CachedBuilder<static>|LimeQuotaMember isCachable()
 * @method static CachedBuilder<static>|LimeQuotaMember max($column)
 * @method static CachedBuilder<static>|LimeQuotaMember min($column)
 * @method static CachedBuilder<static>|LimeQuotaMember newModelQuery()
 * @method static CachedBuilder<static>|LimeQuotaMember newQuery()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeQuotaMember ofFilterData(\Modules\Quaeris\Datas\AnswersFilterData $answersFilterData)
 * @method static CachedBuilder<static>|LimeQuotaMember query()
 * @method static CachedBuilder<static>|LimeQuotaMember sum($column)
 * @method static CachedBuilder<static>|LimeQuotaMember truncate()
 * @method static CachedBuilder<static>|LimeQuotaMember whereCode($value)
 * @method static CachedBuilder<static>|LimeQuotaMember whereId($value)
 * @method static CachedBuilder<static>|LimeQuotaMember whereQid($value)
 * @method static CachedBuilder<static>|LimeQuotaMember whereQuotaId($value)
 * @method static CachedBuilder<static>|LimeQuotaMember whereSid($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeQuotaMember withCacheCooldownSeconds(?int $seconds = null)
 * @mixin \Eloquent
 */
class LimeQuotaMember extends BaseModel
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_quota_members';

    /** @var string */
    protected $primaryKey = 'id';

    /** @var array<int, string> */
    protected $fillable = [
        'sid', 'qid', 'quota_id', 'code',
    ];

    /** @var array<int, string> */
    protected $hidden = [
    ];

    /** @return array<string, string>     */
    protected $casts = [
        'id' => 'int', 'sid' => 'int', 'qid' => 'int', 'quota_id' => 'int', 'code' => 'string',
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
