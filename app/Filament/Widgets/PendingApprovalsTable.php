<?php

namespace App\Filament\Widgets;

use App\Enums\ApprovalDecision;
use App\Models\Approval;
use App\Models\DtsenCertificate;
use App\Models\PbiReactivation;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\TableWidget as BaseWidget;

class PendingApprovalsTable extends BaseWidget
{
    use InteractsWithPageFilters;

    protected static ?int $sort = 8;

    protected int|string|array $columnSpan = [
        'sm' => 'full',
        'lg' => 2,
    ];

    protected static ?string $heading = 'Menunggu Tanda Tangan';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Approval::query()
                    ->with(['approvable.serviceRequest', 'approver'])
                    ->where('decision', ApprovalDecision::Pending)
                    ->oldest('created_at')
            )
            ->columns([
                TextColumn::make('request_number')
                    ->label('No. Tiket')
                    ->weight('bold')
                    ->color('primary')
                    ->getStateUsing(function (Approval $record): string {
                        $approvable = $record->approvable;

                        if ($approvable instanceof DtsenCertificate || $approvable instanceof PbiReactivation) {
                            return $approvable->serviceRequest?->request_number ?? '-';
                        }

                        return '-';
                    }),
                TextColumn::make('type')
                    ->label('Tipe')
                    ->badge()
                    ->getStateUsing(function (Approval $record): string {
                        return match ($record->approvable_type) {
                            DtsenCertificate::class => 'SK DTSEN',
                            PbiReactivation::class => 'Rekomendasi PBI-JK',
                            default => 'Lainnya',
                        };
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'SK DTSEN' => 'info',
                        'Rekomendasi PBI-JK' => 'warning',
                        default => 'gray',
                    }),
                TextColumn::make('applicant_name')
                    ->label('Pemohon')
                    ->getStateUsing(function (Approval $record): string {
                        $approvable = $record->approvable;

                        if ($approvable instanceof DtsenCertificate || $approvable instanceof PbiReactivation) {
                            return $approvable->serviceRequest?->applicant_name ?? '-';
                        }

                        return '-';
                    }),
                TextColumn::make('step')
                    ->label('Tahap')
                    ->badge()
                    ->formatStateUsing(fn (int $state): string => match ($state) {
                        1 => 'Paraf Kabid',
                        2 => 'Tanda Tangan Kadis',
                        default => "Tahap $state",
                    })
                    ->color(fn (int $state): string => match ($state) {
                        1 => 'info',
                        2 => 'warning',
                        default => 'gray',
                    }),
                TextColumn::make('created_at')
                    ->label('Menunggu Sejak')
                    ->since()
                    ->sortable(),
            ])
            ->defaultPaginationPageOption(5)
            ->defaultSort('created_at', 'asc')
            ->emptyStateHeading('Tidak ada yang menunggu')
            ->emptyStateDescription('Semua persetujuan sudah ditindaklanjuti.')
            ->emptyStateIcon('heroicon-o-check-circle');
    }
}
