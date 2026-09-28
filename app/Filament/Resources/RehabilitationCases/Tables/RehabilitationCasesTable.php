<?php

namespace App\Filament\Resources\RehabilitationCases\Tables;

use App\Enums\HandlingType;
use App\Enums\RehabilitationCaseStatus;
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

class RehabilitationCasesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('case_number')
                    ->label('No. Kasus')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                TextColumn::make('client.name')
                    ->label('Nama Klien')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('client.category.name')
                    ->label('Kategori Klien')
                    ->sortable(),
                TextColumn::make('officer.name')
                    ->label('Petugas')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('handling_type')
                    ->label('Penanganan')
                    ->formatStateUsing(fn ($state) => $state instanceof HandlingType ? $state->label() : (HandlingType::tryFrom($state)?->label() ?? $state))
                    ->badge()
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->formatStateUsing(fn ($state) => $state instanceof RehabilitationCaseStatus ? $state->label() : (RehabilitationCaseStatus::tryFrom($state)?->label() ?? $state))
                    ->badge()
                    ->color(fn ($state): string => match ($state instanceof RehabilitationCaseStatus ? $state->value : $state) {
                        'received' => 'gray',
                        'assessment' => 'info',
                        'service_planning' => 'warning',
                        'in_service' => 'primary',
                        'monitoring' => 'purple',
                        'closed' => 'success',
                        default => 'secondary',
                    })
                    ->sortable(),
                TextColumn::make('received_at')
                    ->label('Diterima Pada')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('closed_at')
                    ->label('Ditutup Pada')
                    ->dateTime()
                    ->sortable()
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
                SelectFilter::make('status')
                    ->label('Status Kasus')
                    ->options(collect(RehabilitationCaseStatus::cases())->mapWithKeys(fn ($case) => [$case->value => $case->label()])),
                SelectFilter::make('handling_type')
                    ->label('Jenis Penanganan')
                    ->options(collect(HandlingType::cases())->mapWithKeys(fn ($case) => [$case->value => $case->label()])),
            ])
            ->recordActions([
                EditAction::make(),
                Action::make('close_case')
                    ->label('Tutup Kasus')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn (RehabilitationCase $record): bool => $record->status !== RehabilitationCaseStatus::Closed)
                    ->form([
                        Textarea::make('handling_result')
                            ->label('Hasil Penanganan Akhir')
                            ->required(),
                    ])
                    ->action(function (RehabilitationCase $record, array $data): void {
                        $record->recordStatusChange(RehabilitationCaseStatus::Closed->value, $data['handling_result']);
                        $record->update([
                            'status' => RehabilitationCaseStatus::Closed,
                            'closed_at' => now(),
                            'handling_result' => $data['handling_result'],
                        ]);
                        Notification::make()
                            ->title('Kasus berhasil ditutup')
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
