@guest
    @unless (request()->routeIs('login', 'register', 'password.*', 'two-factor.*'))
        <div class="auth-gate-modal" data-auth-modal aria-hidden="true" role="dialog" aria-modal="true" aria-labelledby="auth-gate-title">
            <div class="auth-gate-backdrop" data-auth-close></div>
            <div class="auth-gate-panel" role="document">
                <button class="auth-gate-close" type="button" data-auth-close aria-label="Close login dialog">&times;</button>
                <p class="account-eyebrow">GENESIS BLOCK <span>/</span> MEMBER ACCESS</p>
                <h2 id="auth-gate-title">Sign in to continue.</h2>
                <p class="auth-gate-intro">Log in to explore indicators, courses, news, resources and the gallery.</p>
                <form method="POST" action="{{ route('login.store') }}" class="auth-gate-form">
                    @csrf
                    <input type="hidden" name="remember" value="1">
                    <div><label for="auth-gate-email">Email address</label><input id="auth-gate-email" name="email" type="email" autocomplete="username" placeholder="you@example.com" required></div>
                    <div><label for="auth-gate-password">Password</label><input id="auth-gate-password" name="password" type="password" autocomplete="current-password" placeholder="Enter your password" required></div>
                    <button type="submit">Log in <i class="fas fa-arrow-right" aria-hidden="true"></i></button>
                </form>
                <p class="auth-gate-register">New to Genesis Block? <a href="{{ route('register') }}">Create an account</a></p>
            </div>
        </div>
    @endunless
@endguest
