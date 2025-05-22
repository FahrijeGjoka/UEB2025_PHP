<?php
/*session_start();

function handleUserSession() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }

    if (!isset($_SESSION['visit_count'])) {
        $_SESSION['visit_count'] = 1;
    } else {
        $_SESSION['visit_count']++;
    }
}

handleUserSession();*/

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

$menPerfumes = [
    ["Fresh & Citrus", "Lemon, Bergamot, Grapefruit, Mandarin", "Light and energizing fragrances, perfect for daily wear and summer vibes."],
    ["Woody & Earthy", "Cedarwood, Vetiver, Oakmoss, Sandalwood", "Deep, rich, and masculine scents with a grounding, natural feel."],
    ["Spicy & Warm", "Cinnamon, Clove, Black Pepper, Nutmeg", "Warm and exotic aromas that add a sense of adventure and mystery."],
    ["Aromatic & Herbal", "Lavender, Rosemary, Thyme, Sage", "Clean, fresh, and herbal scents that evoke calm and sophistication."]
];

$womenPerfumes = [
    ["Floral & Romantic", "Rose, Jasmine, Peony, Orchid", "Elegant and feminine, these scents are timeless and beautiful."],
    ["Fruity & Sweet", "Strawberry, Mango, Peach, Passionfruit", "Playful and youthful scents filled with the sweetness of fresh fruits."],
    ["Gourmand & Delicious", "Vanilla, Chocolate, Caramel, Honey", "Sweet and indulgent aromas that evoke the essence of tasty treats."],
    ["Fresh & Aquatic", "Water Lily, Sea Breeze, Cucumber, Green Tea", "Refreshing and clean fragrances inspired by the ocean and fresh air."]
];

function renderPerfumeTable($perfumes) {
    $html = "<table>";
    $html .= "<tr><th>Type</th><th>Fragrance Notes</th><th>Description</th></tr>";
    foreach ($perfumes as $p) {
        $html .= "<tr><td>{$p[0]}</td><td>{$p[1]}</td><td>{$p[2]}</td></tr>";
    }
    $html .= "</table>";
    return $html;
}

echo "<!DOCTYPE html><html lang='en'><head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>$pageTitle</title>
        <link rel='stylesheet' href='CSS/aboutus.css'>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css'>
    </head><body>";



echo "<header>
        <h1>$brandName</h1>
        <nav>
            <ul>
                <li><a href='#'>Homepage</a></li>
                <li><a href='#about'>About</a></li>
                <li><a href='#types'>Types</a></li>
                <li><a href='#contact'>Contact</a></li>
            </ul>
        </nav>
    </header>";

echo "<section id='about'>
        <h2>About " . strtolower($brandName) . "</h2>
        <p>$aboutText</p>
        <img src='images/lancome.jpg' alt='Perfume bottles' width=300>
    </section>";


echo "<section id='types'>
        <h2>Types of Perfumes</h2>
        <h3>Men's Perfumes</h3>" . renderPerfumeTable($menPerfumes) .
      "<h3>Women's Perfumes</h3>" . renderPerfumeTable($womenPerfumes) .
    "</section>";

echo "<section id='contact'>
        <h2>Contact Us</h2>
        <p>Have questions? <a href='mailto:$contactEmail'>Email us</a> and we will get back to you soon!</p>
    </section>";

echo "<button id='backToTopButton'>⬆️ Back to Top</button>";

echo "<footer class='site-footer'>
        <p>Follow us on:</p>
        <div class='footer-icons'>";
foreach ($socialLinks as $platform => $url) {
    echo "<a href='$url' target='_blank' aria-label='Follow us on $platform'><i class='fab fa-$platform'></i></a>";
}
/*echo "</div>
      <p>Ju keni vizituar këtë faqe " . $_SESSION['visit_count'] . " herë gjatë këtij sesioni.</p>
      <p>&copy; " . date("Y") . " " . htmlspecialchars(strtolower($brandName)) . ". All Rights Reserved.</p>
      <p><a href='website.html' target='_blank'>Visit our official page</a></p>
    </footer>";*/



echo "<script>
        const btn = document.getElementById('backToTopButton');
        window.onscroll = function() {
            if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
                btn.style.display = 'block';
            } else {
                btn.style.display = 'none';
            }
        };
        btn.onclick = function() {
            window.scrollTo({top: 0, behavior: 'smooth'});
        };
    </script>";

echo "</body></html>";
?>
