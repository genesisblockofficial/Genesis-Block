<?php

namespace App\Livewire;

use App\Models\Service;
use Livewire\Component;

class Courses extends Component
{
    public function render()
    {
        $courses = Service::query()
            ->with('serviceDetails')
            ->where('is_active', true)
            ->orderBy('title')
            ->get();

        return view('livewire.courses', [
            'courses' => $courses,
        ])->layout('layout.app');
    }
}
