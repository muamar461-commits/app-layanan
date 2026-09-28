<?php

namespace App\Filament\Resources\InformationPages\Pages;

use App\Filament\Resources\InformationPages\InformationPageResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;

class CreateInformationPage extends CreateRecord
{
    protected static string $resource = InformationPageResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        if (empty($data['manager_id'])) {
            $data['manager_id'] = auth()->id() ?? 1;
        }

        return $data;
    }
}
