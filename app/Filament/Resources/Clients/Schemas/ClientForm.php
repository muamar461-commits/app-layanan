<?php

namespace App\Filament\Resources\Clients\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ClientForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Lengkap')
                    ->required()
                    ->maxLength(255),
                TextInput::make('nik')
                    ->label('NIK (16 Digit)')
                    ->required()
                    ->maxLength(16),
                Select::make('client_category_id')
                    ->label('Kategori Klien')
                    ->relationship('category', 'name')
                    ->required()
                    ->searchable()
                    ->preload(),
                DatePicker::make('birth_date')
                    ->label('Tanggal Lahir')
                    ->required(),
                Select::make('gender')
                    ->label('Jenis Kelamin')
                    ->options([
                        'L' => 'Laki-laki',
                        'P' => 'Perempuan',
                    ])
                    ->required(),
                TextInput::make('phone')
                    ->label('Nomor HP/Telepon')
                    ->tel()
                    ->maxLength(20),
                Select::make('village_id')
                    ->label('Desa/Kelurahan')
                    ->relationship('village', 'name')
                    ->searchable()
                    ->preload(),
                Textarea::make('address')
                    ->label('Alamat Lengkap')
                    ->columnSpanFull(),
            ]);
    }
}
