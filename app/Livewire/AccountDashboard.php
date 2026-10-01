<?php

namespace App\Livewire;

use App\Models\IndicatorAccessRequest;
use App\Models\IndicatorPurchase;
use App\Models\TradeJournal;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AccountDashboard extends Component
{
    public function render()
    {
        $user = Auth::user();

        $purchases = IndicatorPurchase::query()
            ->with('indicator:id,name,slug,summary,cover_image')
            ->whereIn('status', ['paid', 'access_sent'])
            ->where(function ($query) use ($user) {
                $query->where('user_id', $user->id)
                    ->orWhere('email', $user->email);
            })
            ->latest('paid_at')
            ->get()
            ->unique('indicator_id');

        $freeAccess = IndicatorAccessRequest::query()
            ->with('indicator:id,name,slug,summary,cover_image')
            ->where('status', 'access_sent')
            ->where(function ($query) use ($user) {
                $query->where('user_id', $user->id)
                    ->orWhere('email', $user->email);
            })
            ->latest('updated_at')
            ->get()
            ->unique('indicator_id');

        $indicators = $purchases->concat($freeAccess)
            ->filter(fn ($access) => $access->indicator)
            ->unique(fn ($access) => $access->indicator->id)
            ->values();

        $journalEntries = TradeJournal::query()
            ->where('user_id', $user->id)
            ->latest('trade_date')
            ->latest('id')
            ->limit(3)
            ->get();

        return view('livewire.account-dashboard', [
            'user' => $user,
            'indicators' => $indicators,
            'journalEntries' => $journalEntries,
        ])->layout('layout.app');
    }

    public function logout(): void
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        $this->redirect(route('home'));
    }
}
