<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use Modules\Limesurvey\Contracts\LimeSurveyXXXContract;
use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeSurvey684277
 *
 * @property int $id
 * @property string|null $token
 * @property string|null $submitdate
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
class LimeSurvey684277 extends BaseModel implements LimeSurveyXXXContract
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_survey_684277';

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
        6 => '684277X1118X33850001',
        7 => '684277X1118X33850002',
        8 => '684277X1118X33850003',
        9 => '684277X1118X33850004',
        10 => '684277X1118X33850005',
        11 => '684277X1118X33850006',
        12 => '684277X1118X33850007',
        13 => '684277X1118X33850other',
        14 => '684277X1118X33859',
        15 => '684277X1118X33859other',
        16 => '684277X1118X33868',
        17 => '684277X1118X33868other',
        18 => '684277X1119X33869',
        19 => '684277X1119X33870',
        20 => '684277X1119X33871',
        21 => '684277X1120X33872',
        22 => '684277X1120X33873',
        23 => '684277X1120X33874',
        24 => '684277X1120X33875',
        25 => '684277X1120X33876',
        26 => '684277X1121X33877',
        27 => '684277X1121X33878',
        28 => '684277X1121X33879',
        29 => '684277X1121X33880',
        30 => '684277X1121X33881',
        31 => '684277X1121X33882',
        32 => '684277X1121X33883',
        33 => '684277X1121X33884',
        34 => '684277X1122X33885',
        35 => '684277X1122X33886',
        36 => '684277X1122X33887',
        37 => '684277X1122X33888',
        38 => '684277X1122X33889',
        39 => '684277X1122X33890',
        40 => '684277X1122X33891',
        41 => '684277X1122X33892',
        42 => '684277X1122X33893',
        43 => '684277X1122X33894',
        44 => '684277X1122X33898SQ001',
        45 => '684277X1122X33897',
        46 => '684277X1123X33895',
        47 => '684277X1123X33896',
    ];

    /** @var list<string> */
    protected $hidden = [
    ];

    /**
     * The attributes that should be mutated to dates.
     *  da fare.
     *
     * @var array<string>
     */
    protected $dates = [
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

    // Scopes...

    // Functions ...

    // Relations ...
}
