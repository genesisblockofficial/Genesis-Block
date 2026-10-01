<main class="journal-page">
    <section class="journal-hero">
        <div class="container journal-hero-inner">
            <div><p class="account-eyebrow">GENESIS BLOCK <span>/</span> TRADING JOURNAL</p><h1>Review the trade.<br><span>Improve the process.</span></h1><p>Capture every setup, decision and result so your trading becomes measurable.</p></div>
            <div class="journal-hero-stat"><strong>{{ $entries->count() }}</strong><span>saved setup{{ $entries->count() === 1 ? '' : 's' }}</span></div>
        </div>
    </section>

    <section class="journal-content">
        <div class="container">
            @if (session('journal-status'))<div class="journal-feedback" role="status">{{ session('journal-status') }}</div>@endif
            <div class="journal-layout">
                <section class="journal-form-panel">
                    <div class="journal-panel-heading"><p class="account-eyebrow">{{ $editingId ? 'UPDATE ENTRY' : 'NEW ENTRY' }}</p><h2>{{ $editingId ? 'Edit trade setup' : 'Log a trade setup' }}</h2><p>Write down the plan before the outcome takes over the story.</p></div>
                    <form wire:submit="save" class="journal-form">
                        <div class="journal-form-grid journal-form-grid-three">
                            <div><label for="trade-date">Trade date</label><input id="trade-date" type="date" wire:model="tradeDate" required></div>
                            <div><label for="trade-symbol">Symbol</label><input id="trade-symbol" type="text" wire:model="symbol" placeholder="EURUSD" required></div>
                            <div><label for="trade-direction">Direction</label><select id="trade-direction" wire:model="direction"><option value="long">Long</option><option value="short">Short</option></select></div>
                        </div>
                        <div class="journal-form-grid journal-form-grid-three">
                            <div><label for="trade-entry">Entry</label><input id="trade-entry" type="number" step="any" wire:model="entryPrice" placeholder="1.08450"></div>
                            <div><label for="trade-stop">Stop loss</label><input id="trade-stop" type="number" step="any" wire:model="stopLoss" placeholder="1.08150"></div>
                            <div><label for="trade-target">Target</label><input id="trade-target" type="number" step="any" wire:model="targetPrice" placeholder="1.09000"></div>
                        </div>
                        <div><label for="trade-setup">Setup name</label><input id="trade-setup" type="text" wire:model="setup" placeholder="London breakout, pullback, liquidity sweep" required></div>
                        <div class="journal-form-grid journal-form-grid-two">
                            <div><label for="trade-result">Result</label><select id="trade-result" wire:model="result"><option value="planned">Planned</option><option value="win">Win</option><option value="loss">Loss</option><option value="breakeven">Breakeven</option></select></div>
                            <div><label for="trade-pnl">P/L</label><input id="trade-pnl" type="number" step="0.01" wire:model="pnl" placeholder="0.00"></div>
                        </div>
                        <div><label for="trade-notes">Notes and review</label><textarea id="trade-notes" wire:model="notes" rows="5" placeholder="What did you see? What did you execute well? What will you change?"></textarea></div>
                        @if ($errors->any())<p class="journal-error">{{ $errors->first() }}</p>@endif
                        <div class="journal-form-actions"><button class="journal-primary-button" type="submit">{{ $editingId ? 'Update entry' : 'Save setup' }} <i class="fas fa-arrow-right" aria-hidden="true"></i></button>@if ($editingId)<button class="journal-cancel-button" type="button" wire:click="resetForm">Cancel edit</button>@endif</div>
                    </form>
                </section>

                <section class="journal-list-panel">
                    <div class="journal-panel-heading"><p class="account-eyebrow">YOUR RECORD</p><h2>My journal</h2><p>Your saved trade setups, newest first.</p></div>
                    @if ($entries->isNotEmpty())
                        <div class="journal-entry-list">
                            @foreach ($entries as $entry)
                                <article class="journal-entry">
                                    <div class="journal-entry-top"><div><time>{{ $entry->trade_date->format('M j, Y') }}</time><h3>{{ $entry->symbol }} <span class="journal-direction journal-direction-{{ $entry->direction }}">{{ ucfirst($entry->direction) }}</span></h3></div><span class="journal-result journal-result-{{ $entry->result }}">{{ ucfirst($entry->result) }}</span></div>
                                    <p class="journal-entry-setup">{{ $entry->setup }}</p>
                                    <div class="journal-entry-levels"><span>Entry <strong>{{ $entry->entry_price ?: '-' }}</strong></span><span>Stop <strong>{{ $entry->stop_loss ?: '-' }}</strong></span><span>Target <strong>{{ $entry->target_price ?: '-' }}</strong></span>@if ($entry->pnl !== null)<span>P/L <strong class="{{ $entry->pnl >= 0 ? 'journal-profit' : 'journal-loss' }}">{{ $entry->pnl >= 0 ? '+' : '' }}{{ $entry->pnl }}</strong></span>@endif</div>
                                    @if ($entry->notes)<p class="journal-entry-notes">{{ $entry->notes }}</p>@endif
                                    <div class="journal-entry-actions"><button type="button" wire:click="edit({{ $entry->id }})">Edit</button><button type="button" wire:click="delete({{ $entry->id }})" wire:confirm="Delete this journal entry?">Delete</button></div>
                                </article>
                            @endforeach
                        </div>
                    @else
                        <div class="journal-empty"><i class="fas fa-book-open" aria-hidden="true"></i><h3>Your journal is empty</h3><p>Save your first setup and build a record you can learn from.</p></div>
                    @endif
                </section>
            </div>
        </div>
    </section>
</main>
