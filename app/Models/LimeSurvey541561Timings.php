<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeSurvey541561Timings
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
class LimeSurvey541561Timings extends BaseModel
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_survey_541561_timings';

    /** @var string */
    protected $primaryKey = 'id';

    /** @var list<string> */
    protected $fillable = [
        'interviewtime', '541561X1003time', '541561X1003X33065time', '541561X1003X32948time', '541561X1003X32949time', '541561X1003X32950time', '541561X1003X32951time', '541561X1003X32955time', '541561X1003X32957time', '541561X1003X33000time', '541561X1003X32958time', '541561X1003X33004time', '541561X1003X33005time', '541561X1003X32973time', '541561X1003X32946time', '541561X1003X32947time',
    ];

    /** @var list<string> */
    protected $hidden = [
    ];

    /** @return array<string, string>     */
    protected $casts = [
        'id' => 'int', 'interviewtime' => 'float', '541561X1003time' => 'float', '541561X1003X33065time' => 'float', '541561X1003X32948time' => 'float', '541561X1003X32949time' => 'float', '541561X1003X32950time' => 'float', '541561X1003X32951time' => 'float', '541561X1003X32955time' => 'float', '541561X1003X32957time' => 'float', '541561X1003X33000time' => 'float', '541561X1003X32958time' => 'float', '541561X1003X33004time' => 'float', '541561X1003X33005time' => 'float', '541561X1003X32973time' => 'float', '541561X1003X32946time' => 'float', '541561X1003X32947time' => 'float',
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
