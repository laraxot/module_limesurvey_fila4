<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use Illuminate\Support\Carbon;
use Modules\Limesurvey\Contracts\LimeSurveyXXXContract;
use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeSurvey665844
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
class LimeSurvey665844 extends BaseModel implements LimeSurveyXXXContract
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_survey_665844';

    /** @var string */
    protected $primaryKey = 'id';

    /** @var list<string> */
    protected $fillable = [
        'token', 'submitdate', 'lastpage', 'startlanguage', 'seed', '665844X907X31547', '665844X907X31548', '665844X907X31549', '665844X907X31569', '665844X908X31550', '665844X908X315511', '665844X908X315512', '665844X908X31552', '665844X908X315531', '665844X908X315532', '665844X908X31554', '665844X908X315551', '665844X908X315552', '665844X908X31572', '665844X908X315731', '665844X908X315732', '665844X909X31556', '665844X909X315571', '665844X909X315572', '665844X909X315573', '665844X909X31558', '665844X909X315591', '665844X909X315592', '665844X909X31560', '665844X909X315611', '665844X909X315612', '665844X909X315613', '665844X909X315614', '665844X909X31562', '665844X909X315631', '665844X909X315632', '665844X909X315633', '665844X910X31564', '665844X910X315651', '665844X910X315652', '665844X910X315653', '665844X910X315654', '665844X910X31566', '665844X910X315671', '665844X910X315672', '665844X910X31574', '665844X910X315751', '665844X910X315752', '665844X910X315753', '665844X910X315754', '665844X910X31576', '665844X910X315771', '665844X910X315772', '665844X910X315773', '665844X911X31570', '665844X911X31571', '665844X911X31568',
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
            'id' => 'int', 'token' => 'string', 'submitdate' => 'datetime', 'lastpage' => 'int', 'startlanguage' => 'string', 'seed' => 'string', '665844X907X31547' => 'string', '665844X907X31548' => 'string', '665844X907X31549' => 'string', '665844X907X31569' => 'string', '665844X908X31550' => 'string', '665844X908X315511' => 'string', '665844X908X315512' => 'string', '665844X908X31552' => 'string', '665844X908X315531' => 'string', '665844X908X315532' => 'string', '665844X908X31554' => 'string', '665844X908X315551' => 'string', '665844X908X315552' => 'string', '665844X908X31572' => 'string', '665844X908X315731' => 'string', '665844X908X315732' => 'string', '665844X909X31556' => 'string', '665844X909X315571' => 'string', '665844X909X315572' => 'string', '665844X909X315573' => 'string', '665844X909X31558' => 'string', '665844X909X315591' => 'string', '665844X909X315592' => 'string', '665844X909X31560' => 'string', '665844X909X315611' => 'string', '665844X909X315612' => 'string', '665844X909X315613' => 'string', '665844X909X315614' => 'string', '665844X909X31562' => 'string', '665844X909X315631' => 'string', '665844X909X315632' => 'string', '665844X909X315633' => 'string', '665844X910X31564' => 'string', '665844X910X315651' => 'string', '665844X910X315652' => 'string', '665844X910X315653' => 'string', '665844X910X315654' => 'string', '665844X910X31566' => 'string', '665844X910X315671' => 'string', '665844X910X315672' => 'string', '665844X910X31574' => 'string', '665844X910X315751' => 'string', '665844X910X315752' => 'string', '665844X910X315753' => 'string', '665844X910X315754' => 'string', '665844X910X31576' => 'string', '665844X910X315771' => 'string', '665844X910X315772' => 'string', '665844X910X315773' => 'string', '665844X911X31570' => 'string', '665844X911X31571' => 'string', '665844X911X31568' => 'string',
        ];
    }

    // Scopes...

    // Functions ...

    // Relations ...
}
