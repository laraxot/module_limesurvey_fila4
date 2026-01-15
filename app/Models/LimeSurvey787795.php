<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use Illuminate\Support\Carbon;
use Modules\Limesurvey\Contracts\LimeSurveyXXXContract;
use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeSurvey787795
 *
 * @property int $id
 * @property string|null $token
 * @property Carbon|null $submitdate
 * @property int|null $lastpage
 * @property string $startlanguage
 * @property string|null $seed
 * @property Carbon $startdate
 * @property Carbon $datestamp
 *
 * @property-read Profile|null $creator
 * @property-read Extra|null $extra
 * @property-read Profile|null $updater
 *
 * @mixin \Eloquent
 */
class LimeSurvey787795 extends BaseModel implements LimeSurveyXXXContract
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_survey_787795';

    /** @var string */
    protected $primaryKey = 'id';

    /** @var list<string> */
    protected $fillable = [
        'token', 'submitdate', 'lastpage', 'startlanguage', 'seed', 'startdate', 'datestamp', '787795X946X32093', '787795X946X32094', '787795X947X32138', '787795X947X32095', '787795X947X32096', '787795X947X32097', '787795X947X32098', '787795X947X32099', '787795X947X32100', '787795X947X32101', '787795X947X32102', '787795X947X32103SQ001', '787795X947X32104SQ001', '787795X947X32104SQ002', '787795X947X32104SQ003', '787795X947X32104SQ004', '787795X948X32139', '787795X948X32105', '787795X948X32106', '787795X948X32107', '787795X948X32108', '787795X948X32109', '787795X948X32110', '787795X948X32111SQ001', '787795X948X32112', '787795X948X32113SQ001', '787795X948X32114SQ001', '787795X948X32114SQ002', '787795X948X32114SQ003', '787795X948X32114SQ004', '787795X949X32140', '787795X949X32115', '787795X949X32143SQ001', '787795X949X32144', '787795X949X32116', '787795X949X32121', '787795X949X32117', '787795X949X32118', '787795X949X32122', '787795X949X32123', '787795X949X32124', '787795X949X32125', '787795X949X32119SQ001', '787795X949X32120SQ001', '787795X949X32120SQ002', '787795X949X32120SQ003', '787795X949X32120SQ004', '787795X949X32120SQ005', '787795X950X32126', '787795X950X32127', '787795X950X32127other', '787795X950X32128', '787795X950X32129SQ001', '787795X950X32130SQ001', '787795X950X32130SQ002', '787795X951X32135', '787795X951X32131SQ001', '787795X951X32132', '787795X951X32136SQ001', '787795X951X32137', '787795X951X32133SQ001', '787795X951X32134SQ001', '787795X951X32134SQ002', '787795X952X32142', '787795X952X32141',
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
        'id' => 'int', 'token' => 'string', 'submitdate' => 'datetime', 'lastpage' => 'int', 'startlanguage' => 'string', 'seed' => 'string', 'startdate' => 'datetime', 'datestamp' => 'datetime', '787795X946X32093' => 'string', '787795X946X32094' => 'string', '787795X947X32138' => 'string', '787795X947X32095' => 'string', '787795X947X32096' => 'string', '787795X947X32097' => 'string', '787795X947X32098' => 'string', '787795X947X32099' => 'string', '787795X947X32100' => 'string', '787795X947X32101' => 'string', '787795X947X32102' => 'string', '787795X947X32103SQ001' => 'string', '787795X947X32104SQ001' => 'string', '787795X947X32104SQ002' => 'string', '787795X947X32104SQ003' => 'string', '787795X947X32104SQ004' => 'string', '787795X948X32139' => 'string', '787795X948X32105' => 'string', '787795X948X32106' => 'string', '787795X948X32107' => 'string', '787795X948X32108' => 'string', '787795X948X32109' => 'string', '787795X948X32110' => 'string', '787795X948X32111SQ001' => 'string', '787795X948X32112' => 'string', '787795X948X32113SQ001' => 'string', '787795X948X32114SQ001' => 'string', '787795X948X32114SQ002' => 'string', '787795X948X32114SQ003' => 'string', '787795X948X32114SQ004' => 'string', '787795X949X32140' => 'string', '787795X949X32115' => 'string', '787795X949X32143SQ001' => 'string', '787795X949X32144' => 'string', '787795X949X32121' => 'string', '787795X949X32117' => 'string', '787795X949X32118' => 'string', '787795X949X32122' => 'string', '787795X949X32123' => 'string', '787795X949X32124' => 'string', '787795X949X32125' => 'string', '787795X949X32119SQ001' => 'string', '787795X949X32120SQ001' => 'string', '787795X949X32120SQ002' => 'string', '787795X949X32120SQ003' => 'string', '787795X949X32120SQ004' => 'string', '787795X949X32120SQ005' => 'string', '787795X950X32126' => 'string', '787795X950X32127' => 'string', '787795X950X32127other' => 'string', '787795X950X32128' => 'string', '787795X950X32129SQ001' => 'string', '787795X950X32130SQ001' => 'string', '787795X950X32130SQ002' => 'string', '787795X951X32135' => 'string', '787795X951X32131SQ001' => 'string', '787795X951X32132' => 'string', '787795X951X32136SQ001' => 'string', '787795X951X32137' => 'string', '787795X951X32133SQ001' => 'string', '787795X951X32134SQ001' => 'string', '787795X951X32134SQ002' => 'string', '787795X952X32142' => 'string', '787795X952X32141' => 'string',
    ];
    }

    // Scopes...

    // Functions ...

    // Relations ...
}
