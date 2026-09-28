<?php

namespace App\Filament\Resources\Faqs\Schemas;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class FaqForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Konten FAQ')
                    ->columns(2)
                    ->schema([
                        Select::make('information_page_id')
                            ->label('Terkait Halaman Informasi (Opsional)')
                            ->relationship('informationPage', 'title')
                            ->searchable()
                            ->preload(),
                        TextInput::make('sort_order')
                            ->label('Nomor Urut')
                            ->numeric()
                            ->default(0)
                            ->required(),
                        Textarea::make('question')
                            ->label('Pertanyaan FAQ')
                            ->required()
                            ->rows(3)
                            ->columnSpanFull(),
                        Textarea::make('answer')
                            ->label('Jawaban Lengkap')
                            ->required()
                            ->rows(5)
                            ->columnSpanFull(),
                        Toggle::make('is_active')
                            ->label('Aktif / Tampilkan ke Publik')
                            ->default(true),
                    ]),
            ]);
    }
}
