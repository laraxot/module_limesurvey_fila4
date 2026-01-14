<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use GeneaLabs\LaravelModelCaching\CachedBuilder;
use Illuminate\Database\Eloquent\Model;
use Modules\Limesurvey\Contracts\LimeSurveyXXXContract;
use Modules\Limesurvey\Database\Factories\LimeSurvey892883Factory;
use Modules\Quaeris\Datas\AnswersFilterData;
use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeSurvey892883
 *
 * @method static LimeSurvey892883Factory factory($count = null, $state = [])
 *
 * @property int $id
 * @property string|null $token
 * @property string|null $submitdate
 * @property int|null $lastpage
 * @property string $startlanguage
 * @property string|null $seed
 * @property string $startdate
 * @property string $datestamp
 * @property string|null $ipaddr
 *
 *
 * @property-read Profile|null $creator
 * @property-read Extra|null $extra
 * @property-read Profile|null $updater
 *
 * @mixin \Eloquent
 */
class LimeSurvey892883 extends BaseModel implements LimeSurveyXXXContract
{
    /** @var bool */
    public $timestamps = false;

    /** @var string */
    protected $table = 'lime_survey_892883';

    /** @var string */
    protected $primaryKey = 'id';

    /** @var list<string> */
    protected $fillable = [
        0 => 'id',
        1 => 'token',
        2 => 'submitdate',
        3 => 'lastpage',
        4 => 'startlanguage',
        5 => 'seed',
        6 => '892883X1301X35368',
        7 => '892883X1301X35369',
        8 => '892883X1302X35370',
        9 => '892883X1302X35371',
        10 => '892883X1302X35372',
        11 => '892883X1302X35373',
        12 => '892883X1302X35374',
        13 => '892883X1302X35375',
        14 => '892883X1302X35376',
        15 => '892883X1302X35377',
        16 => '892883X1302X3537801',
        17 => '892883X1302X35391',
        18 => '892883X1303X35392',
        19 => '892883X1303X35393',
        20 => '892883X1303X35394',
        21 => '892883X1303X35395',
        22 => '892883X1303X35396',
        23 => '892883X1303X35397',
        24 => '892883X1303X3539819',
        25 => '892883X1303X35399',
        26 => '892883X1303X3540021',
        27 => '892883X1303X35401',
        28 => '892883X1304X35404',
        29 => '892883X1304X3540524',
        30 => '892883X1304X35407',
        31 => '892883X1304X35408',
        32 => '892883X1304X35409',
        33 => '892883X1304X35410',
        34 => '892883X1304X35411',
        35 => '892883X1304X35412',
        36 => '892883X1304X35413',
        37 => '892883X1304X35414',
        38 => '892883X1304X35415',
        39 => '892883X1304X3541634',
        40 => '892883X1304X35418',
        41 => '892883X1305X35419',
        42 => '892883X1305X35420',
        43 => '892883X1305X35421',
        44 => '892883X1305X3542239',
        45 => '892883X1305X35423',
        46 => '892883X1306X3542441',
        47 => '892883X1306X35426',
        48 => '892883X1306X3542743',
        49 => '892883X1306X35431',
        50 => '892883X1306X3543345',
        51 => '892883X1306X35432',
        52 => '892883X1307X3543747',
        53 => '892883X1307X35439',
        54 => '892883X1307X3544049',
        55 => '892883X1307X35442',
        56 => '892883X1307X3544351',
        57 => '892883X1307X35445',
        58 => '892883X1308X3544653',
        59 => '892883X1308X35448',
        60 => '892883X1308X3544955',
        61 => '892883X1308X35451',
        62 => '892883X1308X3545257',
        63 => '892883X1308X35454',
        64 => '892883X1309X35455',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var list<string>
     */
    protected $hidden = [
    ];

    /**
     * The attributes that should be casted to native types.
     * da fare.
     *
     * @var array<string, string>
     */
    protected $casts = [];

    /**
     * The attributes that should be mutated to dates.
     *  da fare.
     *
     * @var array<string>
     */
    protected $dates = [
    ];

    // Scopes...

    // Functions ...

    // Relations ...
}
