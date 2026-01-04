<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CryptoTrade Pro | Register</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <style>
        :root {
            --primary-bg: #0a0e17;
            --secondary-bg: #111827;
            --accent-green: #00ff88;
            --accent-blue: #00a3ff;
            --accent-purple: #8b5cf6;
            --accent-orange: #ff6b35;
            --text-primary: #ffffff;
            --text-secondary: #94a3b8;
            --card-bg: rgba(30, 41, 59, 0.8);
            --border-color: rgba(255, 255, 255, 0.1);
            --glow: 0 0 20px rgba(0, 255, 136, 0.3);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--primary-bg);
            color: var(--text-primary);
            min-height: 100vh;
            overflow-x: hidden;
            position: relative;
        }

        /* Animated Background */
        .bg-animation {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }

        .bg-grid {
            position: absolute;
            width: 200%;
            height: 200%;
            background-image:
                linear-gradient(rgba(0, 163, 255, 0.05) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 163, 255, 0.05) 1px, transparent 1px);
            background-size: 50px 50px;
            animation: gridMove 20s linear infinite;
        }

        @keyframes gridMove {
            0% {
                transform: translate(0, 0);
            }

            100% {
                transform: translate(-50px, -50px);
            }
        }

        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
        }

        .shape {
            position: absolute;
            border-radius: 50%;
            filter: blur(40px);
            opacity: 0.15;
        }

        .shape-1 {
            width: 300px;
            height: 300px;
            background: var(--accent-blue);
            top: 10%;
            left: 10%;
            animation: float 25s infinite linear;
        }

        .shape-2 {
            width: 200px;
            height: 200px;
            background: var(--accent-purple);
            top: 60%;
            right: 15%;
            animation: float 20s infinite linear reverse;
        }

        .shape-3 {
            width: 250px;
            height: 250px;
            background: var(--accent-orange);
            bottom: 10%;
            left: 20%;
            animation: float 30s infinite linear;
        }

        @keyframes float {

            0%,
            100% {
                transform: translate(0, 0) rotate(0deg);
            }

            25% {
                transform: translate(50px, -50px) rotate(90deg);
            }

            50% {
                transform: translate(0, -100px) rotate(180deg);
            }

            75% {
                transform: translate(-50px, -50px) rotate(270deg);
            }
        }

        /* Registration Container */
        .register-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            margin: 50px 0px;
            position: relative;
            z-index: 1;
        }

        .register-card {
            background: var(--card-bg);
            backdrop-filter: blur(20px);
            border: 1px solid var(--border-color);
            border-radius: 24px;
            padding: 40px;
            width: 100%;
            max-width: 900px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 163, 255, 0.3);
            transition: all 0.3s ease;
        }

        .register-card:hover {
            box-shadow: 0 0 40px rgba(0, 163, 255, 0.5);
            transform: translateY(-5px);
        }

        .register-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--accent-blue), var(--accent-purple));
        }

        /* Logo */
        .logo-container {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo {
            font-size: 2.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--accent-blue), var(--accent-purple));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 10px;
            display: inline-block;
        }

        .logo-tagline {
            color: var(--text-secondary);
            font-size: 0.9rem;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        /* Progress Steps */
        .progress-steps {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            position: relative;
        }

        .progress-steps::before {
            content: '';
            position: absolute;
            top: 15px;
            left: 20px;
            right: 20px;
            height: 2px;
            background: var(--border-color);
            z-index: 1;
        }

        .step {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            z-index: 2;
        }

        .step-circle {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: var(--secondary-bg);
            border: 2px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-secondary);
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 8px;
            transition: all 0.3s ease;
        }

        .step.active .step-circle {
            background: var(--accent-blue);
            border-color: var(--accent-blue);
            color: white;
            box-shadow: 0 0 10px rgba(0, 163, 255, 0.5);
        }

        .step.completed .step-circle {
            background: var(--accent-green);
            border-color: var(--accent-green);
            color: white;
        }

        .step.completed .step-circle::after {
            content: '✓';
        }

        .step-label {
            font-size: 0.8rem;
            color: var(--text-secondary);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .step.active .step-label {
            color: var(--accent-blue);
            font-weight: 600;
        }

        .step.completed .step-label {
            color: var(--accent-green);
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            color: var(--text-secondary);
            font-weight: 500;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .form-label .optional {
            color: var(--text-secondary);
            opacity: 0.7;
            font-size: 0.8rem;
            text-transform: none;
        }

        .input-group {
            position: relative;
        }

        .form-control {
            width: 100%;
            padding: 16px 20px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            color: var(--text-primary);
            font-size: 1rem;
            transition: all 0.3s ease;
            padding-left: 50px;
        }

        .form-control::placeholder {
            color: var(--text-secondary);
            opacity: 1;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--accent-blue);
            box-shadow: 0 0 0 3px rgba(0, 163, 255, 0.1);
            background: rgba(255, 255, 255, 0.08);
        }

        .input-icon {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-secondary);
            font-size: 1.2rem;
            z-index: 2;
        }

        .password-toggle {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--text-secondary);
            cursor: pointer;
            z-index: 2;
            transition: color 0.3s ease;
        }

        .password-toggle:hover {
            color: var(--accent-blue);
        }

        /* Password Strength Indicator */
        .password-strength {
            margin-top: 8px;
        }

        .strength-bar {
            height: 4px;
            background: var(--border-color);
            border-radius: 2px;
            overflow: hidden;
            margin-bottom: 5px;
        }

        .strength-fill {
            height: 100%;
            width: 0%;
            transition: all 0.3s ease;
            border-radius: 2px;
        }

        .strength-text {
            font-size: 0.8rem;
            color: var(--text-secondary);
        }

        /* Terms & Conditions */
        .terms-container {
            margin: 25px 0;
            padding: 20px;
            background: rgba(255, 255, 255, 0.03);
            border-radius: 12px;
            border: 1px solid var(--border-color);
        }

        .terms-checkbox {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            cursor: pointer;
        }

        .terms-checkbox input[type="checkbox"] {
            margin-top: 3px;
            accent-color: var(--accent-blue);
        }

        .terms-checkbox label {
            color: var(--text-secondary);
            font-size: 0.9rem;
            line-height: 1.5;
            cursor: pointer;
        }

        .terms-checkbox a {
            color: var(--accent-blue);
            text-decoration: none;
        }

        .terms-checkbox a:hover {
            text-decoration: underline;
        }

        /* Buttons */
        .btn-register {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, var(--accent-blue), var(--accent-purple));
            border: none;
            border-radius: 12px;
            color: white;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-register::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .btn-register:hover::before {
            left: 100%;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 163, 255, 0.3);
        }

        .btn-register:active {
            transform: translateY(0);
        }

        /* Login Link */
        .login-link {
            text-align: center;
            margin-top: 25px;
            color: var(--text-secondary);
            font-size: 0.95rem;
        }

        .login-link a {
            color: var(--accent-green);
            text-decoration: none;
            font-weight: 600;
            margin-left: 5px;
            transition: color 0.3s ease;
        }

        .login-link a:hover {
            color: var(--accent-blue);
            text-decoration: underline;
        }

        /* Live Market Preview */
        .market-preview {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(15, 23, 42, 0.95);
            backdrop-filter: blur(10px);
            border-top: 1px solid var(--border-color);
            padding: 15px 0;
            z-index: 2;
            overflow: hidden;
        }

        .market-ticker {
            display: flex;
            gap: 40px;
            width: max-content;
            animation: ticker 40s linear infinite;
        }

        .market-item {
            display: flex;
            align-items: center;
            gap: 10px;
            white-space: nowrap;
        }

        .market-symbol {
            font-weight: 700;
            color: var(--accent-blue);
        }

        .market-price {
            font-weight: 600;
        }

        .market-change {
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 0.85rem;
        }

        .positive {
            color: #00ff88;
            background: rgba(0, 255, 136, 0.1);
        }

        .negative {
            color: #ff4757;
            background: rgba(255, 71, 87, 0.1);
        }

        @keyframes ticker {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        /* Security Indicators */
        .security-indicators {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid var(--border-color);
        }

        .security-item {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--text-secondary);
            font-size: 0.85rem;
        }

        .security-icon {
            color: var(--accent-blue);
            font-size: 0.9rem;
        }

        /* Form Validation */
        .form-control.error {
            border-color: #ff4757;
            animation: shake 0.5s ease-in-out;
        }

        .error-message {
            color: #ff4757;
            font-size: 0.85rem;
            margin-top: 5px;
            display: none;
        }

        .success-message {
            color: #00ff88;
            font-size: 0.85rem;
            margin-top: 5px;
            display: none;
        }

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            25% {
                transform: translateX(-5px);
            }

            75% {
                transform: translateX(5px);
            }
        }

        /* Loading Animation */
        .loading-spinner {
            display: none;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: var(--accent-blue);
            animation: spin 1s linear infinite;
            margin: 0 auto;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .register-card {
                padding: 30px 20px;
                margin: 20px;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 0;
            }

            .shape {
                display: none;
            }
        }

        @media (max-width: 576px) {
            .register-card {
                padding: 25px 15px;
            }

            .progress-steps::before {
                left: 15px;
                right: 15px;
            }
        }

        /* Password Match Indicator */
        .password-match {
            display: flex;
            align-items: center;
            gap: 5px;
            margin-top: 5px;
            font-size: 0.85rem;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .password-match.show {
            opacity: 1;
        }

        .match-icon {
            font-size: 0.8rem;
        }

        .match-icon.match {
            color: #00ff88;
        }

        .match-icon.mismatch {
            color: #ff4757;
        }
    </style>
</head>

<body>
    <!-- Animated Background -->
    <div class="bg-animation">
        <div class="bg-grid"></div>
        <div class="floating-shapes">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
        </div>
    </div>

    {{ $slot }}

    <!-- Live Market Ticker -->
    <div class="market-preview">
        <div class="market-ticker" id="marketTicker">
            <!-- Ticker items will be populated by JavaScript -->
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Initialize when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            // Password toggle functionality
            const togglePassword = document.getElementById('togglePassword');
            const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById('password_confirmation');

            if (togglePassword && passwordInput) {
                togglePassword.addEventListener('click', function() {
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);
                    this.querySelector('i').classList.toggle('fa-eye');
                    this.querySelector('i').classList.toggle('fa-eye-slash');
                });
            }

            if (toggleConfirmPassword && confirmPasswordInput) {
                toggleConfirmPassword.addEventListener('click', function() {
                    const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' :
                        'password';
                    confirmPasswordInput.setAttribute('type', type);
                    this.querySelector('i').classList.toggle('fa-eye');
                    this.querySelector('i').classList.toggle('fa-eye-slash');
                });
            }

            // Password strength indicator
            if (passwordInput) {
                passwordInput.addEventListener('input', function() {
                    const password = this.value;
                    const strengthBar = document.getElementById('strengthFill');
                    const strengthText = document.getElementById('strengthText');

                    let strength = 0;

                    if (password.length >= 8) strength++;
                    if (/[A-Z]/.test(password)) strength++;
                    if (/[a-z]/.test(password)) strength++;
                    if (/[0-9]/.test(password)) strength++;
                    if (/[^A-Za-z0-9]/.test(password)) strength++;

                    const colors = ['#ff4d4d', '#ff944d', '#ffcc00', '#99cc33', '#33cc33'];
                    const texts = ['Very Weak', 'Weak', 'Fair', 'Good', 'Strong'];

                    strengthBar.style.width = (strength * 20) + '%';
                    strengthBar.style.backgroundColor = colors[strength - 1] || colors[0];
                    strengthText.textContent = texts[strength - 1] || 'Very Weak';
                });
            }

            // Form submission loading state
            const registerForm = document.getElementById('registerForm');
            const registerBtn = document.getElementById('registerBtn');
            const btnText = document.getElementById('btnText');
            const loadingSpinner = document.getElementById('loadingSpinner');

            if (registerForm) {
                registerForm.addEventListener('submit', function() {
                    btnText.textContent = 'Creating Account...';
                    loadingSpinner.style.display = 'block';
                    registerBtn.disabled = true;
                });
            }


            // Add hover effect to register card
            const registerCard = document.querySelector('.register-card');
            registerCard.addEventListener('mouseenter', () => {
                registerCard.style.transform = 'translateY(-10px) scale(1.02)';
            });

            registerCard.addEventListener('mouseleave', () => {
                registerCard.style.transform = 'translateY(-5px) scale(1)';
            });

            // Input focus effects
            const inputs = document.querySelectorAll('.form-control');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.style.transform = 'translateY(-2px)';
                });

                input.addEventListener('blur', function() {
                    this.parentElement.style.transform = 'translateY(0)';
                });
            });
        });

        // Listen for Livewire events
        window.addEventListener('registration-success', (event) => {
            // Reset button state
            const btnText = document.getElementById('btnText');
            const loadingSpinner = document.getElementById('loadingSpinner');
            const registerBtn = document.getElementById('registerBtn');

            if (btnText) btnText.textContent = 'Create Account';
            if (loadingSpinner) loadingSpinner.style.display = 'none';
            if (registerBtn) registerBtn.disabled = false;

            // Show SweetAlert2 success message
            Swal.fire({
                icon: 'success',
                title: 'Registration Successful!',
                text: event.detail.message,
                confirmButtonText: 'OK',
                confirmButtonColor: '#3085d6',
                allowOutsideClick: false,
                allowEscapeKey: false,
                timer: 5000,
                timerProgressBar: true,
                willClose: () => {
                    // Redirect to login page
                    window.location.href = event.detail.redirectUrl;
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect to login page when OK is clicked
                    window.location.href = event.detail.redirectUrl;
                }
            });
        });

        window.addEventListener('registration-error', (event) => {
            // Reset button state
            const btnText = document.getElementById('btnText');
            const loadingSpinner = document.getElementById('loadingSpinner');
            const registerBtn = document.getElementById('registerBtn');

            if (btnText) btnText.textContent = 'Create Account';
            if (loadingSpinner) loadingSpinner.style.display = 'none';
            if (registerBtn) registerBtn.disabled = false;

            // Show SweetAlert2 error message
            Swal.fire({
                icon: 'error',
                title: 'Registration Failed',
                text: event.detail.message,
                confirmButtonText: 'Try Again',
                confirmButtonColor: '#d33',
            });
        });
    </script>
</body>

</html>
