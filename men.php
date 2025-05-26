<?php
require_once 'db.php';

session_start();
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'delete' && isset($_POST['name'])) {
        $name = $_POST['name'];
        foreach ($_SESSION['cart'] as $index => $item) {
            if ($item['name'] === $name) {
                unset($_SESSION['cart'][$index]);
                $_SESSION['cart'] = array_values($_SESSION['cart']);
                break;
            }
        }
        echo json_encode(['success' => true, 'cart_count' => array_sum(array_column($_SESSION['cart'], 'quantity'))]);
        exit;
    }

    if (isset($_POST['name'], $_POST['price'], $_POST['image'])) {
        $name = $_POST['name'];
        $price = floatval($_POST['price']);
        $image = $_POST['image'];

        $found = false;
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['name'] === $name) {
                $item['quantity'] += 1;
                $found = true;
                break;
            }
        }
        if (!$found) {
            $_SESSION['cart'][] = ['name' => $name, 'price' => $price, 'quantity' => 1, 'image' => $image];
        }

        echo json_encode(['success' => true, 'cart_count' => array_sum(array_column($_SESSION['cart'], 'quantity'))]);
        exit;
    }
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
            'brand' => '',
            'price' => $row['cmimi'],
            'image' => $row['foto'],
            'description' => $row['pershkrimi']
        ];
    }
}

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
    <style>
        .side-cart {
            position: fixed;
            right: 0;
            top: 0;
            width: 300px;
            height: 100%;
            background-color: white;
            box-shadow: -2px 0 5px rgba(0,0,0,0.3);
            overflow-y: auto;
            transform: translateX(100%);
            transition: transform 0.3s ease;
            z-index: 999;
        }
        .side-cart.visible {
            transform: translateX(0);
        }
        .cart-item {
            display: flex;
            align-items: center;
            margin: 10px;
        }
        .cart-item img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            margin-right: 10px;
        }
        .cart-item .details {
            flex: 1;
        }
        .cart-item button {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 4px 8px;
            cursor: pointer;
        }
    </style>
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

    <div id="side-cart" class="side-cart">
        <div class="cart-header" style="padding: 10px; border-bottom: 1px solid #ccc;">
            <h2 style="display: inline;">Your Cart</h2>
            <button style="float: right;" onclick="toggleCart()">✖</button>
        </div>
        <div class="cart-content" id="cart-content">
            <?php if (!empty($_SESSION['cart'])): ?>
                <?php foreach ($_SESSION['cart'] as $item): ?>
                    <div class="cart-item">
                        <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>">
                        <div class="details">
                            <strong><?php echo $item['name']; ?></strong><br>
                            x<?php echo $item['quantity']; ?> - $<?php echo number_format($item['price'] * $item['quantity'], 2); ?>
                        </div>
                        <button class="delete-item" data-name="<?php echo $item['name']; ?>">Delete</button>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p style="padding: 10px;">Your cart is empty.</p>
            <?php endif; ?>
        </div>

        <?php if (!empty($_SESSION['cart'])): ?>
            <div style="padding: 15px; text-align: center;">
                <a href="checkout-men.php" style="background-color: #2c3e50; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">
                    Checkout
                </a>
            </div>
        <?php endif; ?>
    </div>

    <div style="background-color: #f0f0f0; padding: 10px; margin: 20px 0; border-left: 5px solid orange;">
        <h3><?php echo $message; ?></h3>
    </div>

    <section class="hero">
        <h1>Welcome to Online Shop</h1>
        <p>Shop the latest trends in perfumes.</p>
    </section>

    <section class="product-of-day" style="background-color:rgb(195, 214, 227); padding: 30px; margin: 30px; border: 2px solid #2c3e50; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
        <h2 style="color: #2c3e50; text-align: center;">Product of the Day</h2>
        <div style="text-align: center;">
            <h3><?php echo $productOfTheDay['name']; ?></h3>
            <img src="<?php echo $productOfTheDay['image']; ?>" alt="<?php echo $productOfTheDay['name']; ?>" style="width: 150px;"><br>
            <strong>Price: $<?php echo number_format($productOfTheDay['price'], 2); ?></strong><br>
            <em><?php echo checkFreeShippingForProduct($productOfTheDay['price']); ?></em><br><br>
            <a href="#" class="btn add-to-cart" data-name="<?php echo $productOfTheDay['name']; ?>" data-price="<?php echo $productOfTheDay['price']; ?>" data-image="<?php echo $productOfTheDay['image']; ?>">Add to Cart</a>
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
                <a href="#" class="btn add-to-cart" data-name="<?php echo $product['name']; ?>" data-price="<?php echo $product['price']; ?>" data-image="<?php echo $product['image']; ?>">Add to Cart</a>
            </div>
        <?php endforeach; ?>
        <div class="cart-details" style="text-align: center; margin: 20px 0;">
            <h1 style="color: #ffc0cb;"><?php echo $random_slogan; ?></h1>
        </div>
    </section>

    <footer>
        <p>&copy; 2024 Online Shop</p>
    </footer>

    <script>
        function toggleCart() {
            document.getElementById('side-cart').classList.toggle('visible');
        }

        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const name = this.dataset.name;
                const price = this.dataset.price;
                const image = this.dataset.image;

                fetch('', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: `name=${encodeURIComponent(name)}&price=${encodeURIComponent(price)}&image=${encodeURIComponent(image)}`
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('cart-count').textContent = data.cart_count;
                        location.reload();
                    }
                });
            });
        });

        document.querySelectorAll('.delete-item').forEach(button => {
            button.addEventListener('click', function() {
                const name = this.dataset.name;
                fetch('', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: `action=delete&name=${encodeURIComponent(name)}`
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('cart-count').textContent = data.cart_count;
                        location.reload();
                    }
                });
            });
        });
    </script>
</body>
</html>
