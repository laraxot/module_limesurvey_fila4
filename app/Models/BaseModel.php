<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

// use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Builder;
use Modules\Quaeris\Datas\AnswersFilterData;
use Modules\Xot\Models\Traits\HasExtraTrait;
use Modules\Xot\Models\XotBaseModel;

/**
 * Class BaseModel.
 */
abstract class BaseModel extends XotBaseModel
{
    use HasExtraTrait;
    /** @var string */
    protected $connection = 'limesurvey';

    /** @var array<int, string> */
    protected $appends = [
    ];

    /** @var array<string > */
    protected $with = [
        'extra',
    ];

    /**
     * Scope a query to only include popular users.
     */
    public function scopeOfFilterData(Builder $query, AnswersFilterData $answersFilterData): void
    {
        $query->when(
            $answersFilterData->date_from,
            static function ($q1) use ($answersFilterData): void {
                $q1->where('submitdate', '>=', $answersFilterData->date_from);
            }
        )->when(
            $answersFilterData->date_to,
            static function ($q1) use ($answersFilterData): void {
                $q1->where('submitdate', '<=', $answersFilterData->date_to);
            }
        )
        /*
        ->when(
            $answersFilterData->question_filter,
            function ($q1) use ( $answersFilterData) {
                $filter_field -- da fare !
                $q1->where($filter_field, $answersFilterData->question_filter);
            }
        )
        */;
    }
}
