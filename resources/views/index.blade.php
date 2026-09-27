<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Genesis Block | Professional Crypto, Forex & Stock Trading</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --black: #000000;
            --green: #63AF31;
            --red: #D0211E;
            --dark-gray: #1F1F1F;
            --light-gray: #333333;
            --text-light: #FFFFFF;
            --text-gray: #CCCCCC;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--black);
            color: var(--text-light);
            line-height: 1.6;
            overflow-x: hidden;
        }

        .section-title {
            font-weight: 700;
            margin-bottom: 2rem;
            position: relative;
            padding-bottom: 10px;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 3px;
            background-color: var(--green);
        }

        /* Header */
        .navbar {
            background-color: var(--black) !important;
            padding: 1rem 0;
            border-bottom: 1px solid var(--dark-gray);
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }

        .navbar-brand {
            font-weight: 700;
            font-family: 'Inter', sans-serif;
            font-size: 1.8rem;
            line-height: 1;
        }

        .navbar-brand .brand-name {
            background: linear-gradient(100deg, #63AF31 0%, #A6D882 52%, #FFFFFF 100%);
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
            -webkit-text-fill-color: transparent;
        }

        .nav-link {
            color: var(--text-gray) !important;
            font-weight: 500;
            margin: 0 0.5rem;
            transition: color 0.3s;
        }

        .nav-link:hover {
            color: var(--green) !important;
        }

        .btn-primary {
            background-color: var(--green);
            border-color: var(--green);
            padding: 0.5rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            background-color: #4d8c25;
            border-color: #4d8c25;
            transform: translateY(-2px);
        }

        .btn-secondary {
            background-color: transparent;
            border: 1px solid var(--text-light);
            color: var(--text-light);
            padding: 0.5rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-secondary:hover {
            background-color: rgba(255, 255, 255, 0.1);
            border-color: var(--text-light);
            color: var(--text-light);
        }

        .btn-warning {
            background-color: var(--red);
            border-color: var(--red);
            color: var(--text-light);
            padding: 0.5rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-warning:hover {
            background-color: #a91a17;
            border-color: #a91a17;
            color: var(--text-light);
        }

        /* Hero Section */
        .hero-section {
            padding-top: 10rem;
            padding-bottom: 5rem;
            background: linear-gradient(135deg, var(--black) 0%, var(--dark-gray) 100%);
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><rect width="100" height="100" fill="none"/><path d="M0,0 L100,0 L100,100 Z" fill="%231F1F1F" opacity="0.3"/></svg>');
            background-size: cover;
            z-index: 0;
        }

        .hero-content {
            position: relative;
            z-index: 1;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 1.5rem;
        }

        .hero-description {
            font-size: 1.2rem;
            color: var(--text-gray);
            margin-bottom: 2.5rem;
            max-width: 600px;
        }

        /* Market Ticker */
        .market-ticker {
            background-color: var(--dark-gray);
            padding: 0.8rem 0;
            overflow: hidden;
            position: relative;
        }

        .ticker-container {
            display: flex;
            animation: ticker 30s linear infinite;
        }

        .ticker-item {
            display: flex;
            align-items: center;
            margin-right: 3rem;
            white-space: nowrap;
        }

        .ticker-symbol {
            font-weight: 600;
            margin-right: 0.5rem;
        }

        .ticker-price {
            font-weight: 600;
            margin-right: 0.5rem;
        }

        .ticker-change.positive {
            color: var(--green);
        }

        .ticker-change.negative {
            color: var(--red);
        }

        @keyframes ticker {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        /* Live Market Overview */
        .market-overview {
            background-color: var(--dark-gray);
            padding: 4rem 0;
        }

        .market-card {
            background-color: var(--black);
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border-left: 4px solid var(--green);
            transition: transform 0.3s;
        }

        .market-card:hover {
            transform: translateY(-5px);
        }

        .market-card.negative {
            border-left-color: var(--red);
        }

        .market-name {
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
        }

        .market-price {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.2rem;
        }

        .market-change {
            font-weight: 600;
        }

        .positive {
            color: var(--green);
        }

        .negative {
            color: var(--red);
        }

        /* Sections */
        .section-container {
            padding: 5rem 0;
            border-bottom: 1px solid var(--light-gray);
        }

        .section-light {
            background-color: var(--dark-gray);
        }

        /* Features */
        .feature-card {
            background-color: var(--black);
            border-radius: 10px;
            padding: 2rem;
            height: 100%;
            transition: transform 0.3s;
            border: 1px solid var(--light-gray);
        }

        .feature-card:hover {
            transform: translateY(-5px);
            border-color: var(--green);
        }

        .feature-icon {
            font-size: 2.5rem;
            color: var(--green);
            margin-bottom: 1.5rem;
        }

        /* Pricing */
        .pricing-card {
            background-color: var(--black);
            border-radius: 10px;
            padding: 2.5rem 2rem;
            text-align: center;
            border: 1px solid var(--light-gray);
            transition: all 0.3s;
        }

        .pricing-card:hover {
            border-color: var(--green);
            transform: translateY(-10px);
        }

        .pricing-card.featured {
            border: 2px solid var(--green);
            position: relative;
            overflow: hidden;
        }

        .pricing-card.featured::before {
            content: 'POPULAR';
            position: absolute;
            top: 20px;
            right: -30px;
            background-color: var(--green);
            color: var(--black);
            padding: 0.3rem 3rem;
            transform: rotate(45deg);
            font-weight: 700;
            font-size: 0.8rem;
        }

        .pricing-header {
            margin-bottom: 2rem;
        }

        .pricing-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .pricing-price {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--green);
        }

        .pricing-period {
            color: var(--text-gray);
            font-size: 1rem;
        }

        /* Security */
        .security-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 2rem;
        }

        .security-icon {
            font-size: 1.5rem;
            color: var(--green);
            margin-right: 1rem;
            margin-top: 0.3rem;
        }

        /* Testimonials */
        .testimonial-card {
            background-color: var(--black);
            border-radius: 10px;
            padding: 2rem;
            border: 1px solid var(--light-gray);
            height: 100%;
        }

        .testimonial-rating {
            color: #FFD700;
            margin-bottom: 1rem;
        }

        /* Contact Form */
        .contact-form .form-control {
            background-color: var(--dark-gray);
            border: 1px solid var(--light-gray);
            color: var(--text-light);
            padding: 0.8rem 1rem;
            margin-bottom: 1.5rem;
        }

        .contact-form .form-control:focus {
            background-color: var(--dark-gray);
            border-color: var(--green);
            color: var(--text-light);
            box-shadow: 0 0 0 0.25rem rgba(99, 175, 49, 0.25);
        }

        /* Footer */
        .footer {
            background-color: var(--black);
            padding: 4rem 0 2rem;
            border-top: 1px solid var(--light-gray);
        }

        .footer-logo {
            font-weight: 700;
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
        }

        .footer-logo span:first-child {
            color: var(--text-light);
        }

        .footer-logo span:last-child {
            color: var(--green);
        }

        .footer-heading {
            font-weight: 600;
            margin-bottom: 1.5rem;
            font-size: 1.2rem;
        }

        .footer-links {
            list-style: none;
            padding-left: 0;
        }

        .footer-links li {
            margin-bottom: 0.8rem;
        }

        .footer-links a {
            color: var(--text-gray);
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer-links a:hover {
            color: var(--green);
        }

        .social-icons a {
            display: inline-block;
            width: 40px;
            height: 40px;
            background-color: var(--dark-gray);
            border-radius: 50%;
            text-align: center;
            line-height: 40px;
            margin-right: 0.5rem;
            color: var(--text-light);
            transition: all 0.3s;
        }

        .social-icons a:hover {
            background-color: var(--green);
            transform: translateY(-3px);
        }

        .copyright {
            border-top: 1px solid var(--light-gray);
            padding-top: 2rem;
            margin-top: 3rem;
            color: var(--text-gray);
            font-size: 0.9rem;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .hero-title {
                font-size: 2.8rem;
            }
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.2rem;
            }

            .section-container {
                padding: 3rem 0;
            }
        }

        @media (max-width: 576px) {
            .hero-title {
                font-size: 1.8rem;
            }

            .hero-description {
                font-size: 1rem;
            }
        }

        /* Chart simulation */
        .mini-chart {
            height: 30px;
            width: 80px;
            margin-top: 0.5rem;
            position: relative;
            overflow: hidden;
        }

        .chart-line {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 100%;
        }

        .chart-line.positive {
            background: linear-gradient(to top, rgba(99, 175, 49, 0.2) 0%, rgba(99, 175, 49, 0.8) 100%);
        }

        .chart-line.negative {
            background: linear-gradient(to top, rgba(208, 33, 30, 0.2) 0%, rgba(208, 33, 30, 0.8) 100%);
        }

        /* Step indicators */
        .step-item {
            text-align: center;
            padding: 1rem;
        }

        .step-icon {
            width: 70px;
            height: 70px;
            background-color: var(--dark-gray);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 1.8rem;
            color: var(--green);
            border: 2px solid var(--green);
        }

        /* Mobile app mockup */
        .mobile-mockup {
            position: relative;
            max-width: 300px;
            margin: 0 auto;
        }

        .mobile-screen {
            background-color: var(--dark-gray);
            border-radius: 30px;
            padding: 2rem 1.5rem;
            border: 10px solid var(--black);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }

        .screen-content {
            background-color: var(--black);
            border-radius: 10px;
            padding: 1rem;
            height: 400px;
        }
    </style>
</head>

<body>
    <!-- Header / Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">
                <span class="brand-name">Genesis Block</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#markets">Markets</a></li>
                    <li class="nav-item"><a class="nav-link" href="#trading">Trading</a></li>
                    <li class="nav-item"><a class="nav-link" href="#pricing">Pricing</a></li>
                    <li class="nav-item"><a class="nav-link" href="#education">Education</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                </ul>
                <div class="d-flex ms-lg-3 mt-3 mt-lg-0">
                    <button class="btn btn-secondary me-2">Login</button>
                    <button class="btn btn-primary">Register</button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section" id="home">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 hero-content">
                    <h1 class="hero-title">Trade Smarter. Trade Faster. Trade Securely.</h1>
                    <p class="hero-description">Join the world's leading multi-asset trading platform. Access global
                        markets in cryptocurrencies, forex, stocks, and commodities with institutional-grade tools and
                        security.</p>
                    <div class="d-flex flex-wrap gap-3">
                        <button class="btn btn-primary">Start Trading</button>
                        <button class="btn btn-secondary">Create Free Account</button>
                    </div>
                </div>
                <div class="col-lg-6 mt-5 mt-lg-0">
                    <div class="market-overview p-4 rounded">
                        <h5 class="mb-4">Live Market Overview</h5>
                        <div id="marketData"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Animated Market Ticker -->
    <div class="market-ticker">
        <div class="ticker-container">
            <!-- Ticker items will be populated by JavaScript -->
        </div>
    </div>

    <!-- Live Market Overview Section -->
    <section class="section-container" id="markets">
        <div class="container">
            <h2 class="section-title">Live Market Overview</h2>
            <div class="row" id="marketOverview">
                <!-- Market data will be populated by JavaScript -->
            </div>
        </div>
    </section>

    <!-- About the Platform -->
    <section class="section-container section-light" id="about">
        <div class="container">
            <h2 class="section-title">About Genesis Block</h2>
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <p class="mb-4">Genesis Block is a premier multi-asset trading platform founded in 2015, serving
                        over 2 million traders worldwide. Our mission is to democratize access to global financial
                        markets through technology, education, and transparent pricing.</p>
                    <p class="mb-4">We combine cutting-edge trading technology with institutional-grade security to
                        provide a seamless trading experience for both beginners and professionals.</p>
                    <div class="row mt-5">
                        <div class="col-md-4 text-center mb-4">
                            <h3 class="text-green">8+</h3>
                            <p class="text-gray">Years Experience</p>
                        </div>
                        <div class="col-md-4 text-center mb-4">
                            <h3 class="text-green">2M+</h3>
                            <p class="text-gray">Active Traders</p>
                        </div>
                        <div class="col-md-4 text-center mb-4">
                            <h3 class="text-green">$4.2T+</h3>
                            <p class="text-gray">Trading Volume</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="p-4 rounded" style="background-color: var(--black);">
                        <h4 class="mb-3">Our Vision</h4>
                        <p>To become the world's most trusted trading platform by empowering traders with tools,
                            knowledge, and security to navigate global markets effectively.</p>
                        <h4 class="mt-4 mb-3">Core Values</h4>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="fas fa-check-circle text-green me-2"></i> Transparency in
                                pricing & execution</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-green me-2"></i> Security-first
                                approach</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-green me-2"></i> Continuous
                                innovation</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-green me-2"></i> Client education &
                                support</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How Trading Works -->
    <section class="section-container" id="trading">
        <div class="container">
            <h2 class="section-title">How Trading Works</h2>
            <div class="row">
                <div class="col-lg-2 col-md-4 col-sm-6 step-item">
                    <div class="step-icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <h5>Create Account</h5>
                    <p class="small">Sign up in under 2 minutes</p>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 step-item">
                    <div class="step-icon">
                        <i class="fas fa-id-card"></i>
                    </div>
                    <h5>Complete KYC</h5>
                    <p class="small">Verify your identity securely</p>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 step-item">
                    <div class="step-icon">
                        <i class="fas fa-credit-card"></i>
                    </div>
                    <h5>Add Funds</h5>
                    <p class="small">Deposit via multiple methods</p>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 step-item">
                    <div class="step-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h5>Start Trading</h5>
                    <p class="small">Access 1000+ instruments</p>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 step-item">
                    <div class="step-icon">
                        <i class="fas fa-wallet"></i>
                    </div>
                    <h5>Withdraw Profits</h5>
                    <p class="small">Fast withdrawal processing</p>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 step-item">
                    <div class="step-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h5>Stay Secure</h5>
                    <p class="small">Advanced security protocols</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Trading Features -->
    <section class="section-container section-light">
        <div class="container">
            <h2 class="section-title">Advanced Trading Features</h2>
            <div class="row">
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                        <h4>Live Charts</h4>
                        <p>Advanced charting with 100+ technical indicators, drawing tools, and multiple timeframes.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-robot"></i>
                        </div>
                        <h4>Stop Loss & Take Profit</h4>
                        <p>Automate risk management with advanced order types to protect your capital.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-balance-scale"></i>
                        </div>
                        <h4>Leverage Trading</h4>
                        <p>Trade with leverage up to 1:500 on selected instruments to amplify your positions.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <h4>Instant Execution</h4>
                        <p>Ultra-fast order execution with average latency under 10ms for critical trades.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <h4>Mobile Trading</h4>
                        <p>Full-featured mobile app for iOS and Android to trade anywhere, anytime.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-code"></i>
                        </div>
                        <h4>API Access</h4>
                        <p>Powerful REST and WebSocket APIs for algorithmic trading and custom integration.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Markets We Offer -->
    <section class="section-container">
        <div class="container">
            <h2 class="section-title">Markets We Offer</h2>
            <div class="row">
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="market-card">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="market-name">Cryptocurrency</div>
                                <div class="market-price">100+ Pairs</div>
                            </div>
                            <div class="feature-icon">
                                <i class="fab fa-bitcoin"></i>
                            </div>
                        </div>
                        <p class="mt-3">Trade Bitcoin, Ethereum, and other major cryptocurrencies with tight spreads.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="market-card">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="market-name">Forex</div>
                                <div class="market-price">80+ Pairs</div>
                            </div>
                            <div class="feature-icon">
                                <i class="fas fa-globe"></i>
                            </div>
                        </div>
                        <p class="mt-3">Major, minor, and exotic currency pairs with institutional pricing.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="market-card">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="market-name">Stocks</div>
                                <div class="market-price">500+ Companies</div>
                            </div>
                            <div class="feature-icon">
                                <i class="fas fa-chart-line"></i>
                            </div>
                        </div>
                        <p class="mt-3">Trade shares of top US, European, and Asian companies with CFDs.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="market-card">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="market-name">Commodities</div>
                                <div class="market-price">Gold, Oil & More</div>
                            </div>
                            <div class="feature-icon">
                                <i class="fas fa-gas-pump"></i>
                            </div>
                        </div>
                        <p class="mt-3">Trade precious metals, energy, and agricultural commodities.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="market-card">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="market-name">Indices</div>
                                <div class="market-price">Global Markets</div>
                            </div>
                            <div class="feature-icon">
                                <i class="fas fa-chart-area"></i>
                            </div>
                        </div>
                        <p class="mt-3">Trade global indices including S&P 500, NASDAQ, FTSE 100, and more.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="market-card">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="market-name">ETFs</div>
                                <div class="market-price">Diversified Funds</div>
                            </div>
                            <div class="feature-icon">
                                <i class="fas fa-boxes"></i>
                            </div>
                        </div>
                        <p class="mt-3">Access a wide range of Exchange Traded Funds across various sectors.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing & Plans -->
    <section class="section-container section-light" id="pricing">
        <div class="container">
            <h2 class="section-title">Transparent Pricing</h2>
            <p class="mb-5 text-center">No hidden fees. Choose the plan that fits your trading style.</p>
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="pricing-card">
                        <div class="pricing-header">
                            <h3 class="pricing-title">Basic</h3>
                            <div class="pricing-price">$0<span class="pricing-period">/month</span></div>
                            <p class="text-gray">For beginner traders</p>
                        </div>
                        <ul class="list-unstyled mb-4">
                            <li class="mb-2"><i class="fas fa-check text-green me-2"></i> Commission: $5 per lot
                            </li>
                            <li class="mb-2"><i class="fas fa-check text-green me-2"></i> Spreads: From 1.2 pips
                            </li>
                            <li class="mb-2"><i class="fas fa-check text-green me-2"></i> Leverage: Up to 1:100</li>
                            <li class="mb-2"><i class="fas fa-check text-green me-2"></i> Basic Charts</li>
                            <li class="mb-2"><i class="fas fa-check text-green me-2"></i> Email Support</li>
                        </ul>
                        <button class="btn btn-primary w-100">Get Started</button>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="pricing-card featured">
                        <div class="pricing-header">
                            <h3 class="pricing-title">Pro</h3>
                            <div class="pricing-price">$29<span class="pricing-period">/month</span></div>
                            <p class="text-gray">For active traders</p>
                        </div>
                        <ul class="list-unstyled mb-4">
                            <li class="mb-2"><i class="fas fa-check text-green me-2"></i> Commission: $3 per lot
                            </li>
                            <li class="mb-2"><i class="fas fa-check text-green me-2"></i> Spreads: From 0.8 pips
                            </li>
                            <li class="mb-2"><i class="fas fa-check text-green me-2"></i> Leverage: Up to 1:200</li>
                            <li class="mb-2"><i class="fas fa-check text-green me-2"></i> Advanced Charts</li>
                            <li class="mb-2"><i class="fas fa-check text-green me-2"></i> Priority Support</li>
                            <li class="mb-2"><i class="fas fa-check text-green me-2"></i> Trading Signals</li>
                        </ul>
                        <button class="btn btn-primary w-100">Get Started</button>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="pricing-card">
                        <div class="pricing-header">
                            <h3 class="pricing-title">Advanced</h3>
                            <div class="pricing-price">$99<span class="pricing-period">/month</span></div>
                            <p class="text-gray">For professional traders</p>
                        </div>
                        <ul class="list-unstyled mb-4">
                            <li class="mb-2"><i class="fas fa-check text-green me-2"></i> Commission: $1.5 per lot
                            </li>
                            <li class="mb-2"><i class="fas fa-check text-green me-2"></i> Spreads: From 0.2 pips
                            </li>
                            <li class="mb-2"><i class="fas fa-check text-green me-2"></i> Leverage: Up to 1:500</li>
                            <li class="mb-2"><i class="fas fa-check text-green me-2"></i> Premium Tools</li>
                            <li class="mb-2"><i class="fas fa-check text-green me-2"></i> Dedicated Account Manager
                            </li>
                            <li class="mb-2"><i class="fas fa-check text-green me-2"></i> API Access</li>
                            <li class="mb-2"><i class="fas fa-check text-green me-2"></i> VPS Hosting</li>
                        </ul>
                        <button class="btn btn-primary w-100">Get Started</button>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <p class="text-gray"><i class="fas fa-exclamation-circle text-green me-2"></i>All plans include SSL
                    encryption, 2FA security, and cold wallet storage for cryptocurrencies.</p>
            </div>
        </div>
    </section>

    <!-- Security & Compliance -->
    <section class="section-container">
        <div class="container">
            <h2 class="section-title">Security & Compliance</h2>
            <div class="row">
                <div class="col-lg-6">
                    <div class="security-item">
                        <div class="security-icon">
                            <i class="fas fa-lock"></i>
                        </div>
                        <div>
                            <h4>Bank-Level Security</h4>
                            <p>256-bit SSL encryption for all data transmission. Funds are held in segregated accounts
                                at top-tier banks.</p>
                        </div>
                    </div>
                    <div class="security-item">
                        <div class="security-icon">
                            <i class="fas fa-user-shield"></i>
                        </div>
                        <div>
                            <h4>Two-Factor Authentication</h4>
                            <p>Mandatory 2FA for all account logins and sensitive transactions. Support for
                                authenticator apps and hardware keys.</p>
                        </div>
                    </div>
                    <div class="security-item">
                        <div class="security-icon">
                            <i class="fas fa-wallet"></i>
                        </div>
                        <div>
                            <h4>Cold Wallet Storage</h4>
                            <p>95% of client cryptocurrencies are stored in offline cold wallets with multi-signature
                                access protocols.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="security-item">
                        <div class="security-icon">
                            <i class="fas fa-balance-scale"></i>
                        </div>
                        <div>
                            <h4>Regulatory Compliance</h4>
                            <p>Licensed and regulated by top financial authorities including FCA, CySEC, and ASIC.</p>
                        </div>
                    </div>
                    <div class="security-item">
                        <div class="security-icon">
                            <i class="fas fa-passport"></i>
                        </div>
                        <div>
                            <h4>KYC & AML Policies</h4>
                            <p>Strict Know Your Customer and Anti-Money Laundering procedures in compliance with global
                                standards.</p>
                        </div>
                    </div>
                    <div class="security-item">
                        <div class="security-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <div>
                            <h4>Insurance Protection</h4>
                            <p>Client funds are protected by insurance coverage of up to $500,000 per account.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Trading Tools & Indicators -->
    <section class="section-container section-light">
        <div class="container">
            <h2 class="section-title">Trading Tools & Indicators</h2>
            <div class="row">
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-ruler-combined"></i>
                        </div>
                        <h5>Technical Analysis</h5>
                        <p class="small">100+ indicators including Moving Averages, RSI, MACD, Bollinger Bands, and
                            Fibonacci retracements.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-calculator"></i>
                        </div>
                        <h5>Risk Management</h5>
                        <p class="small">Built-in risk calculator, position sizing tools, and margin requirements
                            calculator.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <h5>Economic Calendar</h5>
                        <p class="small">Real-time economic events, earnings reports, and central bank announcements
                            with impact ratings.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-bell"></i>
                        </div>
                        <h5>Trading Signals</h5>
                        <p class="small">AI-powered trading signals with entry/exit points, stop loss, and take profit
                            recommendations.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Education & Learning Center -->
    <section class="section-container" id="education">
        <div class="container">
            <h2 class="section-title">Education & Learning Center</h2>
            <div class="row">
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <h5>Beginner Course</h5>
                        <p class="small">Learn trading basics, terminology, and how to place your first trade.</p>
                        <a href="#" class="text-green small">Start Learning →</a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h5>Technical Analysis</h5>
                        <p class="small">Master chart patterns, indicators, and price action strategies.</p>
                        <a href="#" class="text-green small">Start Learning →</a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-book"></i>
                        </div>
                        <h5>Trading Blog</h5>
                        <p class="small">Daily market analysis, trading insights, and platform updates.</p>
                        <a href="#" class="text-green small">Read Articles →</a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-video"></i>
                        </div>
                        <h5>Video Guides</h5>
                        <p class="small">Step-by-step tutorials and webinars from professional traders.</p>
                        <a href="#" class="text-green small">Watch Videos →</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials & Reviews -->
    <section class="section-container section-light">
        <div class="container">
            <h2 class="section-title">Trader Testimonials</h2>
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="testimonial-card">
                        <div class="testimonial-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p>"Genesis Block transformed my trading journey. The platform is intuitive, execution is
                            lightning fast, and their educational resources helped me become a profitable trader."</p>
                        <div class="d-flex align-items-center mt-3">
                            <div class="me-3">
                                <h6 class="mb-0">Michael Chen</h6>
                                <small class="text-gray">Professional Forex Trader</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="testimonial-card">
                        <div class="testimonial-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <p>"As a crypto trader, security is my top priority. Genesis Block's cold wallet storage and 2FA
                            give me peace of mind. The API access is also excellent for my algorithmic strategies."</p>
                        <div class="d-flex align-items-center mt-3">
                            <div class="me-3">
                                <h6 class="mb-0">Sarah Johnson</h6>
                                <small class="text-gray">Crypto Investor</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="testimonial-card">
                        <div class="testimonial-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p>"The mobile app is fantastic! I can manage my portfolio and execute trades while traveling.
                            The customer support team is responsive and knowledgeable when I need assistance."</p>
                        <div class="d-flex align-items-center mt-3">
                            <div class="me-3">
                                <h6 class="mb-0">David Rodriguez</h6>
                                <small class="text-gray">Stock & ETF Trader</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mobile App Promotion -->
    <section class="section-container">
        <div class="container">
            <h2 class="section-title">Trade On The Go</h2>
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h3 class="mb-4">Powerful Trading in Your Pocket</h3>
                    <p class="mb-4">Our award-winning mobile app brings the full trading experience to your
                        smartphone. Execute trades, monitor portfolios, and access advanced charts anywhere.</p>
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="list-unstyled mb-4">
                                <li class="mb-2"><i class="fas fa-check-circle text-green me-2"></i> Full account
                                    management</li>
                                <li class="mb-2"><i class="fas fa-check-circle text-green me-2"></i> Real-time price
                                    alerts</li>
                                <li class="mb-2"><i class="fas fa-check-circle text-green me-2"></i> Advanced
                                    charting tools</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="list-unstyled mb-4">
                                <li class="mb-2"><i class="fas fa-check-circle text-green me-2"></i> Biometric login
                                </li>
                                <li class="mb-2"><i class="fas fa-check-circle text-green me-2"></i> Push
                                    notifications</li>
                                <li class="mb-2"><i class="fas fa-check-circle text-green me-2"></i> One-tap trading
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap gap-3">
                        <button class="btn btn-primary">
                            <i class="fab fa-apple me-2"></i> App Store
                        </button>
                        <button class="btn btn-primary">
                            <i class="fab fa-google-play me-2"></i> Google Play
                        </button>
                    </div>
                </div>
                <div class="col-lg-6 mt-5 mt-lg-0">
                    <div class="mobile-mockup">
                        <div class="mobile-screen">
                            <div class="screen-content">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h6 class="mb-0">Markets</h6>
                                    <span class="badge bg-green">LIVE</span>
                                </div>
                                <div class="market-card p-3 mb-3">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <div class="market-name">BTC/USD</div>
                                            <div class="market-price">$67,423.12</div>
                                        </div>
                                        <div class="market-change positive">+2.34%</div>
                                    </div>
                                </div>
                                <div class="market-card p-3 mb-3">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <div class="market-name">EUR/USD</div>
                                            <div class="market-price">1.0824</div>
                                        </div>
                                        <div class="market-change negative">-0.12%</div>
                                    </div>
                                </div>
                                <div class="market-card p-3">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <div class="market-name">AAPL</div>
                                            <div class="market-price">$192.34</div>
                                        </div>
                                        <div class="market-change positive">+1.56%</div>
                                    </div>
                                </div>
                                <div class="mt-4 text-center">
                                    <button class="btn btn-sm btn-primary w-100">Trade Now</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call To Action -->
    <section class="section-container section-light">
        <div class="container text-center">
            <h2 class="section-title text-center">Start Your Trading Journey Today</h2>
            <p class="mb-5" style="max-width: 700px; margin: 0 auto;">Join millions of traders who trust
                Genesis Block for secure, reliable, and professional trading across global markets.</p>
            <div class="d-flex flex-wrap justify-content-center gap-3">
                <button class="btn btn-primary btn-lg">Open Free Account</button>
                <button class="btn btn-secondary btn-lg">Start Trading Now</button>
            </div>
            <p class="mt-4 text-gray"><i class="fas fa-shield-alt text-green me-2"></i>No credit card required •
                30-day free trial • No hidden fees</p>
        </div>
    </section>

    <!-- Contact Us -->
    <section class="section-container" id="contact">
        <div class="container">
            <h2 class="section-title">Contact Us</h2>
            <div class="row">
                <div class="col-lg-6">
                    <form class="contact-form">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="First Name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="Last Name" required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control" placeholder="Email Address" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Subject">
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" rows="5" placeholder="Your Message" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Send Message</button>
                    </form>
                </div>
                <div class="col-lg-6 mt-5 mt-lg-0">
                    <div class="p-4 rounded" style="background-color: var(--dark-gray);">
                        <h4 class="mb-4">Get In Touch</h4>
                        <div class="d-flex align-items-start mb-4">
                            <div class="me-3">
                                <i class="fas fa-map-marker-alt text-green fs-5"></i>
                            </div>
                            <div>
                                <h6>Office Address</h6>
                                <p class="text-gray small">123 Trading Street, Financial District, New York, NY 10005,
                                    USA</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-start mb-4">
                            <div class="me-3">
                                <i class="fas fa-phone text-green fs-5"></i>
                            </div>
                            <div>
                                <h6>Phone Number</h6>
                                <p class="text-gray small">+1 (555) 123-4567<br>Mon-Fri, 9AM-6PM EST</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-start mb-4">
                            <div class="me-3">
                                <i class="fas fa-envelope text-green fs-5"></i>
                            </div>
                            <div>
                                <h6>Email Address</h6>
                                <p class="text-gray small">support@tradewalla.net<br>response within 2 hours</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-start">
                            <div class="me-3">
                                <i class="fas fa-comments text-green fs-5"></i>
                            </div>
                            <div>
                                <h6>Live Chat Support</h6>
                                <p class="text-gray small">Available 24/7 via our website or mobile app</p>
                                <button class="btn btn-sm btn-primary mt-2">Start Live Chat</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <div class="footer-logo">Genesis<span> Block</span></div>
                    <p class="mb-4">The world's leading multi-asset trading platform. Trade cryptocurrencies, forex,
                        stocks, and commodities with institutional-grade tools and security.</p>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 mb-5 mb-lg-0">
                    <h5 class="footer-heading">Platform</h5>
                    <ul class="footer-links">
                        <li><a href="#">Web Trader</a></li>
                        <li><a href="#">Mobile App</a></li>
                        <li><a href="#">Desktop App</a></li>
                        <li><a href="#">Trading Tools</a></li>
                        <li><a href="#">API Access</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-4 mb-5 mb-lg-0">
                    <h5 class="footer-heading">Markets</h5>
                    <ul class="footer-links">
                        <li><a href="#">Cryptocurrency</a></li>
                        <li><a href="#">Forex</a></li>
                        <li><a href="#">Stocks</a></li>
                        <li><a href="#">Commodities</a></li>
                        <li><a href="#">Indices</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-4 mb-5 mb-lg-0">
                    <h5 class="footer-heading">Company</h5>
                    <ul class="footer-links">
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Careers</a></li>
                        <li><a href="#">Press</a></li>
                        <li><a href="#">Partners</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-4">
                    <h5 class="footer-heading">Legal</h5>
                    <ul class="footer-links">
                        <li><a href="#">Terms & Conditions</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Risk Disclosure</a></li>
                        <li><a href="#">Cookie Policy</a></li>
                        <li><a href="#">Regulatory Info</a></li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="copyright text-center">
                        <p class="mb-2">© 2023 Genesis Block. All rights reserved.</p>
                        <p class="small text-gray">Trading financial instruments carries significant risk of loss. Past
                            performance is not indicative of future results. Please read our Risk Disclosure before
                            trading.</p>
                        <p class="small text-gray mt-2">Genesis Block is a registered trademark. Genesis Block LLC is
                            registered at 123 Trading Street, Financial District, New York, NY 10005, USA.</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap & jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        // Market data for the ticker and overview
        const marketData = [{
                symbol: "BTC/USD",
                price: 67423.12,
                change: 2.34,
                volume: "32.4B"
            },
            {
                symbol: "ETH/USD",
                price: 3456.78,
                change: 1.89,
                volume: "14.2B"
            },
            {
                symbol: "EUR/USD",
                price: 1.0824,
                change: -0.12,
                volume: "1.2T"
            },
            {
                symbol: "GBP/USD",
                price: 1.2632,
                change: 0.24,
                volume: "850B"
            },
            {
                symbol: "XAU/USD",
                price: 2345.67,
                change: 0.56,
                volume: "120B"
            },
            {
                symbol: "AAPL",
                price: 192.34,
                change: 1.56,
                volume: "85.3M"
            },
            {
                symbol: "TSLA",
                price: 245.67,
                change: -0.89,
                volume: "102.1M"
            },
            {
                symbol: "NASDAQ",
                price: 16234.56,
                change: 0.78,
                volume: "N/A"
            }
        ];

        const tickerData = [{
                symbol: "BTC",
                price: "$67,423",
                change: "+2.34%"
            },
            {
                symbol: "ETH",
                price: "$3,456",
                change: "+1.89%"
            },
            {
                symbol: "XRP",
                price: "$0.62",
                change: "-0.45%"
            },
            {
                symbol: "EUR/USD",
                price: "1.0824",
                change: "-0.12%"
            },
            {
                symbol: "GBP/USD",
                price: "1.2632",
                change: "+0.24%"
            },
            {
                symbol: "USD/JPY",
                price: "154.32",
                change: "+0.18%"
            },
            {
                symbol: "Gold",
                price: "$2,345",
                change: "+0.56%"
            },
            {
                symbol: "Oil",
                price: "$78.90",
                change: "-1.23%"
            },
            {
                symbol: "AAPL",
                price: "$192.34",
                change: "+1.56%"
            },
            {
                symbol: "TSLA",
                price: "$245.67",
                change: "-0.89%"
            }
        ];

        // Initialize ticker
        function initTicker() {
            const tickerContainer = document.querySelector('.ticker-container');
            tickerContainer.innerHTML = '';

            // Duplicate items to create seamless loop
            const tickerItems = [...tickerData, ...tickerData];

            tickerItems.forEach(item => {
                const tickerItem = document.createElement('div');
                tickerItem.className = 'ticker-item';

                const isPositive = item.change.startsWith('+');

                tickerItem.innerHTML = `
                    <span class="ticker-symbol">${item.symbol}</span>
                    <span class="ticker-price">${item.price}</span>
                    <span class="ticker-change ${isPositive ? 'positive' : 'negative'}">${item.change}</span>
                `;

                tickerContainer.appendChild(tickerItem);
            });
        }

        // Initialize market overview
        function initMarketOverview() {
            const marketOverview = document.getElementById('marketOverview');
            marketOverview.innerHTML = '';

            marketData.forEach(item => {
                const isPositive = item.change >= 0;
                const colClass = "col-md-6 col-lg-3";

                const marketCard = document.createElement('div');
                marketCard.className = colClass;

                marketCard.innerHTML = `
                    <div class="market-card ${isPositive ? '' : 'negative'}">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <div class="market-name">${item.symbol}</div>
                                <div class="market-price">${item.symbol.includes('/') ? item.price.toFixed(4) : '$' + item.price.toFixed(2)}</div>
                                <div class="market-change ${isPositive ? 'positive' : 'negative'}">
                                    ${isPositive ? '+' : ''}${item.change}%
                                </div>
                            </div>
                            <div class="mini-chart">
                                <div class="chart-line ${isPositive ? 'positive' : 'negative'}"></div>
                            </div>
                        </div>
                        <div class="mt-3 d-flex justify-content-between align-items-center">
                            <small class="text-gray">24h Volume</small>
                            <small>${item.volume}</small>
                        </div>
                    </div>
                `;

                marketOverview.appendChild(marketCard);
            });
        }

        // Initialize market data in hero
        function initMarketData() {
            const marketDataContainer = document.getElementById('marketData');
            marketDataContainer.innerHTML = '';

            // Display first 4 items in hero
            marketData.slice(0, 4).forEach(item => {
                const isPositive = item.change >= 0;

                const marketItem = document.createElement('div');
                marketItem.className = 'd-flex justify-content-between align-items-center mb-3';

                marketItem.innerHTML = `
                    <div>
                        <div class="market-name">${item.symbol}</div>
                        <div class="market-price">${item.symbol.includes('/') ? item.price.toFixed(4) : '$' + item.price.toFixed(2)}</div>
                    </div>
                    <div class="market-change ${isPositive ? 'positive' : 'negative'}">
                        ${isPositive ? '+' : ''}${item.change}%
                    </div>
                `;

                marketDataContainer.appendChild(marketItem);
            });
        }

        // Smooth scrolling for anchor links
        $(document).ready(function() {
            $('a[href^="#"]').on('click', function(e) {
                e.preventDefault();

                const target = this.hash;
                const $target = $(target);

                $('html, body').animate({
                    'scrollTop': $target.offset().top - 80
                }, 800, 'swing');
            });

            // Initialize market displays
            initTicker();
            initMarketOverview();
            initMarketData();

            // Update market data every 10 seconds (simulated)
            setInterval(() => {
                // Simulate price changes
                marketData.forEach(item => {
                    const changeFactor = (Math.random() - 0.5) *
                        0.5; // Random change between -0.25% and +0.25%
                    item.change = parseFloat((item.change + changeFactor).toFixed(2));

                    // Update price based on change
                    const changePercent = item.change / 100;
                    item.price = parseFloat((item.price * (1 + changePercent)).toFixed(2));
                });

                // Update displays
                initMarketOverview();
                initMarketData();
            }, 10000);

            // Sticky navbar on scroll
            window.addEventListener('scroll', function() {
                const navbar = document.querySelector('.navbar');
                if (window.scrollY > 50) {
                    navbar.style.boxShadow = '0 4px 12px rgba(0, 0, 0, 0.1)';
                } else {
                    navbar.style.boxShadow = 'none';
                }
            });
        });
    </script>
</body>

</html>
