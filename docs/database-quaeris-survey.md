# Database quaeris_survey - Analisi Completa

**Data Creazione**: Gennaio 2026  
**Database**: `quaeris_survey`  
**Connessione Laravel**: `limesurvey`  
**Tipo**: MySQL/MariaDB

## Panoramica

Il database `quaeris_survey` è il database principale utilizzato dal modulo Limesurvey per gestire tutti i dati relativi ai questionari (survey). Questo database contiene sia tabelle statiche (configurazione) che tabelle dinamiche (dati delle risposte).


### Statistiche Database (Gennaio 2026)

- **Tabelle totali**: ~500+ tabelle
- **Survey totali**: 400
- **Survey attivi**: 228
- **Tabelle survey dinamiche**: 228 (`lime_survey_{id}`)
- **Tabelle token dinamiche**: 81 (`lime_tokens_{id}`)
- **Tabelle timing dinamiche**: Multiple (`lime_survey_{id}_timings`)
- **Tabelle archiviate**: Multiple (`lime_old_survey_*`)
- **Domande totali**: 53,401
- **Media domande per survey**: 133.5
- **Risposte totali**: 49,549 (lime_answers)
- **Traduzioni domande**: 55,201 (lime_question_l10ns)
- **Traduzioni risposte**: 54,418 (lime_answer_l10ns)


### Tabelle Più Grandi (per Rows)

1. `lime_tokens_946595`: 192,061 righe (27.6 MB dati, 7.7 MB indici)
2. `lime_question_attributes`: 157,341 righe (5.7 MB dati, 4.0 MB indici)
3. `lime_tokens_39275`: 134,291 righe (21.3 MB dati, 5.9 MB indici)
4. `lime_tokens_657328`: 100,298 righe (16.7 MB dati, 4.7 MB indici)
5. `lime_tokens_892883`: 61,195 righe (14.8 MB dati, 3.3 MB indici)


## Architettura del Database

### Tabelle Statiche (Configurazione)

Le tabelle statiche contengono la configurazione e la struttura dei questionari:


#### 1. `lime_surveys` (62 colonne)
Tabella principale che contiene la configurazione di tutti i survey.

**Colonne Principali**:
- `sid` (int, PK): Survey ID - identificatore univoco del survey
- `owner_id` (int): ID del proprietario del survey
- `gsid` (int): Group Survey ID
- `active` (varchar(1)): Stato attivo/inattivo ('Y'/'N')
- `expires` (datetime): Data di scadenza
- `startdate` (datetime): Data di inizio
- `adminemail` (varchar(254)): Email amministratore
- `anonymized` (varchar(1)): Anonimizzazione attiva
- `template` (varchar): Template utilizzato
- `language` (varchar): Lingua principale
- `datecreated` (datetime): Data di creazione

**Relazioni**:
- `hasMany` → `LimeGroup` (groups)
- `hasMany` → `LimeQuestion` (questions)
- `hasOne` → `LimeSurveysLanguagesetting` (lang)

**Modello**: `Modules\Limesurvey\Models\LimeSurvey`


#### 2. `lime_groups` (5 colonne)
Contiene i gruppi di domande all'interno di un survey.

**Colonne**:
- `gid` (int, PK): Group ID
- `sid` (int, FK): Survey ID
- `group_order` (int): Ordine del gruppo
- `randomization_group` (string): Gruppo di randomizzazione
- `grelevance` (string|null): Condizione di rilevanza

**Relazioni**:
- `belongsTo` → `LimeSurvey` (survey)
- `hasMany` → `LimeQuestion` (questions)
- `hasOne` → `LimeGroupL10n` (labels)

**Modello**: `Modules\Limesurvey\Models\LimeGroup`


#### 3. `lime_questions` (17 colonne)
Contiene tutte le domande dei survey.

**Colonne Principali**:
- `qid` (int, PK, auto_increment): Question ID
- `parent_qid` (int, MUL, default: 0): ID domanda padre (per domande annidate)
- `sid` (int, MUL, default: 0): Survey ID
- `gid` (int, MUL, default: 0): Group ID
- `type` (varchar(30), MUL, default: 'T'): Tipo di domanda
- `title` (varchar(20), MUL): Titolo della domanda
- `question` (text, nullable): Testo della domanda (multilingua)
- `preg` (text, nullable): Pattern regex per validazione
- `other` (varchar(1), default: 'N'): Opzione "Altro"
- `mandatory` (varchar(1), nullable): Obbligatorietà ('Y'/'N')
- `question_order` (int): Ordine della domanda
- `scale_id` (int): ID scala
- `same_default` (int): Default condiviso
- `relevance` (text, nullable): Condizione di rilevanza (espressione)
- `modulename` (varchar(255), nullable): Nome modulo
- `encrypted` (varchar(1), nullable): Crittografia
- `question_theme_name` (varchar(255), nullable): Tema domanda
- `same_script` (int): Script condiviso
- `field_name` (computed): Nome campo dinamico (es. '39275X41X487')

**Indici**:
- PRIMARY KEY: `qid`
- INDEX: `parent_qid`, `sid`, `gid`, `type`, `title`

**Tipi di Domande Più Comuni**:
- `T` (Text): 27,239 domande (51.0%) - Testo libero
- `;` (Array): 10,410 domande (19.5%) - Array di opzioni
- `F` (File): 4,174 domande (7.8%) - Upload file
- `M` (Multiple): 3,518 domande (6.6%) - Scelta multipla
- `L` (List): 2,645 domande (5.0%) - Lista dropdown
- `1` (Scale): 1,981 domande (3.7%) - Scala numerica
- `!` (Exclamation): 913 domande (1.7%) - Domanda esclamativa
- Altri tipi: `:`, `B`, `S`, `K`, `X`, etc.

**Relazioni**:
- `belongsTo` → `LimeSurvey` (survey)
- `belongsTo` → `LimeGroup` (group)
- `belongsTo` → `LimeQuestion` (parent) - per domande annidate
- `hasMany` → `LimeQuestion` (children) - domande figlie
- `hasMany` → `LimeAnswer` (answers) - opzioni di risposta
- `hasOne` → `LimeQuestionL10n` (l10n) - traduzioni

**Modello**: `Modules\Limesurvey\Models\LimeQuestion`

**Nota**: Utilizza `Staudenmeir\LaravelAdjacencyList` per gestire la struttura ad albero delle domande annidate.


#### 4. `lime_answers` (6 colonne)
Contiene le opzioni di risposta per le domande di tipo scelta multipla.

**Colonne**:
- `aid` (int, PK): Answer ID
- `qid` (int, FK): Question ID
- `code` (string): Codice della risposta (es. 'AO01', 'AO02')
- `sortorder` (int): Ordine di visualizzazione
- `assessment_value` (int): Valore per assessment
- `scale_id` (int): ID scala

**Relazioni**:
- `belongsTo` → `LimeQuestion` (question)
- `hasOne` → `LimeAnswerL10n` (l10n) - traduzioni

**Modello**: `Modules\Limesurvey\Models\LimeAnswer`


#### 5. `lime_answer_l10ns` (4 colonne)
Traduzioni delle risposte.

**Colonne**:
- `aid` (int, FK): Answer ID
- `language` (string): Lingua
- `answer` (text): Testo tradotto

**Modello**: `Modules\Limesurvey\Models\LimeAnswerL10n`


#### 6. `lime_participants` (10 colonne)
Tabella principale dei partecipanti (token).

**Colonne Principali**:
- `participant_id` (int, PK): ID partecipante
- `firstname` (string): Nome
- `lastname` (string): Cognome
- `email` (string): Email
- `language` (string): Lingua preferita

**Modello**: `Modules\Limesurvey\Models\LimeParticipant`


### Tabelle Dinamiche (Dati)

Le tabelle dinamiche vengono create automaticamente quando viene creato un nuovo survey. Il pattern di naming è: `lime_{type}_{surveyId}`.


#### 1. `lime_survey_{surveyId}` (Dinamica)
Tabella che contiene tutte le risposte di un survey specifico.

**Pattern**: `lime_survey_{sid}` (es. `lime_survey_39275`)

**Colonne Standard**:
- `id` (int, PK): ID risposta
- `token` (string): Token del partecipante (per join con tokens)
- `submitdate` (datetime): Data di invio (usato per filtri temporali)
- `lastpage` (int): Ultima pagina compilata
- `startlanguage` (string): Lingua di inizio
- `datestamp` (datetime): Timestamp creazione
- `seed` (string): Seed per randomizzazione
- `startdate` (datetime): Data inizio compilazione

**Esempio Reale** (`lime_survey_39275`):
- **61 colonne totali**: 8 colonne standard + 53 colonne dinamiche
- **Colonne dinamiche**: `39275X39X465`, `39275X39X466`, `39275X40X539`, etc.
- **Sub-domande**: `39275X40X475SQ001`, `39275X40X475SQ002`, etc.

**Colonne Dinamiche**:
Ogni domanda genera una o più colonne dinamiche con pattern:
- `{sid}X{gid}X{qid}` per domande principali
- `{sid}X{gid}X{qid}SQ001`, `{sid}X{gid}X{qid}SQ002` per sub-domande

**Esempio**:
- Domanda principale: `39275X41X487`
- Sub-domande: `39275X41X487SQ001`, `39275X41X487SQ002`

**Modello**: `Modules\Limesurvey\Models\SurveyResponse`

**Metodo di Accesso**:
```php
// Il modello usa tabelle dinamiche
SurveyResponse::getResponsesForSurvey('39275')
    ->where('submitdate', '>=', '2024-01-01')
    ->get();
```


#### 2. `lime_tokens_{surveyId}` (Dinamica)
Tabella che contiene i token/partecipanti per un survey specifico.

**Pattern**: `lime_tokens_{sid}` (es. `lime_tokens_39275`)

**Colonne Standard**:
- `tid` (int, PK): Token ID
- `token` (string, UNIQUE): Token univoco
- `firstname` (string): Nome
- `lastname` (string): Cognome
- `email` (string): Email
- `emailstatus` (string): Stato email
- `token` (string): Token di accesso
- `language` (string): Lingua
- `sent` (datetime): Data invio
- `remindersent` (datetime): Data reminder
- `remindercount` (int): Contatore reminder
- `completed` (datetime|null): Data completamento
- `usesleft` (int): Utilizzi rimanenti

**Modelli Dinamici**:
I modelli vengono generati automaticamente: `LimeTokens{surveyId}` (es. `LimeTokens39275`)

**Action per Generazione**:
```php
app(GetParticipantModelBySurveyIdAction::class)->execute('39275');
```


#### 3. `lime_survey_{surveyId}_timings` (Dinamica)
Tabella che contiene i tempi di compilazione per ogni pagina.

**Pattern**: `lime_survey_{sid}_timings` (es. `lime_survey_39275_timings`)

**Colonne**:
- `id` (int, PK): ID timing
- `token` (string): Token partecipante
- `firstgroup` (int): Primo gruppo
- `lastgroup` (int): Ultimo gruppo
- `datestamp` (datetime): Timestamp

**Modelli Dinamici**: `LimeSurvey{surveyId}Timings` (es. `LimeSurvey39275Timings`)


### Tabelle di Supporto

#### `extras`
Tabella per attributi extra dei modelli (pattern Laraxot).

**Colonne**:
- `id` (string, PK)
- `model_type` (string): Tipo modello
- `model_id` (string): ID modello
- `extra_attributes` (json): Attributi extra
- `created_at`, `updated_at`, `deleted_at`
- `created_by`, `updated_by`, `deleted_by`

**Modello**: `Modules\Limesurvey\Models\Extra`


## Relazioni Principali

### Struttura Gerarchica

```
LimeSurvey (sid) - 400 survey, 228 attivi
├── LimeGroup (gid, sid) - Gruppi di domande
│   └── LimeQuestion (qid, gid, sid) - 53,401 domande totali
│       ├── LimeAnswer (aid, qid) - 49,549 opzioni risposta
│       ├── LimeQuestionL10n (qid, language) - 55,201 traduzioni
│       └── LimeQuestion (parent_qid) - Domande annidate (tree structure)
├── lime_survey_{sid} - 228 tabelle dinamiche (risposte)
│   └── Colonne dinamiche: {sid}X{gid}X{qid}
└── lime_tokens_{sid} - 81 tabelle dinamiche (partecipanti)
    └── Join con lime_survey_{sid} tramite token
```


### Nota sulle Foreign Key

**⚠️ IMPORTANTE**: Il database `quaeris_survey` **NON utilizza foreign key fisiche** nel database. Le relazioni sono gestite a livello logico tramite Eloquent e sono basate su convenzioni di naming e valori di colonne.

**Motivazione**:
- Performance: Evita overhead di constraint checking
- Flessibilità: Permette modifiche strutturali senza vincoli
- Compatibilità: LimeSurvey originale non usa FK

**Implicazioni**:
- Le relazioni devono essere gestite a livello applicativo
- Integrità referenziale garantita da Eloquent e validazione
- Join manuali richiedono attenzione ai nomi colonne


### Relazioni Eloquent

```php
// Survey → Groups
$survey->groups; // HasMany (LimeGroup)

// Survey → Questions
$survey->questions; // HasMany (LimeQuestion)

// Survey → Language Settings
$survey->lang; // HasOne (LimeSurveysLanguagesetting)

// Group → Questions
$group->questions; // HasMany (LimeQuestion)

// Group → Labels (traduzioni)
$group->labels; // HasOne (LimeGroupL10n)

// Question → Answers
$question->answers; // HasMany (LimeAnswer)

// Question → Parent/Children (Tree - AdjacencyList)
$question->parent; // BelongsTo (LimeQuestion)
$question->children; // HasMany (LimeQuestion)
$question->brothers; // HasMany (LimeQuestion) - stesse domande dello stesso survey

// Question → Translations
$question->l10n; // HasOne (LimeQuestionL10n)

// Question → Group
$question->group; // BelongsTo (LimeGroup)

// Answer → Translations
$answer->l10n; // HasOne (LimeAnswerL10n)

// Survey → Responses (dinamico - tabelle dinamiche)
SurveyResponse::getResponsesForSurvey($survey->sid);

// Survey → Tokens (dinamico - modelli generati)
app(GetParticipantModelBySurveyIdAction::class)->execute($survey->sid);
```


### Scope Methods Disponibili

#### SurveyResponse

```php
// Filtri temporali e domande
->ofDashboardFilterData(DashboardFilterData $filter)
->ofQuestionChartFilterData(QuestionChartFilterData $filter)
->ofFilterData(AnswersFilterData $filter)

// Join con label tradotte
->withAnswersLabel(string|int $qid, string $field_name, string $prefix = '', string $type = 'join')
->withAllAnswers(string $type = 'join') // Tutte le risposte con traduzioni

// Join con partecipanti
->withParticipants() // Join con lime_tokens_{sid}
```


#### LimeQuestion

```php
// Filtri
->ofFilterData(AnswersFilterData $filter)

// Tree queries (AdjacencyList)
->tree() // Albero completo
->isRoot() // Solo radici
->isLeaf() // Solo foglie
->hasChildren() // Con figli
->hasParent() // Con padre
->ancestors() // Antenati
->descendants() // Discendenti
->siblings() // Fratelli
```


#### BaseModel (tutti i modelli)

```php
// Filtri standard
->ofFilterData(AnswersFilterData $filter)
```


## Implementazione Migliorata con SurveyResponse

Il modello `SurveyResponse` offre un accesso immediato ai dati delle risposte ai sondaggi LimeSurvey senza la necessità di popolare preliminarmente i dati. Di seguito sono descritti i punti chiave di un'implementazione ottimizzata:


- **Connessione al Database**: Utilizza la connessione `limesurvey` definita in `config/database.php`, che punta al database `quaeris_survey` tramite variabili d'ambiente come `DB_DATABASE_LIMESURVEY`.
- **Tabelle Dinamiche**: Il modello imposta dinamicamente la tabella del sondaggio con il metodo `setTableForSurvey($surveyId)`, utilizzando il formato `lime_survey_{surveyId}`. Questo permette di accedere direttamente alle risposte di un sondaggio specifico.
- **Recupero Dati**: Il metodo `getResponsesForSurvey($surveyId)` restituisce un builder Eloquent per query personalizzate sulle risposte di un sondaggio.
- **Filtri e Aggregazioni**: Utilizzare `ofDashboardFilterData()` per applicare filtri basati su intervalli di date e condizioni specifiche sulle domande, ideale per dashboard e report.
- **Etichette Risposte**: Metodi come `withAnswersLabel()` e `withAllAnswers()` permettono di arricchire i dati con etichette delle risposte, migliorando la leggibilità nei report.
- **Caching**: Implementare caching con il pacchetto `GeneaLabs\LaravelModelCaching` (già presente nel modello) per ridurre il carico sul database durante query ripetitive. Configurare il cooldown del cache con `withCacheCooldownSeconds()`.
- **Export Grafici in PDF**: Integrare con la pipeline esistente (JPGraph per rendering server-side delle immagini, Html2Pdf o Spatie laravel-pdf per embedding in PDF). Utilizzare query ottimizzate con indici per velocizzare l'estrazione dati.


### Tradeoff e Considerazioni

- **Vantaggi**: Accesso immediato ai dati, query flessibili con Eloquent, integrazione con filtri dashboard.
- **Svantaggi**: Potenziale complessità con dataset molto grandi; necessità di ottimizzare query e caching.
- **Engine PDF**: Scegliere Html2Pdf per compatibilità con template Blade semplici, Spatie laravel-pdf per supporto CSS moderno e rendering complesso (richiede Chromium).


Questa implementazione si concentra sull'efficienza del data layer e sulla scalabilità per reporting avanzato.


## Pattern di Naming

### Field Names

I field names seguono il pattern: `{sid}X{gid}X{qid}`

**Esempi**:
- `39275X41X487` - Domanda principale
- `39275X41X487SQ001` - Prima sub-domanda
- `39275X41X487SQ002` - Seconda sub-domanda


### Tabelle Dinamiche

- **Risposte**: `lime_survey_{sid}`
- **Token**: `lime_tokens_{sid}`
- **Timing**: `lime_survey_{sid}_timings`
- **Archiviate**: `lime_old_survey_{sid}_{timestamp}`


## Utilizzo nel Modulo Quaeris

Il modulo Quaeris utilizza il database `quaeris_survey` per:


1. **QuestionChart**: Visualizzazione grafici delle risposte
2. **SurveyResponse**: Accesso alle risposte dei survey
3. **Dashboard**: Statistiche e filtri
4. **Export**: Esportazione dati


### Esempio di Query Complessa

```php
// Ottenere risposte con label tradotte
$responses = SurveyResponse::getResponsesForSurvey('39275')
    ->withAnswersLabel($qid, $fieldName, 'prefix', 'join')
    ->ofDashboardFilterData($filterData)
    ->get();
```


## Configurazione Laravel

### Connessione Database

```php
// config/database.php
'limesurvey' => [
    'driver' => 'mysql',
    'host' => env('DB_HOST', '127.0.0.1'),
    'port' => env('DB_PORT', '3306'),
    'database' => env('DB_DATABASE_LIMESURVEY', 'quaeris_survey'),
    'username' => env('DB_USERNAME_LIMESURVEY', 'user'),
    'password' => env('DB_PASSWORD_LIMESURVEY', 'password'),
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'strict' => false,
],
```


### BaseModel

Tutti i modelli del modulo Limesurvey estendono `BaseModel` che ha:


```php
protected $connection = 'limesurvey';
```


## Best Practices

### 1. Accesso a Tabelle Dinamiche

**✅ CORRETTO**:
```php
SurveyResponse::getResponsesForSurvey($surveyId)
    ->where('submitdate', '>=', $date)
    ->get();
```


**❌ ERRATO**:
```php
// Non usare direttamente il nome tabella
DB::table('lime_survey_'.$surveyId)->get();
```


### 2. Query con Join

**✅ CORRETTO**:
```php
$query = SurveyResponse::getResponsesForSurvey($surveyId)
    ->withAnswersLabel($qid, $fieldName, 'prefix', 'join')
    ->withParticipants();
```


### 3. Filtri Dashboard

**✅ CORRETTO**:
```php
$query = SurveyResponse::getResponsesForSurvey($surveyId)
    ->ofDashboardFilterData($filterData);
```


## Performance

### Indicizzazione

#### Tabelle Statiche

**lime_surveys**:
- PRIMARY KEY: `sid`
- INDEX: `owner_id` (lime_idx1_surveys)
- INDEX: `gsid` (lime_idx2_surveys)


**lime_questions**:
- PRIMARY KEY: `qid`
- INDEX: `parent_qid` (per tree queries)
- INDEX: `sid` (per filtri survey)
- INDEX: `gid` (per filtri gruppo)
- INDEX: `type` (per filtri tipo)
- INDEX: `title` (per ricerca)


**lime_answers**:
- PRIMARY KEY: `aid`
- INDEX: `qid` (per join con questions)


#### Tabelle Dinamiche

Le tabelle dinamiche `lime_survey_{sid}` dovrebbero avere indici su:
- `token` (per join con `lime_tokens_{sid}`)
- `submitdate` (per filtri temporali - CRITICO per performance)
- Field names principali (se utilizzati frequentemente in WHERE)


**⚠️ IMPORTANTE**: Verificare che gli indici esistano sulle tabelle dinamiche più utilizzate.


### Caching

I modelli utilizzano `GeneaLabs\LaravelModelCaching` per cache automatica:
- Cache delle query Eloquent
- Tag-based invalidation
- Configurabile per modello


### Query Optimization

#### 1. Utilizzare Scope Methods

**✅ CORRETTO**:
```php
SurveyResponse::getResponsesForSurvey($surveyId)
    ->ofDashboardFilterData($filterData) // Scope ottimizzato
    ->get();
```


**❌ ERRATO**:
```php
SurveyResponse::getResponsesForSurvey($surveyId)
    ->where('submitdate', '>=', $dateFrom) // Query manuale
    ->where('submitdate', '<=', $dateTo)
    ->get();
```


#### 2. Eager Loading per Traduzioni

**✅ CORRETTO**:
```php
// Una query con join
->withAnswersLabel($qid, $fieldName, 'prefix', 'join')
```


**❌ ERRATO**:
```php
// N+1 queries
foreach ($responses as $response) {
    $response->answer_label; // Query per ogni risposta
}
```


#### 3. Limitare Colonne

**✅ CORRETTO**:
```php
->addSelect(['id', 'token', 'submitdate', $fieldName])
```


**❌ ERRATO**:
```php
->get(); // Carica tutte le colonne (61+ colonne dinamiche)
```


### Bottlenecks Identificati

1. **Tabelle Token Grandi**: `lime_tokens_946595` con 192k righe
   - Utilizzare indici su `token` e `email`
   - Considerare partizionamento per survey molto grandi


2. **Query con Multiple Join**: `withAllAnswers()` può generare molti join
   - Preferire `subquery` type per performance migliori
   - Limitare a domande necessarie


3. **Tabelle Dinamiche con Molte Colonne**: 61+ colonne per survey
   - Utilizzare `addSelect()` per limitare colonne caricate
   - Evitare `SELECT *` su tabelle dinamiche


## Migrazioni e Backup

### Tabelle Archiviate

Le tabelle vecchie vengono archiviate con pattern:
- `lime_old_survey_{sid}_{timestamp}`


### Backup

Il database `quaeris_survey` dovrebbe essere incluso nei backup regolari data la quantità di dati storici.


## Riferimenti

- [Modulo Limesurvey](../README.md)
- [SurveyResponse Model](../app/Models/SurveyResponse.php)
- [LimeSurvey Model](../app/Models/LimeSurvey.php)
- [LimeQuestion Model](../app/Models/LimeQuestion.php)


## Collegamenti

- [Database Architecture Overview](../../Quaeris/docs/database-architecture.md)
- [Survey Response Patterns](../../Quaeris/docs/question-chart-implementation.md)


*Ultimo aggiornamento: Gennaio 2026*

## Struttura del Database LimeSurvey

- **Tabelle Statiche**: Contengono metadati del sondaggio come `lime_surveys`, `lime_questions`, `lime_groups`.
- **Tabelle Dinamiche**: Contengono dati delle risposte, come `lime_survey_{sid}` per ogni sondaggio e `lime_tokens_{sid}` per i token dei partecipanti.
- **Indici**: Importanti per query efficienti, specialmente su colonne come `submitdate` e `token`.

## Implementazione Migliorata con SurveyResponse

Il modello `SurveyResponse` offre un accesso immediato ai dati delle risposte ai sondaggi LimeSurvey senza la necessità di popolare preliminarmente i dati. Di seguito sono descritti i punti chiave di un'implementazione ottimizzata:

- **Connessione al Database**: Utilizza la connessione `limesurvey` definita in `config/database.php`, che punta al database `quaeris_survey` tramite variabili d'ambiente come `DB_DATABASE_LIMESURVEY`.
- **Tabelle Dinamiche**: Il modello imposta dinamicamente la tabella del sondaggio con il metodo `setTableForSurvey($surveyId)`, utilizzando il formato `lime_survey_{surveyId}`. Questo permette di accedere direttamente alle risposte di un sondaggio specifico.
- **Recupero Dati**: Il metodo `getResponsesForSurvey($surveyId)` restituisce un builder Eloquent per query personalizzate sulle risposte di un sondaggio.
- **Filtri e Aggregazioni**: Utilizzare `ofDashboardFilterData()` per applicare filtri basati su intervalli di date e condizioni specifiche sulle domande, ideale per dashboard e report.
- **Etichette Risposte**: Metodi come `withAnswersLabel()` e `withAllAnswers()` permettono di arricchire i dati con etichette delle risposte, migliorando la leggibilità nei report.
- **Caching**: Implementare caching con il pacchetto `GeneaLabs\LaravelModelCaching` (già presente nel modello) per ridurre il carico sul database durante query ripetitive. Configurare il cooldown del cache con `withCacheCooldownSeconds()`.
- **Export Grafici in PDF**: Integrare con la pipeline esistente (JPGraph per rendering server-side delle immagini, Html2Pdf o Spatie laravel-pdf per embedding in PDF). Utilizzare query ottimizzate con indici per velocizzare l'estrazione dati.

### Tradeoff e Considerazioni

- **Vantaggi**: Accesso immediato ai dati, query flessibili con Eloquent, integrazione con filtri dashboard.
- **Svantaggi**: Potenziale complessità con dataset molto grandi; necessità di ottimizzare query e caching.
- **Engine PDF**: Scegliere Html2Pdf per compatibilità con template Blade semplici, Spatie laravel-pdf per supporto CSS moderno e rendering complesso (richiede Chromium).

Questa implementazione si concentra sull'efficienza del data layer e sulla scalabilità per reporting avanzato.

## Pattern di Naming

### Field Names

I field names seguono il pattern: `{sid}X{gid}X{qid}`

**Esempi**:
- `39275X41X487` - Domanda principale
- `39275X41X487SQ001` - Prima sub-domanda
- `39275X41X487SQ002` - Seconda sub-domanda

### Tabelle Dinamiche

- **Risposte**: `lime_survey_{sid}`
- **Token**: `lime_tokens_{sid}`
- **Timing**: `lime_survey_{sid}_timings`
- **Archiviate**: `lime_old_survey_{sid}_{timestamp}`

## Utilizzo nel Modulo Quaeris

Il modulo Quaeris utilizza il database `quaeris_survey` per:

1. **QuestionChart**: Visualizzazione grafici delle risposte
2. **SurveyResponse**: Accesso alle risposte dei survey
3. **Dashboard**: Statistiche e filtri
4. **Export**: Esportazione dati

### Esempio di Query Complessa

```php
// Ottenere risposte con label tradotte
$responses = SurveyResponse::getResponsesForSurvey('39275')
    ->withAnswersLabel($qid, $fieldName, 'prefix', 'join')
    ->ofDashboardFilterData($filterData)
    ->get();
```

## Configurazione Laravel

### Connessione Database

```php
// config/database.php
'limesurvey' => [
    'driver' => 'mysql',
    'host' => env('DB_HOST', '127.0.0.1'),
    'port' => env('DB_PORT', '3306'),
    'database' => env('DB_DATABASE_LIMESURVEY', 'quaeris_survey'),
    'username' => env('DB_USERNAME_LIMESURVEY', 'user'),
    'password' => env('DB_PASSWORD_LIMESURVEY', 'password'),
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'strict' => false,
],
```

### BaseModel

Tutti i modelli del modulo Limesurvey estendono `BaseModel` che ha:

```php
protected $connection = 'limesurvey';
```

## Best Practices

### 1. Accesso a Tabelle Dinamiche

**✅ CORRETTO**:
```php
SurveyResponse::getResponsesForSurvey($surveyId)
    ->where('submitdate', '>=', $date)
    ->get();
```

**❌ ERRATO**:
```php
// Non usare direttamente il nome tabella
DB::table('lime_survey_'.$surveyId)->get();
```

### 2. Query con Join

**✅ CORRETTO**:
```php
$query = SurveyResponse::getResponsesForSurvey($surveyId)
    ->withAnswersLabel($qid, $fieldName, 'prefix', 'join')
    ->withParticipants();
```

### 3. Filtri Dashboard

**✅ CORRETTO**:
```php
$query = SurveyResponse::getResponsesForSurvey($surveyId)
    ->ofDashboardFilterData($filterData);
```

## Performance

### Indicizzazione

#### Tabelle Statiche

**lime_surveys**:
- PRIMARY KEY: `sid`
- INDEX: `owner_id` (lime_idx1_surveys)
- INDEX: `gsid` (lime_idx2_surveys)

**lime_questions**:
- PRIMARY KEY: `qid`
- INDEX: `parent_qid` (per tree queries)
- INDEX: `sid` (per filtri survey)
- INDEX: `gid` (per filtri gruppo)
- INDEX: `type` (per filtri tipo)
- INDEX: `title` (per ricerca)

**lime_answers**:
- PRIMARY KEY: `aid`
- INDEX: `qid` (per join con questions)

#### Tabelle Dinamiche

Le tabelle dinamiche `lime_survey_{sid}` dovrebbero avere indici su:
- `token` (per join con `lime_tokens_{sid}`)
- `submitdate` (per filtri temporali - CRITICO per performance)
- Field names principali (se utilizzati frequentemente in WHERE)

**⚠️ IMPORTANTE**: Verificare che gli indici esistano sulle tabelle dinamiche più utilizzate.

### Caching

I modelli utilizzano `GeneaLabs\LaravelModelCaching` per cache automatica:
- Cache delle query Eloquent
- Tag-based invalidation
- Configurabile per modello

### Query Optimization

#### 1. Utilizzare Scope Methods

**✅ CORRETTO**:
```php
SurveyResponse::getResponsesForSurvey($surveyId)
    ->ofDashboardFilterData($filterData) // Scope ottimizzato
    ->get();
```

**❌ ERRATO**:
```php
SurveyResponse::getResponsesForSurvey($surveyId)
    ->where('submitdate', '>=', $dateFrom) // Query manuale
    ->where('submitdate', '<=', $dateTo)
    ->get();
```

#### 2. Eager Loading per Traduzioni

**✅ CORRETTO**:
```php
// Una query con join
->withAnswersLabel($qid, $fieldName, 'prefix', 'join')
```

**❌ ERRATO**:
```php
// N+1 queries
foreach ($responses as $response) {
    $response->answer_label; // Query per ogni risposta
}
```

#### 3. Limitare Colonne

**✅ CORRETTO**:
```php
->addSelect(['id', 'token', 'submitdate', $fieldName])
```

**❌ ERRATO**:
```php
->get(); // Carica tutte le colonne (61+ colonne dinamiche)
```

### Bottlenecks Identificati

1. **Tabelle Token Grandi**: `lime_tokens_946595` con 192k righe
   - Utilizzare indici su `token` e `email`
   - Considerare partizionamento per survey molto grandi

2. **Query con Multiple Join**: `withAllAnswers()` può generare molti join
   - Preferire `subquery` type per performance migliori
   - Limitare a domande necessarie

3. **Tabelle Dinamiche con Molte Colonne**: 61+ colonne per survey
   - Utilizzare `addSelect()` per limitare colonne caricate
   - Evitare `SELECT *` su tabelle dinamiche

## Migrazioni e Backup

### Tabelle Archiviate

Le tabelle vecchie vengono archiviate con pattern:
- `lime_old_survey_{sid}_{timestamp}`

### Backup

Il database `quaeris_survey` dovrebbe essere incluso nei backup regolari data la quantità di dati storici.

## Riferimenti

- [Modulo Limesurvey](../README.md)
- [SurveyResponse Model](../app/Models/SurveyResponse.php)
- [LimeSurvey Model](../app/Models/LimeSurvey.php)
- [LimeQuestion Model](../app/Models/LimeQuestion.php)

## Collegamenti

- [Database Architecture Overview](../../Quaeris/docs/database-architecture.md)
- [Survey Response Patterns](../../Quaeris/docs/question-chart-implementation.md)

*Ultimo aggiornamento: Gennaio 2026*

```
