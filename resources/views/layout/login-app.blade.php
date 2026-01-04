<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CryptoTrade Pro | Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --primary-bg: #0a0e17;
            --secondary-bg: #111827;
            --accent-green: #00ff88;
            --accent-blue: #00a3ff;
            --accent-purple: #8b5cf6;
            --text-primary: #ffffff;
            --text-secondary: #94a3b8;
            --card-bg: rgba(30, 41, 59, 0.7);
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
                linear-gradient(rgba(0, 255, 136, 0.05) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 255, 136, 0.05) 1px, transparent 1px);
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
            background: var(--accent-green);
            top: 10%;
            left: 10%;
            animation: float 25s infinite linear;
        }

        .shape-2 {
            width: 200px;
            height: 200px;
            background: var(--accent-blue);
            top: 60%;
            right: 15%;
            animation: float 20s infinite linear reverse;
        }

        .shape-3 {
            width: 250px;
            height: 250px;
            background: var(--accent-purple);
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

        /* Login Container */
        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            z-index: 1;
        }

        .login-card {
            background: var(--card-bg);
            backdrop-filter: blur(20px);
            border: 1px solid var(--border-color);
            border-radius: 24px;
            padding: 40px;
            width: 100%;
            margin: 50px 0px;
            max-width: 450px;
            position: relative;
            overflow: hidden;
            box-shadow: var(--glow);
            transition: all 0.3s ease;
        }

        .login-card:hover {
            box-shadow: 0 0 40px rgba(0, 255, 136, 0.5);
            transform: translateY(-5px);
        }

        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--accent-green), var(--accent-blue));
        }

        /* Logo */
        .logo-container {
            text-align: center;
            margin-bottom: 40px;
        }

        .logo {
            font-size: 2.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--accent-green), var(--accent-blue));
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

        /* Form Styles */
        .form-group {
            margin-bottom: 25px;
            position: relative;
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
            border-color: var(--accent-green);
            box-shadow: 0 0 0 3px rgba(0, 255, 136, 0.1);
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
            color: var(--accent-green);
        }

        /* Remember & Forgot */
        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }

        .checkbox {
            width: 18px;
            height: 18px;
            border: 2px solid var(--border-color);
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .checkbox.checked {
            background: var(--accent-green);
            border-color: var(--accent-green);
        }

        .checkbox.checked::after {
            content: '✓';
            color: white;
            font-size: 12px;
            font-weight: bold;
        }

        .forgot-link {
            color: var(--accent-blue);
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s ease;
        }

        .forgot-link:hover {
            color: var(--accent-green);
            text-decoration: underline;
        }

        /* Buttons */
        .btn-login {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, var(--accent-green), var(--accent-blue));
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

        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .btn-login:hover::before {
            left: 100%;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 255, 136, 0.3);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        /* Divider */
        .divider {
            display: flex;
            align-items: center;
            margin: 30px 0;
            color: var(--text-secondary);
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--border-color);
        }

        .divider-text {
            padding: 0 15px;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        /* Social Login */
        .social-login {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-bottom: 30px;
        }

        .btn-social {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 14px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            color: var(--text-primary);
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-social:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: var(--accent-green);
            transform: translateY(-2px);
        }

        .social-icon {
            font-size: 1.2rem;
        }

        .google {
            color: #ea4335;
        }

        .apple {
            color: #a2aaad;
        }

        /* Sign Up Link */
        .signup-link {
            text-align: center;
            color: var(--text-secondary);
            font-size: 0.95rem;
        }

        .signup-link a {
            color: var(--accent-blue);
            text-decoration: none;
            font-weight: 600;
            margin-left: 5px;
            transition: color 0.3s ease;
        }

        .signup-link a:hover {
            color: var(--accent-green);
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
            color: var(--accent-green);
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

        /* Hide overflow to prevent duplicate visibility */
        .market-preview {
            overflow: hidden;
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
            color: var(--accent-green);
            font-size: 0.9rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .login-card {
                padding: 30px 20px;
                margin: 20px;
            }

            .social-login {
                grid-template-columns: 1fr;
            }

            .shape {
                display: none;
            }
        }

        @media (max-width: 576px) {
            .remember-forgot {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }

            .login-card {
                padding: 25px 15px;
            }
        }

        /* Loading Animation */
        .loading-spinner {
            display: none;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: var(--accent-green);
            animation: spin 1s linear infinite;
            margin: 0 auto;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
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

        /* Success Animation */
        .success-check {
            display: none;
            font-size: 3rem;
            color: var(--accent-green);
            text-align: center;
            animation: bounceIn 0.6s ease;
        }

        @keyframes bounceIn {
            0% {
                transform: scale(0);
                opacity: 0;
            }

            50% {
                transform: scale(1.2);
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
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

    <!-- Login Container -->
    {{ $slot }}

    <!-- Live Market Ticker -->
    <div class="market-preview">
        <div class="market-ticker" id="marketTicker">
            <!-- Ticker items will be populated by JavaScript -->
        </div>
    </div>

    <script>
        // Initialize when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            // Elements
            const loginForm = document.getElementById('loginForm');
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            const togglePassword = document.getElementById('togglePassword');
            const rememberMe = document.getElementById('rememberMe');
            const loginBtn = document.getElementById('loginBtn');
            const btnText = document.getElementById('btnText');
            const loadingSpinner = document.getElementById('loadingSpinner');
            const successCheck = document.getElementById('successCheck');
            const marketTicker = document.getElementById('marketTicker');

            // Password visibility toggle
            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                this.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' :
                    '<i class="fas fa-eye-slash"></i>';
            });

            // Remember me checkbox
            rememberMe.addEventListener('click', function() {
                const checkbox = this.querySelector('.checkbox');
                checkbox.classList.toggle('checked');

                // Save preference
                const isChecked = checkbox.classList.contains('checked');
                localStorage.setItem('rememberMe', isChecked);

                // If checked and email exists, save email
                if (isChecked && emailInput.value) {
                    localStorage.setItem('savedEmail', emailInput.value);
                }
            });

            // Load saved email if remember me was checked
            if (localStorage.getItem('rememberMe') === 'true') {
                rememberMe.querySelector('.checkbox').classList.add('checked');
                const savedEmail = localStorage.getItem('savedEmail');
                if (savedEmail) {
                    emailInput.value = savedEmail;
                }
            }

            // Form validation
            function validateEmail(email) {
                const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return re.test(email);
            }

            function validatePassword(password) {
                return password.length >= 8;
            }

            // Form submission
            loginForm.addEventListener('submit', async function(e) {
                e.preventDefault();

                const email = emailInput.value.trim();
                const password = passwordInput.value;

                // Reset errors
                document.querySelectorAll('.error-message').forEach(el => el.style.display = 'none');
                emailInput.classList.remove('error');
                passwordInput.classList.remove('error');

                // Validate
                let isValid = true;

                if (!validateEmail(email)) {
                    document.getElementById('emailError').style.display = 'block';
                    emailInput.classList.add('error');
                    isValid = false;
                }

                if (!validatePassword(password)) {
                    document.getElementById('passwordError').style.display = 'block';
                    passwordInput.classList.add('error');
                    isValid = false;
                }

                if (!isValid) return;

                // Show loading state
                btnText.style.display = 'none';
                loadingSpinner.style.display = 'block';
                loginBtn.disabled = true;

                // Simulate API call
                setTimeout(() => {
                    // Hide loading, show success
                    loadingSpinner.style.display = 'none';
                    successCheck.style.display = 'block';

                    // Redirect after success animation
                    setTimeout(() => {
                        // In production, redirect to dashboard
                        // window.location.href = 'dashboard.html';

                        // For demo, reset form
                        successCheck.style.display = 'none';
                        btnText.style.display = 'block';
                        loginBtn.disabled = false;

                        // Show success message
                        alert('Login successful! Redirecting to dashboard...');
                        loginForm.reset();
                    }, 1000);
                }, 2000);
            });

            // Live market ticker simulation
            // Updated function to prevent duplicate ticker
            function createMarketTicker() {
                const symbols = [{
                        symbol: 'BTC',
                        name: 'Bitcoin',
                        price: 45231.50,
                        change: 2.34
                    },
                    {
                        symbol: 'ETH',
                        name: 'Ethereum',
                        price: 2380.75,
                        change: 1.56
                    },
                    {
                        symbol: 'BNB',
                        name: 'Binance Coin',
                        price: 312.20,
                        change: -0.45
                    },
                    {
                        symbol: 'XRP',
                        name: 'Ripple',
                        price: 0.6234,
                        change: 3.21
                    },
                    {
                        symbol: 'SOL',
                        name: 'Solana',
                        price: 98.45,
                        change: 5.67
                    },
                    {
                        symbol: 'ADA',
                        name: 'Cardano',
                        price: 0.5123,
                        change: 1.23
                    },
                    {
                        symbol: 'DOT',
                        name: 'Polkadot',
                        price: 7.89,
                        change: -0.78
                    },
                    {
                        symbol: 'DOGE',
                        name: 'Dogecoin',
                        price: 0.098,
                        change: 4.56
                    },
                    {
                        symbol: 'XAU',
                        name: 'Gold',
                        price: 2035.60,
                        change: 0.89
                    },
                    {
                        symbol: 'EUR/USD',
                        name: 'Euro',
                        price: 1.0850,
                        change: -0.12
                    },
                    {
                        symbol: 'GBP/USD',
                        name: 'Pound',
                        price: 1.2650,
                        change: 0.34
                    },
                    {
                        symbol: 'USD/JPY',
                        name: 'Yen',
                        price: 148.50,
                        change: 0.23
                    }
                ];

                // Clear existing items
                marketTicker.innerHTML = '';

                // Double the items for seamless animation
                const doubledSymbols = [...symbols, ...symbols];

                // Create ticker items
                doubledSymbols.forEach(item => {
                    const tickerItem = document.createElement('div');
                    tickerItem.className = 'market-item';

                    const changeClass = item.change >= 0 ? 'positive' : 'negative';
                    const sign = item.change >= 0 ? '+' : '';

                    // Format price based on asset type
                    let formattedPrice;
                    if (item.symbol === 'EUR/USD' || item.symbol === 'GBP/USD') {
                        formattedPrice = item.price.toFixed(4);
                    } else if (item.symbol === 'USD/JPY') {
                        formattedPrice = item.price.toFixed(2);
                    } else if (item.symbol === 'XAU') {
                        formattedPrice = `$${item.price.toFixed(2)}`;
                    } else if (item.symbol.startsWith('X') && item.price < 1) {
                        formattedPrice = `$${item.price.toFixed(4)}`;
                    } else if (item.price < 1) {
                        formattedPrice = `$${item.price.toFixed(4)}`;
                    } else {
                        formattedPrice = `$${item.price.toLocaleString(undefined, {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            })}`;
                    }

                    tickerItem.innerHTML = `
            <span class="market-symbol">${item.symbol}</span>
            <span class="market-price">${formattedPrice}</span>
            <span class="market-change ${changeClass}">${sign}${Math.abs(item.change).toFixed(2)}%</span>
        `;

                    marketTicker.appendChild(tickerItem);
                });
            }

            // Updated update interval function
            setInterval(() => {
                const items = document.querySelectorAll('.market-ticker .market-item');
                items.forEach((item, index) => {
                    const changeElement = item.querySelector('.market-change');
                    const changeText = changeElement.textContent;
                    const currentChange = parseFloat(changeText.replace(/[+-]/g, ''));
                    const isPositive = changeText.includes('+');

                    // Simulate small price changes
                    const randomChange = (Math.random() - 0.5) * 0.15;
                    const newChange = Math.max(Math.min(currentChange + randomChange, 8), -4);
                    const newIsPositive = newChange >= 0;

                    // Update display
                    changeElement.textContent =
                        `${newIsPositive ? '+' : ''}${newChange.toFixed(2)}%`;
                    changeElement.className =
                        `market-change ${newIsPositive ? 'positive' : 'negative'}`;

                    // Update corresponding item in the duplicated set
                    if (items[index + 12]) { // 12 is the original symbols count
                        const duplicateItem = items[index + 12];
                        const duplicateChange = duplicateItem.querySelector('.market-change');
                        duplicateChange.textContent =
                            `${newIsPositive ? '+' : ''}${newChange.toFixed(2)}%`;
                        duplicateChange.className =
                            `market-change ${newIsPositive ? 'positive' : 'negative'}`;
                    }
                });
            }, 3000);
            // Initialize market ticker
            createMarketTicker();

            // Simulate real-time updates
            setInterval(() => {
                const items = document.querySelectorAll('.market-item');
                items.forEach(item => {
                    const changeElement = item.querySelector('.market-change');
                    const changeText = changeElement.textContent;
                    const currentChange = parseFloat(changeText.replace(/[+-]/g, ''));
                    const isPositive = changeText.includes('+');

                    // Simulate small price changes
                    const randomChange = (Math.random() - 0.5) * 0.2;
                    const newChange = Math.max(Math.min(currentChange + randomChange, 10), -5);
                    const newIsPositive = newChange >= 0;

                    // Update display
                    changeElement.textContent =
                        `${newIsPositive ? '+' : ''}${newChange.toFixed(2)}%`;
                    changeElement.className =
                        `market-change ${newIsPositive ? 'positive' : 'negative'}`;
                });
            }, 5000);

            // Add hover effect to login card
            const loginCard = document.querySelector('.login-card');
            loginCard.addEventListener('mouseenter', () => {
                loginCard.style.transform = 'translateY(-10px) scale(1.02)';
            });

            loginCard.addEventListener('mouseleave', () => {
                loginCard.style.transform = 'translateY(-5px) scale(1)';
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

            // Easter egg: Secret keyboard shortcut
            let konamiCode = [];
            const konamiSequence = [
                'ArrowUp', 'ArrowUp',
                'ArrowDown', 'ArrowDown',
                'ArrowLeft', 'ArrowRight',
                'ArrowLeft', 'ArrowRight',
                'b', 'a'
            ];

            document.addEventListener('keydown', (e) => {
                konamiCode.push(e.key);
                if (konamiCode.length > konamiSequence.length) {
                    konamiCode.shift();
                }

                if (JSON.stringify(konamiCode) === JSON.stringify(konamiSequence)) {
                    // Konami code activated!
                    document.body.style.background = 'linear-gradient(45deg, #ff00ff, #00ffff)';
                    setTimeout(() => {
                        document.body.style.background = '';
                    }, 3000);
                    konamiCode = [];
                }
            });
        });
    </script>
</body>

</html>
