    <!-- Login Container -->
    <div class="login-container">
        <div class="login-card">
            <!-- Logo -->
            <div class="logo-container">
                <div class="logo">Genesis Block</div>
                <div class="logo-tagline">Secure Digital Asset Trading</div>
            </div>

            <!-- Login Form -->
            <form id="loginForm">
                <!-- Email -->
                <div class="form-group">
                    <label class="form-label" for="email">
                        <i class="fas fa-envelope me-2"></i>Email Address
                    </label>
                    <div class="input-group">
                        <i class="fas fa-user input-icon"></i>
                        <input type="email" id="email" class="form-control" placeholder="Enter your email"
                            required>
                    </div>
                    <div class="error-message" id="emailError">Please enter a valid email address</div>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label class="form-label" for="password">
                        <i class="fas fa-lock me-2"></i>Password
                    </label>
                    <div class="input-group">
                        <i class="fas fa-key input-icon"></i>
                        <input type="password" id="password" class="form-control" placeholder="Enter your password"
                            required>
                        <button type="button" class="password-toggle" id="togglePassword">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <div class="error-message" id="passwordError">Password must be at least 8 characters</div>
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="remember-forgot">
                    <div class="remember-me" id="rememberMe">
                        <div class="checkbox"></div>
                        <span>Remember me</span>
                    </div>
                    <a href="#" class="forgot-link">Forgot Password?</a>
                </div>

                <!-- Login Button -->
                <button type="submit" class="btn-login" id="loginBtn">
                    <span id="btnText">Sign In</span>
                    <div class="loading-spinner" id="loadingSpinner"></div>
                    <div class="success-check" id="successCheck">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </button>

                <!-- Divider -->
                <div class="divider">
                    <span class="divider-text">Or Continue With</span>
                </div>

                <!-- Social Login -->
                <div class="social-login">
                    <button type="button" class="btn-social">
                        <i class="fab fa-google social-icon google"></i>
                        <span>Google</span>
                    </button>
                    <button type="button" class="btn-social">
                        <i class="fab fa-apple social-icon apple"></i>
                        <span>Apple</span>
                    </button>
                </div>

                <!-- Sign Up Link -->
                <div class="signup-link">
                    Don't have an account?
                    <a href="{{ route('register') }}">Create Account</a>
                </div>
            </form>

            <!-- Security Indicators -->
            <div class="security-indicators">
                <div class="security-item">
                    <i class="fas fa-shield-alt security-icon"></i>
                    <span>256-bit Encryption</span>
                </div>
                <div class="security-item">
                    <i class="fas fa-lock security-icon"></i>
                    <span>2FA Ready</span>
                </div>
            </div>
        </div>
    </div>
