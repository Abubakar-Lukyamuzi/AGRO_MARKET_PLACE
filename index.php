<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Character encoding for the document -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Responsive design for mobile devices -->
    <meta name="description" content="Your trusted online marketplace for agricultural products and services"> <!-- Meta description for search engines -->
    <title>Agro Market Place - Agricultural Marketplace</title> <!-- Title of the webpage -->
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com"> <!-- Preconnect to Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> <!-- Preconnect for font loading -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"> <!-- Roboto font from Google Fonts -->
    
    <link rel="stylesheet" href="index.css"> <!-- Link to the custom stylesheet for styling the page -->
</head>
<body>
    <!-- Navigation -->
    <?php
    include_once 'nav.php'; // Include the navigation bar from an external PHP file
    ?>
    
    <!-- Hero Section -->
    <div class="hero-section"> <!-- Main hero section for the website -->
        <div class="container"> <!-- Container for hero section content -->
            <div class="row align-items-center"> <!-- Row for hero section content -->
                <div class="col-md-6"> <!-- Left column for hero section content -->
                    <h1>Welcome to Agro Market Place</h1> <!-- Main heading -->
                    <p>Your trusted online marketplace for agricultural products and services.</p> <!-- Subheading -->
                    <a href="cat.php" class="btn btn-primary btn-lg">Explore Products</a> <!-- Call-to-action button to explore products -->
                </div>
                <div class="col-md-6"> <!-- Right column for hero section content -->
                    <img src="images/agri2.jpg" alt="Agricultural marketplace" class="img-fluid rounded"> <!-- Hero image -->
                </div>
            </div>
        </div>
    </div>
    
    <!-- Featured Products -->
    <div class="featured-products"> <!-- Section for featured products -->
        <div class="container"> <!-- Container for featured products content -->
            <h2>Featured Products</h2> <!-- Section heading -->
            <div class="row g-4"> <!-- Row for featured products content -->
                <div class="col-lg-3 col-md-6"> <!-- Product card 1 -->
                    <div class="product-card">
                        <img src="images/agri.jpg" alt="Product 1" class="card-img-top"> <!-- Product image -->
                        <div class="card-body"> <!-- Product card body -->
                            <h5 class="card-title">Fresh Produce</h5> <!-- Product title -->
                            <p class="card-text">High-quality fruits and vegetables directly from local farms.</p> <!-- Product description -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6"> <!-- Product card 2 -->
                    <div class="product-card">
                        <img src="images/dairy.jpeg" alt="Product 2" class="card-img-top"> <!-- Product image -->
                        <div class="card-body"> <!-- Product card body -->
                            <h5 class="card-title">Dairy Products</h5> <!-- Product title -->
                            <p class="card-text">Fresh and organic dairy products from trusted suppliers.</p> <!-- Product description -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6"> <!-- Product card 3 -->
                    <div class="product-card">
                        <img src="images/beans.avif" alt="Product 3" class="card-img-top"> <!-- Product image -->
                        <div class="card-body"> <!-- Product card body -->
                            <h5 class="card-title">Grains and Cereals</h5> <!-- Product title -->
                            <p class="card-text">Sustainable and nutritious grains and cereals for your kitchen.</p> <!-- Product description -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6"> <!-- Product card 4 -->
                    <div class="product-card">
                        <img src="images/berries.avif" alt="Product 4" class="card-img-top"> <!-- Product image -->
                        <div class="card-body"> <!-- Product card body -->
                            <h5 class="card-title">Livestock and Feed</h5> <!-- Product title -->
                            <p class="card-text">Quality livestock and animal feed for your farming needs.</p> <!-- Product description -->
                        </div>
                    </div>