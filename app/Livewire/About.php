<?php

namespace App\Livewire;

use Livewire\Component;

class About extends Component
{
    public function render()
    {
        $aboutUs = \App\Models\AboutUs::first();

        return view('livewire.about', [
            'aboutUs' => $aboutUs,
        ])->layout('layout.app');
    }
}
