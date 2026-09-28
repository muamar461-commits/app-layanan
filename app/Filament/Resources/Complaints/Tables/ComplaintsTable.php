<?php

namespace App\Filament\Resources\Complaints\Tables;

use App\Enums\ComplaintStatus;
use App\Enums\HandlingType;
use App\Enums\RehabilitationCaseStatus;
use App\Models\Client;
use App\Models\ClientCategory;
use App\Models\Complaint;
use App\Models\RehabilitationCase;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ComplaintsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('complaint_number')
                    ->label('No. Pengaduan')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                TextColumn::make('category.name')
                    ->label('Kategori')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('reporter_name')
                    ->label('Pelapor')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('village.name')
                    ->label('Desa/Kelurahan')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->formatStateUsing(fn ($state) => $state instanceof ComplaintStatus ? $state->label() : (ComplaintStatus::tryFrom($state)?->label() ?? $state))
                    ->badge()
                    ->color(fn ($state): string => match ($state instanceof ComplaintStatus ? $state->value : $state) {
                        'received' => 'gray',
                        'verification' => 'info',
                        'clarification_requested' => 'warning',
                        'dispatched' => 'primary',
                        'in_handling' => 'purple',
                        'resolved' => 'success',
                        'duplicate' => 'secondary',
                        'invalid' => 'danger',
                        default => 'secondary',
                    })
                    ->sortable(),
                TextColumn::make('reported_at')
                    ->label('Waktu Lapor')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('officer.name')
                    ->label('Petugas')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('resolved_at')
                    ->label('Selesai Pada')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('reported_at', 'desc')
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options(collect(ComplaintStatus::cases())->mapWithKeys(fn ($case) => [$case->value => $case->label()])),
                SelectFilter::make('complaint_category_id')
                    ->label('Kategori')
                    ->relationship('category', 'name'),
                SelectFilter::make('village_id')
                    ->label('Desa/Kelurahan')
                    ->relationship('village', 'name'),
            ])
            ->recordActions([
                EditAction::make(),
                Action::make('verify')
                    ->label('Verifikasi')
                    ->icon('heroicon-o-check-badge')
                    ->color('info')
                    ->visible(fn (Complaint $record): bool => in_array($record->status, [ComplaintStatus::Received, ComplaintStatus::ClarificationRequested]))
                    ->form([
                        Textarea::make('verification_result')
                            ->label('Hasil Verifikasi / Catatan')
                            ->required(),
                    ])
                    ->action(function (Complaint $record, array $data): void {
                        $record->recordStatusChange(ComplaintStatus::Verification->value, $data['verification_result']);
                        $record->update([
                            'status' => ComplaintStatus::Verification,
                            'verification_result' => $data['verification_result'],
                        ]);
                        Notification::make()
                            ->title('Laporan pengaduan berhasil diverifikasi')
                            ->success()
                            ->send();
                    }),
                Action::make('resolve')
                    ->label('Selesaikan')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn (Complaint $record): bool => ! in_array($record->status, [ComplaintStatus::Resolved, ComplaintStatus::Duplicate, ComplaintStatus::Invalid]))
                    ->form([
                        Textarea::make('action_taken')
                            ->label('Tindakan & Hasil Penanganan')
                            ->required(),
                    ])
                    ->action(function (Complaint $record, array $data): void {
                        $record->recordStatusChange(ComplaintStatus::Resolved->value, $data['action_taken']);
                        $record->update([
                            'status' => ComplaintStatus::Resolved,
                            'action_taken' => $data['action_taken'],
                            'resolved_at' => now(),
                        ]);
                        Notification::make()
                            ->title('Pengaduan berhasil diselesaikan')
                            ->success()
                            ->send();
                    }),
                Action::make('to_rehab')
                    ->label('Jadikan Kasus Rehsos')
                    ->icon('heroicon-o-heart')
                    ->color('warning')
                    ->visible(fn (Complaint $record): bool => $record->status !== ComplaintStatus::Duplicate && ! $record->rehabilitationCase)
                    ->requiresConfirmation()
                    ->action(function (Complaint $record): void {
                        $clientCategory = ClientCategory::first();
                        $client = Client::create([
                            'name' => 'Klien dari Aduan '.$record->complaint_number,
                            'nik' => '35'.date('ymd').rand(1000, 9999).rand(10, 99),
                            'client_category_id' => $clientCategory?->id ?? 1,
                            'village_id' => $record->village_id,
                            'address' => $record->location_detail ?? 'Dari pengaduan '.$record->complaint_number,
                            'phone' => $record->reporter_phone,
                        ]);

                        RehabilitationCase::create([
                            'case_number' => 'RHS-'.date('Ym').'-'.str_pad((string) rand(1, 9999), 5, '0', STR_PAD_LEFT),
                            'client_id' => $client->id,
                            'complaint_id' => $record->id,
                            'officer_id' => auth()->id() ?? $record->officer_id ?? 1,
                            'handling_type' => HandlingType::Direct,
                            'status' => RehabilitationCaseStatus::Received,
                            'received_at' => now(),
                        ]);

                        Notification::make()
                            ->title('Kasus rehabilitasi sosial berhasil dibuat dari pengaduan')
                            ->success()
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
