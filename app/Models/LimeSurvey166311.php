<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use Modules\Limesurvey\Contracts\LimeSurveyXXXContract;
use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeSurvey166311
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
 * @property-read Profile|null $creator
 * @property-read Extra|null $extra
 * @property-read Profile|null $updater
 *
 * @mixin \Eloquent
 */
class LimeSurvey166311 extends BaseModel implements LimeSurveyXXXContract
{
    /** @var bool */
    public $timestamps = false;

    /** @var string */
    protected $table = 'lime_survey_166311';

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
        6 => 'startdate',
        7 => 'datestamp',
        8 => 'ipaddr',
        9 => '166311X1557X38736',
        10 => '166311X1557X38737',
        11 => '166311X1558X38738',
        12 => '166311X1558X38739',
        13 => '166311X1558X38740',
        14 => '166311X1558X38741',
        15 => '166311X1558X38742',
        16 => '166311X1558X38743',
        17 => '166311X1558X38744',
        18 => '166311X1558X38745',
        19 => '166311X1558X3874601',
        20 => '166311X1558X38747',
        21 => '166311X1559X3874824',
        22 => '166311X1559X38749',
        23 => '166311X1559X38750',
        24 => '166311X1559X38751',
        25 => '166311X1559X38752',
        26 => '166311X1559X38753',
        27 => '166311X1559X38754',
        28 => '166311X1559X38755',
        29 => '166311X1559X38756',
        30 => '166311X1559X38757',
        31 => '166311X1559X3875834',
        32 => '166311X1559X38759',
        33 => '166311X1560X38760',
        34 => '166311X1560X38761',
        35 => '166311X1560X38762',
        36 => '166311X1560X3876339',
        37 => '166311X1560X38764',
        38 => '166311X1561X3876547',
        39 => '166311X1561X38766',
        40 => '166311X1561X3876749',
        41 => '166311X1561X38768',
        42 => '166311X1561X3876951',
        43 => '166311X1561X38770',
        44 => '166311X1562X3877153',
        45 => '166311X1562X38772',
        46 => '166311X1562X3877355',
        47 => '166311X1562X38774',
        48 => '166311X1562X3877557',
        49 => '166311X1562X38776',
        50 => '166311X1563X38777',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var list<string>
     */
    protected $hidden = [
    ];


    /**
     * Get the casts for the model.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [];
    }

    /**
     * The attributes that should be mutated to dates.
     *
     *  da fare
     *
     * @var array<string>
     */
    protected $dates = [
    ];

    // Scopes...

    // Functions ...

    // Relations ...
}
