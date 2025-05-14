<?php
// Start session before any output
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Premium agricultural products marketplace">
    <title>Agro Market Place - Product Catalog</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            /* Color Palette */
            --color-primary: #00a86b;
            --color-primary-dark: #008c59;
            --color-primary-light: #7cdeb4;
            --color-accent: #ff7e1d;
            --color-black: #1a1a1a;
            --color-white: #ffffff;
            --color-gray-100: #f8f9fa;
            --color-gray-200: #e9ecef;
            --color-gray-300: #dee2e6;
            --color-gray-400: #ced4da;
            --color-gray-500: #adb5bd;
            --color-gray-600: #6c757d;
            --color-gray-700: #495057;
            --color-gray-800: #343a40;
            --color-gray-900: #212529;
            
            /* Typography */
            --font-family: 'Plus Jakarta Sans', sans-serif;
            --font-size-xs: 0.75rem;
            --font-size-sm: 0.875rem;
            --font-size-md: 1rem;
            --font-size-lg: 1.125rem;
            --font-size-xl: 1.25rem;
            --font-size-2xl: 1.5rem;
            --font-size-3xl: 1.875rem;
            --font-size-4xl: 2.25rem;
            
            /* Spacing */
            --spacing-1: 0.25rem;
            --spacing-2: 0.5rem;
            --spacing-3: 0.75rem;
            --spacing-4: 1rem;
            --spacing-5: 1.25rem;
            --spacing-6: 1.5rem;
            --spacing-8: 2rem;
            --spacing-10: 2.5rem;
            --spacing-12: 3rem;
            --spacing-16: 4rem;
            
            /* Borders */
            --border-radius-sm: 0.25rem;
            --border-radius-md: 0.5rem;
            --border-radius-lg: 0.75rem;
            --border-radius-xl: 1rem;
            --border-radius-2xl: 1.5rem;
            --border-radius-full: 9999px;
            
            /* Shadows */
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            
            /* Transitions */
            --transition-fast: 150ms ease;
            --transition-normal: 250ms ease;
            --transition-slow: 350ms ease;
        }
        
        /* Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: var(--font-family);
            background-color: var(--color-gray-100);
            color: var(--color-gray-900);
            line-height: 1.5;
            -webkit-font-smoothing: antialiased;
        }
        
        img {
            max-width: 100%;
            height: auto;
            display: block;
        }
        
        button {
            cursor: pointer;
            font-family: var(--font-family);
        }
        
        a {
            text-decoration: none;
            color: inherit;
        }
        
        /* Layout */
        .container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 var(--spacing-4);
        }
        
        .section {
            margin-bottom: var(--spacing-16);
        }
        
        /* Header */
        .header {
            background-color: var(--color-white);
            box-shadow: var(--shadow-sm);
            position: sticky;
            top: 0;
            z-index: 100;
            padding: var(--spacing-4) 0;
        }
        
        .header-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .logo {
            font-size: var(--font-size-xl);
            font-weight: 700;
            color: var(--color-primary);
        }
        
        .nav-menu {
            display: flex;
            gap: var(--spacing-6);
            list-style: none;
        }
        
        .nav-link {
            font-weight: 500;
            color: var(--color-gray-700);
            padding: var(--spacing-2) var(--spacing-4);
            border-radius: var(--border-radius-full);
            transition: all var(--transition-normal);
        }
        
        .nav-link:hover, .nav-link.active {
            color: var(--color-primary);
            background-color: rgba(0, 168, 107, 0.08);
        }
        
        /* Hero Section */
        .hero {
            background: linear-gradient(to right, rgba(0, 168, 107, 0.1), rgba(0, 168, 107, 0.05));
            padding: var(--spacing-16) 0;
            border-radius: var(--border-radius-lg);
            margin-top: var(--spacing-8);
        }
        
        .hero-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: var(--spacing-8);
        }
        
        .hero-content {
            flex: 1;
        }
        
        .hero-title {
            font-size: var(--font-size-4xl);
            font-weight: 700;
            margin-bottom: var(--spacing-4);
            color: var(--color-gray-900);
        }
        
        .hero-subtitle {
            font-size: var(--font-size-xl);
            color: var(--color-gray-600);
            margin-bottom: var(--spacing-6);
        }
        
        .hero-image {
            flex: 1;
            max-width: 480px;
            border-radius: var(--border-radius-lg);
            overflow: hidden;
        }
        
        /* Category Navigation */
        .category-nav {
            display: flex;
            overflow-x: auto;
            gap: var(--spacing-4);
            padding: var(--spacing-8) 0;
            scrollbar-width: none; /* Firefox */
        }
        
        .category-nav::-webkit-scrollbar {
            display: none; /* Chrome, Safari, Edge */
        }
        
        .category-button {
            padding: var(--spacing-3) var(--spacing-6);
            background-color: var(--color-white);
            border: 1px solid var(--color-gray-200);
            font-weight: 500;
            border-radius: var(--border-radius-full);
            white-space: nowrap;
            transition: all var(--transition-normal);
        }
        
        .category-button:hover, .category-button.active {
            background-color: var(--color-primary);
            color: var(--color-white);
            border-color: var(--color-primary);
            box-shadow: var(--shadow-md);
        }
        
        /* Product Grid */
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: var(--spacing-6);
        }
        
        .product-card {
            background-color: var(--color-white);
            border-radius: var(--border-radius-lg);
            overflow: hidden;
            transition: transform var(--transition-normal), box-shadow var(--transition-normal);
            position: relative;
        }
        
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }
        
        .product-badge {
            position: absolute;
            top: var(--spacing-4);
            right: var(--spacing-4);
            background-color: var(--color-accent);
            color: var(--color-white);
            font-size: var(--font-size-xs);
            font-weight: 600;
            padding: var(--spacing-1) var(--spacing-3);
            border-radius: var(--border-radius-full);
            z-index: 10;
        }
        
        .product-image {
            position: relative;
            height: 200px;
            background-color: var(--color-gray-100);
        }
        
        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .product-content {
            padding: var(--spacing-5);
        }
        
        .product-category {
            color: var(--color-primary);
            font-size: var(--font-size-sm);
            font-weight: 600;
            margin-bottom: var(--spacing-2);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .product-title {
            font-size: var(--font-size-lg);
            font-weight: 600;
            margin-bottom: var(--spacing-2);
            color: var(--color-gray-900);
        }
        
        .product-description {
            font-size: var(--font-size-sm);
            color: var(--color-gray-600);
            margin-bottom: var(--spacing-4);
        }
        
        .product-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: var(--spacing-4);
        }
        
        .product-price {
            font-weight: 700;
            color: var(--color-gray-800);
            font-size: var(--font-size-lg);
            display: flex;
            align-items: center;
            gap: var(--spacing-2);
        }
        
        .product-price-old {
            text-decoration: line-through;
            color: var(--color-gray-500);
            font-size: var(--font-size-sm);
            font-weight: 400;
        }
        
        .product-rating {
            display: flex;
            align-items: center;
            gap: var(--spacing-1);
            font-size: var(--font-size-sm);
            color: var(--color-gray-600);
        }
        
        .product-rating i {
            color: var(--color-accent);
        }
        
        .product-fao {
            background-color: rgba(0, 168, 107, 0.08);
            padding: var(--spacing-3);
            border-radius: var(--border-radius-md);
            font-size: var(--font-size-sm);
            color: var(--color-gray-700);
            margin-bottom: var(--spacing-4);
        }
        
        .product-fao strong {
            color: var(--color-primary);
        }
        
        .product-actions {
            display: flex;
            gap: var(--spacing-2);
        }
        
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: var(--spacing-2);
            padding: var(--spacing-3) var(--spacing-6);
            border-radius: var(--border-radius-md);
            font-weight: 600;
            font-size: var(--font-size-sm);
            text-align: center;
            transition: all var(--transition-normal);
            border: none;
            cursor: pointer;
        }
        
        .btn-primary {
            background-color: var(--color-primary);
            color: var(--color-white);
        }
        
        .btn-primary:hover {
            background-color: var(--color-primary-dark);
        }
        
        .btn-outline {
            background-color: transparent;
            color: var(--color-primary);
            border: 1px solid var(--color-primary);
        }
        
        .btn-outline:hover {
            background-color: rgba(0, 168, 107, 0.08);
        }
        
        /* Section Headers */
        .section-header {
            margin-bottom: var(--spacing-8);
        }
        
        .section-title {
            font-size: var(--font-size-2xl);
            font-weight: 700;
            margin-bottom: var(--spacing-4);
            position: relative;
            display: inline-block;
            padding-bottom: var(--spacing-2);
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 3px;
            background-color: var(--color-primary);
            border-radius: var(--border-radius-full);
        }
        
        /* Footer */
        .footer {
            background-color: var(--color-gray-900);
            color: var(--color-gray-300);
            padding: var(--spacing-16) 0;
            margin-top: var(--spacing-16);
        }
        
        .footer-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: var(--spacing-8);
        }
        
        .footer-column h3 {
            color: var(--color-white);
            margin-bottom: var(--spacing-6);
            font-size: var(--font-size-lg);
        }
        
        .footer-links {
            list-style: none;
        }
        
        .footer-link {
            margin-bottom: var(--spacing-3);
        }
        
        .footer-link a {
            color: var(--color-gray-400);
            transition: color var(--transition-normal);
        }
        
        .footer-link a:hover {
            color: var(--color-primary-light);
        }
        
        .footer-bottom {
            border-top: 1px solid var(--color-gray-800);
            margin-top: var(--spacing-8);
            padding-top: var(--spacing-8);
            text-align: center;
            color: var(--color-gray-500);
            font-size: var(--font-size-sm);
        }
        
        /* Utilities */
        .visually-hidden {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border-width: 0;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .hero-container {
                flex-direction: column;
            }
            
            .hero-image {
                order: -1;
                margin-bottom: var(--spacing-8);
            }
            
            .product-grid {
                grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            }
            
            .hero-title {
                font-size: var(--font-size-3xl);
            }
        }
        
        @media (max-width: 640px) {
            .product-grid {
                grid-template-columns: 1fr;
            }
            
            .nav-menu {
                display: none;
            }
            
            .hero-title {
                font-size: var(--font-size-2xl);
            }
            
            .section-title {
                font-size: var(--font-size-xl);
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="container header-container">
            <a href="/" class="logo">AgroMarket</a>
            <nav>
                <ul class="nav-menu">
                    <li><a href="home.php" class="nav-link">Home</a></li>
                    <li><a href="cat.php" class="nav-link active">Products</a></li>
                    <li><a href="catalog.php" class="nav-link">Marketplace</a></li>
                    <li><a href="about_us.php" class="nav-link">About</a></li>
                    <li><a href="contact.php" class="nav-link">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="container">
        <section class="hero">
            <div class="container hero-container">
                <div class="hero-content">
                    <h1 class="hero-title">Fresh Farm Products Direct to Your Door</h1>
                    <p class="hero-subtitle">Discover the finest organic produce, dairy, and more from local farmers.</p>
                    <div class="product-actions">
                        <a href="catalog.php" class="btn btn-primary">Browse All Products</a>
                        <a href="sellers.php" class="btn btn-outline">Meet Our Farmers</a>
                    </div>
                </div>
                <div class="hero-image">
                    <img src="images/hero-fruits.jpg" alt="Fresh fruits and vegetables" loading="lazy">
                </div>
            </div>
        </section>

        <section class="section">
            <div class="category-nav">
                <button class="category-button active">All Categories</button>
                <button class="category-button">Fruits</button>
                <button class="category-button">Vegetables</button>
                <button class="category-button">Dairy Products</button>
                <button class="category-button">Cereals</button>
                <button class="category-button">Grains</button>
                <button class="category-button">Nuts & Seeds</button>
            </div>
        </section>

        <section class="section">
            <div class="section-header">
                <h2 class="section-title">Premium Fruits</h2>
            </div>
            <div class="product-grid">
                <!-- Product Card 1 -->
                <div class="product-card">
                    <div class="product-badge">Organic</div>
                    <div class="product-image">
                        <img src="images/apple.avif" alt="Organic Apples" loading="lazy">
                    </div>
                    <div class="product-content">
                        <div class="product-category">Fruits</div>
                        <h3 class="product-title">Organic Apples</h3>
                        <p class="product-description">Crisp and juicy apples, grown without pesticides.</p>
                        <div class="product-meta">
                            <div class="product-price">
                                Ugx 7,500/kg
                                <span class="product-price-old">Ugx 8,500</span>
                            </div>
                            <div class="product-rating">
                                <i class="fas fa-star"></i>
                                <span>4.8 (36)</span>
                            </div>
                        </div>
                        <div class="product-fao">
                            <strong>FAO Data:</strong> Global production: 86.4M tonnes (2022)
                        </div>
                        <div class="product-actions">
                            <button class="btn btn-primary">View Details</button>
                            <button class="btn btn-outline">
                                <i class="fas fa-heart"></i>
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Product Card 2 -->
                <div class="product-card">
                    <div class="product-image">
                        <img src="images/banana.avif" alt="Sweet Bananas" loading="lazy">
                    </div>
                    <div class="product-content">
                        <div class="product-category">Fruits</div>
                        <h3 class="product-title">Sweet Bananas</h3>
                        <p class="product-description">Perfectly ripe and bursting with flavor.</p>
                        <div class="product-meta">
                            <div class="product-price">
                                Ugx 4,500/kg
                            </div>
                            <div class="product-rating">
                                <i class="fas fa-star"></i>
                                <span>4.5 (28)</span>
                            </div>
                        </div>
                        <div class="product-fao">
                            <strong>FAO Data:</strong> Global production: 119.8M tonnes (2022)
                        </div>
                        <div class="product-actions">
                            <button class="btn btn-primary">View Details</button>
                            <button class="btn btn-outline">
                                <i class="fas fa-heart"></i>
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Product Card 3 -->
                <div class="product-card">
                    <div class="product-badge">Fresh</div>
                    <div class="product-image">
                        <img src="images/orange.avif" alt="Juicy Oranges" loading="lazy">
                    </div>
                    <div class="product-content">
                        <div class="product-category">Fruits</div>
                        <h3 class="product-title">Juicy Oranges</h3>
                        <p class="product-description">A refreshing burst of vitamin C in every bite.</p>
                        <div class="product-meta">
                            <div class="product-price">
                                Ugx 7,800/kg
                                <span class="product-price-old">Ugx 9,200</span>
                            </div>
                            <div class="product-rating">
                                <i class="fas fa-star"></i>
                                <span>4.7 (42)</span>
                            </div>
                        </div>
                        <div class="product-fao">
                            <strong>FAO Data:</strong> Global production: 75.5M tonnes (2022)
                        </div>
                        <div class="product-actions">
                            <button class="btn btn-primary">View Details</button>
                            <button class="btn btn-outline">
                                <i class="fas fa-heart"></i>
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Product Card 4 -->
                <div class="product-card">
                    <div class="product-image">
                        <img src="images/mango.jpg" alt="Sweet Mangoes" loading="lazy">
                    </div>
                    <div class="product-content">
                        <div class="product-category">Fruits</div>
                        <h3 class="product-title">Sweet Mangoes</h3>
                        <p class="product-description">A tropical delight, bursting with sweetness.</p>
                        <div class="product-meta">
                            <div class="product-price">
                                Ugx 9,600/kg
                            </div>
                            <div class="product-rating">
                                <i class="fas fa-star"></i>
                                <span>4.9 (57)</span>
                            </div>
                        </div>
                        <div class="product-fao">
                            <strong>FAO Data:</strong> Global production: 55.4M tonnes (2022)
                        </div>
                        <div class="product-actions">
                            <button class="btn btn-primary">View Details</button>
                            <button class="btn btn-outline">
                                <i class="fas fa-heart"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section">
            <div class="section-header">
                <h2 class="section-title">Organic Vegetables</h2>
            </div>
            <div class="product-grid">
                <!-- Vegetable Product Cards -->
                <!-- Similar structure to fruit products -->
            </div>
        </section>

        <section class="section">
            <div class="section-header">
                <h2 class="section-title">Farm Fresh Dairy</h2>
            </div>
            <div class="product-grid">
                <!-- Dairy Product Cards -->
                <!-- Similar structure to fruit products -->
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="container footer-container">
            <div class="footer-column">
                <h3>AgroMarket</h3>
                <p>Your trusted marketplace for premium agricultural products directly from farmers to your table.</p>
            </div>
            <div class="footer-column">
                <h3>Quick Links</h3>
                <ul class="footer-links">
                    <li class="footer-link"><a href="home.php">Home</a></li>
                    <li class="footer-link"><a href="cat.php">Products</a></li>
                    <li class="footer-link"><a href="catalog.php">Marketplace</a></li>
                    <li class="footer-link"><a href="about_us.php">About Us</a></li>
                    <li class="footer-link"><a href="contact.php">Contact</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Categories</h3>
                <ul class="footer-links">
                    <li class="footer-link"><a href="#">Fruits</a></li>
                    <li class="footer-link"><a href="#">Vegetables</a></li>
                    <li class="footer-link"><a href="#">Dairy Products</a></li>
                    <li class="footer-link"><a href="#">Grains</a></li>
                    <li class="footer-link"><a href="#">Nuts & Seeds</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Contact Us</h3>
                <ul class="footer-links">
                    <li class="footer-link"><a href="mailto:info@agromarket.com">info@agromarket.com</a></li>
                    <li class="footer-link"><a href="tel:+256700000000">+256 700 000 000</a></li>
                    <li class="footer-link">Plot 123, Farmers Avenue, Kampala</li>
                </ul>
            </div>
        </div>
        <div class="container footer-bottom">
            <p>&copy; 2023 AgroMarket. All rights reserved.</p>
        </div>
    </footer>

    <script>
        // Category Filter Functionality
        const categoryButtons = document.querySelectorAll('.category-button');
        
        categoryButtons.forEach(button => {
            button.addEventListener('click', () => {
                // Remove active class from all buttons
                categoryButtons.forEach(btn => btn.classList.remove('active'));
                
                // Add active class to clicked button
                button.classList.add('active');
                
                // Get the selected category
                const category = button.textContent.trim().toLowerCase();
                
                // Filter products based on category
                filterProductsByCategory(category);
            });
        });
        
        function filterProductsByCategory(category) {
            // Get all product sections
            const sections = document.querySelectorAll('.section:not(:first-child)');
            
            if (category === 'all categories') {
                // Show all sections
                sections.forEach(section => {
                    section.style.display = 'block';
                });
            } else {
                // Show/hide sections based on category
                sections.forEach(section => {
                    const sectionTitle = section.querySelector('.section-title').textContent.toLowerCase();
                    if (sectionTitle.includes(category) || category === 'all categories') {
                        section.style.display = 'block';
                    } else {
                        section.style.display = 'none';
                    }
                });
            }
        }
        
        // FAO Data Integration
        async function fetchFAOData(productName) {
            try {
                const response = await fetch(`fao_proxy.php?api=faostat&q=${encodeURIComponent(productName)}`);
                const data = await response.json();
                return data.data[0] || null;
            } catch (error) {
                console.error('Error fetching FAO data:', error);
                return null;
            }
        }
        
        // Fetch all FAO crop data
        async function fetchAllFAOCrops() {
            try {
                const response = await fetch('fao_proxy.php?api=faostat&q=');
                const data = await response.json();
                return data.data || [];
            } catch (error) {
                console.error('Error fetching all FAO crops:', error);
                return [];
            }
        }
        
        // Create a product card element
        function createProductCard(product) {
            const hasBadge = product.organic || product.fresh;
            const badgeText = product.organic ? 'Organic' : (product.fresh ? 'Fresh' : '');
            const hasDiscount = product.oldPrice && product.oldPrice > product.price;
            
            const productCard = document.createElement('div');
            productCard.className = 'product-card';
            productCard.innerHTML = `
                ${hasBadge ? `<div class="product-badge">${badgeText}</div>` : ''}
                <div class="product-image">
                    <img src="${product.image}" alt="${product.name}" loading="lazy">
                </div>
                <div class="product-content">
                    <div class="product-category">${product.category}</div>
                    <h3 class="product-title">${product.name}</h3>
                    <p class="product-description">${product.description}</p>
                    <div class="product-meta">
                        <div class="product-price">
                            ${product.price}
                            ${hasDiscount ? `<span class="product-price-old">${product.oldPrice}</span>` : ''}
                        </div>
                        <div class="product-rating">
                            <i class="fas fa-star"></i>
                            <span>${product.rating} (${product.reviews})</span>
                        </div>
                    </div>
                    <div class="product-fao">
                        <strong>FAO Data:</strong> Loading...
                    </div>
                    <div class="product-actions">
                        <button class="btn btn-primary">View Details</button>
                        <button class="btn btn-outline">
                            <i class="fas fa-heart"></i>
                        </button>
                    </div>
                </div>
            `;
            
            return productCard;
        }
        
        // Generate product cards from FAO data
        async function generateProductsFromFAO() {
            const cropData = await fetchAllFAOCrops();
            
            // Skip if no data is available
            if (!cropData || cropData.length === 0) return;
            
            // Process each product category
            const categories = {
                'Fruits': [],
                'Vegetables': [],
                'Cereals': [],
                'Dairy': []
            };
            
            // Sample images for each category
            const categoryImages = {
                'Fruits': [
                    'images/apple.avif',
                    'images/banana.avif',
                    'images/orange.avif',
                    'images/mango.jpg'
                ],
                'Vegetables': [
                    'images/tomatoes.avif',
                    'images/beans.avif',
                    'images/broccoli.png',
                    'images/spinach.avif'
                ],
                'Cereals': [
                    'images/wheat.jpg',
                    'images/rice.jpg',
                    'images/maize.jpg',
                    'images/barley.jpg'
                ],
                'Dairy': [
                    'images/milk.png',
                    'images/Cheese.jpg',
                    'images/yogurt.png',
                    'images/butter.jpg'
                ]
            };
            
            // Map each crop to a product category
            cropData.forEach(crop => {
                let category = 'Fruits'; // Default category
                
                // Determine category based on crop name
                const name = crop.item.toLowerCase();
                if (name.includes('rice') || name.includes('wheat') || name.includes('maize') || 
                    name.includes('barley') || name.includes('grain') || name.includes('cereal')) {
                    category = 'Cereals';
                } else if (name.includes('tomato') || name.includes('vegetable') || name.includes('bean') || 
                           name.includes('carrot') || name.includes('lettuce') || name.includes('spinach') ||
                           name.includes('broccoli') || name.includes('potato')) {
                    category = 'Vegetables';
                } else if (name.includes('milk') || name.includes('cheese') || 
                           name.includes('yogurt') || name.includes('butter') || name.includes('dairy')) {
                    category = 'Dairy';
                }
                
                // Random rating and reviews
                const rating = (Math.random() * 1.5 + 3.5).toFixed(1); // Between 3.5 and 5.0
                const reviews = Math.floor(Math.random() * 80) + 10; // Between 10 and 90
                
                // Generate random price
                const basePrice = Math.floor(Math.random() * 15000) + 2000; // Between 2000 and 17000
                const price = `Ugx ${basePrice.toLocaleString()}/kg`;
                
                // Some products have discounts (30% chance)
                const hasDiscount = Math.random() < 0.3;
                const oldPrice = hasDiscount ? `Ugx ${Math.floor(basePrice * 1.2).toLocaleString()}/kg` : null;
                
                // Some products are organic or fresh (40% chance)
                const isOrganic = Math.random() < 0.2;
                const isFresh = !isOrganic && Math.random() < 0.2;
                
                // Create product object
                const product = {
                    name: crop.item,
                    description: `Premium quality ${crop.item.toLowerCase()} from local farmers.`,
                    category: category,
                    price: price,
                    oldPrice: oldPrice,
                    rating: rating,
                    reviews: reviews,
                    organic: isOrganic,
                    fresh: isFresh,
                    faoData: crop,
                    // Select a random image from the category
                    image: categoryImages[category][Math.floor(Math.random() * categoryImages[category].length)]
                };
                
                // Add product to category array
                categories[category].push(product);
            });
            
            // Limit to 4 products per category and create sections
            for (const [category, products] of Object.entries(categories)) {
                // Skip empty categories
                if (products.length === 0) continue;
                
                // Limit to 4 products and shuffle
                const shuffled = products.sort(() => 0.5 - Math.random()).slice(0, 4);
                
                // Create or find section for this category
                let section = document.querySelector(`.section-${category.toLowerCase()}`);
                
                if (!section) {
                    // Create new section if it doesn't exist
                    section = document.createElement('section');
                    section.className = `section section-${category.toLowerCase()}`;
                    section.innerHTML = `
                        <div class="section-header">
                            <h2 class="section-title">${category}</h2>
                        </div>
                        <div class="product-grid product-grid-${category.toLowerCase()}"></div>
                    `;
                    document.querySelector('main').appendChild(section);
                }
                
                // Find or create product grid
                const productGrid = section.querySelector(`.product-grid-${category.toLowerCase()}`) || 
                                   section.querySelector('.product-grid');
                
                // Clear existing products if any
                if (category !== 'Fruits') { // Keep the fruit examples
                    productGrid.innerHTML = '';
                }
                
                // Add products to grid
                shuffled.forEach(product => {
                    const card = createProductCard(product);
                    productGrid.appendChild(card);
                    
                    // Update FAO data on the card
                    const faoElement = card.querySelector('.product-fao');
                    if (faoElement && product.faoData) {
                        faoElement.innerHTML = `
                            <strong>FAO Data:</strong> 
                            Production: ${product.faoData.value.toLocaleString()} ${product.faoData.unit} (${product.faoData.year})
                        `;
                    }
                });
            }
        }
        
        // This function updates FAO data on pre-existing product cards
        async function updateFAOData() {
            const productCards = document.querySelectorAll('.product-card');
            
            for (const card of productCards) {
                const productTitle = card.querySelector('.product-title').textContent;
                const faoElement = card.querySelector('.product-fao');
                
                if (faoElement) {
                    const faoData = await fetchFAOData(productTitle);
                    
                    if (faoData) {
                        faoElement.innerHTML = `
                            <strong>FAO Data:</strong> 
                            Production: ${faoData.value.toLocaleString()} ${faoData.unit} (${faoData.year})
                        `;
                    }
                }
            }
        }
        
        // Initialize page when loaded
        document.addEventListener('DOMContentLoaded', async () => {
            // Update existing products with FAO data
            await updateFAOData();
            
            // Generate additional products from FAO data
            await generateProductsFromFAO();
            
            // Initialize category filters
            const categoryButtons = document.querySelectorAll('.category-button');
            if (categoryButtons.length > 0) {
                categoryButtons[0].click(); // Select "All Categories" by default
            }
        });
    </script>
</body>
</html>