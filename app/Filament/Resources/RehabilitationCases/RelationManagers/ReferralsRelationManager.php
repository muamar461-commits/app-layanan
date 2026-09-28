<?php

namespace App\Filament\Resources\RehabilitationCases\RelationManagers;

use App\Enums\ReferralStatus;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ReferralsRelationManager extends RelationManager
{
    protected static string $relationship = 'referrals';

    protected static ?string $title = 'Rujukan Lembaga';

    protected static ?string $modelLabel = 'Rujukan';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('referral_number')
                    ->label('Nomor Rujukan')
                    ->default(fn () => 'RJK-'.now()->format('Ym').'-'.str_pad((string) rand(1, 9999), 4, '0', STR_PAD_LEFT))
                    ->required(),
                Select::make('assessment_id')
                    ->label('Dasar Assessment')
                    ->relationship('assessment', 'result')
                    ->required()
                    ->searchable()
                    ->preload(),
                Select::make('referral_institution_id')
                    ->label('Lembaga Tujuan Rujukan')
                    ->relationship('institution', 'name')
                    ->required()
                    ->searchable()
                    ->preload(),
                Select::make('officer_id')
                    ->label('Petugas Pengantar / Pendamping')
                    ->relationship('officer', 'name')
                    ->required()
                    ->searchable()
                    ->preload(),
                DatePicker::make('referral_date')
                    ->label('Tanggal Rujukan')
                    ->default(now())
                    ->required(),
                Select::make('status')
                    ->label('Status Rujukan')
                    ->options(collect(ReferralStatus::cases())->mapWithKeys(fn ($case) => [$case->value => $case->label()]))
                    ->default(ReferralStatus::Draft->value)
                    ->required(),
                Textarea::make('service_result')
                    ->label('Hasil Pelayanan Lembaga Rujukan')
                    ->rows(3)
                    ->columnSpanFull(),
                DateTimePicker::make('completed_at')
                    ->label('Waktu Selesai Rujukan'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('referral_number')
                    ->label('No. Rujukan')
                    ->weight('bold')
                    ->searchable(),
                TextColumn::make('institution.name')
                    ->label('Lembaga Tujuan')
                    ->searchable(),
                TextColumn::make('referral_date')
                    ->label('Tanggal')
                    ->date()
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->formatStateUsing(fn ($state) => $state instanceof ReferralStatus ? $state->label() : (ReferralStatus::tryFrom($state)?->label() ?? $state))
                    ->badge()
                    ->color(fn ($state): string => match ($state instanceof ReferralStatus ? $state->value : $state) {
                        'draft' => 'gray',
                        'sent' => 'info',
                        'accepted' => 'primary',
                        'in_service' => 'warning',
                        'completed' => 'success',
                        'declined' => 'danger',
                        'cancelled' => 'secondary',
                        default => 'secondary',
                    }),
                TextColumn::make('officer.name')
                    ->label('Petugas'),
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}
