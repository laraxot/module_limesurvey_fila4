<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use Illuminate\Support\Carbon;
use Modules\Limesurvey\Contracts\LimeSurveyXXXContract;
use Modules\Limesurvey\Database\Factories\LimeSurvey821676Factory;
use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeSurvey821676
 *
 * @method static LimeSurvey821676Factory factory($count = null, $state = [])
 *
 * @property int $id
 * @property string|null $token
 * @property Carbon|null $submitdate
 * @property int|null $lastpage
 * @property string $startlanguage
 * @property string|null $seed
 *
 * @property-read Profile|null $creator
 * @property-read Extra|null $extra
 * @property-read Profile|null $updater
 *
 * @mixin \Eloquent
 */
class LimeSurvey821676 extends BaseModel implements LimeSurveyXXXContract
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_survey_821676';

    /** @var string */
    protected $primaryKey = 'id';

    /** @var list<string> */
    protected $fillable = [
        'token', 'submitdate', 'lastpage', 'startlanguage', 'seed', '821676X650X28755', '821676X650X287811', '821676X650X287812', '821676X650X287813', '821676X650X28781other', '821676X650X28785', '821676X650X28786', '821676X651X28787', '821676X651X28787other', '821676X651X29202', '821676X651X28788', '821676X651X287891', '821676X651X287892', '821676X651X287893', '821676X651X287894', '821676X651X28789other', '821676X651X28794', '821676X652X28795', '821676X652X28795other', '821676X652X29201', '821676X652X28796', '821676X652X287971', '821676X652X287972', '821676X652X287973', '821676X652X287974', '821676X652X28797other', '821676X652X28802', '821676X653X28803', '821676X653X28804', '821676X653X288051', '821676X653X288052', '821676X653X28805other', '821676X653X28808', '821676X654X28809', '821676X654X288101', '821676X654X288102', '821676X654X288103', '821676X654X28810other', '821676X654X28814', '821676X654X288151', '821676X654X288152', '821676X654X288153', '821676X654X288154', '821676X654X28815other', '821676X654X28820', '821676X654X28821', '821676X655X28822', '821676X655X28823', '821676X655X28824', '821676X655X288251', '821676X655X288252', '821676X655X288253', '821676X655X28825other', '821676X655X28829', '821676X655X288301', '821676X655X288302', '821676X655X288303', '821676X655X28830other', '821676X656X288341', '821676X656X288342', '821676X656X288343', '821676X656X288344', '821676X656X288345', '821676X656X288346', '821676X656X28834other', '821676X656X28841',
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
            'id' => 'int', 'token' => 'string', 'submitdate' => 'datetime', 'lastpage' => 'int', 'startlanguage' => 'string', 'seed' => 'string', '821676X650X28755' => 'string', '821676X650X287811' => 'string', '821676X650X287812' => 'string', '821676X650X287813' => 'string', '821676X650X28781other' => 'string', '821676X650X28785' => 'string', '821676X650X28786' => 'string', '821676X651X28787' => 'string', '821676X651X28787other' => 'string', '821676X651X29202' => 'string', '821676X651X28788' => 'string', '821676X651X287891' => 'string', '821676X651X287892' => 'string', '821676X651X287893' => 'string', '821676X651X287894' => 'string', '821676X651X28789other' => 'string', '821676X651X28794' => 'string', '821676X652X28795' => 'string', '821676X652X28795other' => 'string', '821676X652X29201' => 'string', '821676X652X28796' => 'string', '821676X652X287971' => 'string', '821676X652X287972' => 'string', '821676X652X287973' => 'string', '821676X652X287974' => 'string', '821676X652X28797other' => 'string', '821676X652X28802' => 'string', '821676X653X28803' => 'string', '821676X653X28804' => 'string', '821676X653X288051' => 'string', '821676X653X288052' => 'string', '821676X653X28805other' => 'string', '821676X653X28808' => 'string', '821676X654X28809' => 'string', '821676X654X288101' => 'string', '821676X654X288102' => 'string', '821676X654X288103' => 'string', '821676X654X28810other' => 'string', '821676X654X28814' => 'string', '821676X654X288151' => 'string', '821676X654X288152' => 'string', '821676X654X288153' => 'string', '821676X654X288154' => 'string', '821676X654X28815other' => 'string', '821676X654X28820' => 'string', '821676X654X28821' => 'string', '821676X655X28822' => 'string', '821676X655X28823' => 'string', '821676X655X28824' => 'string', '821676X655X288251' => 'string', '821676X655X288252' => 'string', '821676X655X288253' => 'string', '821676X655X28825other' => 'string', '821676X655X28829' => 'string', '821676X655X288301' => 'string', '821676X655X288302' => 'string', '821676X655X288303' => 'string', '821676X655X28830other' => 'string', '821676X656X288341' => 'string', '821676X656X288342' => 'string', '821676X656X288343' => 'string', '821676X656X288344' => 'string', '821676X656X288345' => 'string', '821676X656X288346' => 'string', '821676X656X28834other' => 'string', '821676X656X28841' => 'string',
        ];
    }

    // Scopes...

    // Functions ...

    // Relations ...
}
