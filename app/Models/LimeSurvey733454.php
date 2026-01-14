<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use Illuminate\Support\Carbon;
use Modules\Limesurvey\Contracts\LimeSurveyXXXContract;
use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeSurvey733454
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
class LimeSurvey733454 extends BaseModel implements LimeSurveyXXXContract
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_survey_733454';

    /** @var string */
    protected $primaryKey = 'id';

    /** @var list<string> */
    protected $fillable = [
        'token', 'submitdate', 'lastpage', 'startlanguage', 'seed', 'startdate', 'datestamp', 'ipaddr', '733454X953X32199', '733454X954X321792_01', '733454X954X321792_02', '733454X954X321793_01', '733454X954X321793_02', '733454X954X321794_01', '733454X954X321794_02', '733454X954X321795_01', '733454X954X321795_02', '733454X954X321796_01', '733454X954X321796_02', '733454X954X321797_01', '733454X954X321797_02', '733454X954X321798_01', '733454X954X321798_02', '733454X954X321799_01', '733454X954X321799_02', '733454X954X3217910_01', '733454X954X3217910_02', '733454X954X3217911_01', '733454X954X3217911_02', '733454X954X3217912_01', '733454X954X3217912_02', '733454X954X3217913_01', '733454X954X3217913_02', '733454X954X3217914_01', '733454X954X3217914_02', '733454X954X3217915_01', '733454X954X3217915_02', '733454X954X3217916_01', '733454X954X3217916_02', '733454X954X3217917_01', '733454X954X3217917_02', '733454X954X3217918_01', '733454X954X3217918_02', '733454X954X3217919_01', '733454X954X3217919_02', '733454X954X32180', '733454X954X32185', '733454X955X32186', '733454X955X32187', '733454X958X32188', '733454X958X32190', '733454X958X32255', '733454X956X32177', '733454X956X32177other', '733454X956X32176', '733454X956X32178', '733454X956X32178other', '733454X956X32183', '733454X956X32183other', '733454X956X32182', '733454X956X32181', '733454X956X32184', '733454X956X32193', '733454X957X32194', '733454X957X32196', '733454X957X32197', '733454X957X32198', '733454X957X32200', '733454X957X32201', '733454X957X32201other',
    ];

    /** @var list<string> */
    protected $hidden = [
    ];

    /** @return array<string, string>     */
    protected $casts = [
        'id' => 'int', 'token' => 'string', 'submitdate' => 'datetime', 'lastpage' => 'int', 'startlanguage' => 'string', 'seed' => 'string', 'startdate' => 'datetime', 'datestamp' => 'datetime', 'ipaddr' => 'string', '733454X953X32199' => 'string', '733454X954X321792_01' => 'string', '733454X954X321792_02' => 'string', '733454X954X321793_01' => 'string', '733454X954X321793_02' => 'string', '733454X954X321794_01' => 'string', '733454X954X321794_02' => 'string', '733454X954X321795_01' => 'string', '733454X954X321795_02' => 'string', '733454X954X321796_01' => 'string', '733454X954X321796_02' => 'string', '733454X954X321797_01' => 'string', '733454X954X321797_02' => 'string', '733454X954X321798_01' => 'string', '733454X954X321798_02' => 'string', '733454X954X321799_01' => 'string', '733454X954X321799_02' => 'string', '733454X954X3217910_01' => 'string', '733454X954X3217910_02' => 'string', '733454X954X3217911_01' => 'string', '733454X954X3217911_02' => 'string', '733454X954X3217912_01' => 'string', '733454X954X3217912_02' => 'string', '733454X954X3217913_01' => 'string', '733454X954X3217913_02' => 'string', '733454X954X3217914_01' => 'string', '733454X954X3217914_02' => 'string', '733454X954X3217915_01' => 'string', '733454X954X3217915_02' => 'string', '733454X954X3217916_01' => 'string', '733454X954X3217916_02' => 'string', '733454X954X3217917_01' => 'string', '733454X954X3217917_02' => 'string', '733454X954X3217918_01' => 'string', '733454X954X3217918_02' => 'string', '733454X954X3217919_01' => 'string', '733454X954X3217919_02' => 'string', '733454X954X32180' => 'string', '733454X954X32185' => 'string', '733454X955X32186' => 'string', '733454X955X32187' => 'string', '733454X958X32188' => 'string', '733454X958X32190' => 'string', '733454X958X32255' => 'string', '733454X956X32177' => 'string', '733454X956X32177other' => 'string', '733454X956X32176' => 'string', '733454X956X32178' => 'string', '733454X956X32178other' => 'string', '733454X956X32183' => 'string', '733454X956X32183other' => 'string', '733454X956X32181' => 'string', '733454X956X32184' => 'string', '733454X956X32193' => 'string', '733454X957X32194' => 'string', '733454X957X32196' => 'string', '733454X957X32197' => 'datetime', '733454X957X32198' => 'datetime', '733454X957X32200' => 'string', '733454X957X32201' => 'string', '733454X957X32201other' => 'string',
    ];

    // Scopes...

    // Functions ...

    // Relations ...
}
