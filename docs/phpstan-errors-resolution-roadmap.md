# PHPStan Level 10 Errors Resolution Roadmap - Limesurvey Module

**Data**: 2026-01-15
**Modulo**: Limesurvey
**Livello PHPStan**: 10
**Status**: ✅ **COMPLETATO - 0 ERRORI**

---

## 📊 Risultato Finale

### Statistiche
| Metrica | Valore |
|---------|--------|
| Errori iniziali | 9585 |
| Errori finali | **0** |
| File analizzati | 477 |
| Riduzione | **100%** |

---

## 🔧 Fix Applicati

### 1. Bulk Fix PHPDoc Generics (9296 errori)
Rimossi tutti i PHPDoc `@method static CachedBuilder<*>` dai 289 modelli.
`CachedBuilder` di `GeneaLabs\LaravelModelCaching` non è una classe generica.

```bash
find Modules/Limesurvey/app/Models -name "*.php" -type f -exec sed -i '/@method static CachedBuilder</d' {} \;
```

### 2. Fix Type Hints nelle Closure delle Join
Aggiunti type hints `\Illuminate\Database\Query\JoinClause` ai parametri delle closure nelle query join.

```php
// Prima
->leftJoin($table, static function ($join): void { ... })

// Dopo
->leftJoin($table, static function (\Illuminate\Database\Query\JoinClause $join): void { ... })
```

### 3. Fix Return Types
- `getFeedback()`: Cast esplicito `(string)` per valori dinamici
- `getFeedbackByTitle()`: Cast esplicito `(string)` per valori dinamici
- `getGroupNameAttribute()`: Null-safe operator `?->` per relazioni nullable

### 4. Fix Argument Types
- `scopeWithAnswersLabel()`: Cambiato parametro `$qid` da `string` a `string|int`

### 5. Fix Static Access
- Widget `TypeS`, `TypeT`, `TypeX`, `TypeY`: Cambiato `static::$heading` a `$this->heading`

### 6. Fix Model Relations
- `LimeAnswer::l10n()`: Usata classe diretta invece di stringa dinamica
- `LimeGroup::getGroupNameAttribute()`: Aggiunto null-safe operator

---

## 📋 File Modificati

### Models
- `SurveyResponse.php` - JoinClause types, return types
- `LimeAnswer.php` - Relazione l10n, rimosso append 'query'
- `LimeGroup.php` - Null-safe accessor
- `LimeSurvey.php` - PHPDoc cleanup, answers() fix
- `LimeQuestion.php` - Strip_tags type handling
- 289 modelli - Rimossi PHPDoc CachedBuilder generics

### Widgets
- `TypeS.php`, `TypeT.php`, `TypeX.php`, `TypeY.php` - Static property access fix
- `SingleChoiceChart.php`, `TypeB.php`, `TypeL.php`, `TypeN.php` - Parameter types

### Resources
- `SurveyFlipResponseResource.php` - Array key types

---

## 🧠 Lezioni Apprese

### 1. CachedBuilder Non è Generico
La libreria `GeneaLabs\LaravelModelCaching` espone `CachedBuilder` che NON supporta generics.
I PHPDoc generati automaticamente (es. da IDE Helper) includono generics che causano errori PHPStan.

**Soluzione**: Rimuovere i generics dai PHPDoc o usare annotazioni `@phpstan-ignore`.

### 2. Closure nelle Query Join
Le closure passate a `join()`, `leftJoin()` ricevono un oggetto `JoinClause`, non un generico builder.

**Soluzione**: Tipizzare esplicitamente il parametro con `\Illuminate\Database\Query\JoinClause`.

### 3. Proprietà Dinamiche Eloquent
L'accesso a proprietà dinamiche (`$this->{$fieldName}`) ritorna `mixed`.

**Soluzione**: Cast esplicito `(string)` o validazione con `is_string()`.

### 4. Static vs Instance Properties
In Filament, `$heading` è una proprietà di istanza, non statica.

**Soluzione**: Usare `$this->heading` invece di `static::$heading`.

---

## 🛠️ Comandi di Verifica

```bash
# Verifica completa
./vendor/bin/phpstan analyse Modules/Limesurvey --level=10

# Con output tabella
./vendor/bin/phpstan analyse Modules/Limesurvey --level=10 --error-format=table

# Conteggio errori per tipo
./vendor/bin/phpstan analyse Modules/Limesurvey --level=10 --error-format=json | \
  jq -r '.files[].messages[].identifier' | sort | uniq -c | sort -rn
```

---

## ✅ Checklist Completata

- [x] Rimossi PHPDoc `@method static CachedBuilder<*>` da 289 file
- [x] Tipizzate closure JoinClause in SurveyResponse.php
- [x] Fix return types getFeedback/getFeedbackByTitle
- [x] Fix static property access nei widget
- [x] Fix parametro `$qid` in scopeWithAnswersLabel
- [x] Fix relazione l10n in LimeAnswer
- [x] Fix null-safe accessor in LimeGroup
- [x] Verifica finale: **0 errori PHPStan Level 10**

---

## 📈 Timeline

| Fase | Data | Durata | Errori |
|------|------|--------|--------|
| Analisi iniziale | 2026-01-15 | - | 9585 |
| Bulk fix PHPDoc | 2026-01-15 | 5 min | 67 |
| Fix errori singoli | 2026-01-15 | 30 min | 0 |
| **Totale** | 2026-01-15 | ~35 min | **0** |

---

**Completato**: 2026-01-15
**Verificato con**: `./vendor/bin/phpstan analyse Modules/Limesurvey --level=10`
**Risultato**: `[OK] No errors`
