<?php

namespace App\Filament\Resources\RehabilitationCases\RelationManagers;

use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MonitoringRecordsRelationManager extends RelationManager
{
    protected static string $relationship = 'monitoringRecords';

    protected static ?string $title = 'Catatan Monitoring & Perkembangan';

    protected static ?string $modelLabel = 'Monitoring';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('officer_id')
                    ->label('Petugas Monitoring')
                    ->relationship('officer', 'name')
                    ->required()
                    ->searchable()
                    ->preload(),
                Select::make('referral_id')
                    ->label('Terkait Rujukan (Opsional)')
                    ->relationship('referral', 'referral_number')
                    ->searchable()
                    ->preload(),
                DatePicker::make('monitoring_date')
                    ->label('Tanggal Monitoring')
                    ->default(now())
                    ->required(),
                Textarea::make('progress')
                    ->label('Perkembangan Klien')
                    ->required()
                    ->rows(3)
                    ->columnSpanFull(),
                Textarea::make('result_notes')
                    ->label('Catatan & Kesimpulan Monitoring')
                    ->rows(3)
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('monitoring_date')
                    ->label('Tanggal')
                    ->date()
                    ->sortable(),
                TextColumn::make('officer.name')
                    ->label('Petugas')
                    ->sortable(),
                TextColumn::make('progress')
                    ->label('Perkembangan')
                    ->limit(40),
                TextColumn::make('result_notes')
                    ->label('Catatan')
                    ->limit(40),
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}
