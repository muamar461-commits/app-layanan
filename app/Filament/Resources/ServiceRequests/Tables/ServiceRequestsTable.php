<?php

namespace App\Filament\Resources\ServiceRequests\Tables;

use App\Enums\ServiceRequestStatus;
use App\Models\ServiceRequest;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class ServiceRequestsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('request_number')
                    ->label('No. Pengajuan')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                TextColumn::make('applicant_name')
                    ->label('Nama Pemohon')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('applicant_nik')
                    ->label('NIK')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('serviceType.name')
                    ->label('Jenis Layanan')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('village.name')
                    ->label('Desa/Kelurahan')
                    ->searchable()
                    ->sortable(),
                IconColumn::make('is_priority')
                    ->label('Prioritas')
                    ->boolean()
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->sortable(),
                TextColumn::make('submitted_at')
                    ->label('Waktu Pengajuan')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('officer.name')
                    ->label('Petugas')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Diperbarui Pada')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('service_type_id')
                    ->label('Jenis Layanan')
                    ->relationship('serviceType', 'name'),
                SelectFilter::make('status')
                    ->label('Status')
                    ->options(ServiceRequestStatus::class),
                TernaryFilter::make('is_priority')
                    ->label('Prioritas'),
            ])
            ->recordActions([
                EditAction::make(),
                Action::make('verify')
                    ->label('Verifikasi')
                    ->icon('heroicon-o-check-badge')
                    ->color('info')
                    ->visible(fn (ServiceRequest $record): bool => in_array($record->status, [ServiceRequestStatus::Submitted, ServiceRequestStatus::RevisionRequested]))
                    ->form([
                        Textarea::make('verification_result')
                            ->label('Hasil Verifikasi Berkas')
                            ->required(),
                    ])
                    ->action(function (ServiceRequest $record, array $data): void {
                        $record->recordStatusChange(ServiceRequestStatus::DataVerification->value, $data['verification_result']);
                        $record->update(['verification_result' => $data['verification_result']]);
                        Notification::make()
                            ->title('Pengajuan berhasil diverifikasi')
                            ->success()
                            ->send();
                    }),
                Action::make('approve')
                    ->label('Setujui')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->visible(fn (ServiceRequest $record): bool => in_array($record->status, [ServiceRequestStatus::DataVerification, ServiceRequestStatus::EligibilityVerification, ServiceRequestStatus::AwaitingApproval]))
                    ->requiresConfirmation()
                    ->action(function (ServiceRequest $record): void {
                        $record->recordStatusChange(ServiceRequestStatus::Completed->value, 'Disetujui dan diselesaikan');
                        $record->update(['completed_at' => now()]);
                        Notification::make()
                            ->title('Pengajuan berhasil disetujui & diselesaikan')
                            ->success()
                            ->send();
                    }),
                Action::make('reject')
                    ->label('Tolak')
                    ->icon('heroicon-o-x-mark')
                    ->color('danger')
                    ->visible(fn (ServiceRequest $record): bool => ! in_array($record->status, [ServiceRequestStatus::Completed, ServiceRequestStatus::Rejected]))
                    ->form([
                        Textarea::make('rejection_reason')
                            ->label('Alasan Penolakan')
                            ->required(),
                    ])
                    ->action(function (ServiceRequest $record, array $data): void {
                        $record->recordStatusChange(ServiceRequestStatus::Rejected->value, $data['rejection_reason']);
                        $record->update(['rejection_reason' => $data['rejection_reason']]);
                        Notification::make()
                            ->title('Pengajuan telah ditolak')
                            ->warning()
                            ->send();
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
