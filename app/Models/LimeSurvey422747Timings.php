<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeSurvey422747Timings
 *
 * @property int $id
 * @property float|null $interviewtime
 *
 * @property-read Profile|null $creator
 * @property-read Extra|null $extra
 * @property-read Profile|null $updater
 *
 * @mixin \Eloquent
 */
class LimeSurvey422747Timings extends BaseModel
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_survey_422747_timings';

    /** @var string */
    protected $primaryKey = 'id';

    /** @var list<string> */
    protected $fillable = [
        'interviewtime', '422747X941time', '422747X941X32056time', '422747X941X32033time', '422747X941X32034time', '422747X941X32035time', '422747X942time', '422747X942X32036time', '422747X942X32042time', '422747X942X32043time', '422747X942X32044time', '422747X942X32045time', '422747X942X32046time', '422747X943time', '422747X943X32037time', '422747X943X32047time', '422747X943X32048time', '422747X943X32049time', '422747X944time', '422747X944X32038time', '422747X944X32039time', '422747X944X32040time', '422747X944X32041time', '422747X944X32052time', '422747X944X32050time', '422747X945time', '422747X945X32051time', '422747X945X32053time', '422747X945X32054time', '422747X945X32055time', '422747X945X32057time', '422747X945X32058time',
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
        'id' => 'int', 'interviewtime' => 'float', '422747X941time' => 'float', '422747X941X32056time' => 'float', '422747X941X32033time' => 'float', '422747X941X32034time' => 'float', '422747X941X32035time' => 'float', '422747X942time' => 'float', '422747X942X32036time' => 'float', '422747X942X32042time' => 'float', '422747X942X32043time' => 'float', '422747X942X32044time' => 'float', '422747X942X32045time' => 'float', '422747X942X32046time' => 'float', '422747X943time' => 'float', '422747X943X32037time' => 'float', '422747X943X32047time' => 'float', '422747X943X32048time' => 'float', '422747X943X32049time' => 'float', '422747X944time' => 'float', '422747X944X32038time' => 'float', '422747X944X32039time' => 'float', '422747X944X32040time' => 'float', '422747X944X32041time' => 'float', '422747X944X32052time' => 'float', '422747X944X32050time' => 'float', '422747X945time' => 'float', '422747X945X32051time' => 'float', '422747X945X32053time' => 'float', '422747X945X32054time' => 'float', '422747X945X32055time' => 'float', '422747X945X32057time' => 'float', '422747X945X32058time' => 'float',
    ];
    }

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array<string>
     */
    protected $dates = [
    ];

    // Scopes...

    // Functions ...

    // Relations ...
}
