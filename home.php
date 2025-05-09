<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Character encoding for the document -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Responsive design for mobile devices -->
    <title>Agro Market Place - Your Fresh Agricultural Marketplace</title> <!-- Title of the webpage -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"> <!-- Font Awesome for icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com"> <!-- Preconnect to Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> <!-- Preconnect for font loading -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"> <!-- Roboto font from Google Fonts -->
    <link rel="stylesheet" href="home.css"> <!-- Link to the custom stylesheet for styling the page -->
</head>
<body>
    <!-- Navigation -->
   <?php include_once 'nav.php';?> <!-- Include the navigation bar from an external PHP file -->

    <!-- Hero Section -->
    <div class="hero"> <!-- Main hero section for the website -->
        <div class="hero-content"> <!-- Content container for hero section -->
            <h1>Fresh From Farm to Table</h1> <!-- Main heading -->
            <p>Connect directly with local farmers and get the freshest agricultural products</p> <!-- Subheading -->
            <a href="catalog.php" class="cta-button">Explore Products</a> <!-- Call-to-action button to explore products -->
        </div>
    </div>

    <!-- Featured Farmers -->
    <section class="farmers"> <!-- Section for featured farmers -->
        <h2>Meet Our Featured Farmers</h2> <!-- Section heading -->
        <div class="farmers-grid"> <!-- Grid container for farmer cards -->
            <div class="farmer-card"> <!-- Individual farmer card -->
                <img src="images/kelvin.png" alt="Farmer Kelvin"> <!-- Farmer image -->
                <h3>Kelvin Farms</h3> <!-- Farmer name -->
                <p>Specializes in Organic Vegetables</p> <!-- Farmer specialization -->
                <span class="rating">⭐ 4.8</span> <!-- Farmer rating -->
            </div>
            <!-- Additional farmer cards -->
            <div class="farmer-card">
                <img src="images/mzfr.avif" alt="Farmer Sarah">
                <h3>Sarah's Dairy</h3>
                <p>High-Quality Dairy Products</p>
                <span class="rating">⭐ 4.9</span>
            </div>
            <div class="farmer-card">
                <img src="images/mercy.avif" alt="Farmer John">
                <h3>John's Grains</h3>
                <p>Sustainable Grains and Cereals</p>
                <span class="rating">⭐ 4.7</span>
            </div>
            <div class="farmer-card">
                <img src="images/sula.avif" alt="Farmer Emma">
                <h3>Emma's Orchards</h3>
                <p>Fresh and Juicy Fruits</p>
                <span class="rating">⭐ 5.0</span>
            </div>
        </div>
    </section>

    <!-- Product Categories -->
    <section class="categories"> <!-- Section for product categories -->
        <h2>Product Categories</h2> <!-- Section heading -->
        <div class="category-grid"> <!-- Grid container for category cards -->
            <a href="catalog.php?category=grains" class="category-card"> <!-- Link to grains category -->
                <div class="category-image">
                    <img src="images/maize.avif" alt="Grains"> <!-- Category image -->
                </div>
                <h3>Grains</h3> <!-- Category name -->
                <p>Fresh harvest from local farms</p> <!-- Category description -->
            </a>
            <!-- Additional category cards -->
            <a href="catalog.php?category=fruits" class="category-card">
                <div class="category-image">
                    <img src="images/berries.avif" alt="Fruits">
                </div>
                <h3>Fruits</h3>
                <p>Seasonal fresh fruits</p>
            </a>
            <a href="catalog.php?category=coffee" class="category-card">
                <div class="category-image">
                    <img src="images/tea paper.avif" alt="Coffee">
                </div>
                <h3>Coffee &