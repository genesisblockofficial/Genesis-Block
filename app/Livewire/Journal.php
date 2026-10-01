<?php

namespace App\Livewire;

use App\Models\TradeJournal;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Journal extends Component
{
    public ?int $editingId = null;

    public string $tradeDate = '';
    public string $symbol = '';
    public string $direction = 'long';
    public string $setup = '';
    public string $entryPrice = '';
    public string $stopLoss = '';
    public string $targetPrice = '';
    public string $result = 'planned';
    public string $pnl = '';
    public string $notes = '';

    public function mount(): void
    {
        $this->tradeDate = now()->toDateString();
    }

    public function save(): void
    {
        $data = $this->validate([
            'tradeDate' => ['required', 'date'],
            'symbol' => ['required', 'string', 'max:32'],
            'direction' => ['required', 'in:long,short'],
            'setup' => ['required', 'string', 'max:255'],
            'entryPrice' => ['nullable', 'numeric'],
            'stopLoss' => ['nullable', 'numeric'],
            'targetPrice' => ['nullable', 'numeric'],
            'result' => ['required', 'in:planned,win,loss,breakeven'],
            'pnl' => ['nullable', 'numeric'],
            'notes' => ['nullable', 'string', 'max:5000'],
        ]);

        $journal = $this->editingId
            ? TradeJournal::query()->where('user_id', Auth::id())->findOrFail($this->editingId)
            : new TradeJournal();

        $journal->user_id = Auth::id();
        $journal->trade_date = $data['tradeDate'];
        $journal->symbol = strtoupper($data['symbol']);
        $journal->direction = $data['direction'];
        $journal->setup = $data['setup'];
        $journal->entry_price = $data['entryPrice'] ?: null;
        $journal->stop_loss = $data['stopLoss'] ?: null;
        $journal->target_price = $data['targetPrice'] ?: null;
        $journal->result = $data['result'];
        $journal->pnl = $data['pnl'] === '' ? null : $data['pnl'];
        $journal->notes = $data['notes'] ?: null;
        $journal->save();

        session()->flash('journal-status', $this->editingId ? 'Journal entry updated.' : 'Trade setup saved to your journal.');
        $this->resetForm();
    }

    public function edit(int $id): void
    {
        $entry = TradeJournal::query()->where('user_id', Auth::id())->findOrFail($id);

        $this->editingId = $entry->id;
        $this->tradeDate = (string) $entry->getRawOriginal('trade_date');
        $this->symbol = $entry->symbol;
        $this->direction = $entry->direction;
        $this->setup = $entry->setup;
        $this->entryPrice = (string) ($entry->entry_price ?? '');
        $this->stopLoss = (string) ($entry->stop_loss ?? '');
        $this->targetPrice = (string) ($entry->target_price ?? '');
        $this->result = $entry->result;
        $this->pnl = (string) ($entry->pnl ?? '');
        $this->notes = $entry->notes ?? '';
    }

    public function delete(int $id): void
    {
        TradeJournal::query()->where('user_id', Auth::id())->findOrFail($id)->delete();
        session()->flash('journal-status', 'Journal entry deleted.');
    }

    public function resetForm(): void
    {
        $this->reset(['editingId', 'symbol', 'setup', 'entryPrice', 'stopLoss', 'targetPrice', 'pnl', 'notes']);
        $this->tradeDate = now()->toDateString();
        $this->direction = 'long';
        $this->result = 'planned';
    }

    public function render()
    {
        return view('livewire.journal', [
            'entries' => TradeJournal::query()
                ->where('user_id', Auth::id())
                ->latest('trade_date')
                ->latest('id')
                ->get(),
        ])->layout('layout.app');
    }
}
