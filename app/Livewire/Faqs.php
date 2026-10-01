<?php

namespace App\Livewire;

use App\Models\Faq;
use Livewire\Component;

class Faqs extends Component
{
    public string $search = '';

    public function render()
    {
        $faqs = Faq::query()
            ->where('is_active', true)
            ->when($this->search !== '', function ($query) {
                $query->where(function ($faqQuery) {
                    $faqQuery->where('question', 'like', '%' . $this->search . '%')
                        ->orWhere('answer', 'like', '%' . $this->search . '%');
                });
            })
            ->latest('created_at')
            ->get();

        return view('livewire.faqs', compact('faqs'))->layout('layout.app');
    }
}
