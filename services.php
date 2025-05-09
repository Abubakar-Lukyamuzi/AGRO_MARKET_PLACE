
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farmers' Services</title>
    <link rel="stylesheet" href="services.css">
</head>
<body>
    <header>
        <h1>Farmers' Services</h1>
        <?php
 include_once 'nav.php';
 ?>
    </header>

    <main>
        <section class="services-section">
            <h2>Our Services</h2>
            <div class="service">
                <h3>Market Prices</h3>
                <p>Check the latest market prices for various crops and livestock.</p>
                <button onclick="getMarketPrices()">Get Market Prices</button>
                <div id="market-prices"></div>
            </div>
            <div class="service">
                <h3>Weather Forecasts</h3>
                <p>Get accurate weather forecasts for your area.</p>
                <button onclick="getWeatherForecast()">Check Weather</button>
                <div id="weather-forecast"></div>
            </div>
            <div class="service">
                <h3>Agricultural News</h3>
                <p>Stay updated with the latest news in agriculture.</p>
                <button onclick="getAgriculturalNews()">Read News</button>
                <div id="agricultural-news"></div>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 >AGRO MARKET PLACE. All Rights Reserved.</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>