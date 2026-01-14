# LimeSurvey Module - Best Practices

This document outlines the best practices for working with the LimeSurvey module in the Quaeris Fila4 Mono project. Following these practices ensures optimal performance, security, and maintainability of the integration.

## Architecture Best Practices

### 1. Model Usage

Always use the appropriate models for database interactions:

```php
// ✅ CORRECT: Use dedicated models
use Modules\Limesurvey\Models\LimeSurvey;
use Modules\Limesurvey\Models\LimeQuestion;
use Modules\Limesurvey\Models\SurveyResponse;

// ✅ CORRECT: Use the base model structure
class CustomLimeModel extends \Modules\Limesurvey\Models\BaseModel
{
    protected $connection = 'limesurvey';
    protected $table = 'custom_table';
}
```

### 2. Dynamic Table Handling

Handle LimeSurvey's dynamic tables correctly:

```php
// ✅ CORRECT: Use SurveyResponse static method
$responses = SurveyResponse::getResponsesForSurvey($surveyId)
    ->where('submitdate', '>=', $date)
    ->get();

// ❌ AVOID: Direct table queries
$responses = DB::connection('limesurvey')
    ->table("lime_survey_{$surveyId}")
    ->get();
```

### 3. Model Relationships

Use Eloquent relationships appropriately:

```php
// ✅ CORRECT: Use defined relationships
$survey = LimeSurvey::with(['groups.questions.answers'])->first();

// ✅ CORRECT: Use tree relationships for questions
$questions = LimeQuestion::with('children')->get();

// ❌ AVOID: Manual joins when relationships exist
$questions = DB::table('lime_questions as q')
    ->join('lime_groups as g', 'q.gid', '=', 'g.gid')
    ->select('q.*', 'g.group_title')
    ->get();
```

## Performance Optimization

### 1. Query Optimization

#### Select Only Required Columns

```php
// ✅ CORRECT: Limit columns for wide tables
$responses = SurveyResponse::getResponsesForSurvey($surveyId)
    ->select(['id', 'submitdate', $fieldName])
    ->get();

// ❌ AVOID: SELECT * on wide tables (hundreds of columns)
$responses = SurveyResponse::getResponsesForSurvey($surveyId)->get();
```

#### Use Chunking for Large Datasets

```php
// ✅ CORRECT: Process large datasets in chunks
SurveyResponse::getResponsesForSurvey($surveyId)
    ->chunk(1000, function ($responses) {
        foreach ($responses as $response) {
            // Process each response
            $this->processResponse($response);
        }
    });
```

#### Proper Indexing

Ensure critical columns are indexed:

```php
// For survey response tables, ensure these are indexed:
// - submitdate (for date filtering)
// - token (for participant joins)
// - frequently filtered columns
```

### 2. Caching Strategies

#### Cache Survey Structure

```php
// ✅ CORRECT: Cache complex survey structures
$structure = Cache::remember(
    "limesurvey_structure_{$surveyId}_{$language}", 
    now()->addHours(1),
    function () use ($surveyId) {
        return $this->buildSurveyStructure($surveyId);
    }
);
```

#### Cache Expensive Operations

```php
// ✅ CORRECT: Cache analysis results
$analysis = Cache::remember(
    "survey_analysis_{$surveyId}_{$filterHash}",
    now()->addMinutes(30),
    function () use ($surveyId, $filterData) {
        return $this->analyzeSurvey($surveyId, $filterData);
    }
);
```

### 3. ETL Optimization

#### Optimize SurveyFlip Process

```php
// ✅ CORRECT: Chunk ETL operations
public function populateSurveyFlip($surveyId)
{
    $sourceTable = "lime_survey_{$surveyId}";
    
    DB::connection('limesurvey')
        ->table($sourceTable)
        ->select('*')
        ->chunk(500, function ($rows) use ($surveyId) {
            $this->transformAndInsert($rows, $surveyId);
        });
}
```

## Security Best Practices

### 1. Input Validation

Always validate user inputs:

```php
// ✅ CORRECT: Validate survey creation
public function createSurvey(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:200',
        'description' => 'nullable|string|max:1000',
        'language' => 'required|in:' . implode(',', $this->getSupportedLanguages()),
        'anonymized' => 'boolean',
        'expires' => 'nullable|date|after:now',
    ]);
    
    return LimeSurvey::create($validated);
}
```

### 2. Authorization

Implement proper authorization:

```php
// ✅ CORRECT: Check permissions before operations
public function viewSurvey(LimeSurvey $survey)
{
    $this->authorize('view', $survey);
    return view('survey.show', compact('survey'));
}

// ✅ CORRECT: Policy implementation
class LimeSurveyPolicy
{
    public function view(User $user, LimeSurvey $survey)
    {
        return $user->id === $survey->owner_id || $user->hasRole('admin');
    }
    
    public function update(User $user, LimeSurvey $survey)
    {
        return $user->id === $survey->owner_id || $user->hasRole('admin');
    }
}
```

### 3. SQL Injection Prevention

Use Eloquent and parameterized queries:

```php
// ✅ CORRECT: Eloquent query
$questions = LimeQuestion::where('sid', $surveyId)
    ->where('type', $type)
    ->get();

// ✅ CORRECT: Query builder with parameters
$questions = DB::connection('limesurvey')
    ->table('lime_questions')
    ->where('sid', $surveyId)
    ->get();

// ❌ AVOID: String concatenation
$questions = DB::connection('limesurvey')
    ->select("SELECT * FROM lime_questions WHERE sid = {$surveyId}");
```

## Data Management Best Practices

### 1. Dynamic Table Safety

Handle dynamic tables with care:

```php
// ✅ CORRECT: Check table existence before queries
public function getSurveyResponses($surveyId)
{
    $tableName = "lime_survey_{$surveyId}";
    
    if (!Schema::connection('limesurvey')->hasTable($tableName)) {
        Log::warning("Survey table does not exist: {$tableName}");
        return collect();
    }
    
    return SurveyResponse::getResponsesForSurvey($surveyId)->get();
}
```

### 2. Localization Handling

Properly handle multi-language content:

```php
// ✅ CORRECT: Use localization relationships
public function getLocalizedQuestion($questionId, $language = null)
{
    $language = $language ?: app()->getLocale();
    
    return LimeQuestion::with(['l10n' => function($query) use ($language) {
        $query->where('language', $language);
    }])->find($questionId);
}
```

### 3. Response Processing

Handle response data efficiently:

```php
// ✅ CORRECT: Use scope methods for filtering
public function getFilteredResponses($surveyId, $filterData)
{
    return SurveyResponse::getResponsesForSurvey($surveyId)
        ->ofDashboardFilterData($filterData)
        ->withAnswersLabel($filterData->questionId, $filterData->fieldName)
        ->get();
}
```

## Error Handling Best Practices

### 1. Database Connection Errors

Handle database errors gracefully:

```php
// ✅ CORRECT: Comprehensive error handling
public function getSurveyData($surveyId)
{
    try {
        $responses = SurveyResponse::getResponsesForSurvey($surveyId)->get();
    } catch (QueryException $e) {
        Log::error('Database error retrieving survey responses', [
            'survey_id' => $surveyId,
            'error' => $e->getMessage(),
            'connection' => $e->getConnection()->getName()
        ]);
        
        // Return empty collection or throw custom exception
        return collect();
    }
    
    return $responses;
}
```

### 2. Missing Survey Tables

Handle missing dynamic tables:

```php
// ✅ CORRECT: Graceful handling of missing tables
public function processSurvey($surveyId)
{
    if (!$this->surveyTableExists($surveyId)) {
        Log::info("Survey {$surveyId} has no response table, skipping processing");
        return false;
    }
    
    // Continue with processing
    return $this->performSurveyProcessing($surveyId);
}
```

## Testing Best Practices

### 1. Unit Tests

Write comprehensive unit tests:

```php
// ✅ CORRECT: Test survey creation
public function test_survey_creation()
{
    $data = [
        'title' => 'Test Survey',
        'active' => 'Y',
        'anonymized' => 'Y'
    ];
    
    $survey = LimeSurvey::create($data);
    
    $this->assertDatabaseHas('lime_surveys', [
        'title' => 'Test Survey',
        'active' => 'Y'
    ]);
}

// ✅ CORRECT: Test response retrieval
public function test_survey_response_retrieval()
{
    $surveyId = '12345';
    
    // Use database transactions to avoid side effects
    $responses = SurveyResponse::getResponsesForSurvey($surveyId)->get();
    
    $this->assertIsCollection($responses);
}
```

### 2. Integration Tests

Test the full integration:

```php
// ✅ CORRECT: Test full survey workflow
public function test_full_survey_workflow()
{
    // Create survey
    $survey = $this->createTestSurvey();
    
    // Add questions
    $this->addTestQuestions($survey);
    
    // Collect responses
    $this->collectTestResponses($survey);
    
    // Verify results
    $this->verifySurveyResults($survey);
    
    // Clean up
    $this->cleanupTestSurvey($survey);
}
```

## Maintenance Best Practices

### 1. Regular Monitoring

Monitor system performance:

```php
// ✅ CORRECT: Performance monitoring
public function monitorSurveyPerformance($surveyId)
{
    $responseCount = SurveyResponse::getResponsesForSurvey($surveyId)->count();
    $avgResponseTime = $this->getAverageResponseTime($surveyId);
    $errorRate = $this->getErrorRate($surveyId);
    
    // Log metrics for monitoring
    Log::info('Survey performance metrics', [
        'survey_id' => $surveyId,
        'response_count' => $responseCount,
        'avg_response_time' => $avgResponseTime,
        'error_rate' => $errorRate
    ]);
}
```

### 2. Backup and Recovery

Implement proper backup strategies:

```php
// ✅ CORRECT: Backup critical survey data
public function backupSurveyData($surveyId)
{
    $survey = LimeSurvey::find($surveyId);
    $questions = LimeQuestion::where('sid', $surveyId)->get();
    $responses = SurveyResponse::getResponsesForSurvey($surveyId)->get();
    
    // Store backup in secure location
    $backupData = [
        'survey' => $survey,
        'questions' => $questions,
        'responses' => $responses,
        'timestamp' => now()
    ];
    
    Storage::disk('secure-backup')->put("survey_{$surveyId}_backup.json", 
        json_encode($backupData));
}
```

## Development Workflow

### 1. Code Structure

Follow Laravel and module conventions:

```php
// ✅ CORRECT: Follow module structure
namespace Modules\Limesurvey\Actions;

use Modules\Xot\Actions\Action;

class ProcessSurveyResponseAction extends Action
{
    public function handle($surveyId, $responseData)
    {
        // Implementation here
    }
}
```

### 2. Documentation

Maintain comprehensive documentation:

```php
/**
 * Process survey responses and update analytics
 * 
 * This method handles the complete response processing workflow:
 * 1. Validates the response data
 * 2. Saves to the appropriate dynamic table
 * 3. Updates the SurveyFlip ETL table
 * 4. Updates dashboard analytics
 * 
 * @param int $surveyId The survey identifier
 * @param array $responseData The response data to process
 * @return bool True if processing was successful
 * @throws ValidationException If response data is invalid
 */
public function processResponse($surveyId, array $responseData)
{
    // Implementation
}
```

### 3. Version Control

Follow Git workflow for module changes:

```bash
# ✅ CORRECT: Follow proper branching strategy
git checkout -b feature/limesurvey-analytics-enhancement
# Make changes
git add .
git commit -m "feat(limesurvey): Add enhanced analytics for survey responses"
git push origin feature/limesurvey-analytics-enhancement
```

## Common Pitfalls to Avoid

### 1. Performance Issues

- ❌ Don't use `SELECT *` on dynamic survey tables
- ❌ Don't perform N+1 queries when accessing related data
- ❌ Don't ignore database index optimization
- ❌ Don't process large datasets without chunking

### 2. Security Issues

- ❌ Don't skip input validation
- ❌ Don't bypass authorization checks
- ❌ Don't use raw SQL without parameterization
- ❌ Don't expose sensitive survey data without proper access controls

### 3. Data Integrity

- ❌ Don't directly modify LimeSurvey tables without understanding constraints
- ❌ Don't assume table existence without checking
- ❌ Don't ignore localization requirements
- ❌ Don't process responses without validation

## Monitoring and Observability

### 1. Logging

Implement comprehensive logging:

```php
// ✅ CORRECT: Log important operations
Log::info('Processing survey responses', [
    'survey_id' => $surveyId,
    'response_count' => count($responses),
    'start_time' => now()
]);

Log::debug('Survey processing step', [
    'step' => 'validation',
    'status' => 'completed',
    'duration' => $duration
]);
```

### 2. Metrics

Track important metrics:

```php
// ✅ CORRECT: Track performance metrics
public function trackSurveyMetrics($surveyId, $processingTime)
{
    // Use your preferred metrics system (Prometheus, StatsD, etc.)
    Metrics::gauge('limesurvey.response.processing_time', $processingTime, [
        'survey_id' => $surveyId
    ]);
    
    Metrics::increment('limesurvey.responses.processed', 1, [
        'survey_id' => $surveyId
    ]);
}
```

By following these best practices, you'll ensure that your LimeSurvey module implementations are robust, performant, secure, and maintainable.