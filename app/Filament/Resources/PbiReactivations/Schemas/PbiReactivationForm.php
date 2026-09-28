<?php

namespace App\Filament\Resources\PbiReactivations\Schemas;

use App\Enums\MinistryDecision;
use App\Enums\PbiReason;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PbiReactivationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Peserta & Kepesertaan BPJS')
                    ->columns(2)
                    ->schema([
                        Select::make('service_request_id')
                            ->label('Nomor Pengajuan Layanan')
                            ->relationship('serviceRequest', 'request_number')
                            ->searchable()
                            ->preload()
                            ->required(),
                        TextInput::make('participant_name')
                            ->label('Nama Peserta BPJS')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('participant_nik')
                            ->label('NIK Peserta (16 Digit)')
                            ->required()
                            ->maxLength(16),
                        TextInput::make('bpjs_card_number')
                            ->label('Nomor Kartu BPJS/KIS')
                            ->maxLength(30),
                        DatePicker::make('deactivated_date')
                            ->label('Tanggal Non-Aktif'),
                        Select::make('reason')
                            ->label('Alasan Reaktivasi')
                            ->options(PbiReason::class)
                            ->required(),
                        TextInput::make('health_facility_name')
                            ->label('Fasilitas Kesehatan Perujuk')
                            ->placeholder('Contoh: RSUD Ngudi Waluyo Wlingi'),
                        TextInput::make('health_letter_number')
                            ->label('Nomor Surat Keterangan Medis/Opname'),
                    ]),

                Section::make('Verifikasi & Usulan ke Kemensos')
                    ->columns(2)
                    ->schema([
                        TextInput::make('decile')
                            ->label('Desil Kesejahteraan (1-10)')
                            ->numeric(),
                        TextInput::make('recommendation_number')
                            ->label('Nomor Surat Rekomendasi Dinsos'),
                        DateTimePicker::make('recommendation_issued_at')
                            ->label('Tanggal Rekomendasi Terbit'),
                        DateTimePicker::make('proposed_to_ministry_at')
                            ->label('Tanggal Diusulkan ke SIKS-NG/Kemensos'),
                        Select::make('ministry_decision')
                            ->label('Keputusan Kemensos')
                            ->options(MinistryDecision::class),
                        DateTimePicker::make('ministry_decided_at')
                            ->label('Tanggal Keputusan Kemensos'),
                        DatePicker::make('reactivated_date')
                            ->label('Tanggal Kepesertaan Aktif Kembali'),
                        Select::make('signer_id')
                            ->label('Pejabat Penandatangan Rekomendasi')
                            ->relationship('signer', 'name')
                            ->searchable()
                            ->preload(),
                        Textarea::make('eligibility_notes')
                            ->label('Catatan Hasil Verifikasi Kelayakan')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
