<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farmers' Services - Agro Market Place</title>
    <link rel="stylesheet" href="services.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- SweetAlert2 CSS and JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <?php include_once 'nav.php'; ?>

    <header class="services-header">
        <h1>Our Services</h1>
        <p>Tools and information to help you thrive.</p>
    </header>    <main>
        <section class="services-grid">
            <div class="service-card">
                <i class="fas fa-seedling service-icon"></i>
                <h3>Market Prices</h3>
                <p>Check the latest market prices for various crops and livestock.</p>
                <button onclick="getMarketPrices()">Get Market Prices</button>
                <div id="market-prices" class="service-data-display"></div>
            </div>
            <div class="service-card">
                <i class="fas fa-cloud-sun service-icon"></i>
                <h3>Weather Forecasts</h3>
                <p>Get accurate weather forecasts for your area.</p>
                <button onclick="getWeatherForecast()">Check Weather</button>
                <div id="weather-forecast" class="service-data-display"></div>
            </div>
            <div class="service-card">
                <i class="fas fa-newspaper service-icon"></i>
                <h3>Agricultural News</h3>
                <p>Stay updated with the latest news in agriculture.</p>
                <button onclick="getAgriculturalNews()">Read News</button>
                <div id="agricultural-news" class="service-data-display"></div>
            </div>            <div class="service-card">
                <i class="fas fa-tag service-icon"></i>
                <h3>Product Prices</h3>
                <p>Get detailed price information for agricultural products from FAO database.</p>
                <button onclick="getProductPrices()">Check Product Prices</button>
                <div id="product-prices" class="service-data-display"></div>
            </div>
            
            <div class="service-card">
                <i class="fas fa-chart-line service-icon"></i>
                <h3>Price Tracker</h3>
                <p>Track and register product prices to monitor market trends over time.</p>
                <button onclick="trackProductPrice()">Track Price</button>
                <div id="price-tracker" class="service-data-display"></div>
            </div>
        </section>
        
        <section class="fao-info-section">
            <div class="container">
                <h2>FAO Data Integration</h2>
                <p>Our platform leverages data from the Food and Agriculture Organization (FAO) of the United Nations to provide accurate and up-to-date information on agricultural products, production, and market trends.</p>
                <div class="fao-features">
                    <div class="fao-feature">
                        <i class="fas fa-database"></i>
                        <h4>Comprehensive Database</h4>
                        <p>Access production data for crops worldwide</p>
                    </div>
                    <div class="fao-feature">
                        <i class="fas fa-chart-bar"></i>
                        <h4>Market Analytics</h4>
                        <p>Track price trends and production volumes</p>
                    </div>
                    <div class="fao-feature">
                        <i class="fas fa-globe-americas"></i>
                        <h4>Regional Insights</h4>
                        <p>Compare agricultural data across regions</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> AGRO MARKET PLACE. All Rights Reserved.</p>
    </footer>    <script src="script.js"></script>
    <script>
        // Load tracked prices on page load
        document.addEventListener('DOMContentLoaded', function() {
            const priceTrackerDiv = document.getElementById('price-tracker');
            if (priceTrackerDiv) {
                displayTrackedPrices(priceTrackerDiv);
            }
            
            // Add Bootstrap CSS for tables
            const link = document.createElement('link');
            link.rel = 'stylesheet';
            link.href = 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css';
            document.head.appendChild(link);
        });
    </script>
</body>
</html>