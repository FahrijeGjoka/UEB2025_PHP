<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
         <meta http-equiv="X-UA-Compatible" content="IE=edge">
         <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <title>UEB24_Gr30</title>
         <link rel="stylesheet" href="website.css">
         <script src="https://kit.fontawesome.com/5427edee06.js" crossorigin="anonymous"></script>

        </head>

    <body  onload = "start()">
        <div class="main">
          <div class="header">
    <p>
        <?php
        $userLoggedIn = false;

        if ($userLoggedIn) {
            echo '<a href="profile.php">Profile</a> <a href="#">|</a> <a href="logout.php">Logout</a>';
        } else {
            $authLinks = [
                ["label" => "Sign Up", "href" => "signup.php"],
                ["label" => "Login", "href" => "login.php"]
            ];

            echo '<a href="' . $authLinks[0]['href'] . '">' . $authLinks[0]['label'] . '</a>';
            echo '<a href="#">|</a>';
            echo '<a href="' . $authLinks[1]['href'] . '">' . $authLinks[1]['label'] . '</a>';
        }
        ?>
    </p>

    <div class="container">
        <?php
        $searchAction = ""; 
        $searchPlaceholder = "Search...";
        ?>
        <form action="<?php echo $searchAction; ?>" method="get" class="search-bar">
            <input type="text" name="s" id="s" placeholder="<?php echo $searchPlaceholder; ?>">
            <button type="submit" id="searchButton"><i class="fas fa-search"></i></button>
        </form>
    </div>
</div>

    <div class="body">
    <div class="two">
        <div class="logo">
            <svg width="110" height="110" xmlns="http://www.w3.org/2000/svg">
                <circle cx="55" cy="55" r="55" fill="#eacaca" />
                <text x="50%" y="50%" fill="white" font-size="100" font-family="Arial, sans-serif" font-weight="bold" text-anchor="middle" dominant-baseline="middle">
                    A
                </text>
            </svg>
        </div>

        <div class="brand">
            <?php
            $brandName = "Arom&eacute;";
            $byline = "The best perfume seller";
            ?>
            <h1 style="font-size: 50px;color: #eacaca;"><?php echo $brandName; ?></h1>
            <p class="byline" style="color:#eacaca;padding-bottom:20px;"><?php echo $byline; ?></p>
        </div>
    </div>

    <div class="kits">
        <?php
        $socialLinks = [
            ["url" => "https://www.linkedin.com/", "icon" => "fa-brands fa-linkedin-in"],
            ["url" => "https://x.com/?lang=en", "icon" => "fa-brands fa-twitter"],
            ["url" => "https://www.pinterest.com/", "icon" => "fa-brands fa-pinterest"],
            ["url" => "https://www.google.co.uk/", "icon" => "fa-brands fa-google"],
            ["url" => "https://www.wifimap.io/", "icon" => "fa-sharp fa-solid fa-wifi fa-rotate-90"]
        ];

        foreach ($socialLinks as $link) {
            echo '<a href="' . $link['url'] . '" target="_blank"><i class="' . $link['icon'] . '"></i></a>';
        }
        ?>
    </div>
</div>



        <div class="main-bar">
            <?php
            $navItems = [
                ["label" => "HOMEPAGE", "href" => "#", "class" => "link 1"],
                ["label" => "WOMEN", "href" => "women.php", "class" => "link 4"],
                ["label" => "MEN", "href" => "men.php", "class" => "link 4"],
                ["label" => "GALLERY", "href" => "gallery.html", "class" => "link 5"],
                ["label" => "ABOUT US", "href" => "aboutus.php", "class" => "link 7"],
                ["label" => "CONTACT", "href" => "contactus.php", "class" => "link 8"]
                ];

                foreach ($navItems as $item) {
                    echo '<a class="' . $item['class'] . '" href="' . $item['href'] . '">' . $item['label'] . '</a>';
                }
            ?>
        </div>

            
           <div class="images">
    <?php
    // Të dhënat dinamike
    $imageSrc = "img_0107.jpg";
    $imageAlt = "Arom&eacute;";
    $mainTitle = '"Unveiling Elegance, One Scent at a Time."';
    $description = 'At <u>Arom&eacute;</u>, we take pride in being recognized as the best-selling perfume company,
        setting the standard for luxury and excellence in the fragrance industry. 
        Our meticulously crafted perfumes are a harmonious blend of rare ingredients,
        timeless artistry, and innovative design. Loved by customers worldwide, our
        fragrances transcend trends, offering unique, captivating scents that leave an unforgettable 
        impression. Whether it\'s a signature scent for daily elegance or a bold aroma for special occasions,
        our collection caters to every taste, making us the ultimate destination for those seeking the finest in perfumery. 
        Experience why we are the top choice for fragrance enthusiasts everywhere.';
    $videoLink = "video.php";
    ?>

    <div class="first-pic">
        <img src="<?php echo $imageSrc; ?>" alt="<?php echo $imageAlt; ?>">
    </div>

    <div class="title">
        <h1 class="huge"><?php echo $mainTitle; ?></h1>
        <p class="paragraph"><?php echo $description; ?></p>
    </div>

    <div class="read-more">
        <p style="font-size: 20px; font-weight: bold;">
            <a style="color: #eacaca;" href="<?php echo $videoLink; ?>">SEE</a>
            <a style="color: #eacaca;" href="<?php echo $videoLink; ?>">VIDEOS</a>
            <a style="color: #eacaca;" href="<?php echo $videoLink; ?>">... </a>
        </p>
    </div>
</div>


            <div class="row">
            <div class="class1">
    <div class="title" style="font-style: italic;color: #eacaca;">
        <h1><l>Arom&eacute;'s Perfumes</l></h1>
    </div>

    
    <div class="text" style="color: #eacaca;">
        <h2 style="color: #ffcaca;">Top 5 Most Used Perfumes</h2>
        <ul>
            <!-- Pjesa ku jane perdorur vargjet asociative dhe sortimi i tyre ne descending order-->
            <?php
            
            $topPerfumes = [
                "Dior Sauvage" => 1500,
                "Chanel No. 5" => 1350,
                "Tom Ford Black Orchid" => 1200,
                "Prada Luna Rossa" => 980,
                "YSL La Nuit de l'Homme" => 860
            ];

            arsort($topPerfumes); 

            $rank = 1;
            foreach ($topPerfumes as $name => $uses) {
                echo "<li><strong>Top $rank:</strong> $name - <em>$uses uses</em></li>";
                $rank++;
            }
            ?>
        </ul>

        <hr style="border-color: #ffcaca; margin: 30px 0;">

        <h2 style="color: #ffcaca;">Top 5 Least Used Perfumes</h2>
        <ul>
            <!-- Pjesa ku jane perdorur vargjet asociative dhe sortimi i tyre ne ascending order-->
            <?php
            $leastUsedPerfumes = [
                "Calvin Klein CK One" => 200,
                "Nautica Voyage" => 250,
                "Davidoff Cool Water" => 300,
                "Azzaro Chrome" => 350,
                "Jaguar Classic Black" => 400
            ];

            asort($leastUsedPerfumes); 

            $rank = 1;
            foreach ($leastUsedPerfumes as $name => $uses) {
                echo "<li><strong>Top $rank:</strong> $name - <em>$uses uses</em></li>";
                $rank++;
            }
            ?>
        </ul>
    </div>

   <div class="more">
    <?php
    $moreLinkHref = "aboutus.php";
    $moreLinkText = "Read More About Us";
    ?>
    <a href="<?php echo $moreLinkHref; ?>"><?php echo $moreLinkText; ?></a>
</div>

</div>


<div class="class2">
    <?php
    $titleText = "Some Of Our Fragrances";
    $titleStyle = "font-style: italic; color: #eacaca;";
    ?>

    <div class="title2" style="<?php echo $titleStyle; ?>">
        <h1><?php echo $titleText; ?></h1>
    </div>


    <div class="services">
        <!-- Pjesa ku jane perdorur funksioni, vargjet multidimensionale dhe regEx-->
    <?php
    function perfumeDiscount($price) {
        $discount = 0.1; 
        $newPrice = $price - ($price * $discount);
                
        $regex = '/^[0-9]+(\.[0-9]{1,2})?$/';
        
        if (preg_match($regex, $newPrice)) {
            return number_format($newPrice, 2); 
        } else {
            return "Invalid Price"; 
        }
    }

    $perfumes = [
        [
            "name" => "Gucci Flora",
            "desc" => "Soft and romantic, featuring notes like rose, jasmine, or lily.",
            "image" => "floral.webp",
            "price" => 89.99
        ],
        [
            "name" => "Chanel Allure Home",
            "desc" => "Warm and sensual with hints of amber, vanilla, and exotic spices.",
            "image" => "ALLURE.avif",
            "price" => 120.00
        ],
        [
            "name" => "Tom Ford Noir De Noir ",
            "desc" => "Warm, earthy, and grounding scents like sandalwood, cedar, and vetiver.",
            "image" => "noir tomford.avif",
            "price" => 180.50
        ]
    ];

    foreach ($perfumes as $index => $perfume) {
        echo '
        <div class="service' . ($index + 1) . '">
            <div class="pic' . ($index + 1) . '">
                <img src="' . $perfume["image"] . '" style="border-radius: 20%;" alt="' . $perfume["name"] . '">
            </div>
            <div class="ser-name' . ($index + 1) . '">
                <h3 style="color: #eacaca; font-style: italic;">' . $perfume["name"] . '</h3>
                <p style="color: #eacaca; font-style: inherit;">' . $perfume["desc"] . '</p>
                <p style="color: #ffcaca; font-weight: bold;">On Sale: ' . perfumeDiscount($perfume["price"]) . ' EUR</p>
            </div>
        </div>';
    }
    ?>
</div>

    

                    <br><br>
                    <?php
                        $galleryLinkHref = "gallery.html";
                        $galleryLinkText = "View Our Gallery ...";
                        ?>

                        <div class="more2">
                            <a href="<?php echo $galleryLinkHref; ?>"><?php echo $galleryLinkText; ?></a>
                        </div>

                    <br>
                </div>

                <?php
    $sectionTitle = "What Our Clients Say";
    $sectionStyle = "font-style: italic; color: #eacaca;";

    $testimonials = [
        [
            "name" => "Sarah L",
            "quote" => "I’ve been a loyal customer for years, and this company never disappoints! Their fragrances are luxurious, long-lasting, and always receive compliments. Simply the best in the industry!"
        ],
        [
            "name" => "James T",
            "quote" => "Every perfume I’ve purchased is a masterpiece. The quality, packaging, and unique scents make it clear why they’re a best seller. I wouldn’t go anywhere else for my fragrances!"
        ],
        [
            "name" => "Elena R",
            "quote" => "From the moment you open the bottle, you can tell this company puts their heart into their craft. The scents are sophisticated, memorable, and worth every penny. Truly exceptional!"
        ],
    ];
    ?>

    <div class="class3">
        <div class="all">
            <div class="h-title" style="<?php echo $sectionStyle; ?>">
                <h1><?php echo $sectionTitle; ?></h1>
            </div>

            <div class="clients">
                <?php foreach ($testimonials as $index => $client): ?>
                    <div class="client<?php echo $index + 1; ?>">
                        <i class="fa-solid fa-quote-left"></i>
                        <h3 style="color: #eacaca;">- <?php echo htmlspecialchars($client['name']); ?></h3>
                        <br><br><br>
                    </div>
                    <p style="color: #eacaca; font-style: italic;">
                        "<?php echo htmlspecialchars($client['quote']); ?>"
                    </p>
                    <br><br><br><br>
                <?php endforeach; ?>
            </div>
        </div>
    </div>


        </div>
        </div>

      <?php
$tweets = [
    "Unveil the essence of elegance ✨. Try our newest fragrance, Velvet Bloom, and let your presence linger long after you've left the room. 🌹 <i>#LuxuryPerfume #FragranceLovers</i>",
    "Spray happiness, one spritz at a time. 💕 Discover the secret behind our best-seller, Golden Whisper. It's more than a perfume—it's a mood.<i> #FragranceGoals #BestSeller</i>",
    "Hello, winter! ❄️ Cozy up with our new limited-edition Winter Mist, a blend of vanilla, amber, and warm spices. Perfect for those frosty evenings. <i>#SeasonalFragrance #PerfumeLove</i>",
    "Every bottle tells a story. 🌿 Our fragrances are crafted with passion and sustainability in mind. Here's a sneak peek behind the creation of Eau Lumière. 🌍✨ <i>#SustainableLuxury #PerfumeJourney</i>",
    "Every day is an opportunity to reinvent yourself. Start with your signature scent. 🌟✨ <i>#NewBeginnings #SignatureFragrance</i>"
];

$collaborations = [
    ["Tom Ford", "https://www.tomfordbeauty.com/contact-us"],
    ["Ari Fragrance", "https://arianagrandefragrances.com/"],
    ["Chanel", "https://www.chanel.com/us/fragrance/"],
    ["Cologne", "https://www.yslbeautyus.com/fragrance/mens-fragrances/"],
    ["Dior", "https://shop-beauty.dior.sa/collections/collection-privee-christian-dior-perfumes"],
    ["Prada", "https://www.prada-beauty.com/fragrance/"]
];

$blogPosts = [
    [
        "title" => "Floral Fragrance",
        "author" => "Eneida",
        "date" => "Friday, 6th December 2024",
        "content" => "Introducing Our New Floral Fragrance Collection! 
                            🌸 Immerse yourself in a garden of elegance with our latest arrivals, 
                            crafted to capture the essence of blooming beauty.
                            From the romantic allure of roses to the fresh sweetness of jasmine and the exotic touch of orchids, 
                            each scent is a celebration of nature's finest blossoms.
                            Perfect for adding a touch of sophistication to your everyday or elevating those special moments,
                            these fragrances are designed to leave a lasting impression. 
                            Discover your signature floral scent today and let your presence bloom wherever you go. 🌼✨..."
    ],
    [
        "title" => "New Luxury Fragrances",
        "author" => "Fiorentina",
        "date" => "Thursday, 21st November 2024",
        "content" => "✨ Unveil the Art of Sophistication with Our New Luxury Fragrance
                            Collection! ✨ Indulge in the pinnacle of elegance with our latest arrivals,
                            meticulously crafted for those who appreciate the finer things in life.
                            Featuring a harmonious blend of rare ingredients—like oud, ambergris,
                            and exotic florals—each scent tells a story of opulence and refinement.
                            Designed to make every moment extraordinary, these fragrances are more than a scent—they're an experience.
                            Elevate your essence with a touch of luxury and discover the aroma that defines you. 🌟..."
    ]
];
?>

<section>
    <div class="row2">
        <div class="first-foot" style="padding: 10px;">
            <h3 style="color: #2c3e50;"><u>LATEST TWEETS</u></h3>
            <?php foreach ($tweets as $tweet): ?>
                <p style="color: #eacaca;"><b style="color: #eacaca;">@Arom&eacute;</b>: "<?php echo $tweet; ?>"</p><br>
            <?php endforeach; ?>
        </div>

        <div class="second-foot" style="padding: 30px; margin-left: 40px;">
            <h3 style="color: #2c3e50;"><u>~ COLLABORATIONS ~</u></h3><br>
            <?php foreach ($collaborations as $collab): ?>
                <p><a href="<?php echo $collab[1]; ?>"> ~ <?php echo $collab[0]; ?></a></p><br>
            <?php endforeach; ?>
        </div>

        <div class="third-foot" style="padding-top: 30px;">
            <h3 style="color: #2c3e50"><u> ~ LATEST BLOG POST ~ </u></h3><br><br>
            <?php foreach ($blogPosts as $post): ?>
                <h5 style="color: rgb(138, 131, 131);"><?php echo $post["title"]; ?></h5>
                <p style="color: rgb(138, 131, 131);"><b style="color: #eacaca;"><?php echo $post["author"]; ?></b></p>
                <p style="color: rgb(87, 85, 85);"><?php echo $post["date"]; ?></p><br>
                <p style="color: #2c3e50; width: 300px;"><?php echo $post["content"]; ?>...</p><br><br>
            <?php endforeach; ?>
        </div>

        <div class="contact-form" style="padding-top: 30px;">
            <h2>Suggestions</h2>
            <form method="POST" action="submit_suggestions.php">
                <input type="text" name="name" class="field" placeholder="Name" required>
                <input type="email" name="email" class="field" placeholder="Email" required>
                <input type="text" name="subject" class="field" placeholder="Subject" required>
                <textarea name="message" class="field" placeholder="Message" required></textarea>
                <button type="submit" class="submit-button">Submit</button>
            </form>
        </div>
    </div>
</section>


    </div>

    <?php
$tel = "+38349001001";
$formattedTel = preg_replace("/^[+]383([0-9]{2})([0-9]{3})([0-9]{3})$/", "$1 $2 $3", $tel);
$formattedTel = "+383 " . $formattedTel;
$email = "info@arome.com";
$main_address = "<span>Main address:</span>";

$qytetet = ["Prizren", "Peje", "Tirane"];

$socials = ["Facebook", "Twitter", "Instagram", "LinkedIn"];

$ekipi = [
    ["emri" => "Elsa Krasniqi", "pozita" => "CEO"],
    ["emri" => "Ereza Greicevci", "pozita" => "Marketing Director"],
    ["emri" => "Fahrije Gjokiqi", "pozita" => "Product Manager"],
    ["emri" => "Elona Kuqi", "pozita" => "Section1 Manager"],
    ["emri" => "Era Berisha", "pozita" => "Section2 Manager"]
];

$kompania = "Aromé";
$data = date("Y-m-d");
?>

<div class="footer">
    <div class="footer-container">
        <table class="footer-table">
            <tr>
                <td class="footer-section contact-info">
                    <h3><i>Contact Us</i></h3>
                    <p>Email: <a href="mailto:<?php echo $email; ?>"><mark style="color: #eacaca;"><?php echo $email; ?></mark></a></p>
                    
                    <p>Phone: <a href="tel:<?php echo $tel; ?>"><?php echo $formattedTel; ?></a></p>

                    <ul>
                        <?php var_dump($main_address); ?>
                        <li>
                            <p><address>Location: Rruga Adem Jashari, Prishtine, Kosove</address></p>
                        </li>
                        <ul>You can find us in other cities:
                            <?php foreach ($qytetet as $qytet): ?>
                                <li style="list-style-type: circle;"><?php echo $qytet; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </ul>
                    <p><abbr><?php echo $kompania; ?></abbr></p>
                </td>

                <td class="footer-section social-media">
                    <h3><i>Follow Us</i></h3>
                    <?php foreach ($socials as $social): ?>
                        <a href="#" class="social-icon"><?php echo $social; ?></a><br>
                    <?php endforeach; ?>
                </td>
            </tr>

            <tr>
                <td class="footer-section company-staff">
                    <h3><i>Our Team</i></h3>
                    <ol>
                        <?php foreach ($ekipi as $anetar): ?>
                            <li><?php echo $anetar["emri"] . " - " . $anetar["pozita"]; ?></li>
                        <?php endforeach; ?>
                    </ol>
                </td>

                <td class="footer-section company-photo">
                    <h3><i><?php echo $kompania; ?></i></h3>
                    <img src="company.avif" alt="Company Building" />
                </td>
            </tr>
        </table>
    </div>

    <p class="footer-credit">© <span><?php echo $data; ?></span> <?php echo $kompania; ?>. All Rights Reserved.</p>
</div>


    <script>
        const submitButton = document.querySelector('.submit-button');
        submitButton.addEventListener('click', function(event) {
            event.preventDefault();
            alert('Button clicked!');
        });

        document.getElementById('searchButton').addEventListener('click', function(event) {
        event.preventDefault();       
	    const searchQuery = document.getElementById('s').value.trim();
        const parfume = searchForPerfume(searchQuery); 

        try {
            if (!parfume) throw "Gabim: Parfumi nuk ekziston!";
            console.log(parfume);
            alert("Parfumi është gjetur!");
        } catch (error) {
            console.error(error);
            alert(error); 
        }
    });

    function searchForPerfume(query) {
               if (query === "") {
            return null;
        }
        const parfumeList = ["Dior", "Chanel", "Gucci", "Tom Ford", "Prada", "YSL", "Good Girl", "Versace", "Armani", "Valentino"];
        return parfumeList.includes(query) ? query : null;
    }

    

    </script>

    </body>

</html> 