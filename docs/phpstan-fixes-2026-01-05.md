# PHPStan Fixes - Modulo Limesurvey

## Correzione Massiva Docblocks Modelli

### Errore
`PHPDoc tag @method ... return type contains generic type GeneaLabs\LaravelModelCaching\CachedBuilder<static(...)> but class GeneaLabs\LaravelModelCaching\CachedBuilder is not generic.`

Questo errore si ripete per quasi tutti i metodi statici in oltre 150 modelli auto-generati, portando a circa 10.000 errori PHPStan.

### Soluzione
Rimuovere il parametro generico `<static>` dal tipo `CachedBuilder` nei docblock dei modelli.

**Pattern di ricerca:** `CachedBuilder<static>`
**Pattern di sostituzione:** `CachedBuilder`

### Metodologia di Correzione
Utilizzo di `sed` per la sostituzione massiva in `Modules/Limesurvey/app/Models/`.

```bash
find Modules/Limesurvey/app/Models/ -name "*.php" -exec sed -i 's/CachedBuilder<static>/CachedBuilder/g' {} +
```

### Correzione Covarianza Proprietà ($fillable, $hidden)

### Errore
`PHPDoc type array<int, string> of property ... is not covariant with PHPDoc type list<string> of overridden property ...`

### Soluzione
Sostituire `array<int, string>` con `list<string>` nei docblock delle proprietà `$fillable` e `$hidden`.

**Pattern di ricerca:** `array<int, string>`
**Pattern di sostituzione:** `list<string>`

### Metodologia di Correzione
Utilizzo di `sed` per la sostituzione massiva.

```bash
find Modules/Limesurvey/app/Models/ -name "*.php" -exec sed -i 's/array<int, string>/list<string>/g'  {} +
```
