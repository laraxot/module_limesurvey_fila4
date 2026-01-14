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
 * Modules\Limesurvey\Models\LimeSurvey417991
 *
 * @property int $id
 * @property string|null $token
 * @property Carbon|null $submitdate
 * @property int|null $lastpage
 * @property string $startlanguage
 * @property string|null $seed
 * @property string $startdate
 * @property string $datestamp
 *
 * @property-read Profile|null $creator
 * @property-read Extra|null $extra
 * @property-read Profile|null $updater
 *
 *
 * @mixin \Eloquent
 */
class LimeSurvey417991 extends BaseModel implements LimeSurveyXXXContract
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_survey_417991';

    /** @var string */
    protected $primaryKey = 'id';

    /** @var list<string> */
    protected $fillable = [
        'token', 'submitdate', 'lastpage', 'startlanguage', 'seed', '417991X1025X33130', '417991X1026X331312', '417991X1026X331313', '417991X1026X331314', '417991X1026X331315', '417991X1026X331316', '417991X1026X331317', '417991X1026X331318', '417991X1026X331319', '417991X1026X3314110', '417991X1027X33143',
    ];

    /** @var list<string> */
    protected $hidden = [
    ];

    /** @return array<string, string>     */
    protected $casts = [
        'id' => 'int', 'token' => 'string', 'submitdate' => 'datetime', 'lastpage' => 'int', 'startlanguage' => 'string', 'seed' => 'string', '417991X1025X33130' => 'string', '417991X1026X331312' => 'string', '417991X1026X331313' => 'string', '417991X1026X331314' => 'string', '417991X1026X331315' => 'string', '417991X1026X331316' => 'string', '417991X1026X331317' => 'string', '417991X1026X331318' => 'string', '417991X1026X331319' => 'string', '417991X1026X3314110' => 'string', '417991X1027X33143' => 'string',
    ];

    // Scopes...

    // Functions ...

    // Relations ...
}
