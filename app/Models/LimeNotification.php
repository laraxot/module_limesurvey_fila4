<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use GeneaLabs\LaravelModelCaching\CachedBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Modules\Quaeris\Datas\AnswersFilterData;
use Modules\Quaeris\Models\Profile;

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
 * @property-read Profile|null $creator
 * @property-read Extra|null $extra
 * @property-read Profile|null $updater
 *
 * @method static CachedBuilder|LimeNotification all($columns = [])
 * @method static CachedBuilder|LimeNotification avg($column)
 * @method static CachedBuilder|LimeNotification cache(array $tags = [])
 * @method static CachedBuilder|LimeNotification cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder|LimeNotification count($columns = '*')
 * @method static CachedBuilder|LimeNotification disableCache()
 * @method static CachedBuilder|LimeNotification disableModelCaching()
 * @method static CachedBuilder|LimeNotification exists()
 * @method static CachedBuilder|LimeNotification flushCache(array $tags = [])
 * @method static CachedBuilder|LimeNotification getModelCacheCooldown(Model $instance)
 * @method static CachedBuilder|LimeNotification inRandomOrder($seed = '')
 * @method static CachedBuilder|LimeNotification insert(array $values)
 * @method static CachedBuilder|LimeNotification isCachable()
 * @method static CachedBuilder|LimeNotification max($column)
 * @method static CachedBuilder|LimeNotification min($column)
 * @method static CachedBuilder|LimeNotification newModelQuery()
 * @method static CachedBuilder|LimeNotification newQuery()
 * @method static CachedBuilder|LimeNotification ofFilterData(AnswersFilterData $answersFilterData)
 * @method static CachedBuilder|LimeNotification query()
 * @method static CachedBuilder|LimeNotification sum($column)
 * @method static CachedBuilder|LimeNotification truncate()
 * @method static CachedBuilder|LimeNotification whereCreated($value)
 * @method static CachedBuilder|LimeNotification whereDisplayClass($value)
 * @method static CachedBuilder|LimeNotification whereEntity($value)
 * @method static CachedBuilder|LimeNotification whereEntityId($value)
 * @method static CachedBuilder|LimeNotification whereFirstRead($value)
 * @method static CachedBuilder|LimeNotification whereHash($value)
 * @method static CachedBuilder|LimeNotification whereId($value)
 * @method static CachedBuilder|LimeNotification whereImportance($value)
 * @method static CachedBuilder|LimeNotification whereMessage($value)
 * @method static CachedBuilder|LimeNotification whereStatus($value)
 * @method static CachedBuilder|LimeNotification whereTitle($value)
 * @method static CachedBuilder|LimeNotification withCacheCooldownSeconds(?int $seconds = null)
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

    /** @var list<string> */
    protected $fillable = [
        'entity', 'entity_id', 'title', 'message', 'status', 'importance', 'display_class', 'hash', 'created', 'first_read',
    ];

    /** @var list<string> */
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
