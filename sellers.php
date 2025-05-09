<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Contacts</title>
    <link rel="stylesheet" href="sellers.css">
    
</head>
<body>
<?php
// Get the selected section from the URL
$section = $_GET['section'];

// Display sellers related to the selected section
if ($section == 'fruits') {
    echo '<h1>Fresh Fruits Sellers</h1>';
    // Display fruit sellers
} elseif ($section == 'vegetables') {
    echo '<h1>Fresh Vegetables Sellers</h1>';
    // Display vegetable sellers
} elseif ($section == 'leafygreens') {
    echo '<h1>Leafy Greens Sellers</h1>';
    // Display leafy greens sellers
} elseif ($section == 'coffee') {
    echo '<h1>Specialty Coffee Sellers</h1>';
    // Display coffee sellers
} elseif ($section == 'grains') {
    echo '<h1>Whole Grains Sellers</h1>';
    // Display grain sellers
} else {
    echo '<h1>No sellers found for this section</h1>';
}
?>
    <h1>Contact Sellers</h1>

    <div class="seller-container">
        <div class="seller">
            <h2>Seller 1</h2>
            <div class="contact-info">
                Phone:0787812345<br>
                Email: kelvin@gmail.com
            </div>
            <a href="mailto:kelvin@gmail.com" class="button">Contact Seller</a>
        </div>

        <div class="seller">
            <h2>Seller 2</h2>
            <div class="contact-info">
                Phone: 0774676775<br>
                Email: sarah12@gmail.com
            </div>
            <a href="mailto:sarah12@gmail.com" class="button">Contact Seller</a>
        </div>

        <div class="seller">
            <h2>Seller 3</h2>
            <div class="contact-info">
                Phone: 0800123321<br>
                Email: john@gmail.com
            </div>
            <a href="mailto:john@gmail.com" class="button">Contact Seller</a>
        </div>

        <div class="seller">
            <h2>Seller 4</h2>
            <div class="contact-info">
                Phone: 0712686889<br>
                Email: emmak@gmail.com
            </div>
            <a href="mailto:emmak@gmail.com" class="button">Contact Seller</a>
        </div>

        <div class="seller">
            <h2>Seller 5</h2>
            <div class="contact-info">
                Phone: +256 890-1234<br>
                Email: hansel125@gmail.com
            </div>
            <a href="mailto:hansel125@gmail.com" class="button">Contact Seller</a>
        </div>
    </div>

</body>
</html>