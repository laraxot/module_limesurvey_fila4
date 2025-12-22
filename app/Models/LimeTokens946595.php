<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

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
 * @property-read \Modules\Quaeris\Models\Profile|null $creator
 * @property-read \Modules\Limesurvey\Models\Extra|null $extra
 * @property-read \Modules\Quaeris\Models\Profile|null $updater
 *
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeTokens946595 all($columns = [])
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeTokens946595 avg($column)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeTokens946595 cache(array $tags = [])
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeTokens946595 cachedValue(array $arguments, string $cacheKey)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeTokens946595 count($columns = '*')
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeTokens946595 disableCache()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeTokens946595 disableModelCaching()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeTokens946595 exists()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeTokens946595 flushCache(array $tags = [])
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeTokens946595 getModelCacheCooldown(\Illuminate\Database\Eloquent\Model $instance)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeTokens946595 inRandomOrder($seed = '')
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeTokens946595 insert(array $values)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeTokens946595 isCachable()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeTokens946595 max($column)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeTokens946595 min($column)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeTokens946595 newModelQuery()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeTokens946595 newQuery()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeTokens946595 ofFilterData(\Modules\Quaeris\Datas\AnswersFilterData $answersFilterData)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeTokens946595 query()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeTokens946595 sum($column)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeTokens946595 truncate()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeTokens946595 whereAttribute1($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeTokens946595 whereAttribute2($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeTokens946595 whereAttribute3($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeTokens946595 whereAttribute4($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeTokens946595 whereAttribute5($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeTokens946595 whereAttribute6($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeTokens946595 whereBlacklisted($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeTokens946595 whereCompleted($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeTokens946595 whereEmail($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeTokens946595 whereEmailstatus($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeTokens946595 whereFirstname($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeTokens946595 whereLanguage($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeTokens946595 whereLastname($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeTokens946595 whereMpid($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeTokens946595 whereParticipantId($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeTokens946595 whereRemindercount($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeTokens946595 whereRemindersent($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeTokens946595 whereSent($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeTokens946595 whereTid($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeTokens946595 whereToken($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeTokens946595 whereUsesleft($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeTokens946595 whereValidfrom($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeTokens946595 whereValiduntil($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeTokens946595 withCacheCooldownSeconds(?int $seconds = null)
 *
 * @mixin \Eloquent
 */
class LimeTokens946595 extends BaseModel
{
    use \Modules\Xot\Models\Traits\HasXotFactory;

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
