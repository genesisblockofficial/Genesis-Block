<main class="faq-page">
    <section class="faq-hero">
        <div class="container faq-hero-inner">
            <div><p class="account-eyebrow">GENESIS BLOCK <span>/</span> HELP CENTER</p><h1>Frequently asked<br><span>questions.</span></h1><p>Clear answers to help you get the most from your indicators, courses and market tools.</p></div>
            <div class="faq-search-wrap"><label for="faq-search">Find an answer</label><div><i class="fas fa-search" aria-hidden="true"></i><input id="faq-search" type="search" wire:model.live.debounce.300ms="search" placeholder="Search questions..."></div></div>
        </div>
    </section>

    <section class="faq-content">
        <div class="container">
            <div class="faq-content-heading"><div><p class="account-eyebrow">KNOWLEDGE BASE</p><h2>How can we help?</h2></div><span>{{ $faqs->count() }} answer{{ $faqs->count() === 1 ? '' : 's' }}</span></div>
            @if ($faqs->isNotEmpty())
                <div class="faq-list">
                    @foreach ($faqs as $faq)
                        <details class="faq-item" @if ($loop->first && $search === '') open @endif>
                            <summary><span>{{ $faq->question }}</span><i class="fas fa-plus" aria-hidden="true"></i></summary>
                            <div class="faq-answer">{!! $faq->answer !!}</div>
                        </details>
                    @endforeach
                </div>
            @else
                <div class="faq-empty"><i class="fas fa-circle-question" aria-hidden="true"></i><h3>No answers found</h3><p>Try a different search or check back when new questions are published.</p></div>
            @endif
        </div>
    </section>
</main>
