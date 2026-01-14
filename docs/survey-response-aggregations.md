# SurveyResponse Model - Aggregations and Data Access

## Overview

Il modello `SurveyResponse` fornisce accesso ai dati delle risposte ai sondaggi LimeSurvey. A differenza di altri modelli Eloquent, accede a tabelle dinamiche (`lime_survey_{surveyId}`) che variano a seconda del sondaggio.

## Architettura

### Tabelle Dinamiche

Ogni sondaggio LimeSurvey ha una tabella dedicata:
- `lime_survey_123456` per il sondaggio con ID 123456
- Contiene tutte le risposte inviate per quel sondaggio
- Colonne dinamiche basate sulle domande del sondaggio

### Connessione Database

```php
// In BaseModel del modulo Limesurvey
protected $connection = 'limesurvey';  // Usa la connessione 'limesurvey' da config/database.php
```

Configurazione in `config/database.php`:
```php
'limesurvey' => [
    'driver' => 'mysql',
    'host' => env('DB_HOST_LIMESURVEY'),
    'port' => env('DB_PORT_LIMESURVEY'),
    'database' => env('DB_DATABASE_LIMESURVEY', 'quaeris_survey'),
    'username' => env('DB_USERNAME_LIMESURVEY'),
    'password' => env('DB_PASSWORD_LIMESURVEY'),
    // ...
],
```

## Metodi Principali

### 1. getResponsesForSurvey()

Crea un builder puntato alla tabella dinamica del sondaggio:

```php
public static function getResponsesForSurvey(string $surveyId): Builder
{
    $instance = new static;
    $instance->setTableForSurvey($surveyId);
    return $instance->newQuery();
}
```

**Utilizzo:**
```php
$responses = SurveyResponse::getResponsesForSurvey('123456')
    ->where('submitdate', '!=', null)
    ->get();
```

### 2. withAnswersLabel()

Aggiunge le etichette tradotte delle risposte tramite JOIN con le tabelle `lime_answers` e `lime_answer_l10ns`:

```php
public function scopeWithAnswersLabel(
    Builder $query, 
    string $qid,              // ID della domanda
    string $field_name,       // Nome del campo nella tabella lime_survey_*
    string $prefix = '',      // Prefisso per le colonne
    string $type = 'join'     // 'join' o 'subquery'
): Builder
```

**Utilizzo:**
```php
$responses = SurveyResponse::getResponsesForSurvey('123456')
    ->withAnswersLabel('42', '123456X1X42')  // Aggiunge la colonna 'answer' con l'etichetta
    ->select('submitdate', '123456X1X42 as value', 'answer')
    ->get();
```

**Risultato:**
- Aggiunge colonna `answer` con l'etichetta tradotta della risposta
- Usa la lingua 'it' per default
- Supporta prefissi per multiple join

### 3. withAllAnswers()

Aggiunge le etichette per tutte le domande che hanno risposte tradotte:

```php
public function scopeWithAllAnswers(Builder $query, string $type = 'join'): Builder
```

**Utilizzo:**
```php
$responses = SurveyResponse::getResponsesForSurvey('123456')
    ->withAllAnswers()  // Aggiunge tutte le etichette
    ->get();
```

### 4. ofDashboardFilterData()

Applica i filtri di data e altri filtri specifici:

```php
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
```

**Utilizzo:**
```php
$filterData = DashboardFilterData::from([
    'date_from' => '2024-01-01',
    'date_to' => '2024-12-31',
]);

$responses = SurveyResponse::getResponsesForSurvey('123456')
    ->ofDashboardFilterData($filterData)
    ->get();
```

### 5. withParticipants()

Aggiunge informazioni sui partecipanti tramite JOIN con la tabella `lime_tokens_*`:

```php
public function scopeWithParticipants(Builder $builder): Builder
{
    $survey_id = $this->surveyId;
    $participants_table = 'lime_tokens_'.$survey_id;
    $survey_table = 'lime_survey_'.$survey_id;

    return $builder
        ->join($participants_table.' as u', static function ($join) use ($survey_table): void {
            $join->on('u.token', '=', $survey_table.'.token');
        });
}
```

## Aggregazioni Supportate

### Conteggi (COUNT)

```php
// Contare le risposte per valore
$responses = SurveyResponse::getResponsesForSurvey('123456')
    ->select(
        DB::raw('field_name as value'),
        DB::raw('COUNT(*) as count')
    )
    ->groupBy('field_name')
    ->get();

// Risultato:
// [
//     {'value': 'Y', 'count': 45},
//     {'value': 'N', 'count': 55},
// ]
```

### Conteggi Condizionali (SUM)

```php
// Contare quante risposte hanno valore 'Y'
$responses = SurveyResponse::getResponsesForSurvey('123456')
    ->select(
        DB::raw('date_format(submitdate, "%Y-%m") as month'),
        DB::raw('SUM(field_name = "Y") as y_count'),
        DB::raw('SUM(field_name = "N") as n_count')
    )
    ->groupBy(DB::raw('date_format(submitdate, "%Y-%m")'))
    ->get();

// Risultato:
// [
//     {'month': '2024-01', 'y_count': 10, 'n_count': 15},
//     {'month': '2024-02', 'y_count': 12, 'n_count': 18},
// ]
```

### Medie (AVG)

```php
// Calcolare la media dei valori numerici
$responses = SurveyResponse::getResponsesForSurvey('123456')
    ->select(
        DB::raw('date_format(submitdate, "%Y-%m") as month'),
        DB::raw('AVG(CAST(field_name AS DECIMAL(10,2))) as avg_value')
    )
    ->groupBy(DB::raw('date_format(submitdate, "%Y-%m")'))
    ->get();
```

### Minimo e Massimo (MIN/MAX)

```php
$responses = SurveyResponse::getResponsesForSurvey('123456')
    ->select(
        DB::raw('MIN(CAST(field_name AS DECIMAL(10,2))) as min_value'),
        DB::raw('MAX(CAST(field_name AS DECIMAL(10,2))) as max_value')
    )
    ->get();
```

### Percentuali

```php
$responses = SurveyResponse::getResponsesForSurvey('123456')
    ->select(
        DB::raw('field_name as value'),
        DB::raw('COUNT(*) as count'),
        DB::raw('ROUND(COUNT(*) / (SELECT COUNT(*) FROM lime_survey_123456) * 100, 2) as percentage')
    )
    ->groupBy('field_name')
    ->get();
```

## Caching

Il modello usa `GeneaLabs\LaravelModelCaching` per cache automatico:

```php
// Il caching è automatico
$responses = SurveyResponse::getResponsesForSurvey('123456')->get();  // Cachato

// Disabilitare il cache
$responses = SurveyResponse::getResponsesForSurvey('123456')
    ->disableCache()
    ->get();

// Pulire il cache
SurveyResponse::flushCache();
```

## Filtri Globali

Il modello applica automaticamente un filtro globale per escludere le risposte non inviate:

```php
protected static function booted(): void
{
    static::addGlobalScope('ancient', function (Builder $builder) {
        $builder->whereNotNull('submitdate');  // Esclude risposte non completate
    });
}
```

## Esempi Completi

### Esempio 1: Conteggi per Valore (come nel sistema attuale)

```php
$record = QuestionChart::find(1);  // Domanda di tipo 'Y'
$filterData = DashboardFilterData::from(['date_from' => '2024-01-01', 'date_to' => '2024-12-31']);

$responses = SurveyResponse::getResponsesForSurvey($record->surveyId)
    ->withAnswersLabel($record->question, $record->field_name)
    ->select(
        'submitdate',
        DB::raw($record->field_name.' as value'),
        DB::raw('SUM('.$record->field_name.' = "Y") as Y_count'),
        DB::raw('SUM('.$record->field_name.' = "N") as N_count'),
        'answer'
    )
    ->ofDashboardFilterData($filterData)
    ->groupBy('value')
    ->get();
```

### Esempio 2: Trend Mensile

```php
$responses = SurveyResponse::getResponsesForSurvey('123456')
    ->withAnswersLabel('42', '123456X1X42')
    ->select(
        DB::raw('date_format(submitdate, "%Y-%m") as month'),
        DB::raw('SUM(123456X1X42 = "Y") as y_count'),
        DB::raw('SUM(123456X1X42 = "N") as n_count'),
        DB::raw('COUNT(*) as total')
    )
    ->ofDashboardFilterData($filterData)
    ->groupBy(DB::raw('date_format(submitdate, "%Y-%m")'))
    ->orderBy('month')
    ->get();
```

### Esempio 3: Statistiche Complesse

```php
$responses = SurveyResponse::getResponsesForSurvey('123456')
    ->select(
        DB::raw('date_format(submitdate, "%Y-%m") as month'),
        DB::raw('COUNT(*) as total_responses'),
        DB::raw('SUM(field_name = "Y") as y_count'),
        DB::raw('ROUND(SUM(field_name = "Y") / COUNT(*) * 100, 2) as y_percent'),
        DB::raw('AVG(CAST(field_name AS DECIMAL(10,2))) as avg_value'),
        DB::raw('MIN(CAST(field_name AS DECIMAL(10,2))) as min_value'),
        DB::raw('MAX(CAST(field_name AS DECIMAL(10,2))) as max_value')
    )
    ->ofDashboardFilterData($filterData)
    ->groupBy(DB::raw('date_format(submitdate, "%Y-%m")'))
    ->get();
```

## Performance Tips

1. **Selezionare solo le colonne necessarie** - Usare `select()` per limitare le colonne
2. **Indicizzare le colonne di filtro** - Assicurarsi che `submitdate` sia indicizzato
3. **Usare il caching** - Il modello lo fa automaticamente
4. **Raggruppare a livello database** - Non in memoria
5. **Limitare i risultati** - Usare `limit()` per grandi dataset

## Troubleshooting

### Errore: "Unknown column"
- Verificare che il `field_name` sia corretto per il sondaggio
- Controllare che la colonna esista nella tabella `lime_survey_{surveyId}`

### Errore: "Table doesn't exist"
- Verificare che il `surveyId` sia corretto
- Controllare che il sondaggio esista in LimeSurvey

### Risultati vuoti
- Controllare i filtri di data
- Verificare che ci siano risposte completate (`submitdate != null`)

### Performance lenta
- Controllare gli indici del database
- Ridurre il numero di JOIN
- Usare `limit()` per testare

## Riferimenti

- `SurveyResponse.php`: Modello principale
- `DashboardFilterData.php`: Gestione dei filtri
- `QuestionChart.php`: Utilizzo in Quaeris
- `QuestionChartAnswersTableWidget.php`: Utilizzo nei widget
