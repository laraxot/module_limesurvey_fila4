<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use GeneaLabs\LaravelModelCaching\CachedBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Modules\Quaeris\Datas\AnswersFilterData;
use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeParticipantShare
 *
 * @property string $participant_id
 * @property int $share_uid
 * @property Carbon $date_added
 * @property string $can_edit
 *
 * @property-read Profile|null $creator
 * @property-read Extra|null $extra
 * @property-read Profile|null $updater
 *
 * @method static CachedBuilder|LimeParticipantShare all($columns = [])
 * @method static CachedBuilder|LimeParticipantShare avg($column)
 * @method static CachedBuilder|LimeParticipantShare cache(array $tags = [])
 * @method static CachedBuilder|LimeParticipantShare cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder|LimeParticipantShare count($columns = '*')
 * @method static CachedBuilder|LimeParticipantShare disableCache()
 * @method static CachedBuilder|LimeParticipantShare disableModelCaching()
 * @method static CachedBuilder|LimeParticipantShare exists()
 * @method static CachedBuilder|LimeParticipantShare flushCache(array $tags = [])
 * @method static CachedBuilder|LimeParticipantShare getModelCacheCooldown(Model $instance)
 * @method static CachedBuilder|LimeParticipantShare inRandomOrder($seed = '')
 * @method static CachedBuilder|LimeParticipantShare insert(array $values)
 * @method static CachedBuilder|LimeParticipantShare isCachable()
 * @method static CachedBuilder|LimeParticipantShare max($column)
 * @method static CachedBuilder|LimeParticipantShare min($column)
 * @method static CachedBuilder|LimeParticipantShare newModelQuery()
 * @method static CachedBuilder|LimeParticipantShare newQuery()
 * @method static CachedBuilder|LimeParticipantShare ofFilterData(AnswersFilterData $answersFilterData)
 * @method static CachedBuilder|LimeParticipantShare query()
 * @method static CachedBuilder|LimeParticipantShare sum($column)
 * @method static CachedBuilder|LimeParticipantShare truncate()
 * @method static CachedBuilder|LimeParticipantShare whereCanEdit($value)
 * @method static CachedBuilder|LimeParticipantShare whereDateAdded($value)
 * @method static CachedBuilder|LimeParticipantShare whereParticipantId($value)
 * @method static CachedBuilder|LimeParticipantShare whereShareUid($value)
 * @method static CachedBuilder|LimeParticipantShare withCacheCooldownSeconds(?int $seconds = null)
 *
 * @mixin \Eloquent
 */
class LimeParticipantShare extends BaseModel
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_participant_shares';

    /** @var string */
    protected $primaryKey = 'participant_id';

    /** @var list<string> */
    protected $fillable = [
        'share_uid', 'date_added', 'can_edit',
    ];

    /** @var list<string> */
    protected $hidden = [
    ];

    /** @return array<string, string>     */
    protected $casts = [
        'participant_id' => 'string', 'share_uid' => 'int', 'date_added' => 'datetime', 'can_edit' => 'string',
    ];

    // Scopes...

    // Functions ...

    // Relations ...
}
