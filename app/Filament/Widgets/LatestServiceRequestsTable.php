<?php

namespace App\Filament\Widgets;

use App\Enums\ServiceRequestStatus;
use App\Models\ServiceRequest;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestServiceRequestsTable extends BaseWidget
{
    use InteractsWithPageFilters;

    protected static ?int $sort = 7;

    protected int|string|array $columnSpan = 'full';

    protected static ?string $heading = 'Pengajuan Terbaru';

    public function table(Table $table): Table
    {
        $startDate = $this->filters['startDate'] ?? null;
        $endDate = $this->filters['endDate'] ?? null;
        $serviceTypeId = $this->filters['service_type_id'] ?? null;
        $districtId = $this->filters['district_id'] ?? null;
        $villageId = $this->filters['village_id'] ?? null;

        return $table
            ->query(
                ServiceRequest::query()
                    ->with(['serviceType', 'village.district'])
                    ->when($startDate, fn ($q, $date) => $q->whereDate('submitted_at', '>=', $date))
                    ->when($endDate, fn ($q, $date) => $q->whereDate('submitted_at', '<=', $date))
                    ->when($serviceTypeId, fn ($q, $id) => $q->where('service_type_id', $id))
                    ->when($districtId, fn ($q, $id) => $q->whereHas('village', fn ($v) => $v->where('district_id', $id)))
                    ->when($villageId, fn ($q, $id) => $q->where('village_id', $id))
                    ->latest('submitted_at')
            )
            ->columns([
                TextColumn::make('request_number')
                    ->label('No. Tiket')
                    ->searchable()
                    ->weight('bold')
                    ->color('primary'),
                TextColumn::make('serviceType.name')
                    ->label('Jenis Layanan')
                    ->badge(),
                TextColumn::make('applicant_name')
                    ->label('Pemohon')
                    ->searchable()
                    ->limit(30),
                TextColumn::make('village.district.name')
                    ->label('Kecamatan'),
                TextColumn::make('village.name')
                    ->label('Desa/Kelurahan'),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn (ServiceRequestStatus $state): string => $state->label())
                    ->color(fn (ServiceRequestStatus $state): string => match ($state) {
                        ServiceRequestStatus::Submitted => 'gray',
                        ServiceRequestStatus::DocumentCheck, ServiceRequestStatus::Verification => 'info',
                        ServiceRequestStatus::RevisionRequested => 'warning',
                        ServiceRequestStatus::DataVerification, ServiceRequestStatus::EligibilityVerification, ServiceRequestStatus::Assessment => 'primary',
                        ServiceRequestStatus::AwaitingApproval => 'warning',
                        ServiceRequestStatus::InProcess, ServiceRequestStatus::ProposedToMinistry => 'info',
                        ServiceRequestStatus::Issued, ServiceRequestStatus::RecommendationIssued, ServiceRequestStatus::MinistryApproved, ServiceRequestStatus::Reactivated => 'success',
                        ServiceRequestStatus::Completed => 'success',
                        ServiceRequestStatus::Rejected, ServiceRequestStatus::MinistryRejected => 'danger',
                    }),
                TextColumn::make('submitted_at')
                    ->label('Tanggal')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->defaultPaginationPageOption(5)
            ->defaultSort('submitted_at', 'desc');
    }
}
