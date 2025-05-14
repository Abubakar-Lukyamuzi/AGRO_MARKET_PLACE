<?php
// Test PHP execution - if we see this message, PHP is running
// echo "PHP is working!"; exit;

// PHP header to ensure proper content type
header('Content-Type: text/html; charset=utf-8');

require_once 'config.php';

// Only start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Get search query if present
$search_query = isset($_GET['search']) ? $_GET['search'] : '';
$category = isset($_GET['category']) ? $_GET['category'] : '';

// Function to fetch FAO data through our proxy
function getFAOData($type, $query = '') {
    // Simple approach - use direct file access with $_GET parameters
    $_GET['api'] = $type;
    $_GET['q'] = $query;
    
    // Capture the output from our proxy file
    ob_start();
    include 'fao_proxy.php';
    $response = ob_get_clean();
    
    // Clean up after ourselves
    unset($_GET['api']);
    unset($_GET['q']);
    
    // Parse the JSON response
    $data = json_decode($response, true);
    
    // If parsing failed, return fallback data
    if ($data === null) {
        if ($type === 'agrovoc') {
            return [
                'results' => [
                    [
                        'uri' => 'sample-uri',
                        'prefLabel' => 'Sample Agricultural Term',
                        'definition' => 'This is a sample agricultural term definition.',
                        'narrower' => ['Term 1', 'Term 2', 'Term 3']
                    ]
                ]
            ];
        } else {
            return [
                'data' => [
                    [
                        'code' => '15',
                        'item' => 'Wheat',
                        'element' => 'Production',
                        'value' => 760570042,
                        'unit' => 'tonnes',
                        'year' => '2022',
                        'area' => 'World'
                    ],
                    [
                        'code' => '27',
                        'item' => 'Rice',
                        'element' => 'Production',
                        'value' => 756743719,
                        'unit' => 'tonnes',
                        'year' => '2022',
                        'area' => 'Asia'
                    ],
                    [
                        'code' => '56',
                        'item' => 'Maize',
                        'element' => 'Production',
                        'value' => 1162427138,
                        'unit' => 'tonnes',
                        'year' => '2022',
                        'area' => 'Americas'
                    ]
                ]
            ];
        }
    }
    
    return $data;
}

// Use fallback data for now until PHP execution issues are fixed
$agricultural_terms = [
    'results' => [
        [
            'uri' => 'http://aims.fao.org/aos/agrovoc/c_203',
            'prefLabel' => 'Rice',
            'definition' => 'Annual cereal grass widely cultivated in warm climates, especially in Asia.',
            'narrower' => ['Brown rice', 'White rice', 'Paddy']
        ],
        [
            'uri' => 'http://aims.fao.org/aos/agrovoc/c_7951',
            'prefLabel' => 'Wheat',
            'definition' => 'One of the oldest and most important cereal crops.',
            'narrower' => ['Durum wheat', 'Common wheat', 'Ancient wheat']
        ],
        [
            'uri' => 'http://aims.fao.org/aos/agrovoc/c_12332',
            'prefLabel' => 'Maize',
            'definition' => 'Cereal plant having large kernels on a cob, also known as corn.',
            'narrower' => ['Sweet corn', 'Field corn', 'Popcorn']
        ]
    ]
];

$crops = [
    'data' => [
        [
            'code' => '15',
            'item' => 'Wheat',
            'element' => 'Production',
            'value' => 760570042,
            'unit' => 'tonnes',
            'year' => '2022',
            'area' => 'World'
        ],
        [
            'code' => '27',
            'item' => 'Rice',
            'element' => 'Production',
            'value' => 756743719,
            'unit' => 'tonnes',
            'year' => '2022',
            'area' => 'Asia'
        ],
        [
            'code' => '56',
            'item' => 'Maize',
            'element' => 'Production',
            'value' => 1162427138,
            'unit' => 'tonnes',
            'year' => '2022',
            'area' => 'Americas'
        ]
    ]
];

// Only fetch from our proxy if PHP is definitely working
if (!empty($search_query) || !empty($category)) {
    try {
        // Try to get data from our proxy
        if (!empty($search_query)) {
            $agricultural_terms = getFAOData('agrovoc', $search_query);
            $crops = getFAOData('faostat', $search_query);
        } elseif (!empty($category)) {
            $agricultural_terms = getFAOData('agrovoc', $category);
            $crops = getFAOData('faostat', $category);
        }
    } catch (Exception $e) {
        // If anything fails, we already have fallback data
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo !empty($category) ? ucfirst($category) : 'All Products'; ?> - AGRO MARKET PLACE</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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

        /* Header Styling */
        .catalog-header {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('https://img.freepik.com/free-photo/vegetables-set-left-black-slate_1220-685.jpg');
            background-size: cover;
            background-position: center;
            color: white;
            text-align: center;
            padding: 4rem 2rem;
            margin-bottom: 2rem;
            position: relative;
        }

        .catalog-header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            animation: fadeInDown 1s ease;
        }

        .catalog-header p {
            font-size: 1.2rem;
            max-width: 600px;
            margin: 0 auto;
            animation: fadeInUp 1s ease;
        }

        /* Search Section */
        .search-section {
            max-width: 800px;
            margin: 0 auto 2rem;
            padding: 0 1rem;
        }

        .search-wrapper {
            display: flex;
            background-color: var(--card-color);
            border-radius: 50px;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
        }

        .search-wrapper:focus-within {
            box-shadow: 0 10px 25px rgba(46, 204, 113, 0.2);
            transform: translateY(-2px);
        }

        .search-wrapper input {
            flex: 1;
            border: none;
            padding: 1rem 1.5rem;
            font-size: 1rem;
            outline: none;
            background-color: var(--card-color);
            color: var(--text-color);
        }

        .search-wrapper button {
            border: none;
            background-color: var(--primary-color);
            color: white;
            padding: 1rem 1.5rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .search-wrapper button:hover {
            background-color: var(--primary-dark);
        }

        /* Category Grid */
        .categories-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1.5rem;
            padding: 0 1.5rem;
            margin-bottom: 3rem;
        }

        .category-item {
            position: relative;
            overflow: hidden;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            text-decoration: none;
            color: var(--text-color);
            background-color: var(--card-color);
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-bottom: 1rem;
        }

        .category-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }

        .category-item img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .category-item:hover img {
            transform: scale(1.1);
        }

        .category-item p {
            margin-top: 1rem;
            font-weight: 600;
            font-size: 1.1rem;
            z-index: 2;
        }

        .category-item-icon {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--primary-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 2;
            transition: all 0.3s ease;
        }

        .category-item:hover .category-item-icon {
            transform: scale(1.2);
        }

        /* Products Grid */
        .section-title {
            text-align: center;
            margin-bottom: 2rem;
            position: relative;
        }

        .section-title h2 {
            font-size: 2rem;
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
            width: 50px;
            height: 3px;
            background-color: var(--primary-color);
            border-radius: 10px;
        }

        .section-title p {
            color: var(--text-light);
            font-size: 1rem;
            max-width: 600px;
            margin: 1rem auto 0;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 2rem;
            padding: 0 1.5rem;
            margin-bottom: 3rem;
        }

        .product-card {
            background-color: var(--card-color);
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
            position: relative;
        }

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }

        .product-image {
            height: 200px;
            position: relative;
            overflow: hidden;
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

        .product-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            background-color: var(--primary-color);
            color: white;
            padding: 0.3rem 0.7rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
            z-index: 2;
        }

        .product-content {
            padding: 1.5rem;
        }

        .product-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--text-color);
        }

        .product-category {
            color: var(--text-light);
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .product-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1rem;
        }

        .product-price {
            font-weight: 700;
            font-size: 1.2rem;
            color: var(--primary-color);
        }

        .product-rating {
            color: var(--secondary-color);
            display: flex;
            align-items: center;
        }

        .product-rating span {
            margin-left: 0.5rem;
            font-size: 0.9rem;
            color: var(--text-light);
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

        .product-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: white;
            color: var(--text-color);
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .product-btn:hover {
            background-color: var(--primary-color);
            color: white;
            transform: translateY(-5px);
        }
        
        /* Agricultural Terms Section */
        .terms-section {
            background-color: var(--card-color);
            padding: 3rem 0;
            margin-bottom: 3rem;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
        }
        
        .terms-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
            padding: 0 1.5rem;
        }
        
        .term-card {
            background-color: var(--background-color);
            border-radius: var(--border-radius);
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }
        
        .term-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        
        .term-name {
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }
        
        .term-definition {
            font-size: 0.9rem;
            color: var(--text-light);
            margin-bottom: 0.5rem;
        }
        
        .term-related {
            font-size: 0.8rem;
            color: var(--secondary-color);
        }

        /* Dark mode enhancements */
        [data-theme="dark"] .category-item,
        [data-theme="dark"] .product-card,
        [data-theme="dark"] .terms-section {
            background-color: var(--card-color);
        }
        
        [data-theme="dark"] .term-card {
            background-color: rgba(0, 0, 0, 0.2);
        }
        
        [data-theme="dark"] .search-wrapper input {
            color: var(--text-color);
        }
        
        /* Responsive Styling */
        @media (max-width: 768px) {
            .categories-grid {
                grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
                gap: 1rem;
            }
            
            .products-grid {
                grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            }
            
            .catalog-header h1 {
                font-size: 2rem;
            }
            
            .catalog-header p {
                font-size: 1rem;
            }
        }
        
        @media (max-width: 576px) {
            .categories-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .products-grid {
                grid-template-columns: 1fr;
            }
            
            .terms-container {
                grid-template-columns: 1fr;
            }
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
    </style>
</head>
<body>
    <?php include_once 'nav.php'; ?>

    <header class="catalog-header">
        <h1><?php echo !empty($category) ? ucfirst($category) : 'Explore Our Products'; ?></h1>
        <p><?php echo !empty($search_query) ? 'Search results for "' . htmlspecialchars($search_query) . '"' : 'Find the freshest produce and finest agricultural goods from around the world.'; ?></p>
    </header>

    <section class="search-section">
        <form action="" method="get">
            <div class="search-wrapper">
                <input type="search" name="search" id="searchField" placeholder="Search for agricultural products..." value="<?php echo htmlspecialchars($search_query); ?>" />
                <button type="submit"><i class="fas fa-search"></i></button>
            </div>
        </form>
    </section>

    <?php if (empty($category) && empty($search_query)): ?>
    <div class="container">
        <div class="section-title">
            <h2>Categories</h2>
            <p>Browse our selection of fresh agricultural products by category</p>
        </div>
    </div>

    <div class="categories-grid">
        <a href="catalog.php?category=grains" class="category-item">
            <div class="category-item-icon"><i class="fas fa-wheat-awn"></i></div>
            <img src="images/grains.avif" alt="Grains" onerror="this.src='https://img.freepik.com/free-photo/wheat-sack-pile-flour-wooden-table_1150-16555.jpg'">
            <p>Grains</p>
        </a>

        <a href="catalog.php?category=coffee" class="category-item">
            <div class="category-item-icon"><i class="fas fa-mug-hot"></i></div>
            <img src="images/coffee.avif" alt="Coffee" onerror="this.src='https://img.freepik.com/free-photo/coffee-beans-white-container-few-beans-wooden-floor_1150-17784.jpg'">
            <p>Coffee & Tea</p>
        </a>

        <a href="catalog.php?category=fruits" class="category-item">
            <div class="category-item-icon"><i class="fas fa-apple-alt"></i></div>
            <img src="images/fruits.avif" alt="Fruits" onerror="this.src='https://img.freepik.com/free-photo/fruit-salad-spilling-floor-still-life_23-2150397535.jpg'">
            <p>Fruits</p>
        </a>

        <a href="catalog.php?category=vegetables" class="category-item">
            <div class="category-item-icon"><i class="fas fa-carrot"></i></div>
            <img src="images/vegetables.avif" alt="Vegetables" onerror="this.src='https://img.freepik.com/free-photo/vegetables-set-left-black-slate_1220-685.jpg'">
            <p>Vegetables</p>
        </a>
        
        <a href="catalog.php?category=dairy" class="category-item">
            <div class="category-item-icon"><i class="fas fa-cheese"></i></div>
            <img src="images/dairy.jpeg" alt="Dairy" onerror="this.src='https://img.freepik.com/free-photo/milk-bottle-realistic-illustration_1284-34979.jpg'">
            <p>Dairy</p>
        </a>
        
        <a href="catalog.php?category=legumes" class="category-item">
            <div class="category-item-icon"><i class="fas fa-seedling"></i></div>
            <img src="https://img.freepik.com/free-photo/various-legumes-wooden-table_144627-12044.jpg" alt="Legumes">
            <p>Legumes</p>
        </a>
    </div>
    <?php endif; ?>

    <?php if (!empty($agricultural_terms) && isset($agricultural_terms['results']) && count($agricultural_terms['results']) > 0): ?>
    <div class="container">
        <div class="terms-section">
            <div class="section-title">
                <h2>Agricultural Knowledge</h2>
                <p>Learn more about agricultural terms and concepts</p>
            </div>
            
            <div class="terms-container">
                <?php foreach ($agricultural_terms['results'] as $term): ?>
                <div class="term-card">
                    <h3 class="term-name"><?php echo htmlspecialchars($term['prefLabel']); ?></h3>
                    <p class="term-definition"><?php echo htmlspecialchars($term['definition']); ?></p>
                    <?php if (!empty($term['narrower'])): ?>
                    <p class="term-related">
                        Related: <?php echo htmlspecialchars(implode(', ', array_slice($term['narrower'], 0, 3))); ?>
                    </p>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if (!empty($crops) && isset($crops['data']) && count($crops['data']) > 0): ?>
    <div class="container">
        <div class="section-title">
            <h2>Agricultural Products</h2>
            <p>Explore our selection of high-quality products</p>
        </div>
        
        <div class="products-grid">
            <?php foreach ($crops['data'] as $crop): ?>
            <div class="product-card">
                <div class="product-image">
                    <div class="product-badge"><?php echo htmlspecialchars($crop['area']); ?></div>
                    <?php 
                    // Determine image based on crop name
                    $image_url = 'https://img.freepik.com/free-photo/vegetables-set-left-black-slate_1220-685.jpg';
                    $crop_name = strtolower($crop['item']);
                    
                    if (strpos($crop_name, 'wheat') !== false) {
                        $image_url = 'https://img.freepik.com/free-photo/wheat-sack-pile-flour-wooden-table_1150-16555.jpg';
                    } elseif (strpos($crop_name, 'rice') !== false) {
                        $image_url = 'https://img.freepik.com/free-photo/rice-white-bowl-wooden-floor_1150-35450.jpg';
                    } elseif (strpos($crop_name, 'maize') !== false || strpos($crop_name, 'corn') !== false) {
                        $image_url = 'https://img.freepik.com/free-photo/corn-seeds-sack_1150-17464.jpg';
                    } elseif (strpos($crop_name, 'potato') !== false) {
                        $image_url = 'https://img.freepik.com/free-photo/raw-potatoes-wooden-surface_144627-43592.jpg';
                    } elseif (strpos($crop_name, 'tomato') !== false) {
                        $image_url = 'https://img.freepik.com/free-photo/fresh-red-tomatoes_144627-6910.jpg';
                    } elseif (strpos($crop_name, 'apple') !== false) {
                        $image_url = 'https://img.freepik.com/free-photo/red-apple-with-green-leaf_1101-453.jpg';
                    } elseif (strpos($crop_name, 'banana') !== false) {
                        $image_url = 'https://img.freepik.com/free-photo/bananas-white-background-perfectly-retouched_197589-4511.jpg';
                    } elseif (strpos($crop_name, 'coffee') !== false) {
                        $image_url = 'https://img.freepik.com/free-photo/coffee-beans-white-container-few-beans-wooden-floor_1150-17784.jpg';
                    } elseif (strpos($crop_name, 'soybean') !== false) {
                        $image_url = 'https://img.freepik.com/free-photo/soybeans-wooden-bowl-placed-sack_1150-35117.jpg';
                    } elseif (strpos($crop_name, 'sugarcane') !== false) {
                        $image_url = 'https://img.freepik.com/free-photo/sugar-cane-juice-jaggery-with-raw-sugarcane-wooden-surface_55610-2714.jpg';
                    }
                    ?>
                    <img src="<?php echo $image_url; ?>" alt="<?php echo htmlspecialchars($crop['item']); ?>">
                    <div class="product-overlay">
                        <a href="product-details.php?id=<?php echo $crop['code']; ?>" class="product-btn"><i class="fas fa-eye"></i></a>
                        <a href="#" class="product-btn add-to-cart" data-id="<?php echo $crop['code']; ?>"><i class="fas fa-shopping-cart"></i></a>
                        <a href="#" class="product-btn add-to-wishlist" data-id="<?php echo $crop['code']; ?>"><i class="fas fa-heart"></i></a>
                    </div>
                </div>
                <div class="product-content">
                    <h3 class="product-title"><?php echo htmlspecialchars($crop['item']); ?></h3>
                    <p class="product-category"><?php echo htmlspecialchars($crop['element']); ?></p>
                    <div class="product-meta">
                        <div class="product-price">
                            <?php 
                            // Calculate a sample price based on the crop value
                            $base_price = 1.99;
                            if (isset($crop['value']) && $crop['value'] > 0) {
                                // Use log scale to make price reasonable
                                $price = $base_price + (log10($crop['value']) / 2);
                                echo '$' . number_format($price, 2);
                            } else {
                                echo '$' . number_format($base_price, 2);
                            }
                            ?>
                        </div>
                        <div class="product-rating">
                            <?php
                            // Generate a random rating between 3.5 and 5
                            $rating = rand(35, 50) / 10;
                            for ($i = 1; $i <= 5; $i++) {
                                if ($i <= floor($rating)) {
                                    echo '<i class="fas fa-star"></i>';
                                } elseif ($i - $rating < 1 && $i - $rating > 0) {
                                    echo '<i class="fas fa-star-half-alt"></i>';
                                } else {
                                    echo '<i class="far fa-star"></i>';
                                }
                            }
                            ?>
                            <span>(<?php echo rand(10, 100); ?>)</span>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php elseif (!empty($search_query) || !empty($category)): ?>
    <div class="container text-center py-5">
        <div class="alert alert-info">
            <i class="fas fa-info-circle me-2"></i> No products found matching your criteria. Please try a different search.
        </div>
    </div>
    <?php endif; ?>

    <?php include_once 'footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Theme toggle functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Check for saved theme preference
            const savedTheme = localStorage.getItem('theme') || 'light';
            document.body.setAttribute('data-theme', savedTheme);
            
            // Add to cart functionality
            const addToCartButtons = document.querySelectorAll('.add-to-cart');
            addToCartButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const productId = this.getAttribute('data-id');
                    // Animation effect
                    this.innerHTML = '<i class="fas fa-check"></i>';
                    setTimeout(() => {
                        this.innerHTML = '<i class="fas fa-shopping-cart"></i>';
                    }, 1500);
                    // Alert for demo purposes
                    alert('Product added to cart! Product ID: ' + productId);
                });
            });
            
            // Add to wishlist functionality
            const wishlistButtons = document.querySelectorAll('.add-to-wishlist');
            wishlistButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    // Toggle heart icon
                    const icon = this.querySelector('i');
                    if (icon.classList.contains('far')) {
                        icon.classList.remove('far');
                        icon.classList.add('fas');
                        icon.style.color = '#e74c3c';
                    } else {
                        icon.classList.remove('fas');
                        icon.classList.add('far');
                        icon.style.color = '';
                    }
                });
            });
        });
    </script>
</body>
</html>