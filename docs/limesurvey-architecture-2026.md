# LimeSurvey Architecture & Developer Guide (2026)

## 1. System Overview

LimeSurvey is a monolithic PHP application built on the Yii Framework. Its architecture is characterized by a "Dynamic Database Schema" where specific tables are created on the fly for each activated survey.

### Core Components
- **Framework**: Yii (PHP)
- **Database**: Strictly Relational (MySQL/MariaDB recommended for Quaeris)
- **Plugin System**: Event-driven Hook system
- **API**: JSON-RPC (RemoteControl 2)

## 2. Database Architecture (Deep Dive)

### 2.1 Static Tables (Metadata)
These tables exist permanently and manage the system configuration.

| Table | Description | Key Column |
|-------|-------------|------------|
| `lime_surveys` | Survey configuration (active, format, owner) | `sid` |
| `lime_groups` | Question groups (pages) | `gid` |
| `lime_questions` | Question definitions, types, logic | `qid` |
| `lime_answers` | Predefined answers for closed questions | `aid` |
| `lime_tokens_{SID}` | Participants table (created per survey if not anonymous) | `tid` |
| `lime_users` | Admin users | `uid` |

### 2.2 Localization (L10n) - *Critical for Quaeris*
Since version 3.x, translations are **normalized** into separate tables. You rarely query `lime_questions` for text; you query `lime_question_l10ns`.

- `lime_survey_l10ns`
- `lime_group_l10ns`
- `lime_question_l10ns`
- `lime_answer_l10ns`

**Joins are mandatory** to get the actual text for a specific language.

### 2.3 Dynamic Response Tables (`lime_survey_{SID}`)
When a survey `{SID}` is activated, LimeSurvey creates a table named `lime_survey_{SID}`.

**Structure (Flat Layout):**
- `id`: Response ID (PK)
- `submitdate`: Completion timestamp
- `lastpage`: Progress indicator
- `startlanguage`: Language used
- **Question Columns**: Naming convention `{SID}X{GID}X{QID}`.
    - Example: `1234X12X88` (Survey 1234, Group 12, Question 88).
    - Subquestions append `_{SQCODE}`: `1234X12X88_SQ001`.
    - Comments append `other`: `1234X12X88_other`.

**Performance Implication**:
These tables can become very wide (hundreds of columns). `SELECT *` is expensive.

## 3. Plugin System Architecture

LimeSurvey uses an event-driven plugin system. Plugins implement the `iPlugin` interface and extend `PluginBase`.

### Hook Mechanism
Plugins subscribe to events in their `init()` method:

```php
public function init() {
    $this->subscribe('beforeSurveySettings');
    $this->subscribe('newDirectRequest');
    $this->subscribe('afterSurveyComplete');
}
```

### Key Events for Integration
- `afterSurveyComplete`: Fired when a response is saved. **Ideal for Real-time ETL.**
- `beforeTokenEmail`: dynamic modification of emails.
- `model.*`: e.g., `model.survey.beforeSave`.

## 4. API (RemoteControl 2)

The primary interface for external automation is the JSON-RPC API.

**Endpoint**: `/index.php/admin/remotecontrol`
**Protocol**: JSON-RPC 1.0

### Authentication
Session-based.
1. Call `get_session_key(username, password)`.
2. Receive `$sessionKey`.
3. Pass `$sessionKey` to subsequent calls.
4. Call `release_session_key($sessionKey)`.

### Common Methods
- `export_responses`: Get raw response data.
- `list_surveys`: Get all surveys.
- `get_question_properties`: Get metadata.

## 5. Integration Strategy for Quaeris

### The "Flip" Strategy (ETL)
Because `lime_survey_{SID}` tables are dynamic and "wide", they are hostile to Eloquent and standard Reporting tools.

**Quaeris solution is the "SurveyFlip":**
1. **Extract**: Read row from `lime_survey_{SID}` via `DB::table()`.
2. **Transform**: Map specific column codes (`123X12X88`) to semantically meaningful question definitions.
3. **Load**: Insert into a static `survey_flip_responses` table (EAV - Entity Attribute Value pattern).

**Schema:**
- `survey_id`
- `response_id`
- `question_id`
- `value` (The answer)
- `raw_column` (The original column name)

This allows:
- `Guide::hasMany(Response)` relationship.
- Global stats ("How many 'Yes' answers across ALL surveys?").

## 6. Advanced Survey Logic: ExpressionScript (EM)

LimeSurvey's core power lies in **ExpressionScript** (formerly Expression Manager). It is a logic engine that allows complex branching, validation, and piping without custom JavaScript.

### 6.1 Core Concepts
- **Relevance**: Boolean equations controlling visibility. If `relevance == false`, the question is hidden and value set to NULL.
    - Example: `((Q1 == "Y") or (Q2 > 5))`
- **Tailoring (Piping)**: Injecting values into text using curly braces `{}`.
    - Example: "Hello {TOKEN:firstname}, you selected {Q1.shown}."
- **Equations**: A dedicated question type (`*`) that stores the result of a calculation in the DB.
    - Use cases: Scoring, complex logic aggregation.

### 6.2 Syntax & Variables
- **New Syntax**: Uses human-readable codes instead of SGQA.
    - `QCODE`: The value of the answer.
    - `QCODE.shown`: The displayed text.
    - `QCODE.NAOK`: "No Answer OK" (avoids errors if Q is hidden).
- **Functions**: standardized math/logic functions (`sum()`, `count()`, `if(test, true, false)`).

### 6.3 Developer Note
When analyzing survey logic issues, always check the `lime_questions.relevance` column. This contains the raw ES code that drives the survey flow.

## 7. Data Access & Reporting Strategy

For advanced applications within Quaeris (Filament 4), we adhere to a **Hybrid Access Pattern** to balance performance and fidelity.

**Architectural Decision:**

1.  **Reporting & Charts (Path A)**: Use **`SurveyFlipResponse`** (EAV / Flat Table).
    -   *Why*: Static SQL, Optimized for Aggregation (COUNT, AVG), Indexable.
    -   *Use for*: Dashboard Widgets, Trends, Big Data Analysis.

2.  **Management & Detail (Path B)**: Use **`SurveyResponse`** Model (Dynamic Table).
    -   *Why*: 100% Data Fidelity, Immediate Consistency, Logic Validation.
    -   *Use for*: Single Response Editing, "View Details" Modal, Export to external systems requiring raw format.

**PDF Strategy:**
We use **Spatie Laravel PDF** (Browsershot) as the standard engine.

**Key Resources:**
- [Database Schema Analysis](./database-schema-analysis.md) - **Technical Analysis of the Hybrid Pattern**.
- [Professional Charts & PDF Guide](./professional-charts-and-pdfs.md) - Detailed Reporting Guide.
- [Dashboard Best Practices](./dashboard-best-practices.md) - Layout & Performance.
- [Optimization Guide](./filament-charts-optimization.md) - SurveyFlip Aggregation.

### 7.1 PDF Strategy
We use **Spatie Browsershot** (Headless Chrome) to generate PDFs. This allows us to render full Chart.js visualizations vector-perfectly inside the PDF, which is impossible with traditional `dompdf`.

### 7.2 Chart Strategy

