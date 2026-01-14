<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use Exception;
use GeneaLabs\LaravelModelCaching\CachedBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\Quaeris\Datas\AnswersFilterData;
use Modules\Quaeris\Datas\DashboardFilterData;
use Modules\Quaeris\Datas\QuestionChartFilterData;
use Modules\Quaeris\Models\Profile;
use Modules\Xot\Actions\Query\GetFieldnamesByTablenameAction;
use Webmozart\Assert\Assert;

/**
 * SurveyResponse Model
 *
 * @method Builder withParticipants()
 * @method Builder ofDashboardFilterData(DashboardFilterData $filter)
 * @method Builder withAnswersLabel(string|int $qid, string $field_name, string $prefix = '', string $type = 'join')
 * @method Builder withAllAnswers(string $type = 'join')
 *
 * @property int $id
 * @property string $old_id
 * @property \Carbon\Carbon|null $submitdate
 * @property string|null $token
 * @property int|null $lastpage
 * @property \Carbon\Carbon|null $startdate
 * @property \Carbon\Carbon|null $datestamp
 * @property string|null $ipaddr
 * @property string|null $refurl
 *
 * @property-read Profile|null $creator
 * @property-read Extra|null $extra
 * @property-read Profile|null $updater
 *
 * @method static CachedBuilder all($columns = [])
 * @method static CachedBuilder avg($column)
 * @method static CachedBuilder cache(array $tags = [])
 * @method static CachedBuilder cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder count($columns = '*')
 * @method static CachedBuilder disableCache()
 * @method static CachedBuilder disableModelCaching()
 * @method static CachedBuilder exists()
 * @method static CachedBuilder flushCache(array $tags = [])
 * @method static CachedBuilder getModelCacheCooldown(Model $instance)
 * @method static CachedBuilder inRandomOrder($seed = '')
 * @method static CachedBuilder insert(array $values)
 * @method static CachedBuilder isCachable()
 * @method static CachedBuilder max($column)
 * @method static CachedBuilder min($column)
 * @method static CachedBuilder newModelQuery()
 * @method static CachedBuilder newQuery()
 * @method static CachedBuilder ofFilterData(AnswersFilterData $answersFilterData)
 * @method static CachedBuilder query()
 * @method static CachedBuilder sum($column)
 * @method static CachedBuilder truncate()
 * @method static CachedBuilder withCacheCooldownSeconds(?int $seconds = null)
 *
 * @mixin \Eloquent
 */
class SurveyResponse extends BaseModel
{
    public string $surveyId = '';

    /**
     * Il nome della tabella viene impostato dinamicamente
     */
    public function setTableForSurvey(string $surveyId): void
    {
        $this->surveyId = $surveyId;
        $this->setTable('lime_survey_'.$surveyId);
    }

    /**
     * Restituisce un builder puntato sulla tabella dinamica del sondaggio passato.
     *
     * @return Builder<self>
     */
    public static function getResponsesForSurvey(string $surveyId): Builder
    {
        $instance = new static();
        $instance->setTableForSurvey($surveyId);

        return $instance->newQuery();
    }

    public function getFeedback(LimeQuestion $q): string
    {
        $results = $q->brothers()
            ->where('relevance', 'like', '%'.$q->full_title.'%')
            ->orWhere('relevance', 'like', '%'.$q->fieldname.'%')
            ->get();
        $html = '';

        foreach ($results as $row) {
            /** @var LimeQuestion $row */
            // dddx([$results, $row, $row->field_name]);
            $html = (string) $this->{$row->field_name};
        }

        return $html;
    }

    public function getFeedbackByTitle(LimeQuestion $q): ?string
    {
        $question_c = $q->brothers->firstWhere('title', $q->title.'c');
        $feedback = null;
        if ($question_c === null && $q->parent !== null) {
            $parent_question = $q->brothers->firstWhere('title', $q->parent->title.'c');
            if ($parent_question !== null) {
                Assert::isInstanceOf($parent_question, LimeQuestion::class);
                /** @var LimeQuestion $parent_question */
                $field = $parent_question->sid.'X'.$parent_question->gid.'X'.$parent_question->qid;
                $feedback = (string) $this->{$field};
            }
        } elseif ($question_c !== null) {
            $question_field_name = $question_c->field_name;
            $feedback = (string) $this->{$question_field_name};
        }

        return $feedback;

        // return 'WIP';

        // (ipotesi) i feedback  sono delle colonne che vengono abilitate con delle regole
        // circa come i campi in cui definiamo la visibility

        // questa regola e' nel campo "relevance"

        // e sono del tipo
        // (((!is_empty(39275X41X487SQ001.NAOK) && (39275X41X487SQ001.NAOK <= 5))))
        // o
        // ((39275X41X483.NAOK == "N"))
        // o
        // ((Q25_SQ001.NAOK > 5) or (Q35_SQ001.NAOK > 5) or (Q47_SQ001.NAOK > 5) or (Q53_SQ001.NAOK > 5) or (Q63_SQ001.NAOK > 5) or (  is_empty(Q25_SQ001.NAOK)   and  is_empty(Q35_SQ001.NAOK)   and  is_empty(Q47_SQ001.NAOK)  and is_empty(Q53_SQ001.NAOK)  and  is_empty(Q63_SQ001.NAOK)  ))
        // o
        // ((( ! is_empty(Q35_SQ001.NAOK) && (Q35_SQ001.NAOK <= 5))))

        // percio' o c'e' il nome del fieldname di riferimento,
        // se non c'e' padre il titolo della question ,
        // e se c'e' il padre e' il titolo del padre ."_" . titolo del figlio
    }

    /**
     * Undocumented function
     */
    public function scopeWithAnswersLabel(Builder $query, string|int $qid, string $field_name, string $prefix = '', string $type = 'join'): Builder
    {
        $ask_table = 'lime_answers';
        $ask_table_lang = 'lime_answer_l10ns';
        if ($type === 'subquery') {
            return $query
                ->addSelect([
                    $prefix.'answer' => LimeAnswer::select('answer')
                        // @phpstan-ignore-next-line method.nonObject
                        ->leftJoin($ask_table_lang, static function (\Illuminate\Database\Query\JoinClause $join): void {
                            $join->on('lime_answers.aid', '=', 'lime_answer_l10ns.aid')
                                ->where('language', '=', 'it');
                        })
                        ->whereColumn('code', $field_name)
                        ->where('qid', $qid)
                        ->take(1),
                ]);
        }
        if ($type === 'join') {
            return $query // ->selectRaw('*,ask_lang.answer as label')
            // ->addSelect(''.$prefix.'ask_lang.answer')
            // ->addSelect(DB::Raw($this->getTable().'.*'))
                ->addSelect(DB::Raw($this->getTable().'.'.$this->getKeyName().' as _id'))
                ->addSelect(DB::Raw(''.$prefix.'ask_lang.answer as '.$prefix.'answer'))
                // @phpstan-ignore-next-line method.nonObject
                ->leftJoin($ask_table.' as '.$prefix.'ask', static function (\Illuminate\Database\Query\JoinClause $join) use ($qid, $field_name, $prefix): void {
                    $join->on(''.$prefix.'ask.code', '=', $field_name)
                        ->where(''.$prefix.'ask.qid', '=', $qid);
                    // @phpstan-ignore-next-line method.nonObject
                })->leftJoin($ask_table_lang.' as '.$prefix.'ask_lang', static function (\Illuminate\Database\Query\JoinClause $join) use ($prefix): void {
                    $join->on(''.$prefix.'ask.aid', '=', ''.$prefix.'ask_lang.aid')
                        ->where(''.$prefix.'ask_lang.language', '=', 'it');
                });
        }
        throw new Exception('type not in [join,subquery]');
    }

    public function scopeWithAllAnswers(Builder $query, string $type = 'join'): Builder
    {
        $questions = LimeQuestion::where('sid', $this->surveyId)
            ->whereNotIn('type', ['X'])
            ->get();

        $table = 'lime_survey_'.$this->surveyId;
        $fieldnames = app(GetFieldnamesByTablenameAction::class)->execute($table, 'limesurvey');

        foreach ($questions as $q) {
            Assert::isInstanceOf($q, LimeQuestion::class, '['.__LINE__.']['.class_basename(self::class).']');

            if (! in_array($q->fieldname, $fieldnames)) {
                continue;
            }

            $main = $q->qid;
            if ($q->parent_qid !== 0) {
                $main = $q->parent_qid;
            }
            if ($q->hasTrans()) {
                /** @var Builder<self> $query */
                $query = $this->scopeWithAnswersLabel($query, $main, $q->fieldName, $q->fieldName, 'subquery');
            }
        }

        return $query;
    }

    /**
     * Undocumented function
     *
     * @param  Builder  $builder
     */
    public function scopeWithParticipants(Builder $builder): Builder
    {
        $survey_id = $this->surveyId;
        $participants_table = 'lime_tokens_'.$survey_id;
        $survey_table = 'lime_survey_'.$survey_id;

        return $builder
            // @phpstan-ignore-next-line method.nonObject
            ->join($participants_table.' as u', static function (\Illuminate\Database\Query\JoinClause $join) use ($survey_table): void {
                $join->on('u.token', '=', $survey_table.'.token');
            });
    }

    public function scopeOfDashboardFilterData(Builder $query, DashboardFilterData $filter): Builder
    {
        $query = $query->where('submitdate', '>=', $filter->startDate)
            ->where('submitdate', '<=', $filter->endDate);

        if ($filter->question_filter !== null) {
            $filter_field = $filter->question_filter_fieldname;
            if ($filter_field !== null) {
                $query = $query->where($filter_field, $filter->question_filter);
            }
        }

        return $query;
    }

    public function scopeOfQuestionChartFilterData(Builder $query, QuestionChartFilterData $filter): Builder
    {
        /*
        if ($filters->date_from']) && $filters['date_from']) {
            // @phpstan-ignore-next-line
            $query->whereDate('submitdate', '>=', $filters['date_from']);
        }

        if (isset($filters['date_to']) && $filters['date_to']) {
            // @phpstan-ignore-next-line
            $query->whereDate('submitdate', '<=', $filters['date_to']);
        }

        if (isset($filters['answer_filter'])) {
            // @phpstan-ignore-next-line
            match ($filters['answer_filter']) {
                // @phpstan-ignore-next-line
                'answered' => $query->whereNotNull($record->field_name),
                // @phpstan-ignore-next-line
                'not_answered' => $query->whereNull($record->field_name),
                default => null,
            };
        }
            */
        return $query;
    }

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::addGlobalScope('ancient', function (Builder $builder) {
            $builder->whereNotNull('submitdate');
        });
    }
}
