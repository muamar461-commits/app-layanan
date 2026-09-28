<?php

namespace App\Livewire;

use App\Models\Complaint;
use App\Models\District;
use App\Models\ServiceRequest;
use App\Models\Village;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CitizenAccount extends Component
{
    public string $activeTab = 'requests'; // 'requests', 'complaints', 'profile'

    public string $name = '';

    public string $email = '';

    public string $phone = '';

    public string $nik = '';

    public ?int $district_id = null;

    public ?int $village_id = null;

    public string $address = '';

    public bool $profileSaved = false;

    public function mount(): void
    {
        $user = Auth::user();
        if ($user) {
            $this->name = $user->name ?? '';
            $this->email = $user->email ?? '';
            $this->phone = $user->phone ?? '';
            $this->nik = $user->nik ?? '';
            $this->district_id = $user->district_id;
            $this->village_id = $user->village_id;
        } else {
            // Demo default data if not logged in
            $this->name = 'Budi Santoso';
            $this->phone = '0812-3456-7890';
            $this->email = 'budi.santoso@gmail.com';
            $this->nik = '3505081234560001';
        }
    }

    public function setTab(string $tab): void
    {
        $this->activeTab = $tab;
    }

    public function updateProfile(): void
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
        ]);

        $user = Auth::user();
        if ($user) {
            $user->update([
                'name' => $this->name,
                'phone' => $this->phone,
                'email' => $this->email,
                'district_id' => $this->district_id,
                'village_id' => $this->village_id,
            ]);
        }

        $this->profileSaved = true;
    }

    public function logout(): void
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();

        $this->redirect(route('home'), navigate: true);
    }

    public function render()
    {
        $user = Auth::user();

        // Service Requests for current user (or demo matches by NIK/phone)
        $requestsQuery = ServiceRequest::with(['serviceType', 'village.district']);
        if ($user && $user->nik) {
            $requestsQuery->where(function ($q) use ($user) {
                $q->where('applicant_nik', $user->nik)
                    ->orWhere('phone', $user->phone);
            });
        }
        $serviceRequests = $requestsQuery->latest('submitted_at')->take(10)->get();

        // Complaints for current user
        $complaintsQuery = Complaint::with(['category', 'village.district']);
        if ($user && $user->phone) {
            $complaintsQuery->where('reporter_phone', $user->phone);
        }
        $complaints = $complaintsQuery->latest('reported_at')->take(10)->get();

        $districts = District::orderBy('name')->get();
        $villages = $this->district_id ? Village::where('district_id', $this->district_id)->orderBy('name')->get() : collect();

        return view('livewire.citizen-account', [
            'serviceRequests' => $serviceRequests,
            'complaints' => $complaints,
            'districts' => $districts,
            'villages' => $villages,
            'user' => $user,
        ])->layout('components.layouts.app', ['title' => 'Akun Saya & Riwayat Layanan — SAPA SOSIAL Blitar']);
    }
}
