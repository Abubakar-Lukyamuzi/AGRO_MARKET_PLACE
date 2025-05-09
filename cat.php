<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Your trusted online marketplace for agricultural products and services">
    <title>Agro Market Place - Fresh Products Catalog</title>
    <link rel="stylesheet" href="cat.css"> <!-- Link to the external CSS stylesheet -->
</head>
<body>
   <?php 
   include_once 'nav.php'; // Include the navigation bar from an external PHP file
   ?>

    <div class="container">
        <!-- Premium Fruits Section -->
        <div class="section">
            <h2><a href="sellers.php?section=fruits">Premium Fruits</a></h2> <!-- Section header with a link to fruits -->
            <div class="row">
                <div class="column">
                    <div class="product-card">
                        <img src="images/apple.avif" alt="Fresh Apples"> <!-- Image of the product -->
                        <h3>Organic Apples</h3> <!-- Product name -->
                        <p>Crisp and juicy apples, grown without pesticides.</p> <!-- Product description -->
                        <p class="price">Ugx 7500/kg</p> <!-- Product price -->
                    </div>
                </div>
                <!-- Repeat for other fruits -->
                <div class="column">
                    <div class="product-card">
                        <img src="images/banana.avif" alt="Fresh Bananas">
                        <h3>Sweet Bananas</h3>
                        <p>Perfectly ripe and bursting with flavor.</p>
                        <p class="price">ugx 4500/kg</p>
                    </div>
                </div>
                <div class="column">
                    <div class="product-card">
                        <img src="images/orange.avif" alt="Fresh Oranges">
                        <h3>Juicy Oranges</h3>
                        <p>A refreshing burst of vitamin C in every bite.</p>
                        <p class="price">ugx 7800/kg</p>
                    </div>
                </div>
                <div class="column">
                    <div class="product-card">
                        <img src="images/mango.jpg" alt="Fresh Mangoes">
                        <h3>Sweet Mangoes</h3>
                        <p>A tropical delight, bursting with sweetness.</p>
                        <p class="price">ugx 9600/kg</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Organic Vegetables Section -->
        <div class="section">
            <h2><a href="sellers.php?section=vegetables">Organic Vegetables</a></h2> <!-- Section header with a link to vegetables -->
            <div class="row">
                <div class="column">
                    <div class="product-card">
                        <img src="images/tomatoes.avif" alt="Fresh Tomatoes">
                        <h3>Juicy Tomatoes</h3>
                        <p>Plump and flavorful, perfect for salads and sauces.</p>
                        <p class="price">ugx 4000/kg</p>
                    </div>
                </div>
                <!-- Repeat for other vegetables -->
                <div class="column">
                    <div class="product-card">
                        <img src="images/beans.avif" alt="Fresh Beans">
                        <h3>Crisp Green Beans</h3>
                        <p>Harvested at the peak of freshness.</p>
                        <p class="price">ugx 2500/kg</p>
                    </div>
                </div>
                <div class="column">
                    <div class="product-card">
                        <img src="images/broccoli.png" alt="Fresh Broccoli">
                        <h3>Nutrient-Rich Broccoli</h3>
                        <p>Packed with vitamins and minerals for a healthy boost.</p>
                        <p class="price">ugx 4200/kg</p>
                    </div>
                </div>
                <div class="column">
                    <div class="product-card">
                        <img src="images/spinach.avif" alt="Fresh Spinach">
                        <h3>Tender Spinach Leaves</h3>
                        <p>Nutrient-dense and perfect for salads or sautéing.</p>
                        <p class="price">ugx 3200/bunch</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Farm Fresh Dairy Section -->
        <div class="section">
            <h2><a href="sellers.php?section=dairy">Farm Fresh Dairy</a></h2> <!-- Section header with a