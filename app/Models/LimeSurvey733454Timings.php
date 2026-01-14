<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use GeneaLabs\LaravelModelCaching\CachedBuilder;
use Illuminate\Database\Eloquent\Model;
use Modules\Quaeris\Datas\AnswersFilterData;
use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeSurvey733454Timings
 *
 * @property int $id
 * @property float|null $interviewtime
 *
 * @property-read Profile|null $creator
 * @property-read Extra|null $extra
 * @property-read Profile|null $updater
 *
 *
 * @mixin \Eloquent
 */
class LimeSurvey733454Timings extends BaseModel
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_survey_733454_timings';

    /** @var string */
    protected $primaryKey = 'id';

    /** @var list<string> */
    protected $fillable = [
        'interviewtime', '733454X953time', '733454X953X32199time', '733454X954time', '733454X954X32179time', '733454X954X32180time', '733454X954X32185time', '733454X955time', '733454X955X32186time', '733454X955X32187time', '733454X958time', '733454X958X32188time', '733454X958X32190time', '733454X958X32255time', '733454X956time', '733454X956X32177time', '733454X956X32176time', '733454X956X32178time', '733454X956X32183time', '733454X956X32182time', '733454X956X32181time', '733454X956X32184time', '733454X956X32193time', '733454X957time', '733454X957X32194time', '733454X957X32196time', '733454X957X32197time', '733454X957X32198time', '733454X957X32200time', '733454X957X32201time',
    ];

    /** @var list<string> */
    protected $hidden = [
    ];

    /** @return array<string, string>     */
    protected $casts = [
        'id' => 'int', 'interviewtime' => 'float', '733454X953time' => 'float', '733454X953X32199time' => 'float', '733454X954time' => 'float', '733454X954X32179time' => 'float', '733454X954X32180time' => 'float', '733454X954X32185time' => 'float', '733454X955time' => 'float', '733454X955X32186time' => 'float', '733454X955X32187time' => 'float', '733454X958time' => 'float', '733454X958X32188time' => 'float', '733454X958X32190time' => 'float', '733454X958X32255time' => 'float', '733454X956time' => 'float', '733454X956X32177time' => 'float', '733454X956X32176time' => 'float', '733454X956X32178time' => 'float', '733454X956X32183time' => 'float', '733454X956X32182time' => 'float', '733454X956X32181time' => 'float', '733454X956X32184time' => 'float', '733454X956X32193time' => 'float', '733454X957time' => 'float', '733454X957X32194time' => 'float', '733454X957X32196time' => 'float', '733454X957X32197time' => 'float', '733454X957X32198time' => 'float', '733454X957X32200time' => 'float', '733454X957X32201time' => 'float',
    ];

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
