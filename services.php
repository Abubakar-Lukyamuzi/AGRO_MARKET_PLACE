<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farmers' Services - Agro Market Place</title>
    <link rel="stylesheet" href="services.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php include_once 'nav.php'; ?>

    <header class="services-header">
        <h1>Our Services</h1>
        <p>Tools and information to help you thrive.</p>
    </header>

    <main>
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
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> AGRO MARKET PLACE. All Rights Reserved.</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>