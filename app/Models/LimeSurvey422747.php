<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use Illuminate\Support\Carbon;
use Modules\Limesurvey\Contracts\LimeSurveyXXXContract;
use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeSurvey422747
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
class LimeSurvey422747 extends BaseModel implements LimeSurveyXXXContract
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_survey_422747';

    /** @var string */
    protected $primaryKey = 'id';

    /** @var list<string> */
    protected $fillable = [
        'token', 'submitdate', 'lastpage', 'startlanguage', 'seed', 'startdate', 'datestamp', 'ipaddr', '422747X941X32056', '422747X941X32033', '422747X941X32034', '422747X941X32034other', '422747X941X32035', '422747X942X32036004_01', '422747X942X32036004_02', '422747X942X32036005_01', '422747X942X32036005_02', '422747X942X32036006_01', '422747X942X32036006_02', '422747X942X32036007_01', '422747X942X32036007_02', '422747X942X32036008_01', '422747X942X32036008_02', '422747X942X32036009_01', '422747X942X32036009_02', '422747X942X32036010_01', '422747X942X32036010_02', '422747X942X32036011_01', '422747X942X32036011_02', '422747X942X32036012_01', '422747X942X32036012_02', '422747X942X32036013_01', '422747X942X32036013_02', '422747X942X32036014_01', '422747X942X32036014_02', '422747X942X32036015_01', '422747X942X32036015_02', '422747X942X32036016_01', '422747X942X32036016_02', '422747X942X32036017_01', '422747X942X32036017_02', '422747X942X32036018_01', '422747X942X32036018_02', '422747X942X32036019_01', '422747X942X32036019_02', '422747X942X32036020_01', '422747X942X32036020_02', '422747X942X32042', '422747X942X32043', '422747X942X32044023_001', '422747X942X32044023_002', '422747X942X32045', '422747X942X32046025_001', '422747X942X32046025_002', '422747X943X32037', '422747X943X32047', '422747X943X32048', '422747X943X320491', '422747X943X320492', '422747X943X320493', '422747X943X320494', '422747X943X320495', '422747X943X320496', '422747X943X320497', '422747X943X320498', '422747X943X320499', '422747X944X32038', '422747X944X32039', '422747X944X32040', '422747X944X32040other', '422747X944X32041', '422747X944X32052', '422747X944X32050', '422747X945X32051', '422747X945X32053', '422747X945X32054', '422747X945X32055', '422747X945X32057', '422747X945X32058', '422747X945X32058other',
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
        'id' => 'int', 'token' => 'string', 'submitdate' => 'datetime', 'lastpage' => 'int', 'startlanguage' => 'string', 'seed' => 'string', 'startdate' => 'datetime', 'datestamp' => 'datetime', 'ipaddr' => 'string', '422747X941X32056' => 'string', '422747X941X32033' => 'string', '422747X941X32034' => 'string', '422747X941X32034other' => 'string', '422747X941X32035' => 'string', '422747X942X32036004_01' => 'string', '422747X942X32036004_02' => 'string', '422747X942X32036005_01' => 'string', '422747X942X32036005_02' => 'string', '422747X942X32036006_01' => 'string', '422747X942X32036006_02' => 'string', '422747X942X32036007_01' => 'string', '422747X942X32036007_02' => 'string', '422747X942X32036008_01' => 'string', '422747X942X32036008_02' => 'string', '422747X942X32036009_01' => 'string', '422747X942X32036009_02' => 'string', '422747X942X32036010_01' => 'string', '422747X942X32036010_02' => 'string', '422747X942X32036011_01' => 'string', '422747X942X32036011_02' => 'string', '422747X942X32036012_01' => 'string', '422747X942X32036012_02' => 'string', '422747X942X32036013_01' => 'string', '422747X942X32036013_02' => 'string', '422747X942X32036014_01' => 'string', '422747X942X32036014_02' => 'string', '422747X942X32036015_01' => 'string', '422747X942X32036015_02' => 'string', '422747X942X32036016_01' => 'string', '422747X942X32036016_02' => 'string', '422747X942X32036017_01' => 'string', '422747X942X32036017_02' => 'string', '422747X942X32036018_01' => 'string', '422747X942X32036018_02' => 'string', '422747X942X32036019_01' => 'string', '422747X942X32036019_02' => 'string', '422747X942X32036020_01' => 'string', '422747X942X32036020_02' => 'string', '422747X942X32042' => 'string', '422747X942X32043' => 'string', '422747X942X32044023_001' => 'string', '422747X942X32044023_002' => 'string', '422747X942X32045' => 'string', '422747X942X32046025_001' => 'string', '422747X942X32046025_002' => 'string', '422747X943X32037' => 'string', '422747X943X32047' => 'string', '422747X943X32048' => 'string', '422747X943X320491' => 'string', '422747X943X320492' => 'string', '422747X943X320493' => 'string', '422747X943X320494' => 'string', '422747X943X320495' => 'string', '422747X943X320496' => 'string', '422747X943X320497' => 'string', '422747X943X320498' => 'string', '422747X943X320499' => 'string', '422747X944X32038' => 'string', '422747X944X32039' => 'string', '422747X944X32040' => 'string', '422747X944X32040other' => 'string', '422747X944X32041' => 'string', '422747X944X32052' => 'string', '422747X944X32050' => 'string', '422747X945X32051' => 'string', '422747X945X32053' => 'string', '422747X945X32054' => 'datetime', '422747X945X32055' => 'datetime', '422747X945X32057' => 'string', '422747X945X32058' => 'string', '422747X945X32058other' => 'string',
    ];
    }

    // Scopes...

    // Functions ...

    // Relations ...
}
