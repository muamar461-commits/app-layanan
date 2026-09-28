<?php

namespace App\Filament\Resources\InformationPages\Schemas;

use App\Enums\InformationCategory;
use App\Enums\PublishStatus;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class InformationPageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Identitas Halaman Informasi')
                    ->columns(2)
                    ->schema([
                        TextInput::make('title')
                            ->label('Judul Informasi / Layanan')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                        TextInput::make('slug')
                            ->label('Slug URL')
                            ->required()
                            ->maxLength(255),
                        Select::make('category')
                            ->label('Kategori Informasi')
                            ->options(collect(InformationCategory::cases())->mapWithKeys(fn ($case) => [$case->value => $case->label()]))
                            ->default(InformationCategory::Program->value)
                            ->required(),
                        Select::make('service_type_id')
                            ->label('Terkait Jenis Layanan (Opsional)')
                            ->relationship('serviceType', 'name')
                            ->searchable()
                            ->preload(),
                        Select::make('publish_status')
                            ->label('Status Publikasi')
                            ->options(collect(PublishStatus::cases())->mapWithKeys(fn ($case) => [$case->value => $case->label()]))
                            ->default(PublishStatus::Draft->value)
                            ->required(),
                        DateTimePicker::make('published_at')
                            ->label('Waktu Publikasi')
                            ->default(now()),
                    ]),

                Section::make('Uraian Layanan, Syarat & Alur')
                    ->columns(1)
                    ->schema([
                        Textarea::make('description')
                            ->label('Deskripsi Layanan')
                            ->required()
                            ->rows(4),
                        Textarea::make('requirements')
                            ->label('Persyaratan Pelayanan')
                            ->rows(4),
                        Textarea::make('procedure')
                            ->label('Alur & Prosedur Pelayanan')
                            ->rows(4),
                    ]),

                Section::make('Operasional & Kontak')
                    ->columns(3)
                    ->schema([
                        TextInput::make('service_hours')
                            ->label('Waktu & Jam Pelayanan')
                            ->placeholder('Senin - Kamis 08.00 - 15.00')
                            ->maxLength(255),
                        TextInput::make('location')
                            ->label('Lokasi Kantor Pelayanan')
                            ->placeholder('Kantor Dinsos Kab. Blitar')
                            ->maxLength(255),
                        TextInput::make('contact')
                            ->label('Kontak / Call Center')
                            ->placeholder('0811-xxxx-xxxx')
                            ->maxLength(255),
                    ]),
            ]);
    }
}
