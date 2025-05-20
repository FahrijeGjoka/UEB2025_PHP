<?php
    $pageTitle = "About Us - aromé";
    $brandName = "Aromé";
    $aboutText = "Aromé offers a diverse collection of perfumes crafted for both women and men. Blending premium ingredients with unique scents, our fragrances cater to every style and occasion, delivering elegance and individuality in every bottle.";
    $contactEmail = "info@arome.com";
    $socialLinks = [
        "facebook" => "https://www.facebook.com",
        "instagram" => "https://www.instagram.com",
        "twitter" => "https://www.twitter.com",
        "linkedin" => "https://www.linkedin.com"
    ];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="aboutus.css?v=1.1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <!-- HEADER -->
    <header>
        <h1><?php echo $brandName; ?></h1>
        <nav>
            <ul>
                <li><a href="website.php">Homepage</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#types">Types of Perfumes</a></li>
                <li><a href="#contact">Contact Us</a></li>
            </ul>
        </nav>
    </header>

    <canvas id="aboutCanvas" width="300" height="70"></canvas>

    <!-- ABOUT SECTION -->
    <section id="about">
        <h2>About <?php echo strtolower($brandName); ?></h2>
        <p><?php echo $aboutText; ?></p>
        <img src="lancome2.jpg" alt="Perfume bottles" width="300" height="200">
    </section>

    <!-- TYPES OF PERFUMES SECTION -->
    <section id="types">
        <h2 style="color: #2c3e50">Types of Perfumes</h2>

        <h4>Men's Perfumes</h4>
        <?php
        $menPerfumes = [
            ["Fresh & Citrus", "Lemon, Bergamot, Grapefruit, Mandarin", "Light and energizing fragrances, perfect for daily wear and summer vibes."],
            ["Woody & Earthy", "Cedarwood, Vetiver, Oakmoss, Sandalwood", "Deep, rich, and masculine scents with a grounding, natural feel."],
            ["Spicy & Warm", "Cinnamon, Clove, Black Pepper, Nutmeg", "Warm and exotic aromas that add a sense of adventure and mystery."],
            ["Aromatic & Herbal", "Lavender, Rosemary, Thyme, Sage", "Clean, fresh, and herbal scents that evoke calm and sophistication."]
        ];
        ?>
        <table>
            <tr><th>Type</th><th>Fragrance Notes</th><th>Description</th></tr>
            <?php foreach ($menPerfumes as $perfume): ?>
                <tr>
                    <td><?php echo $perfume[0]; ?></td>
                    <td><?php echo $perfume[1]; ?></td>
                    <td><?php echo $perfume[2]; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <h4>Women's Perfumes</h4>
        <?php
        $womenPerfumes = [
            ["Floral & Romantic", "Rose, Jasmine, Peony, Orchid", "Elegant and feminine, these scents are timeless and beautiful."],
            ["Fruity & Sweet", "Strawberry, Mango, Peach, Passionfruit", "Playful and youthful scents filled with the sweetness of fresh fruits."],
            ["Gourmand & Delicious", "Vanilla, Chocolate, Caramel, Honey", "Sweet and indulgent aromas that evoke the essence of tasty treats."],
            ["Fresh & Aquatic", "Water Lily, Sea Breeze, Cucumber, Green Tea", "Refreshing and clean fragrances inspired by the ocean and fresh air."]
        ];
        ?>
        <table>
            <tr><th>Type</th><th>Fragrance Notes</th><th>Description</th></tr>
            <?php foreach ($womenPerfumes as $perfume): ?>
                <tr>
                    <td><?php echo $perfume[0]; ?></td>
                    <td><?php echo $perfume[1]; ?></td>
                    <td><?php echo $perfume[2]; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </section>

    <!-- CONTACT SECTION -->
    <section id="contact">
        <h2>Contact Us</h2>
        <p>Have questions? <a href="mailto:<?php echo $contactEmail; ?>">Email us</a> and we will get back to you soon!</p>
    </section>

    <button id="backToTopButton">⬆️ Back to Top</button>

    <footer>
        <div class="map-container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d46940.21158541913!2d21.117527700884004!3d42.66637271822324!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x13549ee605110927%3A0x9365bfdf385eb95a!2sPristina!5e0!3m2!1sen!2s!4v1734292238699!5m2!1sen!2s"
                width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
        <p>Follow us on</p>
        <div class="footer-icons">
            <?php foreach ($socialLinks as $platform => $url): ?>
                <a href="<?php echo $url; ?>" target="_blank"><i class="fab fa-<?php echo $platform; ?>"></i></a>
            <?php endforeach; ?>
        </div>
        <p>&copy; <?php echo date("Y"); ?> <?php echo strtolower($brandName); ?>. All Rights Reserved.</p>
        <a href="website.html" target="_blank">Visit our official page</a>
    </footer>

    <script src="aboutus.js"></script>
</body>

</html>
