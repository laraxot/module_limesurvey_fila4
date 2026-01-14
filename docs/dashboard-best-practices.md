# Filament 4 Dashboard Best Practices (2026 Edition)

## 1. Dashboard Philosophy

A dashboard is not just a collection of charts; it is a **Story**.
In Quaeris, dashboards must be:
- **Instant**: Load in < 500ms (Skeleton loaders via Lazy Loading).
- **Interactive**: Filters must work instantly.
- **Actionable**: Every chart should lead to a decision.

## 2. Layout & Organization

### 2.1 The 12-Column Grid
Filament defaults to a 2-column grid. For professional dashboards, use responsive customization.

```php
public function getColumns(): int | string | array
{
    return [
        'default' => 1,
        'md' => 2,
        'xl' => 4, // Widescreen optimization
    ];
}
```

### 2.2 Widget Sizing (`columnSpan`)
- **Stats Widgets**: Span 1 column (compact).
- **Trend Charts**: Span 2 or `full` columns (need width).
- **Pie/Doughnut**: Span 1 column (maintain aspect ratio).

```php
protected int | string | array $columnSpan = [
    'md' => 2,
    'xl' => 1,
];
```

## 3. Advanced Filtering Strategy

### 3.1 The "Global Filter" Problem
By default, widgets are isolated. To filter *all* widgets by "Date Range" or "Department":
**Solution**: Use Livewire Events or `Filter` Widgets.

### 3.2 Implementation (Livewire Events)
1.  **Filter Widget**: A custom widget containing a Form. On change, it dispatches an event.
    ```php
    // In FilterWidget
    public function updated($property) {
        $this->dispatch('filter-changed', filter: $this->filter);
    }
    ```
2.  **Chart Widgets**: Listen for the event.
    ```php
    // In ChartWidget
    protected $listeners = ['filter-changed' => 'updateFilter'];

    public function updateFilter($filter) {
        $this->filter = $filter;
        $this->updateChartData(); // Refresh
    }
    ```

## 4. Performance Optimization

### 4.1 Lazy Loading (Mandatory)
All heavy charts must be lazy loaded.
```php
protected static bool $isLazy = true;
```

### 4.2 Caching Data (The 5-Minute Rule)
Dashboards are view-heavy. Cache aggregation results.
```php
protected function getData(): array
{
    return Cache::remember("dashboard_chart_{$this->id}", 300, function() {
        return ...; // Heavy SQL
    });
}
```

### 4.3 Polling
Disabled by default in Quaeris to save resources. Enable ONLY for real-time monitoring (e.g., active server status).
```php
protected static ?string $pollingInterval = null; // Default
// protected static ?string $pollingInterval = '30s'; // Exception
```

## 5. Summary Checklist

- [ ] **Lazy Loading** is enabled on all charts.
- [ ] **Data is Cached** where possible.
- [ ] **Responsive Grid** configured (`md`, `xl`).
- [ ] **Global Filters** implemented via Events (if needed).
- [ ] **Export to PDF**: Use `spatie/laravel-pdf` (Browsershot) with the "Shadow Report Pattern".
