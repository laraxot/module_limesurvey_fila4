# LimeSurvey Performance Optimization

## Overview
Performance optimization is critical for the LimeSurvey integration due to the dynamic and potentially very wide nature of LimeSurvey's database tables. This document outlines strategies to optimize the various components of the LimeSurvey integration.

## Performance Challenges in LimeSurvey Integration

### 1. Dynamic Wide Tables
- `lime_survey_{SID}` tables can have hundreds of columns
- `SELECT *` queries are extremely expensive
- Indexing challenges with dynamic column structures

### 2. Survey Flip Process
- Transformation of wide tables to EAV format can be resource-intensive
- Large surveys require significant processing time
- Memory usage can be substantial

### 3. Metadata Queries
- Joining with localization tables for every query
- Complex hierarchical question structures
- Multiple related tables to access

## Database Optimization Strategies

### 1. Indexing Strategy

#### LimeSurvey Core Tables
```sql
-- LimeSurvey metadata tables should have proper indexes
CREATE INDEX idx_lime_questions_sid ON lime_questions(sid);
CREATE INDEX idx_lime_questions_gid ON lime_questions(gid);
CREATE INDEX idx_lime_questions_parent ON lime_questions(parent_qid);
CREATE INDEX idx_lime_questions_type ON lime_questions(type);

CREATE INDEX idx_lime_groups_sid ON lime_groups(sid);
CREATE INDEX idx_lime_groups_order ON lime_groups(group_order);

-- Localization tables
CREATE INDEX idx_lime_question_l10ns_qid_lang ON lime_question_l10ns(qid, language);
CREATE INDEX idx_lime_answer_l10ns_aid_lang ON lime_answer_l10ns(aid, language);
```

#### Survey Flip Response Table
```sql
-- Critical indexes for analytics queries
CREATE INDEX idx_survey_flip_survey_question ON survey_flip_responses(survey_id, question_id);
CREATE INDEX idx_survey_flip_survey_response ON survey_flip_responses(survey_id, old_id);
CREATE INDEX idx_survey_flip_submitdate ON survey_flip_responses(submitdate);
CREATE INDEX idx_survey_flip_answer ON survey_flip_responses(answer(255));
CREATE INDEX idx_survey_flip_token ON survey_flip_responses(token);

-- Composite index for common query patterns
CREATE INDEX idx_survey_flip_common ON survey_flip_responses(survey_id, question_id, submitdate);
```

### 2. Query Optimization

#### Avoid SELECT *
```php
// BAD: This will select all dynamic columns which can be hundreds
$all_data = DB::table("lime_survey_$surveyId")->get();

// GOOD: Select only required columns
$minimal_data = DB::table("lime_survey_$surveyId")
    ->select(['id', 'submitdate', 'token', '123456X22X487']) // specific columns
    ->whereNotNull('submitdate')
    ->get();
```

#### Efficient Joins for Localization
```php
// Use subqueries or CTEs for localization data
$questions_with_localization = LimeQuestion::where('sid', $surveyId)
    ->with([
        'l10n' => function($query) {
            $query->select('qid', 'question', 'help', 'language')
                  ->where('language', app()->getLocale());
        }
    ])
    ->select(['qid', 'sid', 'gid', 'type', 'title', 'parent_qid'])
    ->get();
```

### 3. Survey-Specific Optimization

#### Dynamic Table Query Caching
```php
class SurveyResponse extends BaseModel
{
    public static function getResponsesForSurveyOptimized(string $surveyId, array $fieldnames = []): Builder
    {
        $instance = new static;
        $instance->setTableForSurvey($surveyId);
        
        $query = $instance->newQuery();
        
        // Only select required fields if specified
        if (!empty($fieldnames)) {
            $query->select(array_merge(['id', 'submitdate', 'token'], $fieldnames));
        }
        
        return $query;
    }
}
```

## Survey Flip Process Optimization

### 1. Chunked Processing
```php
class PopulateSurveyFlipBySurveyIdAction
{
    public function execute(string $survey_id): void
    {
        $survey_response = SurveyResponse::getResponsesForSurvey($survey_id);
        $questions = LimeQuestion::where('sid', $survey_id)
            ->whereNotIn('type', ['X'])
            ->get();
        
        // Use chunked processing for large surveys
        $survey_response
            ->where('submitdate', '!=', null)
            ->chunk(500, function($chunk) use ($questions, $survey_id) {
                $this->processChunk($chunk, $questions, $survey_id);
            });
    }
    
    private function processChunk($responses, $questions, $survey_id): void
    {
        $insertData = [];
        
        foreach ($responses as $row) {
            foreach ($questions as $q) {
                $data = $this->buildFlipData($row, $q, $survey_id);
                if ($this->isValidData($data)) {
                    $insertData[] = $data;
                    
                    // Insert in batches to avoid memory issues
                    if (count($insertData) >= 100) {
                        SurveyFlipResponse::insert($insertData);
                        $insertData = [];
                    }
                }
            }
        }
        
        // Insert remaining data
        if (!empty($insertData)) {
            SurveyFlipResponse::insert($insertData);
        }
    }
}
```

### 2. Upsert Optimization
```php
// Use bulk upsert operations
class SurveyFlipResponse extends BaseModel
{
    public static function upsertBatch(array $records, array $uniqueBy, array $update = null): void
    {
        if (empty($records)) {
            return;
        }
        
        $update = $update ?? array_keys($records[0]);
        
        // Use Laravel's upsert method for efficiency
        static::upsert($records, $uniqueBy, $update);
    }
}
```

### 3. Differential Processing
```php
class PopulateSurveyFlipBySurveyIdAction
{
    public function executeDifferential(string $survey_id): void
    {
        // Get the highest old_id already processed
        $last_processed_id = SurveyFlipResponse::where('survey_id', $survey_id)
            ->max('old_id') ?? 0;
        
        $new_responses = SurveyResponse::getResponsesForSurvey($survey_id)
            ->where('id', '>', $last_processed_id)
            ->where('submitdate', '!=', null)
            ->get();
            
        // Process only new responses
        $this->processBatch($new_responses, $survey_id);
    }
}
```

## Caching Strategies

### 1. Metadata Caching
```php
class LimeSurveyCache
{
    public static function getStructure(string $surveyId, string $lang = null): array
    {
        $lang = $lang ?? app()->getLocale();
        $cacheKey = "limesurvey_structure_{$surveyId}_{$lang}";
        
        return Cache::remember($cacheKey, 3600, function() use ($surveyId, $lang) {
            return [
                'questions' => LimeQuestion::where('sid', $surveyId)
                    ->with(['l10n' => function($query) use ($lang) {
                        $query->where('language', $lang);
                    }])
                    ->get()
                    ->keyBy('qid'),
                    
                'groups' => LimeGroup::where('sid', $surveyId)
                    ->with(['labels' => function($query) use ($lang) {
                        $query->where('language', $lang);
                    }])
                    ->get()
                    ->keyBy('gid'),
            ];
        });
    }
    
    public static function clearStructure(string $surveyId): void
    {
        Cache::deleteMatching("limesurvey_structure_{$surveyId}_*");
    }
}
```

### 2. Response Data Caching
```php
class SurveyResponseCache
{
    public static function getProcessedResponses(string $surveyId, array $filters = []): Collection
    {
        $cacheKey = "survey_responses_{$surveyId}_" . md5(serialize($filters));
        
        return Cache::remember($cacheKey, 900, function() use ($surveyId, $filters) {
            // Complex query with filters
            $query = SurveyFlipResponse::where('survey_id', $surveyId);
            
            if (!empty($filters['date_from'])) {
                $query->where('submitdate', '>=', $filters['date_from']);
            }
            
            if (!empty($filters['date_to'])) {
                $query->where('submitdate', '<=', $filters['date_to']);
            }
            
            return $query->get();
        });
    }
}
```

## Application-Level Optimizations

### 1. Lazy Loading
```php
class LimeQuestion extends BaseTreeModel
{
    // Only load relationships when needed
    protected $with = []; // Remove default with to enable lazy loading
    
    public function getL10nAttribute()
    {
        return $this->relationLoaded('l10n') 
            ? $this->getRelation('l10n')
            : $this->load('l10n')->getRelation('l10n');
    }
}
```

### 2. Collection Optimization
```php
// Use lazy collections for large datasets
$largeDataset = SurveyResponse::getResponsesForSurvey($surveyId)
    ->where('submitdate', '!=', null)
    ->cursor() // Returns a lazy collection
    ->filter(function($item) {
        return $item->submitdate->isAfter(now()->subDays(30));
    })
    ->map(function($item) {
        return $this->transformForAnalytics($item);
    });
```

## Monitoring and Profiling

### 1. Query Monitoring
```php
// Monitor slow queries in LimeSurvey integration
DB::listen(function ($query) {
    if ($query->time > 1000) { // Queries taking more than 1 second
        Log::warning('Slow LimeSurvey query', [
            'sql' => $query->sql,
            'bindings' => $query->bindings,
            'time' => $query->time,
            'connection' => $query->connectionName
        ]);
    }
});
```

### 2. Performance Metrics
```php
class LimeSurveyPerformanceMonitor
{
    public static function measureFlipProcess(string $surveyId, callable $processFunction)
    {
        $start = microtime(true);
        $memoryStart = memory_get_usage();
        
        $result = $processFunction();
        
        $end = microtime(true);
        $memoryEnd = memory_get_usage();
        
        Log::info('SurveyFlip Performance', [
            'survey_id' => $surveyId,
            'execution_time' => ($end - $start) * 1000, // ms
            'memory_used' => $memoryEnd - $memoryStart, // bytes
            'records_processed' => $result,
            'timestamp' => now()
        ]);
        
        return $result;
    }
}
```

## Configuration Optimizations

### 1. Database Connection Pooling
```php
// config/database.php - Optimize for LimeSurvey queries
'mysql_limesurvey' => [
    'driver' => 'mysql',
    'url' => env('DATABASE_URL'),
    'host' => env('DB_HOST', '127.0.0.1'),
    'port' => env('DB_PORT', '3306'),
    'database' => env('DB_DATABASE', 'forge'),
    'username' => env('DB_USERNAME', 'forge'),
    'password' => env('DB_PASSWORD', ''),
    'unix_socket' => env('DB_SOCKET', ''),
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'prefix' => '',
    'prefix_indexes' => true,
    'strict' => true,
    'engine' => null,
    'options' => extension_loaded('pdo_mysql') ? array_filter([
        PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
        
        // Performance optimizations for wide tables
        PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => false, // For large result sets
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET SESSION query_cache_type=ON",
    ]) : [],
],
```

### 2. Queue Configuration
```php
// Process large surveys via queues to avoid timeouts
class PopulateSurveyFlipBySurveyIdAction
{
    public function execute(string $survey_id): void
    {
        // Check survey size and queue if large
        $response_count = DB::table("lime_survey_$survey_id")->count();
        
        if ($response_count > 10000) {
            // Dispatch to queue for large surveys
            dispatch(new ProcessLargeSurveyJob($survey_id));
        } else {
            // Process inline for smaller surveys
            $this->processInline($survey_id);
        }
    }
}
```

## Real-time Integration Optimization

### 1. Webhook-Based Sync
Instead of polling, use LimeSurvey plugin for real-time updates:

```php
// When LimeSurvey plugin triggers webhook
class ProcessNewSurveyResponseJob
{
    public function handle()
    {
        // Single response processing - very fast
        SurveyFlipResponse::create([
            'survey_id' => $this->surveyId,
            'question_id' => $this->questionId,
            'answer' => $this->answer,
            'submitdate' => $this->submitDate,
            // ... other fields
        ]);
        
        // Update any related caches
        Cache::forget("survey_responses_{$this->surveyId}*");
    }
}
```

### 2. Incremental Updates
```php
// Keep track of last sync per survey
class SurveySyncTracker
{
    public static function getLastSync(string $surveyId): ?Carbon
    {
        return Cache::get("survey_last_sync_$surveyId");
    }
    
    public static function updateSync(string $surveyId): void
    {
        Cache::put("survey_last_sync_$surveyId", now(), 3600);
    }
}
```

## Performance Testing

### 1. Load Testing Script
```bash
#!/bin/bash
# Performance test for LimeSurvey integration

echo "Testing Survey Flip Performance..."

# Test different survey sizes
for size in 100 1000 10000 50000; do
    echo "Testing with $size responses..."
    
    # Create test survey data
    php artisan limesurvey:create-test-data --size=$size
    
    # Time the flip process
    start_time=$(date +%s%3N)
    php artisan limesurvey:flip --survey-id=test$size
    end_time=$(date +%s%3N)
    
    duration=$((end_time - start_time))
    echo "Processed $size responses in $duration ms"
done
```

## Troubleshooting Performance Issues

### 1. Common Problems
- **Slow metadata queries**: Implement caching for question/group data
- **Memory exhaustion**: Use chunked processing and lazy collections  
- **Database locks**: Use proper transaction handling and indexing
- **Wide table queries**: Always specify required columns

### 2. Diagnostic Commands
```bash
# Check for slow queries
mysql -e "SHOW PROCESSLIST;" | grep lime_survey

# Monitor cache hit rates
php artisan cache:stats

# Check queue performance
php artisan queue:monitor

# Monitor memory usage
php artisan limesurvey:benchmark --survey-id=123456
```

These optimizations will significantly improve the performance of the LimeSurvey integration, especially for large surveys with many responses.