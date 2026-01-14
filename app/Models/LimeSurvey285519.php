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
 * Modules\Limesurvey\Models\LimeSurvey285519
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
class LimeSurvey285519 extends BaseModel implements LimeSurveyXXXContract
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_survey_285519';

    /** @var string */
    protected $primaryKey = 'id';

    /** @var list<string> */
    protected $fillable = [
        'token', 'submitdate', 'lastpage', 'startlanguage', 'seed', 'startdate', 'datestamp', 'ipaddr', '285519X1033X33181', '285519X1033X33182', '285519X1033X33182other', '285519X1033X33183', '285519X1034X331844#0', '285519X1034X331844#1', '285519X1034X331845#0', '285519X1034X331845#1', '285519X1034X331846#0', '285519X1034X331846#1', '285519X1034X331847#0', '285519X1034X331847#1', '285519X1034X331848#0', '285519X1034X331848#1', '285519X1034X331849#0', '285519X1034X331849#1', '285519X1034X3318410#0', '285519X1034X3318410#1', '285519X1034X3318411#0', '285519X1034X3318411#1', '285519X1034X3318412#0', '285519X1034X3318412#1', '285519X1034X3318413#0', '285519X1034X3318413#1', '285519X1034X3318414#0', '285519X1034X3318414#1', '285519X1034X3318415#0', '285519X1034X3318415#1', '285519X1034X3318416#0', '285519X1034X3318416#1', '285519X1034X3318417#0', '285519X1034X3318417#1', '285519X1034X3318418#0', '285519X1034X3318418#1', '285519X1034X3318419#0', '285519X1034X3318419#1', '285519X1035X33185', '285519X1035X33186', '285519X1036X33187', '285519X1036X33188', '285519X1036X33189', '285519X1036X33189other', '285519X1036X33190', '285519X1036X33191', '285519X1036X33192',
    ];

    /** @var list<string> */
    protected $hidden = [
    ];

    /** @return array<string, string>     */
    protected $casts = [
        'id' => 'int', 'token' => 'string', 'submitdate' => 'datetime', 'lastpage' => 'int', 'startlanguage' => 'string', 'seed' => 'string', 'startdate' => 'datetime', 'datestamp' => 'datetime', 'ipaddr' => 'string', '285519X1033X33181' => 'string', '285519X1033X33182' => 'string', '285519X1033X33182other' => 'string', '285519X1033X33183' => 'string', '285519X1034X331844#0' => 'string', '285519X1034X331844#1' => 'string', '285519X1034X331845#0' => 'string', '285519X1034X331845#1' => 'string', '285519X1034X331846#0' => 'string', '285519X1034X331846#1' => 'string', '285519X1034X331847#0' => 'string', '285519X1034X331847#1' => 'string', '285519X1034X331848#0' => 'string', '285519X1034X331848#1' => 'string', '285519X1034X331849#0' => 'string', '285519X1034X331849#1' => 'string', '285519X1034X3318410#0' => 'string', '285519X1034X3318410#1' => 'string', '285519X1034X3318411#0' => 'string', '285519X1034X3318411#1' => 'string', '285519X1034X3318412#0' => 'string', '285519X1034X3318412#1' => 'string', '285519X1034X3318413#0' => 'string', '285519X1034X3318413#1' => 'string', '285519X1034X3318414#0' => 'string', '285519X1034X3318414#1' => 'string', '285519X1034X3318415#0' => 'string', '285519X1034X3318415#1' => 'string', '285519X1034X3318416#0' => 'string', '285519X1034X3318416#1' => 'string', '285519X1034X3318417#0' => 'string', '285519X1034X3318417#1' => 'string', '285519X1034X3318418#0' => 'string', '285519X1034X3318418#1' => 'string', '285519X1034X3318419#0' => 'string', '285519X1034X3318419#1' => 'string', '285519X1035X33185' => 'string', '285519X1035X33186' => 'string', '285519X1036X33187' => 'string', '285519X1036X33188' => 'string', '285519X1036X33189' => 'string', '285519X1036X33189other' => 'string', '285519X1036X33190' => 'string', '285519X1036X33191' => 'string', '285519X1036X33192' => 'string',
    ];

    // Scopes...

    // Functions ...

    // Relations ...
}
