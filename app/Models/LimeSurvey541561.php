<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use GeneaLabs\LaravelModelCaching\CachedBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Modules\Limesurvey\Contracts\LimeSurveyXXXContract;
use Modules\Quaeris\Datas\AnswersFilterData;
use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeSurvey541561
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
 *
 * @mixin \Eloquent
 */
class LimeSurvey541561 extends BaseModel implements LimeSurveyXXXContract
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_survey_541561';

    /** @var string */
    protected $primaryKey = 'id';

    /** @var list<string> */
    protected $fillable = [
        'token', 'submitdate', 'lastpage', 'startlanguage', 'seed', 'startdate', 'datestamp', 'ipaddr', '541561X1003X33065', '541561X1003X32948', '541561X1003X32949', '541561X1003X32950', '541561X1003X32951', '541561X1003X329551', '541561X1003X329552', '541561X1003X32957', '541561X1003X32957other', '541561X1003X33000', '541561X1003X329581', '541561X1003X329582', '541561X1003X329583', '541561X1003X33004', '541561X1003X33005', '541561X1003X32973', '541561X1003X32946', '541561X1003X32947', '541561X1003X32947other',
    ];

    /** @var list<string> */
    protected $hidden = [
    ];

    /** @return array<string, string>     */
    protected $casts = [
        'id' => 'int', 'token' => 'string', 'submitdate' => 'datetime', 'lastpage' => 'int', 'startlanguage' => 'string', 'seed' => 'string', 'startdate' => 'datetime', 'datestamp' => 'datetime', 'ipaddr' => 'string', '541561X1003X32948' => 'string', '541561X1003X32949' => 'string', '541561X1003X32950' => 'string', '541561X1003X32951' => 'string', '541561X1003X329551' => 'string', '541561X1003X329552' => 'string', '541561X1003X32957' => 'string', '541561X1003X32957other' => 'string', '541561X1003X33000' => 'string', '541561X1003X329581' => 'string', '541561X1003X329582' => 'string', '541561X1003X329583' => 'string', '541561X1003X33004' => 'string', '541561X1003X33005' => 'string', '541561X1003X32973' => 'string', '541561X1003X32946' => 'string', '541561X1003X32947' => 'string', '541561X1003X32947other' => 'string',
    ];

    // Scopes...

    // Functions ...

    // Relations ...
}
