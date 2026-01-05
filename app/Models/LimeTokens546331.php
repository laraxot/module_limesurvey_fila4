<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use GeneaLabs\LaravelModelCaching\CachedBuilder;
use Illuminate\Database\Eloquent\Model;
use Modules\Quaeris\Datas\AnswersFilterData;
use Modules\Quaeris\Models\Profile;
use Modules\Xot\Models\Traits\HasXotFactory;

/**
 * @property int $tid
 * @property string|null $participant_id
 * @property string|null $firstname
 * @property string|null $lastname
 * @property string|null $email
 * @property string|null $emailstatus
 * @property string|null $token
 * @property string|null $language
 * @property string|null $blacklisted
 * @property string|null $sent
 * @property string|null $remindersent
 * @property int|null $remindercount
 * @property string|null $completed
 * @property int|null $usesleft
 * @property string|null $validfrom
 * @property string|null $validuntil
 * @property int|null $mpid
 *
 * @property-read Profile|null $creator
 * @property-read Extra|null $extra
 * @property-read Profile|null $updater
 *
 * @method static CachedBuilder<static>|LimeTokens546331 all($columns = [])
 * @method static CachedBuilder<static>|LimeTokens546331 avg($column)
 * @method static CachedBuilder<static>|LimeTokens546331 cache(array $tags = [])
 * @method static CachedBuilder<static>|LimeTokens546331 cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder<static>|LimeTokens546331 count($columns = '*')
 * @method static CachedBuilder<static>|LimeTokens546331 disableCache()
 * @method static CachedBuilder<static>|LimeTokens546331 disableModelCaching()
 * @method static CachedBuilder<static>|LimeTokens546331 exists()
 * @method static CachedBuilder<static>|LimeTokens546331 flushCache(array $tags = [])
 * @method static CachedBuilder<static>|LimeTokens546331 getModelCacheCooldown(Model $instance)
 * @method static CachedBuilder<static>|LimeTokens546331 inRandomOrder($seed = '')
 * @method static CachedBuilder<static>|LimeTokens546331 insert(array $values)
 * @method static CachedBuilder<static>|LimeTokens546331 isCachable()
 * @method static CachedBuilder<static>|LimeTokens546331 max($column)
 * @method static CachedBuilder<static>|LimeTokens546331 min($column)
 * @method static CachedBuilder<static>|LimeTokens546331 newModelQuery()
 * @method static CachedBuilder<static>|LimeTokens546331 newQuery()
 * @method static CachedBuilder<static>|LimeTokens546331 ofFilterData(AnswersFilterData $answersFilterData)
 * @method static CachedBuilder<static>|LimeTokens546331 query()
 * @method static CachedBuilder<static>|LimeTokens546331 sum($column)
 * @method static CachedBuilder<static>|LimeTokens546331 truncate()
 * @method static CachedBuilder<static>|LimeTokens546331 whereBlacklisted($value)
 * @method static CachedBuilder<static>|LimeTokens546331 whereCompleted($value)
 * @method static CachedBuilder<static>|LimeTokens546331 whereEmail($value)
 * @method static CachedBuilder<static>|LimeTokens546331 whereEmailstatus($value)
 * @method static CachedBuilder<static>|LimeTokens546331 whereFirstname($value)
 * @method static CachedBuilder<static>|LimeTokens546331 whereLanguage($value)
 * @method static CachedBuilder<static>|LimeTokens546331 whereLastname($value)
 * @method static CachedBuilder<static>|LimeTokens546331 whereMpid($value)
 * @method static CachedBuilder<static>|LimeTokens546331 whereParticipantId($value)
 * @method static CachedBuilder<static>|LimeTokens546331 whereRemindercount($value)
 * @method static CachedBuilder<static>|LimeTokens546331 whereRemindersent($value)
 * @method static CachedBuilder<static>|LimeTokens546331 whereSent($value)
 * @method static CachedBuilder<static>|LimeTokens546331 whereTid($value)
 * @method static CachedBuilder<static>|LimeTokens546331 whereToken($value)
 * @method static CachedBuilder<static>|LimeTokens546331 whereUsesleft($value)
 * @method static CachedBuilder<static>|LimeTokens546331 whereValidfrom($value)
 * @method static CachedBuilder<static>|LimeTokens546331 whereValiduntil($value)
 * @method static CachedBuilder<static>|LimeTokens546331 withCacheCooldownSeconds(?int $seconds = null)
 *
 * @mixin \Eloquent
 */
class LimeTokens546331 extends BaseModel
{
    use HasXotFactory;

    /** @var bool */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        0 => 'tid',
        1 => 'participant_id',
        2 => 'firstname',
        3 => 'lastname',
        4 => 'email',
        5 => 'emailstatus',
        6 => 'token',
        7 => 'language',
        8 => 'blacklisted',
        9 => 'sent',
        10 => 'remindersent',
        11 => 'remindercount',
        12 => 'completed',
        13 => 'usesleft',
        14 => 'validfrom',
        15 => 'validuntil',
        16 => 'mpid',
    ];

    /** @var string */
    protected $primaryKey = 'tid';

    /** @var string */
    protected $table = 'lime_tokens_546331';
}
