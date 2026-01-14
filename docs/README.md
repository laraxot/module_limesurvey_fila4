 # Modulo Limesurvey
Il modulo **Limesurvey** integra nel monolite Laraxot un database e un set di modelli compatibili con **LimeSurvey** (upstream), così da poter:

- leggere struttura survey (survey, gruppi, domande, risposte)
- leggere risposte dalle tabelle dinamiche `lime_survey_{sid}`
- usare questa base dati per dashboard e report (grafici + PDF) nel modulo **Quaeris**

Questo modulo è *infrastrutturale*: espone modelli/query/utility; la business logic di reporting sta principalmente in `Modules/Quaeris`.

## Indice

- [Documentazione Consolidata](#documentazione-consolidata)
- [Panoramica e collegamenti](#panoramica-e-collegamenti)
- [LimeSurvey upstream: architettura](#limesurvey-upstream-architettura)
- [Database: tabelle dinamiche survey_{sid} e tokens_{sid}](#database-tabelle-dinamiche-survey_sid-e-tokens_sid)
- [Statistiche ed export in LimeSurvey (cosa aspettarsi)](#statistiche-ed-export-in-limesurvey-cosa-aspettarsi)
- [Integrazione Laraxot: query, label tradotte, performance](#integrazione-laraxot-query-label-tradotte-performance)
- [Grafici e PDF: come si fa “alla Laraxot / Filament 4”](#grafici-e-pdf-come-si-fa-alla-laraxot--filament-4)

## Documentazione Consolidata

**Nuova struttura ordinata** (gennaio 2026):

- **[index-consolidated.md](index-consolidated.md)** - Indice completo della documentazione
- **[architecture-and-integration.md](architecture-and-integration.md)** - Architettura e integrazione (punto di partenza consigliato)
- **[models-and-queries.md](models-and-queries.md)** - Modelli e pattern di query
- **[best-practices.md](best-practices.md)** - Best practices e ottimizzazioni
- **[phpstan/](phpstan/)** - Analisi PHPStan e compliance Level 10

## Panoramica e collegamenti

- **Docs principali del modulo**:
  - `index.md`
  - `limesurvey-deep-dive-architecture.md`
  - `database-quaeris-survey.md`
  - `database-schema.md`
  - `upstream-references.md`
- **Docs correlati (moduli)**:
  - `../../Quaeris/docs/database-limesurvey-usage.md`
  - `../../Quaeris/docs/pdf-generation-with-charts.md`
  - `../../Chart/docs/charts-and-pdf-complete-guide.md`
  - `../../Chart/docs/filament-charts-professional-guide.md`
  - `../../Chart/docs/pdf-engines-comparison.md`

## LimeSurvey upstream: architettura

LimeSurvey (upstream: [github.com/LimeSurvey/LimeSurvey](https://github.com/LimeSurvey/LimeSurvey)) è un sistema survey maturo basato su **Yii 1.x** (legacy) con un’architettura MVC e un plugin system event-driven.

Concetti da portarsi dietro per l’integrazione:

- **Survey**: contenitore master (ID = `sid`)
- **Group**: gruppi di domande (ID = `gid`)
- **Question**: domande (ID = `qid`, `parent_qid` per sub-questions)
- **Answers**: opzioni risposta (per domande “list”) e relative l10n
- **Responses**: *tabella dinamica per survey* (vedi sotto)

Dettagli completi:

- `limesurvey-deep-dive-architecture.md`

## Database: tabelle dinamiche survey_{sid} e tokens_{sid}

LimeSurvey crea tabelle dinamiche per ogni survey attiva:

- `lime_survey_{sid}`: risposte (una riga = una response)
- `lime_survey_{sid}_timings`: tempi di compilazione
- `lime_tokens_{sid}`: token/partecipanti (se token management attivo)

Campo risposta: LimeSurvey materializza una colonna per domanda, con naming “dinamico”:

- base: `{sid}X{gid}X{qid}`
- subquestion: `{sid}X{gid}X{qid}{sq_title}`
- multiple choice: `{sid}X{gid}X{qid}[{code}]`

Questo significa che nel codice Laravel bisogna gestire con attenzione l’accesso a proprietà dinamiche; in generale:

- preferire `getAttribute($fieldName)` / array-access su model
- evitare query “manuali” su `DB::table('lime_survey_'.$sid)` se esiste già uno scope/model dedicato

## Statistiche ed export in LimeSurvey (cosa aspettarsi)

LimeSurvey offre una sezione “Responses & statistics” con:

- **Statistics (simple mode)**: grafici base
- **Statistics (expert mode)**: filtri, output, grafici configurabili

Output tipici in upstream:

- **HTML**: vista interattiva
- **PDF**: *limitazioni sui grafici* (in upstream spesso solo pie/bar; dipende da versione e implementazione)
- **Excel/CSV**: dati tabellari (in upstream l’Excel non include grafici)

Nota pratica per Laraxot: anche se LimeSurvey ha export/statistiche, nel nostro stack i report “professionali” (Filament 4 + PDF con grafici) vanno costruiti nel monolite:

- per controllo completo di layout, branding e performance
- per caching e batch generation (queue)
- per coerenza UX e permessi (Filament)

## Integrazione Laraxot: query, label tradotte, performance

Pattern consigliati (vedi `../../Quaeris/docs/database-limesurvey-usage.md`):

- **Base query**: `SurveyResponse::getResponsesForSurvey($sid)`
- **Filtri standard**: `->ofDashboardFilterData(...)`
- **Label tradotte**: `->withAnswersLabel($qid, $fieldName, ..., ...)` oppure `->withAllAnswers('subquery')`

Per survey grandi:

- usare `subquery` per evitare join ripetuti
- caching su struttura survey (questions, answers l10n)
- evitare N+1 su l10n/answers

## Grafici e PDF: come si fa “alla Laraxot / Filament 4”

In Laraxot il reporting si compone di due livelli:

- **Web (dashboard)**: Chart.js via widget Filament 4
- **PDF**: immagini server-side (JPGraph) o export Chart.js a PNG/SVG e embedding in HTML2PDF

Punti di verità (docs esistenti):

- `../../Chart/docs/filament-charts-professional-guide.md`
- `../../Chart/docs/charts-and-pdf-complete-guide.md`
- `../../Quaeris/docs/spipu-pdf-charts-embedding-guide.md`

## PHPStan Code Quality Achievement

The Limesurvey module has achieved **Level 10 compliance** with PHPStan, meaning:

- ✅ **0 errors** at the highest level of type checking
- ✅ Full type safety across all components
- ✅ Complete code quality compliance
- ✅ Professional-grade static analysis results

This achievement ensures maximum reliability, maintainability, and code quality for the LimeSurvey integration module.
