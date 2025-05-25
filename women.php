
<?php
require_once 'db.php';
session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reset_cart'])) {
    $_SESSION['cart'] = [];
    header("Location: ".$_SERVER['PHP_SELF']."#top");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_from_cart'])) {
    $removeId = (int)$_POST['remove_id'];
  foreach ($_SESSION['cart'] as $index => &$item) {
    if ($item['id'] === $removeId) {
        if ($item['quantity'] > 1) {
        $_SESSION['cart'][$index]['quantity']--;
        } else {
            unset($_SESSION['cart'][$index]);
        }
        break;
    }
}


    header('Content-Type: application/json');
    echo json_encode([
        'success' => true,
        'cart_count' => array_sum(array_column($_SESSION['cart'], 'quantity')),
        'cart_items' => array_values($_SESSION['cart'])
    ]);
    exit;
}


if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_GET['theme'])) {
    $theme = $_GET['theme'];
    setcookie('theme', $theme, time() + (86400 * 30), "/");
    $_COOKIE['theme'] = $theme;
}

$currentTheme = $_COOKIE['theme'] ?? 'light';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $productId =(int)$_POST['product_id'];
    $productName = $_POST['product_name'];
    $productPrice = (float)$_POST['product_price'];
    $productImage = $_POST['product_image'];
    $productCategory = $_POST['product_category'];

    $found = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] === (int)$productId) {
            $item['quantity']++;
            $found = true;
            break;
        }
    }

    if (!$found) {
        $_SESSION['cart'][] = [
            'id' => $productId,
            'name' => $productName,
            'price' => $productPrice,
            'image' => $productImage,
            'category' => $productCategory,
            'quantity' => 1
        ];
    }

    header('Content-Type: application/json');
    echo json_encode([
        'success' => true,
        'cart_count' => array_sum(array_column($_SESSION['cart'], 'quantity')),
        'cart_items' => $_SESSION['cart']
    ]);
    exit;
}

$GLOBALS['site_name'] = "Online Shop";
$GLOBALS['current_year'] = date('Y');
$GLOBALS['currency'] = "$";

function format_price($price) {
    return $GLOBALS['currency'] . number_format($price, 2);
}

function checkFreeShippingForProduct($price) {
    return $price > 50 ? "Free Shipping!" : "Shipping Cost: $3.99";
}

function shkurtoPershkrimin($desc) {
    return preg_replace("/\bEau de Parfum\b/i", "EDP", $desc);
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

function merrProduktetNgaDB($conn, $nenkategoria) {
    $sql = "SELECT * FROM parfumet WHERE kategoria = 'Women' AND nenkategoria = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $nenkategoria);
    $stmt->execute();
    $result = $stmt->get_result();

    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = [
            'id' => $row['id'] ?? null,
            'name' => $row['emri'],
            'desc' => $row['pershkrimi'],
            'price' => (float)$row['cmimi'],
            'img' => $row['foto']
        ];
    }

    usort($products, function($a, $b) {
        return $a['price'] <=> $b['price'];
    });

    return $products;
}

$floral = merrProduktetNgaDB($conn, 'Floral');
$warmAndSpicy = merrProduktetNgaDB($conn, 'WarmAndSpicy');
$fruitScent = merrProduktetNgaDB($conn, 'FruitScent');

$cart_count = array_sum(array_column($_SESSION['cart'], 'quantity'));
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
    <style>

    </style>
</head>
    <a id="top"></a>
<body class="<?php echo $currentTheme; ?>">


    <header>
        <div class="logo"><?php echo $GLOBALS['site_name']; ?></div>
 
  <nav>
    <ul>
        <?php
        $menu_items = [
            'Homepage' => 'Website.php',
            'Women' => '#',
            'Men' => 'men.php',
            'Gallery' => 'gallery.php',
            'About Us' => 'aboutus.php',
            'Contact' => 'contactus.php'
        ];
        foreach ($menu_items as $label => $url): ?>
            <li><a href="<?php echo $url; ?>"><?php echo $label; ?></a></li>
        <?php endforeach; ?>
    </ul>
</nav>
        <div class="cart">
            <a href="#" id="cart-toggle">Cart (<span class="cart-items"><?php echo $cart_count; ?></span>)</a>
                <form method="post" style="display:inline;">
        <input type="hidden" name="reset_cart" value="1">
        <button type="submit" class="btn">🗑️ Reset Cart</button></form>
    </form> 
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
                                                <form method="post" class="remove-from-cart-form" style="display:inline;">
                <input type="hidden" name="remove_id" value="<?php echo $item['id']; ?>">
                <input type="hidden" name="remove_from_cart" value="1">
                <button type="submit" class="remove-btn" title="Remove item">❌</button>
            </form>

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
                    <?php else: ?>
                        <p>Your cart is empty</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="theme-switcher">
            <a href="?theme=<?php echo $currentTheme === 'light' ? 'dark' : 'light'; ?>">
                <?php echo $currentTheme === 'light' ? '🌙 Dark Mode' : '☀️ Light Mode'; ?>
            </a>
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
                    <img src="<?php echo $product['img']; ?>" alt="<?php echo $product['name']; ?>">
                    <h3><?php echo $product['name']; ?></h3>
                    <p><?php echo shkurtoPershkrimin($product['desc']); ?></p>
                    <span class="price"><?php echo format_price($product['price']); ?></span>
                    <p><?php echo checkFreeShippingForProduct($product['price']); ?></p>
                    <form class="add-to-cart-form" method="post">
<input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                        <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($product['name']); ?>">
                        <input type="hidden" name="product_price" value="<?php echo $product['price']; ?>">
                        <input type="hidden" name="product_image" value="<?php echo $product['img']; ?>">
                        <input type="hidden" name="product_category" value="floral">
                        <input type="hidden" name="add_to_cart" value="1">
                        <button type="submit" class="btn">Add to Cart</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>

        <div id="warmandspicy">
            <h3 class="ntitle">Warm And Spicy</h3>
            <?php foreach ($warmAndSpicy as $product): ?>
                <div class="product">
                    <img src="<?php echo $product['img']; ?>" alt="<?php echo $product['name']; ?>">
                    <h3><?php echo $product['name']; ?></h3>
                    <p><?php echo shkurtoPershkrimin($product['desc']); ?></p>
                    <span class="price"><?php echo format_price($product['price']); ?></span>
                    <p><?php echo checkFreeShippingForProduct($product['price']); ?></p>
                    <form class="add-to-cart-form" method="post">
                     <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                        <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($product['name']); ?>">
                        <input type="hidden" name="product_price" value="<?php echo $product['price']; ?>">
                        <input type="hidden" name="product_image" value="<?php echo $product['img']; ?>">
                        <input type="hidden" name="product_category" value="warmAndSpicy">
                        <input type="hidden" name="add_to_cart" value="1">
                        <button type="submit" class="btn">Add to Cart</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>

        <div id="fruitscent">
            <h3 class="ntitle">Fruit Scent</h3>
            <?php foreach ($fruitScent as $product): ?>
                <div class="product">
                    <img src="<?php echo $product['img']; ?>" alt="<?php echo $product['name']; ?>">
                    <h3><?php echo $product['name']; ?></h3>
                    <p><?php echo shkurtoPershkrimin($product['desc']); ?></p>
                    <span class="price"><?php echo format_price($product['price']); ?></span>
                    <p><?php echo checkFreeShippingForProduct($product['price']); ?></p>
                    <form class="add-to-cart-form" method="post">
<input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                        <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($product['name']); ?>">
                        <input type="hidden" name="product_price" value="<?php echo $product['price']; ?>">
                        <input type="hidden" name="product_image" value="<?php echo $product['img']; ?>">
                        <input type="hidden" name="product_category" value="fruitScent">
                        <input type="hidden" name="add_to_cart" value="1">
                        <button type="submit" class="btn">Add to Cart</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <footer>
        <p>&copy; <?php echo $GLOBALS['current_year'] . ' ' . $GLOBALS['site_name']; ?></p>
    </footer>

    <script>
    $(document).ready(function() {
        // Funksioni për ndërrimin e temës
        function getTheme() {
            return document.cookie.split('; ').find(row => row.startsWith('theme='))?.split('=')[1] || 'light';
        }

        function setTheme(theme) {
            document.body.className = theme;
            document.cookie = `theme=${theme}; path=/; max-age=${60*60*24*30}`;
            updateThemeButton(theme);
        }

        function updateThemeButton(theme) {
            const themeSwitcher = $('.theme-switcher a');
            if (themeSwitcher.length) {
                themeSwitcher.text(theme === 'light' ? '🌙 Dark Mode' : '☀️ Light Mode');
                themeSwitcher.attr('href', `?theme=${theme === 'light' ? 'dark' : 'light'}`);
            }
        }

        $('.theme-switcher a').on('click', function(e) {
            e.preventDefault();
            const currentTheme = getTheme();
            const newTheme = currentTheme === 'light' ? 'dark' : 'light';
            setTheme(newTheme);
        });

        // Inicializo temën
        const initialTheme = getTheme();
        $('body').addClass(initialTheme);
        updateThemeButton(initialTheme);

            $(document).on('submit', 'form[action=""][method="post"]', function(e) {
        var resetForm = $(this);
        if (resetForm.find('input[name="reset_cart"]').length) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "",
                data: resetForm.serialize(),
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        $('.cart-items').text("0");
                        $('#cart-dropdown').html('<h3>Your Cart</h3><div class="cart-items-list"><p>Your cart is empty</p></div>').addClass('show');
                    }
                },
                error: function() {
                    alert("Gabim gjatë resetimit të shportës.");
                }
            });
        }
    });

        // Funksioni për shtimin në shportë
        $('.add-to-cart-form').on('submit', function(e) {
            e.preventDefault();
            var form = $(this);
            var productName = form.find('input[name="product_name"]').val();
            
            $.ajax({
                type: "POST",
                url: "",
                data: form.serialize(),
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        // Përditëso numrin e produkteve në shportë
                        $('.cart-items').text(response.cart_count);
                        
                        // Rikrijo dropdown-in e shportës
                        var cartHtml = '<h3>Your Cart</h3><div class="cart-items-list">';
                        
                        if (response.cart_items && response.cart_items.length > 0) {
                            var total = 0;
                            $.each(response.cart_items, function(index, item) {
                                cartHtml += `
                                    <div class="cart-item">
                                        <img src="${item.image}" alt="${item.name}" width="50">
                                        <div class="cart-item-details">
                                            <h4>${item.name}</h4>
                                            <p>$${item.price.toFixed(2)}</p>
                                            <p>Quantity: ${item.quantity}</p>
                                            <form method="post" action="#top" class="remove-from-cart-form" style="display:inline;">
                    <input type="hidden" name="remove_id" value="${item.id}">
                    <input type="hidden" name="remove_from_cart" value="1">
                    <button type="submit" class="remove-btn" title="Remove item">❌</button>
                </form>

                                        </div>
                                    </div>
                                `;
                                total += item.price * item.quantity;
                            });
                            
                            cartHtml += `
                                <div class="cart-total">
                                    Total: $${total.toFixed(2)}
                                </div>
   
                            `;
                        } else {
                            cartHtml += '<p>Your cart is empty</p>';
                        }
                        
                        cartHtml += '</div>';
                        $('#cart-dropdown').html(cartHtml).addClass('show');
                        
                        // Shfaq mesazhin e suksesit
                        alert('"' + productName + '" u shtua me sukses në shportë!');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Gabim:', error);
                    alert('Ndodhi një gabim gjatë shtimit të produktit në shportë.');
                }
            });
        });


$(document).on('submit', '.remove-from-cart-form', function(e) {
    e.preventDefault();
    var form = $(this);
    $.ajax({
        type: "POST",
        url: "",
        data: form.serialize(),
        dataType: "json",
        success: function(response) {
            if (response.success) {
                $('.cart-items').text(response.cart_count);

                     var cartHtml = '<h3>Your Cart</h3><div class="cart-items-list">';
                if (response.cart_items.length > 0) {
                    var total = 0;
                    $.each(response.cart_items, function(index, item) {
                        cartHtml += `
                            <div class="cart-item">
                                <img src="${item.image}" alt="${item.name}" width="50">
                                <div class="cart-item-details">
                                    <h4>${item.name}</h4>
                                    <p>$${item.price.toFixed(2)}</p>
                                    <p>Quantity: ${item.quantity}</p>
                                    <form method="post" class="remove-from-cart-form" style="display:inline;">
                                        <input type="hidden" name="remove_id" value="${item.id}">
                                        <input type="hidden" name="remove_from_cart" value="1">
                                        <button type="submit" class="remove-btn" title="Remove item">❌</button>
                                    </form>
                                </div>
                            </div>
                        `;
                        total += item.price * item.quantity;
                    });

                    cartHtml += `
                        <div class="cart-total">
                            Total: $${total.toFixed(2)}
                        </div>
                    `;
                } else {
                    cartHtml += '<p>Your cart is empty</p>';
                }
                cartHtml += '</div>';

                $('#cart-dropdown').html(cartHtml).addClass('show');
            }
        },
        error: function(xhr, status, error) {
            alert("Ndodhi një gabim gjatë largimit të produktit.");
        }
   
    });
});

        // Shfaq/fshih dropdown-in e shportës
        $('#cart-toggle').on('click', function(e) {
            e.preventDefault();
            $('#cart-dropdown').toggleClass('show');
        });

        // Funksioni për menunë
        $("#menu").hide();
        $("#menuBtn").on("mouseenter", function() {
            $("#menu").slideDown(500);
        });
    });
    
    </script>
</body>
</html>