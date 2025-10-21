<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

/**
 * TokensResponse Model.
 *
 * Modello con tabella dinamica per i token dei sondaggi LimeSurvey.
 * La tabella viene impostata dinamicamente usando setTableForSurvey().
 */
class TokensResponse extends BaseModel
{
    /** @var string */
    protected $primaryKey = 'tid';

    // Il nome della tabella viene impostato dinamicamente
    public function setTableForSurvey($surveyId)
    {
        $this->setTable('lime_tokens_'.$surveyId);
    }

    // Esempio di recupero risposte in base all'ID del sondaggio
    public static function getResponsesForSurvey($surveyId)
    {
        $instance = new static;
        $instance->setTableForSurvey($surveyId);

        return $instance; // Recupera tutte le risposte dal sondaggio specifico
    }
}
