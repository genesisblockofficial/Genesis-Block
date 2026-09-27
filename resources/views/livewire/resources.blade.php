<main class="resources-page">
    <section class="resources-hero">
        <div class="container resources-hero-layout">
            <div>
                <p class="resource-eyebrow">GENESIS BLOCK <span>/</span> RESOURCE LIBRARY</p>
                <h1>Keep learning.<br><span>Keep sharpening your perspective.</span></h1>
                <p class="resources-hero-copy">Whether you trade or not, continuous learning matters. Explore recommendations and reading that encourage trading knowledge, self-development, emotional discipline, risk awareness and simplicity.</p>
                <div class="resource-topic-list" aria-label="Learning themes">
                    <span>Trading knowledge</span><span>Self-development</span><span>Emotional discipline</span><span>Risk management</span>
                </div>
            </div>
            <div class="resources-hero-aside">
                <span class="resource-aside-number">01</span>
                <p>Learn with curiosity.<br>Decide independently.</p>
            </div>
        </div>
    </section>

    <section class="resources-brokers" id="broker-recommendations">
        <div class="container">
            <div class="resources-section-heading">
                <div>
                    <p class="resource-eyebrow">BROKER DIRECTORY</p>
                    <h2>Recommended brokers</h2>
                </div>
                <p>These external services are listed for reference. Review each provider's fees, terms and regulatory status before opening an account.</p>
            </div>

            @foreach (['stock' => 'Stock market', 'forex' => 'Forex'] as $market => $marketLabel)
                @php($marketBrokers = $brokersByMarket->get($market, collect()))
                <section class="resource-market-section" aria-labelledby="market-{{ $market }}">
                    <div class="resource-market-heading">
                        <h3 id="market-{{ $market }}">{{ $marketLabel }}</h3>
                        <span>{{ str_pad($marketBrokers->count(), 2, '0', STR_PAD_LEFT) }}</span>
                    </div>

                    @if ($marketBrokers->isNotEmpty())
                        <div class="resource-broker-list">
                            @foreach ($marketBrokers as $broker)
                                <article class="resource-broker">
                                    <a class="resource-broker-main" href="{{ $broker->website_url }}" target="_blank" rel="sponsored noopener noreferrer">
                                        <span class="resource-broker-logo">
                                            @if ($broker->logo)
                                                    <img src="{{ asset('storage/' . ltrim($broker->logo, '/')) }}" alt="{{ $broker->name }} logo" loading="lazy">
                                            @else
                                                <span aria-hidden="true">{{ strtoupper(substr($broker->name, 0, 2)) }}</span>
                                            @endif
                                        </span>
                                        <span class="resource-broker-content">
                                            <span class="resource-broker-category">{{ $marketLabel }}</span>
                                            <strong>{{ $broker->name }}</strong>
                                            @if ($broker->description)
                                                <span class="resource-broker-description">{{ $broker->description }}</span>
                                            @endif
                                            <span class="resource-broker-visit">Visit broker website <i class="fas fa-arrow-up-right-from-square" aria-hidden="true"></i></span>
                                        </span>
                                    </a>
                                </article>
                            @endforeach
                        </div>
                    @else
                        <p class="resource-empty-state">No {{ strtolower($marketLabel) }} recommendations are currently published.</p>
                    @endif
                </section>
            @endforeach

            <p class="resource-disclaimer">Genesis Block is an education resource, not a broker or financial adviser. External links may be referral links. Always make your own checks before sharing personal details or opening an account.</p>
        </div>
    </section>

    <section class="resources-books" id="recommended-books">
        <div class="container">
            <div class="resources-section-heading">
                <div>
                    <p class="resource-eyebrow">A READING LIST</p>
                    <h2>Books we recommend</h2>
                </div>
                <p>A mix of trading, focus and personal-development titles. Use the tags as a starting point for choosing what to read next.</p>
            </div>
            <div class="resource-books-grid">
                @foreach ($books as $index => $book)
                    <article class="resource-book">
                        <div class="resource-book-cover-wrap">
                            @if ($book->cover_image)
                                <img class="resource-book-cover" src="{{ asset('storage/' . ltrim($book->cover_image, '/')) }}" alt="{{ $book->title }} cover" loading="lazy">
                            @else
                                <div class="resource-book-cover-placeholder" aria-hidden="true">{{ strtoupper(substr($book->title, 0, 1)) }}</div>
                            @endif
                        </div>
                        <div class="resource-book-topline">
                            <span>{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}@if ($book->author) <span class="resource-book-author">· {{ $book->author }}</span> @endif</span>
                            <span class="resource-book-rating" aria-label="Rated {{ $book->rating }} out of 5 stars">
                                @for ($star = 0; $star < $book->rating; $star++)
                                    <i class="fas fa-star" aria-hidden="true"></i>
                                @endfor
                            </span>
                        </div>
                        <h3>{{ $book->title }}</h3>
                        <div class="resource-book-tags">
                            <span class="{{ $book->is_beginner ? 'is-recommended' : '' }}">Beginner <b>{{ $book->is_beginner ? 'Yes' : 'No' }}</b></span>
                            <span class="{{ $book->for_experienced_traders ? 'is-recommended' : '' }}">Experienced <b>{{ $book->for_experienced_traders ? 'Yes' : 'No' }}</b></span>
                            <span class="{{ $book->is_self_help ? 'is-recommended' : '' }}">Self-development <b>{{ $book->is_self_help ? 'Yes' : 'No' }}</b></span>
                        </div>
                        <a class="resource-book-buy" href="{{ $book->amazon_url }}" target="_blank" rel="sponsored noopener noreferrer">Buy on Amazon <i class="fas fa-arrow-up-right-from-square" aria-hidden="true"></i></a>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
</main>
