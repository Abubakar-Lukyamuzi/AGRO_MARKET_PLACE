<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Your trusted online marketplace for agricultural products and services">
    <title>Agro Market Place - Welcome</title> <!-- Updated Title -->
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <?php include_once 'nav.php'; ?>
    
    <!-- Hero Section -->
    <div class="hero-section"> <!-- Main hero section for the website -->
        <div class="container"> <!-- Container for hero section content -->
            <div class="row align-items-center"> <!-- Row for hero section content -->
                <div class="col-md-7 text-center text-md-start"> <!-- Adjusted column for text, centered on small screens -->
                    <h1>Welcome to Agro Market Place</h1> <!-- Main heading -->
                    <p>Your trusted online marketplace for agricultural products and services. Freshness delivered.</p> <!-- Subheading -->
                    <a href="catalog.php" class="btn btn-primary btn-lg">Explore Our Products</a> <!-- Call-to-action button to explore products -->
                </div>
                <div class="col-md-5 mt-4 mt-md-0"> <!-- Right column for hero section content -->
                    <img src="images/homepage.avif" alt="Agricultural marketplace" class="img-fluid rounded shadow-lg"> <!-- Hero image with shadow -->
                </div>
            </div>
        </div>
    </div>
    
    <!-- Featured Products -->
    <div class="featured-products"> <!-- Section for featured products -->
        <div class="container"> <!-- Container for featured products content -->
            <h2>Discover Our Featured Products</h2> <!-- Section heading -->
            <div class="row g-4"> <!-- Row for featured products content -->
                <div class="col-lg-3 col-md-6"> <!-- Product card 1 -->
                    <div class="product-card h-100">
                        <img src="images/agri.jpg" alt="Fresh Produce" class="card-img-top"> <!-- Product image -->
                        <div class="card-body d-flex flex-column"> <!-- Product card body -->
                            <h5 class="card-title">Vibrant Fresh Produce</h5> <!-- Product title -->
                            <p class="card-text mb-4">High-quality fruits and vegetables directly from local farms, bursting with flavor.</p> <!-- Product description -->
                            <a href="cat.php#fruits" class="btn btn-outline-primary mt-auto">View Produce</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6"> <!-- Product card 2 -->
                    <div class="product-card h-100">
                        <img src="images/dairy.jpeg" alt="Dairy Products" class="card-img-top"> <!-- Product image -->
                        <div class="card-body d-flex flex-column"> <!-- Product card body -->
                            <h5 class="card-title">Artisanal Dairy Products</h5> <!-- Product title -->
                            <p class="card-text mb-4">Fresh and organic dairy selections from trusted local suppliers.</p> <!-- Product description -->
                            <a href="cat.php#dairy" class="btn btn-outline-primary mt-auto">View Dairy</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6"> <!-- Product card 3 -->
                    <div class="product-card h-100">
                        <img src="images/grains.avif" alt="Grains and Cereals" class="card-img-top"> <!-- Product image -->
                        <div class="card-body d-flex flex-column"> <!-- Product card body -->
                            <h5 class="card-title">Wholesome Grains & Cereals</h5> <!-- Product title -->
                            <p class="card-text mb-4">Sustainable and nutritious grains and cereals for your healthy kitchen.</p> <!-- Product description -->
                            <a href="cat.php#grains" class="btn btn-outline-primary mt-auto">View Grains</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6"> <!-- Product card 4 -->
                    <div class="product-card h-100">
                        <img src="images/berries.avif" alt="Livestock and Feed" class="card-img-top"> <!-- Product image -->
                        <div class="card-body d-flex flex-column"> <!-- Product card body -->
                            <h5 class="card-title">Quality Livestock & Feed</h5> <!-- Product title -->
                            <p class="card-text mb-4">Top-quality livestock and essential animal feed for your farming needs.</p> <!-- Product description -->
                            <a href="cat.php#livestock" class="btn btn-outline-primary mt-auto">View Livestock</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include_once 'footer.php'; ?>

</body>
</html>