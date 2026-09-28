<?php

namespace App\Livewire;

use App\Models\District;
use App\Models\Faq;
use App\Models\ServiceType;
use Livewire\Component;

class Home extends Component
{
    public string $ticketNumber = '';

    public string $nikLastDigits = '';

    public function trackQuickTicket(): void
    {
        $ticket = trim($this->ticketNumber);
        if (! empty($ticket)) {
            $this->redirect(route('cek-status', ['ticket' => $ticket]), navigate: true);
        }
    }

    public function render()
    {
        $faqs = Faq::where('is_active', true)->orderBy('sort_order')->take(6)->get();
        $serviceCount = ServiceType::where('is_active', true)->count();
        $districtCount = District::count() ?: 22;

        return view('livewire.home', [
            'faqs' => $faqs,
            'serviceCount' => $serviceCount,
            'districtCount' => $districtCount,
        ])->layout('components.layouts.app', ['title' => 'Beranda — Satu Pintu Layanan Sosial Kabupaten Blitar']);
    }
}
