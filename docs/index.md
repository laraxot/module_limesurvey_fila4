# LimeSurvey Module Documentation

## Overview
LimeSurvey is a powerful, open-source online survey platform. This module provides comprehensive integration with the LimeSurvey platform, enabling advanced survey creation, management, and analysis within the Laraxot system. The integration includes data access, chart generation, and report export capabilities with support for multiple PDF generation libraries.

## Key Features
- **Survey Integration**: Full integration with LimeSurvey database structure
- **Question Management**: Advanced question creation and management
- **Response Collection**: Comprehensive response data collection
- **Analysis Tools**: Advanced data analysis and reporting
- **User Management**: Survey participant and permissions management
- **Data Export**: Export survey data in various formats
- **Chart Integration**: Generate professional charts from survey data
- **PDF Generation**: Create PDF reports with embedded charts using HTML2PDF, Spatie PDF, and JpGraph

## Database Schema

### Static Tables (Metadata)

#### lime_surveys
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

#### lime_groups
Represents question groups (pages) within a survey.

| Column | Type | Description |
|--------|------|-------------|
| `gid` | int | Primary key, unique group identifier |
| `sid` | int | Foreign key to lime_surveys |
| `group_order` | int | Order of the group within the survey |
| `title` | varchar | Group title |
| `description` | text | Group description |
| `language` | varchar | Language code |

#### lime_questions
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

#### lime_answers
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

### Localization Tables

#### lime_survey_l10ns
Localized survey information.

| Column | Type | Description |
|--------|------|-------------|
| `surveyls_survey_id` | int | Foreign key to lime_surveys |
| `surveyls_language` | varchar | Language code |
| `surveyls_title` | varchar | Localized survey title |
| `surveyls_description` | text | Localized survey description |

#### lime_group_l10ns
Localized group information.

| Column | Type | Description |
|--------|------|-------------|
| `groupl10ns_gid` | int | Foreign key to lime_groups |
| `language` | varchar | Language code |
| `group_name` | varchar | Localized group name |
| `description` | text | Localized group description |

#### lime_question_l10ns
Localized question information.

| Column | Type | Description |
|--------|------|-------------|
| `qid` | int | Foreign key to lime_questions |
| `language` | varchar | Language code |
| `question` | text | Localized question text |
| `help` | text | Localized question help |

#### lime_answer_l10ns
Localized answer information.

| Column | Type | Description |
|--------|------|-------------|
| `aid` | int | Foreign key to lime_answers |
| `language` | varchar | Language code |
| `answer` | text | Localized answer text |

### Dynamic Tables (Per Survey)

#### lime_survey_{SID}
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

#### lime_tokens_{SID}
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

## Dynamic Model Implementation

### SurveyResponse Model
The `SurveyResponse` model provides dynamic access to LimeSurvey response tables without needing to create separate models for each survey. This is the traditional approach that directly accesses the LimeSurvey dynamic tables.

```php
namespace Modules\Limesurvey\Models;

class SurveyResponse extends BaseModel
{
    public string $surveyId = '';

    public function setTableForSurvey($surveyId): void
    {
        $this->surveyId = $surveyId;
        $this->setTable('lime_survey_'.$surveyId);
    }

    public static function getResponsesForSurvey(string $surveyId): Builder
    {
        $instance = new static;
        $instance->setTableForSurvey($surveyId);

        return $instance->newQuery();
    }
}
```

### SurveyResponse Statistical Methods
The SurveyResponse model includes several useful scopes and methods for data analysis, particularly for question type Y:

```php
// Adding answer labels to responses
$withLabels = SurveyResponse::getResponsesForSurvey($surveyId)
    ->withAnswersLabel($qid, $field_name);

// Filtering by dashboard data
$filtered = SurveyResponse::getResponsesForSurvey($surveyId)
    ->ofDashboardFilterData($dashboardFilterData);

// Adding statistical calculations for type Y questions
$withStats = SurveyResponse::getResponsesForSurvey($surveyId)
    ->selectRaw("
        *,
        AVG(CASE WHEN {$field_name} = 'Y' THEN 1 ELSE 0 END) * 100 AS percentage,
        SUM(CASE WHEN {$field_name} = 'Y' THEN 1 ELSE 0 END) AS yes_count,
        SUM(CASE WHEN {$field_name} = 'N' THEN 1 ELSE 0 END) AS no_count,
        COUNT(*) AS total_responses
    ");
```

### SurveyFlipResponse Model (EAV Approach)
The `SurveyFlipResponse` model implements an Entity-Attribute-Value (EAV) approach that stores all responses in a single normalized table, providing an alternative to the traditional dynamic table approach.

```php
namespace Modules\Limesurvey\Models;

class SurveyFlipResponse extends BaseModel
{
    protected $fillable = [
        'survey_id',      // ID dell'indagine
        'question_id',    // ID della domanda
        'question_type',  // Type of the question
        'answer',         // Raw answer from LimeSurvey column
        'value',          // Processed value (often from answer labels)
        'participant_id', // ID of the participant
        'submitdate',     // Date when response was submitted
        'fieldname',      // Original LimeSurvey fieldname (e.g., 123X12X88)
        'token',          // Participant token
        'old_id',         // Original response ID from lime_survey_{SID}
        'feedback',       // Associated feedback text
    ];

    public function question(): BelongsTo
    {
        return $this->belongsTo(LimeQuestion::class, 'question_id');
    }

    public function survey(): BelongsTo
    {
        return $this->belongsTo(LimeSurvey::class, 'survey_id');
    }

    public static function getParticipants(string $survey_id): Collection
    {
        $table = 'lime_tokens_'.$survey_id;

        return DB::table($table)->get();
    }

    public static function getResponsesBySurveyId(string $survey_id): Collection
    {
        return self::where('survey_id', $survey_id)->get();
    }
}
```

### Comparison of Approaches

| Aspect | Dynamic Models (SurveyResponse) | Flip Approach (SurveyFlipResponse) |
|--------|---------------------------------|-----------------------------------|
| Table Structure | Dynamic per survey (`lime_survey_{SID}`) | Single EAV table (`survey_flip_responses`) |
| Data Access | `SurveyResponse::getResponsesForSurvey($surveyId)` | Direct query on single table with survey_id filter |
| Field Names | Original LimeSurvey field names | Standardized EAV structure |
| Scalability | Limited by number of tables | Unlimited by single table |
| Query Performance | Requires dynamic table access | Standardized queries with proper indexing |
| Use Case | Direct access to LimeSurvey structure | Analytics, reporting, and complex queries |

### When to Use Each Approach

#### Use Dynamic Models (SurveyResponse) When:
- You need direct access to the original LimeSurvey table structure
- Working with specific survey data in its original format
- You want to leverage LimeSurvey's native table structure
- Performance with specific survey queries is critical

#### Use Flip Approach (SurveyFlipResponse) When:
- Building analytics and reporting dashboards
- Need to query across multiple surveys
- Want simplified data access patterns
- Building complex analytical queries
- Need to perform mathematical operations on responses
- Working with alert systems and threshold monitoring

### Migration Between Approaches
The system supports both approaches simultaneously, allowing for gradual migration. You can use the `MigrateToFlipAction` to transform data from the traditional approach to the flip approach:

```php
use Modules\Limesurvey\Models\SurveyResponse;
use Modules\Limesurvey\Models\SurveyFlipResponse;

class MigrateToFlipAction
{
    public function execute(string $surveyId): void
    {
        // Get data from traditional dynamic table
        $dynamicResponses = SurveyResponse::getResponsesForSurvey($surveyId)->get();
        
        foreach ($dynamicResponses as $response) {
            $this->processResponse($response, $surveyId);
        }
    }
    
    private function processResponse($response, string $surveyId): void
    {
        // Process each field in the response and create EAV entries
        // Implementation details...
    }
}
```

For more detailed information about the flip approach, see [Survey Flip Approach](./survey-flip-approach.md).

### Usage Pattern
The primary pattern for accessing LimeSurvey data is:

```php
// Get responses for a specific survey
$responses = SurveyResponse::getResponsesForSurvey('123456')
    ->where('submitdate', '>=', $dateFrom)
    ->where('submitdate', '<=', $dateTo)
    ->get();

// Get specific question responses
$responses = SurveyResponse::getResponsesForSurvey($surveyId)
    ->select([
        $questionFieldName . ' as answer',
        DB::raw('COUNT(*) as count')
    ])
    ->whereNotNull($questionFieldName)
    ->groupBy($questionFieldName)
    ->orderBy('count', 'desc')
    ->get();
```

### TokensResponse Model
```php
namespace Modules\Limesurvey\Models;

class TokensResponse extends BaseModel
{
    protected $primaryKey = 'tid';

    public function setTableForSurvey($surveyId): void
    {
        $this->setTable('lime_tokens_'.$surveyId);
    }

    public static function getResponsesForSurvey(string $surveyId): Builder
    {
        $instance = new static();
        $instance->setTableForSurvey($surveyId);

        return $instance->newQuery();
    }
}
```

## Question Model Implementation

### LimeQuestion Model
The `LimeQuestion` model represents individual questions with advanced relationships and dynamic field name generation.

```php
namespace Modules\Limesurvey\Models;

class LimeQuestion extends BaseTreeModel
{
    protected $connection = 'limesurvey';
    protected $table = 'lime_questions';
    protected $primaryKey = 'qid';

    // Dynamic field name generation
    public function getFieldNameAttribute(?string $value): string
    {
        if ($value !== null) {
            return $value;
        }

        $res = $this->sid.'X'.$this->gid.'X';
        
        if ($this->type === 'F' && $this->child !== null) {
            return $res.$this->qid.''.$this->child->title;
        }
        if ($this->type === 'F') {
            return $res.$this->parent->qid.$this->title;
        }
        if ($this->parent_qid === 0) {
            return $res.$this->qid;
        }

        return $res.$this->parent_qid.''.$this->title;
    }
}
```

## Chart Integration with LimeSurvey Data

### Data Query Patterns
```php
use Modules\Limesurvey\Models\SurveyResponse;
use Illuminate\Support\Facades\DB;

class LimeSurveyDataProcessor
{
    public function getQuestionResponses(string $surveyId, string $questionId, array $options = []): Collection
    {
        // Get the question information
        $question = DB::table('lime_questions')
            ->where('sid', $surveyId)
            ->where('qid', $questionId)
            ->first();
        
        if (!$question) {
            return collect();
        }
        
        // Build field name: {surveyId}X{groupId}X{questionId}
        $groupId = $question->gid;
        $fieldName = "{$surveyId}X{$groupId}X{$questionId}";
        
        // Query responses using dynamic model
        $query = SurveyResponse::getResponsesForSurvey($surveyId)
            ->select([
                DB::raw("{$fieldName} as answer"),
                DB::raw('COUNT(*) as count')
            ])
            ->whereNotNull($fieldName)
            ->groupBy($fieldName);
            
        // Apply filters
        if (isset($options['date_from'])) {
            $query->where('submitdate', '>=', $options['date_from']);
        }
        
        if (isset($options['date_to'])) {
            $query->where('submitdate', '<=', $options['date_to']);
        }
        
        if (isset($options['limit'])) {
            $query->limit($options['limit']);
        }
        
        return $query->orderBy('count', 'desc')->get();
    }
    
    public function getTrendData(string $surveyId, string $questionId, string $timeUnit = 'month'): Collection
    {
        $question = DB::table('lime_questions')
            ->where('sid', $surveyId)
            ->where('qid', $questionId)
            ->first();
        
        if (!$question) {
            return collect();
        }
        
        $groupId = $question->gid;
        $fieldName = "{$surveyId}X{$groupId}X{$questionId}";
        
        $dateGrouping = match($timeUnit) {
            'day' => 'DATE(submitdate)',
            'week' => 'YEARWEEK(submitdate)',
            'month' => 'DATE_FORMAT(submitdate, "%Y-%m")',
            'year' => 'YEAR(submitdate)',
            default => 'DATE(submitdate)',
        };
        
        return SurveyResponse::getResponsesForSurvey($surveyId)
            ->select([
                DB::raw("{$dateGrouping} as date"),
                DB::raw("{$fieldName} as answer"),
                DB::raw('COUNT(*) as count')
            ])
            ->whereNotNull($fieldName)
            ->whereNotNull('submitdate')
            ->groupBy(DB::raw($dateGrouping), $fieldName)
            ->orderBy('date')
            ->get();
    }
}
```

## PDF Export with Charts from LimeSurvey Data

### PDF Export Service
```php
use Modules\Limesurvey\Models\SurveyResponse;
use Spipu\Html2Pdf\Html2Pdf;
use Spatie\LaravelPdf\Facades\Pdf as SpatiePdf;
use Illuminate\Support\Facades\DB;

class LimeSurveyPdfExporter
{
    /**
     * Export LimeSurvey responses to PDF with charts using HTML2PDF
     */
    public function exportSurveyToPdfHtml2Pdf(string $surveyId, array $options = []): string
    {
        $survey = $this->getSurveyInfo($surveyId);
        $questions = $this->getSurveyQuestions($surveyId, $options);
        
        // Generate chart data from LimeSurvey responses using dynamic model
        $chartData = [];
        foreach ($questions as $question) {
            $data = $this->getQuestionChart($surveyId, $question->qid, $options);
            if ($data) {
                $chartData[] = $data;
            }
        }
        
        // Generate charts using JpGraph
        $chartImages = $this->generateJpGraphs($chartData);
        
        // Build PDF HTML
        $html = $this->buildSurveyPdfHtml($survey, $chartData, $chartImages);
        
        // Generate PDF with HTML2PDF
        $html2pdf = new Html2Pdf('L', 'A4', 'en');
        $html2pdf->setTestIsImage(true);
        $html2pdf->setDefaultFont('Arial');
        $html2pdf->writeHTML($html);
        
        $filename = 'limesurvey_' . $surveyId . '_report_' . date('Y-m-d') . '.pdf';
        $path = storage_path('app/limesurvey_reports/' . $filename);
        $html2pdf->output($path, 'F');
        
        // Clean up temporary images
        $this->cleanupTempImages($chartImages);
        
        return $path;
    }
    
    /**
     * Export LimeSurvey responses to PDF with charts using Spatie PDF
     */
    public function exportSurveyToPdfSpatie(string $surveyId, array $options = []): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $survey = $this->getSurveyInfo($surveyId);
        $questions = $this->getSurveyQuestions($surveyId, $options);
        
        // Generate chart data and convert to base64
        $charts = [];
        foreach ($questions as $question) {
            $data = $this->getQuestionChart($surveyId, $question->qid, $options);
            if ($data) {
                $imageBase64 = $this->generateJpGraphAsBase64($data);
                $charts[] = [
                    'title' => $data['title'],
                    'question_text' => $question->question,
                    'image_base64' => $imageBase64
                ];
            }
        }
        
        return SpatiePdf::view('limesurvey.pdf.survey-report', [
            'survey' => $survey,
            'charts' => $charts,
            'date' => date('F j, Y \a\t g:i A'),
            'options' => $options
        ])
        ->format($options['format'] ?? 'a4')
        ->name('limesurvey_' . $surveyId . '_report_' . date('Y-m-d') . '.pdf');
    }
    
    private function getSurveyInfo(string $surveyId): object
    {
        return DB::table('lime_surveys')
            ->where('sid', $surveyId)
            ->first();
    }
    
    private function getSurveyQuestions(string $surveyId, array $options = []): Collection
    {
        $query = DB::table('lime_questions')
            ->where('sid', $surveyId);
            
        // Filter by question types that are suitable for charts
        $chartableTypes = ['A', 'F', 'L', 'M', 'P', '5', 'B', 'C'];
        $query->whereIn('type', $chartableTypes);
        
        return $query->get();
    }
    
    private function getQuestionChart(string $surveyId, string $questionId, array $options = []): ?array
    {
        $question = DB::table('lime_questions')
            ->where('sid', $surveyId)
            ->where('qid', $questionId)
            ->first();
        
        if (!$question) {
            return null;
        }
        
        // Get field name from question model
        $questionModel = new LimeQuestion();
        $questionModel->sid = $surveyId;
        $questionModel->gid = $question->gid;
        $questionModel->qid = $questionId;
        $questionModel->type = $question->type;
        $questionModel->title = $question->title;
        $questionModel->parent_qid = $question->parent_qid;
        
        $fieldName = $questionModel->field_name;
        
        // Get response data using dynamic SurveyResponse model
        $query = SurveyResponse::getResponsesForSurvey($surveyId)
            ->select([
                DB::raw("{$fieldName} as answer"),
                DB::raw('COUNT(*) as count')
            ])
            ->whereNotNull($fieldName)
            ->groupBy($fieldName);
            
        // Apply date filters
        if (isset($options['date_from'])) {
            $query->where('submitdate', '>=', $options['date_from']);
        }
        
        if (isset($options['date_to'])) {
            $query->where('submitdate', '<=', $options['date_to']);
        }
        
        $responses = $query->orderBy('count', 'desc')
            ->limit($options['limit'] ?? 20)
            ->get();
        
        if ($responses->isEmpty()) {
            return null;
        }
        
        return [
            'title' => $question->question,
            'type' => $this->mapQuestionTypeToChartType($question->type),
            'labels' => $responses->pluck('answer')->toArray(),
            'values' => $responses->pluck('count')->toArray(),
            'question_id' => $questionId
        ];
    }
    
    private function mapQuestionTypeToChartType(string $questionType): string
    {
        $typeMap = [
            'L' => 'bar',    // List
            '!' => 'bar',    // List with comment
            'O' => 'bar',    // List other
            'M' => 'bar',    // Multiple choice
            'P' => 'bar',    // Multiple choice with comments
            'A' => 'bar',    // Array 5 point
            'F' => 'bar',    // Array flexible row
            'H' => 'bar',    // Array flexible column
            '5' => 'bar',    // 5 point choice
            'B' => 'bar',    // 10 point choice
        ];
        
        return $typeMap[$questionType] ?? 'bar';
    }
    
    private function generateJpGraphs(array $chartData): array
    {
        $images = [];
        
        foreach ($chartData as $index => $data) {
            $graph = new \Graph(800, 400);
            $graph->SetScale('textlin');
            
            // Set title
            $graph->title->Set($data['title']);
            $graph->title->SetFont(FF_ARIAL, FS_BOLD, 10);
            
            // Set labels
            if (!empty($data['labels'])) {
                $graph->xaxis->SetTickLabels($data['labels']);
            }
            
            // Rotate labels if there are many
            if (count($data['labels']) > 5) {
                $graph->xaxis->SetLabelAngle(45);
            }
            
            // Create appropriate plot type
            $values = $data['values'] ?? [];
            $plot = new \BarPlot($values);
            $plot->SetFillColor($this->getChartColor($index));
            
            // Add value labels on top of bars
            $plot->value->Show();
            $plot->value->SetFormat('%.0f');
            
            $graph->Add($plot);
            
            // Generate chart image
            $filename = 'temp_charts/limesurvey_chart_' . time() . '_' . $index . '.png';
            $fullPath = public_path($filename);
            
            // Ensure directory exists
            $dir = dirname($fullPath);
            if (!file_exists($dir)) {
                mkdir($dir, 0755, true);
            }
            
            $graph->Stroke($fullPath);
            $images[] = $filename;
        }
        
        return $images;
    }
    
    private function generateJpGraphAsBase64(array $data): string
    {
        $graph = new \Graph(800, 400);
        $graph->SetScale('textlin');
        
        // Set title
        $graph->title->Set($data['title']);
        $graph->title->SetFont(FF_ARIAL, FS_BOLD, 10);
        
        // Set labels
        if (!empty($data['labels'])) {
            $graph->xaxis->SetTickLabels($data['labels']);
        }
        
        // Rotate labels if there are many
        if (count($data['labels']) > 5) {
            $graph->xaxis->SetLabelAngle(45);
        }
        
        // Create plot
        $values = $data['values'] ?? [];
        $plot = new \BarPlot($values);
        $plot->SetFillColor('#3b82f6'); // Tailwind blue-500
        
        // Add value labels on top of bars
        $plot->value->Show();
        $plot->value->SetFormat('%.0f');
        
        $graph->Add($plot);
        
        // Output to memory
        ob_start();
        $graph->Stroke();
        $imageData = ob_get_contents();
        ob_end_clean();
        
        return 'data:image/png;base64,' . base64_encode($imageData);
    }
    
    private function buildSurveyPdfHtml(object $survey, array $chartData, array $chartImages): string
    {
        $html = '<page backtop="20mm" backbottom="20mm" backleft="15mm" backright="15mm">';
        $html .= '<h1 style="text-align: center; font-size: 18pt; margin-bottom: 10px;">LimeSurvey Report</h1>';
        $html .= '<h2 style="text-align: center; font-size: 14pt; margin-bottom: 20px;">' . e($survey->surveyls_title ?? $survey->sid) . '</h2>';
        $html .= '<p style="text-align: center; margin-bottom: 10px;">Survey ID: ' . e($survey->sid) . '</p>';
        $html .= '<p style="text-align: center; margin-bottom: 20px;">Generated on: ' . date('F j, Y \a\t g:i A') . '</p>';
        
        foreach ($chartData as $index => $data) {
            if (isset($chartImages[$index])) {
                $html .= '<div style="margin: 20px 0; page-break-inside: avoid;">';
                $html .= '<h3 style="font-size: 12pt; margin-bottom: 10px;">' . e($data['title']) . '</h3>';
                $html .= '<img src="' . public_path($chartImages[$index]) . '" style="width: 100%; height: auto;">';
                $html .= '</div>';
            }
        }
        
        $html .= '</page>';
        
        return $html;
    }
    
    private function getChartColor(int $index): string
    {
        $colors = [
            '#3b82f6', '#ef4444', '#10b981', '#f59e0b',
            '#8b5cf6', '#ec4899', '#06b6d4', '#84cc16'
        ];
        
        return $colors[$index % count($colors)];
    }
    
    private function cleanupTempImages(array $images): void
    {
        foreach ($images as $imagePath) {
            $fullPath = public_path($imagePath);
            if (file_exists($fullPath)) {
                unlink($fullPath);
            }
        }
    }
}
```

## Advanced PDF Export with Multiple Chart Types
```php
class AdvancedLimeSurveyPdfExporter
{
    public function exportSurveyWithMultipleChartTypes(string $surveyId, array $options = []): string
    {
        $survey = $this->getSurveyInfo($surveyId);
        $questions = $this->getSurveyQuestions($surveyId);
        
        $chartData = [];
        foreach ($questions as $question) {
            $data = $this->getQuestionChart($surveyId, $question->qid, $options);
            if ($data) {
                // Determine best chart type based on data characteristics
                $data['optimal_type'] = $this->determineOptimalChartType($data);
                $chartData[] = $data;
            }
        }
        
        // Generate different chart types based on data
        $chartImages = $this->generateOptimizedCharts($chartData);
        
        $html = $this->buildAdvancedSurveyReportHtml($survey, $chartData, $chartImages);
        
        $html2pdf = new Html2Pdf('L', 'A4', 'en');
        $html2pdf->setTestIsImage(true);
        $html2pdf->setDefaultFont('Arial');
        $html2pdf->writeHTML($html);
        
        $filename = 'advanced_limesurvey_' . $surveyId . '_report_' . date('Y-m-d') . '.pdf';
        $path = storage_path('app/limesurvey_reports/' . $filename);
        $html2pdf->output($path, 'F');
        
        $this->cleanupTempImages($chartImages);
        
        return $path;
    }
    
    private function determineOptimalChartType(array $data): string
    {
        $valueCount = count($data['values']);
        
        // For small number of categories, use bar chart
        if ($valueCount < 6) {
            return 'bar';
        }
        
        // For medium number of categories, use horizontal bar chart
        if ($valueCount < 12) {
            return 'hbar';
        }
        
        // For larger number of categories, consider pie chart only if less than 8 unique values
        if ($valueCount < 8) {
            return 'pie';
        }
        
        // Default to bar chart
        return 'bar';
    }
    
    private function generateOptimizedCharts(array $chartData): array
    {
        $images = [];
        
        foreach ($chartData as $index => $data) {
            $graph = new \Graph(800, 400);
            $graph->SetScale('textlin');
            
            // Set title
            $graph->title->Set($data['title']);
            $graph->title->SetFont(FF_ARIAL, FS_BOLD, 10);
            
            // Set up labels
            if (!empty($data['labels'])) {
                $graph->xaxis->SetTickLabels($data['labels']);
                
                // Rotate labels if there are many
                if (count($data['labels']) > 5) {
                    $graph->xaxis->SetLabelAngle(45);
                }
            }
            
            // Create plot based on optimal type
            $values = $data['values'] ?? [];
            $color = $this->getChartColor($index);
            
            switch ($data['optimal_type']) {
                case 'pie':
                    // For pie charts we need a different approach
                    $pieGraph = new \PieGraph(800, 400);
                    $pieGraph->title->Set($data['title']);
                    $pieGraph->title->SetFont(FF_ARIAL, FS_BOLD, 10);
                    
                    $p1 = new \PiePlot($values);
                    $p1->SetLegends($data['labels']);
                    $p1->SetSliceColors($this->getMultipleColors(count($values)));
                    
                    $pieGraph->Add($p1);
                    $chartImage = $pieGraph;
                    break;
                    
                case 'hbar':
                    // Horizontal bar chart
                    $graph->SetScale('textlin');
                    $graph->Set90AndMargin(50, 50, 50, 50); // Rotate 90 degrees
                    
                    $bplot = new \BarPlot($values);
                    $bplot->SetFillColor($color);
                    $bplot->SetLegend(implode(', ', array_slice($data['labels'], 0, 5)) . (count($data['labels']) > 5 ? '...' : ''));
                    
                    $graph->Add($bplot);
                    $chartImage = $graph;
                    break;
                    
                case 'bar':
                default:
                    $bplot = new \BarPlot($values);
                    $bplot->SetFillColor($color);
                    $bplot->SetLegend(implode(', ', array_slice($data['labels'], 0, 5)) . (count($data['labels']) > 5 ? '...' : ''));
                    
                    $graph->Add($bplot);
                    $chartImage = $graph;
                    break;
            }
            
            // Generate chart image
            $filename = 'temp_charts/optimized_chart_' . time() . '_' . $index . '.png';
            $fullPath = public_path($filename);
            
            // Ensure directory exists
            $dir = dirname($fullPath);
            if (!file_exists($dir)) {
                mkdir($dir, 0755, true);
            }
            
            $chartImage->Stroke($fullPath);
            $images[] = $filename;
        }
        
        return $images;
    }
    
    private function getMultipleColors(int $count): array
    {
        $baseColors = [
            '#3b82f6', '#ef4444', '#10b981', '#f59e0b',
            '#8b5cf6', '#ec4899', '#06b6d4', '#84cc16',
            '#6366f1', '#f97316', '#14b8a6', '#f43f5e'
        ];
        
        $colors = [];
        for ($i = 0; $i < $count; $i++) {
            $colors[] = $baseColors[$i % count($baseColors)];
        }
        
        return $colors;
    }
    
    private function buildAdvancedSurveyReportHtml(object $survey, array $chartData, array $chartImages): string
    {
        $html = '<page backtop="20mm" backbottom="20mm" backleft="15mm" backright="15mm">';
        $html .= '<h1 style="text-align: center; font-size: 18pt; margin-bottom: 10px;">Advanced LimeSurvey Report</h1>';
        $html .= '<h2 style="text-align: center; font-size: 14pt; margin-bottom: 10px;">' . e($survey->surveyls_title ?? $survey->sid) . '</h2>';
        $html .= '<p style="text-align: center; margin-bottom: 5px;">Survey ID: ' . e($survey->sid) . '</p>';
        $html .= '<p style="text-align: center; margin-bottom: 20px;">Generated on: ' . date('F j, Y \a\t g:i A') . '</p>';
        
        foreach ($chartData as $index => $data) {
            if (isset($chartImages[$index])) {
                $html .= '<div style="margin: 20px 0; page-break-inside: avoid;">';
                $html .= '<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">';
                $html .= '<h3 style="font-size: 12pt; margin: 0;">' . e($data['title']) . '</h3>';
                $html .= '<span style="font-size: 10pt; color: #666;">Chart Type: ' . e($data['optimal_type']) . '</span>';
                $html .= '</div>';
                $html .= '<img src="' . public_path($chartImages[$index]) . '" style="width: 100%; height: auto; border: 1px solid #ddd;">';
                
                // Add summary statistics
                $totalResponses = array_sum($data['values']);
                $html .= '<div style="margin-top: 10px; font-size: 10pt;">';
                $html .= '<p><strong>Total Responses:</strong> ' . $totalResponses . '</p>';
                if (!empty($data['values'])) {
                    $maxValue = max($data['values']);
                    $maxIndex = array_search($maxValue, $data['values']);
                    $html .= '<p><strong>Most Common Answer:</strong> ' . e($data['labels'][$maxIndex] ?? 'N/A') . ' (' . $maxValue . ' responses)</p>';
                }
                $html .= '</div>';
                
                $html .= '</div>';
            }
        }
        
        $html .= '</page>';
        
        return $html;
    }
    
    private function getSurveyInfo(string $surveyId): object
    {
        return DB::table('lime_surveys')
            ->where('sid', $surveyId)
            ->first();
    }
    
    private function getSurveyQuestions(string $surveyId): Collection
    {
        return DB::table('lime_questions')
            ->where('sid', $surveyId)
            ->whereIn('type', ['A', 'F', 'L', 'M', 'P', '5', 'B', 'C']) // Chartable types
            ->get();
    }
    
    private function getQuestionChart(string $surveyId, string $questionId, array $options = []): ?array
    {
        $question = DB::table('lime_questions')
            ->where('sid', $surveyId)
            ->where('qid', $questionId)
            ->first();
        
        if (!$question) {
            return null;
        }
        
        // Get field name using the LimeQuestion model
        $questionModel = new LimeQuestion();
        $questionModel->sid = $surveyId;
        $questionModel->gid = $question->gid;
        $questionModel->qid = $questionId;
        $questionModel->type = $question->type;
        $questionModel->title = $question->title;
        $questionModel->parent_qid = $question->parent_qid;
        
        $fieldName = $questionModel->field_name;
        
        $query = SurveyResponse::getResponsesForSurvey($surveyId)
            ->select([
                DB::raw("{$fieldName} as answer"),
                DB::raw('COUNT(*) as count')
            ])
            ->whereNotNull($fieldName)
            ->groupBy($fieldName);
            
        if (isset($options['date_from'])) {
            $query->where('submitdate', '>=', $options['date_from']);
        }
        
        if (isset($options['date_to'])) {
            $query->where('submitdate', '<=', $options['date_to']);
        }
        
        $responses = $query->orderBy('count', 'desc')
            ->limit($options['limit'] ?? 20)
            ->get();
        
        if ($responses->isEmpty()) {
            return null;
        }
        
        return [
            'title' => $question->question,
            'labels' => $responses->pluck('answer')->toArray(),
            'values' => $responses->pluck('count')->toArray(),
            'question_id' => $questionId
        ];
    }
    
    private function getChartColor(int $index): string
    {
        $colors = [
            '#3b82f6', '#ef4444', '#10b981', '#f59e0b',
            '#8b5cf6', '#ec4899', '#06b6d4', '#84cc16'
        ];
        
        return $colors[$index % count($colors)];
    }
    
    private function cleanupTempImages(array $images): void
    {
        foreach ($images as $imagePath) {
            $fullPath = public_path($imagePath);
            if (file_exists($fullPath)) {
                unlink($fullPath);
            }
        }
    }
}
```

## Implementation Best Practices

### 1. Dynamic Model Usage
Always use the dynamic model pattern for accessing LimeSurvey data:

```php
// Correct approach - use dynamic models
$responses = SurveyResponse::getResponsesForSurvey($surveyId)
    ->where('submitdate', '>=', $dateFrom)
    ->get();

// Avoid direct table access when possible
// $responses = DB::table("lime_survey_{$surveyId}")->get();
```

### 2. Question Field Name Generation
Use the LimeQuestion model's field_name attribute to get properly formatted field names:

```php
$questionModel = new LimeQuestion();
$questionModel->sid = $surveyId;
$questionModel->gid = $groupId;
$questionModel->qid = $questionId;
$questionModel->type = $questionType;
$questionModel->title = $questionTitle;
$questionModel->parent_qid = $parentQid;

$fieldName = $questionModel->field_name; // Returns: {SID}X{GID}X{QID}
```

### 3. Scopes for Common Operations
The models include useful scopes for common operations:

```php
// Get responses with participant information
$responses = SurveyResponse::getResponsesForSurvey($surveyId)
    ->withParticipants()
    ->get();

// Filter by dashboard filter data
$responses = SurveyResponse::getResponsesForSurvey($surveyId)
    ->ofDashboardFilterData($dashboardFilterData)
    ->get();

// Get answers with labels
$responses = SurveyResponse::getResponsesForSurvey($surveyId)
    ->withAnswersLabel($qid, $fieldName, $prefix, $type)
    ->get();
```

## Security Considerations
- **Data Access**: Implement proper authentication and authorization
- **SQL Injection**: Use parameterized queries for all database access
- **File Security**: Validate and secure chart image file paths
- **XSS Prevention**: Sanitize all user inputs and data before rendering
- **PDF Content**: Validate HTML content before PDF generation
- **Dynamic Table Names**: Always validate survey IDs before building dynamic table names

## Performance Optimization
1. **Caching**: Cache survey data and chart configurations
2. **Query Optimization**: Use efficient database queries with proper indexing
3. **Asynchronous Processing**: Generate large PDFs in background jobs
4. **Memory Management**: Monitor memory usage for large datasets
5. **Image Optimization**: Optimize chart images for PDF size

## Troubleshooting
Common issues and solutions:
- **Database Connection**: Verify LimeSurvey database connection settings
- **Chart Rendering**: Ensure JpGraph is properly installed and configured
- **PDF Generation**: Check HTML2PDF and Spatie PDF dependencies
- **Performance**: Optimize queries for large survey datasets
- **Memory Issues**: Monitor and adjust memory limits for large reports
- **Dynamic Tables**: Ensure survey IDs exist before accessing dynamic tables

## Related Modules
- [Quaeris Module](../Quaeris/docs/index.md) - Survey management and analysis
- [Chart Module](../Chart/docs/index.md) - Data visualization components
- [UI Module](../UI/docs/index.md) - User interface components
- [Xot Module](../Xot/docs/index.md) - Base infrastructure

## API Reference
For complete API documentation, refer to the official LimeSurvey documentation at https://api.limesurvey.org/