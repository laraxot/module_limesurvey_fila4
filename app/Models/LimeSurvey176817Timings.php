<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeSurvey176817Timings
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
class LimeSurvey176817Timings extends BaseModel
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_survey_176817_timings';

    /** @var string */
    protected $primaryKey = 'id';

    /** @var list<string> */
    protected $fillable = [
        'interviewtime', '176817X795time', '176817X795X30223time', '176817X794time', '176817X794X30215time', '176817X794X30216time', '176817X794X30217time', '176817X794X30218time', '176817X794X30219time', '176817X794X30220time', '176817X794X30221time', '176817X794X30222time', '176817X794X30224time',
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
            'id' => 'int', 'interviewtime' => 'float', '176817X795time' => 'float', '176817X795X30223time' => 'float', '176817X794time' => 'float', '176817X794X30215time' => 'float', '176817X794X30216time' => 'float', '176817X794X30217time' => 'float', '176817X794X30218time' => 'float', '176817X794X30219time' => 'float', '176817X794X30220time' => 'float', '176817X794X30221time' => 'float', '176817X794X30222time' => 'float', '176817X794X30224time' => 'float',
        ];
    }

    // Scopes...

    // Functions ...

    // Relations ...
}
