<?php

namespace App\Filament\Widgets;

use App\Enums\MinistryDecision;
use App\Models\PbiReactivation;
use Carbon\Carbon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\TableWidget as BaseWidget;

class StalledPbiTable extends BaseWidget
{
    use InteractsWithPageFilters;

    protected static ?int $sort = 9;

    protected int|string|array $columnSpan = [
        'sm' => 'full',
        'lg' => 2,
    ];

    protected static ?string $heading = 'Reaktivasi PBI-JK Tertahan';

    /**
     * Jumlah hari batas tertahan sebelum muncul di tabel ini.
     */
    private const STALLED_THRESHOLD_DAYS = 30;

    public function table(Table $table): Table
    {
        $districtId = $this->filters['district_id'] ?? null;
        $villageId = $this->filters['village_id'] ?? null;

        return $table
            ->query(
                PbiReactivation::query()
                    ->with(['serviceRequest.village.district'])
                    ->whereNotNull('proposed_to_ministry_at')
                    ->where('ministry_decision', MinistryDecision::Pending)
                    ->where('proposed_to_ministry_at', '<=', now()->subDays(self::STALLED_THRESHOLD_DAYS))
                    ->when($districtId || $villageId, fn ($q) => $q->whereHas(
                        'serviceRequest',
                        fn ($sr) => $sr
                            ->when($districtId, fn ($q2, $id) => $q2->whereHas('village', fn ($v) => $v->where('district_id', $id)))
                            ->when($villageId, fn ($q2, $id) => $q2->where('village_id', $id))
                    ))
                    ->oldest('proposed_to_ministry_at')
            )
            ->columns([
                TextColumn::make('serviceRequest.request_number')
                    ->label('No. Tiket')
                    ->weight('bold')
                    ->color('primary'),
                TextColumn::make('participant_name')
                    ->label('Peserta')
                    ->limit(25),
                TextColumn::make('proposed_to_ministry_at')
                    ->label('Diusulkan')
                    ->dateTime('d M Y'),
                TextColumn::make('days_stalled')
                    ->label('Lama Tertahan')
                    ->getStateUsing(function (PbiReactivation $record): string {
                        if (! $record->proposed_to_ministry_at) {
                            return '-';
                        }

                        $days = Carbon::parse($record->proposed_to_ministry_at)->diffInDays(now());

                        return $days.' hari';
                    })
                    ->badge()
                    ->color('danger'),
                TextColumn::make('serviceRequest.is_priority')
                    ->label('Prioritas')
                    ->badge()
                    ->formatStateUsing(fn ($state): string => $state ? 'Darurat' : '-')
                    ->color(fn ($state): string => $state ? 'danger' : 'gray'),
            ])
            ->defaultPaginationPageOption(5)
            ->defaultSort('proposed_to_ministry_at', 'asc')
            ->emptyStateHeading('Tidak ada yang tertahan')
            ->emptyStateDescription('Semua usulan reaktivasi dalam batas waktu normal.')
            ->emptyStateIcon('heroicon-o-check-circle');
    }
}
