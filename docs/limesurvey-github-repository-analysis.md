# LimeSurvey GitHub Repository Analysis

## Repository Overview

**Repository URL**: https://github.com/LimeSurvey/LimeSurvey

LimeSurvey is an open-source survey application written in PHP, using the Yii framework. This document provides a comprehensive analysis of the repository structure, architecture patterns, and key components.

## Repository Structure

```
LimeSurvey/
├── application/           # Main application code (Yii MVC)
│   ├── commands/          # Console commands
│   ├── config/            # Configuration files
│   ├── controllers/       # MVC Controllers
│   ├── core/              # Core framework extensions
│   ├── extensions/        # Yii extensions
│   ├── helpers/           # Helper functions
│   ├── libraries/         # Custom libraries
│   ├── models/            # Data models
│   ├── third_party/       # Third-party libraries
│   └── views/             # View templates
├── assets/                # Static assets (CSS, JS, images)
├── installer/             # Installation wizard
├── locale/                # Translation files
├── plugins/               # Plugin system
├── themes/                # Survey themes
├── tmp/                   # Temporary files
└── upload/                # Uploaded files
```

## Core Architecture Patterns

### 1. MVC Pattern (Yii Framework)
LimeSurvey follows the Model-View-Controller pattern:

- **Models**: Data access and business logic
- **Views**: Template rendering with Twig
- **Controllers**: Request handling and routing

### 2. Key Models

#### Survey Model
```php
// application/models/Survey.php
class Survey extends LSActiveRecord
{
    // Primary key
    public $sid;           // Survey ID (unique identifier)
    public $owner_id;      // User who created the survey
    public $gsid;          // Survey group ID
    public $active;        // Y/N flag for activation status
    public $expires;       // Expiration datetime
    public $startdate;     // Start datetime
    public $anonymized;    // Y/N for anonymous responses
    public $format;        // Survey format (A=All, G=Group, S=Single)
    public $language;      // Base language
    public $template;      // Theme name

    // Relations
    public function groups() { }      // Question groups
    public function questions() { }   // Survey questions
    public function responses() { }   // Survey responses
    public function tokens() { }      // Participant tokens
}
```

#### Question Model
```php
// application/models/Question.php
class Question extends LSActiveRecord
{
    public $qid;           // Question ID
    public $parent_qid;    // Parent question (for subquestions)
    public $sid;           // Survey ID
    public $gid;           // Group ID
    public $type;          // Question type code
    public $title;         // Short name/code
    public $question;      // Question text
    public $mandatory;     // Y/N for required
    public $relevance;     // Expression engine relevance equation
    public $question_order; // Display order

    // Question types (30+ types)
    // L = List (radio)
    // M = Multiple choice
    // T = Long free text
    // S = Short free text
    // A = Array (5 point)
    // F = Array (flexible labels)
    // ; = Array texts
    // : = Array numbers
    // 5 = 5 point choice
    // etc.
}
```

#### Answer Model
```php
// application/models/Answer.php
class Answer extends LSActiveRecord
{
    public $aid;           // Answer ID
    public $qid;           // Question ID
    public $code;          // Answer code
    public $sortorder;     // Display order
    public $assessment_value; // Assessment score
}
```

### 3. Question Types Reference

| Code | Type | Description |
|------|------|-------------|
| `L` | List (Radio) | Single choice list |
| `!` | List (Dropdown) | Dropdown single choice |
| `O` | List with comment | Single choice with comment |
| `M` | Multiple choice | Checkbox multiple selection |
| `P` | Multiple choice with comments | Multiple selection with comments |
| `T` | Long free text | Textarea input |
| `S` | Short free text | Text input |
| `U` | Huge free text | Large textarea |
| `N` | Numerical input | Number input |
| `K` | Multiple numerical | Multiple number inputs |
| `A` | Array (5 point) | 5-point scale matrix |
| `B` | Array (10 point) | 10-point scale matrix |
| `C` | Array (Yes/No/Uncertain) | Yes/No matrix |
| `E` | Array (Increase/Same/Decrease) | Trend matrix |
| `F` | Array (Flexible Labels) | Custom labels matrix |
| `H` | Array by column | Column-based array |
| `1` | Array dual scale | Two-scale matrix |
| `;` | Array (Texts) | Text input matrix |
| `:` | Array (Numbers) | Numeric input matrix |
| `5` | 5 point choice | Star rating |
| `D` | Date/Time | Date picker |
| `G` | Gender | Gender selection |
| `Y` | Yes/No | Boolean choice |
| `X` | Text display | Information text |
| `|` | File upload | File attachment |
| `*` | Equation | Calculated value |
| `R` | Ranking | Drag-and-drop ranking |

## RemoteControl API v2

### API Overview
LimeSurvey provides a comprehensive JSON-RPC 2.0 API for remote control operations.

### Authentication
```php
// Get session key
$sessionKey = $client->get_session_key(
    $username,
    $password,
    'Authdb'  // Auth plugin (default: Authdb)
);

// Release session when done
$client->release_session_key($sessionKey);
```

### Survey Management Methods

```php
// List all surveys
list_surveys($sessionKey, $username = null);

// Get survey properties
get_survey_properties($sessionKey, $surveyId, $properties = null);

// Add new survey
add_survey($sessionKey, $surveyId, $surveyTitle, $surveyLanguage, $format = 'G');

// Delete survey
delete_survey($sessionKey, $surveyId);

// Activate survey
activate_survey($sessionKey, $surveyId);

// Import survey from LSS/LSA/TXT
import_survey($sessionKey, $base64Data, $dataType, $newName = null, $destSurveyId = null);

// Export survey structure
export_survey($sessionKey, $surveyId, $documentType = 'lss');

// Copy survey
copy_survey($sessionKey, $surveyId, $newName);
```

### Question Management Methods

```php
// List questions
list_questions($sessionKey, $surveyId, $groupId = null, $language = null);

// Get question properties
get_question_properties($sessionKey, $questionId, $properties = null, $language = null);

// Import question
import_question($sessionKey, $surveyId, $groupId, $base64Data, $dataType, $mandatory = 'N', $newQuestionTitle = null, $newQID = null);

// Delete question
delete_question($sessionKey, $questionId);

// Set question properties
set_question_properties($sessionKey, $questionId, $properties);
```

### Response Management Methods

```php
// Add response
add_response($sessionKey, $surveyId, $responseData);

// Update response
update_response($sessionKey, $surveyId, $responseData);

// Export responses
export_responses($sessionKey, $surveyId, $documentType, $languageCode = null, $completionStatus = 'all', $headingType = 'code', $responseType = 'short', $fromResponseId = null, $toResponseId = null, $fields = null);

// Export responses by token
export_responses_by_token($sessionKey, $surveyId, $documentType, $token, $languageCode = null, $completionStatus = 'all', $headingType = 'code', $responseType = 'short', $fields = null);

// Get response IDs
get_response_ids($sessionKey, $surveyId, $token);

// Delete response
delete_response($sessionKey, $surveyId, $responseId);
```

### Participant/Token Management

```php
// Activate tokens
activate_tokens($sessionKey, $surveyId, $attributeFields = null);

// Add participants
add_participants($sessionKey, $surveyId, $participantData, $createTokenKey = true);

// Delete participants
delete_participants($sessionKey, $surveyId, $tokens);

// Get participant properties
get_participant_properties($sessionKey, $surveyId, $tokenQueryProperties, $tokenProperties = null);

// Set participant properties
set_participant_properties($sessionKey, $surveyId, $tokenQueryProperties, $tokenData);

// List participants
list_participants($sessionKey, $surveyId, $start = 0, $limit = 10, $unused = false, $attributes = false, $conditions = []);

// Invite participants
invite_participants($sessionKey, $surveyId, $tokenIds = null, $uninvitedOnly = true);

// Remind participants
remind_participants($sessionKey, $surveyId, $minDaysBetween = null, $maxReminders = null, $tokenIds = null);
```

### Statistics & Export Methods

```php
// Export statistics
export_statistics($sessionKey, $surveyId, $documentType = 'pdf', $language = null, $graph = '0', $groupIds = null);

// Get summary
get_summary($sessionKey, $surveyId, $statName = 'all');

// Export timeline
export_timeline($sessionKey, $surveyId, $type, $dateStart, $dateEnd);
```

## Database Schema

### Static Tables (Survey Metadata)

```sql
-- Core survey table
CREATE TABLE lime_surveys (
    sid INT PRIMARY KEY,
    owner_id INT NOT NULL,
    gsid INT DEFAULT 1,
    admin VARCHAR(50),
    active CHAR(1) DEFAULT 'N',
    expires DATETIME,
    startdate DATETIME,
    adminemail VARCHAR(254),
    anonymized CHAR(1) DEFAULT 'N',
    format CHAR(1) DEFAULT 'G',
    savetimings CHAR(1) DEFAULT 'N',
    template VARCHAR(100) DEFAULT 'default',
    language VARCHAR(50),
    additional_languages TEXT,
    datestamp CHAR(1) DEFAULT 'N',
    usecookie CHAR(1) DEFAULT 'N',
    allowregister CHAR(1) DEFAULT 'N',
    allowsave CHAR(1) DEFAULT 'Y',
    autonumber_start INT DEFAULT 0,
    autoredirect CHAR(1) DEFAULT 'N',
    allowprev CHAR(1) DEFAULT 'N',
    printanswers CHAR(1) DEFAULT 'N',
    ipaddr CHAR(1) DEFAULT 'N',
    refurl CHAR(1) DEFAULT 'N',
    datecreated DATETIME,
    publicstatistics CHAR(1) DEFAULT 'N',
    publicgraphs CHAR(1) DEFAULT 'N',
    listpublic CHAR(1) DEFAULT 'N',
    htmlemail CHAR(1) DEFAULT 'Y',
    tokenanswerspersistence CHAR(1) DEFAULT 'N',
    assessments CHAR(1) DEFAULT 'N',
    usecaptcha CHAR(1) DEFAULT 'N',
    usetokens CHAR(1) DEFAULT 'N',
    bounce_email VARCHAR(254),
    tokenlength INT DEFAULT 15,
    showxquestions CHAR(1) DEFAULT 'Y',
    showgroupinfo CHAR(1) DEFAULT 'B',
    shownoanswer CHAR(1) DEFAULT 'Y',
    showqnumcode CHAR(1) DEFAULT 'X',
    showwelcome CHAR(1) DEFAULT 'Y',
    showprogress CHAR(1) DEFAULT 'Y',
    questionindex INT DEFAULT 0,
    navigationdelay INT DEFAULT 0,
    nokeyboard CHAR(1) DEFAULT 'N',
    alloweditaftercompletion CHAR(1) DEFAULT 'N'
);

-- Question groups
CREATE TABLE lime_groups (
    gid INT PRIMARY KEY AUTO_INCREMENT,
    sid INT NOT NULL,
    group_order INT DEFAULT 0,
    randomization_group VARCHAR(20) DEFAULT '',
    grelevance TEXT,
    FOREIGN KEY (sid) REFERENCES lime_surveys(sid)
);

-- Group localization
CREATE TABLE lime_group_l10ns (
    id INT PRIMARY KEY AUTO_INCREMENT,
    gid INT NOT NULL,
    group_name TEXT NOT NULL,
    description TEXT,
    language VARCHAR(20) NOT NULL,
    FOREIGN KEY (gid) REFERENCES lime_groups(gid)
);

-- Questions
CREATE TABLE lime_questions (
    qid INT PRIMARY KEY AUTO_INCREMENT,
    parent_qid INT DEFAULT 0,
    sid INT NOT NULL,
    gid INT NOT NULL,
    type CHAR(30) DEFAULT 'T',
    title VARCHAR(20) NOT NULL,
    preg TEXT,
    other CHAR(1) DEFAULT 'N',
    mandatory CHAR(1) DEFAULT 'N',
    encrypted CHAR(1) DEFAULT 'N',
    question_order INT DEFAULT 0,
    scale_id INT DEFAULT 0,
    same_default INT DEFAULT 0,
    relevance TEXT,
    modulename VARCHAR(255),
    FOREIGN KEY (sid) REFERENCES lime_surveys(sid),
    FOREIGN KEY (gid) REFERENCES lime_groups(gid)
);

-- Question localization
CREATE TABLE lime_question_l10ns (
    id INT PRIMARY KEY AUTO_INCREMENT,
    qid INT NOT NULL,
    question TEXT NOT NULL,
    help TEXT,
    language VARCHAR(20) NOT NULL,
    script TEXT,
    FOREIGN KEY (qid) REFERENCES lime_questions(qid)
);

-- Answer options
CREATE TABLE lime_answers (
    aid INT PRIMARY KEY AUTO_INCREMENT,
    qid INT NOT NULL,
    code VARCHAR(5) NOT NULL,
    sortorder INT NOT NULL,
    assessment_value INT DEFAULT 0,
    scale_id INT DEFAULT 0,
    FOREIGN KEY (qid) REFERENCES lime_questions(qid)
);

-- Answer localization
CREATE TABLE lime_answer_l10ns (
    id INT PRIMARY KEY AUTO_INCREMENT,
    aid INT NOT NULL,
    answer TEXT NOT NULL,
    language VARCHAR(20) NOT NULL,
    FOREIGN KEY (aid) REFERENCES lime_answers(aid)
);
```

### Dynamic Tables (Per Survey)

```sql
-- Response table (created when survey is activated)
-- Table name: lime_survey_{SID}
CREATE TABLE lime_survey_123456 (
    id INT PRIMARY KEY AUTO_INCREMENT,
    token VARCHAR(36),
    submitdate DATETIME,
    lastpage INT,
    startlanguage VARCHAR(20),
    seed VARCHAR(31),
    startdate DATETIME,
    datestamp DATETIME,
    -- Question response columns follow pattern:
    -- {SID}X{GID}X{QID} for main questions
    -- {SID}X{GID}X{QID}SQ001 for subquestions
    -- {SID}X{GID}X{QID}other for "other" text
    123456X1X1 VARCHAR(5),           -- Single choice answer code
    123456X1X2 TEXT,                 -- Free text answer
    123456X1X3SQ001 VARCHAR(5),      -- Subquestion answer
    123456X1X3SQ002 VARCHAR(5),      -- Subquestion answer
    123456X1X4 TEXT,                 -- Another question
    123456X1X4other TEXT             -- "Other" text for that question
);

-- Token/Participant table (created when tokens enabled)
-- Table name: lime_tokens_{SID}
CREATE TABLE lime_tokens_123456 (
    tid INT PRIMARY KEY AUTO_INCREMENT,
    participant_id VARCHAR(50),
    token VARCHAR(36) UNIQUE,
    firstname VARCHAR(150),
    lastname VARCHAR(150),
    email TEXT,
    emailstatus VARCHAR(300) DEFAULT 'OK',
    sent VARCHAR(17) DEFAULT 'N',
    remindersent VARCHAR(17) DEFAULT 'N',
    remindercount INT DEFAULT 0,
    completed VARCHAR(17) DEFAULT 'N',
    usesleft INT DEFAULT 1,
    validfrom DATETIME,
    validuntil DATETIME,
    mpid INT,
    blacklisted CHAR(1),
    language VARCHAR(25),
    -- Custom attributes
    attribute_1 TEXT,
    attribute_2 TEXT,
    -- ... more attributes as needed
);

-- Timing table (created when save timings enabled)
-- Table name: lime_survey_{SID}_timings
CREATE TABLE lime_survey_123456_timings (
    id INT PRIMARY KEY,
    interviewtime FLOAT,
    -- Per-group timing columns
    123456X1time FLOAT,              -- Time spent on group 1
    123456X2time FLOAT               -- Time spent on group 2
);
```

## Plugin System

### Plugin Architecture
LimeSurvey supports plugins for extending functionality:

```php
// application/plugins/YourPlugin/YourPlugin.php
class YourPlugin extends PluginBase
{
    protected $storage = 'DbStorage';

    static protected $name = 'YourPlugin';
    static protected $description = 'Plugin description';

    public function init()
    {
        // Register event handlers
        $this->subscribe('beforeSurveyPage');
        $this->subscribe('afterSurveyComplete');
        $this->subscribe('newSurveySettings');
    }

    public function beforeSurveyPage()
    {
        // Handle before survey page load
    }

    public function afterSurveyComplete()
    {
        // Handle after survey completion
    }
}
```

### Available Events
- `beforeSurveyPage` - Before survey page renders
- `afterSurveyComplete` - After survey submission
- `beforeSurveyActivate` - Before survey activation
- `afterSurveyDeactivate` - After survey deactivation
- `newSurveySettings` - Add custom survey settings
- `beforeQuestionRender` - Before question renders
- `newQuestionAttributes` - Add custom question attributes
- `beforeTokenEmail` - Before invitation email
- `afterResponseSave` - After response saved

## Export Formats

LimeSurvey supports multiple export formats:

| Format | Extension | Description |
|--------|-----------|-------------|
| CSV | .csv | Comma-separated values |
| Excel | .xlsx | Microsoft Excel format |
| SPSS | .sav | SPSS data file |
| R | .R | R statistical format |
| Stata | .dta | Stata data file |
| PDF | .pdf | PDF document |
| HTML | .html | HTML tables |
| JSON | .json | JSON format |
| XML | .xml | XML format |
| LSS | .lss | LimeSurvey structure |
| LSA | .lsa | LimeSurvey archive |

## Version Information

### Recent Versions (2024-2025)
- **6.x**: Current major version with modern features
- **5.x**: LTS version with stability focus
- **Key improvements**:
  - Enhanced Expression Manager
  - Improved API capabilities
  - Better multilingual support
  - Modern theme system
  - Enhanced security features

## Integration Best Practices

### 1. Use Session Keys Properly
```php
// Always release session when done
try {
    $sessionKey = $client->get_session_key($user, $pass);
    // ... perform operations
} finally {
    $client->release_session_key($sessionKey);
}
```

### 2. Handle Dynamic Tables
```php
// Response tables are named lime_survey_{SID}
$tableName = "lime_survey_{$surveyId}";

// Field names follow pattern {SID}X{GID}X{QID}
$fieldName = "{$surveyId}X{$groupId}X{$questionId}";
```

### 3. Respect Rate Limits
- Batch operations when possible
- Cache frequently accessed data
- Use pagination for large datasets

### 4. Handle Multilingual Content
```php
// Always specify language when querying localized content
$questions = $client->list_questions($sessionKey, $surveyId, null, 'en');
```

## References

- **Official Documentation**: https://manual.limesurvey.org/
- **API Documentation**: https://manual.limesurvey.org/RemoteControl_2_API
- **GitHub Repository**: https://github.com/LimeSurvey/LimeSurvey
- **Community Forums**: https://forums.limesurvey.org/
