<?php

namespace App\Filament\Widgets;

use App\Models\Complaint;
use App\Models\District;
use App\Models\ServiceRequest;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;

class DistrictDistributionChart extends ChartWidget
{
    use InteractsWithPageFilters;

    protected ?string $heading = 'Sebaran per Kecamatan';

    protected static ?int $sort = 5;

    protected int|string|array $columnSpan = [
        'sm' => 'full',
        'lg' => 2,
    ];

    protected ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $startDate = $this->filters['startDate'] ?? null;
        $endDate = $this->filters['endDate'] ?? null;

        $districts = District::orderBy('name')->get();

        $labels = [];
        $data = [];
        $colors = [
            'rgba(59, 130, 246, 0.8)',
            'rgba(245, 158, 11, 0.8)',
            'rgba(16, 185, 129, 0.8)',
            'rgba(139, 92, 246, 0.8)',
            'rgba(236, 72, 153, 0.8)',
            'rgba(20, 184, 166, 0.8)',
            'rgba(249, 115, 22, 0.8)',
            'rgba(99, 102, 241, 0.8)',
            'rgba(244, 63, 94, 0.8)',
            'rgba(34, 197, 94, 0.8)',
            'rgba(168, 85, 247, 0.8)',
            'rgba(234, 179, 8, 0.8)',
            'rgba(14, 165, 233, 0.8)',
            'rgba(251, 146, 60, 0.8)',
            'rgba(129, 140, 248, 0.8)',
            'rgba(52, 211, 153, 0.8)',
            'rgba(232, 121, 249, 0.8)',
            'rgba(250, 204, 21, 0.8)',
            'rgba(56, 189, 248, 0.8)',
            'rgba(248, 113, 113, 0.8)',
            'rgba(167, 139, 250, 0.8)',
            'rgba(45, 212, 191, 0.8)',
        ];

        foreach ($districts as $index => $district) {
            $villageIds = $district->villages()->pluck('id');

            if ($villageIds->isEmpty()) {
                continue;
            }

            $pengajuan = ServiceRequest::query()
                ->whereIn('village_id', $villageIds)
                ->when($startDate, fn ($q, $date) => $q->whereDate('submitted_at', '>=', $date))
                ->when($endDate, fn ($q, $date) => $q->whereDate('submitted_at', '<=', $date))
                ->count();

            $pengaduan = Complaint::query()
                ->whereIn('village_id', $villageIds)
                ->when($startDate, fn ($q, $date) => $q->whereDate('reported_at', '>=', $date))
                ->when($endDate, fn ($q, $date) => $q->whereDate('reported_at', '<=', $date))
                ->count();

            $total = $pengajuan + $pengaduan;

            if ($total > 0) {
                $labels[] = $district->name;
                $data[] = $total;
            }
        }

        return [
            'datasets' => [
                [
                    'data' => $data,
                    'backgroundColor' => array_slice(
                        array_merge($colors, $colors),
                        0,
                        count($data)
                    ),
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'position' => 'right',
                    'labels' => ['boxWidth' => 12],
                ],
            ],
        ];
    }
}
