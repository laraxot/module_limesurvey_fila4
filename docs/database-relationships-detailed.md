# Relazioni Database quaeris_survey - Dettaglio Completo

**Data Creazione**: Gennaio 2026  
**Database**: `quaeris_survey`

## Panoramica Relazioni

Il database `quaeris_survey` **NON utilizza foreign key fisiche**. Le relazioni sono gestite a livello logico tramite:
- Convenzioni di naming
- Valori di colonne
- Eloquent relationships
- Join manuali quando necessario

## Relazioni Logiche Principali

### 1. Survey → Groups → Questions

```
lime_surveys.sid
    ↓ (logico: sid = sid)
lime_groups.sid
    ↓ (logico: gid = gid)
lime_questions.gid
```

**Implementazione Eloquent**:
```php
// LimeSurvey
public function groups(): HasMany
{
    return $this->hasMany(LimeGroup::class, 'sid', 'sid');
}

// LimeGroup
public function questions(): HasMany
{
    return $this->hasMany(LimeQuestion::class, 'gid', 'gid')
        ->where('sid', $this->sid);
}
```

### 2. Question → Answers

```
lime_questions.qid
    ↓ (logico: qid = qid)
lime_answers.qid
```

**Implementazione Eloquent**:
```php
// LimeQuestion
public function answers(): HasMany
{
    return $this->hasMany(LimeAnswer::class, 'qid', 'qid');
}
```

### 3. Question → Question (Tree Structure)

```
lime_questions.qid
    ↓ (logico: parent_qid = qid)
lime_questions.parent_qid
```

**Implementazione Eloquent** (AdjacencyList):
```php
// LimeQuestion
public function parent(): BelongsTo
{
    return $this->belongsTo(self::class, 'parent_qid', 'qid');
}

public function children(): HasMany
{
    return $this->hasMany(self::class, 'parent_qid', 'qid');
}

public function brothers(): HasMany
{
    return $this->hasMany(self::class, 'sid', 'sid')
        ->where('gid', $this->gid);
}
```

### 4. Survey → Responses (Dinamico)

```
lime_surveys.sid
    ↓ (logico: tabella dinamica)
lime_survey_{sid}.id
```

**Implementazione**:
```php
// SurveyResponse
public static function getResponsesForSurvey(string $surveyId): Builder
{
    $instance = new static;
    $instance->setTableForSurvey($surveyId);
    return $instance->newQuery();
}
```

### 5. Survey → Tokens (Dinamico)

```
lime_surveys.sid
    ↓ (logico: tabella dinamica)
lime_tokens_{sid}.tid
```

**Implementazione**:
```php
// GetParticipantModelBySurveyIdAction
$participant_class = 'Modules\Limesurvey\Models\LimeTokens'.$survey_id;
// Modello generato dinamicamente
```

### 6. Responses → Tokens (Join)

```
lime_survey_{sid}.token
    ↓ (logico: token = token)
lime_tokens_{sid}.token
```

**Implementazione**:
```php
// SurveyResponse::scopeWithParticipants()
public function scopeWithParticipants(Builder $builder): Builder
{
    $survey_id = $this->surveyId;
    $participants_table = 'lime_tokens_'.$survey_id;
    $survey_table = 'lime_survey_'.$survey_id;
    
    return $builder->join($participants_table.' as u', function ($join) use ($survey_table) {
        $join->on('u.token', '=', $survey_table.'.token');
    });
}
```

### 7. Answers → Answer Translations

```
lime_answers.aid
    ↓ (logico: aid = aid AND language = 'it')
lime_answer_l10ns.aid
```

**Implementazione**:
```php
// LimeAnswer
public function l10n(): HasOne
{
    return $this->hasOne(LimeAnswerL10n::class, 'aid', 'aid')
        ->where('language', app()->getLocale());
}
```

### 8. Questions → Question Translations

```
lime_questions.qid
    ↓ (logico: qid = qid AND language = 'it')
lime_question_l10ns.qid
```

**Implementazione**:
```php
// LimeQuestion
public function l10n(): HasOne
{
    $lang = app()->getLocale();
    return $this->hasOne(LimeQuestionL10n::class, 'qid', 'qid')
        ->where('language', $lang);
}
```

### 9. Groups → Group Translations

```
lime_groups.gid
    ↓ (logico: gid = gid AND language = 'it')
lime_group_l10ns.gid
```

**Implementazione**:
```php
// LimeGroup
public function labels(): HasOne
{
    return $this->hasOne(LimeGroupL10n::class, 'gid', 'gid')
        ->where('language', app()->getLocale());
}
```

## Relazioni Complesse

### Responses → Answers (con Traduzioni)

Per ottenere le risposte con le label tradotte, viene utilizzato un join complesso:

```php
// SurveyResponse::scopeWithAnswersLabel()
public function scopeWithAnswersLabel(
    Builder $query, 
    string $qid, 
    string $field_name, 
    string $prefix = '', 
    string $type = 'join'
): Builder
{
    $ask_table = 'lime_answers';
    $ask_table_lang = 'lime_answer_l10ns';
    
    if ($type === 'join') {
        return $query
            ->addSelect(DB::Raw($this->getTable().'.'.$this->getKeyName().' as _id'))
            ->addSelect(DB::Raw(''.$prefix.'ask_lang.answer as '.$prefix.'answer'))
            ->leftJoin($ask_table.' as '.$prefix.'ask', function ($join) use ($qid, $field_name, $prefix) {
                $join->on(''.$prefix.'ask.code', '=', $field_name)
                    ->where(''.$prefix.'ask.qid', '=', $qid);
            })
            ->leftJoin($ask_table_lang.' as '.$prefix.'ask_lang', function ($join) use ($prefix) {
                $join->on(''.$prefix.'ask.aid', '=', ''.$prefix.'ask_lang.aid')
                    ->where(''.$prefix.'ask_lang.language', '=', 'it');
            });
    }
    
    // subquery type...
}
```

**Join Logic**:
1. `lime_survey_{sid}` JOIN `lime_answers` ON `code = field_name` AND `qid = question_id`
2. `lime_answers` JOIN `lime_answer_l10ns` ON `aid = aid` AND `language = 'it'`

## Pattern di Join Manuali

### Join Responses con Tokens

```php
$query = SurveyResponse::getResponsesForSurvey($surveyId)
    ->join('lime_tokens_'.$surveyId.' as tokens', function ($join) use ($surveyId) {
        $join->on('tokens.token', '=', 'lime_survey_'.$surveyId.'.token');
    });
```

### Join Multiple Answers

```php
// Per ogni domanda con traduzione
foreach ($questions as $question) {
    if ($question->hasTrans()) {
        $query = $query->withAnswersLabel(
            $question->qid, 
            $question->fieldName, 
            $question->fieldName, 
            'subquery'
        );
    }
}
```

## Best Practices per Relazioni

### 1. Sempre Specificare Condizioni Multiple

**✅ CORRETTO**:
```php
->where('sid', $this->sid)
->where('gid', $this->gid)
```

**❌ ERRATO**:
```php
// Solo sid potrebbe restituire domande di altri gruppi
->where('sid', $this->sid)
```

### 2. Utilizzare Eager Loading

**✅ CORRETTO**:
```php
$survey->load(['groups.questions.answers.l10n']);
```

**❌ ERRATO**:
```php
foreach ($survey->groups as $group) {
    foreach ($group->questions as $question) {
        $question->answers; // N+1 queries
    }
}
```

### 3. Filtrare per Lingua nelle Traduzioni

**✅ CORRETTO**:
```php
->where('language', app()->getLocale())
```

**❌ ERRATO**:
```php
// Potrebbe restituire traduzioni in lingue diverse
->get()
```

## Riferimenti

- [Database quaeris_survey - Analisi Completa](./database-quaeris-survey.md)
- [SurveyResponse Model](../app/Models/SurveyResponse.php)
- [LimeQuestion Model](../app/Models/LimeQuestion.php)

*Ultimo aggiornamento: Gennaio 2026*
