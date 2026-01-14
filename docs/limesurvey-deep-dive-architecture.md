# LimeSurvey Deep Dive: Architecture and Integration Guide

**Created:** January 2026
**Version:** 5.4.x+
**Purpose:** Comprehensive technical reference for LimeSurvey integration

## Table of Contents

1. [LimeSurvey Overview](#limesurvey-overview)
2. [Core Architecture](#core-architecture)
3. [Database Schema Deep Dive](#database-schema-deep-dive)
4. [Question Types and Structure](#question-types-and-structure)
5. [API Integration](#api-integration)
6. [Response Management](#response-management)
7. [Integration Patterns in Quaeris](#integration-patterns-in-quaeris)

---

## LimeSurvey Overview

### What is LimeSurvey?

LimeSurvey is the world's #1 open-source survey platform, providing comprehensive questionnaire and survey management capabilities. It's a mature, enterprise-ready system with:

- **42,385+ commits** of development history
- **3,500+ GitHub stars**
- **80+ supported languages**
- **30+ question types**
- **900+ survey templates**

### Technology Stack

```
┌─────────────────────────────────────────────┐
│          Frontend Layer                     │
│  - JavaScript (41.4% of codebase)          │
│  - Vue.js components                        │
│  - React integration                        │
│  - CSS/SCSS styling                         │
├─────────────────────────────────────────────┤
│          Backend Layer                      │
│  - PHP (34.9% of codebase)                 │
│  - Yii Framework (legacy)                  │
│  - MySQL/PostgreSQL/MariaDB/MSSQL          │
├─────────────────────────────────────────────┤
│          Infrastructure                     │
│  - Plugin system                            │
│  - Theme engine                             │
│  - RemoteControl API (JSON-RPC/XML-RPC)    │
└─────────────────────────────────────────────┘
```

### Key Capabilities

1. **Survey Management**
   - Unlimited surveys and questions
   - Advanced question types (matrix, ranking, arrays)
   - Skip logic and conditional branching
   - Quota management

2. **Participant Management**
   - Central participant database
   - Token-based invitations
   - Anonymous and identified responses
   - Custom attributes

3. **Data Collection**
   - Multi-language support
   - Response validation
   - File uploads
   - Save and resume functionality

4. **Analysis & Reporting**
   - Statistical analysis
   - Data export (CSV, Excel, SPSS, R)
   - Assessment scoring
   - Custom reports

---

## Core Architecture

### Directory Structure

```
LimeSurvey/
├── application/          # Core application logic (MVC)
│   ├── models/          # Database models
│   ├── controllers/     # Request handlers
│   ├── views/           # Templates
│   └── helpers/         # Utility functions
├── admin/               # Administrative interface
│   ├── authentication/
│   ├── survey/
│   └── participants/
├── plugins/             # Extensible plugin system
│   ├── AuthCAS/
│   ├── ExportR/
│   └── ...
├── themes/              # Survey presentation themes
│   ├── survey/         # Survey themes
│   └── admin/          # Admin themes
├── editor/              # Vue-based survey editor
├── locale/              # 80+ language files
├── upload/              # User-uploaded files
└── tmp/                 # Temporary processing
```

### Request Flow

```
User Request
    ↓
Apache/Nginx (Web Server)
    ↓
index.php (Bootstrap)
    ↓
Yii Framework Router
    ↓
Controller (admin/survey)
    ↓
Model (Database Layer)
    ↓
View (Rendering)
    ↓
Response (HTML/JSON)
```

### Plugin Architecture

LimeSurvey uses an event-driven plugin system:

```php
// Plugin registers for events
class MyPlugin extends PluginBase
{
    public function init()
    {
        $this->subscribe('beforeSurveySettings');
        $this->subscribe('afterSurveyComplete');
    }

    public function beforeSurveySettings()
    {
        // Executed before survey settings are displayed
    }

    public function afterSurveyComplete()
    {
        // Executed after survey submission
    }
}
```

**Available Events:**
- `beforeSurveySettings`, `afterSurveyComplete`
- `beforeQuestionRender`, `afterQuestionRender`
- `beforeSurveyPage`, `afterSurveyPage`
- `newDirectRequest` (for custom pages)

---

## Database Schema Deep Dive

### Schema Overview (LimeSurvey 5.4.x+)

**Prefix:** `lime_` (configurable)
**Tables:** 60+ persistent tables
**Dynamic Tables:** One response table per active survey (`lime_survey_{sid}`)

### Core Table Hierarchy

```
lime_surveys (Master Survey Table)
    │
    ├── lime_surveys_languagesettings (Localized titles/descriptions)
    ├── lime_surveys_groups (Survey grouping)
    │
    ├── lime_groups (Question Groups)
    │   └── lime_group_l10ns (Localized group titles)
    │
    ├── lime_questions (Questions and Subquestions)
    │   ├── lime_question_l10ns (Localized question text)
    │   ├── lime_question_attributes (Type-specific settings)
    │   │
    │   ├── lime_answers (Answer Options)
    │   │   └── lime_answer_l10ns (Localized answers)
    │   │
    │   ├── lime_defaultvalues (Default values)
    │   │   └── lime_defaultvalue_l10ns (Localized defaults)
    │   │
    │   └── lime_conditions (Skip Logic)
    │
    ├── lime_quota (Response Limits)
    │   ├── lime_quota_languagesettings
    │   └── lime_quota_members
    │
    ├── lime_assessments (Scoring Rules)
    │
    └── lime_survey_{sid} (Response Data - Dynamic)
        └── lime_survey_{sid}_timings (Response Timing)
```

### Key Tables Reference

#### 1. `lime_surveys`

**Purpose:** Master survey configuration

**Key Columns:**
- `sid`: Survey ID (primary key)
- `admin`: Survey owner username
- `active`: Survey status ('Y' or 'N')
- `startdate`, `expires`: Survey lifecycle
- `format`: Question display format (G=group, S=single, A=all-on-one)
- `template`: Theme name
- `language`: Base language
- `allowsave`, `allowedit`: Response management flags
- `anonymized`: Anonymity level (Y/N/G)

#### 2. `lime_surveys_languagesettings`

**Purpose:** Localized survey content

**Key Columns:**
- `surveyls_survey_id`: FK to surveys
- `surveyls_language`: Language code (en, it, de)
- `surveyls_title`: Localized survey title
- `surveyls_description`: Survey description
- `surveyls_welcometext`: Welcome message
- `surveyls_endtext`: Thank you message
- `surveyls_email_*`: Email template fields

#### 3. `lime_questions`

**Purpose:** Questions and subquestions

**Key Columns:**
- `qid`: Question ID (primary key)
- `parent_qid`: Parent question ID (0 = root question, >0 = subquestion)
- `sid`: Survey ID
- `gid`: Group ID
- `type`: Question type (see [Question Types](#question-types-and-structure))
- `title`: Question code (used in field names)
- `question`: Question text (HTML allowed)
- `preg`: Validation regex
- `other`: Allow "Other" option (Y/N)
- `mandatory`: Required (Y/N)
- `question_order`: Display order within group
- `relevance`: Conditional display expression

#### 4. `lime_question_l10ns`

**Purpose:** Localized question text

**Key Columns:**
- `id`: Primary key
- `qid`: FK to questions
- `language`: Language code
- `question`: Localized question text
- `help`: Help text

#### 5. `lime_answers`

**Purpose:** Answer options for list questions

**Key Columns:**
- `aid`: Answer ID (primary key)
- `qid`: FK to questions
- `code`: Answer code (stored value)
- `sortorder`: Display order
- `assessment_value`: Score for assessments
- `scale_id`: For dual-scale questions (0 or 1)

#### 6. `lime_answer_l10ns`

**Purpose:** Localized answer text

**Key Columns:**
- `id`: Primary key
- `aid`: FK to answers
- `language`: Language code
- `answer`: Localized answer text

#### 7. `lime_participants`

**Purpose:** Central participant database

**Key Columns:**
- `participant_id`: UUID (primary key)
- `firstname`, `lastname`, `email`: Contact information
- `language`: Preferred language
- `blacklisted`: Opt-out status (Y/N)
- `owner_uid`: User who created the participant
- `created`: Registration date

#### 8. `lime_tokens_{sid}` (Dynamic)

**Purpose:** Survey-specific invitation tokens

**Key Columns:**
- `tid`: Token ID (primary key)
- `token`: Unique access token
- `participant_id`: FK to participants (nullable)
- `firstname`, `lastname`, `email`: Invitation recipient
- `emailstatus`: Invitation sent status
- `token_sent`: Last invitation timestamp
- `completed`: Survey completion timestamp
- `validfrom`, `validuntil`: Token validity period
- `attribute_*`: Custom attributes (configurable)

#### 9. `lime_survey_{sid}` (Dynamic)

**Purpose:** Response data for specific survey

**Structure:** Dynamically created when survey is activated

**Standard Columns:**
- `id`: Response ID (primary key)
- `submitdate`: Completion timestamp (NULL = incomplete)
- `lastpage`: Last visited page
- `startlanguage`: Interface language
- `token`: Token used (if token-based)
- `startdate`: Response start time
- `datestamp`: Last modification time
- `ipaddr`: IP address (if tracked)
- `refurl`: Referrer URL

**Dynamic Columns:** One column per question
- Format: `{sid}X{gid}X{qid}` (e.g., `39275X41X487`)
- Subquestions: `{sid}X{gid}X{qid}{sq_title}` (e.g., `39275X41X487SQ001`)
- Multiple choice: `{sid}X{gid}X{qid}[{code}]` (e.g., `39275X41X487[A]`)

#### 10. `lime_conditions`

**Purpose:** Skip logic and conditional display

**Key Columns:**
- `cid`: Condition ID (primary key)
- `qid`: Target question ID (question to show/hide)
- `cqid`: Condition question ID (question that triggers)
- `cfieldname`: Field name to check
- `method`: Comparison operator (==, <, >, !=, etc.)
- `value`: Comparison value
- `scenario`: Condition group (1 = default)

#### 11. `lime_quota`

**Purpose:** Response limits

**Key Columns:**
- `id`: Quota ID (primary key)
- `sid`: Survey ID
- `name`: Quota name
- `qlimit`: Response limit
- `action`: Action when reached (1=terminate, 2=continue)
- `active`: Quota status (1=active, 0=inactive)
- `autoload_url`: Redirect URL

#### 12. `lime_assessments`

**Purpose:** Survey scoring rules

**Key Columns:**
- `id`: Assessment ID (primary key)
- `sid`: Survey ID
- `scope`: Scope (T=total, G=group)
- `gid`: Group ID (if scope=G)
- `name`: Assessment name
- `minimum`: Minimum score threshold
- `maximum`: Maximum score threshold
- `message`: Result message (HTML)

### Database Relationships Diagram

```
surveys ─────────┬─────────> surveys_languagesettings
                 │
                 ├─────────> groups ─────────> group_l10ns
                 │               │
                 │               └─────────> questions ─┬─> question_l10ns
                 │                                       │
                 │                                       ├─> answers ─> answer_l10ns
                 │                                       │
                 │                                       ├─> question_attributes
                 │                                       │
                 │                                       ├─> conditions
                 │                                       │
                 │                                       └─> defaultvalues ─> defaultvalue_l10ns
                 │
                 ├─────────> quota ─────────┬─> quota_languagesettings
                 │                          │
                 │                          └─> quota_members
                 │
                 ├─────────> assessments
                 │
                 ├─────────> tokens_{sid} ──> participants ─┬─> participant_attribute_values
                 │                                           │
                 │                                           └─> participant_shares
                 │
                 └─────────> survey_{sid} (responses)
                                 │
                                 └─────────> survey_{sid}_timings
```

---

## Question Types and Structure

### Question Type Reference

LimeSurvey supports 30+ question types, categorized as follows:

#### **Single Entry Types**

| Code | Name | Description | Field Structure |
|------|------|-------------|-----------------|
| `5` | 5-Point Choice | Radio buttons 1-5 | Single column: INT(1-5) |
| `D` | Date | Date picker | Single column: DATETIME |
| `G` | Gender | Male/Female radio | Single column: VARCHAR (M/F) |
| `I` | Language Switch | Language selector | Single column: VARCHAR(20) |
| `L` | List (Radio) | Radio button list | Single column: VARCHAR (answer code) |
| `!` | List (Dropdown) | Dropdown list | Single column: VARCHAR (answer code) |
| `N` | Numerical Input | Number entry | Single column: DECIMAL |
| `S` | Short Free Text | Text input (max 255) | Single column: VARCHAR(255) |
| `T` | Long Free Text | Textarea | Single column: TEXT |
| `U` | Huge Free Text | Large textarea | Single column: LONGTEXT |
| `Y` | Yes/No | Binary choice | Single column: VARCHAR(1) Y/N |

#### **Multiple Entry Types**

| Code | Name | Description | Field Structure |
|------|------|-------------|-----------------|
| `M` | Multiple Choice | Checkboxes | Multiple columns: `{qid}[code]` = Y/N |
| `P` | Multiple Choice + Comments | Checkboxes with text | Multiple columns: `{qid}[code]` + `{qid}comment` |

#### **Array Types** (Matrix Questions)

| Code | Name | Description | Field Structure |
|------|------|-------------|-----------------|
| `A` | Array (5 Point) | Matrix with 1-5 scale | Multiple columns: `{qid}{sq_title}` = INT(1-5) |
| `B` | Array (10 Point) | Matrix with 1-10 scale | Multiple columns: `{qid}{sq_title}` = INT(1-10) |
| `C` | Array (Yes/No/Uncertain) | Matrix with Y/N/U | Multiple columns: `{qid}{sq_title}` = VARCHAR(1) |
| `E` | Array (Increase/Same/Decrease) | Matrix with +/=/- | Multiple columns: `{qid}{sq_title}` = VARCHAR(1) |
| `F` | Array (Flexible Labels) | Matrix with custom answers | Multiple columns: `{qid}{sq_title}` = VARCHAR |
| `H` | Array (Flexible Column) | Flexible matrix | Multiple columns: `{qid}_{sq_title}_{code}` |
| `K` | Multiple Numerical | Numerical array | Multiple columns: `{qid}{sq_title}` = DECIMAL |
| `;` | Array (Text) | Text array | Multiple columns: `{qid}_{sq_title}` = TEXT |
| `:` | Array (Numbers) | Numerical array (alternative) | Multiple columns: `{qid}_{sq_title}` = DECIMAL |

#### **Dual Scale Types**

| Code | Name | Description | Field Structure |
|------|------|-------------|-----------------|
| `1` | Array Dual Scale | Two rating scales per row | `{qid}{sq_title}#0` + `{qid}{sq_title}#1` |

#### **Ranking Types**

| Code | Name | Description | Field Structure |
|------|------|-------------|-----------------|
| `R` | Ranking | Drag-and-drop ranking | Multiple columns: `{qid}{rank}` = VARCHAR(code) |

#### **Specialized Types**

| Code | Name | Description | Field Structure |
|------|------|-------------|-----------------|
| `Q` | Multiple Short Text | Multiple text inputs | Multiple columns: `{qid}_{sq_title}` = VARCHAR(255) |
| `X` | Boilerplate | Display-only text | No column (no data stored) |
| `*` | Equation | JavaScript calculation | Single column: TEXT (result) |
| `\|` | File Upload | File upload field | Single column: TEXT (JSON metadata) |

### Question Structure Examples

#### Example 1: Simple List Question (Type `L`)

**Database Structure:**
```
lime_questions:
  qid: 487
  parent_qid: 0
  sid: 39275
  gid: 41
  type: 'L'
  title: 'satisfaction'
  question: 'How satisfied are you?'

lime_answers:
  aid=1, qid=487, code='1', sortorder=1
  aid=2, qid=487, code='2', sortorder=2
  aid=3, qid=487, code='3', sortorder=3

lime_answer_l10ns:
  aid=1, language='en', answer='Very Satisfied'
  aid=2, language='en', answer='Satisfied'
  aid=3, language='en', answer='Neutral'

lime_survey_39275 (response table):
  Column: 39275X41X487 VARCHAR(5)
  Stored value: '1' or '2' or '3' (answer code)
```

#### Example 2: Multiple Choice Question (Type `M`)

**Database Structure:**
```
lime_questions:
  qid: 488
  parent_qid: 0
  type: 'M'
  title: 'features'
  question: 'Which features do you use?'

lime_answers:
  aid=1, qid=488, code='A', sortorder=1
  aid=2, qid=488, code='B', sortorder=2
  aid=3, qid=488, code='C', sortorder=3

lime_answer_l10ns:
  aid=1, answer='Feature A'
  aid=2, answer='Feature B'
  aid=3, answer='Feature C'

lime_survey_39275 (response table):
  Column: 39275X41X488[A] VARCHAR(1)  → 'Y' or NULL
  Column: 39275X41X488[B] VARCHAR(1)  → 'Y' or NULL
  Column: 39275X41X488[C] VARCHAR(1)  → 'Y' or NULL
  Column: 39275X41X488other VARCHAR(255)  → Free text (if 'other' enabled)
```

#### Example 3: Array Question (Type `F`)

**Database Structure:**
```
lime_questions:
  qid: 489
  parent_qid: 0
  type: 'F'
  title: 'quality_matrix'
  question: 'Rate these aspects:'

  qid: 490, parent_qid: 489, title: 'SQ001', question: 'Product Quality'
  qid: 491, parent_qid: 489, title: 'SQ002', question: 'Service Quality'
  qid: 492, parent_qid: 489, title: 'SQ003', question: 'Value for Money'

lime_answers:
  aid=1, qid=489, code='1', answer='Poor'
  aid=2, qid=489, code='2', answer='Fair'
  aid=3, qid=489, code='3', answer='Good'
  aid=4, qid=489, code='4', answer='Excellent'

lime_survey_39275 (response table):
  Column: 39275X41X489SQ001 VARCHAR(5)  → '1', '2', '3', or '4'
  Column: 39275X41X489SQ002 VARCHAR(5)  → '1', '2', '3', or '4'
  Column: 39275X41X489SQ003 VARCHAR(5)  → '1', '2', '3', or '4'
```

### Accessing Question Data

**In Quaeris Integration:**

```php
use Modules\Limesurvey\Models\LimeQuestion;
use Modules\Limesurvey\Models\SurveyResponse;

// Get question with localized text
$question = LimeQuestion::with(['l10ns', 'answers.l10ns'])
    ->where('qid', 487)
    ->first();

// Access localized question text
$questionText = $question->l10ns
    ->where('language', 'en')
    ->first()
    ->question;

// Get responses for this question
$responses = SurveyResponse::getResponsesForSurvey('39275')
    ->withAnswersLabel(487, '39275X41X487')
    ->get();

// Access answer label
foreach ($responses as $response) {
    $answerCode = $response->{'39275X41X487'};  // e.g., '1'
    $answerLabel = $response->{'39275X41X487_label'};  // e.g., 'Very Satisfied'
}
```

---

## API Integration

### RemoteControl API

LimeSurvey provides a comprehensive RPC API for external integration.

#### **Protocols Supported:**
- JSON-RPC (recommended)
- XML-RPC (legacy)

#### **API Endpoint:**
```
https://your-limesurvey.com/admin/remotecontrol
```

#### **Authentication Flow:**

```php
// 1. Get session key
$client = new JsonRpc('https://limesurvey.example.com/admin/remotecontrol');

$sessionKey = $client->call('get_session_key', [
    'username' => 'admin',
    'password' => 'password'
]);

// 2. Make API calls
$surveys = $client->call('list_surveys', [$sessionKey, 'admin']);

// 3. Release session
$client->call('release_session_key', [$sessionKey]);
```

#### **Key API Methods:**

**Survey Management:**
- `list_surveys(sessionKey, username)`: List all surveys
- `get_survey_properties(sessionKey, surveyId, properties)`: Get survey details
- `add_survey(sessionKey, surveyId, title, language, format)`: Create survey
- `delete_survey(sessionKey, surveyId)`: Delete survey
- `activate_survey(sessionKey, surveyId)`: Activate survey
- `export_statistics(sessionKey, surveyId, format)`: Export results

**Question Management:**
- `list_questions(sessionKey, surveyId, groupId, language)`: List questions
- `get_question_properties(sessionKey, questionId, properties, language)`: Question details
- `add_question(sessionKey, surveyId, questionData)`: Add question

**Participant Management:**
- `add_participants(sessionKey, surveyId, participantData, createTokens)`: Add participants
- `delete_participants(sessionKey, surveyId, tokenIds)`: Remove participants
- `get_participant_properties(sessionKey, surveyId, tokenQueryProperties)`: Get details
- `invite_participants(sessionKey, surveyId)`: Send invitations

**Response Management:**
- `export_responses(sessionKey, surveyId, format, language, completionStatus)`: Export responses
- `get_responses_by_token(sessionKey, surveyId, token)`: Get response
- `add_response(sessionKey, surveyId, responseData)`: Submit response

### REST API (New)

LimeSurvey also offers a REST API in recent versions:

```
GET    /api/v1/surveys
GET    /api/v1/surveys/{sid}
POST   /api/v1/surveys
DELETE /api/v1/surveys/{sid}

GET    /api/v1/surveys/{sid}/questions
POST   /api/v1/surveys/{sid}/questions

GET    /api/v1/surveys/{sid}/responses
POST   /api/v1/surveys/{sid}/responses
```

**Authentication:** Bearer token or API key

---

## Response Management

### Response Lifecycle

```
1. Survey Created (Inactive)
   ↓
2. Survey Activated → lime_survey_{sid} table created
   ↓
3. Token Generated (optional) → lime_tokens_{sid} entry
   ↓
4. User Accesses Survey
   ↓
5. Response Initiated → lime_survey_{sid} row (submitdate = NULL)
   ↓
6. User Fills Questions → Columns updated with answers
   ↓
7. User Submits → submitdate set to NOW()
   ↓
8. Response Complete
```

### Response States

**Incomplete Response:**
- `submitdate = NULL`
- `lastpage` tracks progress
- User can resume if `allowsave=Y`

**Complete Response:**
- `submitdate = '2026-01-14 10:30:00'`
- All mandatory questions answered
- Cannot be edited unless `allowedit=Y`

**Partial Response (Save & Resume):**
- User saves progress
- Receives resume token
- Can return via saved token

### Querying Responses

#### **Basic Query:**
```php
use Modules\Limesurvey\Models\SurveyResponse;

// Get all completed responses
$responses = SurveyResponse::getResponsesForSurvey('39275')
    ->whereNotNull('submitdate')
    ->get();
```

#### **With Participant Data:**
```php
$responses = SurveyResponse::getResponsesForSurvey('39275')
    ->withParticipants()  // Joins lime_tokens_{sid}
    ->get();

// Access participant email
foreach ($responses as $response) {
    echo $response->participant_email;
}
```

#### **With Answer Labels:**
```php
$responses = SurveyResponse::getResponsesForSurvey('39275')
    ->withAnswersLabel(487, '39275X41X487', 'answer', 'join')
    ->get();

foreach ($responses as $response) {
    echo $response->{'39275X41X487'};        // Answer code: '1'
    echo $response->answer_label;             // Answer text: 'Very Satisfied'
}
```

#### **With All Answers Translated:**
```php
$responses = SurveyResponse::getResponsesForSurvey('39275')
    ->withAllAnswers('subquery')
    ->get();

// All answer codes are joined with their labels
```

#### **Filtered by Date:**
```php
use Modules\Quaeris\Datas\DashboardFilterData;

$filterData = DashboardFilterData::from([
    'startDate' => '2026-01-01',
    'endDate' => '2026-01-31',
]);

$responses = SurveyResponse::getResponsesForSurvey('39275')
    ->ofDashboardFilterData($filterData)
    ->get();
```

---

## Integration Patterns in Quaeris

### Pattern 1: Survey Selection

**Quaeris Model:** `SurveyPdf`

**Purpose:** Associates a LimeSurvey with reporting configuration

```php
use Modules\Quaeris\Models\SurveyPdf;

$surveyPdf = SurveyPdf::create([
    'survey_id' => '39275',  // LimeSurvey SID
    'name' => 'Q1 2026 Customer Satisfaction',
    'customer_id' => 1,
]);

// Access LimeSurvey info
$limeSurvey = $surveyPdf->info;  // Returns LimeSurvey model
$title = $surveyPdf->surveylsTitle();  // Localized survey title
```

### Pattern 2: Question Charts

**Quaeris Model:** `QuestionChart`

**Purpose:** Maps LimeSurvey questions to chart visualizations

```php
use Modules\Quaeris\Models\QuestionChart;

$questionChart = QuestionChart::create([
    'survey_pdf_id' => $surveyPdf->id,
    'survey_id' => '39275',
    'question' => 487,  // LimeSurvey QID
    'field_name' => '39275X41X487',
    'question_type' => 'L',
    'chart_type' => 'pie1',
    'show_on_pdf' => 1,
]);

// Generate chart from responses
$responses = SurveyResponse::getResponsesForSurvey($questionChart->survey_id)
    ->withAnswersLabel($questionChart->question, $questionChart->field_name)
    ->get();

$chartData = $this->aggregateResponses($responses);
```

### Pattern 3: Response Aggregation

```php
use Modules\Quaeris\Actions\QuestionChart\GetAnswersCount;

$answersFilter = AnswersFilterData::from([
    'survey_pdf_id' => $surveyPdf->id,
    'date_from' => '2026-01-01',
    'date_to' => '2026-01-31',
]);

$totalAnswers = app(GetAnswersCount::class)->execute(
    $questionChart,
    $answersFilter
);

// Returns count of responses matching filters
```

### Pattern 4: PDF Generation with Data

```php
use Modules\Quaeris\Actions\SurveyPdf\MakePdf2Action;

$pdf = app(MakePdf2Action::class)->execute($surveyPdf, $answersFilter);

// Internally:
// 1. Fetches responses with filters
// 2. Generates charts from QuestionCharts
// 3. Renders Blade template
// 4. Converts HTML to PDF via Spipu\Html2Pdf
// 5. Returns downloadable PDF
```

---

## Best Practices

### 1. Always Use Scopes

**✅ CORRECT:**
```php
SurveyResponse::getResponsesForSurvey($surveyId)
    ->withParticipants()
    ->whereNotNull('submitdate')
    ->get();
```

**❌ WRONG:**
```php
// Direct table access bypasses connection discovery
DB::table('lime_survey_'.$surveyId)->get();
```

### 2. Use Eager Loading

```php
// Eager load related data
$question = LimeQuestion::with(['l10ns', 'answers.l10ns', 'group.l10ns'])
    ->find($qid);
```

### 3. Cache Survey Structures

```php
$questions = Cache::remember("survey_{$sid}_questions", 3600, function () use ($sid) {
    return LimeSurvey::with('questions.l10ns')->find($sid);
});
```

### 4. Handle Dynamic Field Names

```php
// Dynamic field names require careful handling
$fieldName = "{$sid}X{$gid}X{$qid}";

// Use getAttribute() for safety
$value = $response->getAttribute($fieldName);

// Or array access
$value = $response[$fieldName];
```

### 5. Validate Question Types

```php
// Different question types need different handling
switch ($question->type) {
    case 'L':  // List - single value
    case '!':  // Dropdown - single value
        $value = $response->{$fieldName};
        break;

    case 'M':  // Multiple choice - multiple columns
        foreach ($answers as $answer) {
            $colName = "{$fieldName}[{$answer->code}]";
            $checked = $response->{$colName} === 'Y';
        }
        break;

    case 'F':  // Array - subquestions
        foreach ($subquestions as $sq) {
            $colName = "{$fieldName}{$sq->title}";
            $value = $response->{$colName};
        }
        break;
}
```

---

## Reference Links

### Official Documentation
- **LimeSurvey Manual:** https://manual.limesurvey.org
- **Database Schema (5.4.x):** https://www.limesurvey.org/manual/limesurvey/LimeSurvey-5.x-database-schema.html
- **RemoteControl API:** https://manual.limesurvey.org/RemoteControl_2_API
- **Question Types:** https://manual.limesurvey.org/Question_types

### GitHub Repository
- **Main Repository:** https://github.com/LimeSurvey/LimeSurvey
- **Issues:** https://github.com/LimeSurvey/LimeSurvey/issues
- **Releases:** https://github.com/LimeSurvey/LimeSurvey/releases

### Community
- **Forums:** https://forums.limesurvey.org
- **Website:** https://www.limesurvey.org

### Related Internal Documentation
- [Database Schema Details](./database-schema.md)
- [API Integration Examples](./api-integration.md)
- [Quaeris Integration Patterns](../Quaeris/docs/database-limesurvey-usage.md)

---

**Version:** 1.0
**Last Updated:** January 14, 2026
**Maintained By:** Quaeris Development Team
