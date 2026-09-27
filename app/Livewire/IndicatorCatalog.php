<?php

namespace App\Livewire;

use App\Models\Indicator;
use App\Models\TradeSetup;
use Livewire\Component;

class IndicatorCatalog extends Component
{
    public function render()
    {
        $indicators = Indicator::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $recentSetups = TradeSetup::query()
            ->with('indicator:id,name,slug')
            ->where('is_active', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->orderByDesc('published_at')
            ->limit(6)
            ->get();

        return view('livewire.indicator-catalog', [
            'indicators' => $indicators,
            'recentSetups' => $recentSetups,
        ])->layout('layout.app');
    }
}
