<main class="auth-page">
    <section class="container auth-layout" aria-labelledby="login-title">
        <div class="auth-intro">
            <p class="auth-eyebrow">GENESIS BLOCK <span>/</span> ACCOUNT ACCESS</p>
            <div>
                <h1 id="login-title">Welcome back.</h1>
                <p>Continue exploring market education and resources from Genesis Block.</p>
            </div>
            <p class="auth-note">A place to learn, understand and think independently.</p>
        </div>

        <div class="auth-form-panel">
            <div class="auth-form-heading">
                <p class="auth-eyebrow">YOUR ACCOUNT</p>
                <h2>Sign in</h2>
                <p>Enter your account details to continue.</p>
            </div>

            <a class="auth-google-button" href="{{ route('auth.google.redirect') }}">
                <i class="fab fa-google" aria-hidden="true"></i>
                <span>Continue with Google</span>
            </a>
            <div class="auth-divider" aria-hidden="true"><span>or sign in with email</span></div>

            @if (session('status'))
                <div class="auth-status" role="status">{{ session('status') }}</div>
            @endif

            @if ($errors->any())
                <div class="auth-error-summary" role="alert">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('login.store') }}" class="auth-form">
                @csrf

                <div class="auth-field">
                    <label for="email">Email address</label>
                    <input id="email" name="email" type="email" value="{{ old('email', request()->query('email')) }}"
                        autocomplete="username" inputmode="email" placeholder="you@example.com" required autofocus>
                </div>

                <div class="auth-field">
                    <div class="auth-field-heading">
                        <label for="password">Password</label>
                        <a href="{{ route('password.request') }}">Forgot password?</a>
                    </div>
                    <input id="password" name="password" type="password" autocomplete="current-password"
                        placeholder="Enter your password" required>
                </div>

                <label class="auth-remember" for="remember">
                    <input id="remember" name="remember" type="checkbox" value="1" @checked(old('remember'))>
                    <span>Remember me</span>
                </label>

                <button class="auth-submit" type="submit">Sign in <i class="fas fa-arrow-right" aria-hidden="true"></i></button>
            </form>

            <p class="auth-register-prompt">New to Genesis Block? <a href="{{ route('register') }}">Create an account</a></p>
        </div>
    </section>
</main>
