<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use GeneaLabs\LaravelModelCaching\CachedBuilder;
use Illuminate\Database\Eloquent\Model;
use Modules\Quaeris\Datas\AnswersFilterData;
use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeSurvey628829Timings
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
class LimeSurvey628829Timings extends BaseModel
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_survey_628829_timings';

    /** @var string */
    protected $primaryKey = 'id';

    /** @var list<string> */
    protected $fillable = [
        'interviewtime', '628829X1070time', '628829X1070X33470time', '628829X1070X33471time', '628829X1065time', '628829X1065X33488time', '628829X1065X33489time', '628829X1065X33398time', '628829X1065X33399time', '628829X1065X33400time', '628829X1065X33401time', '628829X1065X33474time', '628829X1065X33473time', '628829X1066time', '628829X1066X33490time', '628829X1066X33465time', '628829X1066X33426time', '628829X1066X33448time', '628829X1066X33449time', '628829X1066X33456time', '628829X1066X33457time', '628829X1067time', '628829X1067X33466time', '628829X1068time', '628829X1068X33404time', '628829X1068X33405time', '628829X1068X33406time', '628829X1069time', '628829X1069X33467time', '628829X1069X33468time', '628829X1069X33469time', '628829X1069X33472time',
    ];

    /** @var list<string> */
    protected $hidden = [
    ];

    /** @return array<string, string>     */
    protected $casts = [
        'id' => 'int', 'interviewtime' => 'float', '628829X1070time' => 'float', '628829X1070X33470time' => 'float', '628829X1070X33471time' => 'float', '628829X1065time' => 'float', '628829X1065X33488time' => 'float', '628829X1065X33489time' => 'float', '628829X1065X33398time' => 'float', '628829X1065X33399time' => 'float', '628829X1065X33400time' => 'float', '628829X1065X33401time' => 'float', '628829X1065X33474time' => 'float', '628829X1065X33473time' => 'float', '628829X1066time' => 'float', '628829X1066X33490time' => 'float', '628829X1066X33465time' => 'float', '628829X1066X33426time' => 'float', '628829X1066X33448time' => 'float', '628829X1066X33449time' => 'float', '628829X1066X33456time' => 'float', '628829X1066X33457time' => 'float', '628829X1067time' => 'float', '628829X1067X33466time' => 'float', '628829X1068time' => 'float', '628829X1068X33404time' => 'float', '628829X1068X33405time' => 'float', '628829X1068X33406time' => 'float', '628829X1069time' => 'float', '628829X1069X33467time' => 'float', '628829X1069X33468time' => 'float', '628829X1069X33469time' => 'float', '628829X1069X33472time' => 'float',
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
