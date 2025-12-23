<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use GeneaLabs\LaravelModelCaching\CachedBuilder;

/**
 * Modules\Limesurvey\Models\LimeQuotaLanguagesetting
 *
 * @property int $quotals_id
 * @property int $quotals_quota_id
 * @property string $quotals_language
 * @property string|null $quotals_name
 * @property string $quotals_message
 * @property string|null $quotals_url
 * @property string|null $quotals_urldescrip
 *
 * @property-read \Modules\Quaeris\Models\Profile|null $creator
 * @property-read \Modules\Limesurvey\Models\Extra|null $extra
 * @property-read \Modules\Quaeris\Models\Profile|null $updater
 *
 * @method static CachedBuilder<static>|LimeQuotaLanguagesetting all($columns = [])
 * @method static CachedBuilder<static>|LimeQuotaLanguagesetting avg($column)
 * @method static CachedBuilder<static>|LimeQuotaLanguagesetting cache(array $tags = [])
 * @method static CachedBuilder<static>|LimeQuotaLanguagesetting cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder<static>|LimeQuotaLanguagesetting count($columns = '*')
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeQuotaLanguagesetting disableCache()
 * @method static CachedBuilder<static>|LimeQuotaLanguagesetting disableModelCaching()
 * @method static CachedBuilder<static>|LimeQuotaLanguagesetting exists()
 * @method static CachedBuilder<static>|LimeQuotaLanguagesetting flushCache(array $tags = [])
 * @method static CachedBuilder<static>|LimeQuotaLanguagesetting getModelCacheCooldown(\Illuminate\Database\Eloquent\Model $instance)
 * @method static CachedBuilder<static>|LimeQuotaLanguagesetting inRandomOrder($seed = '')
 * @method static CachedBuilder<static>|LimeQuotaLanguagesetting insert(array $values)
 * @method static CachedBuilder<static>|LimeQuotaLanguagesetting isCachable()
 * @method static CachedBuilder<static>|LimeQuotaLanguagesetting max($column)
 * @method static CachedBuilder<static>|LimeQuotaLanguagesetting min($column)
 * @method static CachedBuilder<static>|LimeQuotaLanguagesetting newModelQuery()
 * @method static CachedBuilder<static>|LimeQuotaLanguagesetting newQuery()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeQuotaLanguagesetting ofFilterData(\Modules\Quaeris\Datas\AnswersFilterData $answersFilterData)
 * @method static CachedBuilder<static>|LimeQuotaLanguagesetting query()
 * @method static CachedBuilder<static>|LimeQuotaLanguagesetting sum($column)
 * @method static CachedBuilder<static>|LimeQuotaLanguagesetting truncate()
 * @method static CachedBuilder<static>|LimeQuotaLanguagesetting whereQuotalsId($value)
 * @method static CachedBuilder<static>|LimeQuotaLanguagesetting whereQuotalsLanguage($value)
 * @method static CachedBuilder<static>|LimeQuotaLanguagesetting whereQuotalsMessage($value)
 * @method static CachedBuilder<static>|LimeQuotaLanguagesetting whereQuotalsName($value)
 * @method static CachedBuilder<static>|LimeQuotaLanguagesetting whereQuotalsQuotaId($value)
 * @method static CachedBuilder<static>|LimeQuotaLanguagesetting whereQuotalsUrl($value)
 * @method static CachedBuilder<static>|LimeQuotaLanguagesetting whereQuotalsUrldescrip($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeQuotaLanguagesetting withCacheCooldownSeconds(?int $seconds = null)
 *
 * @mixin \Eloquent
 */
class LimeQuotaLanguagesetting extends BaseModel
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_quota_languagesettings';

    /** @var string */
    protected $primaryKey = 'quotals_id';

    /** @var array<int, string> */
    protected $fillable = [
        'quotals_quota_id', 'quotals_language', 'quotals_name', 'quotals_message', 'quotals_url', 'quotals_urldescrip',
    ];

    /** @var array<int, string> */
    protected $hidden = [
    ];

    /** @return array<string, string>     */
    protected $casts = [
        'quotals_id' => 'int', 'quotals_quota_id' => 'int', 'quotals_language' => 'string', 'quotals_name' => 'string', 'quotals_message' => 'string', 'quotals_url' => 'string', 'quotals_urldescrip' => 'string',
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
