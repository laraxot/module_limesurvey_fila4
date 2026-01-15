<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeSurvey299355Timings
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
class LimeSurvey299355Timings extends BaseModel
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_survey_299355_timings';

    /** @var string */
    protected $primaryKey = 'id';

    /** @var list<string> */
    protected $fillable = [
        'interviewtime', '299355X1029time', '299355X1029X33153time', '299355X1029X33154time', '299355X1029X33155time', '299355X1030time', '299355X1030X33156time', '299355X1031time', '299355X1031X33157time', '299355X1031X33158time', '299355X1032time', '299355X1032X33159time', '299355X1032X33160time', '299355X1032X33161time', '299355X1032X33162time', '299355X1032X33163time', '299355X1032X33164time',
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
        'id' => 'int', 'interviewtime' => 'float', '299355X1029time' => 'float', '299355X1029X33153time' => 'float', '299355X1029X33154time' => 'float', '299355X1029X33155time' => 'float', '299355X1030time' => 'float', '299355X1030X33156time' => 'float', '299355X1031time' => 'float', '299355X1031X33157time' => 'float', '299355X1031X33158time' => 'float', '299355X1032time' => 'float', '299355X1032X33159time' => 'float', '299355X1032X33160time' => 'float', '299355X1032X33161time' => 'float', '299355X1032X33162time' => 'float', '299355X1032X33163time' => 'float', '299355X1032X33164time' => 'float',
    ];
    }

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array<string>
     */
    protected $dates = [
    ];

    // Scopes...

    // Functions ...

    // Relations ...
}
