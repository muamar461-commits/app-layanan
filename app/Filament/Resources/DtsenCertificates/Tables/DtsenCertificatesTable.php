<?php

namespace App\Filament\Resources\DtsenCertificates\Tables;

use App\Models\DtsenCertificate;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class DtsenCertificatesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('certificate_number')
                    ->label('Nomor SK')
                    ->searchable()
                    ->sortable()
                    ->placeholder('Belum Terbit')
                    ->weight('bold'),
                TextColumn::make('serviceRequest.request_number')
                    ->label('No. Pengajuan')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('subject_name')
                    ->label('Nama Yang Diterangkan')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('subject_nik')
                    ->label('NIK')
                    ->searchable(),
                TextColumn::make('purpose.name')
                    ->label('Kegunaan')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('decile')
                    ->label('Desil')
                    ->sortable(),
                IconColumn::make('is_registered')
                    ->label('DTKS')
                    ->boolean()
                    ->sortable(),
                TextColumn::make('issued_at')
                    ->label('Tanggal Terbit')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('valid_until')
                    ->label('Berlaku Sampai')
                    ->date()
                    ->sortable(),
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
                SelectFilter::make('dtsen_purpose_id')
                    ->label('Kegunaan')
                    ->relationship('purpose', 'name'),
            ])
            ->recordActions([
                EditAction::make(),
                Action::make('issue_certificate')
                    ->label('Terbitkan SK')
                    ->icon('heroicon-o-check-badge')
                    ->color('success')
                    ->visible(fn (DtsenCertificate $record): bool => empty($record->certificate_number))
                    ->requiresConfirmation()
                    ->action(function (DtsenCertificate $record): void {
                        $sequenceNumber = 'SK-DTSEN/'.date('Y/m/').str_pad((string) $record->id, 4, '0', STR_PAD_LEFT);
                        $validDays = $record->purpose?->validity_days ?? 30;

                        $record->update([
                            'certificate_number' => $sequenceNumber,
                            'verification_code' => strtoupper(substr(md5($sequenceNumber.time()), 0, 10)),
                            'issued_at' => now(),
                            'valid_until' => now()->addDays($validDays),
                        ]);

                        Notification::make()
                            ->title('SK DTSEN berhasil diterbitkan')
                            ->body("Nomor Surat: {$sequenceNumber}")
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
