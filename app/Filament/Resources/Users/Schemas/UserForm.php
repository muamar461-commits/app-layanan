<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Lengkap')
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                TextInput::make('password')
                    ->label('Kata Sandi')
                    ->password()
                    ->dehydrated(fn ($state) => filled($state))
                    ->required(fn (string $operation): bool => $operation === 'create'),
                TextInput::make('phone')
                    ->label('Nomor HP/Telepon')
                    ->tel()
                    ->maxLength(20),
                TextInput::make('nik')
                    ->label('NIK')
                    ->maxLength(16),
                Select::make('work_unit_id')
                    ->label('Unit Kerja')
                    ->relationship('workUnit', 'name')
                    ->searchable()
                    ->preload(),
                Select::make('district_id')
                    ->label('Kecamatan')
                    ->relationship('district', 'name')
                    ->searchable()
                    ->preload(),
                Select::make('village_id')
                    ->label('Desa/Kelurahan')
                    ->relationship('village', 'name')
                    ->searchable()
                    ->preload(),
                Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true)
                    ->required(),
            ]);
    }
}
