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
 * @method static CachedBuilder|LimeParticipantAttribute all($columns = [])
 * @method static CachedBuilder|LimeParticipantAttribute avg($column)
 * @method static CachedBuilder|LimeParticipantAttribute cache(array $tags = [])
 * @method static CachedBuilder|LimeParticipantAttribute cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder|LimeParticipantAttribute count($columns = '*')
 * @method static CachedBuilder|LimeParticipantAttribute disableCache()
 * @method static CachedBuilder|LimeParticipantAttribute disableModelCaching()
 * @method static CachedBuilder|LimeParticipantAttribute exists()
 * @method static CachedBuilder|LimeParticipantAttribute flushCache(array $tags = [])
 * @method static CachedBuilder|LimeParticipantAttribute getModelCacheCooldown(Model $instance)
 * @method static CachedBuilder|LimeParticipantAttribute inRandomOrder($seed = '')
 * @method static CachedBuilder|LimeParticipantAttribute insert(array $values)
 * @method static CachedBuilder|LimeParticipantAttribute isCachable()
 * @method static CachedBuilder|LimeParticipantAttribute max($column)
 * @method static CachedBuilder|LimeParticipantAttribute min($column)
 * @method static CachedBuilder|LimeParticipantAttribute newModelQuery()
 * @method static CachedBuilder|LimeParticipantAttribute newQuery()
 * @method static CachedBuilder|LimeParticipantAttribute ofFilterData(AnswersFilterData $answersFilterData)
 * @method static CachedBuilder|LimeParticipantAttribute query()
 * @method static CachedBuilder|LimeParticipantAttribute sum($column)
 * @method static CachedBuilder|LimeParticipantAttribute truncate()
 * @method static CachedBuilder|LimeParticipantAttribute whereAttributeId($value)
 * @method static CachedBuilder|LimeParticipantAttribute whereParticipantId($value)
 * @method static CachedBuilder|LimeParticipantAttribute whereValue($value)
 * @method static CachedBuilder|LimeParticipantAttribute withCacheCooldownSeconds(?int $seconds = null)
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

    /** @var list<string> */
    protected $fillable = [
        'attribute_id', 'value',
    ];

    /** @var list<string> */
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
