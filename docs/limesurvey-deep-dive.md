# LimeSurvey Deep Dive & Architecture Analysis

## 1. Architecture Overview

LimeSurvey is a survey system based on a **dynamic database schema**. Unlike traditional applications with fixed tables (e.g., `users`, `posts`), LimeSurvey generates new tables for each active survey.

### Key Components

*   **Core Engine**: PHP-based (Yii Framework legacy, moving to more modern standards).
*   **Database**: MySQL/PostgreSQL/MSSQL. The heart of the system.
*   **Plugins**: Hook-based system for extending functionality.
*   **RemoteControl API**: JSON-RPC interface for external interaction (creating surveys, exporting responses).

## 2. Database Schema: The "Dynamic" Challenge

The most critical aspect for integration is understanding how responses are stored.

### Survey Response Tables (`lime_survey_{sid}`)
For every survey with ID `{sid}` (e.g., `892883`), a table `lime_survey_892883` is created.
*   **Structure**: "Wide" table. One row per respondent. One column per question/sub-question.
*   **Columns**:
    *   `id`: Response ID.
    *   `token`: Participant token (if non-anonymous).
    *   `submitdate`: When the survey was completed.
    *   `startdate`: When it was started.
    *   `1234X12X34`: Dynamic columns based on Group ID, Question ID, Subquestion ID. Naming convention: `{sid}X{gid}X{qid}`.

**Implications for Filament/Laravel Integration**:
*   **No Standard Eloquent Model**: You cannot create a `SurveyResponse` model that maps to *all* surveys because the table name and columns change.
*   **Performance**: Querying wide tables is fast for retrieving a single response but complex for aggregate statistics across multiple surveys or dynamic questions.

### The "Flip" Solution (`SurveyFlipResponse`)
To integrate with Laravel and Filament efficiently, we use a **Transformation Strategy**.
We "flip" the wide table into a "tall" table: `survey_flip_responses`.

*   **Structure**:
    *   `survey_id`: Link to the survey.
    *   `question_id`: Link to the question definition.
    *   `response_id`: Link to the original row in `lime_survey_{sid}`.
    *   `value`: The actual answer (normalized).
    *   `fieldname`: The original column name (e.g., `1234X12X34`).

**Benefits**:
*   **Standard Eloquent Model**: `SurveyFlipResponse` is a standard model.
*   **Indexable**: We can index `[survey_id, question_id]` for instant filtering.
*   **Filament Friendly**: Ideal for Widgets and Charts.

## 3. Data Integration Strategy

1.  **Direct DB Access**: For high-performance read-only access to `lime_` tables. Use `DB::table('lime_survey_' . $sid)`.
2.  **ETL Process (Extract, Transform, Load)**:
    *   Extract from `lime_survey_{sid}`.
    *   Transform (normalize answers).
    *   Load into `SurveyFlipResponse`.
    *   *This is handled by `PopulateSurveyFlipBySurveyIdAction`.*

## 4. Best Practices for Developers

*   **NEVER** modify `lime_` tables directly from external apps. Let LimeSurvey manage its schema.
*   **ALWAYS** use the "Flip" table for analytics and dashboards.
*   **CACHE** aggregations. Don't run `COUNT(*)` on heavy tables on every page load.
