<?php

namespace App\Enums;

enum Role: string
{
    case Admin = 'admin';
    case PetugasDinsos = 'petugas_dinsos';
    case PejabatPenandatangan = 'pejabat_penandatangan';
    case Pimpinan = 'pimpinan';
    case OperatorKecamatan = 'operator_kecamatan';
    case OperatorDesa = 'operator_desa';
    case Masyarakat = 'masyarakat';

    public function label(): string
    {
        return match ($this) {
            self::Admin => 'Administrator',
            self::PetugasDinsos => 'Petugas Dinsos',
            self::PejabatPenandatangan => 'Pejabat Penandatangan',
            self::Pimpinan => 'Pimpinan',
            self::OperatorKecamatan => 'Operator Kecamatan',
            self::OperatorDesa => 'Operator Desa',
            self::Masyarakat => 'Masyarakat',
        };
    }
}
