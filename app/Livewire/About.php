<?php

namespace App\Livewire;

use App\Models\AboutUs as AboutUsModel;
use App\Models\Journey;
use App\Models\TeamMember;
use Livewire\Component;

class About extends Component
{
    public function render()
    {
        $aboutUs = AboutUsModel::first();
        $journeys = Journey::query()
            ->whereNotNull('years')
            ->whereNotNull('title')
            ->orderBy('years')
            ->get();
        $teamMembers = TeamMember::query()
            ->where('is_active', true)
            ->whereNotNull('name')
            ->orderByDesc('is_featured')
            ->orderBy('name')
            ->get();

        return view('livewire.about', [
            'aboutUs' => $aboutUs,
            'journeys' => $journeys,
            'teamMembers' => $teamMembers,
        ])->layout('layout.app');
    }
}
