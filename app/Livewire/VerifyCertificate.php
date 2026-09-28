<?php

namespace App\Livewire;

use App\Models\DtsenCertificate;
use Livewire\Component;

class VerifyCertificate extends Component
{
    public string $code = '';

    public ?DtsenCertificate $certificate = null;

    public bool $hasSearched = false;

    public bool $isExpired = false;

    public function mount(?string $code = null): void
    {
        if ($code) {
            $this->code = $code;
            $this->verify();
        }
    }

    public function verify(): void
    {
        $this->validate([
            'code' => 'required|string',
        ], [
            'code.required' => 'Kode verifikasi SK atau nomor sertifikat wajib diisi.',
        ]);

        $searchCode = trim($this->code);
        $this->certificate = DtsenCertificate::with(['serviceRequest.village.district', 'purpose', 'signer'])
            ->where('verification_code', $searchCode)
            ->orWhere('certificate_number', $searchCode)
            ->first();

        $this->hasSearched = true;

        if ($this->certificate && $this->certificate->valid_until) {
            $this->isExpired = $this->certificate->valid_until->isPast();
        } else {
            $this->isExpired = false;
        }
    }

    public function render()
    {
        return view('livewire.verify-certificate')
            ->layout('components.layouts.app', ['title' => 'Verifikasi Keaslian Surat Keterangan DTSEN — SAPA SOSIAL Blitar']);
    }
}
