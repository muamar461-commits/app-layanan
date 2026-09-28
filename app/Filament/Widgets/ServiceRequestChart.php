<?php

namespace App\Filament\Widgets;

use App\Models\ServiceRequest;
use App\Models\ServiceType;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;

class ServiceRequestChart extends ChartWidget
{
    use InteractsWithPageFilters;

    protected ?string $heading = 'Pengajuan per Jenis Layanan';

    protected static ?int $sort = 3;

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

        $serviceTypes = ServiceType::where('is_active', true)
            ->orderBy('name')
            ->get();

        $data = [];
        $labels = [];
        $backgroundColors = [
            'rgba(59, 130, 246, 0.8)',   // blue
            'rgba(245, 158, 11, 0.8)',   // amber
            'rgba(16, 185, 129, 0.8)',   // emerald
            'rgba(139, 92, 246, 0.8)',   // violet
            'rgba(236, 72, 153, 0.8)',   // pink
            'rgba(20, 184, 166, 0.8)',   // teal
            'rgba(249, 115, 22, 0.8)',   // orange
            'rgba(99, 102, 241, 0.8)',   // indigo
        ];

        foreach ($serviceTypes as $index => $type) {
            $labels[] = $type->name;
            $data[] = ServiceRequest::query()
                ->where('service_type_id', $type->id)
                ->when($startDate, fn ($q, $date) => $q->whereDate('submitted_at', '>=', $date))
                ->when($endDate, fn ($q, $date) => $q->whereDate('submitted_at', '<=', $date))
                ->when($districtId, fn ($q, $id) => $q->whereHas('village', fn ($v) => $v->where('district_id', $id)))
                ->when($villageId, fn ($q, $id) => $q->where('village_id', $id))
                ->count();
        }

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Pengajuan',
                    'data' => $data,
                    'backgroundColor' => array_slice(
                        array_merge($backgroundColors, $backgroundColors),
                        0,
                        count($data)
                    ),
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
            'plugins' => [
                'legend' => ['display' => false],
            ],
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => ['precision' => 0],
                ],
            ],
        ];
    }
}
