# Relazioni Ricorsive nel Modulo Limesurvey

## 📋 Panoramica

Il modulo Limesurvey utilizza relazioni ricorsive per gestire la struttura gerarchica delle domande (`LimeQuestion`) utilizzando il contratto `HasRecursiveRelationshipsContract` e il trait `TypedHasRecursiveRelationships`.

## 🏛️ Filosofia Laraxot

### Pattern di Implementazione

**✅ CORRETTO**: Usare il contratto e il trait wrapper Laraxot

```php
<?php

namespace Modules\Limesurvey\Models;

use Modules\Xot\Contracts\HasRecursiveRelationshipsContract;
use Modules\Xot\Models\Traits\TypedHasRecursiveRelationships;

class LimeQuestion extends BaseModel implements HasRecursiveRelationshipsContract
{
    use TypedHasRecursiveRelationships;
    
    public function getParentKeyName(): string
    {
        return 'parent_qid';  // Override per colonna custom
    }
    
    public function getLocalKeyName(): string
    {
        return 'qid';  // Override per colonna custom
    }
}
```

**❌ SBAGLIATO**: Usare direttamente il trait vendor

```php
// ❌ NON FARE QUESTO
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

class LimeQuestion extends BaseModel
{
    use HasRecursiveRelationships;  // No type safety
}
```

## 🎯 Modelli con Relazioni Ricorsive

### LimeQuestion

**File**: `app/Models/LimeQuestion.php`

**Struttura Gerarchica**:
- **Parent Key**: `parent_qid` (colonna che punta al parent)
- **Local Key**: `qid` (primary key)
- **Relazione**: Una domanda può avere un parent e molti figli

**Metodi Override**:
```php
public function getParentKeyName(): string
{
    return 'parent_qid';  // Override del default 'parent_id'
}

public function getLocalKeyName(): string
{
    return 'qid';  // Override del default 'id'
}
```

**Utilizzo**:
```php
$question = LimeQuestion::find(5);

// Ottenere il parent
$parent = $question->parent;

// Ottenere i figli
$children = $question->children;

// Ottenere tutti gli antenati
$ancestors = $question->ancestors()->get();

// Ottenere tutti i discendenti
$descendants = $question->descendants()->get();

// Ottenere i fratelli (domande con stesso parent)
$siblings = $question->siblings()->get();
```

## 📚 BaseTreeModel

**File**: `app/Models/BaseTreeModel.php`

Classe base astratta per modelli con relazioni ricorsive nel modulo Limesurvey.

**Implementazione**:
```php
abstract class BaseTreeModel extends BaseModel implements HasRecursiveRelationshipsContract
{
    use TypedHasRecursiveRelationships;
}
```

**Utilizzo**: Estendere `BaseTreeModel` per modelli che necessitano relazioni ricorsive.

## 🔧 Configurazione Personalizzata

### Override Metodi di Configurazione

I modelli possono sovrascrivere i metodi di configurazione per adattarsi alla struttura del database:

```php
class LimeQuestion extends BaseModel implements HasRecursiveRelationshipsContract
{
    use TypedHasRecursiveRelationships;
    
    // Override colonna parent key
    public function getParentKeyName(): string
    {
        return 'parent_qid';
    }
    
    // Override colonna local key
    public function getLocalKeyName(): string
    {
        return 'qid';
    }
    
    // Override colonna depth (opzionale)
    public function getDepthName(): string
    {
        return 'depth';  // Default, può essere omesso
    }
    
    // Override colonna path (opzionale)
    public function getPathName(): string
    {
        return 'path';  // Default, può essere omesso
    }
    
    // Override separatore path (opzionale)
    public function getPathSeparator(): string
    {
        return '.';  // Default, può essere omesso
    }
}
```

## 📝 Esempi Pratici

### Esempio 1: Navigazione Albero Domande

```php
// Ottenere una domanda
$question = LimeQuestion::find(10);

// Ottenere il root (domanda senza parent)
$root = $question->rootAncestor()->first();

// Ottenere tutti i discendenti fino a profondità 2
$descendants = $question->descendants()
    ->whereDepth('<=', 2)
    ->get();

// Ottenere tutti gli antenati
$ancestors = $question->ancestors()->get();

// Verificare se è root
$isRoot = $question->isRoot();

// Verificare se è leaf (senza figli)
$isLeaf = $question->isLeaf();
```

### Esempio 2: Query con Vincoli

```php
// Solo domande attive fino a profondità 3
$activeQuestions = $question->descendants()
    ->whereDepth('<=', 3)
    ->where('active', true)
    ->get();

// Solo antenati con tipo specifico
$typedAncestors = $question->ancestors()
    ->where('type', 'L')
    ->get();
```

### Esempio 3: Costruzione Path

```php
// Ottenere il path completo come stringa
$path = $question->getFirstPathSegment();

// Verificare se il path è annidato
$isNested = $question->hasNestedPath();
```

## 🔍 Metodi Disponibili

Tutti i metodi definiti in `HasRecursiveRelationshipsContract` sono disponibili:

- **Configurazione**: `getParentKeyName()`, `getLocalKeyName()`, `getPathName()`, `getDepthName()`, etc.
- **Relazioni**: `parent()`, `children()`, `ancestors()`, `descendants()`, `siblings()`, etc.
- **Utilità**: `getFirstPathSegment()`, `hasNestedPath()`, `isIntegerAttribute()`, `getLabel()`

Vedi [Documentazione Completa](../Xot/docs/recursive-relationships-contract.md) per l'elenco completo.

## 📚 Riferimenti

- [HasRecursiveRelationshipsContract](../Xot/docs/recursive-relationships-contract.md) - Documentazione completa del contratto
- [TypedHasRecursiveRelationships](../Xot/docs/contracts-and-interfaces.md) - Documentazione del trait wrapper
- [Vendor Package](https://github.com/staudenmeir/laravel-adjacency-list) - Documentazione ufficiale

---

**Filosofia**: In Laraxot, usiamo sempre il contratto e il trait wrapper per garantire type safety e manutenibilità, mai il trait vendor direttamente.

