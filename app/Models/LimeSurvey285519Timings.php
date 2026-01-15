<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeSurvey285519Timings
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
class LimeSurvey285519Timings extends BaseModel
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_survey_285519_timings';

    /** @var string */
    protected $primaryKey = 'id';

    /** @var list<string> */
    protected $fillable = [
        'interviewtime', '285519X1033time', '285519X1033X33181time', '285519X1033X33182time', '285519X1033X33183time', '285519X1034time', '285519X1034X33184time', '285519X1035time', '285519X1035X33185time', '285519X1035X33186time', '285519X1036time', '285519X1036X33187time', '285519X1036X33188time', '285519X1036X33189time', '285519X1036X33190time', '285519X1036X33191time', '285519X1036X33192time',
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
            'id' => 'int', 'interviewtime' => 'float', '285519X1033time' => 'float', '285519X1033X33181time' => 'float', '285519X1033X33182time' => 'float', '285519X1033X33183time' => 'float', '285519X1034time' => 'float', '285519X1034X33184time' => 'float', '285519X1035time' => 'float', '285519X1035X33185time' => 'float', '285519X1035X33186time' => 'float', '285519X1036time' => 'float', '285519X1036X33187time' => 'float', '285519X1036X33188time' => 'float', '285519X1036X33189time' => 'float', '285519X1036X33190time' => 'float', '285519X1036X33191time' => 'float', '285519X1036X33192time' => 'float',
        ];
    }

    // Scopes...

    // Functions ...

    // Relations ...
}
