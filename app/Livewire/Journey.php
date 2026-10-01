<?php

namespace App\Livewire;

use App\Models\Journey as JourneyModel;
use Livewire\Component;

class Journey extends Component
{
    public function render()
    {
        return view('livewire.journey', [
            'milestones' => JourneyModel::query()->latest('id')->get(),
        ])->layout('layout.app');
    }
}
