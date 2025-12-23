<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use GeneaLabs\LaravelModelCaching\CachedBuilder;

/**
 * Modules\Limesurvey\Models\LimePermission
 *
 * @property int $id
 * @property string $entity
 * @property int $entity_id
 * @property int $uid
 * @property string $permission
 * @property int $create_p
 * @property int $read_p
 * @property int $update_p
 * @property int $delete_p
 * @property int $import_p
 * @property int $export_p
 *
 * @property-read \Modules\Quaeris\Models\Profile|null $creator
 * @property-read \Modules\Limesurvey\Models\Extra|null $extra
 * @property-read \Modules\Quaeris\Models\Profile|null $updater
 *
 * @method static CachedBuilder<static>|LimePermission all($columns = [])
 * @method static CachedBuilder<static>|LimePermission avg($column)
 * @method static CachedBuilder<static>|LimePermission cache(array $tags = [])
 * @method static CachedBuilder<static>|LimePermission cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder<static>|LimePermission count($columns = '*')
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimePermission disableCache()
 * @method static CachedBuilder<static>|LimePermission disableModelCaching()
 * @method static CachedBuilder<static>|LimePermission exists()
 * @method static CachedBuilder<static>|LimePermission flushCache(array $tags = [])
 * @method static CachedBuilder<static>|LimePermission getModelCacheCooldown(\Illuminate\Database\Eloquent\Model $instance)
 * @method static CachedBuilder<static>|LimePermission inRandomOrder($seed = '')
 * @method static CachedBuilder<static>|LimePermission insert(array $values)
 * @method static CachedBuilder<static>|LimePermission isCachable()
 * @method static CachedBuilder<static>|LimePermission max($column)
 * @method static CachedBuilder<static>|LimePermission min($column)
 * @method static CachedBuilder<static>|LimePermission newModelQuery()
 * @method static CachedBuilder<static>|LimePermission newQuery()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimePermission ofFilterData(\Modules\Quaeris\Datas\AnswersFilterData $answersFilterData)
 * @method static CachedBuilder<static>|LimePermission query()
 * @method static CachedBuilder<static>|LimePermission sum($column)
 * @method static CachedBuilder<static>|LimePermission truncate()
 * @method static CachedBuilder<static>|LimePermission whereCreateP($value)
 * @method static CachedBuilder<static>|LimePermission whereDeleteP($value)
 * @method static CachedBuilder<static>|LimePermission whereEntity($value)
 * @method static CachedBuilder<static>|LimePermission whereEntityId($value)
 * @method static CachedBuilder<static>|LimePermission whereExportP($value)
 * @method static CachedBuilder<static>|LimePermission whereId($value)
 * @method static CachedBuilder<static>|LimePermission whereImportP($value)
 * @method static CachedBuilder<static>|LimePermission wherePermission($value)
 * @method static CachedBuilder<static>|LimePermission whereReadP($value)
 * @method static CachedBuilder<static>|LimePermission whereUid($value)
 * @method static CachedBuilder<static>|LimePermission whereUpdateP($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimePermission withCacheCooldownSeconds(?int $seconds = null)
 *
 * @mixin \Eloquent
 */
class LimePermission extends BaseModel
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_permissions';

    /** @var string */
    protected $primaryKey = 'id';

    /** @var array<int, string> */
    protected $fillable = [
        'entity', 'entity_id', 'uid', 'permission', 'create_p', 'read_p', 'update_p', 'delete_p', 'import_p', 'export_p',
    ];

    /** @var array<int, string> */
    protected $hidden = [
    ];

    /** @return array<string, string>     */
    protected $casts = [
        'id' => 'int', 'entity' => 'string', 'entity_id' => 'int', 'uid' => 'int', 'permission' => 'string', 'create_p' => 'int', 'read_p' => 'int', 'update_p' => 'int', 'delete_p' => 'int', 'import_p' => 'int', 'export_p' => 'int',
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
