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
 * @method static CachedBuilder|LimeParticipantAttributeNamesLang all($columns = [])
 * @method static CachedBuilder|LimeParticipantAttributeNamesLang avg($column)
 * @method static CachedBuilder|LimeParticipantAttributeNamesLang cache(array $tags = [])
 * @method static CachedBuilder|LimeParticipantAttributeNamesLang cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder|LimeParticipantAttributeNamesLang count($columns = '*')
 * @method static CachedBuilder|LimeParticipantAttributeNamesLang disableCache()
 * @method static CachedBuilder|LimeParticipantAttributeNamesLang disableModelCaching()
 * @method static CachedBuilder|LimeParticipantAttributeNamesLang exists()
 * @method static CachedBuilder|LimeParticipantAttributeNamesLang flushCache(array $tags = [])
 * @method static CachedBuilder|LimeParticipantAttributeNamesLang getModelCacheCooldown(Model $instance)
 * @method static CachedBuilder|LimeParticipantAttributeNamesLang inRandomOrder($seed = '')
 * @method static CachedBuilder|LimeParticipantAttributeNamesLang insert(array $values)
 * @method static CachedBuilder|LimeParticipantAttributeNamesLang isCachable()
 * @method static CachedBuilder|LimeParticipantAttributeNamesLang max($column)
 * @method static CachedBuilder|LimeParticipantAttributeNamesLang min($column)
 * @method static CachedBuilder|LimeParticipantAttributeNamesLang newModelQuery()
 * @method static CachedBuilder|LimeParticipantAttributeNamesLang newQuery()
 * @method static CachedBuilder|LimeParticipantAttributeNamesLang ofFilterData(AnswersFilterData $answersFilterData)
 * @method static CachedBuilder|LimeParticipantAttributeNamesLang query()
 * @method static CachedBuilder|LimeParticipantAttributeNamesLang sum($column)
 * @method static CachedBuilder|LimeParticipantAttributeNamesLang truncate()
 * @method static CachedBuilder|LimeParticipantAttributeNamesLang whereAttributeId($value)
 * @method static CachedBuilder|LimeParticipantAttributeNamesLang whereAttributeName($value)
 * @method static CachedBuilder|LimeParticipantAttributeNamesLang whereLang($value)
 * @method static CachedBuilder|LimeParticipantAttributeNamesLang withCacheCooldownSeconds(?int $seconds = null)
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

    /** @var list<string> */
    protected $fillable = [
        'lang', 'attribute_name',
    ];

    /** @var list<string> */
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
