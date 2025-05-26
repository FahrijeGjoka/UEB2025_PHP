<?php
require_once 'db.php';

session_start();
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'], $_POST['price'])) {
    $name = $_POST['name'];
    $price = floatval($_POST['price']);

    // Check if product exists in cart
    $found = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['name'] === $name) {
            $item['quantity'] += 1;
            $found = true;
            break;
        }
    }
    if (!$found) {
        $_SESSION['cart'][] = ['name' => $name, 'price' => $price, 'quantity' => 1];
    }

    echo json_encode(['success' => true, 'cart_count' => array_sum(array_column($_SESSION['cart'], 'quantity'))]);
    exit;
}

$message = "Welcome to our store!";
define("Arome", "Online Shop");

$day = date("l");
switch ($day) {
    case "Monday": $message = "Happy Monday! Fresh week, fresh scents!"; break;
    case "Tuesday": $message = "Tuesday Treat! Free shipping on all orders"; break;
    case "Wednesday": $message = "Midweek Special! Buy 2, get 1 free!"; break;
    case "Thursday": $message = "Thursday Thrill! 15% off all men's fragrances!"; break;
    case "Friday": $message = "Friday Deal! Get 10% off!"; break;
    case "Saturday": $message = "Weekend Vibes! 20% off select perfumes!"; break;
    case "Sunday": $message = "Sunday Relax! Enjoy our free samples with your order!!"; break;
    default: $message = "Welcome to " . Arome; break;
}

function checkFreeShippingForProduct($price) {
    return $price > 100 ? "Free Shipping!" : "Shipping Cost: $3.99";
}

$slogans = [
    "Smell like never before!",
    "Find your signature scent.",
    "Elegance in every drop.",
    "Style. Fragrance. You."
];
$random_slogan = $slogans[array_rand($slogans)];



$products = [];
$sql = "SELECT * FROM parfumet WHERE kategoria = 'Men'";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = [
            'id' => $row['id'],
            'name' => $row['emri'],
            'brand' => '', // opsional
            'price' => $row['cmimi'],
            'image' => $row['foto'],
            'description' => $row['pershkrimi']
        ];
    }
}

$dayIndex = date("w");
$productOfTheDay = $products[$dayIndex % count($products)];

// Product of the day
$dayIndex = date("w");
$productOfTheDay = $products[$dayIndex % count($products)];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Shop</title>
    <link rel="stylesheet" href="css/men.css?v=1.1">
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
        <div class="cart" onclick="toggleCart()">
            <span>Cart 🛒</span>
            <span class="cart-items" id="cart-count">
                <?php echo isset($_SESSION['cart']) ? array_sum(array_column($_SESSION['cart'], 'quantity')) : 0; ?>
            </span>
        </div>
    </header>

    <div id="side-cart" class="side-cart hidden">
        <div class="cart-header">
            <h2>Your Cart</h2>
            <button onclick="toggleCart()">✖</button>
        </div>
        <div class="cart-content" id="cart-content">
            <?php if (!empty($_SESSION['cart'])): ?>
                <ul>
                    <?php foreach ($_SESSION['cart'] as $item): ?>
                        <li>
                            <?php echo $item['name']; ?> x<?php echo $item['quantity']; ?> - $<?php echo number_format($item['price'] * $item['quantity'], 2); ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>Your cart is empty.</p>
            <?php endif; ?>
        </div>
    </div>

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
            <h3 style="font-size: 1.5em; margin-bottom: 15px; color: #2c3e50;"><?php echo $productOfTheDay['name']; ?> by <?php echo $productOfTheDay['brand']; ?></h3>
            <p style="font-weight: bold; font-size: 1.3em; margin-bottom: 10px; color: #2c3e50;">Price: $<?php echo number_format($productOfTheDay['price'], 2); ?></p>
            <p style="font-size: 1.1em; margin-bottom: 20px; color: #2c3e50;"><?php echo checkFreeShippingForProduct($productOfTheDay['price']); ?></p>
            <a href="#" class="btn add-to-cart" data-name="<?php echo $productOfTheDay['name']; ?>" data-price="<?php echo $productOfTheDay['price']; ?>" style="font-size: 1.2em; padding: 12px 20px; background-color: #2c3e50; color: #f4c2c2; border-radius: 0px;">Add to Cart</a>
        </div>
    </section>

    <section class="products">
        <h2>Featured Products</h2>
        
        <?php foreach ($products as $product): ?>
            <div class="product">
                <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                <h3><?php echo $product['name']; ?></h3>
                <p><?php echo $product['description']; ?></p>
                <span class="price">$<?php echo number_format($product['price'], 2); ?></span>
                <p><?php echo checkFreeShippingForProduct($product['price']); ?></p>
                <a href="#" class="btn add-to-cart" data-name="<?php echo $product['name']; ?>" data-price="<?php echo $product['price']; ?>">Add to Cart</a>
            </div>
        <?php endforeach; ?>
        
        <div class="cart-details" style="width: 100%; display: flex; justify-content: center; align-items: center; margin: 20px 0;">
            <h1 style="color: #ffc0cb; font-size: 1.8em; text-align: center;">
                <?php echo $random_slogan; ?>
            </h1>
        </div>
    </section>

    <footer>
        <p>&copy; 2024 Online Shop</p>
    </footer>

    <script>
        function toggleCart() {
            const cart = document.getElementById('side-cart');
            cart.classList.toggle('visible');
            cart.classList.toggle('hidden');
        }

        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const name = this.getAttribute('data-name');
                const price = this.getAttribute('data-price');

                fetch('', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: `name=${encodeURIComponent(name)}&price=${encodeURIComponent(price)}`
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('cart-count').textContent = data.cart_count;
                        alert('Product added to cart!');
                    }
                });
            });
        });
    </script>
</body>
</html>