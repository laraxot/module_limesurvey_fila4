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
 * @property string|null $attribute_1
 * @property string|null $attribute_2
 * @property string|null $attribute_3
 * @property string|null $attribute_4
 * @property string|null $attribute_5
 * @property string|null $attribute_6
 *
 * @property-read Profile|null $creator
 * @property-read Extra|null $extra
 * @property-read Profile|null $updater
 *
 * @method static CachedBuilder|LimeTokens946595 all($columns = [])
 * @method static CachedBuilder|LimeTokens946595 avg($column)
 * @method static CachedBuilder|LimeTokens946595 cache(array $tags = [])
 * @method static CachedBuilder|LimeTokens946595 cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder|LimeTokens946595 count($columns = '*')
 * @method static CachedBuilder|LimeTokens946595 disableCache()
 * @method static CachedBuilder|LimeTokens946595 disableModelCaching()
 * @method static CachedBuilder|LimeTokens946595 exists()
 * @method static CachedBuilder|LimeTokens946595 flushCache(array $tags = [])
 * @method static CachedBuilder|LimeTokens946595 getModelCacheCooldown(Model $instance)
 * @method static CachedBuilder|LimeTokens946595 inRandomOrder($seed = '')
 * @method static CachedBuilder|LimeTokens946595 insert(array $values)
 * @method static CachedBuilder|LimeTokens946595 isCachable()
 * @method static CachedBuilder|LimeTokens946595 max($column)
 * @method static CachedBuilder|LimeTokens946595 min($column)
 * @method static CachedBuilder|LimeTokens946595 newModelQuery()
 * @method static CachedBuilder|LimeTokens946595 newQuery()
 * @method static CachedBuilder|LimeTokens946595 ofFilterData(AnswersFilterData $answersFilterData)
 * @method static CachedBuilder|LimeTokens946595 query()
 * @method static CachedBuilder|LimeTokens946595 sum($column)
 * @method static CachedBuilder|LimeTokens946595 truncate()
 * @method static CachedBuilder|LimeTokens946595 whereAttribute1($value)
 * @method static CachedBuilder|LimeTokens946595 whereAttribute2($value)
 * @method static CachedBuilder|LimeTokens946595 whereAttribute3($value)
 * @method static CachedBuilder|LimeTokens946595 whereAttribute4($value)
 * @method static CachedBuilder|LimeTokens946595 whereAttribute5($value)
 * @method static CachedBuilder|LimeTokens946595 whereAttribute6($value)
 * @method static CachedBuilder|LimeTokens946595 whereBlacklisted($value)
 * @method static CachedBuilder|LimeTokens946595 whereCompleted($value)
 * @method static CachedBuilder|LimeTokens946595 whereEmail($value)
 * @method static CachedBuilder|LimeTokens946595 whereEmailstatus($value)
 * @method static CachedBuilder|LimeTokens946595 whereFirstname($value)
 * @method static CachedBuilder|LimeTokens946595 whereLanguage($value)
 * @method static CachedBuilder|LimeTokens946595 whereLastname($value)
 * @method static CachedBuilder|LimeTokens946595 whereMpid($value)
 * @method static CachedBuilder|LimeTokens946595 whereParticipantId($value)
 * @method static CachedBuilder|LimeTokens946595 whereRemindercount($value)
 * @method static CachedBuilder|LimeTokens946595 whereRemindersent($value)
 * @method static CachedBuilder|LimeTokens946595 whereSent($value)
 * @method static CachedBuilder|LimeTokens946595 whereTid($value)
 * @method static CachedBuilder|LimeTokens946595 whereToken($value)
 * @method static CachedBuilder|LimeTokens946595 whereUsesleft($value)
 * @method static CachedBuilder|LimeTokens946595 whereValidfrom($value)
 * @method static CachedBuilder|LimeTokens946595 whereValiduntil($value)
 * @method static CachedBuilder|LimeTokens946595 withCacheCooldownSeconds(?int $seconds = null)
 *
 * @mixin \Eloquent
 */
class LimeTokens946595 extends BaseModel
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
        17 => 'attribute_1',
        18 => 'attribute_2',
        19 => 'attribute_3',
        20 => 'attribute_4',
        21 => 'attribute_5',
        22 => 'attribute_6',
    ];

    /** @var string */
    protected $primaryKey = 'tid';

    /** @var string */
    protected $table = 'lime_tokens_946595';
}
