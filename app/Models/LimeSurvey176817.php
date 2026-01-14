<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use Illuminate\Support\Carbon;
use Modules\Limesurvey\Contracts\LimeSurveyXXXContract;
use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeSurvey176817
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
class LimeSurvey176817 extends BaseModel implements LimeSurveyXXXContract
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_survey_176817';

    /** @var string */
    protected $primaryKey = 'id';

    /** @var list<string> */
    protected $fillable = [
        'token', 'submitdate', 'lastpage', 'startlanguage', 'seed', 'startdate', 'datestamp', 'ipaddr', '176817X795X30223', '176817X794X30215', '176817X794X30216', '176817X794X30217', '176817X794X30218', '176817X794X30219', '176817X794X30220', '176817X794X30221', '176817X794X30222SQ001', '176817X794X30222SQ002', '176817X794X30222SQ003', '176817X794X30222SQ004', '176817X794X30224',
    ];

    /** @var list<string> */
    protected $hidden = [
    ];

    /** @return array<string, string>     */
    protected $casts = [
        'id' => 'int', 'token' => 'string', 'submitdate' => 'datetime', 'lastpage' => 'int', 'startlanguage' => 'string', 'seed' => 'string', 'startdate' => 'datetime', 'datestamp' => 'datetime', 'ipaddr' => 'string', '176817X795X30223' => 'string', '176817X794X30215' => 'string', '176817X794X30216' => 'string', '176817X794X30217' => 'string', '176817X794X30218' => 'string', '176817X794X30219' => 'string', '176817X794X30220' => 'string', '176817X794X30221' => 'string', '176817X794X30222SQ001' => 'string', '176817X794X30222SQ002' => 'string', '176817X794X30222SQ003' => 'string', '176817X794X30222SQ004' => 'string', '176817X794X30224' => 'string',
    ];

    // Scopes...

    // Functions ...

    // Relations ...
}
