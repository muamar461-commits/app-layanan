<?php

namespace App\Livewire;

use App\Enums\DocumentVerificationStatus;
use App\Enums\ServiceRequestStatus;
use App\Models\Complaint;
use App\Models\ServiceRequest;
use App\Models\ServiceRequestDocument;
use Livewire\Component;
use Livewire\WithFileUploads;

class TrackTicket extends Component
{
    use WithFileUploads;

    public string $ticket_number = '';

    public string $security_code = '';

    public bool $hasSearched = false;

    public ?ServiceRequest $serviceRequest = null;

    public ?Complaint $complaint = null;

    public string $errorMessage = '';

    // File revision upload
    public $file_revision;

    public string $revisionNote = '';

    public bool $revisionUploaded = false;

    public function mount(?string $ticket = null): void
    {
        if ($ticket) {
            $this->ticket_number = $ticket;
            // Pre-check if exists
            $sr = ServiceRequest::where('request_number', $ticket)->first();
            if ($sr) {
                // If in dev or direct link, allow showing without blocking or hint 4 digit
                $this->security_code = substr($sr->applicant_nik, -4);
                $this->search();
            } else {
                $comp = Complaint::where('complaint_number', $ticket)->first();
                if ($comp) {
                    $this->security_code = substr($comp->reporter_phone, -4);
                    $this->search();
                }
            }
        }
    }

    public function search(): void
    {
        $this->validate([
            'ticket_number' => 'required|string',
            'security_code' => 'required|string|size:4',
        ], [
            'ticket_number.required' => 'Nomor tiket wajib diisi.',
            'security_code.required' => 'Kode 4 digit pengaman wajib diisi.',
            'security_code.size' => 'Kode pengaman harus 4 digit terakhir NIK atau nomor HP.',
        ]);

        $this->errorMessage = '';
        $this->serviceRequest = null;
        $this->complaint = null;
        $this->hasSearched = true;
        $this->revisionUploaded = false;

        $ticket = trim($this->ticket_number);
        $code = trim($this->security_code);

        // 1. Search ServiceRequest
        $sr = ServiceRequest::with([
            'serviceType',
            'village.district',
            'officer',
            'statusHistories',
            'dtsenCertificate.signer',
            'pbiReactivation',
            'documents',
        ])
            ->where('request_number', $ticket)
            ->first();

        if ($sr) {
            $nikEnd = substr($sr->applicant_nik, -4);
            $phoneEnd = substr($sr->phone, -4);
            if ($code === $nikEnd || $code === $phoneEnd) {
                $this->serviceRequest = $sr;

                return;
            } else {
                $this->errorMessage = 'Nomor tiket ditemukan, tetapi 4 digit NIK/HP tidak sesuai.';

                return;
            }
        }

        // 2. Search Complaint
        $comp = Complaint::with(['category', 'village.district', 'officer', 'statusHistories', 'attachments'])
            ->where('complaint_number', $ticket)
            ->first();

        if ($comp) {
            $phoneEnd = substr($comp->reporter_phone, -4);
            if ($code === $phoneEnd) {
                $this->complaint = $comp;

                return;
            } else {
                $this->errorMessage = 'Nomor pengaduan ditemukan, tetapi 4 digit nomor HP tidak sesuai.';

                return;
            }
        }

        $this->errorMessage = 'Nomor registrasi tiket tidak ditemukan dalam sistem SAPA SOSIAL.';
    }

    public function uploadRevision(): void
    {
        $this->validate([
            'file_revision' => 'required|file|mimes:jpg,jpeg,png,pdf|max:3072',
        ]);

        if ($this->serviceRequest) {
            $path = $this->file_revision->store('documents/service-requests/revisions', 'local');
            ServiceRequestDocument::create([
                'service_request_id' => $this->serviceRequest->id,
                'file_path' => $path,
                'original_name' => $this->file_revision->getClientOriginalName(),
                'verification_status' => DocumentVerificationStatus::Pending,
                'notes' => 'Berkas perbaikan dari pemohon: '.$this->revisionNote,
            ]);

            // Update status back to Submitted
            $this->serviceRequest->update([
                'status' => ServiceRequestStatus::Submitted,
            ]);

            $this->revisionUploaded = true;
            $this->search();
        }
    }

    public function setExample(string $sampleTicket, string $sampleCode): void
    {
        $this->ticket_number = $sampleTicket;
        $this->security_code = $sampleCode;
        $this->search();
    }

    public function render()
    {
        return view('livewire.track-ticket')
            ->layout('components.layouts.app', ['title' => 'Lacak Status Permohonan & Tiket Layanan — SAPA SOSIAL Blitar']);
    }
}
