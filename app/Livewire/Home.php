<?php

namespace App\Livewire;

use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        return view('livewire.homepage')->layout('layout.app', [
            'seoTitle' => 'Market Education, Trading Indicators & Insights | Genesis Block',
            'seoDescription' => 'Learn about market structure, explore TradingView indicators and review educational trade setups designed to support independent research.',
            'seoCanonical' => route('home'),
        ]);
    }
}
