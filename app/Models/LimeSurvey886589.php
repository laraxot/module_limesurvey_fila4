<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use GeneaLabs\LaravelModelCaching\CachedBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Modules\Limesurvey\Contracts\LimeSurveyXXXContract;
use Modules\Limesurvey\Database\Factories\LimeSurvey886589Factory;
use Modules\Quaeris\Datas\AnswersFilterData;
use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeSurvey886589
 *
 * @method static LimeSurvey886589Factory factory($count = null, $state = [])
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
class LimeSurvey886589 extends BaseModel implements LimeSurveyXXXContract
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_survey_886589';

    /** @var string */
    protected $primaryKey = 'id';

    /** @var list<string> */
    protected $fillable = [
        'token', 'submitdate', 'lastpage', 'startlanguage', 'seed', '886589X223X24551Q1', '886589X223X24551Q2', '886589X223X24551Q3', '886589X223X24551Q4', '886589X224X24556', '886589X224X24556other', '886589X224X24557', '886589X224X24558SQ001', '886589X225X24560', '886589X225X24561', '886589X226X24562', '886589X226X24562other', '886589X226X24563',
    ];

    /** @var list<string> */
    protected $hidden = [
    ];

    /** @return array<string, string>     */
    protected $casts = [
        'id' => 'int', 'token' => 'string', 'submitdate' => 'datetime', 'lastpage' => 'int', 'startlanguage' => 'string', 'seed' => 'string', '886589X223X24551Q1' => 'string', '886589X223X24551Q2' => 'string', '886589X223X24551Q3' => 'string', '886589X223X24551Q4' => 'string', '886589X224X24556' => 'string', '886589X224X24556other' => 'string', '886589X224X24557' => 'string', '886589X224X24558SQ001' => 'string', '886589X225X24560' => 'string', '886589X225X24561' => 'string', '886589X226X24562' => 'string', '886589X226X24562other' => 'string', '886589X226X24563' => 'string',
    ];

    // Scopes...

    // Functions ...

    // Relations ...
}
