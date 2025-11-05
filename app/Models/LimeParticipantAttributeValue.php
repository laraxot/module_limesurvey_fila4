<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use GeneaLabs\LaravelModelCaching\CachedBuilder;

/**
 * Modules\Limesurvey\Models\LimeParticipantAttributeValue
 *
 * @property int $value_id
 * @property int $attribute_id
 * @property string $value
 * @property-read \Modules\Quaeris\Models\Profile|null $creator
 * @property-read \Modules\Limesurvey\Models\Extra|null $extra
 * @property-read \Modules\Quaeris\Models\Profile|null $updater
 * @method static CachedBuilder<static>|LimeParticipantAttributeValue all($columns = [])
 * @method static CachedBuilder<static>|LimeParticipantAttributeValue avg($column)
 * @method static CachedBuilder<static>|LimeParticipantAttributeValue cache(array $tags = [])
 * @method static CachedBuilder<static>|LimeParticipantAttributeValue cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder<static>|LimeParticipantAttributeValue count($columns = '*')
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeParticipantAttributeValue disableCache()
 * @method static CachedBuilder<static>|LimeParticipantAttributeValue disableModelCaching()
 * @method static CachedBuilder<static>|LimeParticipantAttributeValue exists()
 * @method static CachedBuilder<static>|LimeParticipantAttributeValue flushCache(array $tags = [])
 * @method static CachedBuilder<static>|LimeParticipantAttributeValue getModelCacheCooldown(\Illuminate\Database\Eloquent\Model $instance)
 * @method static CachedBuilder<static>|LimeParticipantAttributeValue inRandomOrder($seed = '')
 * @method static CachedBuilder<static>|LimeParticipantAttributeValue insert(array $values)
 * @method static CachedBuilder<static>|LimeParticipantAttributeValue isCachable()
 * @method static CachedBuilder<static>|LimeParticipantAttributeValue max($column)
 * @method static CachedBuilder<static>|LimeParticipantAttributeValue min($column)
 * @method static CachedBuilder<static>|LimeParticipantAttributeValue newModelQuery()
 * @method static CachedBuilder<static>|LimeParticipantAttributeValue newQuery()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeParticipantAttributeValue ofFilterData(\Modules\Quaeris\Datas\AnswersFilterData $answersFilterData)
 * @method static CachedBuilder<static>|LimeParticipantAttributeValue query()
 * @method static CachedBuilder<static>|LimeParticipantAttributeValue sum($column)
 * @method static CachedBuilder<static>|LimeParticipantAttributeValue truncate()
 * @method static CachedBuilder<static>|LimeParticipantAttributeValue whereAttributeId($value)
 * @method static CachedBuilder<static>|LimeParticipantAttributeValue whereValue($value)
 * @method static CachedBuilder<static>|LimeParticipantAttributeValue whereValueId($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeParticipantAttributeValue withCacheCooldownSeconds(?int $seconds = null)
 * @mixin \Eloquent
 */
class LimeParticipantAttributeValue extends BaseModel
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_participant_attribute_values';

    /** @var string */
    protected $primaryKey = 'value_id';

    /** @var array<int, string> */
    protected $fillable = [
        'attribute_id', 'value',
    ];

    /** @var array<int, string> */
    protected $hidden = [
    ];

    /** @return array<string, string>     */
    protected $casts = [
        'value_id' => 'int', 'attribute_id' => 'int', 'value' => 'string',
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
