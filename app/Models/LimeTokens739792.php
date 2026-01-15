<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use Illuminate\Database\Eloquent\Builder;
use Modules\Limesurvey\Database\Factories\LimeTokens739792Factory;
use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeTokens739792
 *
 * @method static LimeTokens739792Factory factory($count = null, $state = [])
 *
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
 *
 * @method static Builder|LimeTokens739792 whereAttribute1($value)
 * @method static Builder|LimeTokens739792 whereAttribute2($value)
 * @method static Builder|LimeTokens739792 whereAttribute3($value)
 * @method static Builder|LimeTokens739792 whereBlacklisted($value)
 * @method static Builder|LimeTokens739792 whereCompleted($value)
 * @method static Builder|LimeTokens739792 whereEmail($value)
 * @method static Builder|LimeTokens739792 whereEmailstatus($value)
 * @method static Builder|LimeTokens739792 whereFirstname($value)
 * @method static Builder|LimeTokens739792 whereLanguage($value)
 * @method static Builder|LimeTokens739792 whereLastname($value)
 * @method static Builder|LimeTokens739792 whereMpid($value)
 * @method static Builder|LimeTokens739792 whereParticipantId($value)
 * @method static Builder|LimeTokens739792 whereRemindercount($value)
 * @method static Builder|LimeTokens739792 whereRemindersent($value)
 * @method static Builder|LimeTokens739792 whereSent($value)
 * @method static Builder|LimeTokens739792 whereTid($value)
 * @method static Builder|LimeTokens739792 whereToken($value)
 * @method static Builder|LimeTokens739792 whereUsesleft($value)
 * @method static Builder|LimeTokens739792 whereValidfrom($value)
 * @method static Builder|LimeTokens739792 whereValiduntil($value)
 *
 * @property-read Profile|null $creator
 * @property-read Extra|null $extra
 * @property-read Profile|null $updater
 *
 * @mixin \Eloquent
 */
class LimeTokens739792 extends BaseModel
{
    /** @var bool */
    public $timestamps = false;

    /** @var string */
    protected $table = 'lime_tokens_739792';

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
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var list<string>
     */
    protected $hidden = [
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     *  da fare
     *
     * @var array<string>
     */
    protected $dates = [
    ];

    /**
     * Get the casts for the model.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [];
    }

    // Scopes...

    // Functions ...

    // Relations ...
}
