<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use Illuminate\Support\Carbon;
use Modules\Limesurvey\Contracts\LimeSurveyXXXContract;
use Modules\Limesurvey\Database\Factories\LimeSurvey799586Factory;
use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeSurvey799586
 *
 * @method static LimeSurvey799586Factory factory($count = null, $state = [])
 *
 * @property int $id
 * @property string|null $token
 * @property Carbon|null $submitdate
 * @property int|null $lastpage
 * @property string $startlanguage
 * @property string|null $seed
 * @property Carbon $startdate
 * @property Carbon $datestamp
 * @property string|null $ipaddr
 *
 * @property-read Profile|null $creator
 * @property-read Extra|null $extra
 * @property-read Profile|null $updater
 *
 * @mixin \Eloquent
 */
class LimeSurvey799586 extends BaseModel implements LimeSurveyXXXContract
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_survey_799586';

    /** @var string */
    protected $primaryKey = 'id';

    /** @var list<string> */
    protected $fillable = [
        'token', 'submitdate', 'lastpage', 'startlanguage', 'seed', 'startdate', 'datestamp', 'ipaddr', '799586X1018X33007', '799586X1007X33041', '799586X1007X33012', '799586X1007X33013', '799586X1007X33014', '799586X1009X33044', '799586X1008X33015B01#0', '799586X1008X33015B01#1', '799586X1008X33015B02#0', '799586X1008X33015B02#1', '799586X1008X33016', '799586X1008X33017', '799586X1010X33018B04#0', '799586X1010X33018B04#1', '799586X1010X33018B05#0', '799586X1010X33018B05#1', '799586X1010X33018B06#0', '799586X1010X33018B06#1', '799586X1010X33018B07#0', '799586X1010X33018B07#1', '799586X1010X33018B09#0', '799586X1010X33018B09#1', '799586X1010X33018B10#0', '799586X1010X33018B10#1', '799586X1010X33043B08#0', '799586X1010X33043B08#1', '799586X1010X33019', '799586X1010X33020', '799586X1011X33021B12#0', '799586X1011X33021B12#1', '799586X1011X33021B13#0', '799586X1011X33021B13#1', '799586X1011X33021B14#0', '799586X1011X33021B14#1', '799586X1011X33021B15#0', '799586X1011X33021B15#1', '799586X1011X33022', '799586X1011X33023', '799586X1012X33024B17#0', '799586X1012X33024B17#1', '799586X1012X33024B18#0', '799586X1012X33024B18#1', '799586X1012X33024B19#0', '799586X1012X33024B19#1', '799586X1012X33024B20#0', '799586X1012X33024B20#1', '799586X1012X33025', '799586X1012X33026', '799586X1013X33027B22#0', '799586X1013X33027B22#1', '799586X1013X33027B23#0', '799586X1013X33027B23#1', '799586X1013X33028', '799586X1013X33029', '799586X1014X33030', '799586X1014X330311', '799586X1014X330312', '799586X1014X330313', '799586X1014X330314', '799586X1014X330315', '799586X1015X33032', '799586X1015X33033', '799586X1015X33034', '799586X1015X33042', '799586X1015X33035', '799586X1015X33036', '799586X1015X33036other', '799586X1016X33008', '799586X1016X33009', '799586X1016X33010', '799586X1016X33037', '799586X1016X33011', '799586X1016X33038', '799586X1017X33006', '799586X1017X33006other', '799586X1017X33039', '799586X1017X33040', '799586X1017X33045',
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
            'id' => 'int', 'token' => 'string', 'submitdate' => 'datetime', 'lastpage' => 'int', 'startlanguage' => 'string', 'seed' => 'string', 'startdate' => 'datetime', 'datestamp' => 'datetime', 'ipaddr' => 'string', '799586X1018X33007' => 'string', '799586X1007X33041' => 'string', '799586X1007X33012' => 'string', '799586X1007X33013' => 'string', '799586X1007X33014' => 'string', '799586X1009X33044' => 'string', '799586X1008X33015B01#0' => 'string', '799586X1008X33015B01#1' => 'string', '799586X1008X33015B02#0' => 'string', '799586X1008X33015B02#1' => 'string', '799586X1008X33016' => 'string', '799586X1008X33017' => 'string', '799586X1010X33018B04#0' => 'string', '799586X1010X33018B04#1' => 'string', '799586X1010X33018B05#0' => 'string', '799586X1010X33018B05#1' => 'string', '799586X1010X33018B06#0' => 'string', '799586X1010X33018B06#1' => 'string', '799586X1010X33018B07#0' => 'string', '799586X1010X33018B07#1' => 'string', '799586X1010X33018B09#0' => 'string', '799586X1010X33018B09#1' => 'string', '799586X1010X33018B10#0' => 'string', '799586X1010X33018B10#1' => 'string', '799586X1010X33043B08#0' => 'string', '799586X1010X33043B08#1' => 'string', '799586X1010X33019' => 'string', '799586X1010X33020' => 'string', '799586X1011X33021B12#0' => 'string', '799586X1011X33021B12#1' => 'string', '799586X1011X33021B13#0' => 'string', '799586X1011X33021B13#1' => 'string', '799586X1011X33021B14#0' => 'string', '799586X1011X33021B14#1' => 'string', '799586X1011X33021B15#0' => 'string', '799586X1011X33021B15#1' => 'string', '799586X1011X33022' => 'string', '799586X1011X33023' => 'string', '799586X1012X33024B17#0' => 'string', '799586X1012X33024B17#1' => 'string', '799586X1012X33024B18#0' => 'string', '799586X1012X33024B18#1' => 'string', '799586X1012X33024B19#0' => 'string', '799586X1012X33024B19#1' => 'string', '799586X1012X33024B20#0' => 'string', '799586X1012X33024B20#1' => 'string', '799586X1012X33025' => 'string', '799586X1012X33026' => 'string', '799586X1013X33027B22#0' => 'string', '799586X1013X33027B22#1' => 'string', '799586X1013X33027B23#0' => 'string', '799586X1013X33027B23#1' => 'string', '799586X1013X33028' => 'string', '799586X1013X33029' => 'string', '799586X1014X33030' => 'string', '799586X1014X330311' => 'string', '799586X1014X330312' => 'string', '799586X1014X330313' => 'string', '799586X1014X330314' => 'string', '799586X1014X330315' => 'string', '799586X1015X33032' => 'string', '799586X1015X33033' => 'string', '799586X1015X33034' => 'string', '799586X1015X33042' => 'string', '799586X1015X33035' => 'string', '799586X1015X33036' => 'string', '799586X1015X33036other' => 'string', '799586X1016X33008' => 'string', '799586X1016X33010' => 'string', '799586X1016X33037' => 'string', '799586X1016X33011' => 'string', '799586X1016X33038' => 'string', '799586X1017X33006' => 'string', '799586X1017X33006other' => 'string', '799586X1017X33039' => 'datetime', '799586X1017X33040' => 'datetime',
        ];
    }

    // Scopes...

    // Functions ...

    // Relations ...
}
