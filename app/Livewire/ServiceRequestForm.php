<?php

namespace App\Livewire;

use App\Enums\DocumentVerificationStatus;
use App\Enums\PbiReason;
use App\Enums\ServiceRequestStatus;
use App\Models\Client;
use App\Models\ClientCategory;
use App\Models\District;
use App\Models\DtsenCertificate;
use App\Models\DtsenPurpose;
use App\Models\PbiReactivation;
use App\Models\RehabilitationCase;
use App\Models\ServiceRequest;
use App\Models\ServiceRequestDocument;
use App\Models\ServiceType;
use App\Models\Village;
use Livewire\Component;
use Livewire\WithFileUploads;

class ServiceRequestForm extends Component
{
    use WithFileUploads;

    // Service Mode: dtsen, pbi, rehab, lainnya
    public string $mode = 'dtsen';

    public ?int $service_type_id = null;

    // Multi-step for DTSEN
    public int $dtsenStep = 1;

    // Common Applicant Fields
    public string $applicant_name = '';

    public string $applicant_nik = '';

    public string $family_card_number = '';

    public string $phone = '';

    public ?int $district_id = null;

    public ?int $village_id = null;

    public string $address = '';

    public bool $is_priority = false;

    public bool $statement_agreement = false;

    // DTSEN specific
    public ?int $dtsen_purpose_id = null;

    public string $purpose_description = '';

    public string $subject_name = '';

    public string $subject_nik = '';

    public string $relationship_to_applicant = 'Diri Sendiri';

    // PBI specific
    public string $bpjs_card_number = '';

    public ?string $deactivated_date = null;

    public string $pbi_reason = 'emergency';

    public string $health_facility_name = '';

    public string $health_letter_number = '';

    // Rehab specific
    public ?int $client_category_id = null;

    public string $client_name = '';

    public string $client_nik = '';

    public ?int $client_age = null;

    public string $client_gender = 'male';

    public string $client_condition = '';

    public string $applicant_relation_rehab = 'Keluarga';

    // File uploads
    public $file_ktp;

    public $file_kk;

    public $file_bpjs;

    public $file_faskes;

    public $file_dokumen_lain;

    // State
    public bool $isSubmitted = false;

    public ?string $generatedTicketNumber = null;

    public ?string $submittedServiceName = null;

    public ?string $submittedDate = null;

    public function mount(?string $service = null, ?int $service_type_id = null): void
    {
        if ($service === 'pbi' || $service === 'kis') {
            $this->mode = 'pbi';
        } elseif ($service === 'rehab' || $service === 'rehabilitasi') {
            $this->mode = 'rehab';
        } elseif ($service === 'lainnya') {
            $this->mode = 'lainnya';
        } else {
            $this->mode = 'dtsen';
        }

        // Set matching service_type_id
        if ($service_type_id) {
            $this->service_type_id = $service_type_id;
        } else {
            $handler = match ($this->mode) {
                'dtsen' => 'dtsen',
                'pbi' => 'pbi',
                default => null,
            };

            if ($handler) {
                $this->service_type_id = ServiceType::where('handler', $handler)->first()?->id;
            } else {
                $this->service_type_id = ServiceType::where('is_active', true)->first()?->id;
            }
        }

        // Default district
        $firstDistrict = District::first();
        if ($firstDistrict) {
            $this->district_id = $firstDistrict->id;
        }

        // Default DTSEN purpose
        $firstPurpose = DtsenPurpose::where('is_active', true)->first();
        if ($firstPurpose) {
            $this->dtsen_purpose_id = $firstPurpose->id;
        }

        // Default client category for rehab
        $firstCategory = ClientCategory::first();
        if ($firstCategory) {
            $this->client_category_id = $firstCategory->id;
        }
    }

    public function switchMode(string $newMode): void
    {
        $this->mode = $newMode;
        $this->dtsenStep = 1;

        if ($newMode === 'dtsen') {
            $this->service_type_id = ServiceType::where('handler', 'dtsen')->first()?->id;
        } elseif ($newMode === 'pbi') {
            $this->service_type_id = ServiceType::where('handler', 'pbi')->first()?->id;
        }
    }

    public function updatedDistrictId(): void
    {
        $this->village_id = null;
    }

    public function updatedPbiReason(): void
    {
        if ($this->pbi_reason === 'emergency') {
            $this->is_priority = true;
        } else {
            $this->is_priority = false;
        }
    }

    // DTSEN Stepper Actions
    public function nextDtsenStep(): void
    {
        if ($this->dtsenStep === 1) {
            $this->validate([
                'dtsen_purpose_id' => 'required|exists:dtsen_purposes,id',
            ]);
            $this->dtsenStep = 2;
        } elseif ($this->dtsenStep === 2) {
            $this->validate([
                'applicant_name' => 'required|string|max:255',
                'applicant_nik' => 'required|string|size:16',
                'family_card_number' => 'nullable|string|max:16',
                'phone' => 'required|string|max:20',
                'district_id' => 'required|exists:districts,id',
                'village_id' => 'required|exists:villages,id',
                'address' => 'required|string',
            ]);

            if (empty($this->subject_name)) {
                $this->subject_name = $this->applicant_name;
            }
            if (empty($this->subject_nik)) {
                $this->subject_nik = $this->applicant_nik;
            }

            $this->dtsenStep = 3;
        } elseif ($this->dtsenStep === 3) {
            $this->validate([
                'file_ktp' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
                'file_kk' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            ]);
            $this->dtsenStep = 4;
        }
    }

    public function prevDtsenStep(): void
    {
        if ($this->dtsenStep > 1) {
            $this->dtsenStep--;
        }
    }

    public function submit(): void
    {
        if ($this->mode === 'dtsen') {
            $this->submitDtsen();
        } elseif ($this->mode === 'pbi') {
            $this->submitPbi();
        } elseif ($this->mode === 'rehab') {
            $this->submitRehab();
        } else {
            $this->submitGeneral();
        }
    }

    protected function submitDtsen(): void
    {
        $this->validate([
            'applicant_name' => 'required|string|max:255',
            'applicant_nik' => 'required|string|size:16',
            'phone' => 'required|string|max:20',
            'district_id' => 'required|exists:districts,id',
            'village_id' => 'required|exists:villages,id',
            'address' => 'required|string',
            'dtsen_purpose_id' => 'required|exists:dtsen_purposes,id',
            'statement_agreement' => 'accepted',
        ]);

        $ticketNumber = 'DTSEN-'.date('Ym').'-'.str_pad((string) rand(10, 9999), 5, '0', STR_PAD_LEFT);

        $serviceRequest = ServiceRequest::create([
            'request_number' => $ticketNumber,
            'service_type_id' => $this->service_type_id ?? ServiceType::where('handler', 'dtsen')->first()?->id,
            'applicant_name' => $this->applicant_name,
            'applicant_nik' => $this->applicant_nik,
            'family_card_number' => $this->family_card_number,
            'phone' => $this->phone,
            'village_id' => $this->village_id,
            'address' => $this->address,
            'is_priority' => $this->is_priority,
            'status' => ServiceRequestStatus::Submitted,
            'submitted_at' => now(),
        ]);

        DtsenCertificate::create([
            'service_request_id' => $serviceRequest->id,
            'dtsen_purpose_id' => $this->dtsen_purpose_id,
            'purpose_description' => $this->purpose_description,
            'subject_name' => $this->subject_name ?: $this->applicant_name,
            'subject_nik' => $this->subject_nik ?: $this->applicant_nik,
            'relationship_to_applicant' => $this->relationship_to_applicant,
        ]);

        $this->storeUploads($serviceRequest);

        $this->onSuccess($ticketNumber, 'Surat Keterangan DTSEN');
    }

    protected function submitPbi(): void
    {
        $this->validate([
            'applicant_name' => 'required|string|max:255',
            'applicant_nik' => 'required|string|size:16',
            'phone' => 'required|string|max:20',
            'district_id' => 'required|exists:districts,id',
            'village_id' => 'required|exists:villages,id',
            'address' => 'required|string',
            'bpjs_card_number' => 'required|string|max:30',
            'pbi_reason' => 'required|string',
            'statement_agreement' => 'accepted',
        ]);

        $ticketNumber = 'PBI-'.date('Ym').'-'.str_pad((string) rand(10, 9999), 5, '0', STR_PAD_LEFT);

        $isEmergency = ($this->pbi_reason === 'emergency');

        $serviceRequest = ServiceRequest::create([
            'request_number' => $ticketNumber,
            'service_type_id' => $this->service_type_id ?? ServiceType::where('handler', 'pbi')->first()?->id,
            'applicant_name' => $this->applicant_name,
            'applicant_nik' => $this->applicant_nik,
            'family_card_number' => $this->family_card_number,
            'phone' => $this->phone,
            'village_id' => $this->village_id,
            'address' => $this->address,
            'is_priority' => $isEmergency || $this->is_priority,
            'status' => ServiceRequestStatus::Submitted,
            'submitted_at' => now(),
        ]);

        $pbiReasonEnum = match ($this->pbi_reason) {
            'chronic' => PbiReason::Chronic,
            'catastrophic' => PbiReason::Catastrophic,
            'newborn' => PbiReason::Newborn,
            'other' => PbiReason::Other,
            default => PbiReason::Emergency,
        };

        PbiReactivation::create([
            'service_request_id' => $serviceRequest->id,
            'participant_name' => $this->applicant_name,
            'participant_nik' => $this->applicant_nik,
            'bpjs_card_number' => $this->bpjs_card_number,
            'deactivated_date' => $this->deactivated_date,
            'reason' => $pbiReasonEnum,
            'health_facility_name' => $this->health_facility_name,
            'health_letter_number' => $this->health_letter_number,
        ]);

        $this->storeUploads($serviceRequest);

        $this->onSuccess($ticketNumber, 'Reaktivasi KIS / PBI-JK');
    }

    protected function submitRehab(): void
    {
        $this->validate([
            'applicant_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'district_id' => 'required|exists:districts,id',
            'village_id' => 'required|exists:villages,id',
            'client_category_id' => 'required|exists:client_categories,id',
            'client_name' => 'required|string|max:255',
            'client_condition' => 'required|string',
            'statement_agreement' => 'accepted',
        ]);

        $ticketNumber = 'REHAB-'.date('Ym').'-'.str_pad((string) rand(10, 9999), 5, '0', STR_PAD_LEFT);

        $serviceRequest = ServiceRequest::create([
            'request_number' => $ticketNumber,
            'service_type_id' => $this->service_type_id ?? ServiceType::first()?->id,
            'applicant_name' => $this->applicant_name,
            'applicant_nik' => $this->applicant_nik ?: '3505000000000000',
            'phone' => $this->phone,
            'village_id' => $this->village_id,
            'address' => $this->address ?: 'Kabupaten Blitar',
            'is_priority' => true,
            'status' => ServiceRequestStatus::Submitted,
            'submitted_at' => now(),
        ]);

        // Create client profile
        $client = Client::create([
            'name' => $this->client_name,
            'nik' => $this->client_nik ?: null,
            'client_category_id' => $this->client_category_id,
            'gender' => $this->client_gender,
            'birth_date' => $this->client_age ? now()->subYears($this->client_age)->toDateString() : null,
            'district_id' => $this->district_id,
            'village_id' => $this->village_id,
            'address' => $this->address,
        ]);

        // Create rehabilitation case
        RehabilitationCase::create([
            'case_number' => 'KASUS-'.date('Ym').'-'.str_pad((string) rand(10, 9999), 5, '0', STR_PAD_LEFT),
            'client_id' => $client->id,
            'service_request_id' => $serviceRequest->id,
            'received_at' => now(),
        ]);

        $this->storeUploads($serviceRequest);

        $this->onSuccess($ticketNumber, 'Permohonan Rehabilitasi Sosial');
    }

    protected function submitGeneral(): void
    {
        $this->validate([
            'service_type_id' => 'required|exists:service_types,id',
            'applicant_name' => 'required|string|max:255',
            'applicant_nik' => 'required|string|size:16',
            'phone' => 'required|string|max:20',
            'district_id' => 'required|exists:districts,id',
            'village_id' => 'required|exists:villages,id',
            'address' => 'required|string',
            'statement_agreement' => 'accepted',
        ]);

        $ticketNumber = 'REQ-'.date('Ym').'-'.str_pad((string) rand(10, 9999), 5, '0', STR_PAD_LEFT);

        $serviceRequest = ServiceRequest::create([
            'request_number' => $ticketNumber,
            'service_type_id' => $this->service_type_id,
            'applicant_name' => $this->applicant_name,
            'applicant_nik' => $this->applicant_nik,
            'family_card_number' => $this->family_card_number,
            'phone' => $this->phone,
            'village_id' => $this->village_id,
            'address' => $this->address,
            'is_priority' => $this->is_priority,
            'status' => ServiceRequestStatus::Submitted,
            'submitted_at' => now(),
        ]);

        $this->storeUploads($serviceRequest);

        $serviceTypeName = ServiceType::find($this->service_type_id)?->name ?? 'Layanan Sosial';
        $this->onSuccess($ticketNumber, $serviceTypeName);
    }

    protected function storeUploads(ServiceRequest $serviceRequest): void
    {
        $files = [
            'file_ktp' => 'KTP',
            'file_kk' => 'Kartu Keluarga',
            'file_bpjs' => 'Kartu BPJS/KIS',
            'file_faskes' => 'Surat Keterangan Faskes',
            'file_dokumen_lain' => 'Dokumen Pendukung',
        ];

        foreach ($files as $prop => $docName) {
            if ($this->$prop) {
                $path = $this->$prop->store('documents/service-requests', 'local');
                ServiceRequestDocument::create([
                    'service_request_id' => $serviceRequest->id,
                    'file_path' => $path,
                    'original_name' => $this->$prop->getClientOriginalName(),
                    'verification_status' => DocumentVerificationStatus::Pending,
                ]);
            }
        }
    }

    protected function onSuccess(string $ticketNumber, string $serviceName): void
    {
        $this->generatedTicketNumber = $ticketNumber;
        $this->submittedServiceName = $serviceName;
        $this->submittedDate = now()->translatedFormat('d F Y, H:i').' WIB';
        $this->isSubmitted = true;
    }

    public function resetForm(): void
    {
        $this->isSubmitted = false;
        $this->generatedTicketNumber = null;
        $this->dtsenStep = 1;
    }

    public function render()
    {
        $serviceTypes = ServiceType::where('is_active', true)->get();
        $districts = District::orderBy('name')->get();
        $villages = $this->district_id
            ? Village::where('district_id', $this->district_id)->orderBy('name')->get()
            : collect();
        $dtsenPurposes = DtsenPurpose::where('is_active', true)->get();
        $clientCategories = ClientCategory::all();

        // Selected DTSEN Purpose model
        $selectedPurpose = $this->dtsen_purpose_id ? DtsenPurpose::find($this->dtsen_purpose_id) : null;
        $selectedDistrict = $this->district_id ? District::find($this->district_id) : null;
        $selectedVillage = $this->village_id ? Village::find($this->village_id) : null;

        return view('livewire.service-request-form', [
            'serviceTypes' => $serviceTypes,
            'districts' => $districts,
            'villages' => $villages,
            'dtsenPurposes' => $dtsenPurposes,
            'clientCategories' => $clientCategories,
            'selectedPurpose' => $selectedPurpose,
            'selectedDistrict' => $selectedDistrict,
            'selectedVillage' => $selectedVillage,
        ])->layout('components.layouts.app', ['title' => 'Formulir Pengajuan Layanan — SAPA SOSIAL Blitar']);
    }
}
