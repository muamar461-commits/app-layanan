<?php

namespace App\Filament\Resources\Complaints\RelationManagers;

use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ComplaintAttachmentsRelationManager extends RelationManager
{
    protected static string $relationship = 'attachments';

    protected static ?string $title = 'Lampiran & Bukti Pendukung';

    protected static ?string $modelLabel = 'Lampiran';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('type')
                    ->label('Jenis Lampiran')
                    ->options([
                        'photo' => 'Foto / Gambar Kejadian',
                        'document' => 'Dokumen / Surat Keterangan',
                    ])
                    ->default('photo')
                    ->required(),
                FileUpload::make('file_path')
                    ->label('File Berkas / Foto')
                    ->directory('complaint-attachments')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('type')
                    ->label('Jenis')
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'photo' => 'Foto',
                        'document' => 'Dokumen',
                        default => $state,
                    })
                    ->badge(),
                ImageColumn::make('file_path')
                    ->label('Pratinjau Foto')
                    ->square(),
                TextColumn::make('created_at')
                    ->label('Diunggah Pada')
                    ->dateTime(),
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                DeleteAction::make(),
            ]);
    }
}
