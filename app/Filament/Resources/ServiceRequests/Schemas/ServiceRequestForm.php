<?php

namespace App\Filament\Resources\ServiceRequests\Schemas;

use App\Enums\ServiceRequestStatus;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ServiceRequestForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Layanan')
                    ->columns(2)
                    ->schema([
                        TextInput::make('request_number')
                            ->label('Nomor Pengajuan')
                            ->placeholder('Dibuat otomatis jika kosong')
                            ->maxLength(50),
                        Select::make('service_type_id')
                            ->label('Jenis Layanan')
                            ->relationship('serviceType', 'name')
                            ->required()
                            ->searchable()
                            ->preload(),
                        Select::make('status')
                            ->label('Status Pengajuan')
                            ->options(ServiceRequestStatus::class)
                            ->default(ServiceRequestStatus::Submitted)
                            ->required(),
                        Toggle::make('is_priority')
                            ->label('Prioritas / Kebutuhan Mendesak')
                            ->default(false),
                    ]),

                Section::make('Data Identitas Pemohon')
                    ->columns(2)
                    ->schema([
                        TextInput::make('applicant_name')
                            ->label('Nama Pemohon')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('applicant_nik')
                            ->label('NIK Pemohon (16 Digit)')
                            ->required()
                            ->maxLength(16),
                        TextInput::make('family_card_number')
                            ->label('Nomor Kartu Keluarga (KK)')
                            ->maxLength(16),
                        TextInput::make('phone')
                            ->label('Nomor HP/WhatsApp')
                            ->tel()
                            ->required()
                            ->maxLength(20),
                        Select::make('village_id')
                            ->label('Desa/Kelurahan')
                            ->relationship('village', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Textarea::make('address')
                            ->label('Alamat Domisili Lengkap')
                            ->columnSpanFull(),
                    ]),

                Section::make('Penugasan & Tindak Lanjut Layanan')
                    ->columns(2)
                    ->schema([
                        Select::make('work_unit_id')
                            ->label('Unit Kerja Pengelola')
                            ->relationship('workUnit', 'name')
                            ->searchable()
                            ->preload(),
                        Select::make('officer_id')
                            ->label('Petugas Penangan')
                            ->relationship('officer', 'name')
                            ->searchable()
                            ->preload(),
                        DateTimePicker::make('submitted_at')
                            ->label('Waktu Diajukan')
                            ->default(now()),
                        DateTimePicker::make('completed_at')
                            ->label('Waktu Selesai'),
                        Textarea::make('verification_result')
                            ->label('Hasil Verifikasi Berkas & Persyaratan')
                            ->columnSpanFull(),
                        Textarea::make('officer_notes')
                            ->label('Catatan Petugas')
                            ->columnSpanFull(),
                        Textarea::make('service_result')
                            ->label('Hasil / Realisasi Pelayanan')
                            ->columnSpanFull(),
                        Textarea::make('rejection_reason')
                            ->label('Alasan Penolakan (Bila Ditolak)')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
