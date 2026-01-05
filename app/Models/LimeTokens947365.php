<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use GeneaLabs\LaravelModelCaching\CachedBuilder;
use Illuminate\Database\Eloquent\Model;
use Modules\Quaeris\Datas\AnswersFilterData;
use Modules\Quaeris\Models\Profile;

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
 * @method static CachedBuilder|LimeTokens947365 all($columns = [])
 * @method static CachedBuilder|LimeTokens947365 avg($column)
 * @method static CachedBuilder|LimeTokens947365 cache(array $tags = [])
 * @method static CachedBuilder|LimeTokens947365 cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder|LimeTokens947365 count($columns = '*')
 * @method static CachedBuilder|LimeTokens947365 disableCache()
 * @method static CachedBuilder|LimeTokens947365 disableModelCaching()
 * @method static CachedBuilder|LimeTokens947365 exists()
 * @method static CachedBuilder|LimeTokens947365 flushCache(array $tags = [])
 * @method static CachedBuilder|LimeTokens947365 getModelCacheCooldown(Model $instance)
 * @method static CachedBuilder|LimeTokens947365 inRandomOrder($seed = '')
 * @method static CachedBuilder|LimeTokens947365 insert(array $values)
 * @method static CachedBuilder|LimeTokens947365 isCachable()
 * @method static CachedBuilder|LimeTokens947365 max($column)
 * @method static CachedBuilder|LimeTokens947365 min($column)
 * @method static CachedBuilder|LimeTokens947365 newModelQuery()
 * @method static CachedBuilder|LimeTokens947365 newQuery()
 * @method static CachedBuilder|LimeTokens947365 ofFilterData(AnswersFilterData $answersFilterData)
 * @method static CachedBuilder|LimeTokens947365 query()
 * @method static CachedBuilder|LimeTokens947365 sum($column)
 * @method static CachedBuilder|LimeTokens947365 truncate()
 * @method static CachedBuilder|LimeTokens947365 whereAttribute1($value)
 * @method static CachedBuilder|LimeTokens947365 whereAttribute10($value)
 * @method static CachedBuilder|LimeTokens947365 whereAttribute11($value)
 * @method static CachedBuilder|LimeTokens947365 whereAttribute12($value)
 * @method static CachedBuilder|LimeTokens947365 whereAttribute13($value)
 * @method static CachedBuilder|LimeTokens947365 whereAttribute14($value)
 * @method static CachedBuilder|LimeTokens947365 whereAttribute2($value)
 * @method static CachedBuilder|LimeTokens947365 whereAttribute3($value)
 * @method static CachedBuilder|LimeTokens947365 whereAttribute4($value)
 * @method static CachedBuilder|LimeTokens947365 whereAttribute5($value)
 * @method static CachedBuilder|LimeTokens947365 whereAttribute6($value)
 * @method static CachedBuilder|LimeTokens947365 whereAttribute7($value)
 * @method static CachedBuilder|LimeTokens947365 whereAttribute8($value)
 * @method static CachedBuilder|LimeTokens947365 whereAttribute9($value)
 * @method static CachedBuilder|LimeTokens947365 whereBlacklisted($value)
 * @method static CachedBuilder|LimeTokens947365 whereCompleted($value)
 * @method static CachedBuilder|LimeTokens947365 whereEmail($value)
 * @method static CachedBuilder|LimeTokens947365 whereEmailstatus($value)
 * @method static CachedBuilder|LimeTokens947365 whereFirstname($value)
 * @method static CachedBuilder|LimeTokens947365 whereLanguage($value)
 * @method static CachedBuilder|LimeTokens947365 whereLastname($value)
 * @method static CachedBuilder|LimeTokens947365 whereMpid($value)
 * @method static CachedBuilder|LimeTokens947365 whereParticipantId($value)
 * @method static CachedBuilder|LimeTokens947365 whereRemindercount($value)
 * @method static CachedBuilder|LimeTokens947365 whereRemindersent($value)
 * @method static CachedBuilder|LimeTokens947365 whereSent($value)
 * @method static CachedBuilder|LimeTokens947365 whereTid($value)
 * @method static CachedBuilder|LimeTokens947365 whereToken($value)
 * @method static CachedBuilder|LimeTokens947365 whereUsesleft($value)
 * @method static CachedBuilder|LimeTokens947365 whereValidfrom($value)
 * @method static CachedBuilder|LimeTokens947365 whereValiduntil($value)
 * @method static CachedBuilder|LimeTokens947365 withCacheCooldownSeconds(?int $seconds = null)
 *
 * @mixin \Eloquent
 */
class LimeTokens947365 extends BaseModel
{
    /** @var bool */
    public $timestamps = false;

    /** @var string */
    protected $table = 'lime_tokens_947365';

    /** @var string */
    protected $primaryKey = 'tid';

    /** @var list<string> */
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
