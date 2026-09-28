<?php

namespace App\Filament\Resources\InformationPages\RelationManagers;

use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DownloadableFormsRelationManager extends RelationManager
{
    protected static string $relationship = 'downloadableForms';

    protected static ?string $title = 'Formulir Unduhan';

    protected static ?string $modelLabel = 'Formulir';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Formulir / Dokumen')
                    ->required()
                    ->maxLength(255),
                TextInput::make('version')
                    ->label('Versi Formulir')
                    ->default('v1.0')
                    ->required()
                    ->maxLength(50),
                FileUpload::make('file_path')
                    ->label('File Formulir (PDF / Word)')
                    ->directory('downloadable-forms')
                    ->required()
                    ->columnSpanFull(),
                Toggle::make('is_current')
                    ->label('Versi Berlaku Saat Ini')
                    ->default(true),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama Formulir')
                    ->searchable()
                    ->weight('bold'),
                TextColumn::make('version')
                    ->label('Versi'),
                IconColumn::make('is_current')
                    ->label('Berlaku?')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->label('Diunggah Pada')
                    ->dateTime(),
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
