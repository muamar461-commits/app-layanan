<?php

namespace App\Filament\Resources\DtsenCertificates;

use App\Filament\Resources\DtsenCertificates\Pages\CreateDtsenCertificate;
use App\Filament\Resources\DtsenCertificates\Pages\EditDtsenCertificate;
use App\Filament\Resources\DtsenCertificates\Pages\ListDtsenCertificates;
use App\Filament\Resources\DtsenCertificates\Schemas\DtsenCertificateForm;
use App\Filament\Resources\DtsenCertificates\Tables\DtsenCertificatesTable;
use App\Models\DtsenCertificate;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class DtsenCertificateResource extends Resource
{
    protected static ?string $model = DtsenCertificate::class;

    protected static ?string $modelLabel = 'Surat Keterangan DTSEN';

    protected static ?string $pluralModelLabel = 'Surat Keterangan DTSEN';

    protected static ?string $navigationLabel = 'Surat Keterangan DTSEN';

    protected static string|UnitEnum|null $navigationGroup = 'Pelayanan Sosial';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentCheck;

    public static function form(Schema $schema): Schema
    {
        return DtsenCertificateForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DtsenCertificatesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListDtsenCertificates::route('/'),
            'create' => CreateDtsenCertificate::route('/create'),
            'edit' => EditDtsenCertificate::route('/{record}/edit'),
        ];
    }
}
