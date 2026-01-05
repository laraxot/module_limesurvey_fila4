<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use GeneaLabs\LaravelModelCaching\CachedBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Modules\Quaeris\Datas\AlertDashboardFilterData;
use Modules\Quaeris\Datas\AnswersFilterData;
use Modules\Quaeris\Datas\DashboardFilterData;
use Modules\Quaeris\Models\Profile;

/**
 * Class SurveyFlipResponse.
 *
 * @property int $id
 * @property string|null $survey_id
 * @property string|null $question_id
 * @property string|null $question_type
 * @property string|null $token
 * @property string|null $answer
 * @property string|null $value
 * @property Carbon|null $submitdate
 * @property string|null $fieldname
 * @property string|null $old_id
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string|null $updated_by
 * @property string|null $created_by
 * @property string|null $deleted_at
 * @property string|null $deleted_by
 * @property string|null $feedback
 *
 * @property-read Profile|null $creator
 * @property-read Extra|null $extra
 * @property-read LimeQuestion|null $question
 * @property-read LimeSurvey|null $survey
 * @property-read Profile|null $updater
 *
 * @method static CachedBuilder|SurveyFlipResponse all($columns = [])
 * @method static CachedBuilder|SurveyFlipResponse avg($column)
 * @method static CachedBuilder|SurveyFlipResponse cache(array $tags = [])
 * @method static CachedBuilder|SurveyFlipResponse cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder|SurveyFlipResponse count($columns = '*')
 * @method static CachedBuilder|SurveyFlipResponse disableCache()
 * @method static CachedBuilder|SurveyFlipResponse disableModelCaching()
 * @method static CachedBuilder|SurveyFlipResponse exists()
 * @method static CachedBuilder|SurveyFlipResponse flushCache(array $tags = [])
 * @method static CachedBuilder|SurveyFlipResponse getModelCacheCooldown(Model $instance)
 * @method static CachedBuilder|SurveyFlipResponse inRandomOrder($seed = '')
 * @method static CachedBuilder|SurveyFlipResponse insert(array $values)
 * @method static CachedBuilder|SurveyFlipResponse isCachable()
 * @method static CachedBuilder|SurveyFlipResponse max($column)
 * @method static CachedBuilder|SurveyFlipResponse min($column)
 * @method static CachedBuilder|SurveyFlipResponse newModelQuery()
 * @method static CachedBuilder|SurveyFlipResponse newQuery()
 * @method static CachedBuilder|SurveyFlipResponse ofAlertDashboardFilterData(AlertDashboardFilterData $filter)
 * @method static CachedBuilder|SurveyFlipResponse ofAlertDashboardFilterDataOLD(AlertDashboardFilterData $filter)
 * @method static CachedBuilder|SurveyFlipResponse ofDashboardFilterData(DashboardFilterData $filter)
 * @method static CachedBuilder|SurveyFlipResponse ofFilterData(AnswersFilterData $answersFilterData)
 * @method static CachedBuilder|SurveyFlipResponse query()
 * @method static CachedBuilder|SurveyFlipResponse sum($column)
 * @method static CachedBuilder|SurveyFlipResponse truncate()
 * @method static CachedBuilder|SurveyFlipResponse whereAnswer($value)
 * @method static CachedBuilder|SurveyFlipResponse whereCreatedAt($value)
 * @method static CachedBuilder|SurveyFlipResponse whereCreatedBy($value)
 * @method static CachedBuilder|SurveyFlipResponse whereDeletedAt($value)
 * @method static CachedBuilder|SurveyFlipResponse whereDeletedBy($value)
 * @method static CachedBuilder|SurveyFlipResponse whereFeedback($value)
 * @method static CachedBuilder|SurveyFlipResponse whereFieldname($value)
 * @method static CachedBuilder|SurveyFlipResponse whereId($value)
 * @method static CachedBuilder|SurveyFlipResponse whereOldId($value)
 * @method static CachedBuilder|SurveyFlipResponse whereQuestionId($value)
 * @method static CachedBuilder|SurveyFlipResponse whereQuestionType($value)
 * @method static CachedBuilder|SurveyFlipResponse whereSubmitdate($value)
 * @method static CachedBuilder|SurveyFlipResponse whereSurveyId($value)
 * @method static CachedBuilder|SurveyFlipResponse whereToken($value)
 * @method static CachedBuilder|SurveyFlipResponse whereUpdatedAt($value)
 * @method static CachedBuilder|SurveyFlipResponse whereUpdatedBy($value)
 * @method static CachedBuilder|SurveyFlipResponse whereValue($value)
 * @method static CachedBuilder|SurveyFlipResponse withCacheCooldownSeconds(?int $seconds = null)
 *
 * @mixin \Eloquent
 */
class SurveyFlipResponse extends BaseModel
{
    /** @var list<string> */
    protected $fillable = [
        'survey_id',      // ID dell'indagine
        'question_id',    // ID della domanda
        'question_type',    // Typè della domanda
        'answer',         // Valore della risposta
        'value',          // Valore da aggiungere per le risposte
        'participant_id', // ID del partecipante
        'submitdate',     // Data di invio della risposta
        'fieldname',      // Nome del campo della risposta
        'token',
        'old_id',
        'feedback',
    ];

    /** @var array<string, string> */
    protected $casts = [
        'survey_id' => 'string',
        'question_id' => 'string',
        'question_type' => 'string',
        'answer' => 'string',
        'value' => 'string',
        'participant_id' => 'string',
        'submitdate' => 'datetime',
        'fieldname' => 'string',
        'old_id' => 'string',
        'feedback' => 'string',
    ];

    /**
     * Relazione con il modello LimeQuestion.
     */
    public function question(): BelongsTo
    {
        return $this->belongsTo(LimeQuestion::class, 'question_id');
    }

    /**
     * Relazione con il modello Survey.
     */
    public function survey(): BelongsTo
    {
        return $this->belongsTo(LimeSurvey::class, 'survey_id');
    }

    /*
     * Relazione con il modello Participant dalla tabella lime_tokens_<survey_id>.
     *
     * @return HasOne

    public function participant(): HasOne
    {
        // Costruisce dinamicamente il nome della tabella
        $table = 'lime_tokens_' . $this->survey_id;

        return $this->hasOne($table, 'token', 'participant_id'); // Relazione 1 a 1
    }
    */
    /**
     * Restituisce i partecipanti per un determinato survey_id.
     */
    public static function getParticipants(string $survey_id): Collection
    {
        $table = 'lime_tokens_'.$survey_id;

        return DB::table($table)->get(); // Ottieni tutti i partecipanti per il survey_id specificato
    }

    /**
     * Ottiene le risposte per un determinato survey_id.
     */
    public static function getResponsesBySurveyId(string $survey_id): Collection
    {
        return self::where('survey_id', $survey_id)->get();
    }

    /**
     * Scope a query to filter responses based on provided filter data.
     */
    public function scopeOfFilterData(Builder $query, AnswersFilterData $answersFilterData): void
    {
        $query->when(
            $answersFilterData->date_from,
            static function (Builder $q1) use ($answersFilterData): void {
                $q1->where('submitdate', '>=', $answersFilterData->date_from);
            }
        )->when(
            $answersFilterData->date_to,
            static function (Builder $q1) use ($answersFilterData): void {
                $q1->where('submitdate', '<=', $answersFilterData->date_to);
            }
        )->when(
            $answersFilterData->question_filter,
            static function (Builder $q1) use ($answersFilterData): void {
                $q1->where('fieldname', $answersFilterData->question_filter);
            }
        );
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

    public function scopeOfAlertDashboardFilterData(Builder $query, AlertDashboardFilterData $filter): Builder
    {
        $dashboard_filter_data = $filter->getDashboardFilterData();

        $query = $query->ofDashboardFilterData($dashboard_filter_data)
            // ->whereNull('value')  // Filtro principale: solo record con value NULL
            // Verifica che answer contenga solo numeri (con possibili zeri iniziali)
            ->whereRaw('answer REGEXP "^[0-9]+$"')
            // Filtro base: solo valori numerici tra 0 e 10
            ->whereRaw('CAST(REGEXP_REPLACE(answer, "^0+", "") AS DECIMAL) >= 0')
            ->whereRaw('CAST(REGEXP_REPLACE(answer, "^0+", "") AS DECIMAL) <= 10')
            ->when(
                $filter->min_value,
                function (Builder $query, int $value): Builder {
                    return $query->whereRaw('CAST(REGEXP_REPLACE(answer, "^0+", "") AS DECIMAL) >= ?', [$value]);
                }
            )
            ->when(
                $filter->max_value,
                function (Builder $query, int $value): Builder {
                    return $query->whereRaw('CAST(REGEXP_REPLACE(answer, "^0+", "") AS DECIMAL) <= ?', [$value]);
                }
            );

        return $query;
    }

    public function scopeOfAlertDashboardFilterDataOLD(Builder $query, AlertDashboardFilterData $filter): Builder
    {
        $dashboard_filter_data = $filter->getDashboardFilterData();

        $query = $query->ofDashboardFilterData($dashboard_filter_data)
            ->when(
                $filter->min_value,
                function (Builder $query, int $value): Builder {
                    return $query->where(function (Builder $q) use ($value): void {
                        $q->whereNull('value')
                            ->whereRaw('answer REGEXP "^-?[0-9]+(\.[0-9]+)?$"')
                            ->where('answer', '>=', $value)
                            ->orWhere(function (Builder $q) use ($value): void {
                                $q->whereNotNull('value')
                                    ->whereRaw('value REGEXP "^-?[0-9]+(\.[0-9]+)?$"')
                                    ->where('value', '>=', $value);
                            });
                    });
                }
            )
            ->when(
                $filter->max_value,
                function (Builder $query, int $value): Builder {
                    return $query->where(function (Builder $q) use ($value): void {
                        $q->whereNull('value')
                            ->whereRaw('answer REGEXP "^-?[0-9]+(\.[0-9]+)?$"')
                            ->where('answer', '<=', $value)
                            ->orWhere(function (Builder $q) use ($value): void {
                                $q->whereNotNull('value')
                                    ->whereRaw('value REGEXP "^-?[0-9]+(\.[0-9]+)?$"')
                                    ->where('value', '<=', $value);
                            });
                    });
                }
            );

        return $query;
    }
}
