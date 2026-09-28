<?php

namespace App\Filament\Pages;

use App\Models\District;
use App\Models\ServiceType;
use App\Models\Village;
use BackedEnum;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Pages\Dashboard\Concerns\HasFiltersForm;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class Dashboard extends BaseDashboard
{
    use HasFiltersForm;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-home';

    protected static ?string $title = 'Dashboard';

    public function filtersForm(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Filter Periode & Wilayah')
                    ->icon('heroicon-o-funnel')
                    ->compact()
                    ->columnSpanFull()
                    ->schema([
                        Grid::make([
                            'default' => 1,
                            'sm' => 2,
                            'md' => 3,
                            'lg' => 5,
                            'xl' => 5,
                        ])
                            ->schema([
                                DatePicker::make('startDate')
                                    ->label('Dari Tanggal')
                                    ->default(now()->startOfMonth()->toDateString())
                                    ->columnSpan(1),
                                DatePicker::make('endDate')
                                    ->label('Sampai Tanggal')
                                    ->default(now()->toDateString())
                                    ->columnSpan(1),
                                Select::make('service_type_id')
                                    ->label('Jenis Layanan')
                                    ->options(fn (): array => ServiceType::where('is_active', true)->pluck('name', 'id')->all())
                                    ->placeholder('Semua Jenis Layanan')
                                    ->searchable()
                                    ->columnSpan(1),
                                Select::make('district_id')
                                    ->label('Kecamatan')
                                    ->options(fn (): array => District::pluck('name', 'id')->all())
                                    ->placeholder('Semua Kecamatan')
                                    ->searchable()
                                    ->live()
                                    ->columnSpan(1),
                                Select::make('village_id')
                                    ->label('Desa/Kelurahan')
                                    ->options(function (Get $get): array {
                                        $districtId = $get('district_id');

                                        if (! $districtId) {
                                            return [];
                                        }

                                        return Village::where('district_id', $districtId)
                                            ->pluck('name', 'id')
                                            ->all();
                                    })
                                    ->placeholder('Semua Desa')
                                    ->searchable()
                                    ->columnSpan(1),
                            ]),
                    ]),
            ]);
    }
}
