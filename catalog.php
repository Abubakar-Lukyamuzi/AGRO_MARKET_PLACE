<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" /> <!-- Set character encoding to UTF-8 -->
    <title>AGRO MARKET PLACE</title> <!-- Title of the webpage -->
    <link rel="stylesheet" href="catalog.css"> <!-- Link to external CSS file for styling -->
</head>
<body>
<header>
    <h1>AGRO MARKET PLACE</h1> <!-- Main heading of the webpage -->
</header>

<?php
 include_once 'nav.php'; // Include the navigation menu from nav.php
?>

<section class="search-section">
    <form action="" method="get"> <!-- Form for searching items -->
        <input type="search" name="search" id="searchField" placeholder="What are you looking for?" /> <!-- Search input field -->
        <button type="submit">Search</button> <!-- Search button -->
    </form>
</section>

<center><h3>Grab your taste......🍌🍉🍇🥭😜</h3></center> <!-- Centered message to attract users -->

<p style="text-align: center;">Select a category to view more:</p> <!-- Prompt for users to select a category -->

<div class="categories"> <!-- Container for category links -->
    <a href="cat.php"> <!-- Link to the Grains category -->
        <img src="images/grains.avif" alt="Grains"> <!-- Image for Grains category -->
        <p>Grains</p> <!-- Label for Grains category -->
    </a>

    <a href="cat.php"> <!-- Link to the Coffee category -->
        <img src="images/coffee.avif" alt="Coffee"> <!-- Image for Coffee category -->
        <p>Coffee</p> <!-- Label for Coffee category -->
    </a>

    <a href="cat.php"> <!-- Link to the Fruits category -->
        <img src="images/fruits.avif" alt="Fruits"> <!-- Image for Fruits category -->
        <p>Fruits</p> <!-- Label for Fruits category -->
    </a>

    <a href="cat.php"> <!-- Link to the Leafy Vegetables category -->
        <img src="images/vegetables.avif" alt="Leafy Vegetables"> <!-- Image for Leafy Vegetables category -->
        <p>Leafy Vegetables</p> <!-- Label for Leafy Vegetables category -->
    </a>
</div>

</body>
</html>