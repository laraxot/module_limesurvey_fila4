# LimeSurvey Architecture Overview

## System Integration Pattern

LimeSurvey is a robust, open-source survey platform built on the Yii PHP framework. The integration between LimeSurvey and our Quaeris system follows a **Database-Centric Integration** pattern, where we directly access LimeSurvey's database tables to extract and transform survey data.

### Core Architecture Components

#### 1. Static Metadata Tables
LimeSurvey maintains permanent tables for survey structure and configuration:

| Table | Purpose | Key Column |
|-------|---------|------------|
| `lime_surveys` | Survey configuration, status, properties | `sid` (Survey ID) |
| `lime_groups` | Question groups/pages within surveys | `gid` (Group ID) |
| `lime_questions` | Question definitions, types, logic | `qid` (Question ID) |
| `lime_answers` | Predefined answers for closed questions | `aid` (Answer ID) |
| `lime_users` | Administrator accounts | `uid` (User ID) |

#### 2. Dynamic Response Tables
When a survey is activated, LimeSurvey creates a dedicated table: `lime_survey_{SID}`

**Structure**:
- `id`: Response identifier (Primary Key)
- `submitdate`: Timestamp of survey completion
- `lastpage`: Progress tracking
- `startlanguage`: Language used for the survey
- **Dynamic Columns**: Following the naming convention `{SID}X{GID}X{QID}`
  - Example: `1234X12X88` (Survey 1234, Group 12, Question 88)
  - Subquestions: `1234X12X88_SQ001`
  - Comments: `1234X12X88_other`

### Localization (L10n) Strategy
Since LimeSurvey 3.x, translations are normalized into separate localization tables:

- `lime_survey_l10ns`
- `lime_group_l10ns` 
- `lime_question_l10ns`
- `lime_answer_l10ns`

**Important**: Always join with the appropriate L10n table to get actual text content in the specific language.

### Integration Architecture

#### 1. Direct Database Access
- Uses Laravel's `DB::table()` to access LimeSurvey tables directly
- Bypasses LimeSurvey's application layer for performance
- Requires knowledge of LimeSurvey's internal table structure

#### 2. Survey Flip Strategy
Due to the dynamic and "wide" nature of `lime_survey_{SID}` tables, we implement the Survey Flip pattern:

**Process**:
1. **Extract**: Read from `lime_survey_{SID}` via `DB::table()`
2. **Transform**: Map column codes (`123X12X88`) to meaningful question definitions
3. **Load**: Insert into static `survey_flip_responses` table (EAV pattern)

**Benefits**:
- Eloquent compatibility for relationships
- Simplified querying for analytics
- Consistent schema across all surveys

#### 3. Model Structure

- `LimeSurvey`: Represents `lime_surveys` table
- `LimeGroup`: Represents `lime_groups` table
- `LimeQuestion`: Represents `lime_questions` table with adjacency list for hierarchical questions
- `LimeAnswer`: Represents `lime_answers` table
- `SurveyResponse`: Dynamic access to `lime_survey_{SID}` tables
- `SurveyFlipResponse`: EAV representation of survey responses

## Technical Integration Points

### Authentication & Authorization
- Direct database access (no authentication needed for this layer)
- LimeSurvey handles its own admin authentication
- Token-based participant access via `lime_tokens_{SID}` tables

### Data Flow
```mermaid
graph LR
    A[LimeSurvey Admin Creates Survey] --> B[LimeSurvey Creates lime_survey_{SID}]
    B --> C[Participants Complete Surveys]
    C --> D[Survey Data in lime_survey_{SID}]
    D --> E[PopulateSurveyFlipBySurveyIdAction]
    E --> F[Transform to SurveyFlipResponse EAV]
    F --> G[Quaeris Analytics & Dashboards]
```

### Performance Characteristics
- Direct database access provides low-latency reads
- Dynamic table structures require careful indexing
- SurveyFlip reduces query complexity for analytics
- Caching strategies needed for metadata tables