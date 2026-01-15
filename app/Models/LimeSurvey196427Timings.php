<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeSurvey196427Timings
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
class LimeSurvey196427Timings extends BaseModel
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_survey_196427_timings';

    /** @var string */
    protected $primaryKey = 'id';

    /** @var list<string> */
    protected $fillable = [
        'interviewtime', '196427X1028time', '196427X1028X33144time', '196427X1028X33152time', '196427X1028X33145time', '196427X1028X33146time', '196427X1028X33147time', '196427X1028X33148time', '196427X1028X33149time', '196427X1028X33150time', '196427X1028X33151time',
    ];

    /** @var list<string> */
    protected $hidden = [
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array<string>
     */
    protected $dates = [
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
            'id' => 'int', 'interviewtime' => 'float', '196427X1028time' => 'float', '196427X1028X33144time' => 'float', '196427X1028X33152time' => 'float', '196427X1028X33145time' => 'float', '196427X1028X33146time' => 'float', '196427X1028X33147time' => 'float', '196427X1028X33148time' => 'float', '196427X1028X33149time' => 'float', '196427X1028X33150time' => 'float', '196427X1028X33151time' => 'float',
        ];
    }

    // Scopes...

    // Functions ...

    // Relations ...
}
