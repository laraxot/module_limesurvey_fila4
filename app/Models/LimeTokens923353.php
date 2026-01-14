<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use Modules\Limesurvey\Database\Factories\LimeTokens923353Factory;
use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeTokens923353
 *
 * @method static LimeTokens923353Factory factory($count = null, $state = [])
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
 * @mixin \Eloquent
 */
class LimeTokens923353 extends BaseModel
{
    /** @var bool */
    public $timestamps = false;

    /** @var string */
    protected $table = 'lime_tokens_923353';

    /** @var string */
    protected $primaryKey = 'tid';

    /** @var list<string> */
    protected $fillable = [
        'tid',
        'participant_id',
        'firstname',
        'lastname',
        'email',
        'emailstatus',
        'token',
        'language',
        'blacklisted',
        'sent',
        'remindersent',
        'remindercount',
        'completed',
        'usesleft',
        'validfrom',
        'validuntil',
        'mpid',
        'attribute_1',
        'attribute_2',
        'attribute_3',
        'attribute_4',
        'attribute_5',
        'attribute_6',
        'attribute_7',
        'attribute_8',
        'attribute_9',
        'attribute_10',
        'attribute_11',
        'attribute_12',
        'attribute_13',
        'attribute_14',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var list<string>
     */
    protected $hidden = [
    ];

    /**
     * The attributes that should be casted to native types.
     * da fare.
     *
     * @var array<string, string>
     */
    protected $casts = [];

    /**
     * The attributes that should be mutated to dates.
     *  da fare.
     *
     * @var array<string>
     */
    protected $dates = [
    ];

    // Scopes...

    // Functions ...

    // Relations ...
}
