<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use Modules\Limesurvey\Database\Factories\LimeSurvey799586TimingsFactory;
use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeSurvey799586Timings
 *
 * @method static LimeSurvey799586TimingsFactory factory($count = null, $state = [])
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
class LimeSurvey799586Timings extends BaseModel
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_survey_799586_timings';

    /** @var string */
    protected $primaryKey = 'id';

    /** @var list<string> */
    protected $fillable = [
        'interviewtime', '799586X1018time', '799586X1018X33007time', '799586X1007time', '799586X1007X33041time', '799586X1007X33012time', '799586X1007X33013time', '799586X1007X33014time', '799586X1009time', '799586X1009X33044time', '799586X1008time', '799586X1008X33015time', '799586X1008X33016time', '799586X1008X33017time', '799586X1010time', '799586X1010X33018time', '799586X1010X33043time', '799586X1010X33019time', '799586X1010X33020time', '799586X1011time', '799586X1011X33021time', '799586X1011X33022time', '799586X1011X33023time', '799586X1012time', '799586X1012X33024time', '799586X1012X33025time', '799586X1012X33026time', '799586X1013time', '799586X1013X33027time', '799586X1013X33028time', '799586X1013X33029time', '799586X1014time', '799586X1014X33030time', '799586X1014X33031time', '799586X1015time', '799586X1015X33032time', '799586X1015X33033time', '799586X1015X33034time', '799586X1015X33042time', '799586X1015X33035time', '799586X1015X33036time', '799586X1016time', '799586X1016X33008time', '799586X1016X33009time', '799586X1016X33010time', '799586X1016X33037time', '799586X1016X33011time', '799586X1016X33038time', '799586X1017time', '799586X1017X33006time', '799586X1017X33039time', '799586X1017X33040time', '799586X1017X33045time',
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
        'id' => 'int', 'interviewtime' => 'float', '799586X1018time' => 'float', '799586X1018X33007time' => 'float', '799586X1007time' => 'float', '799586X1007X33041time' => 'float', '799586X1007X33012time' => 'float', '799586X1007X33013time' => 'float', '799586X1007X33014time' => 'float', '799586X1009time' => 'float', '799586X1009X33044time' => 'float', '799586X1008time' => 'float', '799586X1008X33015time' => 'float', '799586X1008X33016time' => 'float', '799586X1008X33017time' => 'float', '799586X1010time' => 'float', '799586X1010X33018time' => 'float', '799586X1010X33043time' => 'float', '799586X1010X33019time' => 'float', '799586X1010X33020time' => 'float', '799586X1011time' => 'float', '799586X1011X33021time' => 'float', '799586X1011X33022time' => 'float', '799586X1011X33023time' => 'float', '799586X1012time' => 'float', '799586X1012X33024time' => 'float', '799586X1012X33025time' => 'float', '799586X1012X33026time' => 'float', '799586X1013time' => 'float', '799586X1013X33027time' => 'float', '799586X1013X33028time' => 'float', '799586X1013X33029time' => 'float', '799586X1014time' => 'float', '799586X1014X33030time' => 'float', '799586X1014X33031time' => 'float', '799586X1015time' => 'float', '799586X1015X33032time' => 'float', '799586X1015X33033time' => 'float', '799586X1015X33034time' => 'float', '799586X1015X33042time' => 'float', '799586X1015X33035time' => 'float', '799586X1015X33036time' => 'float', '799586X1016time' => 'float', '799586X1016X33008time' => 'float', '799586X1016X33009time' => 'float', '799586X1016X33010time' => 'float', '799586X1016X33037time' => 'float', '799586X1016X33011time' => 'float', '799586X1016X33038time' => 'float', '799586X1017time' => 'float', '799586X1017X33006time' => 'float', '799586X1017X33039time' => 'float', '799586X1017X33040time' => 'float', '799586X1017X33045time' => 'float',
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
