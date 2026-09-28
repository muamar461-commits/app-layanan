<?php

namespace App\Filament\Resources\RehabilitationCases\RelationManagers;

use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AssessmentsRelationManager extends RelationManager
{
    protected static string $relationship = 'assessments';

    protected static ?string $title = 'Catatan Assessment';

    protected static ?string $modelLabel = 'Assessment';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('officer_id')
                    ->label('Petugas Assessment')
                    ->relationship('officer', 'name')
                    ->required()
                    ->searchable()
                    ->preload(),
                DatePicker::make('assessment_date')
                    ->label('Tanggal Assessment')
                    ->default(now())
                    ->required(),
                Textarea::make('result')
                    ->label('Hasil Assessment Kondisi Klien')
                    ->required()
                    ->rows(3)
                    ->columnSpanFull(),
                Textarea::make('service_needs')
                    ->label('Kebutuhan Pelayanan')
                    ->required()
                    ->rows(3)
                    ->columnSpanFull(),
                Textarea::make('recommendation')
                    ->label('Rekomendasi Penanganan')
                    ->required()
                    ->rows(3)
                    ->columnSpanFull(),
                Toggle::make('needs_referral')
                    ->label('Perlu Rujukan ke Lembaga Lain')
                    ->default(false),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('assessment_date')
                    ->label('Tanggal')
                    ->date()
                    ->sortable(),
                TextColumn::make('officer.name')
                    ->label('Petugas')
                    ->sortable(),
                TextColumn::make('result')
                    ->label('Hasil Assessment')
                    ->limit(40),
                TextColumn::make('service_needs')
                    ->label('Kebutuhan')
                    ->limit(40),
                IconColumn::make('needs_referral')
                    ->label('Rujukan?')
                    ->boolean(),
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
