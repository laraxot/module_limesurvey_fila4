# LimeSurvey Integration Complete Guide

## Overview
This comprehensive guide covers the complete integration between the Laraxot system and LimeSurvey, including both the traditional dynamic model approach and the innovative flip approach. This documentation serves as a complete reference for developers working with survey data analysis, chart generation, and PDF reporting.

## Architecture Overview

### Traditional Dynamic Model Approach
The traditional approach uses dynamic models that directly access LimeSurvey's dynamic table structure:

- `SurveyResponse` model accesses `lime_survey_{SID}` tables
- Direct field access using LimeSurvey's naming convention: `{SID}X{GID}X{QID}`
- Requires dynamic table name setting based on survey ID
- Best for direct access to original LimeSurvey format

### Flip Approach (EAV Structure)
The flip approach implements an Entity-Attribute-Value structure:

- `SurveyFlipResponse` model accesses single `survey_flip_responses` table
- Standardized EAV structure with survey_id, question_id, answer, value
- Better for analytics, cross-survey queries, and complex reporting
- More flexible for mathematical operations and alert systems

## Database Structure Comparison

### Traditional Approach Tables
- `lime_surveys` - Static metadata table
- `lime_questions` - Static questions table
- `lime_survey_{SID}` - Dynamic response tables (one per survey)
- Field names follow: `{SID}X{GID}X{QID}` pattern

### Flip Approach Table
- `survey_flip_responses` - Single EAV table with:
  - `survey_id` - Original survey ID
  - `question_id` - Original question ID
  - `answer` - Raw answer value
  - `value` - Processed value (often from answer labels)
  - `fieldname` - Original field name for reference

## Implementation Patterns

### 1. SurveyResponse Model (Traditional)
```php
// Accessing data with dynamic model
$responses = SurveyResponse::getResponsesForSurvey($surveyId)
    ->select([
        DB::raw("{$fieldName} as answer"),
        DB::raw('COUNT(*) as count')
    ])
    ->whereNotNull($fieldName)
    ->groupBy($fieldName)
    ->get();
```

### 2. SurveyFlipResponse Model (Flip)
```php
// Accessing data with flip model
$responses = SurveyFlipResponse::where('survey_id', $surveyId)
    ->where('question_id', $questionId)
    ->select([
        'answer',
        DB::raw('COUNT(*) as count')
    ])
    ->whereNotNull('answer')
    ->groupBy('answer')
    ->get();
```

## Chart Generation Patterns

### 1. Traditional Approach Chart Generation
```php
class TraditionalChartService
{
    public function generateChart(string $surveyId, string $fieldName, Chart $chart): string
    {
        $data = $this->getTraditionalData($surveyId, $fieldName);
        
        $graph = $this->createGraph($chart, $data['labels']);
        $plot = new \BarPlot($data['values']);
        $plot->SetFillColor($chart->list_color ?? '#3b82f6');
        
        $graph->Add($plot);
        
        $filename = 'charts/traditional_' . $chart->id . '.png';
        $graph->Stroke(public_path($filename));
        
        return $filename;
    }
    
    private function getTraditionalData(string $surveyId, string $fieldName): array
    {
        $responses = SurveyResponse::getResponsesForSurvey($surveyId)
            ->select([
                DB::raw("{$fieldName} as answer"),
                DB::raw('COUNT(*) as count')
            ])
            ->whereNotNull($fieldName)
            ->groupBy($fieldName)
            ->orderBy('count', 'desc')
            ->get();
            
        return [
            'labels' => $responses->pluck('answer')->toArray(),
            'values' => $responses->pluck('count')->toArray()
        ];
    }
}
```

### 2. Flip Approach Chart Generation
```php
class FlipChartService
{
    public function generateChart(string $surveyId, string $questionId, Chart $chart): string
    {
        $data = $this->getFlipData($surveyId, $questionId);
        
        $graph = $this->createGraph($chart, $data['labels']);
        $plot = new \BarPlot($data['values']);
        $plot->SetFillColor($chart->list_color ?? '#ef4444');
        
        $graph->Add($plot);
        
        $filename = 'charts/flip_' . $chart->id . '.png';
        $graph->Stroke(public_path($filename));
        
        return $filename;
    }
    
    private function getFlipData(string $surveyId, string $questionId): array
    {
        $responses = SurveyFlipResponse::where('survey_id', $surveyId)
            ->where('question_id', $questionId)
            ->select([
                'answer',
                DB::raw('COUNT(*) as count')
            ])
            ->whereNotNull('answer')
            ->groupBy('answer')
            ->orderBy('count', 'desc')
            ->get();
            
        return [
            'labels' => $responses->pluck('answer')->toArray(),
            'values' => $responses->pluck('count')->toArray()
        ];
    }
}
```

## PDF Generation with Both Approaches

### Multi-Engine PDF Service
```php
class MultiApproachPdfService
{
    public function generatePdf(
        array $chartConfigs,
        string $surveyId,
        string $approach = 'traditional',
        string $engine = 'html2pdf'
    ): \Symfony\Component\HttpFoundation\BinaryFileResponse {
        switch ($engine) {
            case 'spatie':
                return $this->generateWithSpatie($chartConfigs, $surveyId, $approach);
            case 'html2pdf':
            default:
                return $this->generateWithHtml2Pdf($chartConfigs, $surveyId, $approach);
        }
    }
    
    private function generateWithHtml2Pdf(array $chartConfigs, string $surveyId, string $approach): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $chartService = $approach === 'flip' ? 
            new FlipChartService() : 
            new TraditionalChartService();
        
        $chartImages = [];
        foreach ($chartConfigs as $config) {
            $imagePath = $approach === 'flip' ?
                $chartService->generateChart($surveyId, $config['question_id'], $config['chart']) :
                $chartService->generateChart($surveyId, $config['field_name'], $config['chart']);
            
            $chartImages[] = $imagePath;
        }
        
        $html = $this->buildPdfHtml($chartConfigs, $chartImages, $approach);
        
        $html2pdf = new Html2Pdf('L', 'A4', 'en');
        $html2pdf->setTestIsImage(true);
        $html2pdf->setDefaultFont('Arial');
        $html2pdf->writeHTML($html);
        
        $filename = 'survey_report_' . $surveyId . '_' . $approach . '_' . date('Y-m-d') . '.pdf';
        $path = storage_path('app/reports/' . $filename);
        $html2pdf->output($path, 'F');
        
        $this->cleanupTempImages($chartImages);
        
        return response()->download($path);
    }
    
    private function buildPdfHtml(array $chartConfigs, array $chartImages, string $approach): string
    {
        $html = '<page backtop="20mm" backbottom="20mm" backleft="15mm" backright="15mm">';
        $html .= '<h1 style="text-align: center; font-size: 18pt; margin-bottom: 10px;">Survey Report - ' . ucfirst($approach) . ' Approach</h1>';
        $html .= '<p style="text-align: center; margin-bottom: 20px;">Survey ID: ' . e($surveyId) . ' | Generated: ' . date('F j, Y \a\t g:i A') . '</p>';
        
        foreach ($chartConfigs as $index => $config) {
            if (isset($chartImages[$index])) {
                $html .= '<div style="margin: 20px 0; page-break-inside: avoid;">';
                $html .= '<h2 style="font-size: 14pt; margin-bottom: 10px;">' . e($config['title']) . '</h2>';
                $html .= '<img src="' . public_path($chartImages[$index]) . '" style="width: 100%; height: auto; border: 1px solid #ddd;">';
                $html .= '</div>';
            }
        }
        
        $html .= '</page>';
        
        return $html;
    }
}
```

## Performance Optimization Strategies

### 1. Indexing for Traditional Approach
```sql
-- Indexes for lime_survey_{SID} tables (applied per survey)
CREATE INDEX idx_submitdate ON lime_survey_{SID}(submitdate);
CREATE INDEX idx_fieldname ON lime_survey_{SID}({fieldname});
```

### 2. Indexing for Flip Approach
```sql
-- Primary indexes for survey_flip_responses
CREATE INDEX idx_survey_flip_survey_id ON survey_flip_responses(survey_id);
CREATE INDEX idx_survey_flip_survey_question ON survey_flip_responses(survey_id, question_id);
CREATE INDEX idx_survey_flip_survey_date ON survey_flip_responses(survey_id, submitdate);
CREATE INDEX idx_survey_flip_answer ON survey_flip_responses(survey_id, question_id, answer);
```

### 3. Caching Strategies
```php
class CachedChartService
{
    public function getChartData(string $surveyId, string $identifier, string $approach, array $options = []): array
    {
        $cacheKey = "chart_{$approach}_{$surveyId}_{$identifier}_" . md5(serialize($options));
        $ttl = now()->addMinutes(30);
        
        return Cache::remember($cacheKey, $ttl, function() use ($surveyId, $identifier, $approach, $options) {
            return $approach === 'flip' ?
                $this->getFlipData($surveyId, $identifier, $options) :
                $this->getTraditionalData($surveyId, $identifier, $options);
        });
    }
}
```

## Migration Between Approaches

### Migration Action
```php
class MigrateSurveyToFlipAction
{
    public function execute(string $surveyId): void
    {
        // Get original responses from dynamic table
        $originalResponses = SurveyResponse::getResponsesForSurvey($surveyId)->get();
        
        foreach ($originalResponses as $response) {
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
    
    private function isQuestionField(string $field): bool
    {
        return preg_match('/^\d+X\d+X\d+/', $field);
    }
    
    private function parseFieldName(string $field): array
    {
        // Parse {SID}X{GID}X{QID} format
        $parts = explode('X', $field);
        return [
            'survey_id' => $parts[0],
            'group_id' => $parts[1],
            'question_id' => $parts[2] ?? null
        ];
    }
}
```

## Best Practices

### 1. When to Use Traditional Approach
- Direct access to LimeSurvey's native data structure
- Performance-critical operations on single surveys
- Compatibility with existing LimeSurvey integrations
- Simple reporting that matches LimeSurvey's original format

### 2. When to Use Flip Approach
- Cross-survey analytics and reporting
- Complex mathematical operations on responses
- Alert systems with threshold monitoring
- Standardized data access patterns
- Scalability with large numbers of surveys

### 3. Hybrid Approach Benefits
- Leverage strengths of both approaches
- Migrate incrementally from traditional to flip
- Maintain compatibility during transition
- Optimize for specific use cases

## Security Considerations
- Validate survey IDs before accessing dynamic tables
- Sanitize field names to prevent SQL injection
- Implement proper authentication for all access patterns
- Use parameterized queries for all database operations
- Validate data during migration between approaches

## Troubleshooting
- **Performance Issues**: Check proper indexing for both approaches
- **Data Inconsistencies**: Validate field name parsing and data transformation
- **Migration Failures**: Ensure data integrity during migration operations
- **Query Errors**: Verify proper survey ID and question ID validation
- **Memory Issues**: Use chunking for large data operations in both approaches

## Related Documentation
- [LimeSurvey Module Documentation](./Modules/Limesurvey/docs/index.md)
- [Quaeris Module Documentation](./Modules/Quaeris/docs/index.md)
- [Chart Module Documentation](./Modules/Chart/docs/index.md)
- [UI Module Documentation](./Modules/UI/docs/index.md)
- [Survey Flip Approach Details](./Modules/Limesurvey/docs/survey-flip-approach.md)
