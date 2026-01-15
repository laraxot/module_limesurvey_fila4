<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use Illuminate\Support\Carbon;
use Modules\Limesurvey\Database\Factories\LimeSurveyLinkFactory;
use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeSurveyLink
 *
 * @method static LimeSurveyLinkFactory factory($count = null, $state = [])
 *
 * @property string $participant_id
 * @property int $token_id
 * @property int $survey_id
 * @property Carbon|null $date_created
 * @property Carbon|null $date_invited
 * @property Carbon|null $date_completed
 *
 * @property-read Profile|null $creator
 * @property-read Extra|null $extra
 * @property-read Profile|null $updater
 *
 * @mixin \Eloquent
 */
class LimeSurveyLink extends BaseModel
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_survey_links';

    /** @var string */
    protected $primaryKey = 'participant_id';

    /** @var list<string> */
    protected $fillable = [
        'token_id', 'survey_id', 'date_created', 'date_invited', 'date_completed',
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
        'participant_id' => 'string', 'token_id' => 'int', 'survey_id' => 'int', 'date_created' => 'datetime', 'date_invited' => 'datetime', 'date_completed' => 'datetime',
    ];
    }

    // Scopes...

    // Functions ...

    // Relations ...
}
