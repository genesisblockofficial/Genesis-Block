<main class="auth-page">
    <section class="container auth-layout" aria-labelledby="reset-password-title">
        <div class="auth-intro">
            <p class="auth-eyebrow">GENESIS BLOCK <span>/</span> ACCOUNT ACCESS</p>
            <div>
                <h1>Choose a new password.</h1>
                <p>Set a new password to secure your Genesis Block account.</p>
            </div>
            <p class="auth-note">Use a password you do not use on other sites.</p>
        </div>

        <div class="auth-form-panel">
            <div class="auth-form-heading">
                <p class="auth-eyebrow">ACCOUNT RECOVERY</p>
                <h2 id="reset-password-title">Reset password</h2>
                <p>Enter your email and choose a new password.</p>
            </div>

            @if ($errors->any())
                <div class="auth-error-summary" role="alert">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('password.update') }}" class="auth-form">
                @csrf
                <input type="hidden" name="token" value="{{ $token ?? request()->route('token') }}">

                <div class="auth-field">
                    <label for="email">Email address</label>
                    <input id="email" name="email" type="email" value="{{ old('email', request()->query('email')) }}"
                        autocomplete="email" inputmode="email" required autofocus>
                </div>

                <div class="auth-field">
                    <label for="password">New password</label>
                    <input id="password" name="password" type="password" autocomplete="new-password" required>
                </div>

                <div class="auth-field">
                    <label for="password_confirmation">Confirm new password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required>
                </div>

                <button class="auth-submit" type="submit">Save new password <i class="fas fa-arrow-right" aria-hidden="true"></i></button>
            </form>

            <p class="auth-register-prompt"><a href="{{ route('login') }}">Back to sign in</a></p>
        </div>
    </section>
</main>
