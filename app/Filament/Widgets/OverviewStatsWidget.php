<?php

namespace App\Filament\Widgets;

use App\Enums\ComplaintStatus;
use App\Enums\RehabilitationCaseStatus;
use App\Enums\ServiceRequestStatus;
use App\Models\Complaint;
use App\Models\RehabilitationCase;
use App\Models\ServiceRequest;
use Carbon\Carbon;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class OverviewStatsWidget extends StatsOverviewWidget
{
    use InteractsWithPageFilters;

    protected static ?int $sort = 0;

    protected int|string|array $columnSpan = 'full';

    protected function getStats(): array
    {
        $startDate = $this->filters['startDate'] ?? null;
        $endDate = $this->filters['endDate'] ?? null;
        $serviceTypeId = $this->filters['service_type_id'] ?? null;
        $districtId = $this->filters['district_id'] ?? null;
        $villageId = $this->filters['village_id'] ?? null;

        $totalPengajuan = ServiceRequest::query()
            ->when($startDate, fn ($q, $date) => $q->whereDate('submitted_at', '>=', $date))
            ->when($endDate, fn ($q, $date) => $q->whereDate('submitted_at', '<=', $date))
            ->when($serviceTypeId, fn ($q, $id) => $q->where('service_type_id', $id))
            ->when($districtId, fn ($q, $id) => $q->whereHas('village', fn ($v) => $v->where('district_id', $id)))
            ->when($villageId, fn ($q, $id) => $q->where('village_id', $id))
            ->count();

        $totalPengaduan = Complaint::query()
            ->when($startDate, fn ($q, $date) => $q->whereDate('reported_at', '>=', $date))
            ->when($endDate, fn ($q, $date) => $q->whereDate('reported_at', '<=', $date))
            ->when($districtId, fn ($q, $id) => $q->whereHas('village', fn ($v) => $v->where('district_id', $id)))
            ->when($villageId, fn ($q, $id) => $q->where('village_id', $id))
            ->count();

        $kasusRehsosAktif = RehabilitationCase::query()
            ->where('status', '!=', RehabilitationCaseStatus::Closed)
            ->when($districtId, fn ($q, $id) => $q->whereHas('client', fn ($c) => $c->whereHas('village', fn ($v) => $v->where('district_id', $id))))
            ->when($villageId, fn ($q, $id) => $q->whereHas('client', fn ($c) => $c->where('village_id', $id)))
            ->count();

        $layananSelesai = ServiceRequest::query()
            ->where('status', ServiceRequestStatus::Completed)
            ->when($startDate, fn ($q, $date) => $q->whereDate('completed_at', '>=', $date))
            ->when($endDate, fn ($q, $date) => $q->whereDate('completed_at', '<=', $date))
            ->when($serviceTypeId, fn ($q, $id) => $q->where('service_type_id', $id))
            ->when($districtId, fn ($q, $id) => $q->whereHas('village', fn ($v) => $v->where('district_id', $id)))
            ->when($villageId, fn ($q, $id) => $q->where('village_id', $id))
            ->count();

        $pengaduanSelesai = Complaint::query()
            ->where('status', ComplaintStatus::Resolved)
            ->when($startDate, fn ($q, $date) => $q->whereDate('resolved_at', '>=', $date))
            ->when($endDate, fn ($q, $date) => $q->whereDate('resolved_at', '<=', $date))
            ->when($districtId, fn ($q, $id) => $q->whereHas('village', fn ($v) => $v->where('district_id', $id)))
            ->when($villageId, fn ($q, $id) => $q->where('village_id', $id))
            ->count();

        $totalSelesai = $layananSelesai + $pengaduanSelesai;

        // Sparkline: pengajuan per hari (7 hari terakhir)
        $pengajuanPerHari = $this->getDailyTrend(ServiceRequest::class, 'submitted_at');
        $pengaduanPerHari = $this->getDailyTrend(Complaint::class, 'reported_at');

        return [
            Stat::make('Pengajuan Masuk', number_format($totalPengajuan))
                ->description('Periode terpilih')
                ->descriptionIcon('heroicon-m-document-text')
                ->chart($pengajuanPerHari)
                ->color('primary'),
            Stat::make('Pengaduan Masuk', number_format($totalPengaduan))
                ->description('Periode terpilih')
                ->descriptionIcon('heroicon-m-megaphone')
                ->chart($pengaduanPerHari)
                ->color('warning'),
            Stat::make('Kasus Rehsos Aktif', number_format($kasusRehsosAktif))
                ->description('Belum ditutup')
                ->descriptionIcon('heroicon-m-heart')
                ->color('info'),
            Stat::make('Layanan Selesai', number_format($totalSelesai))
                ->description($layananSelesai.' pengajuan, '.$pengaduanSelesai.' pengaduan')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),
        ];
    }

    /**
     * Mengambil tren harian 7 hari terakhir untuk sparkline chart.
     *
     * @return array<int, int>
     */
    private function getDailyTrend(string $model, string $dateColumn): array
    {
        $trend = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $trend[] = $model::whereDate($dateColumn, $date)->count();
        }

        return $trend;
    }
}
