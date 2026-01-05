<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use Modules\Quaeris\Models\Profile;
use Illuminate\Database\Eloquent\Model;
use Modules\Quaeris\Datas\AnswersFilterData;
use GeneaLabs\LaravelModelCaching\CachedBuilder;
use Illuminate\Support\Carbon;

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
 * @method static CachedBuilder<static>|LimeParticipantShare all($columns = [])
 * @method static CachedBuilder<static>|LimeParticipantShare avg($column)
 * @method static CachedBuilder<static>|LimeParticipantShare cache(array $tags = [])
 * @method static CachedBuilder<static>|LimeParticipantShare cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder<static>|LimeParticipantShare count($columns = '*')
 * @method static CachedBuilder<static>|LimeParticipantShare disableCache()
 * @method static CachedBuilder<static>|LimeParticipantShare disableModelCaching()
 * @method static CachedBuilder<static>|LimeParticipantShare exists()
 * @method static CachedBuilder<static>|LimeParticipantShare flushCache(array $tags = [])
 * @method static CachedBuilder<static>|LimeParticipantShare getModelCacheCooldown(Model $instance)
 * @method static CachedBuilder<static>|LimeParticipantShare inRandomOrder($seed = '')
 * @method static CachedBuilder<static>|LimeParticipantShare insert(array $values)
 * @method static CachedBuilder<static>|LimeParticipantShare isCachable()
 * @method static CachedBuilder<static>|LimeParticipantShare max($column)
 * @method static CachedBuilder<static>|LimeParticipantShare min($column)
 * @method static CachedBuilder<static>|LimeParticipantShare newModelQuery()
 * @method static CachedBuilder<static>|LimeParticipantShare newQuery()
 * @method static CachedBuilder<static>|LimeParticipantShare ofFilterData(AnswersFilterData $answersFilterData)
 * @method static CachedBuilder<static>|LimeParticipantShare query()
 * @method static CachedBuilder<static>|LimeParticipantShare sum($column)
 * @method static CachedBuilder<static>|LimeParticipantShare truncate()
 * @method static CachedBuilder<static>|LimeParticipantShare whereCanEdit($value)
 * @method static CachedBuilder<static>|LimeParticipantShare whereDateAdded($value)
 * @method static CachedBuilder<static>|LimeParticipantShare whereParticipantId($value)
 * @method static CachedBuilder<static>|LimeParticipantShare whereShareUid($value)
 * @method static CachedBuilder<static>|LimeParticipantShare withCacheCooldownSeconds(?int $seconds = null)
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

    /** @var array<int, string> */
    protected $fillable = [
        'share_uid', 'date_added', 'can_edit',
    ];

    /** @var array<int, string> */
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
