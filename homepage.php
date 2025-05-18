<?php
$searchAction = "";
$searchPlaceholder = "Search...";
$brandName = "Arom&eacute;";
$byline = "The best perfume seller";
$socialLinks = [
    ["url" => "https://www.linkedin.com/", "icon" => "fa-brands fa-linkedin-in"],
    ["url" => "https://x.com/?lang=en", "icon" => "fa-brands fa-twitter"],
    ["url" => "https://www.pinterest.com/", "icon" => "fa-brands fa-pinterest"],
    ["url" => "https://www.google.co.uk/", "icon" => "fa-brands fa-google"],
    ["url" => "https://www.wifimap.io/", "icon" => "fa-sharp fa-solid fa-wifi fa-rotate-90"]
];
$navItems = [
    ["label" => "HOMEPAGE", "href" => "#", "class" => "link 1"],
    ["label" => "WOMEN", "href" => "women.php", "class" => "link 4"],
    ["label" => "MEN", "href" => "men.php", "class" => "link 4"],
    ["label" => "GALLERY", "href" => "gallery.html", "class" => "link 5"],
    ["label" => "ABOUT US", "href" => "aboutus.php", "class" => "link 7"],
    ["label" => "CONTACT", "href" => "contactus.php", "class" => "link 8"]
];
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
$topPerfumes = [
    "Dior Sauvage" => 1500,
    "Chanel No. 5" => 1350,
    "Tom Ford Black Orchid" => 1200,
    "Prada Luna Rossa" => 980,
    "YSL La Nuit de l'Homme" => 860
];
$leastUsedPerfumes = [
    "Calvin Klein CK One" => 200,
    "Nautica Voyage" => 250,
    "Davidoff Cool Water" => 300,
    "Azzaro Chrome" => 350,
    "Jaguar Classic Black" => 400
];
$moreLinkHref = "aboutus.php";
$moreLinkText = "Read More About Us";
$titleText = "Some Of Our Fragrances";
$titleStyle = "font-style: italic; color: #eacaca;";
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
$galleryLinkHref = "gallery.html";
$galleryLinkText = "View Our Gallery ...";
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



//Pjesa me pointera
$titlee = "Aromé's Perfumes";
$mainTitlee = &$titlee; 

$mainTitlee = "aromé's perfumes";

//
function doubleUsage(&$usage) {
    $usage *= 1.2;
}
doubleUsage($leastUsedPerfumes["Jaguar Classic Black"]);

?>