<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Sets the character encoding for the document -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Ensures the page is responsive on different devices -->
    <title>About Us - Agro Market Place</title> <!-- Title of the webpage -->
    <link rel="stylesheet" href="about us.css"> <!-- Link to the external CSS file for styling -->
</head>
<body>

    <header>
        <h1>Agro Market Place</h1> <!-- Main title of the website -->
        <?php
        include_once 'nav.php'; // Includes the navigation menu from an external PHP file
        ?>
        <h4>About Us</h4> <!-- Subtitle for the About Us section -->
    </header>

    <section class="about-section">
        <div class="container"> <!-- Container for the content to maintain layout -->
            <div class="about-content">
                <h2>Our Mission</h2> <!-- Mission statement heading -->
                <p>To create a thriving online marketplace that connects farmers with consumers, promoting sustainable agriculture and local economies.</p> <!-- Mission statement description -->
            </div>

            <div class="about-content">
                <h2>Our Story</h2> <!-- Story heading -->
                <p>Founded in 2025, Agro Market Place was born out of a passion for fresh, locally sourced produce. We saw a need for a platform that would eliminate the middleman and allow farmers to sell directly to consumers.</p> <!-- Description of the company's origin -->
            </div>

            <div class="about-content">
                <h2>How We Work</h2> <!-- Explanation of the operational model -->
                <p>Our user-friendly platform allows farmers to list their products, set their own prices, and manage their orders. Customers can easily browse through a wide variety of produce, place orders, and enjoy convenient delivery options.</p> <!-- Description of the platform's functionality -->
            </div>
        </div>
    </section>

    <section class="team-section">
        <h2>Meet Our Team</h2> <!-- Team section heading -->
        <div class="team-container"> <!-- Container for team members -->
            <div class="team-member">
                <figure>
                    <img src="images/tiifah.jpeg" alt="Queen"> <!-- Image of team member -->
                    <figcaption>QUEEN LATIIFAH</figcaption> <!-- Caption for the image -->
                </figure>
                <p>Working together, great ideas can emerge from collaboration. Every small effort counts. Embrace the process of growth and improvement.</p> <!-- Description of the team member -->
            </div>
            <div class="team-member">
                <figure>
                    <img src="images/nico.jpeg" alt="Nico"> <!-- Image of team member -->
                    <figcaption>KAMUSIIME NICHOLAS</figcaption> <!-- Caption for the image -->
                </figure>
                <p>Embrace support and collaboration. Open doors to new opportunities. By working together, we can achieve remarkable results.</p> <!-- Description of the team member -->
            </div>
            <div class="team-member">
                <figure>
                    <img src="images/godwin.jpeg" alt="tandeka"> <!-- Image of team member -->
                    <figcaption>TANDEKA GODWIN</figcaption> <!-- Caption for the image -->
                </figure>
                <p>The boat gate.Ihave a different casino. The mountains will give birth to their companions,the feathered ones and the great push,and the mouse will be born.There is no reason</p> <!-- Description of the team member (note: this text seems nonsensical) -->
            </div>
            <div class="team-member">
                <figure>
                    <img src="images/lahus.jpeg" alt="Hussein"> <!-- Image of team member -->
                    <figcaption>LUKYAMUZI ABUBAKAR HUSSEIN</figcaption> <!-- Caption for the image -->
                </figure>
                <p>There are no limits. Embrace challenges with confidence. Today is an opportunity to grow, learn, and move forward. Approach every task with determination and clarity.</p> <!-- Description of the team member -->
            </div>
        </div>
    </section>

    <footer>
        <p>&copy; 2025 Agro Market Place. All rights reserved.</p> <!-- Footer with copyright notice -->
    </footer>

</body>
</html>