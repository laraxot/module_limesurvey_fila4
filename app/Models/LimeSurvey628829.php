<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use Illuminate\Support\Carbon;
use Modules\Limesurvey\Contracts\LimeSurveyXXXContract;
use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeSurvey628829
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
class LimeSurvey628829 extends BaseModel implements LimeSurveyXXXContract
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_survey_628829';

    /** @var string */
    protected $primaryKey = 'id';

    /** @var list<string> */
    protected $fillable = [
        'token', 'submitdate', 'lastpage', 'startlanguage', 'seed', 'startdate', 'datestamp', 'ipaddr', '628829X1070X33470', '628829X1070X33471', '628829X1065X33488', '628829X1065X33489', '628829X1065X33489other', '628829X1065X33398', '628829X1065X33399', '628829X1065X33400', '628829X1065X33401', '628829X1065X33474', '628829X1065X33473', '628829X1066X33490', '628829X1066X33465', '628829X1066X33426', '628829X1066X33448', '628829X1066X33449', '628829X1066X33456', '628829X1066X33457', '628829X1067X33466', '628829X1068X33404', '628829X1068X33405', '628829X1068X33406', '628829X1068X33406other', '628829X1069X33467', '628829X1069X33467other', '628829X1069X33468', '628829X1069X33469', '628829X1069X33469other', '628829X1069X33472', '628829X1069X33472other',
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
            'id' => 'int', 'token' => 'string', 'submitdate' => 'datetime', 'lastpage' => 'int', 'startlanguage' => 'string', 'seed' => 'string', 'startdate' => 'datetime', 'datestamp' => 'datetime', 'ipaddr' => 'string', '628829X1070X33470' => 'string', '628829X1070X33471' => 'string', '628829X1065X33488' => 'string', '628829X1065X33489' => 'string', '628829X1065X33489other' => 'string', '628829X1065X33398' => 'string', '628829X1065X33399' => 'string', '628829X1065X33400' => 'string', '628829X1065X33401' => 'string', '628829X1065X33474' => 'string', '628829X1065X33473' => 'string', '628829X1066X33490' => 'string', '628829X1066X33465' => 'string', '628829X1066X33426' => 'string', '628829X1066X33448' => 'string', '628829X1066X33449' => 'string', '628829X1066X33456' => 'string', '628829X1066X33457' => 'string', '628829X1067X33466' => 'string', '628829X1068X33404' => 'string', '628829X1068X33405' => 'string', '628829X1068X33406' => 'string', '628829X1068X33406other' => 'string', '628829X1069X33467' => 'string', '628829X1069X33467other' => 'string', '628829X1069X33468' => 'datetime', '628829X1069X33469' => 'string', '628829X1069X33469other' => 'string', '628829X1069X33472' => 'string', '628829X1069X33472other' => 'string',
        ];
    }

    // Scopes...

    // Functions ...

    // Relations ...
}
