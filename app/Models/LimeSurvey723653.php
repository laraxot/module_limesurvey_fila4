<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use Illuminate\Support\Carbon;
use Modules\Limesurvey\Contracts\LimeSurveyXXXContract;
use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeSurvey723653
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
class LimeSurvey723653 extends BaseModel implements LimeSurveyXXXContract
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_survey_723653';

    /** @var string */
    protected $primaryKey = 'id';

    /** @var list<string> */
    protected $fillable = [
        'token', 'submitdate', 'lastpage', 'startlanguage', 'seed', 'startdate', 'datestamp', '723653X434X26682', '723653X434X26683', '723653X435X26727', '723653X435X26684', '723653X435X26685', '723653X435X26686', '723653X435X26687', '723653X435X26688', '723653X435X26689', '723653X435X26690', '723653X435X26691', '723653X435X26692SQ001', '723653X435X26693', '723653X436X26728', '723653X436X26694', '723653X436X26695', '723653X436X26696', '723653X436X26697', '723653X436X26698', '723653X436X26699', '723653X436X26700SQ001', '723653X436X26701', '723653X436X26702SQ001', '723653X436X26703', '723653X437X26729', '723653X437X26704', '723653X437X26732SQ001', '723653X437X26733', '723653X437X26705', '723653X437X26710', '723653X437X26706', '723653X437X26707', '723653X437X26711', '723653X437X26712', '723653X437X26713', '723653X437X26714', '723653X437X26708SQ001', '723653X437X26709', '723653X438X26715', '723653X438X26716', '723653X438X26716other', '723653X438X26717', '723653X438X26718SQ001', '723653X438X26719', '723653X439X26724', '723653X439X26720SQ001', '723653X439X26721', '723653X439X26725SQ001', '723653X439X26726', '723653X439X26722SQ001', '723653X439X26723', '723653X440X26731', '723653X440X26730',
    ];

    /** @var list<string> */
    protected $hidden = [
    ];

    /** @return array<string, string>     */
    protected $casts = [
        'id' => 'int', 'token' => 'string', 'submitdate' => 'datetime', 'lastpage' => 'int', 'startlanguage' => 'string', 'seed' => 'string', 'startdate' => 'datetime', 'datestamp' => 'datetime', '723653X434X26682' => 'string', '723653X434X26683' => 'string', '723653X435X26727' => 'string', '723653X435X26684' => 'string', '723653X435X26685' => 'string', '723653X435X26686' => 'string', '723653X435X26687' => 'string', '723653X435X26688' => 'string', '723653X435X26689' => 'string', '723653X435X26690' => 'string', '723653X435X26691' => 'string', '723653X435X26692SQ001' => 'string', '723653X435X26693' => 'string', '723653X436X26728' => 'string', '723653X436X26694' => 'string', '723653X436X26695' => 'string', '723653X436X26696' => 'string', '723653X436X26697' => 'string', '723653X436X26698' => 'string', '723653X436X26699' => 'string', '723653X436X26700SQ001' => 'string', '723653X436X26701' => 'string', '723653X436X26702SQ001' => 'string', '723653X436X26703' => 'string', '723653X437X26729' => 'string', '723653X437X26704' => 'string', '723653X437X26732SQ001' => 'string', '723653X437X26733' => 'string', '723653X437X26710' => 'string', '723653X437X26706' => 'string', '723653X437X26707' => 'string', '723653X437X26711' => 'string', '723653X437X26712' => 'string', '723653X437X26713' => 'string', '723653X437X26714' => 'string', '723653X437X26708SQ001' => 'string', '723653X437X26709' => 'string', '723653X438X26715' => 'string', '723653X438X26716' => 'string', '723653X438X26716other' => 'string', '723653X438X26717' => 'string', '723653X438X26718SQ001' => 'string', '723653X438X26719' => 'string', '723653X439X26724' => 'string', '723653X439X26720SQ001' => 'string', '723653X439X26721' => 'string', '723653X439X26725SQ001' => 'string', '723653X439X26726' => 'string', '723653X439X26722SQ001' => 'string', '723653X439X26723' => 'string', '723653X440X26731' => 'string', '723653X440X26730' => 'string',
    ];

    // Scopes...

    // Functions ...

    // Relations ...
}
