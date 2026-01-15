<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use Illuminate\Support\Carbon;
use Modules\Limesurvey\Database\Factories\LimeUserFactory;
use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeUser
 *
 * @method static LimeUserFactory factory($count = null, $state = [])
 *
 * @property int $uid
 * @property string $users_name
 * @property string $password
 * @property string $full_name
 * @property int $parent_id
 * @property string|null $lang
 * @property string|null $email
 * @property string|null $htmleditormode
 * @property string $templateeditormode
 * @property string $questionselectormode
 * @property string|null $one_time_pw
 * @property int $dateformat
 * @property Carbon|null $created
 * @property Carbon|null $modified
 * @property string|null $last_login
 * @property string|null $validation_key
 * @property string|null $validation_key_expiration
 * @property string|null $last_forgot_email_password
 *
 * @property-read Profile|null $creator
 * @property-read Extra|null $extra
 * @property-read Profile|null $updater
 *
 * @mixin \Eloquent
 */
class LimeUser extends BaseModel
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_users';

    /** @var string */
    protected $primaryKey = 'uid';

    /** @var list<string> */
    protected $fillable = [
        'users_name', 'password', 'full_name', 'parent_id', 'lang', 'email', 'htmleditormode', 'templateeditormode', 'questionselectormode', 'one_time_pw', 'dateformat', 'created', 'modified',
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
        'uid' => 'int', 'users_name' => 'string', 'password' => 'string', 'full_name' => 'string', 'parent_id' => 'int', 'lang' => 'string', 'email' => 'string', 'htmleditormode' => 'string', 'templateeditormode' => 'string', 'questionselectormode' => 'string', 'one_time_pw' => 'string', 'dateformat' => 'int', 'created' => 'datetime', 'modified' => 'datetime',
    ];
    }

    // Scopes...

    // Functions ...

    // Relations ...
}
