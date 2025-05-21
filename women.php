<?php
session_start();


// Theme switcher
if (isset($_GET['theme'])) {
    $theme = $_GET['theme'];
    setcookie('theme', $theme, time() + (86400 * 30), "/");
    $_COOKIE['theme'] = $theme;
}

$currentTheme = $_COOKIE['theme'] ?? 'light';

// Gjëra globale
$GLOBALS['site_name'] = "Online Shop";
$GLOBALS['current_year'] = date('Y');
$GLOBALS['currency'] = "$";

// Funksione ndihmëse
function format_price($price) {
    return $GLOBALS['currency'] . number_format($price, 2);
}

function checkFreeShippingForProduct($price) {
    return $price > 50 ? "Free Shipping!" : "Shipping Cost: $3.99";
}

function shkurtoPershkrimin($desc) {
    return preg_replace("/\bEau de Parfum\b/i", "EDP", $desc);
}

function sortProductsAscending($products) {
    $prices = array_column($products, 'price');
    sort($prices);
    $sorted = [];
    foreach ($prices as $price) {
        foreach ($products as $product) {
            if ($product['price'] == $price) {
                $sorted[] = $product;
                break;
            }
        }
    }
    return $sorted;
}

class WelcomeMessage {
    private $siteName;
    private $currentDay;
    private $slogans;

    public function __construct($siteName) {
        $this->siteName = $siteName;
        $this->currentDay = date("l");
        $this->slogans = [
            "Smell like never before!",
            "Find your signature scent.",
            "Elegance in every drop.",
            "Style. Fragrance. You."
        ];
    }

    public function getRandomSlogan() {
        return $this->slogans[array_rand($this->slogans)];
    }

    public function getDailyMessage() {
        switch ($this->currentDay) {
            case "Monday": return "Happy Monday! Fresh week, fresh scents!";
            case "Tuesday": return "Tuesday Treat! Free shipping on all orders!";
            case "Wednesday": return "Midweek Special! Buy 2, get 1 free!";
            case "Thursday": return "Thursday Thrill! 15% off all men's fragrances!";
            case "Friday": return "Friday Deal! Get 10% off!";
            case "Saturday": return "Weekend Vibes! 20% off select perfumes!";
            case "Sunday": return "Sunday Relax! Enjoy free samples with your order!";
            default: return "Welcome to " . $this->siteName;
        }
    }

    public function displayWelcome() {
        return "<h1 class='welcome-message'>Welcome to {$this->siteName}</h1>";
    }
}

// Popullo produktet dhe llogarit karrocën
$floral = [  ["name" => "Valentino", "desc" => "Born In Roma Eau de Parfum", "price" => 35.98, "img" => "womanimg/valentino2.jpg.png"],
  ["name" => "BURBERYY", "desc" => "Her Eau de Parfum", "price" => 39.97, "img" => "womanimg/burberry.jpg"],
  ["name" => "Ariana Grande", "desc" => "MOD Blush Eau de Parfum", "price" => 29.98, "img" => "womanimg/ariana.jpg"],
  ["name" => "Carolina Herrera", "desc" => "Good Girl Blush Eau de Parfum", "price" => 19.98, "img" => "womanimg/carolina.jpg"],
  ["name" => "Yves Saint Laurent", "desc" => "Libre Eau De Parfum", "price" => 69.98, "img" => "womanimg/Yves Saint Laurent.jpg"],
  ["name" => "JIMMY CHOO", "desc" => "I want Choo Eau de Parfum", "price" => 33.98, "img" => "womanimg/JIMMY CHOO.jpg"],
  ["name" => "Prada", "desc" => "Paradoce Eau de Parfum", "price" => 59.98, "img" => "womanimg/Prada.jpg"],
  ["name" => "Gucci", "desc" => "Gardenia Eau de Parfum", "price" => 49.98, "img" => "womanimg/Gucci.jpg"]]; // produktet e floral
$floral = sortProductsAscending($floral);
$warmAndSpicy = [ ["name" => "Yves Saint Laurent", "desc" => "Black Opium Eau de Parfum", "price" => 35.98, "img" => "womanimg/blackopium.jpg"],
  ["name" => "BURBERRY", "desc" => "Burberry Goddess Eau de Parfum", "price" => 39.94, "img" => "womanimg/burberry.jpg"],
  ["name" => "Ariana Grande", "desc" => "Cloud Eau de Parfum", "price" => 24.98, "img" => "womanimg/Ariana Grande.jpg"],
  ["name" => "PHLUR", "desc" => "Body & Hair Fragrance Mist", "price" => 39.92, "img" => "womanimg/PHLUR.jpg"],
  ["name" => "Kayali", "desc" => "Vanilla Candy Rock Sugar", "price" => 29.98, "img" => "womanimg/Kayali.jpg"],
  ["name" => "Opium Red", "desc" => "Black Opium Eau de Parfum", "price" => 39.90, "img" => "womanimg/opiumred.jpg"],
  ["name" => "Ariana Grande", "desc" => "MOD Vanilla Eau de Parfum", "price" => 52.90, "img" => "womanimg/mod.jpg"],
  ["name" => "Viktor&Rolf", "desc" => "Flowerbomb Eau de Parfum", "price" => 49.98, "img" => "womanimg/download.jpg"]]; // produktet warmAndSpicy
$warmAndSpicy = sortProductsAscending($warmAndSpicy);
$fruitScent = [  ["name" => "Tom Ford Bitter Peach", "desc" => "Bitter Peach Eau De Parfum Fragrance", "price" => 350.98, "img" => "womanimg/tomfordpeach.jpg"],
  ["name" => "Tom Ford", "desc" => "Fucking Fabulous Eau de Parfum Fragrance", "price" => 399.98, "img" => "womanimg/vanile.jpg"],
  ["name" => "Tom Ford Lost Cherry", "desc" => "Lost Cherry Eau de Parfum Fragrance", "price" => 240.98, "img" => "womanimg/cherry.jpg"],
  ["name" => "Neroli Portofino ", "desc" => "Citruc floral cent", "price" => 239.98, "img" => "womanimg/tom.png"]]; // produktet e fruit scent
$fruitScent = sortProductsAscending($fruitScent);

$cart_count = 0;
foreach ($_SESSION['cart'] as $item) {
    $cart_count += $item['quantity'];
}

$welcome = new WelcomeMessage("Online Shop");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Women</title>
    <link rel="stylesheet" href="css/women.css?v=1.1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Theme switcher functionality
        function getTheme() {
            return document.cookie.split('; ').find(row => row.startsWith('theme='))?.split('=')[1] || 'light';
        }

        function setTheme(theme) {
            document.body.className = theme;
            document.cookie = `theme=${theme}; path=/; max-age=${60*60*24*30}`;
            updateThemeButton(theme);
        }

        function updateThemeButton(theme) {
            const themeSwitcher = document.querySelector('.theme-switcher a');
            if (themeSwitcher) {
                themeSwitcher.textContent = theme === 'light' ? '🌙 Dark Mode' : '☀️ Light Mode';
                themeSwitcher.href = `?theme=${theme === 'light' ? 'dark' : 'light'}`;
            }
        }

        document.querySelector('.theme-switcher a')?.addEventListener('click', function(e) {
            e.preventDefault();
            const currentTheme = getTheme();
            const newTheme = currentTheme === 'light' ? 'dark' : 'light';
            setTheme(newTheme);
        });

        // Initialize theme
        const initialTheme = getTheme();
        document.body.className = initialTheme;
        updateThemeButton(initialTheme);

        // Existing cart functionality
        const cartItems = document.querySelector('.cart-items');
        let itemCount = 0;

        const addToCartButtons = document.querySelectorAll('.btn');
        addToCartButtons.forEach(button => {
            button.addEventListener('click', () => {
                itemCount++;
                cartItems.textContent = itemCount;
            });
        });

        // Existing menu functionality
        $("#menu").hide();
        $("#menuBtn").on("mouseenter", function() {
            $("#menu").slideDown(500);
        });
    });
    </script>
</head>
<body class="<?php echo $currentTheme; ?>">
    <header>

        <div class="logo"><?php echo $GLOBALS['site_name']; ?></div>
        <nav>
            <ul>
                <li><a href="Website.php">Homepage</a></li>
                <li><a href="#">Women</a></li>
                <li><a href="men.php">Men</a></li>
                <li><a href="gallery.php">Gallery</a></li>
                <li><a href="aboutus.php">About Us</a></li>
                <li><a href="contactus.php">Contact</a></li>
            </ul>
        </nav>
        <div class="cart">
            <a href="#">Cart</a>
            <span class="cart-items">0</span>
        </div>
        <div class="theme-switcher">
            <a href="?theme=<?php echo $currentTheme === 'light' ? 'dark' : 'light'; ?>">
                <?php echo $currentTheme === 'light' ? '🌙 Dark Mode' : '☀️ Light Mode'; ?>
            </a>
        </div>
          <div class="cart">
        <a href="#" id="cart-toggle">Cart (<?php echo $cart_count; ?>)</a>
        <div class="cart-dropdown" id="cart-dropdown">
            <h3>Your Cart</h3>
            <div class="cart-items-list">
                <?php if (!empty($_SESSION['cart'])): ?>
                    <?php foreach ($_SESSION['cart'] as $item): ?>
                        <div class="cart-item">
                            <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>">
                            <div class="cart-item-details">
                                <h4><?php echo $item['name']; ?></h4>
                                <p><?php echo format_price($item['price']); ?></p>
                                <p>Quantity: <?php echo $item['quantity']; ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <div class="cart-total">
                        Total: <?php 
                            $total = 0;
                            foreach ($_SESSION['cart'] as $item) {
                                $total += $item['price'] * $item['quantity'];
                            }
                            echo format_price($total);
                        ?>
                    </div>
                    <a href="checkout.php" class="btn">Checkout</a>
                <?php else: ?>
                    <p>Your cart is empty</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    </header>

    <div style="background-color: #f0f0f0; padding: 10px; margin: 20px 0; border-left: 5px solid pink;">
        <h3 class="mesazhi"><?php echo $welcome->getDailyMessage(); ?></h3>
    </div>

    <section class="hero">
        <?php echo $welcome->displayWelcome(); ?>
        <h2><?php echo $welcome->getRandomSlogan(); ?></h2>
        <button id="menuBtn">SCENTES</button>
        <ul id="menu" class="start">
            <li><a href="#floralscent">Floral Scent</a></li>
            <li><a href="#warmandspicy">Warm and Spicy</a></li>
            <li><a href="#fruitscent">Fruit Scent</a></li>
        </ul>
    </section>

    <section class="products">
        <h2 style="font-size: 60px;">Featured Products</h2>

        <div id="floralscent">
            <h3 class="ntitle">Floral Scent</h3>
            <?php foreach ($floral as $product): ?>
                <div class="product">
                    <img src="<?php echo $product['img']; ?>" alt="Product Image">
                    <h3><?php echo $product['name']; ?></h3>
                    <p><?php echo shkurtoPershkrimin($product['desc']); ?></p>
                    <span class="price"><?php echo format_price($product['price']); ?></span>
                    <p><?php echo checkFreeShippingForProduct($product['price']); ?></p>
                    <a href="#" class="btn">Add to Cart</a>
                        <form method="post">
        <input type="hidden" name="product_id" value="<?php echo md5($product['name'] . $product['price']); ?>">
  
    </form>

                </div>
            <?php endforeach; ?>
        </div>

        <div id="warmandspicy">
            <h3 class="ntitle">Warm And Spicy</h3>
            <?php foreach ($warmAndSpicy as $product): ?>
                <div class="product">
                    <img src="<?php echo $product['img']; ?>" alt="Product Image">
                    <h3><?php echo $product['name']; ?></h3>
                    <p><?php echo shkurtoPershkrimin($product['desc']); ?></p>
                    <span class="price"><?php echo format_price($product['price']); ?></span>
                    <p><?php echo checkFreeShippingForProduct($product['price']); ?></p>
                    <a href="#" class="btn">Add to Cart</a>
                        <form method="post">
        <input type="hidden" name="product_id" value="<?php echo md5($product['name'] . $product['price']); ?>">

    </form>

                </div>
            <?php endforeach; ?>
        </div>

        <div id="fruitscent">
            <h3 class="ntitle">Fruit Scent</h3>
            <?php foreach ($fruitScent as $product): ?>
                <div class="product">
                    <img src="<?php echo $product['img']; ?>" alt="Product Image">
                    <h3><?php echo $product['name']; ?></h3>
                    <p><?php echo shkurtoPershkrimin($product['desc']); ?></p>
                    <span class="price"><?php echo format_price($product['price']); ?></span>
                    <p><?php echo checkFreeShippingForProduct($product['price']); ?></p>
       
                    
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <footer>
        <p>&copy; <?php echo $GLOBALS['current_year'] . ' ' . $GLOBALS['site_name']; ?></p>
    </footer>
</body>
</html>
?>