<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeSurvey735128Timings
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
class LimeSurvey735128Timings extends BaseModel
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_survey_735128_timings';

    /** @var string */
    protected $primaryKey = 'id';

    /** @var list<string> */
    protected $fillable = [
        'interviewtime', '735128X931time', '735128X931X31971time', '735128X931X31823time', '735128X931X31824time', '735128X931X31825time', '735128X932time', '735128X932X31826time', '735128X932X31887time', '735128X932X31888time', '735128X932X31889time', '735128X932X31947time', '735128X932X31948time', '735128X933time', '735128X933X31827time', '735128X933X31952time', '735128X933X31953time', '735128X933X31954time', '735128X934time', '735128X934X31829time', '735128X934X31830time', '735128X934X31831time', '735128X934X31832time', '735128X934X31967time', '735128X934X31965time', '735128X935time', '735128X935X31966time', '735128X935X31968time', '735128X935X31969time', '735128X935X31970time', '735128X935X31972time', '735128X935X32032time',
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
        'id' => 'int', 'interviewtime' => 'float', '735128X931time' => 'float', '735128X931X31971time' => 'float', '735128X931X31823time' => 'float', '735128X931X31824time' => 'float', '735128X931X31825time' => 'float', '735128X932time' => 'float', '735128X932X31826time' => 'float', '735128X932X31887time' => 'float', '735128X932X31888time' => 'float', '735128X932X31889time' => 'float', '735128X932X31947time' => 'float', '735128X932X31948time' => 'float', '735128X933time' => 'float', '735128X933X31827time' => 'float', '735128X933X31952time' => 'float', '735128X933X31953time' => 'float', '735128X933X31954time' => 'float', '735128X934time' => 'float', '735128X934X31829time' => 'float', '735128X934X31830time' => 'float', '735128X934X31831time' => 'float', '735128X934X31832time' => 'float', '735128X934X31967time' => 'float', '735128X934X31965time' => 'float', '735128X935time' => 'float', '735128X935X31966time' => 'float', '735128X935X31968time' => 'float', '735128X935X31969time' => 'float', '735128X935X31970time' => 'float', '735128X935X31972time' => 'float', '735128X935X32032time' => 'float',
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
