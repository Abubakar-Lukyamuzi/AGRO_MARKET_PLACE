<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>AGRO MARKET PLACE</title>
    <link rel="stylesheet" href="faqs.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com"> <!-- Preconnect to Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> <!-- Preconnect for font loading -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"> <!-- Roboto font from Google Fonts -->
</head>
<body>
<?php
 include_once 'nav.php';
 ?>
   <h2>FREQUENTLY ASKED QUESTIONS</h2> 
   <P>
   <details>
            <summary>How can I pay?</summary>
            <p>
                You can pay using mobile money.
                Its advaisable to always pay after receiving what you ordered for to avoid being scummed.
            </p>
        </details><br>
        <details>
            <summary>What is an online market place?</summary>
            <p>This is a digital platform where farmers,producers,and consumers can buy and sell agricultural products directly.This marketplace facilitates transactions for fresh produce,livestock,grains and other farm-related goods.</p>
        </details><br>
        <details>
            <summary>How do I register as a seller?</summary>
            <p>To register as a seller, you typically need to create an account on the marketplace platform. This process may involve providing details about your farm, the products you wish to sell, and any necessary certifications or licenses.</p>
        </details><br>
        <details>
            <summary>What types of products can I sell?</summary>
            <p>You can sell a variety of agricultural products, including fruits, vegetables, grains, dairy products, meat, and even handmade goods like jams or crafts. Ensure that your products comply with local regulations and quality standards.</p>
        </details><br>
        <details>
            <summary>Are there fees associated with selling on the platform?</summary>
            <p>Most online marketplaces charge fees, which can include listing fees, transaction fees, or a percentage of sales. It’s important to review the fee structure of the specific platform you choose to understand the costs involved.</p>
        </details><br>
        <details>
            <summary>How do I handle shipping and delivery?</summary>
            <p>Shipping and delivery options vary by your location. Sometimes may offer integrated shipping solutions, while others may require sellers to manage their own logistics. It’s essential to clarify these details during the registration process.</p>
        </details>
        <br>
        <details>
            <summary>Can I sell products that I grow informally?</summary>
            <p>Yes,Agro Market Place allow informal producers to sell their products. However, you may need to check the specific requirements of the platform regarding quality standards and any necessary documentation.</p>
        </details><br>
        <details>
            <summary>What support is available for new sellers?</summary>
            <p>Agro Market Place provides resources such as FAQs, tutorials, and customer support to help new sellers navigate the platform. It also offers marketing assistance to promote your products.</p>
        </details><br>
        <details>
            <summary>How can I ensure the quality of my products?</summary>
            <p>Maintaining high-quality standards is crucial for success. Regularly inspect your products, adhere to best agricultural practices, and consider obtaining certifications that demonstrate quality and safety.</p>
        </details><br>
        <details>
            <summary>How can I promote my products effectively?</summary>
            <p>Utilize social media, email marketing, and the marketplace’s promotional tools to reach potential customers. Engaging with your audience through storytelling about your farm and products can also enhance visibility.</p> 
        </details>
   </P>
   <script>
    document.querySelectorAll('.faq-question').forEach(item => {
        item.addEventListener('click', () => {
            const answer = item.nextElementSibling;
            answer.style.display = answer.style.display === 'block' ? 'none' : 'block';
        });
    });
</script>
   

</body>
</html>