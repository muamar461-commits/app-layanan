<?php

namespace App\Filament\Resources\ServiceRequests\Pages;

use App\Filament\Resources\ServiceRequests\ServiceRequestResource;
use Filament\Resources\Pages\CreateRecord;

class CreateServiceRequest extends CreateRecord
{
    protected static string $resource = ServiceRequestResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (empty($data['request_number'])) {
            $data['request_number'] = 'REQ-'.date('Ymd').'-'.strtoupper(substr(uniqid(), -5));
        }

        return $data;
    }
}
