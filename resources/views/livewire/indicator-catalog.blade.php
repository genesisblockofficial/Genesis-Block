<main class="indicator-page">
    <section class="indicator-hero">
        <div class="container indicator-hero-layout">
            <div>
                <p class="indicator-eyebrow">GENESIS BLOCK <span>/</span> INDICATORS</p>
                <h1>Explore the setup.<br><span>Understand the tool.</span></h1>
                <p>Learn what each TradingView indicator is designed to show, review recent setups published by our team, and decide whether it fits your own research.</p>
            </div>
            <p class="indicator-hero-note">Setups are for education and discussion only. They are not instructions or guarantees of future results.</p>
        </div>
    </section>

    <section class="indicator-setups">
        <div class="container">
            <div class="indicator-section-heading">
                <div><p class="indicator-eyebrow">RECENTLY PUBLISHED</p><h2>Trade setups</h2></div>
                <p>Recent examples added and managed by the Genesis Block admin team.</p>
            </div>

            @if (session('status'))
                <div class="indicator-feedback" role="status">{{ session('status') }}</div>
            @endif

            @if ($recentSetups->isNotEmpty())
                <div class="indicator-setup-list">
                    @foreach ($recentSetups as $setup)
                        <article class="indicator-setup">
                            <div class="indicator-setup-topline">
                                <span class="indicator-direction indicator-direction-{{ $setup->direction }}">{{ ucfirst($setup->direction) }}</span>
                                <time datetime="{{ $setup->published_at->toIso8601String() }}">{{ $setup->published_at->format('M j, Y · g:i A') }}</time>
                            </div>
                            <div class="indicator-setup-main">
                                <div>
                                    <p class="indicator-setup-market">{{ $setup->market ?: 'Market setup' }}@if ($setup->indicator) <span> / {{ $setup->indicator->name }}</span> @endif</p>
                                    <h3>{{ $setup->symbol }} <span>{{ $setup->title }}</span></h3>
                                    @if ($setup->analysis)
                                        <p class="indicator-setup-analysis">{{ $setup->analysis }}</p>
                                    @endif
                                </div>
                                @if ($setup->chart_image)
                                    <img class="indicator-setup-image" src="{{ asset('storage/' . ltrim($setup->chart_image, '/')) }}" alt="{{ $setup->symbol }} setup chart" loading="lazy">
                                @endif
                            </div>
                            <dl class="indicator-setup-levels">
                                @if ($setup->entry_zone)
                                    <div><dt>Entry zone</dt><dd>{{ $setup->entry_zone }}</dd></div>
                                @endif
                                @if ($setup->stop_loss)
                                    <div><dt>Stop loss</dt><dd>{{ $setup->stop_loss }}</dd></div>
                                @endif
                                @if ($setup->target_zone)
                                    <div><dt>Target zone</dt><dd>{{ $setup->target_zone }}</dd></div>
                                @endif
                            </dl>
                        </article>
                    @endforeach
                </div>
            @else
                <p class="indicator-empty-state">No recent trade setups have been published yet.</p>
            @endif
        </div>
    </section>

    <section class="indicator-catalog">
        <div class="container">
            <div class="indicator-section-heading">
                <div><p class="indicator-eyebrow">TRADINGVIEW TOOLS</p><h2>Available indicators</h2></div>
                <p>Access links are delivered by email after a free request is reviewed or a paid order is approved.</p>
            </div>

            @if ($errors->has('checkout'))
                <div class="indicator-feedback" role="alert">{{ $errors->first('checkout') }}</div>
            @endif

            @if (session('access_request_sent'))
                <div class="indicator-feedback" role="status">{{ session('access_request_sent') }}</div>
            @endif

            @if ($indicators->isNotEmpty())
                <div class="indicator-card-grid">
                    @foreach ($indicators as $indicator)
                        <article class="indicator-card">
                            @if ($indicator->cover_image)
                                <img class="indicator-card-image" src="{{ asset('storage/' . ltrim($indicator->cover_image, '/')) }}" alt="{{ $indicator->name }}" loading="lazy">
                            @else
                                <div class="indicator-card-image indicator-card-placeholder" aria-hidden="true"><i class="fas fa-chart-line"></i></div>
                            @endif
                            <div class="indicator-card-content">
                                <div class="indicator-card-meta">
                                    <span>{{ $indicator->is_paid ? 'PAID ACCESS' : 'FREE ACCESS' }}</span>
                                    @if ($indicator->is_paid)
                                        <strong>${{ number_format($indicator->price_cents / 100, 2) }} USD</strong>
                                    @endif
                                </div>
                                <h3>{{ $indicator->name }}</h3>
                                @if ($indicator->summary)
                                    <p class="indicator-card-summary">{{ $indicator->summary }}</p>
                                @endif
                                @if ($indicator->description)
                                    <p class="indicator-card-description">{{ $indicator->description }}</p>
                                @endif

                                @if ($indicator->is_paid)
                                    @if ($indicator->price_cents >= 50)
                                        <form class="indicator-access-form" method="POST" action="{{ route('indicators.checkout', $indicator) }}">
                                            @csrf
                                            <label for="purchase-email-{{ $indicator->id }}">Email for access</label>
                                            <input id="purchase-email-{{ $indicator->id }}" name="email" type="email" value="{{ old('email') }}" autocomplete="email" placeholder="you@example.com" required>
                                            <button class="indicator-action-button" type="submit">Continue to secure checkout <i class="fas fa-arrow-right" aria-hidden="true"></i></button>
                                        </form>
                                    @else
                                        <p class="indicator-price-warning">Checkout is unavailable until this paid indicator is priced at $0.50 USD or more. Please contact the team.</p>
                                    @endif
                                @else
                                    <form class="indicator-access-form" method="POST" action="{{ route('indicators.free-request', $indicator) }}">
                                        @csrf
                                        <label for="request-email-{{ $indicator->id }}">Request free access</label>
                                        <input id="request-email-{{ $indicator->id }}" name="email" type="email" autocomplete="email" placeholder="you@example.com" required>
                                        <button class="indicator-action-button indicator-action-outline" type="submit">Request access <i class="fas fa-arrow-right" aria-hidden="true"></i></button>
                                    </form>
                                @endif
                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <p class="indicator-empty-state">No indicators are currently available. Check back for new tools.</p>
            @endif
        </div>
    </section>

    <section class="indicator-disclaimer">
        <div class="container"><p>Trading involves risk, and losses are possible. Indicator access and example setups are educational tools, not individualized financial advice or a promise of performance. Always review a setup independently and manage risk appropriately.</p></div>
    </section>
</main>
