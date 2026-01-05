<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use GeneaLabs\LaravelModelCaching\CachedBuilder;
use Illuminate\Database\Eloquent\Model;
use Modules\Quaeris\Datas\AnswersFilterData;
use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeParticipantAttributeName
 *
 * @property int $attribute_id
 * @property string $attribute_type
 * @property string $defaultname
 * @property string $visible
 * @property string $encrypted
 * @property string $core_attribute
 *
 * @property-read Profile|null $creator
 * @property-read Extra|null $extra
 * @property-read Profile|null $updater
 *
 * @method static CachedBuilder<static>|LimeParticipantAttributeName all($columns = [])
 * @method static CachedBuilder<static>|LimeParticipantAttributeName avg($column)
 * @method static CachedBuilder<static>|LimeParticipantAttributeName cache(array $tags = [])
 * @method static CachedBuilder<static>|LimeParticipantAttributeName cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder<static>|LimeParticipantAttributeName count($columns = '*')
 * @method static CachedBuilder<static>|LimeParticipantAttributeName disableCache()
 * @method static CachedBuilder<static>|LimeParticipantAttributeName disableModelCaching()
 * @method static CachedBuilder<static>|LimeParticipantAttributeName exists()
 * @method static CachedBuilder<static>|LimeParticipantAttributeName flushCache(array $tags = [])
 * @method static CachedBuilder<static>|LimeParticipantAttributeName getModelCacheCooldown(Model $instance)
 * @method static CachedBuilder<static>|LimeParticipantAttributeName inRandomOrder($seed = '')
 * @method static CachedBuilder<static>|LimeParticipantAttributeName insert(array $values)
 * @method static CachedBuilder<static>|LimeParticipantAttributeName isCachable()
 * @method static CachedBuilder<static>|LimeParticipantAttributeName max($column)
 * @method static CachedBuilder<static>|LimeParticipantAttributeName min($column)
 * @method static CachedBuilder<static>|LimeParticipantAttributeName newModelQuery()
 * @method static CachedBuilder<static>|LimeParticipantAttributeName newQuery()
 * @method static CachedBuilder<static>|LimeParticipantAttributeName ofFilterData(AnswersFilterData $answersFilterData)
 * @method static CachedBuilder<static>|LimeParticipantAttributeName query()
 * @method static CachedBuilder<static>|LimeParticipantAttributeName sum($column)
 * @method static CachedBuilder<static>|LimeParticipantAttributeName truncate()
 * @method static CachedBuilder<static>|LimeParticipantAttributeName whereAttributeId($value)
 * @method static CachedBuilder<static>|LimeParticipantAttributeName whereAttributeType($value)
 * @method static CachedBuilder<static>|LimeParticipantAttributeName whereCoreAttribute($value)
 * @method static CachedBuilder<static>|LimeParticipantAttributeName whereDefaultname($value)
 * @method static CachedBuilder<static>|LimeParticipantAttributeName whereEncrypted($value)
 * @method static CachedBuilder<static>|LimeParticipantAttributeName whereVisible($value)
 * @method static CachedBuilder<static>|LimeParticipantAttributeName withCacheCooldownSeconds(?int $seconds = null)
 *
 * @mixin \Eloquent
 */
class LimeParticipantAttributeName extends BaseModel
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_participant_attribute_names';

    /** @var string */
    protected $primaryKey = 'attribute_id';

    /** @var array<int, string> */
    protected $fillable = [
        'attribute_type', 'defaultname', 'visible',
    ];

    /** @var array<int, string> */
    protected $hidden = [
    ];

    /** @return array<string, string>     */
    protected $casts = [
        'attribute_id' => 'int', 'attribute_type' => 'string', 'defaultname' => 'string', 'visible' => 'string',
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
