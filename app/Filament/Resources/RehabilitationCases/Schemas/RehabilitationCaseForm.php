<?php

namespace App\Filament\Resources\RehabilitationCases\Schemas;

use App\Enums\HandlingType;
use App\Enums\RehabilitationCaseStatus;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class RehabilitationCaseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Kasus & Klien')
                    ->columns(2)
                    ->schema([
                        TextInput::make('case_number')
                            ->label('Nomor Kasus')
                            ->placeholder('Dibuat otomatis jika kosong')
                            ->maxLength(50),
                        Select::make('client_id')
                            ->label('Klien')
                            ->relationship('client', 'name')
                            ->required()
                            ->searchable()
                            ->preload(),
                        Select::make('officer_id')
                            ->label('Petugas Penanggung Jawab')
                            ->relationship('officer', 'name')
                            ->required()
                            ->searchable()
                            ->preload(),
                        Select::make('handling_type')
                            ->label('Jenis Penanganan')
                            ->options(collect(HandlingType::cases())->mapWithKeys(fn ($case) => [$case->value => $case->label()]))
                            ->default(HandlingType::Direct->value)
                            ->required(),
                        Select::make('status')
                            ->label('Status Kasus')
                            ->options(collect(RehabilitationCaseStatus::cases())->mapWithKeys(fn ($case) => [$case->value => $case->label()]))
                            ->default(RehabilitationCaseStatus::Received->value)
                            ->required(),
                        DateTimePicker::make('received_at')
                            ->label('Waktu Penerimaan')
                            ->default(now()),
                    ]),

                Section::make('Keterkaitan Layanan Asal (Opsional)')
                    ->columns(2)
                    ->schema([
                        Select::make('service_request_id')
                            ->label('Pengajuan Layanan Terkait')
                            ->relationship('serviceRequest', 'request_number')
                            ->searchable()
                            ->preload(),
                        Select::make('complaint_id')
                            ->label('Pengaduan Terkait')
                            ->relationship('complaint', 'complaint_number')
                            ->searchable()
                            ->preload(),
                    ]),

                Section::make('Hasil & Penyelesaian Kasus')
                    ->columns(1)
                    ->schema([
                        DateTimePicker::make('closed_at')
                            ->label('Waktu Penutupan Kasus'),
                        Textarea::make('handling_result')
                            ->label('Hasil Penanganan / Catatan Akhir')
                            ->rows(4),
                    ]),
            ]);
    }
}
