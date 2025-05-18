<?php  
include_once("homepage.php");
?>
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
        
            <h1 style="font-size: 50px;color: #eacaca;"><?php echo $brandName; ?></h1>
            <p class="byline" style="color:#eacaca;padding-bottom:20px;"><?php echo $byline; ?></p>
        </div>
    </div>

    <div class="kits">
        <?php
       
        foreach ($socialLinks as $link) {
            echo '<a href="' . $link['url'] . '" target="_blank"><i class="' . $link['icon'] . '"></i></a>';
        }
        ?>
    </div>
</div>



        <div class="main-bar">
            <?php
        
                foreach ($navItems as $item) {
                    echo '<a class="' . $item['class'] . '" href="' . $item['href'] . '">' . $item['label'] . '</a>';
                }
            ?>
        </div>

            
           <div class="images">
   

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
    <a href="<?php echo $moreLinkHref; ?>"><?php echo $moreLinkText; ?></a>
</div>

</div>


<div class="class2">
   

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
        <div class="more2">
                            <a href="<?php echo $galleryLinkHref; ?>"><?php echo $galleryLinkText; ?></a>
                        </div>

                    <br>
                </div>

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