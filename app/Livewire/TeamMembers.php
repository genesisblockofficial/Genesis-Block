<?php

namespace App\Livewire;

use App\Models\TeamMember;
use Livewire\Component;

class TeamMembers extends Component
{
    public function render()
    {
        return view('livewire.team-members', [
            'members' => TeamMember::query()
                ->where('is_active', true)
                ->orderByDesc('is_featured')
                ->orderBy('name')
                ->get(),
        ])->layout('layout.app');
    }
}
