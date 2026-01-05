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
 * @method static CachedBuilder|LimeParticipantAttributeName all($columns = [])
 * @method static CachedBuilder|LimeParticipantAttributeName avg($column)
 * @method static CachedBuilder|LimeParticipantAttributeName cache(array $tags = [])
 * @method static CachedBuilder|LimeParticipantAttributeName cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder|LimeParticipantAttributeName count($columns = '*')
 * @method static CachedBuilder|LimeParticipantAttributeName disableCache()
 * @method static CachedBuilder|LimeParticipantAttributeName disableModelCaching()
 * @method static CachedBuilder|LimeParticipantAttributeName exists()
 * @method static CachedBuilder|LimeParticipantAttributeName flushCache(array $tags = [])
 * @method static CachedBuilder|LimeParticipantAttributeName getModelCacheCooldown(Model $instance)
 * @method static CachedBuilder|LimeParticipantAttributeName inRandomOrder($seed = '')
 * @method static CachedBuilder|LimeParticipantAttributeName insert(array $values)
 * @method static CachedBuilder|LimeParticipantAttributeName isCachable()
 * @method static CachedBuilder|LimeParticipantAttributeName max($column)
 * @method static CachedBuilder|LimeParticipantAttributeName min($column)
 * @method static CachedBuilder|LimeParticipantAttributeName newModelQuery()
 * @method static CachedBuilder|LimeParticipantAttributeName newQuery()
 * @method static CachedBuilder|LimeParticipantAttributeName ofFilterData(AnswersFilterData $answersFilterData)
 * @method static CachedBuilder|LimeParticipantAttributeName query()
 * @method static CachedBuilder|LimeParticipantAttributeName sum($column)
 * @method static CachedBuilder|LimeParticipantAttributeName truncate()
 * @method static CachedBuilder|LimeParticipantAttributeName whereAttributeId($value)
 * @method static CachedBuilder|LimeParticipantAttributeName whereAttributeType($value)
 * @method static CachedBuilder|LimeParticipantAttributeName whereCoreAttribute($value)
 * @method static CachedBuilder|LimeParticipantAttributeName whereDefaultname($value)
 * @method static CachedBuilder|LimeParticipantAttributeName whereEncrypted($value)
 * @method static CachedBuilder|LimeParticipantAttributeName whereVisible($value)
 * @method static CachedBuilder|LimeParticipantAttributeName withCacheCooldownSeconds(?int $seconds = null)
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

    /** @var list<string> */
    protected $fillable = [
        'attribute_type', 'defaultname', 'visible',
    ];

    /** @var list<string> */
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
