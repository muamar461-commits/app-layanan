<?php

namespace App\Livewire;

use App\Enums\PublishStatus;
use App\Models\InformationPage;
use App\Models\PageVisit;
use Livewire\Component;

class ServiceDetail extends Component
{
    public InformationPage $page;

    public function mount(string $slug): void
    {
        $this->page = InformationPage::with(['downloadableForms', 'faqs', 'serviceType'])
            ->where('slug', $slug)
            ->where('publish_status', PublishStatus::Published)
            ->firstOrFail();

        // Track page visit
        $today = now()->toDateString();
        $visit = PageVisit::firstOrCreate(
            ['information_page_id' => $this->page->id, 'visit_date' => $today],
            ['visit_count' => 0]
        );
        $visit->increment('visit_count');
    }

    public function render()
    {
        return view('livewire.service-detail')
            ->layout('components.layouts.app', ['title' => $this->page->title]);
    }
}
