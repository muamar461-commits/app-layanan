<?php

namespace App\Filament\Resources\RehabilitationCases\Pages;

use App\Filament\Resources\RehabilitationCases\RehabilitationCaseResource;
use Filament\Resources\Pages\CreateRecord;

class CreateRehabilitationCase extends CreateRecord
{
    protected static string $resource = RehabilitationCaseResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (empty($data['case_number'])) {
            $data['case_number'] = 'RHS-'.date('Ym').'-'.str_pad((string) rand(1, 9999), 5, '0', STR_PAD_LEFT);
        }

        return $data;
    }
}
