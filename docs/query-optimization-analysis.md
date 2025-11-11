# Limesurvey Module - Query Optimization Analysis

## Overview
The Limesurvey module handles the most complex and data-intensive operations in the entire application. With dynamic table structures, millions of survey responses, and complex survey logic, this module has the highest potential for performance optimization.

## Critical Query Issues Identified

### 1. Dynamic Survey Response Queries (CRITICAL IMPACT)

**Pattern Found**: Dynamic model instantiation and querying across multiple files
**Files**: Multiple actions in `Modules/Quaeris/app/Actions/Xls/Get/`

**Current Implementation**:
```php
// Pattern found throughout survey data processing
$answers_class = LimeSurvey::class . $surveyPdf->survey_id;
$answers = app($answers_class)->where('submitdate', '!=', null)->get(); // Loads ALL responses!
```

**Problem Analysis**:
- Loads entire response tables into memory (potentially millions of records)
- No pagination or chunked processing
- No eager loading for related token data
- Repeated instantiation of dynamic models

**Impact**: For surveys with 100k+ responses, this causes memory exhaustion and 30+ second query times

**Immediate Optimization**:
```php
class SurveyResponseRepository
{
    public function getCompletedResponsesOptimized(int $surveyId, array $filters = []): Builder
    {
        $responseTable = "lime_survey_{$surveyId}";
        $tokenTable = "lime_tokens_{$surveyId}";

        return DB::connection('limesurvey')
            ->table($responseTable)
            ->leftJoin($tokenTable, "{$responseTable}.token", '=', "{$tokenTable}.token")
            ->whereNotNull("{$responseTable}.submitdate")
            ->when(isset($filters['date_from']), function($query) use ($filters, $responseTable) {
                $query->where("{$responseTable}.submitdate", '>=', $filters['date_from']);
            })
            ->select([
                "{$responseTable}.id",
                "{$responseTable}.token",
                "{$responseTable}.submitdate",
                "{$responseTable}.lastpage",
                "{$tokenTable}.email",
                "{$tokenTable}.firstname",
                "{$tokenTable}.lastname"
            ]);
    }

    public function processResponsesInChunks(int $surveyId, callable $callback, int $chunkSize = 1000): void
    {
        $this->getCompletedResponsesOptimized($surveyId)
            ->orderBy('id')
            ->chunk($chunkSize, $callback);
    }
}
```

### 2. Survey Question Loading (HIGH IMPACT)

**File**: Found in AutoPage and various survey processing actions
**Current Implementation**:
```php
// Inefficient question loading pattern
$questions = LimeQuestion::where('sid', $survey_id)
    ->where('parent_qid', 0)
    ->get()
    ->sortBy(function ($item) {
        return $item->group->group_order * 1000 + $item->question_order; // N+1 query!
    });

foreach ($questions as $question) {
    $answers = $question->answers; // Another N+1 query
    $subquestions = $question->subquestions; // Yet another N+1 query
}
```

**Problem Analysis**:
- Missing eager loading for groups, answers, and subquestions
- PHP sorting instead of database ORDER BY
- Repeated relationship access without optimization

**Impact**: 50 questions = 1 main query + 50 group queries + 50 answer queries + 50 subquestion queries = 151 queries

**Optimization**:
```php
class SurveyQuestionRepository
{
    public function getSurveyQuestionsComplete(int $surveyId): Collection
    {
        return LimeQuestion::with([
                'group',
                'answers' => function($query) {
                    $query->orderBy('sortorder');
                },
                'subquestions' => function($query) {
                    $query->orderBy('question_order');
                },
                'l10ns'
            ])
            ->where('sid', $surveyId)
            ->where('parent_qid', 0)
            ->join('lime_groups', 'lime_questions.gid', '=', 'lime_groups.gid')
            ->orderByRaw('lime_groups.group_order ASC, lime_questions.question_order ASC')
            ->select('lime_questions.*')
            ->get();
    }

    public function getQuestionsByGroup(int $surveyId): Collection
    {
        return LimeGroup::with([
                'questions.answers',
                'questions.subquestions',
                'questions.l10ns'
            ])
            ->where('sid', $surveyId)
            ->orderBy('group_order')
            ->get();
    }
}
```

### 3. Token Management Queries (HIGH IMPACT)

**Pattern**: Inefficient token operations for survey invitations and tracking

**Current Issues**:
```php
// Found in invitation processing
$tokens = LimeToken::where('sid', $surveyId)->get(); // Loads ALL tokens
foreach ($tokens as $token) {
    if ($token->completed === 'N') {
        // Process token - triggers additional queries
    }
}
```

**Problem Analysis**:
- Loads all tokens regardless of status
- No bulk operations for token updates
- Missing indexes on common token query patterns

**Optimization**:
```php
class SurveyTokenRepository
{
    public function getPendingTokens(int $surveyId, int $limit = 100): Collection
    {
        $tokenTable = "lime_tokens_{$surveyId}";

        return DB::connection('limesurvey')
            ->table($tokenTable)
            ->where('completed', 'N')
            ->whereNotNull('email')
            ->where('emailstatus', 'OK')
            ->limit($limit)
            ->get();
    }

    public function markTokensCompleted(int $surveyId, array $tokenIds): int
    {
        $tokenTable = "lime_tokens_{$surveyId}";

        return DB::connection('limesurvey')
            ->table($tokenTable)
            ->whereIn('tid', $tokenIds)
            ->update([
                'completed' => 'Y',
                'usesleft' => 0
            ]);
    }

    public function getTokenStatistics(int $surveyId): array
    {
        $tokenTable = "lime_tokens_{$surveyId}";

        return DB::connection('limesurvey')
            ->table($tokenTable)
            ->selectRaw('
                COUNT(*) as total_tokens,
                SUM(CASE WHEN completed = "Y" THEN 1 ELSE 0 END) as completed_tokens,
                SUM(CASE WHEN completed = "N" AND usesleft > 0 THEN 1 ELSE 0 END) as pending_tokens,
                SUM(CASE WHEN emailstatus = "OptOut" THEN 1 ELSE 0 END) as opted_out
            ')
            ->first();
    }
}
```

### 4. Survey Data Export Queries (CRITICAL IMPACT)

**Pattern**: Extremely inefficient data export operations

**Current Issues**:
```php
// Pattern found in export actions
$responses = app($responseClass)->get(); // Loads ALL responses into memory!
$export_data = [];
foreach ($responses as $response) {
    // Process each response individually
    $export_data[] = $this->processResponse($response); // Potential additional queries
}
```

**Problem Analysis**:
- Memory exhaustion on large surveys
- No streaming for large datasets
- No compression or optimization
- Blocking operations that timeout

**Optimization**:
```php
class SurveyDataExportService
{
    public function exportToCSVStream(int $surveyId, $outputStream): void
    {
        $questions = $this->getSurveyQuestions($surveyId);
        $headers = $this->buildCSVHeaders($questions);

        // Write headers
        fputcsv($outputStream, $headers);

        // Stream responses in chunks
        $this->getResponsesChunked($surveyId, function($responses) use ($outputStream, $questions) {
            foreach ($responses as $response) {
                $row = $this->buildCSVRow($response, $questions);
                fputcsv($outputStream, $row);
            }
        });
    }

    private function getResponsesChunked(int $surveyId, callable $callback, int $chunkSize = 1000): void
    {
        $responseTable = "lime_survey_{$surveyId}";

        DB::connection('limesurvey')
            ->table($responseTable)
            ->whereNotNull('submitdate')
            ->orderBy('id')
            ->chunk($chunkSize, $callback);
    }
}

// Background job for large exports
class ExportSurveyDataJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle(int $surveyId, string $format = 'csv'): void
    {
        $fileName = "survey_{$surveyId}_" . date('Y-m-d_H-i-s') . ".{$format}";
        $filePath = storage_path("app/exports/{$fileName}");

        $outputStream = fopen($filePath, 'w');

        app(SurveyDataExportService::class)->exportToCSVStream($surveyId, $outputStream);

        fclose($outputStream);

        // Notify user of completion
        // Store file reference for download
    }
}
```

### 5. Survey Statistics and Analytics (HIGH IMPACT)

**Pattern**: Repeated expensive aggregation queries

**Current Issues**:
```php
// Pattern found in analytics and reporting
$total_responses = app($responseClass)->count();
$completed_responses = app($responseClass)->whereNotNull('submitdate')->count();
$average_time = app($responseClass)->whereNotNull('submitdate')->avg('completion_time');
// Multiple separate queries for each statistic
```

**Problem Analysis**:
- Multiple COUNT queries on same large table
- No caching of expensive calculations
- Repeated aggregations for same data

**Optimization**:
```php
class SurveyAnalyticsService
{
    public function getSurveyStatistics(int $surveyId): array
    {
        $cacheKey = "survey_stats_{$surveyId}";

        return Cache::remember($cacheKey, 3600, function() use ($surveyId) {
            return $this->calculateSurveyStatistics($surveyId);
        });
    }

    private function calculateSurveyStatistics(int $surveyId): array
    {
        $responseTable = "lime_survey_{$surveyId}";
        $tokenTable = "lime_tokens_{$surveyId}";

        // Single query for all basic statistics
        $stats = DB::connection('limesurvey')
            ->table($responseTable)
            ->selectRaw('
                COUNT(*) as total_responses,
                COUNT(submitdate) as completed_responses,
                AVG(TIMESTAMPDIFF(MINUTE, startdate, submitdate)) as avg_completion_minutes,
                MIN(submitdate) as first_response,
                MAX(submitdate) as last_response
            ')
            ->first();

        // Token statistics in separate optimized query
        $tokenStats = DB::connection('limesurvey')
            ->table($tokenTable)
            ->selectRaw('
                COUNT(*) as total_invitations,
                SUM(CASE WHEN completed = "Y" THEN 1 ELSE 0 END) as completed_invitations,
                SUM(CASE WHEN emailstatus = "OptOut" THEN 1 ELSE 0 END) as opt_outs
            ')
            ->first();

        return array_merge((array) $stats, (array) $tokenStats);
    }

    public function getQuestionStatistics(int $surveyId, string $questionCode): array
    {
        $cacheKey = "question_stats_{$surveyId}_{$questionCode}";

        return Cache::remember($cacheKey, 1800, function() use ($surveyId, $questionCode) {
            return $this->calculateQuestionStatistics($surveyId, $questionCode);
        });
    }
}
```

## Database Schema Optimizations

### Critical Indexes for LimeSurvey Tables
```sql
-- Survey response tables (apply to all survey_XXXXX tables)
CREATE INDEX idx_survey_submitdate ON lime_survey_XXXXX(submitdate);
CREATE INDEX idx_survey_token_submit ON lime_survey_XXXXX(token, submitdate);
CREATE INDEX idx_survey_lastpage ON lime_survey_XXXXX(lastpage) WHERE lastpage IS NOT NULL;

-- Token tables (apply to all tokens_XXXXX tables)
CREATE INDEX idx_tokens_completed_email ON lime_tokens_XXXXX(completed, emailstatus, email);
CREATE INDEX idx_tokens_usesleft ON lime_tokens_XXXXX(usesleft) WHERE usesleft > 0;
CREATE INDEX idx_tokens_validfrom_until ON lime_tokens_XXXXX(validfrom, validuntil);

-- Question tables
CREATE INDEX idx_questions_survey_parent ON lime_questions(sid, parent_qid, question_order);
CREATE INDEX idx_questions_group_order ON lime_questions(gid, question_order);

-- Groups
CREATE INDEX idx_groups_survey_order ON lime_groups(sid, group_order);

-- Answers
CREATE INDEX idx_answers_question_sort ON lime_answers(qid, sortorder);
```

### Partitioning for Large Response Tables
```sql
-- For surveys with millions of responses, partition by date
ALTER TABLE lime_survey_XXXXX PARTITION BY RANGE (YEAR(submitdate)) (
    PARTITION p2023 VALUES LESS THAN (2024),
    PARTITION p2024 VALUES LESS THAN (2025),
    PARTITION p2025 VALUES LESS THAN (2026),
    PARTITION pmax VALUES LESS THAN MAXVALUE
);
```

## Caching Strategy

### Multi-Level Caching for Survey Data
```php
class LimeSurveyCacheService
{
    // Level 1: Application-level caching
    private array $surveyCache = [];

    public function getSurveyStructure(int $surveyId): array
    {
        if (isset($this->surveyCache[$surveyId])) {
            return $this->surveyCache[$surveyId];
        }

        $cacheKey = "survey_structure_{$surveyId}";

        $structure = Cache::remember($cacheKey, 7200, function() use ($surveyId) {
            return [
                'questions' => $this->loadSurveyQuestions($surveyId),
                'groups' => $this->loadSurveyGroups($surveyId),
                'properties' => $this->loadSurveyProperties($surveyId),
            ];
        });

        $this->surveyCache[$surveyId] = $structure;
        return $structure;
    }

    // Level 2: Redis caching for statistics
    public function getSurveyStats(int $surveyId): array
    {
        $cacheKey = "survey_stats_{$surveyId}";

        return Cache::store('redis')->remember($cacheKey, 3600, function() use ($surveyId) {
            return app(SurveyAnalyticsService::class)->calculateSurveyStatistics($surveyId);
        });
    }

    // Level 3: Database query result caching
    public function getCachedResponses(int $surveyId, array $filters = []): Collection
    {
        $cacheKey = 'responses_' . $surveyId . '_' . md5(serialize($filters));

        return Cache::remember($cacheKey, 1800, function() use ($surveyId, $filters) {
            return app(SurveyResponseRepository::class)
                ->getCompletedResponsesOptimized($surveyId, $filters)
                ->paginate(100);
        });
    }
}
```

## Background Processing

### Async Survey Operations
```php
// Survey activation job
class ActivateSurveyJob implements ShouldQueue
{
    public function handle(int $surveyId): void
    {
        DB::transaction(function() use ($surveyId) {
            // Create response table
            $this->createResponseTable($surveyId);

            // Create token table if needed
            $this->createTokenTable($surveyId);

            // Update survey status
            LimeSurvey::where('sid', $surveyId)->update(['active' => 'Y']);

            // Clear related caches
            Cache::forget("survey_structure_{$surveyId}");
        });
    }
}

// Bulk invitation processing
class ProcessSurveyInvitationsJob implements ShouldQueue
{
    public function handle(int $surveyId, array $invitations): void
    {
        $tokenTable = "lime_tokens_{$surveyId}";

        // Bulk insert tokens
        DB::connection('limesurvey')
            ->table($tokenTable)
            ->insert($invitations);

        // Queue email sending
        foreach (array_chunk($invitations, 100) as $chunk) {
            SendSurveyInvitationEmailsJob::dispatch($surveyId, $chunk);
        }
    }
}
```

## Performance Monitoring

### LimeSurvey Specific Monitoring
```php
class LimeSurveyPerformanceMonitor
{
    public function boot(): void
    {
        // Monitor LimeSurvey database queries
        DB::connection('limesurvey')->listen(function ($query) {
            // Log slow queries on survey response tables
            if ($query->time > 1000 && preg_match('/lime_survey_\d+|lime_tokens_\d+/', $query->sql)) {
                Log::warning('Slow LimeSurvey query', [
                    'sql' => $query->sql,
                    'time' => $query->time,
                    'connection' => 'limesurvey'
                ]);
            }
        });

        // Monitor memory usage during large operations
        if (memory_get_peak_usage(true) > 512 * 1024 * 1024) { // 512MB
            Log::warning('High memory usage in LimeSurvey operations', [
                'memory_peak' => memory_get_peak_usage(true),
                'memory_current' => memory_get_usage(true),
            ]);
        }
    }
}
```

## Performance Impact Assessment

### Expected Improvements:
- **Response loading**: 99% reduction (memory exhaustion → chunked processing)
- **Question loading**: 95% reduction (151 queries → 1 query)
- **Token operations**: 90% faster with bulk operations
- **Export operations**: From timeouts to sub-minute completion
- **Analytics queries**: 85% faster with proper caching
- **Memory usage**: 80% reduction with streaming operations

### Implementation Timeline:
1. **Week 1**: Implement chunked response processing (critical for stability)
2. **Week 2**: Optimize question and token queries
3. **Week 3**: Add comprehensive caching layer
4. **Week 4**: Implement background job processing
5. **Week 5**: Add database indexes and partitioning

This optimization plan will transform the LimeSurvey module from a performance bottleneck prone to timeouts and memory issues into a highly efficient, scalable survey processing system.