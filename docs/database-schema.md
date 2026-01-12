# Database Schema Analysis: Quaeris Survey (Limesurvey)

## Overview
The `Modules/Limesurvey` module interacts with the `quaeris_survey` database (configured via the `limesurvey` connection). This database follows the standard Limesurvey 3.x/5.x schema.

## Core Table Structure

### 1. Surveys (`lime_surveys`)
The central entity defining properties of a survey.
- **Primary Key**: `sid` (int)
- **owner_id** (int): FK to `lime_users.uid`
- **active** (char 1): 'Y'/'N' - Is the survey currently active?
- **expires** (datetime): Expiration timestamp.
- **admin**, **adminemail**: Contact details.
- **anonymized** (char 1): 'Y'/'N' - Are responses anonymous?
- **format** (char 1): 'G' (Group-by-Group), 'Q' (Question-by-Question), 'A' (All-in-one).
- **template** (varchar 100): Theme name.
- **language** (varchar 50): Base language (e.g., 'it', 'en').
- **additional_languages** (text): Space-separated list of other languages.
- **tokenlength** (int): Default 15.

### 2. Groups (`lime_groups`)
Logical grouping of questions (pages in 'Group-by-Group' mode).
- **Primary Key**: `gid` (int)
- **sid** (int): FK to `lime_surveys.sid`
- **group_order** (int): Positioning order.
- **randomization_group** (varchar 20): For shuffling groups.

### 3. Questions (`lime_questions`)
The questions within the survey.
- **Primary Key**: `qid` (int)
- **parent_qid** (int): 0 for main questions. For subquestions (e.g., in Array types), this points to the parent `qid`.
- **sid** (int): FK to `lime_surveys.sid`
- **gid** (int): FK to `lime_groups.gid`
- **type** (varchar 30): Question Type Code (e.g., 'T' = Text, 'M' = Multiple Choice, 'L' = List, '5' = 5 Point Choice).
- **title** (varchar 20): The "Code" of the question (e.g., 'Q1', 'demographics').
- **question_order** (int): Positioning order.
- **mandatory** (char 1): 'Y'/'N'.
- **other** (char 1): 'Y'/'N' - Does it have an "Other" option?
- **relevance** (text): Expression Manager logic for visibility (e.g., `((Q1.NAOK == "Y"))`).

### 4. Answers (`lime_answers`)
Predefined answer options for closed questions (List, Multiple Choice).
- **Primary Key**: `aid` (int)
- **qid** (int): FK to `lime_questions.qid`
- **code** (varchar 5): The stored value (e.g., 'A1', '1', 'Y').
- **sortorder** (int): Display order.
- **assessment_value** (int): For scoring.

## key Relationships
- `Survey` (1) -> (N) `Group` (on `sid`)
- `Group` (1) -> (N) `Question` (on `gid`)
- `Question` (1) -> (N) `Answer` (on `qid`)
- `Question` (1) -> (N) `Question` (Subquestions, on `parent_qid`)

## 5. Translations (Localization)
Limesurvey 3.x+ separates text content into dedicated `_l10ns` tables to support multilingual surveys.

### Questions L10n (`lime_question_l10ns`)
- **id** (int): PK
- **qid** (int): FK to `lime_questions.qid`
- **question** (mediumtext): The actual question text.
- **help** (mediumtext): Help text.
- **language** (varchar 20): Language code (e.g., 'it', 'en').

### Groups L10n (`lime_group_l10ns`)
- **id** (int): PK
- **gid** (int): FK to `lime_groups.gid`
- **group_name** (text): Title of the group.
- **description** (mediumtext): Group description.
- **language** (varchar 20): Language code.

### Answers L10n (`lime_answer_l10ns`)
- **id** (int): PK
- **aid** (int): FK to `lime_answers.aid`
- **answer** (mediumtext): The answer text/label.
- **language** (varchar 20): Language code.

## Dynamic Tables
- **`lime_survey_{SID}`**: Stores responses.
    - Columns: `{SID}X{GID}X{QID}` (e.g., `123X4X5`).
    - Subquestions: `{SID}X{GID}X{QID}_{SQID}`.
- **`lime_tokens_{SID}`**: Participants table.

