// Configuration
const CONFIG = {
    // Finnhub API Key - Replace with your own key
    FINNHUB_API_KEY: 'cn7v29pr01qibtjf79lgcn7v29pr01qibtjf79m0',

    // News categories mapping
    CATEGORIES: {
        'general': 'General',
        'crypto': 'Cryptocurrency',
        'forex': 'Forex & Metals',
        'stock': 'Stocks',
        'merger': 'Mergers',
        'ipo': 'IPOs',
        'financial': 'Financial',
        'technology': 'Technology'
    },

    // API Endpoints
    FINNHUB_NEWS_URL: 'https://finnhub.io/api/v1/news',
    FINNHUB_CRYPTO_NEWS_URL: 'https://finnhub.io/api/v1/news',

    // Update intervals (in milliseconds)
    UPDATE_INTERVAL: 60000, // 1 minute
    TICKER_INTERVAL: 5000   // 5 seconds
};

// News Manager Class
class NewsManager {
    constructor() {
        this.currentCategory = 'general';
        this.articles = [];
        this.trendingArticles = [];
        this.lastUpdate = null;
        this.isLoading = false;
    }

    // Initialize news manager
    async init() {
        this.setupEventListeners();
        await this.loadNews();
        this.startAutoRefresh();
    }

    // Setup event listeners
    setupEventListeners() {
        // Category filter buttons
        document.querySelectorAll('.category-btn').forEach(button => {
            button.addEventListener('click', async () => {
                const category = button.dataset.category;
                await this.filterNews(category);

                // Update active button
                document.querySelectorAll('.category-btn').forEach(btn => {
                    btn.classList.remove('active');
                });
                button.classList.add('active');
            });
        });

        // Newsletter subscription
        document.getElementById('newsletterForm').addEventListener('submit', (e) => {
            e.preventDefault();
            const email = e.target.querySelector('.newsletter-input').value;
            if (email) {
                alert(`Thank you for subscribing! Market insights will be sent to ${email}`);
                e.target.reset();
            }
        });

        // Featured article click
        document.getElementById('featuredArticle').addEventListener('click', () => {
            if (this.articles.length > 0) {
                this.openArticle(this.articles[0]);
            }
        });
    }

    // Load news from API
    async loadNews(category = 'general') {
        this.currentCategory = category;
        this.showLoading(true);

        try {
            let url;
            let params = {};

            // Build API URL based on category
            if (category === 'crypto') {
                url = CONFIG.FINNHUB_CRYPTO_NEWS_URL;
                params = {
                    category: 'crypto',
                    token: CONFIG.FINNHUB_API_KEY
                };
            } else {
                url = CONFIG.FINNHUB_NEWS_URL;
                params = {
                    category: category,
                    token: CONFIG.FINNHUB_API_KEY
                };
            }

            // Fetch news
            const response = await fetch(`${url}?${new URLSearchParams(params)}`);

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const data = await response.json();

            // Process and store articles
            this.articles = this.processArticles(data);
            this.lastUpdate = new Date();

            // Update UI
            this.updateFeaturedArticle();
            this.updateNewsGrid();
            this.updateTrendingNews();
            this.updateMarketUpdates();

        } catch (error) {
            console.error('Error fetching news:', error);
            this.showError('Failed to load news. Using sample data...');
            this.loadSampleData();
        } finally {
            this.showLoading(false);
        }
    }

    // Process raw articles from API
    processArticles(articles) {
        return articles.slice(0, 15).map(article => ({
            id: article.id || Math.random().toString(36).substr(2, 9),
            title: article.headline || article.title || 'Market Update',
            excerpt: article.summary || 'No summary available',
            category: article.category || 'general',
            source: article.source || 'Finnhub',
            date: new Date(article.datetime * 1000 || article.publishedAt || Date.now()),
            url: article.url || '#',
            image: article.image || this.getRandomNewsImage(),
            sentiment: article.sentiment || 'neutral'
        }));
    }

    // Get random news image
    getRandomNewsImage() {
        const images = [
            'https://images.unsplash.com/photo-1621761191319-c6fb62004040?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            'https://images.unsplash.com/photo-1620336655055-bd87c5d1d73f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            'https://images.unsplash.com/photo-1611974789855-9c2a0a7236a3?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            'https://images.unsplash.com/photo-1517336714731-489689fd1ca8?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            'https://images.unsplash.com/photo-1553877522-43269d4ea984?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
        ];
        return images[Math.floor(Math.random() * images.length)];
    }

    // Update featured article
    updateFeaturedArticle() {
        if (this.articles.length === 0) return;

        const featured = this.articles[0];
        const featuredElement = document.getElementById('featuredArticle');

        featuredElement.querySelector('#featuredImage').style.backgroundImage = `url('${featured.image}')`;
        featuredElement.querySelector('#featuredTitle').textContent = featured.title;
        featuredElement.querySelector('#featuredExcerpt').textContent = featured.excerpt.length > 200
            ? featured.excerpt.substring(0, 200) + '...'
            : featured.excerpt;
        featuredElement.querySelector('#featuredDate').textContent = this.formatDate(featured.date);
        featuredElement.querySelector('#featuredSource').textContent = featured.source;
    }

    // Update news grid
    updateNewsGrid() {
        const newsGrid = document.getElementById('newsGrid');
        newsGrid.innerHTML = '';

        // Show articles 1-12 (excluding featured which is article 0)
        const gridArticles = this.articles.slice(1, 13);

        gridArticles.forEach((article, index) => {
            const newsCard = document.createElement('div');
            newsCard.className = 'news-card';

            newsCard.innerHTML = `
                        <div class="news-image" style="background-image: url('${article.image}')"></div>
                        <div class="news-content">
                            <span class="news-category">${CONFIG.CATEGORIES[article.category] || 'Market News'}</span>
                            <h4 class="news-title">${article.title}</h4>
                            <p class="news-excerpt">${article.excerpt.length > 150
                    ? article.excerpt.substring(0, 150) + '...'
                    : article.excerpt}</p>
                            <div class="news-meta">
                                <div class="news-date">
                                    <i class="far fa-calendar"></i>
                                    <span>${this.formatDate(article.date)}</span>
                                </div>
                                <div class="news-read-time">
                                    <i class="fas fa-newspaper"></i>
                                    <span>${article.source}</span>
                                </div>
                            </div>
                        </div>
                    `;

            newsCard.addEventListener('click', () => this.openArticle(article));
            newsGrid.appendChild(newsCard);
        });
    }

    // Update trending news sidebar
    updateTrendingNews() {
        const trendingContainer = document.getElementById('trendingNews');
        const trendingItems = trendingContainer.querySelectorAll('.trending-item');

        // Get top 4 trending articles (excluding featured)
        const trendingArticles = this.articles.slice(1, 5);

        trendingItems.forEach((item, index) => {
            if (trendingArticles[index]) {
                const article = trendingArticles[index];
                item.querySelector('.trending-title').textContent = article.title.length > 50
                    ? article.title.substring(0, 50) + '...'
                    : article.title;
                item.querySelector('.trending-meta').textContent = `${article.source} • Trending`;

                item.addEventListener('click', () => this.openArticle(article));
            }
        });
    }

    // Update market updates section
    updateMarketUpdates() {
        const updatesContainer = document.getElementById('marketUpdates');
        const updateCards = updatesContainer.querySelectorAll('.update-card');

        // Get 4 articles for updates
        const updateArticles = this.articles.slice(0, 4);

        updateCards.forEach((card, index) => {
            if (updateArticles[index]) {
                const article = updateArticles[index];
                card.querySelector('.update-title').textContent = article.title.length > 60
                    ? article.title.substring(0, 60) + '...'
                    : article.title;
                card.querySelector('.update-time').textContent = this.getRelativeTime(article.date);
                card.querySelector('.update-content').textContent = article.excerpt.length > 100
                    ? article.excerpt.substring(0, 100) + '...'
                    : article.excerpt;

                // Set border color based on sentiment
                if (article.sentiment === 'positive') {
                    card.style.borderLeftColor = 'var(--green)';
                } else if (article.sentiment === 'negative') {
                    card.style.borderLeftColor = 'var(--red)';
                    card.classList.add('negative');
                }
            }
        });
    }

    // Filter news by category
    async filterNews(category) {
        await this.loadNews(category);
    }

    // Open article in new tab
    openArticle(article) {
        if (article.url && article.url !== '#') {
            window.open(article.url, '_blank');
        } else {
            // Show modal or detailed view
            alert(`${article.title}\n\n${article.excerpt}\n\nSource: ${article.source}\nPublished: ${this.formatDate(article.date)}`);
        }
    }

    // Start auto-refresh
    startAutoRefresh() {
        setInterval(() => {
            this.loadNews(this.currentCategory);
        }, CONFIG.UPDATE_INTERVAL);
    }

    // Show/hide loading spinner
    showLoading(show) {
        document.getElementById('loadingSpinner').style.display = show ? 'block' : 'none';
        this.isLoading = show;
    }

    // Show error message
    showError(message) {
        const newsGrid = document.getElementById('newsGrid');
        newsGrid.innerHTML = `
                    <div class="loading-card">
                        <i class="fas fa-exclamation-triangle fa-2x mb-3" style="color: var(--red);"></i>
                        <p>${message}</p>
                    </div>
                `;
    }

    // Load sample data (fallback)
    loadSampleData() {
        const sampleArticles = [
            {
                id: 1,
                title: "Bitcoin ETF Approval Leads to Market Surge",
                excerpt: "Major financial institutions receive SEC approval for Bitcoin ETFs, causing a 15% surge in BTC prices.",
                category: "crypto",
                source: "MarketWatch",
                date: new Date(),
                url: "#",
                image: "https://images.unsplash.com/photo-1621761191319-c6fb62004040?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80",
                sentiment: "positive"
            },
            {
                id: 2,
                title: "Federal Reserve Holds Interest Rates Steady",
                excerpt: "The Fed maintains current rates while signaling potential cuts later this year amid cooling inflation.",
                category: "general",
                source: "Reuters",
                date: new Date(Date.now() - 3600000),
                url: "#",
                image: "https://images.unsplash.com/photo-1611974789855-9c2a0a7236a3?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80",
                sentiment: "neutral"
            }
        ];

        this.articles = sampleArticles;
        this.updateFeaturedArticle();
        this.updateNewsGrid();
        this.updateTrendingNews();
        this.updateMarketUpdates();
    }

    // Format date
    formatDate(date) {
        return date.toLocaleDateString('en-US', {
            month: 'short',
            day: 'numeric',
            year: 'numeric'
        });
    }

    // Get relative time
    getRelativeTime(date) {
        const now = new Date();
        const diffMs = now - date;
        const diffMins = Math.floor(diffMs / 60000);
        const diffHours = Math.floor(diffMs / 3600000);
        const diffDays = Math.floor(diffMs / 86400000);

        if (diffMins < 1) return 'Just now';
        if (diffMins < 60) return `${diffMins} minute${diffMins === 1 ? '' : 's'} ago`;
        if (diffHours < 24) return `${diffHours} hour${diffHours === 1 ? '' : 's'} ago`;
        if (diffDays < 7) return `${diffDays} day${diffDays === 1 ? '' : 's'} ago`;
        return this.formatDate(date);
    }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', async function () {
    // Initialize news manager
    const newsManager = new NewsManager();
    await newsManager.init();

    // Update time indicator
    function updateTimeIndicator() {
        const timeElement = document.querySelector('.news-hero-subtitle');
        const now = new Date();
        const timeString = now.toLocaleTimeString('en-US', {
            hour: '2-digit',
            minute: '2-digit',
            hour12: true
        });

        if (timeElement) {
            const baseText = 'Real-time financial news from global markets, cryptocurrencies, forex, and stocks. Powered by Finnhub API.';
            timeElement.textContent = `${baseText} Last updated: ${timeString}`;
        }
    }

    // Initial time update
    updateTimeIndicator();

    // Update time every minute
    setInterval(updateTimeIndicator, 60000);
});