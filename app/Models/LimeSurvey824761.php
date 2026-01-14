<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use GeneaLabs\LaravelModelCaching\CachedBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Modules\Limesurvey\Contracts\LimeSurveyXXXContract;
use Modules\Limesurvey\Database\Factories\LimeSurvey824761Factory;
use Modules\Quaeris\Datas\AnswersFilterData;
use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeSurvey824761
 *
 * @method static LimeSurvey824761Factory factory($count = null, $state = [])
 *
 * @property int $id
 * @property string|null $token
 * @property Carbon|null $submitdate
 * @property int|null $lastpage
 * @property string $startlanguage
 * @property string|null $seed
 *
 *
 * @property-read Profile|null $creator
 * @property-read Extra|null $extra
 * @property-read Profile|null $updater
 *
 * @mixin \Eloquent
 */
class LimeSurvey824761 extends BaseModel implements LimeSurveyXXXContract
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_survey_824761';

    /** @var string */
    protected $primaryKey = 'id';

    /** @var list<string> */
    protected $fillable = [
        'token', 'submitdate', 'lastpage', 'startlanguage', 'seed', '824761X981X3267901', '824761X981X3267902', '824761X981X3268201', '824761X981X3268202', '824761X981X3268501', '824761X981X3268502', '824761X981X3268801', '824761X981X3268802', '824761X982X3269101', '824761X982X3269102', '824761X982X3269401', '824761X982X3269402', '824761X982X3269701', '824761X982X3269702', '824761X983X3270001', '824761X983X3270002', '824761X983X3270301', '824761X983X3270302', '824761X983X3270601', '824761X983X3270602', '824761X984X3270901', '824761X984X3270902', '824761X984X3271201', '824761X984X3271202', '824761X984X3271501', '824761X984X3271502', '824761X984X3271801', '824761X984X3271802', '824761X984X3272101', '824761X984X3272102', '824761X985X3272401', '824761X985X3272402', '824761X985X3272701', '824761X985X3272702', '824761X985X3273001', '824761X985X3273002', '824761X985X3273301', '824761X985X3273302', '824761X985X3273601', '824761X985X3273602', '824761X986X32739', '824761X986X32740', '824761X986X32741',
    ];

    /** @var list<string> */
    protected $hidden = [
    ];

    /** @return array<string, string>     */
    protected $casts = [
        'id' => 'int', 'token' => 'string', 'submitdate' => 'datetime', 'lastpage' => 'int', 'startlanguage' => 'string', 'seed' => 'string', '824761X981X3267901' => 'string', '824761X981X3267902' => 'string', '824761X981X3268201' => 'string', '824761X981X3268202' => 'string', '824761X981X3268501' => 'string', '824761X981X3268502' => 'string', '824761X981X3268801' => 'string', '824761X981X3268802' => 'string', '824761X982X3269101' => 'string', '824761X982X3269102' => 'string', '824761X982X3269401' => 'string', '824761X982X3269402' => 'string', '824761X982X3269701' => 'string', '824761X982X3269702' => 'string', '824761X983X3270001' => 'string', '824761X983X3270002' => 'string', '824761X983X3270301' => 'string', '824761X983X3270302' => 'string', '824761X983X3270601' => 'string', '824761X983X3270602' => 'string', '824761X984X3270901' => 'string', '824761X984X3270902' => 'string', '824761X984X3271201' => 'string', '824761X984X3271202' => 'string', '824761X984X3271501' => 'string', '824761X984X3271502' => 'string', '824761X984X3271801' => 'string', '824761X984X3271802' => 'string', '824761X984X3272101' => 'string', '824761X984X3272102' => 'string', '824761X985X3272401' => 'string', '824761X985X3272402' => 'string', '824761X985X3272701' => 'string', '824761X985X3272702' => 'string', '824761X985X3273001' => 'string', '824761X985X3273002' => 'string', '824761X985X3273301' => 'string', '824761X985X3273302' => 'string', '824761X985X3273601' => 'string', '824761X985X3273602' => 'string', '824761X986X32739' => 'string', '824761X986X32740' => 'string', '824761X986X32741' => 'string',
    ];

    // Scopes...

    // Functions ...

    // Relations ...
}
