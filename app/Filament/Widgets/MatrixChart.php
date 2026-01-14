<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;
use Modules\Limesurvey\Models\SurveyResponse;

class MatrixChart extends ChartWidget
{
    public string $surveyId;

    public int $questionId;

    public array $subQuestions; // Lista delle sotto-domande (righe della matrice)

    protected ?string $heading = 'Risposte a Domande a Matrice';

    public function __construct(string $surveyId, int $questionId, array $subQuestions)
    {
        $this->surveyId = $surveyId;
        $this->questionId = $questionId;
        $this->subQuestions = $subQuestions;
    }

    protected function getType(): string
    {
        // Il tipo di grafico, in questo caso "bar" (impilate)
        return 'bar';
    }

    protected function getChartData(): array
    {
        // Esempio di risposte per una matrice
        $datasets = [];
        $labels = ['Fortemente in disaccordo', 'In disaccordo', 'Neutrale', 'D’accordo', 'Fortemente d’accordo'];

        foreach ($this->subQuestions as $subQuestion) {
            // Ensure subQuestion has required keys and proper types
            $code = is_array($subQuestion) && isset($subQuestion['code']) ? (string) $subQuestion['code'] : '';
            $text = is_array($subQuestion) && isset($subQuestion['text']) ? (string) $subQuestion['text'] : '';
            
            if ($code === '') {
                continue; // Skip if code is empty
            }
            
            // Recupera le risposte per ogni sotto-domanda della matrice
            $responses = SurveyResponse::getResponsesForSurvey($this->surveyId)
                ->select(DB::raw('COUNT(*) as count'), DB::raw("answer_{$this->questionId}_{$code} as answer"))
                ->groupBy("answer_{$this->questionId}_{$code}")
                ->get();

            $datasets[] = [
                'label' => $text,
                'data' => $responses->pluck('count')->toArray(),
            ];
        }

        return [
            'labels' => $labels,
            'datasets' => $datasets,
        ];
    }
}
