<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeSurvey726613Timings
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
class LimeSurvey726613Timings extends BaseModel
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_survey_726613_timings';

    /** @var string */
    protected $primaryKey = 'id';

    /** @var list<string> */
    protected $fillable = [
        'interviewtime', '726613X995time', '726613X995X33066time', '726613X995X32856time', '726613X995X32857time', '726613X995X32858time', '726613X995X32859time', '726613X995X32860time', '726613X995X32861time', '726613X995X32862time', '726613X995X32863time', '726613X995X32871time', '726613X995X32880time', '726613X995X32881time', '726613X995X32890time', '726613X995X32891time', '726613X995X32892time', '726613X995X32893time', '726613X995X32894time', '726613X995X32905time', '726613X995X32915time', '726613X995X32927time', '726613X995X32937time', '726613X995X32938time', '726613X995X32940time', '726613X995X32941time', '726613X995X32942time', '726613X995X32943time', '726613X995X32944time', '726613X995X32945time', '726613X995X32833time', '726613X995X32834time',
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
            'id' => 'int', 'interviewtime' => 'float', '726613X995time' => 'float', '726613X995X33066time' => 'float', '726613X995X32856time' => 'float', '726613X995X32857time' => 'float', '726613X995X32858time' => 'float', '726613X995X32859time' => 'float', '726613X995X32860time' => 'float', '726613X995X32861time' => 'float', '726613X995X32862time' => 'float', '726613X995X32863time' => 'float', '726613X995X32871time' => 'float', '726613X995X32880time' => 'float', '726613X995X32881time' => 'float', '726613X995X32890time' => 'float', '726613X995X32891time' => 'float', '726613X995X32892time' => 'float', '726613X995X32893time' => 'float', '726613X995X32894time' => 'float', '726613X995X32905time' => 'float', '726613X995X32915time' => 'float', '726613X995X32927time' => 'float', '726613X995X32937time' => 'float', '726613X995X32938time' => 'float', '726613X995X32940time' => 'float', '726613X995X32941time' => 'float', '726613X995X32942time' => 'float', '726613X995X32943time' => 'float', '726613X995X32944time' => 'float', '726613X995X32945time' => 'float', '726613X995X32833time' => 'float', '726613X995X32834time' => 'float',
        ];
    }

    // Scopes...

    // Functions ...

    // Relations ...
}
