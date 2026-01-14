<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use Illuminate\Support\Carbon;
use Modules\Limesurvey\Contracts\LimeSurveyXXXContract;
use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeSurvey196427
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
 * @property string|null $refurl
 *
 * @property-read Profile|null $creator
 * @property-read Extra|null $extra
 * @property-read Profile|null $updater
 *
 * @mixin \Eloquent
 */
class LimeSurvey196427 extends BaseModel implements LimeSurveyXXXContract
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_survey_196427';

    /** @var string */
    protected $primaryKey = 'id';

    /** @var list<string> */
    protected $fillable = [
        'token', 'submitdate', 'lastpage', 'startlanguage', 'seed', 'startdate', 'datestamp', 'ipaddr', 'refurl', '196427X1028X33144', '196427X1028X33152', '196427X1028X33145', '196427X1028X33146', '196427X1028X33147', '196427X1028X33148', '196427X1028X33149', '196427X1028X33150', '196427X1028X33151',
    ];

    /** @var list<string> */
    protected $hidden = [
    ];

    /** @return array<string, string>     */
    protected $casts = [
        'id' => 'int', 'token' => 'string', 'submitdate' => 'datetime', 'lastpage' => 'int', 'startlanguage' => 'string', 'seed' => 'string', 'startdate' => 'datetime', 'datestamp' => 'datetime', 'ipaddr' => 'string', 'refurl' => 'string', '196427X1028X33144' => 'string', '196427X1028X33152' => 'string', '196427X1028X33145' => 'string', '196427X1028X33146' => 'string', '196427X1028X33147' => 'string', '196427X1028X33148' => 'string', '196427X1028X33149' => 'string', '196427X1028X33150' => 'string', '196427X1028X33151' => 'string',
    ];

    // Scopes...

    // Functions ...

    // Relations ...
}
