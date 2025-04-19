<?php
$message = "Welcome to our store!";
define("Arome", "Online Shop");

$day = date("l");
// Zbritjet bazuar në ditën e javës
switch ($day) {
    case "Monday":
        $message = "Happy Monday! Fresh week, fresh scents!";
        break;
    case "Tuesday":
        $message = "Tuesday Treat! Free shipping on all orders";
        break;
    case "Wednesday":
        $message = "Midweek Special! Buy 2, get 1 free!";
        break;
    case "Thursday":
        $message = "Thursday Thrill! 15% off all men's fragrances!";
        break;
    case "Friday":
        $message = "Friday Deal! Get 10% off!";
        break;
    case "Saturday":
        $message = "Weekend Vibes! 20% off select perfumes!";
        break;
    case "Sunday":
        $message = "Sunday Relax! Enjoy our free samples with your order!";
        break;
    default:
        $message = "Welcome to " . Arome;
        break;
}

// Funksion per te formatuar kategorine (string ne uppercase).
function formatCategory($cat) {
    return strtoupper($cat);
}
function checkFreeShippingForProduct($price) {
  if ($price > 100) {
      return "Free Shipping!";
  } else {
      return "Shipping Cost: $3.99"; 
  }
}
//Varg associativ per slogane te rastesishme.
$slogans = [
  "Smell like never before!",
  "Find your signature scent.",
  "Elegance in every drop.",
  "Style. Fragrance. You."
];
$random_slogan = $slogans[array_rand($slogans)];

//OOP
// Definimi i klases kryesore per produktet.
class Product {
  public $name;
  public $price;

  // Konstruktori per te inicializuar produktin.
  public function __construct($name, $price) {
      $this->name = $name;
      $this->price = $price;
  }

  public function getLabel() {
      return "{$this->name} - \${$this->price}";
  }
}

// Nen-klasa per parfume qe trashegon klasen Product.
class Perfume extends Product {
  public $brand;

  public function __construct($name, $price, $brand) {
      parent::__construct($name, $price);
      $this->brand = $brand;
  }

  public function getFullDescription() {
      return "{$this->brand} {$this->name} costs \${$this->price}";
  }
}

// Lista e parfumeve ne vargun $parfumeList.
$parfumeList = [
new Perfume("Dior Sauvage", 89.99, "Dior"),
new Perfume("Bleu de Chanel", 99.99, "Chanel"),
new Perfume("Tom Ford Noir", 119.99, "Tom Ford"),
new Perfume("Armani Code", 89.99, "Armani"),
new Perfume("Gucci Guilty", 79.99, "Gucci"),
new Perfume("Versace Eros", 85.99, "Versace"),
new Perfume("Burberry Touch", 74.99, "Burberry"),
new Perfume("YSL L'Homme", 94.99, "YSL"),
new Perfume("Acqua Di Gio", 79.99, "Giorgio Armani"),
new Perfume("Mr. Burberry", 94.99, "Burberry"),
new Perfume("YSL L'Homme Intense", 109.99, "YSL"),
new Perfume("Prada Luna Rossa", 84.99, "Prada"),
new Perfume("Bvlgari Man in Black", 99.99, "Bvlgari"),
new Perfume("Dolce & Gabbana The One", 94.99, "Dolce & Gabbana"),
new Perfume("Calvin Klein Eternity", 79.99, "Calvin Klein"),
new Perfume("Joop! Homme", 69.99, "Joop!"),
new Perfume("Creed Aventus", 305.99, "Creed"),
new Perfume("Azzaro Wanted", 79.99, "Azzaro"),
new Perfume("Montblanc Legend", 84.99, "Montblanc"),
new Perfume("Dior Homme", 89.99, "Dior"),
new Perfume("Armani Stronger With You", 114.99, "Armani"),
new Perfume("Chanel Allure Homme", 119.99, "Chanel"),
new Perfume("Tom Ford Black Orchid", 139.99, "Tom Ford")
];

// Produkti i dites bazuar ne indeksin e dites se javes.
$dayIndex = date("w"); // 0-6 (e Diel - e Shtune)
$perfumeOfTheDay = $parfumeList[$dayIndex % count($parfumeList)];


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Online Shop</title>
  <link rel="stylesheet" href="men.css">
</head>
<body>
  <header>
    <div class="logo">Online Shop</div>
    <nav>
      <ul>
        <li><a href="website.php">Homepage</a></li>
        <li><a href="women.php">Women</a></li>
        <li><a href="#">Men</a></li>
        <li><a href="contactus.php">Gallery</a></li>
        <li><a href="aboutus.php">About Us</a></li>
        <li><a href="contactus.php">Contact</a></li>
      </ul>
    </nav>

    <div class="cart">
      <a href="#">Cart</a>
      <span class="cart-items">0</span>
    </div>

  </header>
  <div style="background-color: #f0f0f0; padding: 10px; margin: 20px 0; border-left: 5px solid orange;">
    <h3><?php echo $message; ?></h3>
  </div>
  <section class="hero">
    <h1>Welcome to Online Shop</h1>
    <p>Shop the latest trends in perfumes.</p>
</section>
<section class="product-of-day" style="background-color:rgb(195, 214, 227); padding: 30px; margin: 30px; border: 2px solid #2c3e50; border-radius: 0px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
  <h2 style="color: #2c3e50; font-size: 2em; text-align: center;"> Product of the Day </h2>
  <div style="display: flex; flex-direction: column; align-items: center;">
    <h3 style="font-size: 1.5em; margin-bottom: 15px; color: #2c3e50;"><?php echo $perfumeOfTheDay->name; ?> by <?php echo $perfumeOfTheDay->brand; ?></h3>
    <p style="font-weight: bold; font-size: 1.3em; margin-bottom: 10px; color: #2c3e50;">Price: $<?php echo number_format($perfumeOfTheDay->price, 2); ?></p>
    <p style="font-size: 1.1em; margin-bottom: 20px; color: #2c3e50;"><?php echo checkFreeShippingForProduct($perfumeOfTheDay->price); ?></p>
    <a href="#" class="btn" style="font-size: 1.2em; padding: 12px 20px; background-color: #2c3e50; color: #f4c2c2; border-radius: 0px;">Add to Cart</a>
  </div>
</section>

<section class="products">
    <h2>Featured Products</h2>

  <div class="product">
    <img src="dior-008555di_01.webp"alt="Dior Sauvage">
    <h3>Dior Sauvage</h3>
    <p>An intense and fresh fragrance with notes of bergamot and pepper.</p>
    <span class="price">$89.99</span>
    <p><?php echo checkFreeShippingForProduct(89.99); ?></p>
    <a href="#" class="btn">Add to Cart</a>
  </div>
  <div class="product">
    <img src="bleuman.webp" alt="Bleu de Chanel">
    <h3>Bleu de Chanel</h3>
    <p>An elegant fragrance with citrus and woody notes.</p>
    <span class="price">$99.99</span>
    <p><?php echo checkFreeShippingForProduct(99.99); ?></p>
    <a href="#" class="btn">Add to Cart</a>
  </div>
  <div class="product">
    <img src="noirtomford.avif" alt="Tom Ford Noir">
    <h3>Tom Ford Noir</h3>
    <p>A mysterious and refined scent with notes of vanilla and amber.</p>
    <span class="price">$119.99</span>
    <p><?php echo checkFreeShippingForProduct(119.99); ?></p>
    <a href="#" class="btn">Add to Cart</a>
  </div>
  <div class="product">
    <img src="codearmani.webp" alt="Armani Code">
    <h3>Armani Code</h3>
    <p>A magnetic fragrance with lemon, olive blossom, and tonka bean.</p>
    <span class="price">$89.99</span>
    <p><?php echo checkFreeShippingForProduct(89.99); ?></p>
    <a href="#" class="btn">Add to Cart</a>
  </div>
  <div class="product">
    <img src="guiltygucci.avif" alt="Gucci Guilty">
    <h3>Gucci Guilty</h3>
    <p>A provocative and contemporary scent with citrus and lavender.</p>
    <span class="price">$79.99</span>
    <p><?php echo checkFreeShippingForProduct(79.99); ?></p>
    <a href="#" class="btn">Add to Cart</a>
  </div>
  <div class="product">
    <img src="versaceEros.avif" alt="Versace Eros">
    <h3>Versace Eros</h3>
    <p>A passionate fragrance with mint, green apple, and vanilla.</p>
    <span class="price">$85.99</span>
    <p><?php echo checkFreeShippingForProduct(85.99); ?></p>
    <a href="#" class="btn">Add to Cart</a>
  </div>
  <div class="product">
    <img src="burberrymann.webp" alt="Burberry Touch">
    <h3>Burberry Touch</h3>
    <p>A soft and refined fragrance with notes of musk and white pepper.</p>
    <span class="price">$74.99</span>
    <p><?php echo checkFreeShippingForProduct(74.99); ?></p>
    <a href="#" class="btn">Add to Cart</a>
  </div>
  <div class="product">
    <img src="HOMMEysl.avif" alt="YSL L'Homme">
    <h3>YSL L'Homme</h3>
    <p>A balanced and charismatic fragrance with ginger and vetiver.</p>
    <span class="price">$94.99</span>
    <p><?php echo checkFreeShippingForProduct(94.99); ?></p>
    <a href="#" class="btn">Add to Cart</a>
  </div>
  <div class="product">
    <img src="ARMANI.webp" alt="Acqua di Gio by Giorgio Armani">
    <h3>Acqua di Gio</h3>
    <p>A fresh and aquatic fragrance with notes of citrus, jasmine, and rosemary.</p>
    <span class="price">$79.99</span>
    <p><?php echo checkFreeShippingForProduct(79.99); ?></p>
    <a href="#" class="btn">Add to Cart</a>
  </div>
  
  <div class="product">
    <img src="mr2Burberry.webp" alt="Burberry Mr. Burberry">
    <h3>Burberry Mr. Burberry</h3>
    <p>A sophisticated and modern scent with grapefruit, cedarwood, and vetiver.</p>
    <span class="price">$94.99</span>
    <p><?php echo checkFreeShippingForProduct(94.99); ?></p>
    <a href="#" class="btn">Add to Cart</a>
  </div>
  
  <div class="product">
    <img src="hommeintense.jpg" alt="YSL L'Homme Intense">
    <h3>YSL L'Homme Intense</h3>
    <p>A warm and woody fragrance with iris, amber, and cedarwood.</p>
    <span class="price">$109.99</span>
    <p><?php echo checkFreeShippingForProduct(109.99); ?></p>
    <a href="#" class="btn">Add to Cart</a>
  </div>
  <div class="product">
    <img src="lunarosa.webp" alt="Prada Luna Rossa">
    <h3>Prada Luna Rossa</h3>
    <p>A fresh and invigorating scent with notes of lavender and mint.</p>
    <span class="price">$84.99</span>
    <p><?php echo checkFreeShippingForProduct(84.99); ?></p>
    <a href="#" class="btn">Add to Cart</a>
</div>
<div class="product">
    <img src="bvlgariman.png" alt="Bvlgari Man in Black">
    <h3>Bvlgari Man in Black</h3>
    <p>An intense and magnetic fragrance with notes of rum and leather.</p>
    <span class="price">$99.99</span>
    <p><?php echo checkFreeShippingForProduct(99.99); ?></p>
    <a href="#" class="btn">Add to Cart</a>
</div>
<div class="product">
    <img src="dolceeman.webp" alt="Dolce & Gabbana The One">
    <h3>Dolce & Gabbana The One</h3>
    <p>A sophisticated scent with notes of tobacco, amber, and ginger.</p>
    <span class="price">$94.99</span>
    <p><?php echo checkFreeShippingForProduct(94.99); ?></p>
    <a href="#" class="btn">Add to Cart</a>
</div>
<div class="product">
  <img src="calvinforman.jfif" alt="Calvin Klein Eternity">
  <h3>Calvin Klein Eternity</h3>
  <p>A timeless fragrance with a fresh and aromatic blend of notes.</p>
  <span class="price">$79.99</span>
  <p><?php echo checkFreeShippingForProduct(79.99); ?></p>
  <a href="#" class="btn">Add to Cart</a>
</div>
<div class="product">
  <img src="joophomme.webp" alt="Joop! Homme">
  <h3>Joop! Homme</h3>
  <p>A bold and spicy fragrance with cinnamon, orange blossom, and vanilla.</p>
  <span class="price">$69.99</span>
  <p><?php echo checkFreeShippingForProduct(69.99); ?></p>
  <a href="#" class="btn">Add to Cart</a>
</div>
<div class="product">
  <img src="CreedMAN.webp" alt="Creed Aventus">
  <h3>Creed Aventus</h3>
  <p>A luxurious fragrance with pineapple, birch, and musk.</p>
  <span class="price">$305.99</span>
  <p><?php echo checkFreeShippingForProduct(305.99); ?></p>
  <a href="#" class="btn">Add to Cart</a>
</div>
<div class="product">
  <img src="AZZARO.jpeg" alt="Azzaro Wanted">
  <h3>Azzaro Wanted</h3>
  <p>A bold and fresh scent with lemon, ginger, and tonka bean.</p>
  <span class="price">$79.99</span>
  <p><?php echo checkFreeShippingForProduct(79.99); ?></p>
  <a href="#" class="btn">Add to Cart</a>
</div>
<div class="product">
  <img src="LEGEND.jfif"alt="Montblanc Legend">
  <h3>Montblanc Legend</h3>
  <p>An elegant and masculine scent with lavender, pineapple, and oakmoss.</p>
  <span class="price">$84.99</span>
  <p><?php echo checkFreeShippingForProduct(84.99); ?></p>
  <a href="#" class="btn">Add to Cart</a>
</div>
<div class="product">
  <img src="DiorHomme.webp" alt="Dior Homme">
  <h3>Dior Homme</h3>
  <p>A modern and sophisticated fragrance with iris and leather notes.</p>
  <span class="price">$89.99</span>
  <p><?php echo checkFreeShippingForProduct(89.99); ?></p>
  <a href="#" class="btn">Add to Cart</a>
</div>
<div class="product">
  <img src="armaniSWY.webp" alt="Armani Stronger With You">
  <h3>Armani Stronger With You</h3>
  <p>A warm and spicy fragrance with notes of chestnut, vanilla, and amberwood.</p>
  <span class="price">$114.99</span>
  <p><?php echo checkFreeShippingForProduct(114.99); ?></p>
  <a href="#" class="btn">Add to Cart</a>
</div>
<div class="product">
  <img src="ALLURE.avif" alt="Chanel Allure Homme">
  <h3>Chanel Allure Homme</h3>
  <p>A refined fragrance with notes of mandarin, cedarwood, and tonka bean.</p>
  <span class="price">$119.99</span>
  <p><?php echo checkFreeShippingForProduct(119.99); ?></p>
  <a href="#" class="btn">Add to Cart</a>
</div>
<div class="product">
  <img src="blackohrid.webp" alt="Tom Ford Black Orchid">
  <h3>Tom Ford Black Orchid</h3>
  <p>A luxurious fragrance with notes of black orchid, patchouli, and vanilla.</p>
  <span class="price">$139.99</span>
  <p><?php echo checkFreeShippingForProduct(139.99); ?></p>
  <a href="#" class="btn">Add to Cart</a>
</div>
<div class="cart-details" style="width: 100%; display: flex; justify-content: center; align-items: center; margin: 20px 0;">
  <h1 style="color: #ffc0cb; font-size: 1.8em; text-align: center;">
    <?php echo $random_slogan; ?>
  </h1>
</div>
  <ul id="cart-list"></ul>
</div>
</section>
<footer>
  <p>&copy; 2024 Online Shop</p>
</footer>
<script>
  const cartItems = document.querySelector('.cart-items');
  
  let itemCount = 0;
  
  
  const addToCartButtons = document.querySelectorAll('.btn');
  
  
  addToCartButtons.forEach(button => {
    button.addEventListener('click', () => {
     
      itemCount++;
      
     
      cartItems.textContent = itemCount;
    });
  });
  
  $(function(){
  
    $("#menu").hide();
        
        $("#menuBtn").on("mouseenter",function(){
          $("#menu").slideDown(500);
        });
        
      })
  
  
            </script>
</body>
</html>