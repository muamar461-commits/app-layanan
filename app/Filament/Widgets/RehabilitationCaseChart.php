<?php

namespace App\Filament\Widgets;

use App\Enums\RehabilitationCaseStatus;
use App\Models\RehabilitationCase;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;

class RehabilitationCaseChart extends ChartWidget
{
    use InteractsWithPageFilters;

    protected ?string $heading = 'Kasus Rehabilitasi Sosial per Status';

    protected static ?int $sort = 6;

    protected int|string|array $columnSpan = [
        'sm' => 'full',
        'lg' => 2,
    ];

    protected ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $districtId = $this->filters['district_id'] ?? null;
        $villageId = $this->filters['village_id'] ?? null;

        $statuses = RehabilitationCaseStatus::cases();

        $statusColors = [
            RehabilitationCaseStatus::Received->value => 'rgba(99, 102, 241, 0.8)',
            RehabilitationCaseStatus::Assessment->value => 'rgba(245, 158, 11, 0.8)',
            RehabilitationCaseStatus::ServicePlanning->value => 'rgba(139, 92, 246, 0.8)',
            RehabilitationCaseStatus::InService->value => 'rgba(59, 130, 246, 0.8)',
            RehabilitationCaseStatus::Monitoring->value => 'rgba(20, 184, 166, 0.8)',
            RehabilitationCaseStatus::Closed->value => 'rgba(16, 185, 129, 0.8)',
        ];

        $labels = [];
        $data = [];
        $colors = [];

        foreach ($statuses as $status) {
            $count = RehabilitationCase::query()
                ->where('status', $status)
                ->when($districtId, fn ($q, $id) => $q->whereHas('client', fn ($c) => $c->whereHas('village', fn ($v) => $v->where('district_id', $id))))
                ->when($villageId, fn ($q, $id) => $q->whereHas('client', fn ($c) => $c->where('village_id', $id)))
                ->count();

            $labels[] = $status->label();
            $data[] = $count;
            $colors[] = $statusColors[$status->value] ?? 'rgba(156, 163, 175, 0.8)';
        }

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Kasus',
                    'data' => $data,
                    'backgroundColor' => $colors,
                    'borderRadius' => 6,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getOptions(): array
    {
        return [
            'indexAxis' => 'y',
            'plugins' => [
                'legend' => ['display' => false],
            ],
            'scales' => [
                'x' => [
                    'beginAtZero' => true,
                    'ticks' => ['precision' => 0],
                ],
            ],
        ];
    }
}
