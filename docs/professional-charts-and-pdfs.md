# Professional Charts & PDF Reporting in Filament 4 (2026 Edition)

## 1. The Philosophy of "Professional" Reports

A "professional" report in 2026 isn't just about showing data; it's about **Clarity**, **Aesthetics**, and **Performance**.

### Core Principles
1.  **Data-Ink Ratio**: Remove non-essential information. No 3D effects, no excessive gridlines, no redundant legends.
2.  **Color Harmony**: Use the project's color palette (e.g., from `tailwind.config.js`). Filament 4's `Color` facade ensures consistency between UI and Charts.
3.  **Typography**: Use the system font (Inter/Roboto) for all chart labels to match the application UI.
4.  **Dark Mode Support**: Charts must look perfect in both Light and Dark modes. Chart.js (via Filament) handles this, but custom integrations must be tested.

---

## 2. Filament 4 Charts: The Standard

Filament v4 uses **Chart.js** under the hood. While you can use ApexCharts plugins, the native implementation is the most robust and "future-proof".

### 2.1 Configuration for "Premium" Feel

To achieve a premium look, you shouldn't just dump data into the widget. You must configure the options.

```php
protected function getOptions(): array
{
    // Fetch theme colors or use standard palette
    return [
        'plugins' => [
            'legend' => [
                'display' => true,
                'position' => 'bottom', // Professional standard
                'labels' => [
                    'font' => [
                        'family' => 'inherit', // Uses CSS font
                        'weight' => 600,
                    ],
                    'usePointStyle' => true, // Elegant dots instead of squares
                ],
            ],
            'tooltip' => [
                'enabled' => true,
                'backgroundColor' => 'rgba(0,0,0,0.8)',
                'titleFont' => ['family' => 'inherit'],
                'bodyFont' => ['family' => 'inherit'],
                'padding' => 10,
                'cornerRadius' => 8,
                'displayColors' => true,
            ],
        ],
        'scales' => [
            'y' => [
                'grid' => [
                    'display' => true,
                    'drawBorder' => false,
                    'color' => 'rgba(0,0,0,0.05)', // Subtle grid
                ],
                'ticks' => [
                    'font' => ['family' => 'inherit'],
                ],
            ],
            'x' => [
                'grid' => [
                    'display' => false, // Cleaner look
                ],
                'ticks' => [
                    'font' => ['family' => 'inherit'],
                ],
            ],
        ],
        'maintainAspectRatio' => false,
        'animation' => [
            'duration' => 1000, 
            'easing' => 'easeOutQuart', // Smooth professional ease
        ],
    ];
}
```

### 2.2 Using "SurveyFlip" for Performance

Refer to `filament-charts-optimization.md` for the specialized data retrieval strategy (`SurveyFlipResponse` + `toBase()` + Cache). **Never** load thousands of Eloquent models just to count them.

---

## 3. The "PDF with Charts" Challenge

### The Problem
Traditional PHP PDF generators like `dompdf`, `TCPDF`, or `wkhtmltopdf` (Snappy) **cannot execute JavaScript**.
Since Chart.js (and ApexCharts) renders via client-side JavaScript (Canvas/SVG), these tools see a blank space where the chart should be.

### The Failed Solutions
- **ImageMagick/GD on Server**: Generates ugly, low-res static images. Hard to style.
- **Client-side Capture (Canvas.toDataURL)**: Requires complex synchronization (Frontend sends Base64 -> Backend -> PDF). Fragile and slow.

### The 2026 Solution: Spatie Browsershot
**Browsershot** uses a headless Google Chrome instance (via Puppeteer). It renders the *actual* webpage, executes the JavaScript, waits for animations to finish, and "prints" it to PDF.
**Result**: Vector-perfect, identical-to-browser rendering.

---

## 4. Implementation Guide: PDF Reporting with Browsershot

### 4.1 Prerequisites
1.  **Node.js & npm** installed on the server.
2.  **Puppeteer**: `npm install puppeteer`
3.  **Browsershot Package**: `composer require spatie/browsershot`

### 4.2 Architecture

1.  **Blade View (`resources/views/reports/survey-pdf.blade.php`)**:
    - A standard HTML page (Tailwind allowed!).
    - Includes the Chart.js library (from CDN or local build).
    - Renders charts using standard JS configuration.
2.  **Controller / Action**:
    - Prepares data.
    - Renders View to String.
    - Passes HTML to Browsershot.

### 4.3 The Blade View (The "Paper")

```html
<!-- resources/views/reports/survey-pdf.blade.php -->
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <!-- Tailwind via CDN for PDF generation speed, or local build -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* PDF Specific Fixes */
        body { -webkit-print-color-adjust: exact; }
        .page-break { page-break-after: always; }
        .chart-container { position: relative; height: 400px; width: 100%; }
    </style>
</head>
<body class="bg-gray-50 text-gray-900 p-8">

    <div class="mb-8 text-center">
        <h1 class="text-3xl font-bold text-gray-800">{{ $title }}</h1>
        <p class="text-gray-500">Generated: {{ now()->format('d/m/Y H:i') }}</p>
    </div>

    <!-- Chart Section -->
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 mb-8">
        <h2 class="text-xl font-semibold mb-4">Satisfaction Trend</h2>
        <div class="chart-container">
            <canvas id="satisfactionChart"></canvas>
        </div>
    </div>

    <script>
        // Inject Data from Backend
        const chartData = @json($chartData);

        const ctx = document.getElementById('satisfactionChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: chartData,
          ## 4. PDF Reporting Strategy: The Great Debate

When exporting charts to PDF, you have two main architectural paths. Quaeris standard is **Path A** (Modern).

### 4.1 Comparison of Tools

| Feature | Spatie Browsershot / Laravel PDF | html2pdf (TCPDF) | JpGraph |
| :--- | :--- | :--- | :--- |
| **Engine** | Headless Chrome (Puppeteer) | PHP (TCPDF) | PHP (GD/ImageMagick) |
| **Chart.js Support**| ✅ Native (runs JS) | ❌ No JS support | ❌ (Generates images) |
| **CSS Support** | ✅ Full (Grid, Flexbox, Tailwind) | ⚠️ Limited (No Grid/Flex) | ❌ None |
| **Aesthetic** | ⭐️ Premium (Matches Web) | 📉 Dated | 📉 "Scientific/Retro" |
| **Server Req** | Node.js + Puppeteer | PHP Ext only | PHP Ext (GD) |
| **Performance** | Slower (Browser boot) | Fast | Very Fast |
| **Scalability** | Medium (CPU heavy) | High | High |

### 4.2 Path A: The Modern Standard (Spatie Laravel PDF)
**Recommended for Quaeris.**
This approach uses `spatie/laravel-pdf` (a wrapper around Browsershot) to render Blade views exactly as they appear in the browser.

*   **Pros**: 100% visual fidelity, DRY (reuse Blade components), Modern CSS.
*   **Cons**: Requires Node.js/Puppeteer on server.
*   **Implementation**:
    ```bash
    composer require spatie/laravel-pdf
    ```

### 4.3 Path B: The Legacy/No-Node Fallback (JpGraph + html2pdf)
**Use ONLY if Node.js is strictly forbidden.**
This approach generates chart images server-side using PHP (JpGraph) and embeds them into a basic HTML table layout converted by `html2pdf`.

*   **Pros**: Pure PHP, no external dependencies, fast.
*   **Cons**: Ugly charts (Windows 98 style), hard to style, HTML layout is painful (no Flexbox).
*   **Implementation**:
    1.  Install `mitoteam/jpgraph` (PHP 8.3 compatible fork).
    2.  Generate Image -> Save to Temp -> Embed `<img src="...">`.
    3.  Feed HTML to `spipu/html2pdf`.

## 5. Implementation Guide: Path A (Spatie Laravel PDF)

### 5.1 Controller
```php
use Spatie\LaravelPdf\Facades\Pdf;

public function download(Survey $survey)
{
    $data = app(GetSurveyReportDataAction::class)->execute($survey);

    return Pdf::view('reports.pdf.survey-report', ['data' => $data])
        ->format('A4')
        ->withBrowsershot(function (Browsershot $browsershot) {
            $browsershot->noSandbox();
            $browsershot->waitUntilNetworkIdle(); // Wait for Chart animations
        })
        ->download("report-{$survey->id}.pdf");
}
```

### 5.2 Blade View (`reports/pdf/survey-report.blade.php`)
*   Include Tailwind via CDN (or cached CSS).
*   Include Chart.js.
*   **CRITICAL**: Disable Chart animations.
    ```javascript
    const config = {
        type: 'line',
        options: {
            animation: false, // MANDATORY for PDF
            responsive: false, // Fix dimensions for PDF
        }
    };
    ```
3.  **Timeouts**: Charts take time to render. `waitUntilNetworkIdle()` is often safer than `window.status` checks.

---

## 5. Summary Checklist

- [ ] **Data**: Use `SurveyFlip` patterns for fast SQL aggregation.
- [ ] **Charts**: Setup `ChartWidget` with "Premium" options (Font, Legend, Padding).
- [ ] **PDF**: Use `Spatie\Browsershot`.
    - [ ] Blade View with specialized "Print" styles.
    - [ ] `animation: false` in JS.
    - [ ] `showBackground()` enabled.

## 6. Advanced Strategy: Exporting Entire Dashboards to PDF

A common request is "Download this Dashboard as PDF".
**Problem**: Dashboards are complex grids with navigation, sidebars, and interactive elements (useless in PDF).
**Solution**: The "Shadow Report Pattern".

### 6.1 The Shadow Report Pattern
For every Dashboard (e.g., `SurveyDashboard`), creating a corresponding "Print View" Blade file (`resources/views/reports/survey-dashboard-pdf.blade.php`).

1.  **Reuse Logic**: Do *not* duplicate data fetching. Extract data logic into Action classes (e.g., `GetSurveySatisfactionStatsAction`).
2.  **Inject Data**: The Controller calling Browsershot fetches data using these Actions and passes it to the Print View.
3.  **Visual Consistency**: The Print View uses the same Tailwind classes/colors as the Dashboard but in a linear layout (Stack of widgets) rather than a Grid, optimized for A4 paper.

### 6.2 Implementation Example

```php
// Action to prepare data for BOTH Dashboard and PDF
class GetDashboardDataAction {
    public function execute(int $surveyId, ?array $filters = []) {
        return [
            'satisfaction' => ...,
            'responses_trend' => ...,
            'nps_score' => ...
        ];
    }
}

// In Dashboard Widget
protected function getData(): array {
    return app(GetDashboardDataAction::class)->execute($this->surveyId)['satisfaction'];
}

// In PDF Controller
public function download(Survey $survey) {
    $data = app(GetDashboardDataAction::class)->execute($survey->id);
    $html = view('reports.survey-dashboard-pdf', ['data' => $data])->render();
    return Browsershot::html($html)->pdf();
}
```

## 7. Professional Widget Configuration (Filament 4)

### 7.1 Advanced Filters
Use `HasFiltersForm` to create sidebar-like filters for your widgets.

```php
use Filament\Widgets\ChartWidget;
use Filament\Forms\Components\DatePicker;

class ResponsesTrendChart extends ChartWidget
{
    protected function getFiltersSchema(): array
    {
        return [
            DatePicker::make('start_date'),
            DatePicker::make('end_date'),
        ];
    }

    protected function getData(): array
    {
        $start = $this->filters['start_date'] ?? now()->subMonth();
        $end = $this->filters['end_date'] ?? now();
        
        // Use these dates in your query
    }
}
```

### 7.2 Polling & Performance
For heavy widgets, always use:
- `protected static bool $isLazy = true;` (Load after page init)
- `protected int | string | array $columnSpan = 'full';` (Responsive sizing)
- `protected static ?string $pollingInterval = '60s';` (Avoids hammering server)

