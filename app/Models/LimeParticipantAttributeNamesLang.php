<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use GeneaLabs\LaravelModelCaching\CachedBuilder;
use Illuminate\Database\Eloquent\Model;
use Modules\Quaeris\Datas\AnswersFilterData;
use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeParticipantAttributeNamesLang
 *
 * @property int $attribute_id
 * @property string $attribute_name
 * @property string $lang
 *
 * @property-read Profile|null $creator
 * @property-read Extra|null $extra
 * @property-read Profile|null $updater
 *
 * @method static CachedBuilder<static>|LimeParticipantAttributeNamesLang all($columns = [])
 * @method static CachedBuilder<static>|LimeParticipantAttributeNamesLang avg($column)
 * @method static CachedBuilder<static>|LimeParticipantAttributeNamesLang cache(array $tags = [])
 * @method static CachedBuilder<static>|LimeParticipantAttributeNamesLang cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder<static>|LimeParticipantAttributeNamesLang count($columns = '*')
 * @method static CachedBuilder<static>|LimeParticipantAttributeNamesLang disableCache()
 * @method static CachedBuilder<static>|LimeParticipantAttributeNamesLang disableModelCaching()
 * @method static CachedBuilder<static>|LimeParticipantAttributeNamesLang exists()
 * @method static CachedBuilder<static>|LimeParticipantAttributeNamesLang flushCache(array $tags = [])
 * @method static CachedBuilder<static>|LimeParticipantAttributeNamesLang getModelCacheCooldown(Model $instance)
 * @method static CachedBuilder<static>|LimeParticipantAttributeNamesLang inRandomOrder($seed = '')
 * @method static CachedBuilder<static>|LimeParticipantAttributeNamesLang insert(array $values)
 * @method static CachedBuilder<static>|LimeParticipantAttributeNamesLang isCachable()
 * @method static CachedBuilder<static>|LimeParticipantAttributeNamesLang max($column)
 * @method static CachedBuilder<static>|LimeParticipantAttributeNamesLang min($column)
 * @method static CachedBuilder<static>|LimeParticipantAttributeNamesLang newModelQuery()
 * @method static CachedBuilder<static>|LimeParticipantAttributeNamesLang newQuery()
 * @method static CachedBuilder<static>|LimeParticipantAttributeNamesLang ofFilterData(AnswersFilterData $answersFilterData)
 * @method static CachedBuilder<static>|LimeParticipantAttributeNamesLang query()
 * @method static CachedBuilder<static>|LimeParticipantAttributeNamesLang sum($column)
 * @method static CachedBuilder<static>|LimeParticipantAttributeNamesLang truncate()
 * @method static CachedBuilder<static>|LimeParticipantAttributeNamesLang whereAttributeId($value)
 * @method static CachedBuilder<static>|LimeParticipantAttributeNamesLang whereAttributeName($value)
 * @method static CachedBuilder<static>|LimeParticipantAttributeNamesLang whereLang($value)
 * @method static CachedBuilder<static>|LimeParticipantAttributeNamesLang withCacheCooldownSeconds(?int $seconds = null)
 *
 * @mixin \Eloquent
 */
class LimeParticipantAttributeNamesLang extends BaseModel
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_participant_attribute_names_lang';

    /** @var string */
    protected $primaryKey = 'attribute_id';

    /** @var array<int, string> */
    protected $fillable = [
        'lang', 'attribute_name',
    ];

    /** @var array<int, string> */
    protected $hidden = [
    ];

    /** @return array<string, string>     */
    protected $casts = [
        'attribute_id' => 'int', 'lang' => 'string', 'attribute_name' => 'string',
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
