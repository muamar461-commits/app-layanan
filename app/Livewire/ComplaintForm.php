<?php

namespace App\Livewire;

use App\Enums\ComplaintAttachmentType;
use App\Enums\ComplaintStatus;
use App\Models\Complaint;
use App\Models\ComplaintAttachment;
use App\Models\ComplaintCategory;
use App\Models\District;
use App\Models\Village;
use Livewire\Component;
use Livewire\WithFileUploads;

class ComplaintForm extends Component
{
    use WithFileUploads;

    public ?int $complaint_category_id = null;

    public string $reporter_name = '';

    public string $reporter_phone = '';

    public ?int $district_id = null;

    public ?int $village_id = null;

    public string $location_detail = '';

    public string $description = '';

    public $attachment_file;

    public bool $isSubmitted = false;

    public ?string $generatedComplaintNumber = null;

    public ?string $submittedDate = null;

    public function mount(): void
    {
        $this->complaint_category_id = ComplaintCategory::where('is_active', true)->first()?->id;

        $firstDistrict = District::first();
        if ($firstDistrict) {
            $this->district_id = $firstDistrict->id;
        }
    }

    public function updatedDistrictId(): void
    {
        $this->village_id = null;
    }

    protected function rules(): array
    {
        return [
            'complaint_category_id' => 'required|exists:complaint_categories,id',
            'reporter_name' => 'required|string|max:255',
            'reporter_phone' => 'required|string|max:20',
            'district_id' => 'required|exists:districts,id',
            'village_id' => 'required|exists:villages,id',
            'location_detail' => 'nullable|string',
            'description' => 'required|string|min:10',
            'attachment_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:3072',
        ];
    }

    public function submit(): void
    {
        $this->validate();

        $complaintNumber = 'ADU-'.date('Ym').'-'.str_pad((string) rand(10, 9999), 5, '0', STR_PAD_LEFT);

        $complaint = Complaint::create([
            'complaint_number' => $complaintNumber,
            'complaint_category_id' => $this->complaint_category_id,
            'reporter_name' => $this->reporter_name,
            'reporter_phone' => $this->reporter_phone,
            'village_id' => $this->village_id,
            'location_detail' => $this->location_detail,
            'description' => $this->description,
            'status' => ComplaintStatus::Received,
            'reported_at' => now(),
        ]);

        if ($this->attachment_file) {
            $path = $this->attachment_file->store('complaint-attachments', 'local');
            $ext = strtolower($this->attachment_file->getClientOriginalExtension());
            $type = in_array($ext, ['jpg', 'jpeg', 'png']) ? ComplaintAttachmentType::Photo : ComplaintAttachmentType::Document;

            ComplaintAttachment::create([
                'complaint_id' => $complaint->id,
                'file_path' => $path,
                'type' => $type,
            ]);
        }

        $this->generatedComplaintNumber = $complaintNumber;
        $this->submittedDate = now()->translatedFormat('d F Y, H:i').' WIB';
        $this->isSubmitted = true;
    }

    public function resetForm(): void
    {
        $this->isSubmitted = false;
        $this->generatedComplaintNumber = null;
        $this->description = '';
        $this->location_detail = '';
        $this->attachment_file = null;
    }

    public function render()
    {
        $categories = ComplaintCategory::where('is_active', true)->get();
        $districts = District::orderBy('name')->get();
        $villages = $this->district_id
            ? Village::where('district_id', $this->district_id)->orderBy('name')->get()
            : collect();

        $selectedCategory = $this->complaint_category_id ? ComplaintCategory::find($this->complaint_category_id) : null;

        return view('livewire.complaint-form', [
            'categories' => $categories,
            'districts' => $districts,
            'villages' => $villages,
            'selectedCategory' => $selectedCategory,
        ])->layout('components.layouts.app', ['title' => 'Pengaduan & Laporan Masalah Sosial — SAPA SOSIAL Blitar']);
    }
}
