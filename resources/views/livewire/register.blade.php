<main class="auth-page">
    <section class="container auth-layout register-layout" aria-labelledby="register-title">
        <div class="auth-intro">
            <p class="auth-eyebrow">GENESIS BLOCK <span>/</span> GET STARTED</p>
            <div>
                <h1 id="register-title">A thoughtful start.</h1>
                <p>Create an account to keep your learning and resources together in one place.</p>
            </div>
            <p class="auth-note">Learn at your own pace. Explore with context.</p>
        </div>

        <div class="auth-form-panel">
            <div class="auth-form-heading">
                <p class="auth-eyebrow">ACCOUNT DETAILS</p>
                <h2>Create your account</h2>
                <p>Enter your details to get started.</p>
            </div>

            <a class="auth-google-button" href="{{ route('auth.google.redirect') }}">
                <i class="fab fa-google" aria-hidden="true"></i>
                <span>Continue with Google</span>
            </a>
            <div class="auth-divider" aria-hidden="true"><span>or create an account with email</span></div>

            @if ($errors->any())
                <div class="auth-error-summary" role="alert">{{ $errors->first() }}</div>
            @endif
            <div class="auth-error-summary" id="registration-error" role="alert" hidden></div>

            <form wire:submit.prevent="register" class="auth-form register-form">
                <div class="register-fields">
                    <div class="auth-field">
                        <label for="firstName">First name</label>
                        <input id="firstName" type="text" wire:model.blur="firstName" autocomplete="given-name"
                            placeholder="First name" required>
                        @error('firstName') <span class="auth-field-error">{{ $message }}</span> @enderror
                    </div>

                    <div class="auth-field">
                        <label for="lastName">Last name</label>
                        <input id="lastName" type="text" wire:model.blur="lastName" autocomplete="family-name"
                            placeholder="Last name" required>
                        @error('lastName') <span class="auth-field-error">{{ $message }}</span> @enderror
                    </div>

                    <div class="auth-field">
                        <label for="email">Email address</label>
                        <input id="email" type="email" wire:model.blur="email" autocomplete="email"
                            inputmode="email" placeholder="you@example.com" required>
                        @error('email') <span class="auth-field-error">{{ $message }}</span> @enderror
                    </div>

                    <div class="auth-field">
                        <label for="phoneNumber">Phone number <span class="auth-optional">Optional</span></label>
                        <input id="phoneNumber" type="tel" wire:model.blur="phoneNumber" autocomplete="tel"
                            inputmode="tel" placeholder="Your phone number">
                        @error('phoneNumber') <span class="auth-field-error">{{ $message }}</span> @enderror
                    </div>

                    <div class="auth-field">
                        <label for="password">Password</label>
                        <div class="auth-password-wrap">
                            <input id="password" type="password" wire:model="password" autocomplete="new-password"
                                placeholder="At least 8 characters" required>
                            <button class="auth-password-toggle" type="button" data-password-toggle="password"
                                aria-label="Show password" title="Show password"><i class="fas fa-eye" aria-hidden="true"></i></button>
                        </div>
                        @error('password') <span class="auth-field-error">{{ $message }}</span> @enderror
                    </div>

                    <div class="auth-field">
                        <label for="password_confirmation">Confirm password</label>
                        <div class="auth-password-wrap">
                            <input id="password_confirmation" type="password" wire:model="password_confirmation"
                                autocomplete="new-password" placeholder="Re-enter your password" required>
                            <button class="auth-password-toggle" type="button" data-password-toggle="password_confirmation"
                                aria-label="Show password" title="Show password"><i class="fas fa-eye" aria-hidden="true"></i></button>
                        </div>
                    </div>
                </div>

                <button class="auth-submit" type="submit" wire:loading.attr="disabled" wire:target="register">
                    <span wire:loading.remove wire:target="register">Create account</span>
                    <span wire:loading wire:target="register">Creating account...</span>
                    <i class="fas fa-arrow-right" aria-hidden="true"></i>
                </button>
            </form>

            <p class="auth-register-prompt">Already have an account? <a href="{{ route('login') }}">Sign in</a></p>
        </div>
    </section>
</main>

@script
    <script>
        document.querySelectorAll('[data-password-toggle]').forEach((button) => {
            button.addEventListener('click', () => {
                const input = document.getElementById(button.dataset.passwordToggle);
                const showingPassword = input.type === 'password';

                input.type = showingPassword ? 'text' : 'password';
                button.setAttribute('aria-label', showingPassword ? 'Hide password' : 'Show password');
                button.setAttribute('title', showingPassword ? 'Hide password' : 'Show password');
                button.innerHTML = `<i class="fas ${showingPassword ? 'fa-eye-slash' : 'fa-eye'}" aria-hidden="true"></i>`;
            });
        });

        $wire.on('registration-error', (event) => {
            const message = document.getElementById('registration-error');
            message.textContent = event.detail.message;
            message.hidden = false;
        });
    </script>
@endscript
