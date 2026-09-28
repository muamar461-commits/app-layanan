<?php

namespace App\Livewire;

use App\Enums\PublishStatus;
use App\Models\InformationPage;
use App\Models\ServiceType;
use Livewire\Component;

class ServiceCatalog extends Component
{
    public string $search = '';

    public string $selectedCategory = 'all';

    public function setCategory(string $category): void
    {
        $this->selectedCategory = $category;
    }

    public function render()
    {
        $query = ServiceType::where('is_active', true);

        if (! empty(trim($this->search))) {
            $keyword = trim($this->search);
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%")
                    ->orWhere('description', 'like', "%{$keyword}%")
                    ->orWhere('category', 'like', "%{$keyword}%");
            });
        }

        if ($this->selectedCategory !== 'all') {
            $query->where(function ($q) {
                if ($this->selectedCategory === 'bansos') {
                    $q->where('category', 'like', '%Bansos%')
                        ->orWhere('category', 'like', '%Dasar%')
                        ->orWhere('handler', 'dtsen');
                } elseif ($this->selectedCategory === 'kesehatan') {
                    $q->where('category', 'like', '%Kesehatan%')
                        ->orWhere('handler', 'pbi');
                } elseif ($this->selectedCategory === 'rehabilitasi') {
                    $q->where('category', 'like', '%Rehabilitasi%')
                        ->orWhere('needs_assessment', true);
                } elseif ($this->selectedCategory === 'pengaduan') {
                    $q->where('category', 'like', '%Pengaduan%');
                }
            });
        }

        $serviceTypes = $query->orderBy('id')->get();
        $totalServicesCount = ServiceType::where('is_active', true)->count();

        // Also fetch published information pages
        $infoPages = InformationPage::where('publish_status', PublishStatus::Published)->get()->keyBy('service_type_id');

        return view('livewire.service-catalog', [
            'serviceTypes' => $serviceTypes,
            'totalServicesCount' => $totalServicesCount,
            'infoPages' => $infoPages,
        ])->layout('components.layouts.app', ['title' => 'Katalog & Informasi Layanan Sosial — SAPA SOSIAL Blitar']);
    }
}
