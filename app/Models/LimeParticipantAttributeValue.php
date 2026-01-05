<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use GeneaLabs\LaravelModelCaching\CachedBuilder;
use Illuminate\Database\Eloquent\Model;
use Modules\Quaeris\Datas\AnswersFilterData;
use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeParticipantAttributeValue
 *
 * @property int $value_id
 * @property int $attribute_id
 * @property string $value
 *
 * @property-read Profile|null $creator
 * @property-read Extra|null $extra
 * @property-read Profile|null $updater
 *
 * @method static CachedBuilder|LimeParticipantAttributeValue all($columns = [])
 * @method static CachedBuilder|LimeParticipantAttributeValue avg($column)
 * @method static CachedBuilder|LimeParticipantAttributeValue cache(array $tags = [])
 * @method static CachedBuilder|LimeParticipantAttributeValue cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder|LimeParticipantAttributeValue count($columns = '*')
 * @method static CachedBuilder|LimeParticipantAttributeValue disableCache()
 * @method static CachedBuilder|LimeParticipantAttributeValue disableModelCaching()
 * @method static CachedBuilder|LimeParticipantAttributeValue exists()
 * @method static CachedBuilder|LimeParticipantAttributeValue flushCache(array $tags = [])
 * @method static CachedBuilder|LimeParticipantAttributeValue getModelCacheCooldown(Model $instance)
 * @method static CachedBuilder|LimeParticipantAttributeValue inRandomOrder($seed = '')
 * @method static CachedBuilder|LimeParticipantAttributeValue insert(array $values)
 * @method static CachedBuilder|LimeParticipantAttributeValue isCachable()
 * @method static CachedBuilder|LimeParticipantAttributeValue max($column)
 * @method static CachedBuilder|LimeParticipantAttributeValue min($column)
 * @method static CachedBuilder|LimeParticipantAttributeValue newModelQuery()
 * @method static CachedBuilder|LimeParticipantAttributeValue newQuery()
 * @method static CachedBuilder|LimeParticipantAttributeValue ofFilterData(AnswersFilterData $answersFilterData)
 * @method static CachedBuilder|LimeParticipantAttributeValue query()
 * @method static CachedBuilder|LimeParticipantAttributeValue sum($column)
 * @method static CachedBuilder|LimeParticipantAttributeValue truncate()
 * @method static CachedBuilder|LimeParticipantAttributeValue whereAttributeId($value)
 * @method static CachedBuilder|LimeParticipantAttributeValue whereValue($value)
 * @method static CachedBuilder|LimeParticipantAttributeValue whereValueId($value)
 * @method static CachedBuilder|LimeParticipantAttributeValue withCacheCooldownSeconds(?int $seconds = null)
 *
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

    /** @var list<string> */
    protected $fillable = [
        'attribute_id', 'value',
    ];

    /** @var list<string> */
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
