<?php

namespace App\Filament\Resources\DtsenCertificates\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class DtsenCertificateForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Pengajuan & Subjek Surat')
                    ->columns(2)
                    ->schema([
                        Select::make('service_request_id')
                            ->label('Nomor Pengajuan Layanan')
                            ->relationship('serviceRequest', 'request_number')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Select::make('dtsen_purpose_id')
                            ->label('Tujuan / Kegunaan SK')
                            ->relationship('purpose', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        TextInput::make('subject_name')
                            ->label('Nama Yang Diterangkan')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('subject_nik')
                            ->label('NIK Yang Diterangkan')
                            ->required()
                            ->maxLength(16),
                        TextInput::make('relationship_to_applicant')
                            ->label('Hubungan dengan Pemohon')
                            ->placeholder('Misal: Diri Sendiri, Anak, Orang Tua')
                            ->maxLength(50),
                        Textarea::make('purpose_description')
                            ->label('Keterangan Keperluan Khusus')
                            ->columnSpanFull(),
                    ]),

                Section::make('Hasil Pengecekan SIKS-NG & Penerbitan Surat')
                    ->columns(2)
                    ->schema([
                        Toggle::make('is_registered')
                            ->label('Terdaftar di DTKS / SIKS-NG')
                            ->default(true),
                        TextInput::make('decile')
                            ->label('Desil Kesejahteraan (1-10)')
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(10),
                        TextInput::make('certificate_number')
                            ->label('Nomor Surat Keterangan')
                            ->placeholder('Nomor SK Resmi (Dinas Sosial)'),
                        TextInput::make('verification_code')
                            ->label('Kode Verifikasi QR')
                            ->placeholder('Otomatis / Unik'),
                        DateTimePicker::make('issued_at')
                            ->label('Tanggal Terbit'),
                        DatePicker::make('valid_until')
                            ->label('Berlaku Sampai'),
                        Select::make('checker_id')
                            ->label('Petugas Verifikator SIKS-NG')
                            ->relationship('checker', 'name')
                            ->searchable()
                            ->preload(),
                        Select::make('signer_id')
                            ->label('Pejabat Penandatangan')
                            ->relationship('signer', 'name')
                            ->searchable()
                            ->preload(),
                    ]),
            ]);
    }
}
