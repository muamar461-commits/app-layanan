<?php

namespace App\Filament\Resources\Complaints\Pages;

use App\Filament\Resources\Complaints\ComplaintResource;
use Filament\Resources\Pages\CreateRecord;

class CreateComplaint extends CreateRecord
{
    protected static string $resource = ComplaintResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (empty($data['complaint_number'])) {
            $data['complaint_number'] = 'ADU-'.date('Ym').'-'.str_pad((string) rand(1, 9999), 5, '0', STR_PAD_LEFT);
        }

        if (empty($data['reported_at'])) {
            $data['reported_at'] = now();
        }

        return $data;
    }
}
