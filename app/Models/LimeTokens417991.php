<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Modules\Limesurvey\Database\Factories\LimeTokens417991Factory;
use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeTokens417991
 *
 * @method static LimeTokens417991Factory factory($count = null, $state = [])
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
 * @property Carbon|null $validfrom
 * @property Carbon|null $validuntil
 * @property int|null $mpid
 * @property string|null $attribute_1
 * @property string|null $attribute_2
 *
 * @method static Builder|LimeTokens417991 whereAttribute1($value)
 * @method static Builder|LimeTokens417991 whereAttribute2($value)
 * @method static Builder|LimeTokens417991 whereBlacklisted($value)
 * @method static Builder|LimeTokens417991 whereCompleted($value)
 * @method static Builder|LimeTokens417991 whereEmail($value)
 * @method static Builder|LimeTokens417991 whereEmailstatus($value)
 * @method static Builder|LimeTokens417991 whereFirstname($value)
 * @method static Builder|LimeTokens417991 whereLanguage($value)
 * @method static Builder|LimeTokens417991 whereLastname($value)
 * @method static Builder|LimeTokens417991 whereMpid($value)
 * @method static Builder|LimeTokens417991 whereParticipantId($value)
 * @method static Builder|LimeTokens417991 whereRemindercount($value)
 * @method static Builder|LimeTokens417991 whereRemindersent($value)
 * @method static Builder|LimeTokens417991 whereSent($value)
 * @method static Builder|LimeTokens417991 whereTid($value)
 * @method static Builder|LimeTokens417991 whereToken($value)
 * @method static Builder|LimeTokens417991 whereUsesleft($value)
 * @method static Builder|LimeTokens417991 whereValidfrom($value)
 * @method static Builder|LimeTokens417991 whereValiduntil($value)
 *
 * @property-read Profile|null $creator
 * @property-read Extra|null $extra
 * @property-read Profile|null $updater
 *
 * @mixin \Eloquent
 */
class LimeTokens417991 extends BaseModel
{
    /** @var bool */
    public $timestamps = false;

    /** @var string */
    protected $table = 'lime_tokens_417991';

    /** @var string */
    protected $primaryKey = 'tid';

    /** @var list<string> */
    protected $fillable = [
        'participant_id', 'firstname', 'lastname', 'email', 'emailstatus', 'token', 'language', 'blacklisted', 'sent', 'remindersent', 'remindercount', 'completed', 'usesleft', 'validfrom', 'validuntil', 'mpid', 'attribute_1', 'attribute_2',
    ];

    /** @var list<string> */
    protected $hidden = [
    ];

    /** @return array<string, string>     */
    /**
     * Get the casts for the model.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'tid' => 'int', 'participant_id' => 'string', 'firstname' => 'string', 'lastname' => 'string', 'email' => 'string', 'emailstatus' => 'string', 'token' => 'string', 'language' => 'string', 'blacklisted' => 'string', 'sent' => 'string', 'remindersent' => 'string', 'remindercount' => 'int', 'completed' => 'string', 'usesleft' => 'int', 'validfrom' => 'datetime', 'validuntil' => 'datetime', 'mpid' => 'int', 'attribute_1' => 'string', 'attribute_2' => 'string',
        ];
    }

    // Scopes...

    // Functions ...

    // Relations ...
}
