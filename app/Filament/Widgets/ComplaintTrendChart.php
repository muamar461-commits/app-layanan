<?php

namespace App\Filament\Widgets;

use App\Models\Complaint;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;

class ComplaintTrendChart extends ChartWidget
{
    use InteractsWithPageFilters;

    protected ?string $heading = 'Tren Pengaduan';

    protected static ?int $sort = 4;

    protected int|string|array $columnSpan = [
        'sm' => 'full',
        'lg' => 2,
    ];

    protected ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $startDate = $this->filters['startDate'] ?? null;
        $endDate = $this->filters['endDate'] ?? null;
        $districtId = $this->filters['district_id'] ?? null;
        $villageId = $this->filters['village_id'] ?? null;

        // Default: 6 bulan terakhir jika filter kosong
        $start = $startDate ? Carbon::parse($startDate)->startOfMonth() : now()->subMonths(5)->startOfMonth();
        $end = $endDate ? Carbon::parse($endDate)->endOfMonth() : now()->endOfMonth();

        $months = CarbonPeriod::create($start, '1 month', $end);
        $labels = [];
        $masukData = [];
        $selesaiData = [];

        foreach ($months as $month) {
            $labels[] = $month->translatedFormat('M Y');

            $baseQuery = Complaint::query()
                ->when($districtId, fn ($q, $id) => $q->whereHas('village', fn ($v) => $v->where('district_id', $id)))
                ->when($villageId, fn ($q, $id) => $q->where('village_id', $id));

            $masukData[] = (clone $baseQuery)
                ->whereYear('reported_at', $month->year)
                ->whereMonth('reported_at', $month->month)
                ->count();

            $selesaiData[] = (clone $baseQuery)
                ->whereNotNull('resolved_at')
                ->whereYear('resolved_at', $month->year)
                ->whereMonth('resolved_at', $month->month)
                ->count();
        }

        return [
            'datasets' => [
                [
                    'label' => 'Pengaduan Masuk',
                    'data' => $masukData,
                    'borderColor' => 'rgba(245, 158, 11, 1)',
                    'backgroundColor' => 'rgba(245, 158, 11, 0.1)',
                    'fill' => true,
                    'tension' => 0.4,
                ],
                [
                    'label' => 'Pengaduan Selesai',
                    'data' => $selesaiData,
                    'borderColor' => 'rgba(16, 185, 129, 1)',
                    'backgroundColor' => 'rgba(16, 185, 129, 0.1)',
                    'fill' => true,
                    'tension' => 0.4,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => ['precision' => 0],
                ],
            ],
        ];
    }
}
