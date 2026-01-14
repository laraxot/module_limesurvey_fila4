# Optimized Filament Charts for LimeSurvey Data

To deliver "super optimized" charts (`grafici super ottimizzati`), we must strictly follow the **Hybrid Access Pattern**: use static tables for stats, and dynamic tables only for detail.

## 1. The Golden Rule: Aggregation over Hydration

**BAD**: Hydrating dynamic `SurveyResponse` models to count them.
```php
// ❌ Don't do this (Dynamic Table Access)
$responses = SurveyResponse::getResponsesForSurvey($id)->get();
$data = $responses->groupBy('98276X...')->map->count();
```
*Why?* Loads thousands of heavy objects with dynamic attributes. Fills RAM instantly.

**GOOD**: Database-level aggregation on `SurveyFlipResponse`.
```php
// ✅ Do this (Static Table Access)
$data = SurveyFlipResponse::where('survey_id', $id)
    ->selectRaw('value, count(*) as count')
    ->groupBy('value')
    ->pluck('count', 'value');
```
*Why?* Uses standard SQL indexing. Only transfers summary data.

## 2. Using `Trend` for Time-Series

For "Responses over time" charts, use `flowframe/laravel-trend` on the *static* table.

```php
use Flowframe\Trend\Trend;

$trend = Trend::query(SurveyFlipResponse::query()->where('survey_id', $this->survey_id))
    ->between(now()->subMonth(), now())
    ->perDay()
    ->count();
```

## 3. High-Performance Widgets Implementation

### Step A: Define the Widget
Create a standard Filament Chart Widget.

### Step B: The `getData` Method
Use `DB::query` or `toBase()` to skip Eloquent overhead completely for read-only stats.

```php
protected function getData(): array
{
    // Use caching to prevent DB hits on every refresh
    return Cache::remember("chart_survey_{$this->survey_id}", 600, function() {
        
        $counts = DB::table('survey_flip_responses')
            ->where('survey_id', $this->record->id)
            ->where('question_id', $this->question_id)
            ->select('value', DB::raw('count(*) as total'))
            ->groupBy('value')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Responses',
                    'data' => $counts->pluck('total'),
                ],
            ],
            'labels' => $counts->pluck('value'),
        ];
    });
}
```

## 4. Lazy Loading & Polling

*   **Lazy Loading**: Enable `protected static bool $isLazy = true;` in your Widget class. This makes the page load instantly, and the chart loads in a second request.
*   **Polling**: If data changes fast, use `protected static ?string $pollingInterval = '30s';`. If static, set to `null` to save resources.

## 5. Advanced: Pre-Aggregated Tables

If you have millions of rows, even `GROUP BY` is slow.
**Solution**: Create a `survey_stats` table.
*   Columns: `survey_id`, `question_id`, `value_key`, `count`.
*   Update this table via a Scheduled Job (every hour) or Observer.
*   The Chart Widget queries this tiny table solely.

## 6. Filament Chart Configuration

*   **Colors**: Use `filament config` colors (primary/warning) to match the theme.
*   **Interactivity**: Use `chart.js` plugins if needed, but standard Filament charts are usually sufficient.
*   **Dark Mode**: Ensure labels are readable in Dark Mode (Filament handles this mostly automatically).

## Summary Checklist

1.  [ ] **Use Case A (Charts)**: Ensure `SurveyFlipResponse` is used.
2.  [ ] **Use Case B (Detail)**: Ensure `SurveyResponse` is used *only* for single record view (Modal/Edit).
3.  [ ] Use `selectRaw` / `groupBy`.
4.  [ ] Cache results (`Cache::remember`).
5.  [ ] Enable Lazy Loading.
