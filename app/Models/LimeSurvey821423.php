<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use Illuminate\Support\Carbon;
use Modules\Limesurvey\Contracts\LimeSurveyXXXContract;
use Modules\Limesurvey\Database\Factories\LimeSurvey821423Factory;
use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeSurvey821423
 *
 * @method static LimeSurvey821423Factory factory($count = null, $state = [])
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
class LimeSurvey821423 extends BaseModel implements LimeSurveyXXXContract
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_survey_821423';

    /** @var string */
    protected $primaryKey = 'id';

    /** @var list<string> */
    protected $fillable = [
        'token', 'submitdate', 'lastpage', 'startlanguage', 'seed', 'startdate', 'datestamp', '821423X959X32256', '821423X959X32256other', '821423X971X32334', '821423X972X32257SQ001', '821423X972X32257SQ002', '821423X972X32257SQ003', '821423X972X32257SQ004', '821423X972X32257SQ005', '821423X972X32257SQ006', '821423X972X32257SQ007', '821423X972X32257SQ008', '821423X972X32257SQ009', '821423X972X32257SQ010', '821423X972X32257SQ011', '821423X972X32347SQ001', '821423X972X32347SQ002', '821423X972X32347SQ003', '821423X972X32347SQ004', '821423X972X32347SQ005', '821423X972X32347SQ006', '821423X972X32347SQ007', '821423X972X32347SQ008', '821423X972X32347SQ009', '821423X972X32347SQ010', '821423X972X32347SQ011', '821423X972X32359SQ001', '821423X972X32372', '821423X966X32375', '821423X966X32376', '821423X966X32376other', '821423X966X323771', '821423X966X323772', '821423X966X323773', '821423X966X323774', '821423X966X323775', '821423X966X323776', '821423X966X323777', '821423X966X323778', '821423X966X323779', '821423X966X3237710', '821423X966X3237711', '821423X966X32612', '821423X967X32378SQ001', '821423X967X32380', '821423X967X32386', '821423X967X32395SQ001', '821423X967X32395SQ002', '821423X967X32395SQ003', '821423X967X32395SQ004', '821423X968X32401', '821423X969X32402SQ001', '821423X969X32402SQ002', '821423X969X32402SQ003', '821423X969X32402SQ004', '821423X969X32402SQ005', '821423X969X32402SQ006', '821423X969X32409', '821423X969X32415SQ001', '821423X969X32415SQ002', '821423X969X32415SQ003', '821423X969X32415SQ004', '821423X969X32427SQ001', '821423X969X32427SQ002', '821423X969X32427SQ003', '821423X969X32427SQ004', '821423X970X32439', '821423X970X32440', '821423X970X32446', '821423X970X32447', '821423X970X32448', '821423X970X32449',
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
            'id' => 'int', 'token' => 'string', 'submitdate' => 'datetime', 'lastpage' => 'int', 'startlanguage' => 'string', 'seed' => 'string', 'startdate' => 'datetime', 'datestamp' => 'datetime', '821423X959X32256' => 'string', '821423X959X32256other' => 'string', '821423X971X32334' => 'string', '821423X972X32257SQ001' => 'string', '821423X972X32257SQ002' => 'string', '821423X972X32257SQ003' => 'string', '821423X972X32257SQ004' => 'string', '821423X972X32257SQ005' => 'string', '821423X972X32257SQ006' => 'string', '821423X972X32257SQ007' => 'string', '821423X972X32257SQ008' => 'string', '821423X972X32257SQ009' => 'string', '821423X972X32257SQ010' => 'string', '821423X972X32257SQ011' => 'string', '821423X972X32347SQ001' => 'string', '821423X972X32347SQ002' => 'string', '821423X972X32347SQ003' => 'string', '821423X972X32347SQ004' => 'string', '821423X972X32347SQ005' => 'string', '821423X972X32347SQ006' => 'string', '821423X972X32347SQ007' => 'string', '821423X972X32347SQ008' => 'string', '821423X972X32347SQ009' => 'string', '821423X972X32347SQ010' => 'string', '821423X972X32347SQ011' => 'string', '821423X972X32359SQ001' => 'string', '821423X972X32372' => 'string', '821423X966X32375' => 'string', '821423X966X32376' => 'string', '821423X966X32376other' => 'string', '821423X966X323771' => 'string', '821423X966X323772' => 'string', '821423X966X323773' => 'string', '821423X966X323774' => 'string', '821423X966X323775' => 'string', '821423X966X323776' => 'string', '821423X966X323777' => 'string', '821423X966X323778' => 'string', '821423X966X323779' => 'string', '821423X966X3237710' => 'string', '821423X966X3237711' => 'string', '821423X966X32612' => 'string', '821423X967X32378SQ001' => 'string', '821423X967X32380' => 'string', '821423X967X32386' => 'string', '821423X967X32395SQ001' => 'string', '821423X967X32395SQ002' => 'string', '821423X967X32395SQ003' => 'string', '821423X967X32395SQ004' => 'string', '821423X968X32401' => 'string', '821423X969X32402SQ001' => 'string', '821423X969X32402SQ002' => 'string', '821423X969X32402SQ003' => 'string', '821423X969X32402SQ004' => 'string', '821423X969X32402SQ005' => 'string', '821423X969X32402SQ006' => 'string', '821423X969X32409' => 'string', '821423X969X32415SQ001' => 'string', '821423X969X32415SQ002' => 'string', '821423X969X32415SQ003' => 'string', '821423X969X32415SQ004' => 'string', '821423X969X32427SQ001' => 'string', '821423X969X32427SQ002' => 'string', '821423X969X32427SQ003' => 'string', '821423X969X32427SQ004' => 'string', '821423X970X32439' => 'string', '821423X970X32440' => 'string', '821423X970X32446' => 'string', '821423X970X32447' => 'string', '821423X970X32448' => 'string', '821423X970X32449' => 'string',
        ];
    }

    // Scopes...

    // Functions ...

    // Relations ...
}
