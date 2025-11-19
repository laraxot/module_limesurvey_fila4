<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use GeneaLabs\LaravelModelCaching\CachedBuilder;
use Illuminate\Support\Carbon;

/**
 * Modules\Limesurvey\Models\LimeParticipant
 *
 * @property string $participant_id
 * @property string|null $firstname
 * @property string|null $lastname
 * @property string|null $email
 * @property string|null $language
 * @property string $blacklisted
 * @property int $owner_uid
 * @property int $created_by
 * @property Carbon|null $created
 * @property Carbon|null $modified
 * @property-read \Modules\Quaeris\Models\Profile|null $creator
 * @property-read \Modules\Limesurvey\Models\Extra|null $extra
 * @property-read \Modules\Quaeris\Models\Profile|null $updater
 *
 * @method static CachedBuilder<static>|LimeParticipant all($columns = [])
 * @method static CachedBuilder<static>|LimeParticipant avg($column)
 * @method static CachedBuilder<static>|LimeParticipant cache(array $tags = [])
 * @method static CachedBuilder<static>|LimeParticipant cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder<static>|LimeParticipant count($columns = '*')
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeParticipant disableCache()
 * @method static CachedBuilder<static>|LimeParticipant disableModelCaching()
 * @method static CachedBuilder<static>|LimeParticipant exists()
 * @method static CachedBuilder<static>|LimeParticipant flushCache(array $tags = [])
 * @method static CachedBuilder<static>|LimeParticipant getModelCacheCooldown(\Illuminate\Database\Eloquent\Model $instance)
 * @method static CachedBuilder<static>|LimeParticipant inRandomOrder($seed = '')
 * @method static CachedBuilder<static>|LimeParticipant insert(array $values)
 * @method static CachedBuilder<static>|LimeParticipant isCachable()
 * @method static CachedBuilder<static>|LimeParticipant max($column)
 * @method static CachedBuilder<static>|LimeParticipant min($column)
 * @method static CachedBuilder<static>|LimeParticipant newModelQuery()
 * @method static CachedBuilder<static>|LimeParticipant newQuery()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeParticipant ofFilterData(\Modules\Quaeris\Datas\AnswersFilterData $answersFilterData)
 * @method static CachedBuilder<static>|LimeParticipant query()
 * @method static CachedBuilder<static>|LimeParticipant sum($column)
 * @method static CachedBuilder<static>|LimeParticipant truncate()
 * @method static CachedBuilder<static>|LimeParticipant whereBlacklisted($value)
 * @method static CachedBuilder<static>|LimeParticipant whereCreated($value)
 * @method static CachedBuilder<static>|LimeParticipant whereCreatedBy($value)
 * @method static CachedBuilder<static>|LimeParticipant whereEmail($value)
 * @method static CachedBuilder<static>|LimeParticipant whereFirstname($value)
 * @method static CachedBuilder<static>|LimeParticipant whereLanguage($value)
 * @method static CachedBuilder<static>|LimeParticipant whereLastname($value)
 * @method static CachedBuilder<static>|LimeParticipant whereModified($value)
 * @method static CachedBuilder<static>|LimeParticipant whereOwnerUid($value)
 * @method static CachedBuilder<static>|LimeParticipant whereParticipantId($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeParticipant withCacheCooldownSeconds(?int $seconds = null)
 *
 * @mixin \Eloquent
 */
class LimeParticipant extends BaseModel
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_participants';

    /** @var string */
    protected $primaryKey = 'participant_id';

    /** @var array<int, string> */
    protected $fillable = [
        'firstname', 'lastname', 'email', 'language', 'blacklisted', 'owner_uid', 'created_by', 'created', 'modified',
    ];

    /** @var array<int, string> */
    protected $hidden = [
    ];

    /** @return array<string, string>     */
    protected $casts = [
        'participant_id' => 'string', 'firstname' => 'string', 'lastname' => 'string', 'email' => 'string', 'language' => 'string', 'blacklisted' => 'string', 'owner_uid' => 'int', 'created_by' => 'int', 'created' => 'datetime', 'modified' => 'datetime',
    ];

    // Scopes...

    // Functions ...

    // Relations ...
}
