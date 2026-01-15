<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use Illuminate\Support\Carbon;
use Modules\Limesurvey\Contracts\LimeSurveyXXXContract;
use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeSurvey568792
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
class LimeSurvey568792 extends BaseModel implements LimeSurveyXXXContract
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_survey_568792';

    /** @var string */
    protected $primaryKey = 'id';

    /** @var list<string> */
    protected $fillable = [
        'token', 'submitdate', 'lastpage', 'startlanguage', 'seed', 'startdate', 'datestamp', 'ipaddr', '568792X987X32761', '568792X988X32785', '568792X989X327452_01', '568792X989X327452_02', '568792X989X327453_01', '568792X989X327453_02', '568792X989X327454_01', '568792X989X327454_02', '568792X989X327455_01', '568792X989X327455_02', '568792X989X327456_01', '568792X989X327456_02', '568792X989X327457_01', '568792X989X327457_02', '568792X989X327458_01', '568792X989X327458_02', '568792X989X327459_01', '568792X989X327459_02', '568792X989X3274510_01', '568792X989X3274510_02', '568792X989X3274511_01', '568792X989X3274511_02', '568792X989X3274512_01', '568792X989X3274512_02', '568792X989X32746', '568792X993X32799', '568792X993X32800', '568792X993X32801', '568792X994X32802', '568792X994X32803', '568792X994X3280418', '568792X994X3280419', '568792X994X3280420', '568792X994X32808', '568792X990X32747', '568792X990X32809', '568792X990X32810', '568792X990X32811', '568792X990X32812', '568792X991X32759', '568792X991X32760', '568792X991X32762', '568792X991X32763', '568792X991X32763other',
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
            'id' => 'int', 'token' => 'string', 'submitdate' => 'datetime', 'lastpage' => 'int', 'startlanguage' => 'string', 'seed' => 'string', 'startdate' => 'datetime', 'datestamp' => 'datetime', 'ipaddr' => 'string', '568792X987X32761' => 'string', '568792X988X32785' => 'string', '568792X989X327452_01' => 'string', '568792X989X327452_02' => 'string', '568792X989X327453_01' => 'string', '568792X989X327453_02' => 'string', '568792X989X327454_01' => 'string', '568792X989X327454_02' => 'string', '568792X989X327455_01' => 'string', '568792X989X327455_02' => 'string', '568792X989X327456_01' => 'string', '568792X989X327456_02' => 'string', '568792X989X327457_01' => 'string', '568792X989X327457_02' => 'string', '568792X989X327458_01' => 'string', '568792X989X327458_02' => 'string', '568792X989X327459_01' => 'string', '568792X989X327459_02' => 'string', '568792X989X3274510_01' => 'string', '568792X989X3274510_02' => 'string', '568792X989X3274511_01' => 'string', '568792X989X3274511_02' => 'string', '568792X989X3274512_01' => 'string', '568792X989X3274512_02' => 'string', '568792X989X32746' => 'string', '568792X993X32799' => 'string', '568792X993X32800' => 'string', '568792X993X32801' => 'string', '568792X994X32802' => 'string', '568792X994X32803' => 'string', '568792X994X3280418' => 'string', '568792X994X3280419' => 'string', '568792X994X3280420' => 'string', '568792X994X32808' => 'string', '568792X990X32747' => 'string', '568792X990X32809' => 'string', '568792X990X32810' => 'string', '568792X990X32811' => 'string', '568792X990X32812' => 'string', '568792X991X32759' => 'datetime', '568792X991X32760' => 'datetime', '568792X991X32762' => 'string', '568792X991X32763' => 'string', '568792X991X32763other' => 'string',
        ];
    }

    // Scopes...

    // Functions ...

    // Relations ...
}
