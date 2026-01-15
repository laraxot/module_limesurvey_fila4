<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeSurvey325712Timings
 *
 * @property int $id
 * @property float|null $interviewtime
 *
 * @property-read Profile|null $creator
 * @property-read Extra|null $extra
 * @property-read Profile|null $updater
 *
 * @mixin \Eloquent
 */
class LimeSurvey325712Timings extends BaseModel
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_survey_325712_timings';

    /** @var string */
    protected $primaryKey = 'id';

    /** @var list<string> */
    protected $fillable = [
        'interviewtime', '325712X973time', '325712X973X32478time', '325712X974time', '325712X974X32502time', '325712X974X32503time', '325712X974X32504time', '325712X975time', '325712X975X32505time', '325712X978time', '325712X978X32516time', '325712X978X32517time', '325712X978X32518time', '325712X978X32519time', '325712X976time', '325712X976X32520time', '325712X976X32531time', '325712X976X32532time', '325712X979time', '325712X979X32533time', '325712X979X32544time', '325712X979X32557time', '325712X979X32579time', '325712X979X32590time', '325712X979X32601time', '325712X979X32613time', '325712X979X32624time', '325712X979X32635time', '325712X979X32646time', '325712X979X32657time', '325712X980time', '325712X980X32658time', '325712X980X32659time', '325712X980X32660time', '325712X980X32661time', '325712X980X32668time', '325712X977time', '325712X977X32474time', '325712X977X32476time', '325712X977X32477time', '325712X977X32479time', '325712X977X32480time',
    ];

    /** @var list<string> */
    protected $hidden = [
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array<string>
     */
    protected $dates = [
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
            'id' => 'int', 'interviewtime' => 'float', '325712X973time' => 'float', '325712X973X32478time' => 'float', '325712X974time' => 'float', '325712X974X32502time' => 'float', '325712X974X32503time' => 'float', '325712X974X32504time' => 'float', '325712X975time' => 'float', '325712X975X32505time' => 'float', '325712X978time' => 'float', '325712X978X32516time' => 'float', '325712X978X32517time' => 'float', '325712X978X32518time' => 'float', '325712X978X32519time' => 'float', '325712X976time' => 'float', '325712X976X32520time' => 'float', '325712X976X32531time' => 'float', '325712X976X32532time' => 'float', '325712X979time' => 'float', '325712X979X32533time' => 'float', '325712X979X32544time' => 'float', '325712X979X32557time' => 'float', '325712X979X32579time' => 'float', '325712X979X32590time' => 'float', '325712X979X32601time' => 'float', '325712X979X32613time' => 'float', '325712X979X32624time' => 'float', '325712X979X32635time' => 'float', '325712X979X32646time' => 'float', '325712X979X32657time' => 'float', '325712X980time' => 'float', '325712X980X32658time' => 'float', '325712X980X32659time' => 'float', '325712X980X32660time' => 'float', '325712X980X32661time' => 'float', '325712X980X32668time' => 'float', '325712X977time' => 'float', '325712X977X32474time' => 'float', '325712X977X32476time' => 'float', '325712X977X32477time' => 'float', '325712X977X32479time' => 'float', '325712X977X32480time' => 'float',
        ];
    }

    // Scopes...

    // Functions ...

    // Relations ...
}
