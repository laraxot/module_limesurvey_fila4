# LimeSurvey Database Schema Analysis & Hybrid Strategy

> **Status**: Verified against `quaeris_survey` database.
> **Standard**: Hybrid Access Pattern (2026).

## 1. The Core Duality
LimeSurvey's architecture presents a challenge:
1.  **Metadata is Static**: Tables like `lime_surveys`, `lime_questions` are stable.
2.  **Data is Dynamic**: Responses are stored in `lime_survey_{SID}` tables created at runtime.

### 1.1 The "Dynamic Table" Problem (`lime_survey_{SID}`)
- **Structure**: One column per Question/Subquestion.
- **Naming**: `SID X GID X QID` (e.g., `982763X1165X34197001`).
- **Pros**: Fast for single-row inserts/reads. 100% data fidelity.
- **Cons**: Impossible to query cleanly for aggregate reports (e.g., "Average of Q1 across all years"). Column names change if questions move.

### 1.2 The "SurveyFlip" Solution (`survey_flip_responses`)
- **Structure**: EAV (Entity-Attribute-Value).
- **Schema**:
    - `survey_id`: Link to Survey.
    - `question_id`: Link to Question.
    - `token`: Link to Participant.
    - `value`: The actual answer.
    - `fieldname`: Original column name reference.
- **Pros**: Static SQL for Reports. Indexable. Great for Charts.
- **Cons**: Write-heavy synchronization needed.

---

## 2. Hybrid Access Strategy (The Standard)

We use a **Dual-Path Architecture** to get the best of both worlds.

| Feature | Path A: Direct Dynamic Access | Path B: SurveyFlip (ETL) |
| :--- | :--- | :--- |
| **Model** | `Modules\Limesurvey\Models\SurveyResponse` | `Modules\Limesurvey\Models\SurveyFlipResponse` |
| **Table** | `lime_survey_{SID}` (Dynamic) | `survey_flip_responses` (Static) |
| **Use Case** | **Management & Detail View** | **Reporting & Charts** |
| **Scenario** | Editing a single response, Logic checks | aggregated Dashboards, Trends |
| **Fidelity** | 100% (Raw Data) | 99% (Normalized Data) |
| **Speed** | Fast (Single Row) | Fast (Aggregates) |

### 2.1 Implementation: Dynamic Access
Used when you need to view or edit a specific response in full detail.

```php
// Define the table at runtime
$response = new SurveyResponse();
$response->setTableForSurvey($surveyId);

// Find a specific response
$data = $response->where('token', $token)->first();
// Access via dynamic property
echo $data->{'982763X1165X34197001'};
```

### 2.2 Implementation: Reporting Access
Used when rendering Filament Charts or PDFs.

```php
// Aggregate without worrying about column names
$count = SurveyFlipResponse::query()
    ->where('survey_id', $surveyId)
    ->where('question_id', $questionCode) // e.g., 'Q1'
    ->where('value', 'Yes')
    ->count();
```

---

## 3. Schema Reference

### 3.1 `lime_questions` (Metadata)
| Column | Type | Description |
| :--- | :--- | :--- |
| `qid` | int | Primary Key |
| `sid` | int | Survey ID |
| `gid` | int | Group ID |
| `type` | char(1) | Question Type (L=List, M=Multiple, etc) |
| `title` | varchar | Code (e.g., "Q1") |
| `question` | text | The Question Text |

### 3.2 `survey_flip_responses` (The Reporting Truth)
| Column | Type | Key | Description |
| :--- | :--- | :--- | :--- |
| `id` | bigint | PK | Unique ID |
| `survey_id` | varchar | MUL | Survey ID |
| `question_id` | varchar | MUL | Question Code (not QID!) |
| `token` | varchar | MUL | Participant Token |
| `value` | varchar | | The Answer |
| `submitdate` | datetime | | When it happened |

> **Optimization Note**: Ensure composite index on `(survey_id, question_id, value)` for chart performance.
