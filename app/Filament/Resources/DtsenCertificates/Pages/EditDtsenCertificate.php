<?php

namespace App\Filament\Resources\DtsenCertificates\Pages;

use App\Filament\Resources\DtsenCertificates\DtsenCertificateResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDtsenCertificate extends EditRecord
{
    protected static string $resource = DtsenCertificateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
