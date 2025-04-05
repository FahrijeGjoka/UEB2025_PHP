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
                <p><a href="signup.html">Sign Up</a><a href="#">|</a><a href="login.html">Login</a></p>

                <div class="container">
                    <form action="" method="get" class="search-bar">
                        <input type="text" name="s" id="s">
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
                    <h1 style="font-size: 50px;color: #eacaca;">Arom&eacute;</h1>
                    <p class="byline" style="color:#eacaca;padding-bottom:20px;">The best perfume seller</p>
                </div>
            </div>

                <div class="kits">
                    <a href="https://www.linkedin.com/" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a>
                    <a href="https://x.com/?lang=en" target="_blank"><i class="fa-brands fa-twitter"></i></a>
                    <a href="https://www.pinterest.com/" target="_blank"><i class="fa-brands fa-pinterest"></i></a>
                    <a href="https://www.google.co.uk/" target="_blank"><i class="fa-brands fa-google"></i></a>
                    <a href="https://www.wifimap.io/" target="_blank"><i class="fa-sharp fa-solid fa-wifi fa-rotate-90"></i></a>
                </div>
            </div>

            <div class="main-bar">
                <a class="link 1" href="#">HOMEPAGE</a>
                <a class="link 4" href="women.html">WOMEN</a>
                <a class="link 4" href="men.html">MEN</a>
                <a class="link 5" href="gallery.html">GALLERY</a>
                <a class="link 7" href="aboutus.html">ABOUT US</a>
                <a class="link 8" href="contactus.html">CONTACT</a>
            </div>
            
            <div class="images">
                <div class="first-pic">
                    <img src="img_0107.jpg" alt="Arom&eacute;">
                </div>
                <div class="title">
                    <h1 class="huge">"Unveiling Elegance, One Scent at a Time."</h1>

                    <p class="paragraph">At <u>Arom&eacute;</u>, we take pride in being recognized as the best-selling perfume company,
                        setting the standard for luxury and excellence in the fragrance industry. 
                        Our meticulously crafted perfumes are a harmonious blend of rare ingredients,
                        timeless artistry, and innovative design. Loved by customers worldwide, our
                        fragrances transcend trends, offering unique, captivating scents that leave an unforgettable 
                        impression. Whether it's a signature scent for daily elegance or a bold aroma for special occasions,
                        our collection caters to every taste, making us the ultimate destination for those seeking the finest in perfumery. 
                        Experience why we are the top choice for fragrance enthusiasts everywhere.</p>
                </div>

                <div class="read-more">
                    <p style="font-size: 20px; font-weight: bold;"><a style="color: #eacaca;" href="video.html">SEE</a> <a style="color: #eacaca;" href="video.html">VIDEOS</a> <a style="color: #eacaca;" href="video.html">... </a></p>
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
        <a href="aboutus.html">Read More About Us</a>
    </div>
</div>


                <div class="class2">
    <div class="title2" style="font-style: italic;color: #eacaca;">
        <h1>Some Of Our Fragrances</h1>
    </div>

    <div class="services">
    <div class="services">
    <?php
    function perfumeDiscount($price) {
        $discount = 0.1; 
        $newPrice = $price - ($price * $discount);
        
        
        $regex = '/^\d+(\.\d{1,2})?$/'; 
        
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

    </div>

                <br><br>
                <div class="more2">
                    <a href="gallery.html">View Our Gallery ...</a>
                </div>
                <br>
            </div>

            <div class="class3">
                <div class="all">
                    <div class="h-title" style="font-style: italic;color: #eacaca;">
                        <h1>What Our Clients Say</h1>
                    </div>

                    <div class="clients">
                        <div class="client1">
                            <i class="fa-solid fa-quote-left"></i>
                            <h3 style="color: #eacaca;" >- Sarah L</h3>
                            <br><br><br>
                        </div>
                        <p style="color: #eacaca;font-style: italic;">"I’ve been a loyal customer for years,
                             and this company never disappoints! Their fragrances are luxurious, long-lasting, and always receive compliments. 
                             Simply the best in the industry!" 
                        </p>
                        
                        <br><br><br><br>
                        <div class="client2">
                            <i class="fa-solid fa-quote-left"></i>
                            <h3 style="color: #eacaca;">- James T</h3>
                            <br><br><br>
                        </div>
                        <p style="color: #eacaca;font-style: italic;">"Every perfume I’ve purchased is a masterpiece. 
                            The quality, packaging, and unique scents make it clear why they’re a best seller.
                             I wouldn’t go anywhere else for my fragrances!"
                        </p>
                    
                        <br><br><br><br>
                        <div class="client3">
                            <i class="fa-solid fa-quote-left"></i>
                            <h3 style="color: #eacaca;">- Elena R</h3>
                            <br><br><br>
                        </div>
                        <p style="color: #eacaca;font-style: italic;">"From the moment you open the bottle,
                             you can tell this company puts their heart into their craft. The scents are sophisticated, memorable, 
                             and worth every penny. Truly exceptional!"
                        </p>
                        </div>

                </div>
            </div>

        </div>

        <section>
            <div class="row2">
                <div class="first-foot" style="padding-top: 30px;padding-right: 10px;padding-top: 10px;padding-bottom: 10px;">
                    
                    <h3 style="color: #2c3e50;"><u>LATEST TWEETS</u> </h3>
                    <p style="color: #eacaca;">
                        <b style="color: #eacaca;">@Arom&eacute;</b>: "Unveil the essence of elegance ✨. 
                        Try our newest fragrance, Velvet Bloom, and let your presence linger long after you've left the room. 
                        🌹 <i>#LuxuryPerfume #FragranceLovers</i>"
                    </p>
                    <br>
                    <p style="color: #eacaca;">
                        <b style="color: #eacaca;">@Arom&eacute;</b>: "Spray happiness, one spritz at a time.
                         💕 Discover the secret behind our best-seller, Golden Whisper. 
                         It's more than a perfume—it's a mood.<i> #FragranceGoals #BestSeller</i>"
                    </p>
                    <br>
                    <p style="color: #eacaca;">
                        <b style="color:#eacaca;">@Arom&eacute;</b>: "Hello, winter! ❄️ Cozy up with our new limited-edition Winter Mist, 
                        a blend of vanilla, amber, and warm spices. Perfect for those frosty evenings.
                         <i>#SeasonalFragrance #PerfumeLove</i>"
                    </p>
                    <br>
                    <p style="color: #eacaca;">
                        <b style="color: #eacaca;">@Arom&eacute;</b>: "Every bottle tells a story.
                         🌿 Our fragrances are crafted with passion and sustainability in mind. 
                         Here's a sneak peek behind the creation of Eau Lumière. 🌍✨ <i>#SustainableLuxury #PerfumeJourney</i>"
                    </p>
                    <br>
                    <p style="color: #eacaca;">
                        <b style="color: #eacaca;">@Arom&eacute;</b>: "Every day is an opportunity to reinvent yourself. 
                        Start with your signature scent. 🌟✨ <i>#NewBeginnings #SignatureFragrance</i>"
                    </p>
                    <br><br>
                </div>

                <div class="second-foot" style="padding: 30px;margin-left: 40px;">

                    <h3 style="color: #2c3e50;"><u>~ COLLABORATIONS ~ </u></h3><br>
                    <p><a href="https://www.tomfordbeauty.com/contact-us"> ~ Tom Ford</a></p>
                    <br>
                    <p><a href="https://arianagrandefragrances.com/"> ~ Ari Fragrance</a></p>
                    <br>
                    <p><a href="https://www.chanel.com/us/fragrance/"> ~ Chanel</a></p>
                    <br>
                    <p><a href="https://www.yslbeautyus.com/fragrance/mens-fragrances/?srsltid=AfmBOooUnDNXlpDjvaKDZEQxZ-9LmHU3oW0UbpV0brdJtT6hGbQAs0wR"> ~ Cologne</a></p>
                    <br>
                    <p><a href="https://shop-beauty.dior.sa/collections/collection-privee-christian-dior-perfumes"> ~ Dior</a></p>
                    <br>
                    <p><a href="https://www.prada-beauty.com/fragrance/?srsltid=AfmBOooKAD0HJk436Z2Jh7rlxJ8YL70g9g8q7RnVfA50KLCAHhxkJVbu"> ~ Prada</a></p>

                </div>
                <div class="third-foot" style="padding-top: 30px;">
                    <div class="first">
                      
                        <h3 style="color: #2c3e50 "><u> ~ LATEST BLOG POST ~ </u></h3>
                        <br><br>
                        <h5 style="color: rgb(138, 131, 131); ">Floral Fragrance</h5>
                        <p style="color: rgb(138, 131, 131); "><b style="color: #eacaca;">Eneida</b></p>
                        <p style="color: rgb(87, 85, 85); "> Friday, 6th December 2024</p>
                        <br>
                        <p style="color: #2c3e50; width: 300px;">🌸 Introducing Our New Floral Fragrance Collection! 
                            🌸 Immerse yourself in a garden of elegance with our latest arrivals, 
                            crafted to capture the essence of blooming beauty.
                            From the romantic allure of roses to the fresh sweetness of jasmine and the exotic touch of orchids, 
                            each scent is a celebration of nature's finest blossoms.
                            Perfect for adding a touch of sophistication to your everyday or elevating those special moments,
                            these fragrances are designed to leave a lasting impression. 
                            Discover your signature floral scent today and let your presence bloom wherever you go. 🌼✨...
                        </p>
                    </div>
                    <br><br>
                    <div class="second">

                        <h5 style="color: rgb(138, 131, 131); ">New Luxury Fragrances</h5>
                        <p style="color: rgb(138, 131, 131); "><b style="color: #eacaca;">Fiorentina</b></p>
                        <p style="color: rgb(87, 85, 85); "> Thursday, 21st November 2024</p>
                        <br>
                        <p style="color: #2c3e50; width: 300px;">✨ Unveil the Art of Sophistication with Our New Luxury Fragrance
                            Collection! ✨ Indulge in the pinnacle of elegance with our latest arrivals,
                            meticulously crafted for those who appreciate the finer things in life.
                            Featuring a harmonious blend of rare ingredients—like oud, ambergris,
                            and exotic florals—each scent tells a story of opulence and refinement.
                            Designed to make every moment extraordinary, these fragrances are more than a scent—they're an experience.
                            Elevate your essence with a touch of luxury and discover the aroma that defines you. 🌟...
                        </p>
                    </div>
                </div>

                <div class="contact-form" style="padding-top: 30px;">
                    <h2>Suggestions</h2>
                    <input type="text" class="field" placeholder="Name">
                    <input type="email" class="field" placeholder="Email">
                    <input type="text" class="field" placeholder="Subject">
                    <textarea name="field" placeholder="Message"></textarea>
                    <button type="submit" class="submit-button">Submit</button>
                </div>
            </div>
        </section>

    </div>
    <div class="footer">
        <div class="footer-container">
          <table class="footer-table">
            <tr>
              <td class="footer-section contact-info">
                <h3><i>Contact Us</i></h3>
                <p>Email: <a href="mailto:info@arome.com"><mark style="color: #eacaca;">info@arome.com</mark></a></p>
                <p>Phone: <a href="tel:+38349001001">+383 49 001 001</a></p>
                    <ul><?php
                        $main_address = "<span>Main address:</span>";
                        var_dump($main_address);
                        ?>
                        <li><p><address>Location: Rruga Adem Jashari, Prishtine, Kosove</address></p></li>
                        <ul>You can find us in other cities:
                            <li style="list-style-type: circle;">Prizren</li>
                            <li style="list-style-type: circle;">Peje</li>
                            <li style="list-style-type: circle;">Tirane</li>
                        </ul>
                </ul>
                <p><abbr>Aromé</abbr></p>
              </td>
             
              <td class="footer-section social-media">
                <h3><i>Follow Us</i></h3>
                <a href="#" class="social-icon"></i> Facebook</a><br>
                <a href="#" class="social-icon"></i> Twitter</a><br>
                <a href="#" class="social-icon"></i> Instagram</a><br>
                <a href="#" class="social-icon"></i> LinkedIn</a>
              </td>
            </tr>
            <tr>
            <?php
            $ekipi = [
                ["emri" => "Elsa Krasniqi", "pozita" => "CEO"],
                ["emri" => "Ereza Greicevci", "pozita" => "Marketing Director"],
                ["emri" => "Fahrije Gjokiqi", "pozita" => "Product Manager"],
                ["emri" => "Elona Kuqi", "pozita" => "Section1 Manager"],
                ["emri" => "Era Berisha", "pozita" => "Section2 Manager"]
            ];
            ?>
            <td class="footer-section company-staff">
                <h3><i>Our Team</i></h3>
                <ol>
                    <?php foreach ($ekipi as $anetar): ?>
                    <li><?php echo $anetar["emri"] . " - " . $anetar["pozita"]; ?></li>
                    <?php endforeach; ?>
                </ol>
            </td>
              <td class="footer-section company-photo">
                <h3><i>Aromé</i></h3>
                <img src="company.avif" alt="Company Building" />
              </td>
            </tr>
          </table>
        </div>
        <?php
        $kompania = "Aromé";
        ?>
        <p class="footer-credit">© <span><?php echo date("Y-m-d"); ?></span> <?php echo $kompania; ?>. All Rights Reserved.</p>
   
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