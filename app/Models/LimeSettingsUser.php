<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use GeneaLabs\LaravelModelCaching\CachedBuilder;

/**
 * Modules\Limesurvey\Models\LimeSettingsUser
 *
 * @property int $id
 * @property int $uid
 * @property string|null $entity
 * @property string|null $entity_id
 * @property string $stg_name
 * @property string|null $stg_value
 * @property-read \Modules\Quaeris\Models\Profile|null $creator
 * @property-read \Modules\Limesurvey\Models\Extra|null $extra
 * @property-read \Modules\Quaeris\Models\Profile|null $updater
 * @method static CachedBuilder<static>|LimeSettingsUser all($columns = [])
 * @method static CachedBuilder<static>|LimeSettingsUser avg($column)
 * @method static CachedBuilder<static>|LimeSettingsUser cache(array $tags = [])
 * @method static CachedBuilder<static>|LimeSettingsUser cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder<static>|LimeSettingsUser count($columns = '*')
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSettingsUser disableCache()
 * @method static CachedBuilder<static>|LimeSettingsUser disableModelCaching()
 * @method static CachedBuilder<static>|LimeSettingsUser exists()
 * @method static CachedBuilder<static>|LimeSettingsUser flushCache(array $tags = [])
 * @method static CachedBuilder<static>|LimeSettingsUser getModelCacheCooldown(\Illuminate\Database\Eloquent\Model $instance)
 * @method static CachedBuilder<static>|LimeSettingsUser inRandomOrder($seed = '')
 * @method static CachedBuilder<static>|LimeSettingsUser insert(array $values)
 * @method static CachedBuilder<static>|LimeSettingsUser isCachable()
 * @method static CachedBuilder<static>|LimeSettingsUser max($column)
 * @method static CachedBuilder<static>|LimeSettingsUser min($column)
 * @method static CachedBuilder<static>|LimeSettingsUser newModelQuery()
 * @method static CachedBuilder<static>|LimeSettingsUser newQuery()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSettingsUser ofFilterData(\Modules\Quaeris\Datas\AnswersFilterData $answersFilterData)
 * @method static CachedBuilder<static>|LimeSettingsUser query()
 * @method static CachedBuilder<static>|LimeSettingsUser sum($column)
 * @method static CachedBuilder<static>|LimeSettingsUser truncate()
 * @method static CachedBuilder<static>|LimeSettingsUser whereEntity($value)
 * @method static CachedBuilder<static>|LimeSettingsUser whereEntityId($value)
 * @method static CachedBuilder<static>|LimeSettingsUser whereId($value)
 * @method static CachedBuilder<static>|LimeSettingsUser whereStgName($value)
 * @method static CachedBuilder<static>|LimeSettingsUser whereStgValue($value)
 * @method static CachedBuilder<static>|LimeSettingsUser whereUid($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSettingsUser withCacheCooldownSeconds(?int $seconds = null)
 * @mixin \Eloquent
 */
class LimeSettingsUser extends BaseModel
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_settings_user';

    /** @var string */
    protected $primaryKey = 'id';

    /** @var array<int, string> */
    protected $fillable = [
        'uid', 'entity', 'entity_id', 'stg_name', 'stg_value',
    ];

    /** @var array<int, string> */
    protected $hidden = [
    ];

    /** @return array<string, string>     */
    protected $casts = [
        'id' => 'int', 'uid' => 'int', 'entity' => 'string', 'entity_id' => 'string', 'stg_name' => 'string', 'stg_value' => 'string',
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
