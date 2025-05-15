<?php
include('config.php');

// Only start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['username'])) {
    header("location:login.php");
    exit();
}
$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Character encoding for the document -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Responsive design for mobile devices -->
    <title>Agro Marketplace - Fresh From Farm to Table</title> <!-- Title of the webpage -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"> <!-- Font Awesome for icons -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #27ae60;
            --primary-dark: #219653;
            --primary-light: #6fcf97;
            --secondary-color: #f39c12;
            --secondary-dark: #e67e22;
            --text-color: #2d3436;
            --text-light: #636e72;
            --background-color: #f5f6fa;
            --card-color: #ffffff;
            --border-radius: 12px;
            --shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            --animation-duration: 0.3s;
        }

        [data-theme="dark"] {
            --primary-color: #2ecc71;
            --primary-dark: #27ae60;
            --primary-light: #55efc4;
            --secondary-color: #f39c12;
            --secondary-dark: #e67e22;
            --text-color: #f5f6fa;
            --text-light: #dfe6e9;
            --background-color: #2d3436;
            --card-color: #1e272e;
            --shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: var(--background-color);
            color: var(--text-color);
            transition: background-color var(--animation-duration) ease;
        }

        /* Custom Navbar Styling */
        .custom-navbar {
            background-color: var(--card-color);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            transition: all var(--animation-duration) ease;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--primary-color) !important;
        }

        .navbar-brand img {
            width: 40px;
            margin-right: 10px;
        }

        .nav-link {
            color: var(--text-color) !important;
            font-weight: 500;
            position: relative;
            margin: 0 5px;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            color: var(--primary-color) !important;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background-color: var(--primary-color);
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .nav-link.active::after {
            width: 100%;
        }

        .user-profile {
            display: flex;
            align-items: center;
            margin-left: 20px;
        }

        .user-image {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-color: var(--primary-light);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            margin-right: 10px;
        }

        .user-name {
            font-weight: 600;
            color: var(--text-color);
        }

        .dropdown-menu {
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border: none;
            padding: 0.5rem;
            min-width: 200px;
            background-color: var(--card-color);
        }

        .dropdown-item {
            color: var(--text-color);
            padding: 0.5rem 1rem;
            border-radius: 5px;
            transition: all 0.2s ease;
        }

        .dropdown-item:hover {
            background-color: var(--primary-light);
            color: white;
        }

        .dropdown-item i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        /* Theme Toggle Button */
        .theme-toggle {
            background: transparent;
            border: none;
            color: var(--text-color);
            font-size: 1.2rem;
            cursor: pointer;
            margin-right: 15px;
            transition: transform var(--animation-duration) ease;
        }

        .theme-toggle:hover {
            transform: rotate(30deg);
        }

        /* Hero Section */
        .hero {
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('images/agri2.jpg');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 8rem 2rem;
            text-align: center;
            border-radius: 0 0 var(--border-radius) var(--border-radius);
            margin-bottom: 4rem;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(39, 174, 96, 0.7), rgba(39, 174, 96, 0));
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 800px;
            margin: 0 auto;
        }

        .hero h1 {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            animation: fadeInDown 1s ease;
        }

        .hero p {
            font-size: 1.5rem;
            margin-bottom: 2rem;
            animation: fadeInUp 1s ease;
        }

        .cta-button {
            display: inline-block;
            background-color: var(--primary-color);
            color: white;
            text-decoration: none;
            font-size: 1.3rem;
            font-weight: 600;
            padding: 1.2rem 2.5rem;
            border-radius: 50px;
            transition: all 0.3s ease;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            animation: fadeInUp 1.2s ease;
            border: none;
        }

        .cta-button:hover {
            background-color: var(--primary-dark);
            transform: translateY(-5px);
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.3);
            color: white;
        }

        .search-container {
            display: flex;
            justify-content: center;
            margin-top: 2rem;
            animation: fadeIn 1.5s ease;
        }

        .search-bar {
            display: flex;
            max-width: 600px;
            width: 100%;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 50px;
            padding: 0.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .search-input {
            flex-grow: 1;
            border: none;
            background: transparent;
            padding: 0.5rem 1rem;
            font-size: 1rem;
            outline: none;
            color: var(--text-color);
        }

        .search-button {
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 50px;
            padding: 0.5rem 1.5rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .search-button:hover {
            background-color: var(--primary-dark);
        }

        /* Stats Counter Section */
        .stats-counter {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: -60px;
            margin-bottom: 4rem;
            position: relative;
            z-index: 10;
        }

        .counter-item {
            background-color: var(--card-color);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            padding: 2rem;
            margin: 0 1rem;
            text-align: center;
            min-width: 200px;
            flex: 1;
            transition: all 0.3s ease;
        }

        .counter-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }

        .counter-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        .counter-label {
            font-size: 1rem;
            color: var(--text-light);
            font-weight: 500;
        }

        .counter-icon {
            font-size: 2rem;
            color: var(--primary-light);
            margin-bottom: 1rem;
        }

        /* Section Title Styling */
        .section-title {
            text-align: center;
            margin-bottom: 3rem;
            position: relative;
        }

        .section-title h2 {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--text-color);
            display: inline-block;
            position: relative;
            z-index: 1;
        }

        .section-title h2::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 70px;
            height: 4px;
            background-color: var(--primary-color);
            border-radius: 10px;
        }

        .section-title p {
            color: var(--text-light);
            font-size: 1.1rem;
            max-width: 700px;
            margin: 1rem auto 0;
        }

        /* Featured Farmers Section */
        .farmers {
            padding: 4rem 2rem;
            background-color: var(--background-color);
        }

        .farmers-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
        }

        .farmer-card {
            background-color: var(--card-color);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .farmer-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }

        .farmer-banner {
            height: 120px;
            background: linear-gradient(to right, var(--primary-color), var(--primary-light));
            position: relative;
        }

        .farmer-photo {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid var(--card-color);
            position: absolute;
            left: 20px;
            bottom: -50px;
        }

        .farmer-content {
            padding: 60px 20px 20px;
            text-align: left;
        }

        .farmer-name {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--text-color);
        }

        .farmer-specialty {
            color: var(--text-light);
            margin-bottom: 1rem;
        }

        .rating {
            color: var(--secondary-color);
            margin-bottom: 1rem;
            display: block;
        }

        .farmer-stats {
            display: flex;
            justify-content: space-between;
            padding-top: 1rem;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
        }

        .stat {
            text-align: center;
        }

        .stat-value {
            font-weight: 600;
            font-size: 1.1rem;
            color: var(--text-color);
        }

        .stat-label {
            font-size: 0.8rem;
            color: var(--text-light);
        }

        .view-profile {
            display: inline-block;
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            margin-top: 1rem;
            transition: all 0.3s ease;
        }

        .view-profile:hover {
            color: var(--primary-dark);
        }

        .view-profile i {
            margin-left: 5px;
            transition: transform 0.3s ease;
        }

        .view-profile:hover i {
            transform: translateX(5px);
        }

        /* Animations */
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        /* Responsive Styling */
        @media (max-width: 992px) {
            .hero h1 {
                font-size: 3rem;
            }
            
            .counter-item {
                margin: 0.5rem;
                min-width: 160px;
            }
        }

        @media (max-width: 768px) {
            .hero {
                padding: 6rem 1rem;
            }
            
            .hero h1 {
                font-size: 2.5rem;
            }
            
            .hero p {
                font-size: 1.2rem;
            }
            
            .cta-button {
                font-size: 1.1rem;
                padding: 1rem 2rem;
            }
            
            .stats-counter {
                flex-direction: column;
                align-items: center;
                margin-top: -30px;
            }
            
            .counter-item {
                width: 80%;
                max-width: 300px;
                margin: 0.5rem 0;
            }
            
            .section-title h2 {
                font-size: 2rem;
            }
        }

        @media (max-width: 576px) {
            .hero h1 {
                font-size: 2rem;
            }
            
            .search-bar {
                flex-direction: column;
                background: transparent;
                box-shadow: none;
            }
            
            .search-input {
                background-color: rgba(255, 255, 255, 0.9);
                border-radius: 50px;
                margin-bottom: 0.5rem;
                padding: 0.8rem 1rem;
            }
            
            .search-button {
                width: 100%;
                padding: 0.8rem;
            }
            
            .counter-item {
                width: 100%;
            }
            
            .farmers-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg custom-navbar">
        <div class="container">
            <a class="navbar-brand" href="home.php">
                <img src="assets/images/logo.png" alt="Agro Marketplace Logo" onerror="this.src='https://cdn-icons-png.flaticon.com/512/1532/1532688.png';">
                AGRO MARKETPLACE
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cat.php">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="catalog.php">Buy</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about_us.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="services.php">Services</a>
                    </li>
                </ul>
                
                <button id="themeToggle" class="theme-toggle">
                    <i class="fas fa-moon"></i>
                </button>
                
                <div class="dropdown">
                    <div class="user-profile" data-bs-toggle="dropdown">
                        <div class="user-image">
                            <?php echo substr($username, 0, 1); ?>
                        </div>
                        <div class="user-name"><?php echo $username; ?></div>
                        <i class="fas fa-chevron-down ms-2"></i>
                    </div>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="profile.php"><i class="fas fa-user"></i> My Profile</a></li>
                        <li><a class="dropdown-item" href="orders.php"><i class="fas fa-shopping-bag"></i> My Orders</a></li>
                        <li><a class="dropdown-item" href="favorites.php"><i class="fas fa-heart"></i> Favorites</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero">
        <div class="hero-content">
            <h1>Fresh From Farm to Table</h1>
            <p>Connect directly with local farmers and get the freshest agricultural products</p>
            <a href="catalog.php" class="cta-button">Explore Products</a>
            
            <div class="search-container">
                <div class="search-bar">
                    <input type="text" class="search-input" placeholder="Search for products, farmers...">
                    <button class="search-button">Search</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Counter -->
    <div class="container">
        <div class="stats-counter">
            <div class="counter-item">
                <div class="counter-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="counter-number">1,200+</div>
                <div class="counter-label">Farmers</div>
            </div>
            <div class="counter-item">
                <div class="counter-icon">
                    <i class="fas fa-seedling"></i>
                </div>
                <div class="counter-number">5,000+</div>
                <div class="counter-label">Products</div>
            </div>
            <div class="counter-item">
                <div class="counter-icon">
                    <i class="fas fa-truck"></i>
                </div>
                <div class="counter-number">15,000+</div>
                <div class="counter-label">Deliveries</div>
            </div>
            <div class="counter-item">
                <div class="counter-icon">
                    <i class="fas fa-smile"></i>
                </div>
                <div class="counter-number">98%</div>
                <div class="counter-label">Satisfaction</div>
            </div>
        </div>
    </div>

    <!-- Featured Farmers Section -->
    <section class="farmers">
        <div class="container">
            <div class="section-title">
                <h2>Meet Our Featured Farmers</h2>
                <p>Connect with experienced farmers who provide the highest quality produce fresh from their farms</p>
            </div>
            
            <div class="farmers-grid">
                <div class="farmer-card">
                    <div class="farmer-banner">
                        <img src="images/kelvin.png" alt="Farmer Kelvin" class="farmer-photo">
                    </div>
                    <div class="farmer-content">
                        <h3 class="farmer-name">Kelvin Farms</h3>
                        <p class="farmer-specialty">Organic Vegetables</p>
                        <span class="rating">⭐ 4.8 (120 reviews)</span>
                        <div class="farmer-stats">
                            <div class="stat">
                                <div class="stat-value">156</div>
                                <div class="stat-label">Products</div>
                            </div>
                            <div class="stat">
                                <div class="stat-value">25</div>
                                <div class="stat-label">Years</div>
                            </div>
                            <div class="stat">
                                <div class="stat-value">12K+</div>
                                <div class="stat-label">Customers</div>
                            </div>
                        </div>
                        <a href="#" class="view-profile">View Profile <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
                
                <div class="farmer-card">
                    <div class="farmer-banner">
                        <img src="images/mzfr.avif" alt="Farmer Sarah" class="farmer-photo">
                    </div>
                    <div class="farmer-content">
                        <h3 class="farmer-name">Sarah's Dairy</h3>
                        <p class="farmer-specialty">High-Quality Dairy Products</p>
                        <span class="rating">⭐ 4.9 (98 reviews)</span>
                        <div class="farmer-stats">
                            <div class="stat">
                                <div class="stat-value">89</div>
                                <div class="stat-label">Products</div>
                            </div>
                            <div class="stat">
                                <div class="stat-value">15</div>
                                <div class="stat-label">Years</div>
                            </div>
                            <div class="stat">
                                <div class="stat-value">8K+</div>
                                <div class="stat-label">Customers</div>
                            </div>
                        </div>
                        <a href="#" class="view-profile">View Profile <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
                
                <div class="farmer-card">
                    <div class="farmer-banner">
                        <img src="images/mercy.avif" alt="Farmer John" class="farmer-photo">
                    </div>
                    <div class="farmer-content">
                        <h3 class="farmer-name">John's Grains</h3>
                        <p class="farmer-specialty">Sustainable Grains and Cereals</p>
                        <span class="rating">⭐ 4.7 (84 reviews)</span>
                        <div class="farmer-stats">
                            <div class="stat">
                                <div class="stat-value">124</div>
                                <div class="stat-label">Products</div>
                            </div>
                            <div class="stat">
                                <div class="stat-value">18</div>
                                <div class="stat-label">Years</div>
                            </div>
                            <div class="stat">
                                <div class="stat-value">10K+</div>
                                <div class="stat-label">Customers</div>
                            </div>
                        </div>
                        <a href="#" class="view-profile">View Profile <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
                
                <div class="farmer-card">
                    <div class="farmer-banner">
                        <img src="images/sula.avif" alt="Farmer Emma" class="farmer-photo">
                    </div>
                    <div class="farmer-content">
                        <h3 class="farmer-name">Emma's Orchards</h3>
                        <p class="farmer-specialty">Fresh and Juicy Fruits</p>
                        <span class="rating">⭐ 5.0 (145 reviews)</span>
                        <div class="farmer-stats">
                            <div class="stat">
                                <div class="stat-value">112</div>
                                <div class="stat-label">Products</div>
                            </div>
                            <div class="stat">
                                <div class="stat-value">22</div>
                                <div class="stat-label">Years</div>
                            </div>
                            <div class="stat">
                                <div class="stat-value">15K+</div>
                                <div class="stat-label">Customers</div>
                            </div>
                        </div>
                        <a href="#" class="view-profile">View Profile <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Product Categories Section -->
    <section class="categories py-5">
        <div class="container">
            <div class="section-title">
                <h2>Product Categories</h2>
                <p>Browse through our wide range of fresh agricultural products</p>
            </div>
            
            <div class="row g-4">
                <div class="col-md-4 col-sm-6">
                    <a href="catalog.php" class="category-card">
                        <div class="card h-100 border-0 rounded-4 shadow-sm overflow-hidden">
                            <div class="category-image">
                                <img src="images/maize.avif" alt="Grains" class="img-fluid">
                                <div class="category-overlay">
                                    <span>View Products</span>
                                </div>
                            </div>
                            <div class="card-body text-center">
                                <div class="category-icon">
                                    <i class="fas fa-wheat-alt"></i>
                                </div>
                                <h3>Grains</h3>
                                <p>Fresh harvest from local farms</p>
                            </div>
                        </div>
                    </a>
                </div>
                
                <div class="col-md-4 col-sm-6">
                    <a href="catalog.php" class="category-card">
                        <div class="card h-100 border-0 rounded-4 shadow-sm overflow-hidden">
                            <div class="category-image">
                                <img src="images/berries.avif" alt="Fruits" class="img-fluid">
                                <div class="category-overlay">
                                    <span>View Products</span>
                                </div>
                            </div>
                            <div class="card-body text-center">
                                <div class="category-icon">
                                    <i class="fas fa-apple-alt"></i>
                                </div>
                                <h3>Fruits</h3>
                                <p>Seasonal fresh fruits</p>
                            </div>
                        </div>
                    </a>
                </div>
                
                <div class="col-md-4 col-sm-6">
                    <a href="catalog.php" class="category-card">
                        <div class="card h-100 border-0 rounded-4 shadow-sm overflow-hidden">
                            <div class="category-image">
                                <img src="images/tea paper.avif" alt="Coffee" class="img-fluid">
                                <div class="category-overlay">
                                    <span>View Products</span>
                                </div>
                            </div>
                            <div class="card-body text-center">
                                <div class="category-icon">
                                    <i class="fas fa-mug-hot"></i>
                                </div>
                                <h3>Coffee & Tea</h3>
                                <p>Organic coffee and tea</p>
                            </div>
                        </div>
                    </a>
                </div>
                
                <div class="col-md-4 col-sm-6">
                    <a href="catalog.php" class="category-card">
                        <div class="card h-100 border-0 rounded-4 shadow-sm overflow-hidden">
                            <div class="category-image">
                                <img src="images/vegetables.jpg" alt="Vegetables" class="img-fluid" onerror="this.src='https://img.freepik.com/free-photo/vegetables-set-left-black-slate_1220-685.jpg'">
                                <div class="category-overlay">
                                    <span>View Products</span>
                                </div>
                            </div>
                            <div class="card-body text-center">
                                <div class="category-icon">
                                    <i class="fas fa-carrot"></i>
                                </div>
                                <h3>Vegetables</h3>
                                <p>Fresh organic vegetables</p>
                            </div>
                        </div>
                    </a>
                </div>
                
            </div>
        </div>
    </section>

    <!-- Dark Mode Toggle Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Theme toggle functionality
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM fully loaded');
            const themeToggle = document.getElementById('themeToggle');
            if (!themeToggle) {
                console.error('Theme toggle button not found');
                return;
            }
            
            const themeIcon = themeToggle.querySelector('i');
            
            // Check for saved theme preference or default to 'light'
            const savedTheme = localStorage.getItem('theme') || 'light';
            console.log('Saved theme:', savedTheme);
            
            // Apply theme on initial load
            setTheme(savedTheme);
            
            // Handle theme toggle click
            themeToggle.addEventListener('click', function() {
                console.log('Theme toggle clicked');
                const currentTheme = document.body.getAttribute('data-theme') || 'light';
                const newTheme = currentTheme === 'light' ? 'dark' : 'light';
                
                setTheme(newTheme);
                
                // Save preference to localStorage
                localStorage.setItem('theme', newTheme);
            });
            
            // Function to set the theme
            function setTheme(theme) {
                console.log('Setting theme to:', theme);
                document.body.setAttribute('data-theme', theme);
                
                // Update theme icon
                if (theme === 'dark') {
                    themeIcon.classList.remove('fa-moon');
                    themeIcon.classList.add('fa-sun');
                } else {
                    themeIcon.classList.remove('fa-sun');
                    themeIcon.classList.add('fa-moon');
                }
            }
        });

        // FAO API Integration
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.querySelector('.search-input');
            const searchButton = document.querySelector('.search-button');
            
            if (searchInput && searchButton) {
                // Handle search button click
                searchButton.addEventListener('click', function() {
                    performSearch(searchInput.value.trim());
                });
                
                // Handle Enter key press in search input
                searchInput.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        performSearch(searchInput.value.trim());
                    }
                });
            }
            
            // Function to perform search
            function performSearch(query) {
                if (!query) {
                    showNotification('Please enter a search term');
                    return;
                }
                
                showNotification('Searching agricultural data...');
                
                // Show loading indicator
                const loadingIndicator = document.createElement('div');
                loadingIndicator.id = 'searchLoadingIndicator';
                loadingIndicator.className = 'search-loading';
                loadingIndicator.innerHTML = `
                    <div class="spinner-border text-success" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p>Searching for agricultural data...</p>
                `;
                document.body.appendChild(loadingIndicator);
                
                // Call FAO AGROVOC API for agricultural terms
                searchAGROVOC(query)
                    .then(agroTerms => {
                        // Search for crop data using the FAOSTAT API
                        return Promise.all([
                            agroTerms, 
                            searchFAOSTAT(query)
                        ]);
                    })
                    .then(([agroTerms, cropData]) => {
                        // Remove loading indicator
                        const loadingIndicator = document.getElementById('searchLoadingIndicator');
                        if (loadingIndicator) {
                            loadingIndicator.remove();
                        }
                        
                        // Process and display results
                        displaySearchResults(query, agroTerms, cropData);
                    })
                    .catch(error => {
                        console.error('Error fetching agricultural data:', error);
                        
                        // Remove loading indicator
                        const loadingIndicator = document.getElementById('searchLoadingIndicator');
                        if (loadingIndicator) {
                            loadingIndicator.remove();
                        }
                        
                        // Show sample data if API fails
                        showNotification('Using sample data due to API limitation');
                        displaySampleResults(query);
                    });
            }
            
            // Function to search AGROVOC API (FAO's Agricultural Vocabulary)
            async function searchAGROVOC(query) {
                try {
                    // Use our proxy instead of direct API call
                    const url = `fao_proxy.php?api=agrovoc&q=${encodeURIComponent(query)}`;
                    
                    const response = await fetch(url);
                    if (!response.ok) {
                        throw new Error('AGROVOC API call failed');
                    }
                    
                    const data = await response.json();
                    return processAGROVOCData(data);
                } catch (error) {
                    console.error('Error fetching AGROVOC data:', error);
                    return []; // Return empty array on error
                }
            }
            
            // Process AGROVOC data
            function processAGROVOCData(data) {
                if (!data || !data.results) return [];
                
                return data.results.map(item => ({
                    id: item.uri || '',
                    name: item.prefLabel || 'Unknown Term',
                    category: 'Agricultural Term',
                    description: item.definition || 'No definition available',
                    related: item.narrower || []
                })).slice(0, 6); // Limit to 6 results
            }
            
            // Function to search FAOSTAT API
            async function searchFAOSTAT(query) {
                try {
                    // Use our proxy instead of direct API call
                    const url = `fao_proxy.php?api=faostat&q=${encodeURIComponent(query)}`;
                    
                    const response = await fetch(url);
                    if (!response.ok) {
                        throw new Error('FAOSTAT API call failed');
                    }
                    
                    const data = await response.json();
                    return processFAOSTATData(data, query);
                } catch (error) {
                    console.error('Error fetching FAOSTAT data:', error);
                    return []; // Return empty array on error
                }
            }
            
            // Process FAOSTAT data
            function processFAOSTATData(data, query) {
                if (!data || !data.data) return [];
                
                // Filter crop data matching the query
                const filteredData = data.data.filter(item => 
                    item.item && item.item.toLowerCase().includes(query.toLowerCase())
                );
                
                // Transform to our product format
                return filteredData.map(item => ({
                    id: item.code || '',
                    name: item.item || 'Unknown Crop',
                    category: item.element || 'Agricultural Product',
                    value: item.value || 0,
                    unit: item.unit || '',
                    year: item.year || '',
                    area: item.area || 'Global',
                    image: getCropImage(item.item) // Function to get crop image
                })).slice(0, 6); // Limit to 6 results
            }
            
            // Function to get crop image (fallback images)
            function getCropImage(cropName) {
                const cropImages = {
                    'wheat': 'https://img.freepik.com/free-photo/wheat-sack-pile-flour-wooden-table_1150-16555.jpg',
                    'rice': 'https://img.freepik.com/free-photo/rice-white-bowl-wooden-floor_1150-35450.jpg',
                    'maize': 'https://img.freepik.com/free-photo/corn-seeds-sack_1150-17464.jpg',
                    'potato': 'https://img.freepik.com/free-photo/raw-potatoes-wooden-surface_144627-43592.jpg',
                    'tomato': 'https://img.freepik.com/free-photo/fresh-red-tomatoes_144627-6910.jpg',
                    'apple': 'https://img.freepik.com/free-photo/red-apple-with-green-leaf_1101-453.jpg',
                    'banana': 'https://img.freepik.com/free-photo/bananas-white-background-perfectly-retouched_197589-4511.jpg',
                    'orange': 'https://img.freepik.com/free-photo/orange-white-white_144627-16571.jpg',
                    'carrot': 'https://img.freepik.com/free-photo/carrots-isolated-white-background_1150-15641.jpg',
                    'milk': 'https://img.freepik.com/free-photo/milk-bottle-realistic-illustration_1284-34979.jpg',
                    'beef': 'https://img.freepik.com/free-photo/raw-fresh-beef-cut-wooden-cutting-board-dark-background_1150-44344.jpg',
                    'chicken': 'https://img.freepik.com/free-photo/raw-chicken-meat-cutting-board-dark-surface_1150-44248.jpg',
                    'coffee': 'https://img.freepik.com/free-photo/coffee-beans-white-container-few-beans-wooden-floor_1150-17784.jpg',
                    'tea': 'https://img.freepik.com/free-photo/cup-tea-with-leaf-mint_1150-17295.jpg'
                };
                
                // Find matching crop image or use default
                const cropKey = Object.keys(cropImages).find(key => 
                    cropName.toLowerCase().includes(key)
                );
                
                return cropKey ? cropImages[cropKey] : 'https://img.freepik.com/free-photo/vegetables-set-left-black-slate_1220-685.jpg';
            }
            
            // Function to display search results from APIs
            function displaySearchResults(query, agroTerms, cropData) {
                // Create modal if it doesn't exist
                let modal = document.getElementById('searchResultsModal');
                if (!modal) {
                    modal = document.createElement('div');
                    modal.className = 'modal fade';
                    modal.id = 'searchResultsModal';
                    modal.setAttribute('tabindex', '-1');
                    modal.setAttribute('aria-hidden', 'true');
                    
                    document.body.appendChild(modal);
                }
                
                // Prepare agricultural terms HTML
                let termsHTML = '';
                if (agroTerms && agroTerms.length > 0) {
                    termsHTML = `
                        <h5 class="mt-4 mb-3">Agricultural Terms (${agroTerms.length})</h5>
                        <div class="row g-3">
                            ${agroTerms.map(term => `
                                <div class="col-md-6">
                                    <div class="card h-100 border-0 rounded-4 shadow-sm">
                                        <div class="card-body">
                                            <h5 class="card-title">${term.name}</h5>
                                            <p class="card-text small">${term.description}</p>
                                            ${term.related && term.related.length > 0 ? `
                                                <p class="card-text small text-muted">Related: ${term.related.slice(0, 3).join(', ')}</p>
                                            ` : ''}
                                        </div>
                                    </div>
                                </div>
                            `).join('')}
                        </div>
                    `;
                }
                
                // Prepare crop data HTML
                let cropsHTML = '';
                if (cropData && cropData.length > 0) {
                    cropsHTML = `
                        <h5 class="mt-4 mb-3">Agricultural Products (${cropData.length})</h5>
                        <div class="row g-3">
                            ${cropData.map(crop => `
                                <div class="col-md-6 col-lg-4">
                                    <div class="card h-100 border-0 rounded-4 shadow-sm product-card">
                                        <div class="product-image">
                                            <img src="${crop.image}" alt="${crop.name}" class="card-img-top">
                                            <div class="product-overlay">
                                                <a href="product-details.php?id=${crop.id}" class="btn btn-sm btn-outline-light rounded-circle"><i class="fas fa-eye"></i></a>
                                            </div>
                                        </div>
                                        <div class="card-body text-center">
                                            <p class="text-muted mb-1 small">${crop.category}</p>
                                            <h5 class="product-title">${crop.name}</h5>
                                            <p class="small text-muted">${crop.area} (${crop.year})</p>
                                            ${crop.value ? `<p class="small">Production: ${crop.value} ${crop.unit}</p>` : ''}
                                        </div>
                                    </div>
                                </div>
                            `).join('')}
                        </div>
                    `;
                }
                
                // If no results found
                if (!agroTerms.length && !cropData.length) {
                    termsHTML = '<p>No agricultural terms or products found matching your search.</p>';
                }
                
                // Build modal content
                modal.innerHTML = `
                    <div class="modal-dialog modal-dialog-centered modal-xl">
                        <div class="modal-content rounded-4 border-0">
                            <div class="modal-header border-bottom-0">
                                <h5 class="modal-title">Agricultural Data for "${query}"</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                ${termsHTML}
                                ${cropsHTML}
                                <div class="mt-4 p-3 bg-light rounded-4 small">
                                    <p class="mb-0"><i class="fas fa-info-circle me-2"></i> Data sourced from the Food and Agriculture Organization (FAO) of the United Nations.</p>
                                </div>
                            </div>
                            <div class="modal-footer border-top-0">
                                <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Close</button>
                                <a href="catalog.php?search=${encodeURIComponent(query)}" class="btn btn-success rounded-pill">View All Products</a>
                            </div>
                        </div>
                    </div>
                `;
                
                // Initialize and show the modal
                const modalInstance = new bootstrap.Modal(modal);
                modalInstance.show();
            }
            
            // Function to display sample results (fallback when API fails)
            function displaySampleResults(query) {
                // Sample data based on common agricultural products
                const sampleProducts = [
                    {
                        id: 1,
                        name: 'Organic Wheat',
                        category: 'Grains',
                        price: 2.99,
                        farmer: 'John\'s Grains',
                        image: 'https://img.freepik.com/free-photo/wheat-sack-pile-flour-wooden-table_1150-16555.jpg',
                        area: 'Local Farms',
                        year: '2023'
                    },
                    {
                        id: 2,
                        name: 'Fresh Tomatoes',
                        category: 'Vegetables',
                        price: 3.49,
                        farmer: 'Kelvin Farms',
                        image: 'https://img.freepik.com/free-photo/fresh-red-tomatoes_144627-6910.jpg',
                        area: 'Greenhouse',
                        year: '2023'
                    },
                    {
                        id: 3,
                        name: 'Organic Apples',
                        category: 'Fruits',
                        price: 4.99,
                        farmer: 'Emma\'s Orchards',
                        image: 'https://img.freepik.com/free-photo/red-apple-with-green-leaf_1101-453.jpg',
                        area: 'Orchard',
                        year: '2023'
                    },
                    {
                        id: 4,
                        name: 'Fresh Milk',
                        category: 'Dairy',
                        price: 3.29,
                        farmer: 'Sarah\'s Dairy',
                        image: 'https://img.freepik.com/free-photo/milk-bottle-realistic-illustration_1284-34979.jpg',
                        area: 'Dairy Farm',
                        year: '2023'
                    }
                ];
                
                // Filter sample products based on query
                const filteredProducts = sampleProducts.filter(product => 
                    product.name.toLowerCase().includes(query.toLowerCase()) ||
                    product.category.toLowerCase().includes(query.toLowerCase()) ||
                    product.farmer.toLowerCase().includes(query.toLowerCase())
                );
                
                // Create and show modal with sample results
                displaySearchResults(query, [], filteredProducts.length > 0 ? filteredProducts : sampleProducts);
            }
            
            // Function to show notification
            function showNotification(message) {
                // Create notification element if it doesn't exist
                let notification = document.getElementById('notification');
                if (!notification) {
                    notification = document.createElement('div');
                    notification.id = 'notification';
                    notification.className = 'notification';
                    document.body.appendChild(notification);
                }
                
                // Set notification message and style
                notification.innerHTML = message;
                notification.style.display = 'block';
                
                // Hide after 3 seconds
                setTimeout(() => {
                    notification.style.display = 'none';
                }, 3000);
            }
        });
    </script>

    <!-- Enhanced FAO API and Dark Mode Styling -->
    <style>
        /* Dark mode enhancements */
        [data-theme="dark"] {
            --primary-color: #2ecc71;
            --primary-dark: #27ae60;
            --primary-light: #55efc4;
            --secondary-color: #f39c12;
            --secondary-dark: #e67e22;
            --text-color: #f5f6fa !important;
            --text-light: #dfe6e9 !important;
            --background-color: #2d3436 !important;
            --card-color: #1e272e !important;
            --shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }
        
        [data-theme="dark"] body {
            background-color: #2d3436 !important;
            color: #f5f6fa !important;
        }
        
        [data-theme="dark"] .custom-navbar {
            background-color: #1e272e !important;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2) !important;
        }
        
        [data-theme="dark"] .dropdown-menu {
            background-color: #1e272e !important;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3) !important;
        }
        
        [data-theme="dark"] .dropdown-item {
            color: #f5f6fa !important;
        }
        
        [data-theme="dark"] .dropdown-item:hover {
            background-color: #55efc4 !important;
        }
        
        [data-theme="dark"] .counter-item,
        [data-theme="dark"] .farmer-card,
        [data-theme="dark"] .category-card .card,
        [data-theme="dark"] .modal-content {
            background-color: #1e272e !important;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2) !important;
        }
        
        [data-theme="dark"] .section-title h2,
        [data-theme="dark"] .farmer-name,
        [data-theme="dark"] .stat-value,
        [data-theme="dark"] .card h3,
        [data-theme="dark"] .card-title,
        [data-theme="dark"] .modal-title {
            color: #f5f6fa !important;
        }
        
        [data-theme="dark"] .section-title p,
        [data-theme="dark"] .farmer-specialty,
        [data-theme="dark"] .stat-label,
        [data-theme="dark"] .card p,
        [data-theme="dark"] .card-text,
        [data-theme="dark"] .modal-body {
            color: #dfe6e9 !important;
        }
        
        [data-theme="dark"] .theme-toggle {
            background-color: #4a5568 !important;
            color: #f5f6fa !important;
        }
        
        [data-theme="dark"] .bg-light {
            background-color: #2d3436 !important;
        }
        
        /* Notification styling */
        .notification {
            position: fixed;
            top: 80px;
            right: 20px;
            background-color: var(--primary-color);
            color: white;
            padding: 15px 25px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            z-index: 9999;
            display: none;
            animation: slideIn 0.3s forwards;
        }
        
        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        
        /* Search loading indicator */
        .search-loading {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            z-index: 9999;
        }
        
        [data-theme="dark"] .search-loading {
            background: rgba(30, 39, 46, 0.9);
        }
        
        .search-loading p {
            margin-top: 15px;
            color: var(--text-color);
        }
        
        /* Modal and search results styling */
        .modal-content {
            background-color: var(--card-color);
            color: var(--text-color);
        }
        
        .product-card {
            transition: all 0.3s ease;
        }
        
        .product-card:hover {
            transform: translateY(-10px);
        }
        
        .product-image {
            height: 200px;
            overflow: hidden;
            position: relative;
        }
        
        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        
        .product-card:hover .product-image img {
            transform: scale(1.1);
        }
        
        .product-overlay {
            position: absolute;
            bottom: -50px;
            left: 0;
            width: 100%;
            padding: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: bottom 0.3s ease;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.7), transparent);
        }
        
        .product-card:hover .product-overlay {
            bottom: 0;
        }
        
        .product-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--text-color);
        }
        
        .product-price {
            margin-bottom: 0.5rem;
        }
        
        .price {
            font-weight: 700;
            font-size: 1.2rem;
            color: var(--primary-color);
        }
    </style>
</body>
</html>