# LimeSurvey Survey Flip Approach

## Overview
The LimeSurvey Survey Flip approach is an innovative method for handling LimeSurvey data that transforms the traditional dynamic table approach into a more flexible Entity-Attribute-Value (EAV) structure. Instead of creating separate tables for each survey (`lime_survey_{SID}`), the system uses a single `survey_flip_responses` table that stores responses in a normalized EAV format.

## Architecture

### Traditional Approach vs Flip Approach
- **Traditional**: Creates dynamic tables `lime_survey_{SID}` for each survey
- **Flip Approach**: Uses single `survey_flip_responses` table with EAV structure

### SurveyFlipResponse Model Structure
```php
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
}
```

### Key Differences from Dynamic Models

| Aspect | Dynamic Models (SurveyResponse) | Flip Approach (SurveyFlipResponse) |
|--------|---------------------------------|-----------------------------------|
| Table Structure | Dynamic per survey (`lime_survey_{SID}`) | Single EAV table (`survey_flip_responses`) |
| Data Access | `SurveyResponse::getResponsesForSurvey($surveyId)` | Direct query on single table with survey_id filter |
| Field Names | Original LimeSurvey field names | Standardized EAV structure |
| Scalability | Limited by number of tables | Unlimited by single table |
| Query Performance | Requires dynamic table access | Standardized queries |

## Survey Flip Implementation Details

### Data Transformation Process
The flip approach works by taking data from the traditional LimeSurvey dynamic tables and transforming it into the EAV structure:

```php
// Example transformation process
$originalResponses = DB::table("lime_survey_{$surveyId}")->get();

foreach ($originalResponses as $originalResponse) {
    // Extract each field from the original response
    foreach ($originalResponse as $field => $value) {
        if ($this->isQuestionField($field)) {
            // Parse the field name (e.g., 123456X12X88)
            $parsed = $this->parseFieldName($field);
            
            SurveyFlipResponse::create([
                'survey_id' => $parsed['survey_id'],
                'question_id' => $parsed['question_id'],
                'question_type' => $this->getQuestionType($parsed['question_id']),
                'answer' => $value,
                'value' => $this->getProcessedValue($value, $parsed['question_id']),
                'submitdate' => $originalResponse->submitdate,
                'fieldname' => $field,
                'old_id' => $originalResponse->id,
                'token' => $originalResponse->token ?? null,
            ]);
        }
    }
}
```

### Benefits of the Flip Approach

1. **Simplified Queries**: No need to dynamically access different tables
2. **Better Performance**: Single table with proper indexing
3. **Scalability**: No limit on number of surveys
4. **Consistent Structure**: Uniform data access patterns
5. **Easier Analytics**: Standardized data structure for reporting

### Field Name Parsing
The flip approach handles the complex LimeSurvey field naming convention:

```php
// LimeSurvey field name: {SID}X{GID}X{QID}[subquestion_suffix]
// Example: 123456X12X88 (survey 123456, group 12, question 88)
// Example: 123456X12X88_SQ001 (sub-question)
```

### Question Field Detection
```php
private function isQuestionField(string $field): bool
{
    // Fields that are NOT question fields:
    $nonQuestionFields = [
        'id', 'submitdate', 'lastpage', 'startlanguage', 'token'
    ];
    
    return !in_array($field, $nonQuestionFields) && 
           preg_match('/^\d+X\d+X\d+/', $field);
}
```

## Database Schema

### survey_flip_responses Table Structure
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

## Usage Patterns

### Querying Flip Response Data
```php
// Get all responses for a specific survey
$responses = SurveyFlipResponse::where('survey_id', '123456')->get();

// Get responses for a specific question
$questionResponses = SurveyFlipResponse::where('survey_id', '123456')
    ->where('question_id', '88')
    ->get();

// Get responses with date filtering
$dateFiltered = SurveyFlipResponse::where('survey_id', '123456')
    ->whereBetween('submitdate', [$startDate, $endDate])
    ->get();

// Get responses with answer filtering
$filtered = SurveyFlipResponse::where('survey_id', '123456')
    ->where('answer', 'specific_answer')
    ->get();
```

### Using with Scopes
```php
use Modules\Quaeris\Datas\AnswersFilterData;

// Using the ofFilterData scope
$filter = new AnswersFilterData([
    'date_from' => '2023-01-01',
    'date_to' => '2023-12-31',
    'question_filter' => '123456X12X88'
]);

$responses = SurveyFlipResponse::ofFilterData($filter)->get();

// Using the ofDashboardFilterData scope
$dashboardFilter = new DashboardFilterData([
    'startDate' => '2023-01-01',
    'endDate' => '2023-12-31',
    'question_filter' => 'specific_value',
    'question_filter_fieldname' => '123456X12X88'
]);

$responses = SurveyFlipResponse::ofDashboardFilterData($dashboardFilter)->get();
```

### Alert Dashboard Filtering
```php
use Modules\Quaeris\Datas\AlertDashboardFilterData;

// Using the ofAlertDashboardFilterData scope for numerical analysis
$alertFilter = new AlertDashboardFilterData([
    'min_value' => 5,
    'max_value' => 10,
    'startDate' => '2023-01-01',
    'endDate' => '2023-12-31'
]);

$numericalResponses = SurveyFlipResponse::ofAlertDashboardFilterData($alertFilter)
    ->get();
```

## Integration with Other Components

### Chart Generation with Flip Data
```php
class FlipChartGenerator
{
    public function getChartData(string $surveyId, string $questionId): array
    {
        $responses = SurveyFlipResponse::where('survey_id', $surveyId)
            ->where('question_id', $questionId)
            ->select([
                'answer as label',
                DB::raw('COUNT(*) as count')
            ])
            ->groupBy('answer')
            ->orderBy('count', 'desc')
            ->get();
            
        $total = $responses->sum('count');
        
        return [
            'labels' => $responses->pluck('label')->toArray(),
            'values' => $responses->pluck('count')->toArray(),
            'data_table' => $responses->map(function($item) use ($total) {
                return [
                    'label' => $item->label,
                    'count' => $item->count,
                    'percentage' => $total > 0 ? round(($item->count / $total) * 100, 2) : 0
                ];
            })->toArray()
        ];
    }
}
```

### PDF Generation with Flip Data
```php
class FlipPdfGenerator
{
    public function generatePdfWithFlipData(string $surveyId, array $questionIds, array $options = []): string
    {
        $chartGenerator = new JpGraphGenerator();
        $chartImages = [];
        
        foreach ($questionIds as $questionId) {
            $chartData = $this->getChartData($surveyId, $questionId);
            
            $graph = new \Graph(800, 400);
            $graph->SetScale('textlin');
            $graph->title->Set("Question {$questionId} - Survey {$surveyId}");
            
            $plot = new \BarPlot($chartData['values']);
            $plot->SetFillColor('#3b82f6');
            $plot->value->Show();
            $plot->value->SetFormat('%.0f');
            
            $graph->xaxis->SetTickLabels($chartData['labels']);
            if (count($chartData['labels']) > 5) {
                $graph->xaxis->SetLabelAngle(45);
            }
            
            $graph->Add($plot);
            
            $filename = 'charts/flip_chart_' . $surveyId . '_' . $questionId . '_' . time() . '.png';
            $fullPath = public_path($filename);
            
            $dir = dirname($fullPath);
            if (!file_exists($dir)) {
                mkdir($dir, 0755, true);
            }
            
            $graph->Stroke($fullPath);
            $chartImages[] = $filename;
        }
        
        // Generate PDF with charts
        $html = $this->buildPdfHtml($surveyId, $chartData, $chartImages);
        
        $html2pdf = new Html2Pdf('L', 'A4', 'en');
        $html2pdf->setTestIsImage(true);
        $html2pdf->setDefaultFont('Arial');
        $html2pdf->writeHTML($html);
        
        $filename = 'flip_survey_report_' . $surveyId . '_' . date('Y-m-d') . '.pdf';
        $path = storage_path('app/flip_reports/' . $filename);
        $html2pdf->output($path, 'F');
        
        $this->cleanupTempImages($chartImages);
        
        return $path;
    }
}
```

## Performance Considerations

### Indexing Strategy
For optimal performance with the flip approach, the following indexes are recommended:

```sql
-- Primary index for survey-based queries
CREATE INDEX idx_survey_flip_survey_id ON survey_flip_responses(survey_id);

-- Composite index for date-based filtering
CREATE INDEX idx_survey_flip_survey_date ON survey_flip_responses(survey_id, submitdate);

-- Composite index for question-based queries
CREATE INDEX idx_survey_flip_survey_question ON survey_flip_responses(survey_id, question_id);

-- Index for numerical answer filtering
CREATE INDEX idx_survey_flip_answer_numeric ON survey_flip_responses(survey_id, answer) 
WHERE answer ~ '^[0-9]+$';

-- Full-text search index for answer values
CREATE INDEX idx_survey_flip_answer_gin ON survey_flip_responses USING gin(to_tsvector('english', answer));
```

### Query Optimization
```php
class OptimizedFlipQuery
{
    public function getAggregatedData(string $surveyId, array $questionIds = []): Collection
    {
        $query = SurveyFlipResponse::select([
            'question_id',
            'answer',
            DB::raw('COUNT(*) as count'),
            DB::raw('COUNT(*) * 100.0 / SUM(COUNT(*)) OVER (PARTITION BY question_id) as percentage')
        ])
        ->where('survey_id', $surveyId)
        ->whereNotNull('answer')
        ->groupBy('question_id', 'answer')
        ->orderBy('question_id')
        ->orderBy('count', 'desc');
        
        if (!empty($questionIds)) {
            $query->whereIn('question_id', $questionIds);
        }
        
        return $query->get();
    }
}
```

## Migration from Traditional Approach

### Data Migration Process
```php
class MigrateToFlipAction
{
    public function execute(string $surveyId): void
    {
        // Get data from traditional dynamic table
        $dynamicResponses = DB::table("lime_survey_{$surveyId}")->get();
        
        foreach ($dynamicResponses as $response) {
            $this->processResponse($response, $surveyId);
        }
    }
    
    private function processResponse($response, string $surveyId): void
    {
        foreach ($response as $field => $value) {
            if ($this->isQuestionField($field)) {
                $parsed = $this->parseFieldName($field);
                
                SurveyFlipResponse::create([
                    'survey_id' => $surveyId,
                    'question_id' => $parsed['question_id'],
                    'question_type' => $this->getQuestionType($parsed['question_id']),
                    'answer' => $value,
                    'value' => $this->getProcessedValue($value, $parsed['question_id']),
                    'submitdate' => $response->submitdate,
                    'fieldname' => $field,
                    'old_id' => $response->id,
                    'token' => $response->token ?? null,
                ]);
            }
        }
    }
}
```

## Security Considerations
- **Data Access**: Implement proper authentication and authorization
- **SQL Injection**: Use parameterized queries for all database access
- **Field Validation**: Validate field names and survey IDs
- **Data Integrity**: Ensure data consistency during migration
- **Performance**: Monitor query performance with large datasets

## Best Practices
1. **Indexing**: Ensure proper indexes on frequently queried columns
2. **Caching**: Cache aggregated results for better performance
3. **Pagination**: Use pagination for large result sets
4. **Data Validation**: Validate data during migration and insertion
5. **Monitoring**: Monitor performance and query execution times
6. **Backup**: Always backup data before migration operations

## Troubleshooting
Common issues and solutions:
- **Performance Issues**: Verify proper indexing and query optimization
- **Data Inconsistencies**: Check field name parsing and data transformation
- **Migration Failures**: Validate source data before migration
- **Query Errors**: Ensure proper survey ID validation
- **Memory Issues**: Use chunking for large data operations

## Related Documentation
- [LimeSurvey Database Schema](./database-schema.md) - Traditional database structure
- [Quaeris Module Documentation](../../Quaeris/docs/index.md) - Survey management and analysis
- [Chart Module Documentation](../../Chart/docs/index.md) - Data visualization components
- [UI Module Documentation](../../UI/docs/index.md) - User interface components