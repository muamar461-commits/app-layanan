<?php

namespace App\Filament\Resources\PbiReactivations\Pages;

use App\Filament\Resources\PbiReactivations\PbiReactivationResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPbiReactivation extends EditRecord
{
    protected static string $resource = PbiReactivationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
