<script>
    setTimeout(() => {
        let latestPrices = {};
        let priceChanges = {};

        let wsUrl =
            "wss://stream.binance.com:9443/stream?streams=btcusdt@ticker/ethusdt@ticker/bnbusdt@ticker/xrpusdt@ticker/solusdt@ticker";

        let ws = new WebSocket(wsUrl);

        function updateUI() {

            let symbols = ["BTCUSDT", "ETHUSDT", "BNBUSDT", "XRPUSDT", "SOLUSDT"];

            symbols.forEach(symbol => {
                if (latestPrices[symbol]) {
                    // Update price
                    let priceElements = document.querySelectorAll(`[data-symbol="${symbol}"]`);
                    let price = parseFloat(latestPrices[symbol]).toFixed(2);

                    priceElements.forEach(el => {
                        el.textContent = "$" + parseFloat(price).toLocaleString();
                        el.classList.remove('loading');
                    });

                    // Update change percentage and icon
                    let changeElements = document.querySelectorAll(`[data-change="${symbol}"]`);
                    let change = priceChanges[symbol] || 0;

                    changeElements.forEach(el => {
                        let isPositive = change > 0;
                        let isNegative = change < 0;

                        // Update classes
                        el.classList.remove('positive', 'negative', 'neutral');
                        el.classList.add(isPositive ? 'positive' : isNegative ? 'negative' :
                            'neutral');

                        // Update icon and text
                        let icon = isPositive ? '▲' : isNegative ? '▼' : '━';
                        let sign = isPositive ? '+' : '';

                        el.innerHTML = `
                            <span class="trade-icon">${icon}</span>
                            <span>${sign}${change.toFixed(2)}%</span>
                        `;
                    });

                }
            });
        }

        ws.onmessage = function(event) {
            try {
                let data = JSON.parse(event.data);
                if (data && data.data && data.data.s && data.data.c) {
                    latestPrices[data.data.s] = data.data.c;
                    priceChanges[data.data.s] = parseFloat(data.data.P); // P is the price change percentage
                }
            } catch (e) {
                console.error("Error parsing WebSocket message:", e);
            }
        };

        ws.onclose = function(event) {
            setTimeout(() => location.reload(), 3000);
        };

        // Update every second for smooth updates
        setInterval(updateUI, 1000);
        setTimeout(updateUI, 2000);

    }, 1000);




    // WebSocket connection for real-time data (simulated - replace with actual WebSocket endpoint)
    class ForexWebSocket {
        constructor() {
            this.symbols = [
                'XAU/USD', 'EUR/USD', 'GBP/USD', 'USD/JPY', 'XAG/USD'
            ];
            this.forexData = {};
            this.connect();
        }

        connect() {
            // This is a simulation - replace with actual WebSocket connection
            console.log('Connecting to Forex WebSocket...');

            // Simulate WebSocket connection
            this.updatePrices();
            setInterval(() => this.updatePrices(), 3000); // Update every 3 seconds
        }

        updatePrices() {
            this.symbols.forEach(symbol => {
                // Simulate price changes
                const basePrice = this.getBasePrice(symbol);
                const change = (Math.random() - 0.5) * 0.02; // ±1% change
                const newPrice = basePrice * (1 + change);
                const percentChange = (change * 100).toFixed(2);

                this.forexData[symbol] = {
                    price: newPrice.toFixed(this.getDecimals(symbol)),
                    change: percentChange,
                    isPositive: percentChange >= 0
                };

                this.updateUI(symbol);
            });
        }

        getBasePrice(symbol) {
            const basePrices = {
                'EUR/USD': 1.0850,
                'GBP/USD': 1.2650,
                'USD/JPY': 148.50,
                'XAU/USD': 2030.00,
                'XAG/USD': 23.50
            };
            return basePrices[symbol] || 1.0000;
        }

        getDecimals(symbol) {
            if (symbol.includes('XAU') || symbol.includes('XAG')) return 2;
            if (symbol.includes('USD/JPY')) return 2;
            return 4;
        }

        updateUI(symbol) {
            const data = this.forexData[symbol];
            if (!data) return;

            // Update price
            const priceElement = document.querySelector(`[data-forex-symbol="${symbol}"]`);
            if (priceElement) {
                priceElement.textContent = data.price;
                priceElement.classList.remove('loading');
            }

            // Update change
            const changeElement = document.querySelector(`[data-forex-change="${symbol}"]`);
            if (changeElement) {
                const changeValue = parseFloat(data.change);
                changeElement.innerHTML = `
                <span class="trade-icon">${changeValue >= 0 ? '↗' : '↘'}</span>
                <span>${Math.abs(changeValue).toFixed(2)}%</span>
            `;

                // Update styling
                changeElement.className = 'crypto-right ' +
                    (changeValue > 0 ? 'positive' : changeValue < 0 ? 'negative' : 'neutral');
            }
        }
    }

    // Alpha Vantage API Integration
    class AlphaVantageAPI {
        constructor(apiKey) {
            this.apiKey = apiKey;
            this.baseURL = 'https://www.alphavantage.co/query';
        }

        async getForexRate(fromCurrency, toCurrency) {
            try {
                const url =
                    `${this.baseURL}?function=CURRENCY_EXCHANGE_RATE&from_currency=${fromCurrency}&to_currency=${toCurrency}&apikey=${this.apiKey}`;
                const response = await fetch(url);
                const data = await response.json();

                if (data['Realtime Currency Exchange Rate']) {
                    const rateData = data['Realtime Currency Exchange Rate'];
                    return {
                        price: parseFloat(rateData['5. Exchange Rate']),
                        change: parseFloat(rateData['9. Change']),
                        percentChange: parseFloat(rateData['10. Change Percent'])
                    };
                }
                return null;
            } catch (error) {
                console.error('Error fetching Forex data:', error);
                return null;
            }
        }

        async getCryptoPrice(symbol) {
            try {
                const url =
                    `${this.baseURL}?function=CURRENCY_EXCHANGE_RATE&from_currency=${symbol}&to_currency=USD&apikey=${this.apiKey}`;
                const response = await fetch(url);
                const data = await response.json();

                if (data['Realtime Currency Exchange Rate']) {
                    const rateData = data['Realtime Currency Exchange Rate'];
                    return {
                        price: parseFloat(rateData['5. Exchange Rate']),
                        change: parseFloat(rateData['9. Change']),
                        percentChange: parseFloat(rateData['10. Change Percent'])
                    };
                }
                return null;
            } catch (error) {
                console.error('Error fetching Crypto data:', error);
                return null;
            }
        }
    }

    // Initialize when page loads
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize WebSocket (simulated)
        const forexWebSocket = new ForexWebSocket();

        // Initialize Alpha Vantage API (replace with your API key)
        const alphaVantage = new AlphaVantageAPI('GA8X8DJQE0M62KOT');

        // Fetch initial data
        fetchInitialData();

        async function fetchInitialData() {
            // Example: Fetch EUR/USD rate
            const eurUsdData = await alphaVantage.getForexRate('EUR', 'USD');
            if (eurUsdData) {
                updateForexUI('EUR/USD', eurUsdData);
            }

            // Example: Fetch Gold price
            const goldData = await alphaVantage.getForexRate('XAU', 'USD');
            if (goldData) {
                updateForexUI('XAU/USD', goldData);
            }
        }

        function updateForexUI(symbol, data) {
            const priceElement = document.querySelector(`[data-forex-symbol="${symbol}"]`);
            const changeElement = document.querySelector(`[data-forex-change="${symbol}"]`);

            if (priceElement && changeElement) {
                priceElement.textContent = data.price.toFixed(4);
                priceElement.classList.remove('loading');

                const changeValue = data.percentChange;
                changeElement.innerHTML = `
                <span class="trade-icon">${changeValue >= 0 ? '↗' : '↘'}</span>
                <span>${Math.abs(changeValue).toFixed(2)}%</span>
            `;

                changeElement.className = 'crypto-right ' +
                    (changeValue > 0 ? 'positive' : changeValue < 0 ? 'negative' : 'neutral');
            }
        }
    });




    // Combined WebSocket Manager for both Crypto and Forex
    class MarketWebSocketManager {
        constructor() {
            this.cryptoPrices = {};
            this.cryptoChanges = {};
            this.forexPrices = {};
            this.forexChanges = {};
            this.cryptoWebSocket = null;
            this.tickerInterval = null;
            this.updateInterval = null;
            this.tickerItems = [];
            this.currentTickerIndex = 0;
        }

        init() {
            this.startCryptoWebSocket();
            this.startForexSimulation();
            this.startTickerUpdates();
        }

        startCryptoWebSocket() {
            const wsUrl =
                "wss://stream.binance.com:9443/stream?streams=btcusdt@ticker/ethusdt@ticker/bnbusdt@ticker/xrpusdt@ticker/solusdt@ticker";

            this.cryptoWebSocket = new WebSocket(wsUrl);

            this.cryptoWebSocket.onmessage = (event) => {
                try {
                    const data = JSON.parse(event.data);
                    if (data && data.data && data.data.s && data.data.c) {
                        const symbol = data.data.s;
                        this.cryptoPrices[symbol] = parseFloat(data.data.c);
                        this.cryptoChanges[symbol] = parseFloat(data.data.P);
                        this.updateCryptoUI(symbol);
                        this.updateTickerItem(symbol, 'crypto');
                    }
                } catch (e) {
                    console.error("Error parsing WebSocket message:", e);
                }
            };

            this.cryptoWebSocket.onclose = () => {
                setTimeout(() => this.startCryptoWebSocket(), 3000);
            };

            // Update UI every second
            this.updateInterval = setInterval(() => this.updateAllCryptoUI(), 1000);
        }

        startForexSimulation() {
            this.forexSymbols = ['XAU/USD', 'EUR/USD', 'GBP/USD', 'USD/JPY', 'XAG/USD'];

            // Initialize with base prices
            this.forexBasePrices = {
                'EUR/USD': 1.0850,
                'GBP/USD': 1.2650,
                'USD/JPY': 148.50,
                'XAU/USD': 2030.00,
                'XAG/USD': 23.50
            };

            // Set initial values
            this.forexSymbols.forEach(symbol => {
                this.forexPrices[symbol] = this.forexBasePrices[symbol];
                this.forexChanges[symbol] = 0;
            });

            // Simulate updates every 3 seconds
            setInterval(() => this.simulateForexUpdates(), 3000);

            // Initial UI update
            setTimeout(() => {
                this.forexSymbols.forEach(symbol => {
                    this.updateForexUI(symbol);
                    this.updateTickerItem(symbol, 'forex');
                });
            }, 1000);
        }

        simulateForexUpdates() {
            this.forexSymbols.forEach(symbol => {
                const basePrice = this.forexBasePrices[symbol];
                const change = (Math.random() - 0.5) * 0.02;
                this.forexPrices[symbol] = basePrice * (1 + change);
                this.forexChanges[symbol] = change * 100;

                this.updateForexUI(symbol);
                this.updateTickerItem(symbol, 'forex');
            });
        }

        updateCryptoUI(symbol) {
            const price = this.cryptoPrices[symbol];
            const change = this.cryptoChanges[symbol];

            if (price && change !== undefined) {
                // Update card UI
                const priceElements = document.querySelectorAll(`[data-symbol="${symbol}"]`);
                priceElements.forEach(el => {
                    el.textContent = "$" + price.toLocaleString(undefined, {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    });
                    el.classList.remove('loading');
                });

                const changeElements = document.querySelectorAll(`[data-change="${symbol}"]`);
                changeElements.forEach(el => {
                    const isPositive = change > 0;
                    const isNegative = change < 0;

                    el.classList.remove('positive', 'negative', 'neutral');
                    el.classList.add(isPositive ? 'positive' : isNegative ? 'negative' : 'neutral');

                    const icon = isPositive ? '▲' : isNegative ? '▼' : '━';
                    const sign = isPositive ? '+' : '';

                    el.innerHTML = `
                        <span class="trade-icon">${icon}</span>
                        <span>${sign}${Math.abs(change).toFixed(2)}%</span>
                    `;
                });
            }
        }

        updateForexUI(symbol) {
            const price = this.forexPrices[symbol];
            const change = this.forexChanges[symbol];

            if (price && change !== undefined) {
                const formattedPrice = symbol.includes('XAU') || symbol.includes('XAG') ?
                    price.toFixed(2) : symbol.includes('USD/JPY') ?
                    price.toFixed(2) : price.toFixed(4);

                // Update card UI
                const priceElement = document.querySelector(`[data-forex-symbol="${symbol}"]`);
                if (priceElement) {
                    priceElement.textContent = formattedPrice;
                    priceElement.classList.remove('loading');
                }

                const changeElement = document.querySelector(`[data-forex-change="${symbol}"]`);
                if (changeElement) {
                    const isPositive = change > 0;
                    const isNegative = change < 0;

                    changeElement.className = 'crypto-right ' +
                        (isPositive ? 'positive' : isNegative ? 'negative' : 'neutral');

                    const icon = isPositive ? '↗' : isNegative ? '↘' : '━';
                    const sign = isPositive ? '+' : '';

                    changeElement.innerHTML = `
                        <span class="trade-icon">${icon}</span>
                        <span>${sign}${Math.abs(change).toFixed(2)}%</span>
                    `;
                }
            }
        }

        updateAllCryptoUI() {
            Object.keys(this.cryptoPrices).forEach(symbol => {
                this.updateCryptoUI(symbol);
            });
        }

        getDisplayName(symbol, type) {
            if (type === 'crypto') {
                const names = {
                    'BTCUSDT': 'Bitcoin',
                    'ETHUSDT': 'Ethereum',
                    'BNBUSDT': 'Binance Coin',
                    'XRPUSDT': 'Ripple',
                    'SOLUSDT': 'Solana'
                };
                return names[symbol] || symbol.replace('USDT', '');
            } else {
                const names = {
                    'EUR/USD': 'Euro / US Dollar',
                    'GBP/USD': 'British Pound / USD',
                    'USD/JPY': 'US Dollar / Japanese Yen',
                    'XAU/USD': 'Gold Spot',
                    'XAG/USD': 'Silver Spot'
                };
                return names[symbol] || symbol;
            }
        }

        // Ticker functionality
        startTickerUpdates() {
            this.updateTicker();
            this.tickerInterval = setInterval(() => this.updateTicker(), 100);
        }

        updateTickerItem(symbol, type) {
            const price = type === 'crypto' ? this.cryptoPrices[symbol] : this.forexPrices[symbol];
            const change = type === 'crypto' ? this.cryptoChanges[symbol] : this.forexChanges[symbol];

            if (!price || change === undefined) return;

            const displayName = this.getDisplayName(symbol, type);
            const displayPrice = type === 'crypto' ?
                `$${price.toFixed(2)}` :
                price.toFixed(type === 'forex' && !symbol.includes('XAU') && !symbol.includes('XAG') ? 4 : 2);

            const tickerItem = {
                symbol: symbol.replace('USDT', '').replace('/', ''),
                name: displayName,
                price: displayPrice,
                change: change,
                type: type
            };

            // Update or add to ticker items
            const existingIndex = this.tickerItems.findIndex(item => item.symbol === tickerItem.symbol);
            if (existingIndex >= 0) {
                this.tickerItems[existingIndex] = tickerItem;
            } else {
                this.tickerItems.push(tickerItem);
            }
        }

        updateTicker() {
            const tickerContainer = document.getElementById('liveTicker');
            if (!tickerContainer) return;

            // Clear and rebuild ticker
            tickerContainer.innerHTML = '';

            // Display all items in ticker (no animation, just display all)
            this.tickerItems.forEach(item => {
                const tickerItem = document.createElement('div');
                tickerItem.className = 'ticker-item';

                const isPositive = item.change > 0;
                const changeClass = isPositive ? 'positive' : 'negative';
                const sign = isPositive ? '+' : '';

                tickerItem.innerHTML = `
                    <span class="ticker-symbol">${item.symbol}</span>
                    <span class="ticker-price">${item.price}</span>
                    <span class="ticker-change ${changeClass}">${sign}${Math.abs(item.change).toFixed(2)}%</span>
                `;

                tickerContainer.appendChild(tickerItem);
            });
        }
    }

    // Initialize everything when DOM is loaded
    document.addEventListener('DOMContentLoaded', function() {
        const marketManager = new MarketWebSocketManager();
        marketManager.init();
    });
</script>
