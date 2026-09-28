<?php

namespace App\Filament\Resources\InformationPages\Tables;

use App\Enums\InformationCategory;
use App\Enums\PublishStatus;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class InformationPagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Judul Layanan')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                TextColumn::make('category')
                    ->label('Kategori')
                    ->formatStateUsing(fn ($state) => $state instanceof InformationCategory ? $state->label() : (InformationCategory::tryFrom($state)?->label() ?? $state))
                    ->badge()
                    ->sortable(),
                TextColumn::make('serviceType.name')
                    ->label('Jenis Layanan')
                    ->placeholder('-')
                    ->sortable(),
                TextColumn::make('publish_status')
                    ->label('Status')
                    ->formatStateUsing(fn ($state) => $state instanceof PublishStatus ? $state->label() : (PublishStatus::tryFrom($state)?->label() ?? $state))
                    ->badge()
                    ->color(fn ($state): string => match ($state instanceof PublishStatus ? $state->value : $state) {
                        'draft' => 'gray',
                        'published' => 'success',
                        'archived' => 'warning',
                        default => 'secondary',
                    })
                    ->sortable(),
                TextColumn::make('published_at')
                    ->label('Diterbitkan')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('category')
                    ->label('Kategori')
                    ->options(collect(InformationCategory::cases())->mapWithKeys(fn ($case) => [$case->value => $case->label()])),
                SelectFilter::make('publish_status')
                    ->label('Status Publikasi')
                    ->options(collect(PublishStatus::cases())->mapWithKeys(fn ($case) => [$case->value => $case->label()])),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
