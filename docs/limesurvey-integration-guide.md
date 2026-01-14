# LimeSurvey Integration Guide

This guide provides detailed instructions for integrating with the LimeSurvey platform through the Limesurvey module in the Quaeris Fila4 Mono project.

## Overview of LimeSurvey Integration

LimeSurvey is an open-source online survey application that allows users to create and manage surveys. The Limesurvey module provides a comprehensive integration layer between the Laravel-based Quaeris platform and the LimeSurvey system, enabling advanced survey creation, distribution, and analysis capabilities.

### Key Integration Points

1. **Database Integration**: Direct access to the LimeSurvey database schema
2. **API Integration**: Remote Control 2 API for programmatic operations
3. **Dynamic Table Handling**: Support for LimeSurvey's dynamic table creation
4. **Real-time Synchronization**: ETL pipeline for data transformation

## Database Architecture

The integration relies on the `quaeris_survey` database, which mirrors the LimeSurvey database structure.

### Static Tables (Configuration)

These tables exist permanently and store survey configuration:

- `lime_surveys`: Survey configurations (62 columns)
- `lime_groups`: Question groups/pages structure
- `lime_questions`: Question definitions with tree support
- `lime_answers`: Answer options for closed questions
- `lime_participants`: Central participant database

### Dynamic Tables (Data)

LimeSurvey creates dynamic tables when surveys are activated:

- `lime_survey_{SID}`: Response data for specific surveys
- `lime_tokens_{SID}`: Participant tracking for specific surveys
- `lime_survey_{SID}_timings`: Timing data for response completion

## Integration Patterns

### 1. Survey Creation and Management

```php
use Modules\Limesurvey\Models\LimeSurvey;

// Create a new survey in LimeSurvey
$survey = new LimeSurvey();
$survey->title = 'Customer Satisfaction Survey';
$survey->active = 'Y';
$survey->anonymized = 'Y';
$survey->save();

// Add groups to the survey
$group = new \Modules\Limesurvey\Models\LimeGroup();
$group->sid = $survey->sid;
$group->group_title = 'Introduction';
$group->save();

// Add questions to the group
$question = new \Modules\Limesurvey\Models\LimeQuestion();
$question->sid = $survey->sid;
$question->gid = $group->gid;
$question->type = 'T'; // Text input
$question->title = 'customer_name';
$question->question = 'What is your name?';
$question->save();
```

### 2. Response Data Access

The module provides optimized access to response data through the `SurveyResponse` model:

```php
use Modules\Limesurvey\Models\SurveyResponse;

// Get responses for a specific survey
$responses = SurveyResponse::getResponsesForSurvey($surveyId)
    ->withAnswersLabel($questionId, $fieldName)
    ->get();

// Apply dashboard filters
$responses = SurveyResponse::getResponsesForSurvey($surveyId)
    ->ofDashboardFilterData($filterData)
    ->get();

// Get responses with participant information
$responses = SurveyResponse::getResponsesForSurvey($surveyId)
    ->withParticipants()
    ->get();
```

### 3. Dynamic Model Generation

The module handles LimeSurvey's dynamic table structure:

```php
use Modules\Limesurvey\Actions\GetParticipantModelBySurveyIdAction;

// Get the dynamic tokens model for a specific survey
$tokenModelClass = app(GetParticipantModelBySurveyIdAction::class)
    ->execute($surveyId);

// Use the dynamic model
$tokens = $tokenModelClass::query()->get();
```

## ETL (ETL) Strategy: SurveyFlip

Due to LimeSurvey's dynamic table structure, the module implements a "SurveyFlip" strategy:

### Extract
- Read responses from `lime_survey_{SID}` tables using direct DB queries
- Handle wide table structures efficiently

### Transform
- Map dynamic column names (`{SID}X{GID}X{QID}`) to meaningful question definitions
- Normalize response data into a consistent format

### Load
- Insert transformed data into static `survey_flip_responses` table
- Enable standard Eloquent relationships and reporting

```php
use Modules\Limesurvey\Actions\PopulateSurveyFlipBySurveyIdAction;

// Execute the ETL process for a survey
app(PopulateSurveyFlipBySurveyIdAction::class)
    ->execute($surveyId);
```

## API Integration (RemoteControl 2)

The integration supports LimeSurvey's RemoteControl 2 API:

```php
// Example API interaction (conceptual)
$sessionKey = $limeSurveyAPI->get_session_key($username, $password);

// Export responses
$responses = $limeSurveyAPI->export_responses(
    $sessionKey, 
    $surveyId, 
    'csv', 
    $language = 'en', 
    $completionStatus = 'all',
    $headingType = 'code',
    $responseType = 'short'
);

$limeSurveyAPI->release_session_key($sessionKey);
```

## Localization Support

LimeSurvey 3.x+ uses normalized localization tables:

- `lime_survey_l10ns`
- `lime_group_l10ns`
- `lime_question_l10ns`
- `lime_answer_l10ns`

The module properly joins these tables to retrieve localized content:

```php
// Get localized question content
$question = LimeQuestion::with('l10n')
    ->where('language', app()->getLocale())
    ->first();
```

## Performance Optimizations

### 1. Caching Strategy

```php
// Cache survey structure for improved performance
Cache::remember("limesurvey_structure_{$surveyId}_{$language}", 
    now()->addHours(1), 
    function() use ($surveyId) {
        return $this->getSurveyStructure($surveyId);
    }
);
```

### 2. Query Optimization

```php
// Use optimized scope methods
SurveyResponse::getResponsesForSurvey($surveyId)
    ->select(['id', 'submitdate', $fieldName]) // Limit columns
    ->where('submitdate', '>=', $date)
    ->chunk(1000, function ($responses) {
        // Process in chunks for large datasets
    });
```

### 3. Index Management

Ensure proper indexing on:
- `lime_survey_{SID}` tables: `submitdate`, `token` columns
- Static tables: Foreign key columns
- Frequently queried columns

## Security Considerations

### 1. Input Validation

```php
// Always validate survey inputs
$request->validate([
    'title' => 'required|string|max:200',
    'description' => 'nullable|string',
    'language' => 'required|in:en,it,de,fr,es' // Supported languages
]);
```

### 2. Authorization

The module implements proper authorization using Laravel policies:

```php
// Check if user can access survey
Gate::allows('view', $limeSurvey);
Gate::allows('update', $limeSurvey);
Gate::allows('delete', $limeSurvey);
```

### 3. SQL Injection Prevention

Use Eloquent ORM and parameterized queries:

```php
// Safe - uses Eloquent
$questions = LimeQuestion::where('sid', $surveyId)->get();

// Safe - uses query builder with parameters
$questions = DB::table('lime_questions')
    ->where('sid', $surveyId)
    ->get();
```

## Error Handling and Logging

### 1. Database Connection Errors

```php
try {
    $responses = SurveyResponse::getResponsesForSurvey($surveyId)->get();
} catch (\Illuminate\Database\QueryException $e) {
    Log::error('LimeSurvey database error', [
        'survey_id' => $surveyId,
        'error' => $e->getMessage()
    ]);
    throw new \Exception('Unable to retrieve survey responses');
}
```

### 2. Survey Not Found

```php
$survey = LimeSurvey::find($surveyId);
if (!$survey) {
    throw new \Illuminate\Database\Eloquent\ModelNotFoundException(
        "Survey with ID {$surveyId} not found"
    );
}
```

## Testing and Quality Assurance

### 1. Unit Tests

```php
public function test_survey_response_retrieval()
{
    $surveyId = '12345';
    
    // Mock survey response data
    SurveyResponse::fake([
        $surveyId => collect([
            ['id' => 1, 'submitdate' => now(), 'token' => 'ABC123']
        ])
    ]);
    
    $responses = SurveyResponse::getResponsesForSurvey($surveyId)->get();
    
    $this->assertCount(1, $responses);
}
```

### 2. Integration Tests

```php
public function test_full_survey_workflow()
{
    // Test complete workflow: create survey → add questions → collect responses
    $survey = $this->createTestSurvey();
    $this->addTestQuestions($survey);
    $this->collectTestResponses($survey);
    $this->analyzeSurveyResults($survey);
}
```

## Troubleshooting Common Issues

### 1. Dynamic Table Not Found

**Issue**: `SQLSTATE[42S02]: Base table or view not found: 1146 Table 'lime_survey_XXXXXX' doesn't exist`

**Solution**: Verify that the survey is active in LimeSurvey and the corresponding table has been created:

```php
// Check if table exists before querying
if (Schema::connection('limesurvey')->hasTable("lime_survey_{$surveyId}")) {
    $responses = SurveyResponse::getResponsesForSurvey($surveyId)->get();
} else {
    Log::warning("Survey table does not exist: lime_survey_{$surveyId}");
    $responses = collect(); // Return empty collection
}
```

### 2. Wide Table Performance Issues

**Issue**: Slow queries on tables with many columns

**Solution**: Select only required columns:

```php
// Instead of SELECT *
$responses = SurveyResponse::getResponsesForSurvey($surveyId)
    ->select(['id', 'submitdate', 'token', $requiredField])
    ->get();
```

### 3. Localization Problems

**Issue**: Questions or answers appear in wrong language

**Solution**: Ensure proper joins with localization tables:

```php
$questions = LimeQuestion::with(['l10n' => function($query) {
    $query->where('language', app()->getLocale());
}])->get();
```

## Migration from Other Survey Systems

When migrating from other survey systems:

1. **Data Structure Mapping**: Map existing question types to LimeSurvey question types
2. **Response Format Conversion**: Convert response data to LimeSurvey's dynamic table format
3. **User Authorization**: Implement proper user permissions for migrated surveys
4. **URL Redirection**: Update links to point to new LimeSurvey integration

## Best Practices

### 1. Survey Design
- Keep surveys concise and focused
- Use clear, unbiased questions
- Implement proper skip logic and conditional questions
- Test surveys before full deployment

### 2. Performance
- Use caching for frequently accessed data
- Implement pagination for large datasets
- Optimize database queries with proper indexing
- Process large datasets in chunks

### 3. Security
- Validate all user inputs
- Implement proper authorization
- Protect against injection attacks
- Maintain participant anonymity when required

### 4. Data Management
- Regularly backup survey data
- Implement data retention policies
- Monitor database growth
- Archive completed surveys when appropriate

## Future Enhancements

### 1. Real-time Integration
- Implement LimeSurvey plugin for real-time webhook integration
- Add instant dashboard updates without polling
- Use Laravel queues for background processing

### 2. Advanced Analytics
- Implement machine learning for response analysis
- Add predictive modeling capabilities
- Create advanced visualization tools

### 3. Enhanced User Experience
- Improve mobile responsiveness
- Add accessibility features
- Implement progressive web app functionality