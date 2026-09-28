<?php

namespace App\Livewire;

use App\Enums\PublishStatus;
use App\Models\Faq;
use App\Models\InformationPage;
use App\Models\SearchLog;
use Livewire\Component;

class InformationFaq extends Component
{
    public string $search = '';

    public string $selectedCategory = 'all';

    public function setKeyword(string $keyword): void
    {
        $this->search = $keyword;
    }

    public function updatedSearch(): void
    {
        if (strlen($trimmed = trim($this->search)) >= 3) {
            SearchLog::create([
                'keyword' => $trimmed,
                'result_count' => InformationPage::where('publish_status', PublishStatus::Published)
                    ->where(function ($query) use ($trimmed) {
                        $query->where('title', 'like', "%{$trimmed}%")
                            ->orWhere('description', 'like', "%{$trimmed}%");
                    })->count(),
                'searched_at' => now(),
            ]);
        }
    }

    public function render()
    {
        $query = InformationPage::where('publish_status', PublishStatus::Published);

        if (! empty(trim($this->search))) {
            $keyword = trim($this->search);
            $query->where(function ($q) use ($keyword) {
                $q->where('title', 'like', "%{$keyword}%")
                    ->orWhere('description', 'like', "%{$keyword}%")
                    ->orWhere('requirements', 'like', "%{$keyword}%");
            });
        }

        if ($this->selectedCategory !== 'all') {
            $query->where('category', $this->selectedCategory);
        }

        $articles = $query->latest('published_at')->get();

        $faqsQuery = Faq::where('is_active', true)->orderBy('sort_order');
        if (! empty(trim($this->search))) {
            $keyword = trim($this->search);
            $faqsQuery->where(function ($q) use ($keyword) {
                $q->where('question', 'like', "%{$keyword}%")
                    ->orWhere('answer', 'like', "%{$keyword}%");
            });
        }
        $faqs = $faqsQuery->get()->groupBy('category');

        return view('livewire.information-faq', [
            'articles' => $articles,
            'faqs' => $faqs,
        ])->layout('components.layouts.app', ['title' => 'Pusat Informasi & FAQ — SAPA SOSIAL Blitar']);
    }
}
