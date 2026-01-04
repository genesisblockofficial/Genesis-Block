 <!-- Main Content -->
 <section class="section-container">
     <div class="container">
         <!-- News Categories -->
         <div class="news-categories">
             <button class="category-btn active" data-category="general">All News</button>
             <button class="category-btn" data-category="crypto">Cryptocurrency</button>
             <button class="category-btn" data-category="forex">Forex & Metals</button>
             <button class="category-btn" data-category="stock">Stocks</button>
             <button class="category-btn" data-category="merger">Mergers & Acquisitions</button>
             <button class="category-btn" data-category="ipo">IPOs</button>
         </div>

         <!-- Loading Spinner -->
         <div class="loading-spinner" id="loadingSpinner"></div>

         <!-- Featured News -->
         <div class="featured-news" id="featuredNews">
             <div class="featured-main" id="featuredArticle">
                 <div class="featured-image" id="featuredImage"></div>
                 <div class="featured-content">
                     <span class="featured-badge">LATEST NEWS</span>
                     <h2 class="featured-title" id="featuredTitle">Loading latest market news...</h2>
                     <p class="featured-excerpt" id="featuredExcerpt">Fetching real-time market updates from global
                         financial sources.</p>
                     <div class="news-meta">
                         <div class="news-date">
                             <i class="far fa-calendar"></i>
                             <span id="featuredDate">Just now</span>
                         </div>
                         <div class="news-read-time">
                             <i class="far fa-clock"></i>
                             <span id="featuredSource">Loading source...</span>
                         </div>
                     </div>
                 </div>
             </div>

             <div class="featured-sidebar" id="trendingNews">
                 <div class="trending-item">
                     <div class="trending-rank">1</div>
                     <h3 class="trending-title">Loading...</h3>
                     <div class="trending-meta">Fetching trending topics</div>
                 </div>
                 <div class="trending-item">
                     <div class="trending-rank">2</div>
                     <h3 class="trending-title">Loading...</h3>
                     <div class="trending-meta">Fetching trending topics</div>
                 </div>
                 <div class="trending-item">
                     <div class="trending-rank">3</div>
                     <h3 class="trending-title">Loading...</h3>
                     <div class="trending-meta">Fetching trending topics</div>
                 </div>
                 <div class="trending-item">
                     <div class="trending-rank">4</div>
                     <h3 class="trending-title">Loading...</h3>
                     <div class="trending-meta">Fetching trending topics</div>
                 </div>
             </div>
         </div>

         <!-- News Grid -->
         <div class="news-grid" id="newsGrid">
             <div class="loading-card">
                 <div class="loading-spinner" style="display: block;"></div>
                 <p class="mt-3">Fetching real-time market news...</p>
             </div>
         </div>

         <!-- Market Updates -->
         <div class="market-updates">
             <div class="container">
                 <h2 class="section-title">Live Market Updates</h2>
                 <div class="row" id="marketUpdates">
                     <div class="col-md-6">
                         <div class="update-card">
                             <div class="update-title">Loading market updates...</div>
                             <div class="update-time">Just now</div>
                             <div class="update-content">Fetching real-time market information</div>
                         </div>
                     </div>
                     <div class="col-md-6">
                         <div class="update-card">
                             <div class="update-title">Loading market updates...</div>
                             <div class="update-time">Just now</div>
                             <div class="update-content">Fetching real-time market information</div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>

         <!-- Newsletter Section -->
         <div class="newsletter-section">
             <h2 class="newsletter-title">Stay Ahead of the Market</h2>
             <p class="newsletter-subtitle">Get daily market insights, breaking news, and expert analysis delivered
                 directly to your inbox.</p>
             <form class="newsletter-form" id="newsletterForm">
                 <input type="email" class="newsletter-input" placeholder="Enter your email address" required>
                 <button type="submit" class="btn btn-primary">Subscribe Now</button>
             </form>
         </div>
     </div>
 </section>
