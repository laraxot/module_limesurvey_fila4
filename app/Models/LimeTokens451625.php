<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use Modules\Quaeris\Models\Profile;
use GeneaLabs\LaravelModelCaching\CachedBuilder;
use Illuminate\Database\Eloquent\Model;
use Modules\Quaeris\Datas\AnswersFilterData;

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
 * @property string|null $attribute_1
 * @property string|null $attribute_2
 * @property string|null $attribute_3
 * @property string|null $attribute_4
 * @property string|null $attribute_5
 * @property string|null $attribute_6
 * @property string|null $attribute_7
 * @property string|null $attribute_8
 * @property string|null $attribute_9
 * @property string|null $attribute_10
 * @property string|null $attribute_11
 * @property string|null $attribute_12
 * @property string|null $attribute_13
 * @property string|null $attribute_14
 *
 * @property-read Profile|null $creator
 * @property-read Extra|null $extra
 * @property-read Profile|null $updater
 *
 * @method static CachedBuilder<static>|LimeTokens451625 all($columns = [])
 * @method static CachedBuilder<static>|LimeTokens451625 avg($column)
 * @method static CachedBuilder<static>|LimeTokens451625 cache(array $tags = [])
 * @method static CachedBuilder<static>|LimeTokens451625 cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder<static>|LimeTokens451625 count($columns = '*')
 * @method static CachedBuilder<static>|LimeTokens451625 disableCache()
 * @method static CachedBuilder<static>|LimeTokens451625 disableModelCaching()
 * @method static CachedBuilder<static>|LimeTokens451625 exists()
 * @method static CachedBuilder<static>|LimeTokens451625 flushCache(array $tags = [])
 * @method static CachedBuilder<static>|LimeTokens451625 getModelCacheCooldown(Model $instance)
 * @method static CachedBuilder<static>|LimeTokens451625 inRandomOrder($seed = '')
 * @method static CachedBuilder<static>|LimeTokens451625 insert(array $values)
 * @method static CachedBuilder<static>|LimeTokens451625 isCachable()
 * @method static CachedBuilder<static>|LimeTokens451625 max($column)
 * @method static CachedBuilder<static>|LimeTokens451625 min($column)
 * @method static CachedBuilder<static>|LimeTokens451625 newModelQuery()
 * @method static CachedBuilder<static>|LimeTokens451625 newQuery()
 * @method static CachedBuilder<static>|LimeTokens451625 ofFilterData(AnswersFilterData $answersFilterData)
 * @method static CachedBuilder<static>|LimeTokens451625 query()
 * @method static CachedBuilder<static>|LimeTokens451625 sum($column)
 * @method static CachedBuilder<static>|LimeTokens451625 truncate()
 * @method static CachedBuilder<static>|LimeTokens451625 whereAttribute1($value)
 * @method static CachedBuilder<static>|LimeTokens451625 whereAttribute10($value)
 * @method static CachedBuilder<static>|LimeTokens451625 whereAttribute11($value)
 * @method static CachedBuilder<static>|LimeTokens451625 whereAttribute12($value)
 * @method static CachedBuilder<static>|LimeTokens451625 whereAttribute13($value)
 * @method static CachedBuilder<static>|LimeTokens451625 whereAttribute14($value)
 * @method static CachedBuilder<static>|LimeTokens451625 whereAttribute2($value)
 * @method static CachedBuilder<static>|LimeTokens451625 whereAttribute3($value)
 * @method static CachedBuilder<static>|LimeTokens451625 whereAttribute4($value)
 * @method static CachedBuilder<static>|LimeTokens451625 whereAttribute5($value)
 * @method static CachedBuilder<static>|LimeTokens451625 whereAttribute6($value)
 * @method static CachedBuilder<static>|LimeTokens451625 whereAttribute7($value)
 * @method static CachedBuilder<static>|LimeTokens451625 whereAttribute8($value)
 * @method static CachedBuilder<static>|LimeTokens451625 whereAttribute9($value)
 * @method static CachedBuilder<static>|LimeTokens451625 whereBlacklisted($value)
 * @method static CachedBuilder<static>|LimeTokens451625 whereCompleted($value)
 * @method static CachedBuilder<static>|LimeTokens451625 whereEmail($value)
 * @method static CachedBuilder<static>|LimeTokens451625 whereEmailstatus($value)
 * @method static CachedBuilder<static>|LimeTokens451625 whereFirstname($value)
 * @method static CachedBuilder<static>|LimeTokens451625 whereLanguage($value)
 * @method static CachedBuilder<static>|LimeTokens451625 whereLastname($value)
 * @method static CachedBuilder<static>|LimeTokens451625 whereMpid($value)
 * @method static CachedBuilder<static>|LimeTokens451625 whereParticipantId($value)
 * @method static CachedBuilder<static>|LimeTokens451625 whereRemindercount($value)
 * @method static CachedBuilder<static>|LimeTokens451625 whereRemindersent($value)
 * @method static CachedBuilder<static>|LimeTokens451625 whereSent($value)
 * @method static CachedBuilder<static>|LimeTokens451625 whereTid($value)
 * @method static CachedBuilder<static>|LimeTokens451625 whereToken($value)
 * @method static CachedBuilder<static>|LimeTokens451625 whereUsesleft($value)
 * @method static CachedBuilder<static>|LimeTokens451625 whereValidfrom($value)
 * @method static CachedBuilder<static>|LimeTokens451625 whereValiduntil($value)
 * @method static CachedBuilder<static>|LimeTokens451625 withCacheCooldownSeconds(?int $seconds = null)
 *
 * @mixin \Eloquent
 */
class LimeTokens451625 extends BaseModel
{
    /** @var bool */
    public $timestamps = false;

    /** @var string */
    protected $table = 'lime_tokens_451625';

    /** @var string */
    protected $primaryKey = 'tid';

    /** @var array<int, string> */
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
        17 => 'attribute_1',
        18 => 'attribute_2',
        19 => 'attribute_3',
        20 => 'attribute_4',
        21 => 'attribute_5',
        22 => 'attribute_6',
        23 => 'attribute_7',
        24 => 'attribute_8',
        25 => 'attribute_9',
        26 => 'attribute_10',
        27 => 'attribute_11',
        28 => 'attribute_12',
        29 => 'attribute_13',
        30 => 'attribute_14',
    ];
}
