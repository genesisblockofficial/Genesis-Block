<main class="payment-result-page">
    <section class="container payment-result-panel">
        <p class="indicator-eyebrow">GENESIS BLOCK <span>/</span> PAYMENT STATUS</p>

        @if ($purchase->status === 'access_sent')
            <h1>Access has been sent.</h1>
            <p>TradingView access for {{ $purchase->indicator_name }} was sent to <strong>{{ $purchase->email }}</strong>.</p>
        @elseif ($purchase->status === 'paid')
            <h1>Payment received.</h1>
            <p>Your payment for {{ $purchase->indicator_name }} is confirmed. The team will review the order and email the TradingView access link to <strong>{{ $purchase->email }}</strong>.</p>
        @else
            <h1>Payment confirmation pending.</h1>
            <p>Stripe is still confirming the payment for {{ $purchase->indicator_name }}. If the charge completed, this page will update after confirmation. No access link is shown here.</p>
        @endif

        <a class="indicator-action-button payment-result-link" href="{{ route('indicators.index') }}">Back to indicators <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
    </section>
</main>