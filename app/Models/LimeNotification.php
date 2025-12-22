<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use GeneaLabs\LaravelModelCaching\CachedBuilder;
use Illuminate\Support\Carbon;

/**
 * Modules\Limesurvey\Models\LimeNotification
 *
 * @property int $id
 * @property string $entity
 * @property int $entity_id
 * @property string $title
 * @property string $message
 * @property string $status
 * @property int $importance
 * @property string|null $display_class
 * @property string|null $hash
 * @property Carbon|null $created
 * @property Carbon|null $first_read
 *
 * @property-read \Modules\Quaeris\Models\Profile|null $creator
 * @property-read \Modules\Limesurvey\Models\Extra|null $extra
 * @property-read \Modules\Quaeris\Models\Profile|null $updater
 *
 * @method static CachedBuilder<static>|LimeNotification all($columns = [])
 * @method static CachedBuilder<static>|LimeNotification avg($column)
 * @method static CachedBuilder<static>|LimeNotification cache(array $tags = [])
 * @method static CachedBuilder<static>|LimeNotification cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder<static>|LimeNotification count($columns = '*')
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeNotification disableCache()
 * @method static CachedBuilder<static>|LimeNotification disableModelCaching()
 * @method static CachedBuilder<static>|LimeNotification exists()
 * @method static CachedBuilder<static>|LimeNotification flushCache(array $tags = [])
 * @method static CachedBuilder<static>|LimeNotification getModelCacheCooldown(\Illuminate\Database\Eloquent\Model $instance)
 * @method static CachedBuilder<static>|LimeNotification inRandomOrder($seed = '')
 * @method static CachedBuilder<static>|LimeNotification insert(array $values)
 * @method static CachedBuilder<static>|LimeNotification isCachable()
 * @method static CachedBuilder<static>|LimeNotification max($column)
 * @method static CachedBuilder<static>|LimeNotification min($column)
 * @method static CachedBuilder<static>|LimeNotification newModelQuery()
 * @method static CachedBuilder<static>|LimeNotification newQuery()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeNotification ofFilterData(\Modules\Quaeris\Datas\AnswersFilterData $answersFilterData)
 * @method static CachedBuilder<static>|LimeNotification query()
 * @method static CachedBuilder<static>|LimeNotification sum($column)
 * @method static CachedBuilder<static>|LimeNotification truncate()
 * @method static CachedBuilder<static>|LimeNotification whereCreated($value)
 * @method static CachedBuilder<static>|LimeNotification whereDisplayClass($value)
 * @method static CachedBuilder<static>|LimeNotification whereEntity($value)
 * @method static CachedBuilder<static>|LimeNotification whereEntityId($value)
 * @method static CachedBuilder<static>|LimeNotification whereFirstRead($value)
 * @method static CachedBuilder<static>|LimeNotification whereHash($value)
 * @method static CachedBuilder<static>|LimeNotification whereId($value)
 * @method static CachedBuilder<static>|LimeNotification whereImportance($value)
 * @method static CachedBuilder<static>|LimeNotification whereMessage($value)
 * @method static CachedBuilder<static>|LimeNotification whereStatus($value)
 * @method static CachedBuilder<static>|LimeNotification whereTitle($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeNotification withCacheCooldownSeconds(?int $seconds = null)
 *
 * @mixin \Eloquent
 */
class LimeNotification extends BaseModel
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_notifications';

    /** @var string */
    protected $primaryKey = 'id';

    /** @var array<int, string> */
    protected $fillable = [
        'entity', 'entity_id', 'title', 'message', 'status', 'importance', 'display_class', 'hash', 'created', 'first_read',
    ];

    /** @var array<int, string> */
    protected $hidden = [
    ];

    /** @return array<string, string>     */
    protected $casts = [
        'id' => 'int', 'entity' => 'string', 'entity_id' => 'int', 'title' => 'string', 'message' => 'string', 'status' => 'string', 'importance' => 'int', 'display_class' => 'string', 'hash' => 'string', 'created' => 'datetime', 'first_read' => 'datetime',
    ];

    // Scopes...

    // Functions ...

    // Relations ...
}
