<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use Illuminate\Support\Carbon;
use Modules\Quaeris\Models\Profile;

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
 *
 * @property-read Profile|null $creator
 * @property-read Extra|null $extra
 * @property-read Profile|null $updater
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

    /** @var list<string> */
    protected $fillable = [
        'firstname', 'lastname', 'email', 'language', 'blacklisted', 'owner_uid', 'created_by', 'created', 'modified',
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
            'participant_id' => 'string', 'firstname' => 'string', 'lastname' => 'string', 'email' => 'string', 'language' => 'string', 'blacklisted' => 'string', 'owner_uid' => 'int', 'created_by' => 'int', 'created' => 'datetime', 'modified' => 'datetime',
        ];
    }

    // Scopes...

    // Functions ...

    // Relations ...
}
