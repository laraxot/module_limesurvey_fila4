<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeSurvey139982Timing
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
class LimeSurvey139982Timing extends BaseModel
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_survey_139982_timings';

    /** @var string */
    protected $primaryKey = 'id';

    /** @var list<string> */
    protected $fillable = [
        'interviewtime',
        '139982X812time',
        '139982X812X30336time',
        '139982X812X30337time',
        '139982X812X30338time',
        '139982X812X30339time',
        '139982X812X30340time',
        '139982X812X30341time',
    ];

    /** @var list<string> */
    protected $hidden = [
    ];

    /** @return array<string, string>     */
    protected $casts = [
        'id' => 'int',
        'interviewtime' => 'float',
        '139982X812time' => 'float',
        '139982X812X30336time' => 'float',
        '139982X812X30337time' => 'float',
        '139982X812X30338time' => 'float',
        '139982X812X30339time' => 'float',
        '139982X812X30340time' => 'float',
        '139982X812X30341time' => 'float',
    ];

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
