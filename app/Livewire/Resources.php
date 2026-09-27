<?php

namespace App\Livewire;

use App\Models\BrokerRecommendation;
use App\Models\ResourceBook;
use Livewire\Component;

class Resources extends Component
{
    public function render()
    {
        $brokersByMarket = BrokerRecommendation::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get()
            ->groupBy('market');

        $books = ResourceBook::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('title')
            ->get();

        return view('livewire.resources', [
            'brokersByMarket' => $brokersByMarket,
            'books' => $books,
        ])->layout('layout.app');
    }
}
