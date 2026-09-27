    <!-- Registration Container -->
    <div class="register-container">
        <div class="register-card">
            <!-- Logo -->
            <div class="logo-container">
                <div class="logo">Genesis Block</div>
                <div class="logo-tagline">Create Your Trading Account</div>
            </div>

            <!-- Progress Steps -->
            <div class="progress-steps">
                <div class="step active">
                    <div class="step-circle">1</div>
                    <div class="step-label">Details</div>
                </div>
                <div class="step">
                    <div class="step-circle">2</div>
                    <div class="step-label">Security</div>
                </div>
                <div class="step">
                    <div class="step-circle">3</div>
                    <div class="step-label">Complete</div>
                </div>
            </div>

            <!-- Registration Form -->
            <form wire:submit.prevent="register" id="registerForm">
                <!-- Name Row -->
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="firstName">
                            <i class="fas fa-user me-2"></i>First Name*
                        </label>
                        <div class="input-group">
                            <i class="fas fa-user-circle input-icon"></i>
                            <input type="text" id="firstName" wire:model="firstName" class="form-control"
                                placeholder="Enter first name">
                        </div>
                        @error('firstName')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="lastName">
                            <i class="fas fa-user me-2"></i>Last Name*
                        </label>
                        <div class="input-group">
                            <i class="fas fa-user-circle input-icon"></i>
                            <input type="text" id="lastName" wire:model="lastName" class="form-control"
                                placeholder="Enter last name">
                        </div>
                        @error('lastName')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <!-- Email -->
                    <div class="form-group">
                        <label class="form-label" for="email">
                            <i class="fas fa-envelope me-2"></i>Email Address*
                        </label>
                        <div class="input-group">
                            <i class="fas fa-envelope input-icon"></i>
                            <input type="email" id="email" wire:model="email" class="form-control"
                                placeholder="Enter your email">
                        </div>
                        @error('email')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                        @if (!$errors->has('email') && $email)
                            <div class="success-message">✓ Email available</div>
                        @endif
                    </div>

                    <!-- Phone Number -->
                    <div class="form-group">
                        <label class="form-label" for="phoneNumber">
                            <i class="fas fa-phone me-2"></i>Phone Number
                        </label>
                        <div class="input-group">
                            <i class="fas fa-phone input-icon"></i>
                            <input type="tel" id="phoneNumber" wire:model="phoneNumber" class="form-control"
                                placeholder="+1 (123) 456-7890">
                        </div>
                        @error('phoneNumber')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <!-- Password -->
                    <div class="form-group">
                        <label class="form-label" for="password">
                            <i class="fas fa-lock me-2"></i>Password*
                        </label>
                        <div class="input-group">
                            <i class="fas fa-key input-icon"></i>
                            <input type="password" id="password" wire:model="password" class="form-control"
                                placeholder="Create a strong password">
                            <button type="button" class="password-toggle" id="togglePassword">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <div class="password-strength">
                            <div class="strength-bar">
                                <div class="strength-fill" id="strengthFill"></div>
                            </div>
                            <div class="strength-text" id="strengthText">Password strength</div>
                        </div>
                        @error('password')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-group">
                        <label class="form-label" for="password_confirmation">
                            <i class="fas fa-lock me-2"></i>Confirm Password*
                        </label>
                        <div class="input-group">
                            <i class="fas fa-key input-icon"></i>
                            <input type="password" id="password_confirmation" wire:model="password_confirmation"
                                class="form-control" placeholder="Re-enter your password">
                            <button type="button" class="password-toggle" id="toggleConfirmPassword">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        @if ($password && $password_confirmation && $password === $password_confirmation)
                            <div class="password-match" id="passwordMatch">
                                <span class="match-icon"><i class="fas fa-check-circle"></i></span>
                                <span class="match-text">Passwords match</span>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Terms & Conditions -->
                <div class="terms-container">
                    <div class="terms-checkbox">
                        <input type="checkbox" id="terms" required>
                        <label for="terms">
                            I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy
                                Policy</a>. I understand that cryptocurrency trading involves risk and I am responsible
                            for my investment decisions.
                        </label>
                    </div>
                </div>

                <!-- Register Button -->
                <button type="submit" class="btn-register" id="registerBtn">
                    <span id="btnText">Create Account</span>
                    <div class="loading-spinner" id="loadingSpinner"></div>
                </button>

                <!-- Login Link -->
                <div class="login-link">
                    Already have an account?
                    <a href="{{ route('login') }}" id="loginLink">Sign In</a>
                </div>
            </form>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Security Indicators -->
            <div class="security-indicators">
                <div class="security-item">
                    <i class="fas fa-shield-alt security-icon"></i>
                    <span>256-bit Encryption</span>
                </div>
                <div class="security-item">
                    <i class="fas fa-lock security-icon"></i>
                    <span>2FA Enabled</span>
                </div>
                <div class="security-item">
                    <i class="fas fa-user-shield security-icon"></i>
                    <span>KYC Ready</span>
                </div>
            </div>
        </div>
    </div>
