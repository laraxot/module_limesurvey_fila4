<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use GeneaLabs\LaravelModelCaching\CachedBuilder;
use Illuminate\Database\Eloquent\Model;
use Modules\Limesurvey\Contracts\LimeSurveyXXXContract;
use Modules\Quaeris\Datas\AnswersFilterData;
use Modules\Quaeris\Models\Profile;

/**
 * @property int $id
 * @property string|null $token
 * @property string|null $submitdate
 * @property int|null $lastpage
 * @property string $startlanguage
 * @property string|null $seed
 * @property string $startdate
 * @property string $datestamp
 *
 * @property-read Profile|null $creator
 * @property-read Extra|null $extra
 * @property-read Profile|null $updater
 *
 *
 * @mixin \Eloquent
 */
class LimeSurvey946595 extends BaseModel implements LimeSurveyXXXContract
{
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    /** @var string */
    protected $table = 'lime_survey_946595';

    /** @var string */
    protected $primaryKey = 'id';
}
