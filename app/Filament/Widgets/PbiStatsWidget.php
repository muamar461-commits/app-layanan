<?php

namespace App\Filament\Widgets;

use App\Enums\MinistryDecision;
use App\Enums\ServiceRequestStatus;
use App\Models\PbiReactivation;
use App\Models\ServiceRequest;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PbiStatsWidget extends StatsOverviewWidget
{
    use InteractsWithPageFilters;

    protected static ?int $sort = 2;

    protected int|string|array $columnSpan = [
        'sm' => 'full',
        'lg' => 2,
    ];

    /**
     * Jumlah hari batas tertahan di Kemensos sebelum ditandai peringatan.
     * Idealnya dibaca dari pengaturan admin, di-default 30 hari.
     */
    private const STALLED_THRESHOLD_DAYS = 30;

    protected function getStats(): array
    {
        $startDate = $this->filters['startDate'] ?? null;
        $endDate = $this->filters['endDate'] ?? null;
        $districtId = $this->filters['district_id'] ?? null;
        $villageId = $this->filters['village_id'] ?? null;

        $pbiRequestScope = fn ($q) => $q
            ->whereHas('pbiReactivation')
            ->when($districtId, fn ($q2, $id) => $q2->whereHas('village', fn ($v) => $v->where('district_id', $id)))
            ->when($villageId, fn ($q2, $id) => $q2->where('village_id', $id));

        $verifikasi = ServiceRequest::query()
            ->tap($pbiRequestScope)
            ->where('status', ServiceRequestStatus::EligibilityVerification)
            ->count();

        $menungguKemensos = ServiceRequest::query()
            ->tap($pbiRequestScope)
            ->where('status', ServiceRequestStatus::ProposedToMinistry)
            ->count();

        $aktifKembali = ServiceRequest::query()
            ->tap($pbiRequestScope)
            ->whereIn('status', [ServiceRequestStatus::Reactivated, ServiceRequestStatus::Completed])
            ->when($startDate, fn ($q, $date) => $q->whereDate('completed_at', '>=', $date))
            ->when($endDate, fn ($q, $date) => $q->whereDate('completed_at', '<=', $date))
            ->count();

        $daruratMedis = ServiceRequest::query()
            ->where('is_priority', true)
            ->whereHas('pbiReactivation')
            ->whereNotIn('status', [
                ServiceRequestStatus::Completed,
                ServiceRequestStatus::Rejected,
                ServiceRequestStatus::MinistryRejected,
            ])
            ->when($districtId, fn ($q, $id) => $q->whereHas('village', fn ($v) => $v->where('district_id', $id)))
            ->when($villageId, fn ($q, $id) => $q->where('village_id', $id))
            ->count();

        $tertahan = PbiReactivation::query()
            ->whereNotNull('proposed_to_ministry_at')
            ->where('ministry_decision', MinistryDecision::Pending)
            ->where('proposed_to_ministry_at', '<=', now()->subDays(self::STALLED_THRESHOLD_DAYS))
            ->when($districtId || $villageId, fn ($q) => $q->whereHas(
                'serviceRequest',
                fn ($sr) => $sr
                    ->when($districtId, fn ($q2, $id) => $q2->whereHas('village', fn ($v) => $v->where('district_id', $id)))
                    ->when($villageId, fn ($q2, $id) => $q2->where('village_id', $id))
            ))
            ->count();

        return [
            Stat::make('Verifikasi Kelayakan', number_format($verifikasi))
                ->description('Dalam proses verifikasi')
                ->descriptionIcon('heroicon-m-clipboard-document-check')
                ->color('info'),
            Stat::make('Menunggu Kemensos', number_format($menungguKemensos))
                ->description('Diusulkan ke Kemensos')
                ->descriptionIcon('heroicon-m-building-office')
                ->color($menungguKemensos > 0 ? 'warning' : 'success'),
            Stat::make('Aktif Kembali', number_format($aktifKembali))
                ->description('Kepesertaan aktif kembali')
                ->descriptionIcon('heroicon-m-check-badge')
                ->color('success'),
            Stat::make('Darurat Medis', number_format($daruratMedis))
                ->description('Prioritas belum selesai')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color($daruratMedis > 0 ? 'danger' : 'gray'),
            Stat::make('Tertahan > '.self::STALLED_THRESHOLD_DAYS.' Hari', number_format($tertahan))
                ->description('Perlu ditindaklanjuti')
                ->descriptionIcon('heroicon-m-clock')
                ->color($tertahan > 0 ? 'danger' : 'gray'),
        ];
    }

    protected function getHeading(): ?string
    {
        return 'Reaktivasi KIS / PBI-JK';
    }
}
