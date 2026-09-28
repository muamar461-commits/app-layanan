<?php

namespace App\Filament\Resources\PbiReactivations\Tables;

use App\Enums\MinistryDecision;
use App\Enums\PbiReason;
use App\Models\PbiReactivation;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class PbiReactivationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('participant_name')
                    ->label('Nama Peserta')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                TextColumn::make('participant_nik')
                    ->label('NIK')
                    ->searchable(),
                TextColumn::make('bpjs_card_number')
                    ->label('No. KIS/BPJS')
                    ->searchable(),
                TextColumn::make('reason')
                    ->label('Alasan')
                    ->badge()
                    ->sortable(),
                TextColumn::make('recommendation_number')
                    ->label('No. Rekomendasi')
                    ->searchable()
                    ->placeholder('Belum Ada'),
                TextColumn::make('proposed_to_ministry_at')
                    ->label('Diusulkan Ke Kemensos')
                    ->dateTime()
                    ->sortable()
                    ->placeholder('Belum Diusulkan'),
                TextColumn::make('ministry_decision')
                    ->label('Keputusan Kemensos')
                    ->badge()
                    ->sortable()
                    ->placeholder('Menunggu'),
                TextColumn::make('reactivated_date')
                    ->label('Aktif Kembali')
                    ->date()
                    ->sortable()
                    ->placeholder('-'),
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
                SelectFilter::make('reason')
                    ->label('Alasan')
                    ->options(PbiReason::class),
                SelectFilter::make('ministry_decision')
                    ->label('Keputusan Kemensos')
                    ->options(MinistryDecision::class),
            ])
            ->recordActions([
                EditAction::make(),
                Action::make('issue_recommendation')
                    ->label('Terbitkan Rekomendasi')
                    ->icon('heroicon-o-document-text')
                    ->color('info')
                    ->visible(fn (PbiReactivation $record): bool => empty($record->recommendation_number))
                    ->requiresConfirmation()
                    ->action(function (PbiReactivation $record): void {
                        $rekNumber = 'REK-PBI/'.date('Y/m/').str_pad((string) $record->id, 4, '0', STR_PAD_LEFT);
                        $record->update([
                            'recommendation_number' => $rekNumber,
                            'recommendation_issued_at' => now(),
                        ]);
                        Notification::make()
                            ->title('Surat Rekomendasi berhasil diterbitkan')
                            ->body("Nomor: {$rekNumber}")
                            ->success()
                            ->send();
                    }),
                Action::make('propose_to_ministry')
                    ->label('Usulkan ke Kemensos')
                    ->icon('heroicon-o-paper-airplane')
                    ->color('warning')
                    ->visible(fn (PbiReactivation $record): bool => filled($record->recommendation_number) && empty($record->proposed_to_ministry_at))
                    ->requiresConfirmation()
                    ->action(function (PbiReactivation $record): void {
                        $record->update([
                            'proposed_to_ministry_at' => now(),
                        ]);
                        Notification::make()
                            ->title('Status berhasil diubah ke: Diusulkan ke Kemensos (SIKS-NG)')
                            ->success()
                            ->send();
                    }),
                Action::make('record_ministry_decision')
                    ->label('Keputusan Kemensos')
                    ->icon('heroicon-o-check-badge')
                    ->color('primary')
                    ->visible(fn (PbiReactivation $record): bool => filled($record->proposed_to_ministry_at) && empty($record->ministry_decision))
                    ->form([
                        Select::make('ministry_decision')
                            ->label('Keputusan')
                            ->options(MinistryDecision::class)
                            ->required(),
                    ])
                    ->action(function (PbiReactivation $record, array $data): void {
                        $record->update([
                            'ministry_decision' => $data['ministry_decision'],
                            'ministry_decided_at' => now(),
                        ]);
                        Notification::make()
                            ->title('Keputusan Kemensos berhasil disimpan')
                            ->success()
                            ->send();
                    }),
                Action::make('mark_reactivated')
                    ->label('Tandai Aktif')
                    ->icon('heroicon-o-heart')
                    ->color('success')
                    ->visible(fn (PbiReactivation $record): bool => $record->ministry_decision === MinistryDecision::Approved && empty($record->reactivated_date))
                    ->form([
                        DatePicker::make('reactivated_date')
                            ->label('Tanggal Aktif Kembali')
                            ->default(now())
                            ->required(),
                    ])
                    ->action(function (PbiReactivation $record, array $data): void {
                        $record->update([
                            'reactivated_date' => $data['reactivated_date'],
                        ]);
                        Notification::make()
                            ->title('Peserta PBI-JK berhasil diaktifkan kembali')
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
