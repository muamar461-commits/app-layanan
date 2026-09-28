<?php

namespace App\Filament\Resources\Complaints\Schemas;

use App\Enums\ComplaintStatus;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ComplaintForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Pelapor & Lokasi Kejadian')
                    ->columns(2)
                    ->schema([
                        TextInput::make('complaint_number')
                            ->label('Nomor Pengaduan')
                            ->placeholder('Dibuat otomatis jika kosong')
                            ->maxLength(50),
                        Select::make('complaint_category_id')
                            ->label('Kategori Pengaduan')
                            ->relationship('category', 'name')
                            ->required()
                            ->searchable()
                            ->preload(),
                        TextInput::make('reporter_name')
                            ->label('Nama Pelapor')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('reporter_phone')
                            ->label('Nomor HP/WhatsApp Pelapor')
                            ->tel()
                            ->required()
                            ->maxLength(20),
                        Select::make('village_id')
                            ->label('Desa/Kelurahan Kejadian')
                            ->relationship('village', 'name')
                            ->required()
                            ->searchable()
                            ->preload(),
                        Textarea::make('location_detail')
                            ->label('Alamat / Titik Lokasi Detail Kejadian')
                            ->columnSpanFull(),
                    ]),

                Section::make('Uraian Permasalahan Sosial')
                    ->columns(1)
                    ->schema([
                        Textarea::make('description')
                            ->label('Deskripsi / Kronologi Permasalahan')
                            ->required()
                            ->rows(4),
                        DateTimePicker::make('reported_at')
                            ->label('Waktu Laporan Diterima')
                            ->default(now()),
                    ]),

                Section::make('Tindak Lanjut & Penanganan Petugas')
                    ->columns(2)
                    ->schema([
                        Select::make('status')
                            ->label('Status Laporan')
                            ->options(collect(ComplaintStatus::cases())->mapWithKeys(fn ($case) => [$case->value => $case->label()]))
                            ->default(ComplaintStatus::Received->value)
                            ->required(),
                        Select::make('officer_id')
                            ->label('Petugas yang Menangani')
                            ->relationship('officer', 'name')
                            ->searchable()
                            ->preload(),
                        Textarea::make('verification_result')
                            ->label('Hasil Verifikasi Laporan')
                            ->columnSpanFull(),
                        Textarea::make('action_taken')
                            ->label('Tindakan / Penanganan yang Dilakukan')
                            ->columnSpanFull(),
                        Select::make('duplicate_of_id')
                            ->label('Laporan Induk (Jika Laporan Duplikat)')
                            ->relationship('duplicateOf', 'complaint_number')
                            ->searchable()
                            ->preload(),
                        DateTimePicker::make('resolved_at')
                            ->label('Waktu Selesai Ditangani'),
                    ]),
            ]);
    }
}
