# Changelog - Modulo Limesurvey

All notable changes to this module will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Fixed
- **Architettura Modelli: Correzione BaseModel e Modelli Dinamici (15 Ottobre 2025)**
  - `BaseModel.php`: Ora estende `XotBaseModel` invece di `Model`
    - Rimossi: Cachable, HasFactory, HasExtraTrait, newFactory()
    - Mantenuto: `$connection = 'limesurvey'`, `$timestamps = false`, scopeOfFilterData()
    - **Benefici:** ~65 righe duplicate eliminate
  - `SurveyResponse.php`: Ora estende `BaseModel` invece di `Model`
    - Rimossa: `$connection = 'limesurvey'` (automatica da BaseModel)
    - Funzionalità `setTableForSurvey()` mantenuta e funzionante
    - Aggiunto PHPDoc completo
  - `TokensResponse.php`: Ora estende `BaseModel` invece di `Model`
    - Rimossa: `$connection = 'limesurvey'` (automatica da BaseModel)
    - Funzionalità `setTableForSurvey()` mantenuta e funzionante
    - Aggiunto PHPDoc completo
  - **Impatto:** Tabelle dinamiche ora seguono l'architettura standard senza perdere funzionalità

## 1.0.0 - 202X-XX-XX

- Initial release

