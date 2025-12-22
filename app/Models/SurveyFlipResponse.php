<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Modules\Quaeris\Datas\AlertDashboardFilterData;
use Modules\Quaeris\Datas\AnswersFilterData;
use Modules\Quaeris\Datas\DashboardFilterData;

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
 * @property \Illuminate\Support\Carbon|null $submitdate
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
 * @property-read \Modules\Quaeris\Models\Profile|null $creator
 * @property-read \Modules\Limesurvey\Models\Extra|null $extra
 * @property-read \Modules\Limesurvey\Models\LimeQuestion|null $question
 * @property-read \Modules\Limesurvey\Models\LimeSurvey|null $survey
 * @property-read \Modules\Quaeris\Models\Profile|null $updater
 *
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|SurveyFlipResponse all($columns = [])
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|SurveyFlipResponse avg($column)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|SurveyFlipResponse cache(array $tags = [])
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|SurveyFlipResponse cachedValue(array $arguments, string $cacheKey)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|SurveyFlipResponse count($columns = '*')
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|SurveyFlipResponse disableCache()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|SurveyFlipResponse disableModelCaching()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|SurveyFlipResponse exists()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|SurveyFlipResponse flushCache(array $tags = [])
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|SurveyFlipResponse getModelCacheCooldown(\Illuminate\Database\Eloquent\Model $instance)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|SurveyFlipResponse inRandomOrder($seed = '')
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|SurveyFlipResponse insert(array $values)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|SurveyFlipResponse isCachable()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|SurveyFlipResponse max($column)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|SurveyFlipResponse min($column)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|SurveyFlipResponse newModelQuery()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|SurveyFlipResponse newQuery()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|SurveyFlipResponse ofAlertDashboardFilterData(\Modules\Quaeris\Datas\AlertDashboardFilterData $filter)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|SurveyFlipResponse ofAlertDashboardFilterDataOLD(\Modules\Quaeris\Datas\AlertDashboardFilterData $filter)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|SurveyFlipResponse ofDashboardFilterData(\Modules\Quaeris\Datas\DashboardFilterData $filter)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|SurveyFlipResponse ofFilterData(\Modules\Quaeris\Datas\AnswersFilterData $answersFilterData)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|SurveyFlipResponse query()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|SurveyFlipResponse sum($column)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|SurveyFlipResponse truncate()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|SurveyFlipResponse whereAnswer($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|SurveyFlipResponse whereCreatedAt($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|SurveyFlipResponse whereCreatedBy($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|SurveyFlipResponse whereDeletedAt($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|SurveyFlipResponse whereDeletedBy($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|SurveyFlipResponse whereFeedback($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|SurveyFlipResponse whereFieldname($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|SurveyFlipResponse whereId($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|SurveyFlipResponse whereOldId($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|SurveyFlipResponse whereQuestionId($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|SurveyFlipResponse whereQuestionType($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|SurveyFlipResponse whereSubmitdate($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|SurveyFlipResponse whereSurveyId($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|SurveyFlipResponse whereToken($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|SurveyFlipResponse whereUpdatedAt($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|SurveyFlipResponse whereUpdatedBy($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|SurveyFlipResponse whereValue($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|SurveyFlipResponse withCacheCooldownSeconds(?int $seconds = null)
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
