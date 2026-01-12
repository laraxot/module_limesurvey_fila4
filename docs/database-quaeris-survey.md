# Database quaeris_survey - Analisi Completa

**Data Creazione**: Gennaio 2026  
**Database**: `quaeris_survey`  
**Connessione Laravel**: `limesurvey`  
**Tipo**: MySQL/MariaDB

## Panoramica

Il database `quaeris_survey` è il database principale utilizzato dal modulo Limesurvey per gestire tutti i dati relativi ai questionari (survey). Questo database contiene sia tabelle statiche (configurazione) che tabelle dinamiche (dati delle risposte).

### Statistiche Database

- **Tabelle totali**: ~500+ tabelle
- **Tabelle survey dinamiche**: 228 (`lime_survey_{id}`)
- **Tabelle token dinamiche**: 81 (`lime_tokens_{id}`)
- **Tabelle timing dinamiche**: Multiple (`lime_survey_{id}_timings`)
- **Tabelle archiviate**: Multiple (`lime_old_survey_*`)

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
- `qid` (int, PK): Question ID
- `parent_qid` (int): ID domanda padre (per domande annidate)
- `sid` (int, FK): Survey ID
- `gid` (int, FK): Group ID
- `type` (string): Tipo di domanda (es. 'L', 'M', 'N', 'S', etc.)
- `title` (string): Titolo della domanda
- `question` (text): Testo della domanda (multilingua)
- `question_order` (int): Ordine della domanda
- `mandatory` (string|null): Obbligatorietà ('Y'/'N')
- `relevance` (string|null): Condizione di rilevanza
- `field_name` (computed): Nome campo dinamico (es. '39275X41X487')

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
- `token` (string): Token del partecipante
- `submitdate` (datetime): Data di invio
- `lastpage` (int): Ultima pagina compilata
- `startlanguage` (string): Lingua di inizio
- `datestamp` (datetime): Timestamp creazione

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
LimeSurvey (sid)
├── LimeGroup (gid, sid)
│   └── LimeQuestion (qid, gid, sid)
│       ├── LimeAnswer (aid, qid) - opzioni risposta
│       └── LimeQuestion (parent_qid) - domande annidate
└── lime_survey_{sid} - risposte
    └── lime_tokens_{sid} - partecipanti
```

### Relazioni Eloquent

```php
// Survey → Groups
$survey->groups; // HasMany

// Survey → Questions
$survey->questions; // HasMany

// Group → Questions
$group->questions; // HasMany

// Question → Answers
$question->answers; // HasMany

// Question → Parent/Children (Tree)
$question->parent; // BelongsTo
$question->children; // HasMany (AdjacencyList)

// Survey → Responses (dinamico)
SurveyResponse::getResponsesForSurvey($survey->sid);

// Survey → Tokens (dinamico)
LimeTokens{surveyId}::where('token', $token);
```

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

Le tabelle dinamiche dovrebbero avere indici su:
- `token` (per join con tokens)
- `submitdate` (per filtri temporali)
- Field names principali (se necessario)

### Caching

I modelli utilizzano `GeneaLabs\LaravelModelCaching` per cache automatica.

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
