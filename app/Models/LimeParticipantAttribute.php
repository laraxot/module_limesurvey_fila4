<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use GeneaLabs\LaravelModelCaching\CachedBuilder;
use Illuminate\Database\Eloquent\Model;
use Modules\Quaeris\Datas\AnswersFilterData;
use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeParticipantAttribute
 *
 * @property string $participant_id
 * @property int $attribute_id
 * @property string $value
 *
 * @property-read Profile|null $creator
 * @property-read Extra|null $extra
 * @property-read Profile|null $updater
 *
 * @method static CachedBuilder<static>|LimeParticipantAttribute all($columns = [])
 * @method static CachedBuilder<static>|LimeParticipantAttribute avg($column)
 * @method static CachedBuilder<static>|LimeParticipantAttribute cache(array $tags = [])
 * @method static CachedBuilder<static>|LimeParticipantAttribute cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder<static>|LimeParticipantAttribute count($columns = '*')
 * @method static CachedBuilder<static>|LimeParticipantAttribute disableCache()
 * @method static CachedBuilder<static>|LimeParticipantAttribute disableModelCaching()
 * @method static CachedBuilder<static>|LimeParticipantAttribute exists()
 * @method static CachedBuilder<static>|LimeParticipantAttribute flushCache(array $tags = [])
 * @method static CachedBuilder<static>|LimeParticipantAttribute getModelCacheCooldown(Model $instance)
 * @method static CachedBuilder<static>|LimeParticipantAttribute inRandomOrder($seed = '')
 * @method static CachedBuilder<static>|LimeParticipantAttribute insert(array $values)
 * @method static CachedBuilder<static>|LimeParticipantAttribute isCachable()
 * @method static CachedBuilder<static>|LimeParticipantAttribute max($column)
 * @method static CachedBuilder<static>|LimeParticipantAttribute min($column)
 * @method static CachedBuilder<static>|LimeParticipantAttribute newModelQuery()
 * @method static CachedBuilder<static>|LimeParticipantAttribute newQuery()
 * @method static CachedBuilder<static>|LimeParticipantAttribute ofFilterData(AnswersFilterData $answersFilterData)
 * @method static CachedBuilder<static>|LimeParticipantAttribute query()
 * @method static CachedBuilder<static>|LimeParticipantAttribute sum($column)
 * @method static CachedBuilder<static>|LimeParticipantAttribute truncate()
 * @method static CachedBuilder<static>|LimeParticipantAttribute whereAttributeId($value)
 * @method static CachedBuilder<static>|LimeParticipantAttribute whereParticipantId($value)
 * @method static CachedBuilder<static>|LimeParticipantAttribute whereValue($value)
 * @method static CachedBuilder<static>|LimeParticipantAttribute withCacheCooldownSeconds(?int $seconds = null)
 *
 * @mixin \Eloquent
 */
class LimeParticipantAttribute extends BaseModel
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_participant_attribute';

    /** @var string */
    protected $primaryKey = 'participant_id';

    /** @var array<int, string> */
    protected $fillable = [
        'attribute_id', 'value',
    ];

    /** @var array<int, string> */
    protected $hidden = [
    ];

    /** @return array<string, string>     */
    protected $casts = [
        'participant_id' => 'string', 'attribute_id' => 'int', 'value' => 'string',
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
