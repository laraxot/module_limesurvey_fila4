# LimeSurvey Integration Troubleshooting

## Overview
This document provides troubleshooting guidance for common issues encountered in the LimeSurvey integration module. It covers problems related to database connectivity, data transformation, survey flip process, and performance issues.

## Common Issues and Solutions

### 1. Database Connectivity Issues

#### Problem: Cannot connect to LimeSurvey database
**Symptoms:**
- Connection refused errors
- Database authentication failures
- "Unknown database" errors

**Solutions:**
1. Verify database credentials in `.env` file:
```env
LIMESURVEY_DB_HOST=localhost
LIMESURVEY_DB_PORT=3306
LIMESURVEY_DB_DATABASE=limesurvey
LIMESURVEY_DB_USERNAME=user
LIMESURVEY_DB_PASSWORD=password
```

2. Check database configuration in `config/database.php`:
```php
'limesurvey' => [
    'driver' => 'mysql',
    'host' => env('LIMESURVEY_DB_HOST', '127.0.0.1'),
    // ... other settings
],
```

3. Test connection manually:
```bash
mysql -h localhost -u user -p limesurvey
```

#### Problem: Dynamic table doesn't exist
**Symptoms:**
- "Table 'lime_survey_123456' doesn't exist" error
- Survey responses cannot be accessed

**Solutions:**
1. Verify that the survey with ID `123456` exists and is activated in LimeSurvey
2. Check that the survey has been properly activated (not just created)
3. Ensure the table prefix is correct (should be `lime_` by default)

### 2. Survey Flip Process Issues

#### Problem: Survey flip process is slow or consuming too much memory
**Symptoms:**
- Process timeouts
- High memory usage
- Incomplete processing

**Solutions:**
1. Enable chunked processing:
```php
// Use smaller chunk sizes for large surveys
$survey_response->chunk(100, function($chunk) {
    // Process small chunks to reduce memory usage
});
```

2. Optimize the flip action to process only new records:
```php
// Get last processed ID to do differential processing
$last_processed_id = SurveyFlipResponse::where('survey_id', $surveyId)->max('old_id') ?? 0;
```

3. Increase PHP memory limit temporarily:
```php
ini_set('memory_limit', '1G');
```

#### Problem: Missing responses after flip process
**Symptoms:**
- Not all LimeSurvey responses appear in SurveyFlipResponse
- Data inconsistency between source and target

**Solutions:**
1. Check the survey flip query filters:
```php
// Ensure we're not filtering out valid responses
$survey_response->where('submitdate', '!=', null) // Only completed responses
```

2. Verify field name mapping:
```php
// Check that LimeQuestion fieldname attribute works correctly
$question = LimeQuestion::find($qid);
$fieldname = $question->fieldname; // Should return something like "123456X22X487"
```

3. Check for duplicate handling:
```php
// Ensure the firstOrCreate logic is working properly
SurveyFlipResponse::firstOrCreate(
    ['old_id' => $row->id, 'survey_id' => $survey_id, 'question_id' => $q->qid],
    $data
);
```

### 3. Data Transformation Issues

#### Problem: Incorrect field name mapping
**Symptoms:**
- `answer` field is null in SurveyFlipResponse
- Field names like `123456X22X487` not matching questions

**Solutions:**
1. Debug the fieldname attribute in LimeQuestion:
```php
public function getFieldNameAttribute(?string $value): string
{
    if ($value !== null) {
        return $value;
    }
    
    // Add debugging
    \Log::info("Building fieldname", [
        'sid' => $this->sid,
        'gid' => $this->gid, 
        'qid' => $this->qid,
        'type' => $this->type,
        'parent_qid' => $this->parent_qid
    ]);
    
    $res = $this->sid.'X'.$this->gid.'X';
    // ... rest of logic
}
```

2. Verify question types that should be excluded:
```php
// Ensure 'X' type questions (equation types) are excluded
$questions = LimeQuestion::where('sid', $survey_id)
    ->whereNotIn('type', ['X']) // Exclude equations
    ->get();
```

#### Problem: Localization issues (text showing as codes)
**Symptoms:**
- Question text shows as codes instead of actual text
- Missing translations

**Solutions:**
1. Verify language settings:
```php
// Check that l10n relationship is properly loaded
$question = LimeQuestion::with('l10n')->find($qid);
$text = $question->l10n->question ?? $question->question;
```

2. Ensure proper language context:
```php
$lang = app()->getLocale(); // or specific language from survey
$question_l10n = LimeQuestionL10n::where('qid', $qid)
    ->where('language', $lang)
    ->first();
```

### 4. Performance Issues

#### Problem: Slow queries on large surveys
**Symptoms:**
- Queries taking more than 30 seconds
- High CPU usage
- Database locks

**Solutions:**
1. Add proper indexes:
```sql
-- Ensure these indexes exist
CREATE INDEX idx_survey_flip_survey_question ON survey_flip_responses(survey_id, question_id);
CREATE INDEX idx_lime_survey_submitdate ON lime_survey_123456(submitdate);
```

2. Optimize queries to avoid SELECT *:
```php
// BAD - selects all dynamic columns
$all = DB::table("lime_survey_$id")->get();

// GOOD - select only needed columns
$needed = DB::table("lime_survey_$id")
    ->select(['id', 'submitdate', 'token', '123456X22X487'])
    ->get();
```

3. Use pagination for large result sets:
```php
$paginated = SurveyFlipResponse::where('survey_id', $surveyId)
    ->paginate(1000);
```

### 5. Caching Issues

#### Problem: Stale metadata after LimeSurvey changes
**Symptoms:**
- Updated questions not showing new text
- Old survey structure still being used

**Solutions:**
1. Clear relevant caches:
```bash
# Clear specific survey cache
php artisan cache:forget "limesurvey_structure_123456_it"

# Clear all LimeSurvey caches
php artisan cache:clear --tag=limesurvey
```

2. Implement cache invalidation:
```php
// In your update methods
Cache::forget("limesurvey_structure_{$surveyId}_{$lang}");
// Or
LimeSurveyCache::clearStructure($surveyId);
```

### 6. Queue and Job Issues

#### Problem: Flip jobs failing or not processing
**Symptoms:**
- Jobs stuck in queue
- Failed job entries in database
- No new data appearing

**Solutions:**
1. Check queue worker status:
```bash
# Check if queue worker is running
ps aux | grep queue:work

# Restart queue worker
php artisan queue:restart
```

2. Check failed jobs:
```bash
# View failed jobs
php artisan queue:failed

# Retry failed jobs
php artisan queue:retry all
```

3. Check job configuration:
```php
// Ensure proper queue connection
PopulateSurveyFlipBySurveyIdAction::make()
    ->onQueue('limesurvey-processing') // Use appropriate queue
    ->execute($surveyId);
```

## Diagnostic Tools and Commands

### 1. Survey Status Check
```bash
# Check survey existence and structure
php artisan limesurvey:check-survey --id=123456

# Verify dynamic table exists
php artisan limesurvey:check-table --survey=123456

# Check flip process status
php artisan limesurvey:flip-status --survey=123456
```

### 2. Data Consistency Check
```bash
# Compare source and target record counts
php artisan limesurvey:consistency-check --survey=123456
```

### 3. Performance Analysis
```bash
# Profile survey flip performance
php artisan limesurvey:profile-flip --survey=123456 --iterations=5
```

## Log Analysis

### 1. Common Error Patterns
Look for these patterns in logs:

**Database errors:**
```
SQLSTATE[42S02]: Base table or view not found: 1146 Table 'limesurvey.lime_survey_123456' doesn't exist
```

**Memory errors:**
```
Allowed memory size of 536870912 bytes exhausted
```

**Connection errors:**
```
SQLSTATE[HY000] [2002] Connection refused
```

### 2. Log Locations
- Laravel logs: `storage/logs/laravel.log`
- Queue logs: `storage/logs/queue.log`
- Application logs: `storage/logs/limesurvey.log` (if configured)

## Debugging Steps

### 1. Step by step debugging of survey flip:
```php
public function execute(string $survey_id): void 
{
    \Log::info("Starting survey flip for: $survey_id");
    
    // Step 1: Get survey responses
    $survey_response = SurveyResponse::getResponsesForSurvey($survey_id);
    \Log::info("Response query built", ['query' => $survey_response->toSql()]);
    
    // Step 2: Get questions
    $questions = LimeQuestion::where('sid', $survey_id)->get();
    \Log::info("Questions loaded", ['count' => $questions->count()]);
    
    // Step 3: Process responses
    $responses = $survey_response->get();
    \Log::info("Responses loaded", ['count' => $responses->count()]);
    
    // ... continue with processing
}
```

### 2. Verify field mappings:
```php
// Debug fieldname generation
foreach ($questions as $q) {
    $fieldname = $q->fieldname;
    $exists = Schema::connection('limesurvey')
        ->hasColumn("lime_survey_$survey_id", $fieldname);
    
    \Log::info("Field check", [
        'question_id' => $q->qid,
        'fieldname' => $fieldname,
        'exists' => $exists
    ]);
}
```

## Monitoring and Health Checks

### 1. Create health check commands:
```bash
# Overall system health
php artisan limesurvey:health-check

# Database connectivity
php artisan limesurvey:db-check

# Queue health
php artisan limesurvey:queue-check
```

### 2. Set up monitoring alerts:
- Monitor queue failure rate
- Track survey flip completion times
- Alert on database connection failures
- Monitor cache hit rates

## Recovery Procedures

### 1. Data recovery after failed flip:
```bash
# Reset survey flip progress to retry
php artisan limesurvey:reset-flip --survey=123456

# Re-process specific date range
php artisan limesurvey:flip --survey=123456 --date-range="2023-01-01:2023-12-31"
```

### 2. Emergency procedures:
- Stop all processing if database is in bad state
- Restore from backups if needed
- Clear all caches related to LimeSurvey
- Restart queue workers

These troubleshooting steps should help resolve most common issues with the LimeSurvey integration. Always ensure you have proper backups before making significant changes to the system.