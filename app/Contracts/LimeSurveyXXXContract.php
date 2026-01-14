<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Contracts;

use Illuminate\Database\Eloquent\Builder;
use Modules\Quaeris\Datas\AnswersFilterData;

/**
 * @property int $id
 * @property string|null $token
 * @property \Carbon\Carbon|null $submitdate
 * @property int|null $lastpage
 * @property string|null $startlanguage
 * @property string|null $seed
 * @property \Carbon\Carbon|null $startdate
 * @property \Carbon\Carbon|null $datestamp
 * @property string|null $ipaddr
 * @property string|null $refurl
 *
 * @method mixed getAttribute(string $key)
 * @method Builder ofFilterData(AnswersFilterData $answersFilterData)
 *
 * @mixin \Illuminate\Database\Eloquent\Model
 */
interface LimeSurveyXXXContract
{
    /**
     * Scope a query to only include popular users.
     */
    public function scopeOfFilterData(Builder $query, AnswersFilterData $answersFilterData): void;

    // public function ofFilterData(AnswersFilterData $answersFilterData): Builder;
}
