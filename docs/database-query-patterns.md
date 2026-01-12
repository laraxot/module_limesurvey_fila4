# Pattern di Query Database quaeris_survey

**Data Creazione**: Gennaio 2026  
**Database**: `quaeris_survey`

## Pattern Comuni

### 1. Query Risposte con Filtri Temporali

```php
use Modules\Limesurvey\Models\SurveyResponse;
use Modules\Quaeris\Datas\DashboardFilterData;

$filterData = DashboardFilterData::from([
    'date_from' => '2024-01-01',
    'date_to' => '2024-12-31',
]);

$responses = SurveyResponse::getResponsesForSurvey('39275')
    ->ofDashboardFilterData($filterData)
    ->get();
```

**SQL Generato**:
```sql
SELECT * FROM lime_survey_39275
WHERE submitdate >= '2024-01-01'
  AND submitdate <= '2024-12-31'
  AND submitdate IS NOT NULL
```

### 2. Query con Label Tradotte (Join)

```php
$responses = SurveyResponse::getResponsesForSurvey('39275')
    ->withAnswersLabel(487, '39275X41X487', 'prefix', 'join')
    ->get();
```

**SQL Generato**:
```sql
SELECT 
    lime_survey_39275.id as _id,
    prefixask_lang.answer as prefixanswer,
    lime_survey_39275.*
FROM lime_survey_39275
LEFT JOIN lime_answers as prefixask 
    ON prefixask.code = '39275X41X487' 
    AND prefixask.qid = 487
LEFT JOIN lime_answer_l10ns as prefixask_lang 
    ON prefixask.aid = prefixask_lang.aid 
    AND prefixask_lang.language = 'it'
WHERE submitdate IS NOT NULL
```

### 3. Query con Label Tradotte (Subquery)

```php
$responses = SurveyResponse::getResponsesForSurvey('39275')
    ->withAnswersLabel(487, '39275X41X487', 'prefix', 'subquery')
    ->get();
```

**SQL Generato**:
```sql
SELECT 
    *,
    (SELECT answer 
     FROM lime_answers 
     LEFT JOIN lime_answer_l10ns ON lime_answers.aid = lime_answer_l10ns.aid 
     WHERE lime_answer_l10ns.language = 'it'
       AND lime_answers.code = '39275X41X487'
       AND lime_answers.qid = 487
     LIMIT 1) as prefixanswer
FROM lime_survey_39275
WHERE submitdate IS NOT NULL
```

### 4. Query con Tutte le Risposte Tradotte

```php
$responses = SurveyResponse::getResponsesForSurvey('39275')
    ->withAllAnswers('subquery')
    ->get();
```

**Comportamento**:
- Recupera tutte le domande del survey
- Per ogni domanda con traduzione, aggiunge una subquery
- Utilizza `GetFieldnamesByTablenameAction` per identificare colonne esistenti

### 5. Query con Partecipanti (Join Tokens)

```php
$responses = SurveyResponse::getResponsesForSurvey('39275')
    ->withParticipants()
    ->get();
```

**SQL Generato**:
```sql
SELECT lime_survey_39275.*
FROM lime_survey_39275
JOIN lime_tokens_39275 as u 
    ON u.token = lime_survey_39275.token
WHERE submitdate IS NOT NULL
```

### 6. Query Domande con Tree Structure

```php
use Modules\Limesurvey\Models\LimeQuestion;

// Albero completo
$tree = LimeQuestion::where('sid', '39275')
    ->tree()
    ->get();

// Solo radici
$roots = LimeQuestion::where('sid', '39275')
    ->isRoot()
    ->get();

// Domande con figli
$withChildren = LimeQuestion::where('sid', '39275')
    ->hasChildren()
    ->get();

// Antenati di una domanda
$ancestors = $question->ancestors;

// Discendenti di una domanda
$descendants = $question->descendants;
```

### 7. Query con Raggruppamento

```php
use Illuminate\Support\Facades\DB;

$responses = SurveyResponse::getResponsesForSurvey('39275')
    ->select([
        DB::raw('date_format(submitdate, "%Y-%m") as month'),
        DB::raw('COUNT(*) as count'),
        '39275X41X487 as value'
    ])
    ->groupBy(DB::raw('date_format(submitdate, "%Y-%m")'))
    ->groupBy('39275X41X487')
    ->get();
```

### 8. Query con Filtro Domanda Specifica

```php
$filterData = DashboardFilterData::from([
    'date_from' => '2024-01-01',
    'date_to' => '2024-12-31',
    'question_filter' => 'AO01',
    'question_filter_fieldname' => '39275X41X487',
]);

$responses = SurveyResponse::getResponsesForSurvey('39275')
    ->ofDashboardFilterData($filterData)
    ->get();
```

**SQL Generato**:
```sql
SELECT * FROM lime_survey_39275
WHERE submitdate >= '2024-01-01'
  AND submitdate <= '2024-12-31'
  AND 39275X41X487 = 'AO01'
  AND submitdate IS NOT NULL
```

## Pattern Anti-Pattern

### ❌ ERRATO: Query Diretta su Tabelle Dinamiche

```php
// ❌ NON FARE MAI QUESTO
DB::table('lime_survey_39275')->get();
```

**Problemi**:
- Bypassa il modello Eloquent
- Non applica global scope (submitdate IS NOT NULL)
- Non gestisce connessione corretta
- Perde funzionalità di cache

### ✅ CORRETTO: Usare Metodo Statico

```php
// ✅ CORRETTO
SurveyResponse::getResponsesForSurvey('39275')->get();
```

### ❌ ERRATO: Join Manuali senza Verifica

```php
// ❌ NON FARE MAI QUESTO
$query->join('lime_tokens_39275', 'token', '=', 'token');
```

**Problemi**:
- Nome tabella hardcoded
- Non gestisce casi edge (tabella non esiste)
- Non usa scope methods

### ✅ CORRETTO: Usare Scope Method

```php
// ✅ CORRETTO
$query->withParticipants();
```

### ❌ ERRATO: Caricare Tutte le Colonne

```php
// ❌ NON FARE MAI QUESTO
SurveyResponse::getResponsesForSurvey('39275')->get();
// Carica 61+ colonne anche se ne servono solo 3
```

### ✅ CORRETTO: Limitare Colonne

```php
// ✅ CORRETTO
SurveyResponse::getResponsesForSurvey('39275')
    ->addSelect(['id', 'token', 'submitdate', '39275X41X487'])
    ->get();
```

## Performance Tips

### 1. Utilizzare Indici

Le query su `submitdate` sono ottimizzate se esiste un indice:

```sql
CREATE INDEX idx_submitdate ON lime_survey_39275(submitdate);
```

### 2. Limitare Risultati

```php
->limit(100)
->offset(0)
```

### 3. Utilizzare Paginazione

```php
->paginate(50)
```

### 4. Evitare N+1 Queries

**❌ ERRATO**:
```php
$responses = SurveyResponse::getResponsesForSurvey('39275')->get();
foreach ($responses as $response) {
    $label = $response->getAnswerLabel(); // Query per ogni risposta
}
```

**✅ CORRETTO**:
```php
$responses = SurveyResponse::getResponsesForSurvey('39275')
    ->withAnswersLabel($qid, $fieldName)
    ->get();
```

## Riferimenti

- [Database quaeris_survey - Analisi Completa](./database-quaeris-survey.md)
- [Database Relationships - Dettaglio](./database-relationships-detailed.md)
- [SurveyResponse Model](../app/Models/SurveyResponse.php)

*Ultimo aggiornamento: Gennaio 2026*
