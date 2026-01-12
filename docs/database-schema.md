# Database Schema Analysis: Quaeris Survey (Limesurvey)

## Overview
The `Modules/Limesurvey` module interacts with the `quaeris_survey` database (configured via the `limesurvey` connection in Laravel). This database is a standard Limesurvey installation.

## Connection Details
- **Database Name**: `quaeris_survey`
- **Connection Name**: `limesurvey` (defined in `config/database.php` and `.env`)
- **Table Prefix**: `lime_`

## Table Structure
The database consists of over 300 tables, categorized into:

### 1. Core Tables
Static tables defining the survey structure and system configuration. Models are located in `Modules/Limesurvey/app/Models`.
- **Surveys**: `lime_surveys` (Model: `Survey`) - Central entity.
- **Groups**: `lime_groups` (Model: `Group`) - Question groups within a survey.
- **Questions**: `lime_questions` (Model: `Question`) - Questions linked to groups and surveys.
- **Answers**: `lime_answers` (Model: `Answer`) - Predefined answers for closed questions.
- **Conditions**: `lime_conditions` (Model: `Condition`) - Logic for question visibility.
- **Users**: `lime_users` (Model: `User`) - Limesurvey administrators/users.

### 2. Dynamic Tables
Tables created dynamically for each active survey.
- **Responses**: `lime_survey_{SID}` - Stores participant responses. Columns correspond to Question IDs (e.g., `{SID}X{GID}X{QID}`).
- **Tokens**: `lime_tokens_{SID}` - Stores participant tokens/invitations for restricted surveys.
- **Timings**: `lime_survey_{SID}_timings` - Response timing data.

### 3. System Tables
- `lime_settings_global`
- `lime_plugins`
- `lime_permissions`

## Data Model & Relationships
- **Survey** `hasMany` **Groups** (`sid` -> `sid`)
- **Group** `hasMany` **Questions** (`gid` -> `gid`)
- **Question** `hasMany` **Answers** (`qid` -> `qid`)
- **Question** `hasMany` **SubQuestions** (Self-referencing via `parent_qid`)

## Integration with Quaeris
The `Modules/Quaeris` module analyzes data from this database.
- **Widgets**: Uses `Modules\Quaeris\Models\QuestionChart` to map a chart to a specific Limesurvey Question (`parent_qid` or `question` ID).
- **Data Retrieval**: Uses `SurveyResponse` model (which dynamically maps to `lime_survey_{SID}`) to fetch analytics data.
