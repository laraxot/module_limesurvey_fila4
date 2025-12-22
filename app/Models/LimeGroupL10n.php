<?php

declare(strict_types=1);

/**
 * Created by Reliese Model.
 */

namespace Modules\Limesurvey\Models;

use GeneaLabs\LaravelModelCaching\CachedBuilder;

/**
 * Modules\Limesurvey\Models\LimeGroupL10n
 *
 * @property int $id
 * @property int $gid
 * @property string $group_name
 * @property string|null $description
 * @property string $language
 *
 * @property-read \Modules\Quaeris\Models\Profile|null $creator
 * @property-read \Modules\Limesurvey\Models\Extra|null $extra
 * @property-read \Modules\Quaeris\Models\Profile|null $updater
 *
 * @method static CachedBuilder<static>|LimeGroupL10n all($columns = [])
 * @method static CachedBuilder<static>|LimeGroupL10n avg($column)
 * @method static CachedBuilder<static>|LimeGroupL10n cache(array $tags = [])
 * @method static CachedBuilder<static>|LimeGroupL10n cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder<static>|LimeGroupL10n count($columns = '*')
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeGroupL10n disableCache()
 * @method static CachedBuilder<static>|LimeGroupL10n disableModelCaching()
 * @method static CachedBuilder<static>|LimeGroupL10n exists()
 * @method static CachedBuilder<static>|LimeGroupL10n flushCache(array $tags = [])
 * @method static CachedBuilder<static>|LimeGroupL10n getModelCacheCooldown(\Illuminate\Database\Eloquent\Model $instance)
 * @method static CachedBuilder<static>|LimeGroupL10n inRandomOrder($seed = '')
 * @method static CachedBuilder<static>|LimeGroupL10n insert(array $values)
 * @method static CachedBuilder<static>|LimeGroupL10n isCachable()
 * @method static CachedBuilder<static>|LimeGroupL10n max($column)
 * @method static CachedBuilder<static>|LimeGroupL10n min($column)
 * @method static CachedBuilder<static>|LimeGroupL10n newModelQuery()
 * @method static CachedBuilder<static>|LimeGroupL10n newQuery()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeGroupL10n ofFilterData(\Modules\Quaeris\Datas\AnswersFilterData $answersFilterData)
 * @method static CachedBuilder<static>|LimeGroupL10n query()
 * @method static CachedBuilder<static>|LimeGroupL10n sum($column)
 * @method static CachedBuilder<static>|LimeGroupL10n truncate()
 * @method static CachedBuilder<static>|LimeGroupL10n whereDescription($value)
 * @method static CachedBuilder<static>|LimeGroupL10n whereGid($value)
 * @method static CachedBuilder<static>|LimeGroupL10n whereGroupName($value)
 * @method static CachedBuilder<static>|LimeGroupL10n whereId($value)
 * @method static CachedBuilder<static>|LimeGroupL10n whereLanguage($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeGroupL10n withCacheCooldownSeconds(?int $seconds = null)
 *
 * @mixin \Eloquent
 */
class LimeGroupL10n extends BaseModel
{
    public $timestamps = false;

    protected $table = 'lime_group_l10ns';

    protected $casts = [
        'gid' => 'int',
    ];

    protected $fillable = [
        'gid',
        'group_name',
        'description',
        'language',
    ];
}
