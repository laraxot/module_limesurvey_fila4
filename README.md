# Modulo Limesurvey

Modulo Laravel per la gestione dei questionari LimeSurvey.

## Database

Il modulo utilizza il database `quaeris_survey` (connessione `limesurvey`) che contiene:

- **228 tabelle survey dinamiche** (`lime_survey_{id}`)
- **81 tabelle token dinamiche** (`lime_tokens_{id}`)
- **Tabelle statiche** per configurazione (surveys, questions, groups, answers)

Per documentazione completa del database, vedere:
- [Database quaeris_survey - Analisi Completa](./docs/database-quaeris-survey.md)

## Modelli Principali

- `LimeSurvey`: Configurazione survey
- `LimeGroup`: Gruppi di domande
- `LimeQuestion`: Domande (struttura ad albero)
- `LimeAnswer`: Opzioni di risposta
- `SurveyResponse`: Risposte (tabelle dinamiche)
- `LimeParticipant`: Partecipanti

## Utilizzo

### Accesso Risposte

```php
use Modules\Limesurvey\Models\SurveyResponse;

$responses = SurveyResponse::getResponsesForSurvey($surveyId)
    ->withAnswersLabel($qid, $fieldName)
    ->get();
```

## Documentazione

- [Database Architecture](./docs/database-quaeris-survey.md)
- [Performance Optimization](./docs/performance/)
- [Roadmap](./docs/roadmap.md)