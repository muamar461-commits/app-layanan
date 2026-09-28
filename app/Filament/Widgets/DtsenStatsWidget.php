<?php

namespace App\Filament\Widgets;

use App\Enums\ServiceRequestStatus;
use App\Models\DtsenCertificate;
use App\Models\ServiceRequest;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DtsenStatsWidget extends StatsOverviewWidget
{
    use InteractsWithPageFilters;

    protected static ?int $sort = 1;

    protected int|string|array $columnSpan = [
        'sm' => 'full',
        'lg' => 2,
    ];

    protected function getStats(): array
    {
        $startDate = $this->filters['startDate'] ?? null;
        $endDate = $this->filters['endDate'] ?? null;
        $districtId = $this->filters['district_id'] ?? null;
        $villageId = $this->filters['village_id'] ?? null;

        $baseServiceRequestFilter = fn ($q) => $q
            ->when($districtId, fn ($q2, $id) => $q2->whereHas('village', fn ($v) => $v->where('district_id', $id)))
            ->when($villageId, fn ($q2, $id) => $q2->where('village_id', $id));

        $diterbitkan = DtsenCertificate::query()
            ->whereNotNull('issued_at')
            ->when($startDate, fn ($q, $date) => $q->whereDate('issued_at', '>=', $date))
            ->when($endDate, fn ($q, $date) => $q->whereDate('issued_at', '<=', $date))
            ->when($districtId || $villageId, fn ($q) => $q->whereHas('serviceRequest', $baseServiceRequestFilter))
            ->count();

        $menungguTtd = ServiceRequest::query()
            ->where('status', ServiceRequestStatus::AwaitingApproval)
            ->whereHas('dtsenCertificate')
            ->when($districtId, fn ($q, $id) => $q->whereHas('village', fn ($v) => $v->where('district_id', $id)))
            ->when($villageId, fn ($q, $id) => $q->where('village_id', $id))
            ->count();

        $ditolak = ServiceRequest::query()
            ->where('status', ServiceRequestStatus::Rejected)
            ->whereHas('dtsenCertificate')
            ->when($startDate, fn ($q, $date) => $q->whereDate('completed_at', '>=', $date))
            ->when($endDate, fn ($q, $date) => $q->whereDate('completed_at', '<=', $date))
            ->when($districtId, fn ($q, $id) => $q->whereHas('village', fn ($v) => $v->where('district_id', $id)))
            ->when($villageId, fn ($q, $id) => $q->where('village_id', $id))
            ->count();

        return [
            Stat::make('SK DTSEN Diterbitkan', number_format($diterbitkan))
                ->description('Surat terbit pada periode ini')
                ->descriptionIcon('heroicon-m-document-check')
                ->color('success'),
            Stat::make('Menunggu Tanda Tangan', number_format($menungguTtd))
                ->description('Antrean paraf/persetujuan')
                ->descriptionIcon('heroicon-m-pencil-square')
                ->color($menungguTtd > 0 ? 'warning' : 'success'),
            Stat::make('Ditolak', number_format($ditolak))
                ->description('Pengajuan DTSEN ditolak')
                ->descriptionIcon('heroicon-m-x-circle')
                ->color($ditolak > 0 ? 'danger' : 'gray'),
        ];
    }

    protected function getHeading(): ?string
    {
        return 'Surat Keterangan DTSEN';
    }
}
