<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use Modules\Limesurvey\Contracts\LimeSurveyXXXContract;
use Modules\Limesurvey\Database\Factories\LimeSurvey955466Factory;
use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeSurvey955466
 *
 * @method static LimeSurvey955466Factory factory($count = null, $state = [])
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
 * @property string|null $refurl
 *
 * @property-read Profile|null $creator
 * @property-read Extra|null $extra
 * @property-read Profile|null $updater
 *
 * @mixin \Eloquent
 */
class LimeSurvey955466 extends BaseModel implements LimeSurveyXXXContract
{
    /** @var bool */
    public $timestamps = false;

    /** @var string */
    protected $table = 'lime_survey_955466';

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
        6 => '955466X1141X34094',
        7 => '955466X1141X34096',
        8 => '955466X1141X34098',
        9 => '955466X1141X34095',
        10 => '955466X1141X34097',
        11 => '955466X1141X34099',
        12 => '955466X1142X34100001',
        13 => '955466X1142X34100002',
        14 => '955466X1142X34100003',
        15 => '955466X1142X34100004',
        16 => '955466X1142X34100005',
        17 => '955466X1143X34107',
        18 => '955466X1143X34108',
        19 => '955466X1143X34109',
        20 => '955466X1143X34110',
        21 => '955466X1143X34111',
    ];

    /** @var list<string> */
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
