# LimeSurvey Database Schema

## Static Tables (Metadata)

### lime_surveys
The main survey configuration table containing all survey settings and properties.

| Column | Type | Description |
|--------|------|-------------|
| `sid` | int | Primary key, unique survey identifier |
| `owner_id` | int | Creator of the survey |
| `admin` | varchar | Administrator name |
| `active` | char(1) | 'Y' if active, 'N' if inactive |
| `expires` | datetime | Survey expiration date |
| `startdate` | datetime | Survey start date |
| `adminemail` | varchar | Administrator email |
| `anonymized` | char(1) | 'Y' if responses are anonymized |
| `format` | varchar | Survey format (A, G, S) |
| `template` | varchar | Template name |
| `language` | varchar | Base language |
| `additional_languages` | varchar | Comma-separated list of additional languages |
| `datestamp` | char(1) | 'Y' if date stamping is enabled |
| `usecookie` | char(1) | 'Y' if cookie control is enabled |
| `allowregister` | char(1) | 'Y' if registration is allowed |
| `allowsave` | char(1) | 'Y' if saving and continuing later is allowed |

### lime_groups
Represents question groups (pages) within a survey.

| Column | Type | Description |
|--------|------|-------------|
| `gid` | int | Primary key, unique group identifier |
| `sid` | int | Foreign key to lime_surveys |
| `group_order` | int | Order of the group within the survey |
| `title` | varchar | Group title |
| `description` | text | Group description |
| `language` | varchar | Language code |

### lime_questions
Contains individual questions within the survey structure.

| Column | Type | Description |
|--------|------|-------------|
| `qid` | int | Primary key, unique question identifier |
| `parent_qid` | int | For sub-questions, references parent question |
| `sid` | int | Foreign key to lime_surveys |
| `gid` | int | Foreign key to lime_groups |
| `type` | varchar | Question type code (A, B, C, D, etc.) |
| `title` | varchar | Unique question identifier within survey |
| `question` | text | Question text |
| `help` | text | Question help text |
| `other` | char(1) | 'Y' if "Other" option is available |
| `mandatory` | char(1) | 'Y' if question is mandatory |
| `question_order` | int | Order of question within group |
| `scale_id` | int | For dual-scale questions (0=primary, 1=secondary) |
| `relevance` | text | Expression determining question visibility |

### lime_answers
Predefined answers for closed-ended questions.

| Column | Type | Description |
|--------|------|-------------|
| `aid` | int | Primary key, unique answer identifier |
| `qid` | int | Foreign key to lime_questions |
| `code` | varchar | Answer code |
| `answer` | text | Answer text |
| `sortorder` | int | Display order |
| `language` | varchar | Language code |
| `assessment_value` | int | Value for assessment scoring |

## Localization Tables

### lime_survey_l10ns
Localized survey information.

| Column | Type | Description |
|--------|------|-------------|
| `surveyls_survey_id` | int | Foreign key to lime_surveys |
| `surveyls_language` | varchar | Language code |
| `surveyls_title` | varchar | Localized survey title |
| `surveyls_description` | text | Localized survey description |

### lime_group_l10ns
Localized group information.

| Column | Type | Description |
|--------|------|-------------|
| `groupl10ns_gid` | int | Foreign key to lime_groups |
| `language` | varchar | Language code |
| `group_name` | varchar | Localized group name |
| `description` | text | Localized group description |

### lime_question_l10ns
Localized question information.

| Column | Type | Description |
|--------|------|-------------|
| `qid` | int | Foreign key to lime_questions |
| `language` | varchar | Language code |
| `question` | text | Localized question text |
| `help` | text | Localized question help |

### lime_answer_l10ns
Localized answer information.

| Column | Type | Description |
|--------|------|-------------|
| `aid` | int | Foreign key to lime_answers |
| `language` | varchar | Language code |
| `answer` | text | Localized answer text |

## Dynamic Tables (Per Survey)

### lime_survey_{SID}
Created dynamically when a survey is activated. Contains responses for that specific survey.

| Column | Type | Description |
|--------|------|-------------|
| `id` | int | Primary key, response identifier |
| `submitdate` | datetime | Date/time when survey was submitted |
| `lastpage` | int | Last page visited by respondent |
| `startlanguage` | varchar | Language used when starting the survey |
| `token` | varchar | Participant token (if tokens enabled) |
| `{SID}X{GID}X{QID}` | various | Response for specific question |
| `{SID}X{GID}X{QID}_SQ001` | various | Response for sub-question |
| `{SID}X{GID}X{QID}_other` | text | "Other" text response |

### lime_tokens_{SID}
Participant management table, created when tokens are enabled for a survey.

| Column | Type | Description |
|--------|------|-------------|
| `tid` | int | Primary key, token identifier |
| `tid_hex` | varchar | Hexadecimal token identifier |
| `token` | varchar | Token string |
| `sent` | varchar | Status of invitation sent ("Y", "N", "C") |
| `completed` | varchar | Completion status ("Y" or empty) |
| `email` | varchar | Participant email |
| `firstname` | varchar | First name |
| `lastname` | varchar | Last name |
| `attribute_{N}` | varchar | Custom attributes |

## Our Integration Tables

### survey_flip_responses
EAV (Entity-Attribute-Value) representation of LimeSurvey responses.

| Column | Type | Description |
|--------|------|-------------|
| `id` | int | Primary key |
| `survey_id` | string | Original survey ID |
| `question_id` | string | Original question ID |
| `question_type` | string | Question type |
| `token` | string | Participant token |
| `answer` | string | Raw answer from LimeSurvey column |
| `value` | string | Processed value (often from answer labels) |
| `submitdate` | datetime | Submission date |
| `fieldname` | string | Original LimeSurvey fieldname (e.g., 123X12X88) |
| `old_id` | string | Original response ID from lime_survey_{SID} |
| `feedback` | string | Associated feedback text |