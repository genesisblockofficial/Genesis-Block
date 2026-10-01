<main class="auth-page">
    <section class="container auth-layout" aria-labelledby="forgot-password-title">
        <div class="auth-intro">
            <p class="auth-eyebrow">GENESIS BLOCK <span>/</span> ACCOUNT ACCESS</p>
            <div>
                <h1 id="forgot-password-title">Reset your password.</h1>
                <p>Enter the email address linked to your account and we will send you a password reset link.</p>
            </div>
            <p class="auth-note">Your account stays secure while you get back in.</p>
        </div>

        <div class="auth-form-panel">
            <div class="auth-form-heading">
                <p class="auth-eyebrow">ACCOUNT RECOVERY</p>
                <h2>Forgot password?</h2>
                <p>We will email you a secure link to choose a new password.</p>
            </div>

            @if (session('status'))
                <div class="auth-status" role="status">{{ session('status') }}</div>
            @endif

            @if ($errors->any())
                <div class="auth-error-summary" role="alert">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" class="auth-form">
                @csrf

                <div class="auth-field">
                    <label for="email">Email address</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}"
                        autocomplete="email" inputmode="email" placeholder="you@example.com" required autofocus>
                </div>

                <button class="auth-submit" type="submit">Send reset link <i class="fas fa-arrow-right" aria-hidden="true"></i></button>
            </form>

            <p class="auth-register-prompt"><a href="{{ route('login') }}">Back to sign in</a></p>
        </div>
    </section>
</main>
