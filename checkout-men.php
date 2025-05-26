<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header("Location: men.php");
    exit;
}

function format_price($price) {
    return "$" . number_format($price, 2);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Men's Fragrance Checkout</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #2c3e50;
            color: #ecf0f1;
        }

        .checkout-container {
            background: #ecf0f1;
            padding: 30px;
            border-radius: 12px;
            width: 80%;
            max-width: 800px;
            margin: auto;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            color: #2c3e50;
        }

        h1 {
            text-align: center;
            color: #2c3e50;
        }

        .item {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #bdc3c7;
        }

        .total {
            font-weight: bold;
            font-size: 20px;
            text-align: right;
            padding-top: 20px;
        }

        .confirm-btn {
            margin-top: 20px;
            background: green;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .confirm-btn:hover {
            background: #27ae60;
        }

        img {
            max-height: 50px;
            border-radius: 6px;
        }

        .payment-buttons button {
            background-color: #ffc439;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            margin: 10px;
            cursor: pointer;
        }

        .payment-buttons button.card {
            background-color: #00457C;
            color: white;
        }

        .payment-buttons button img {
            height: 24px;
            vertical-align: middle;
            margin-right: 10px;
        }

        .payment-icons img {
            margin: 0 8px;
            height: 40px;
        }
    </style>
</head>
<body>
    <div class="checkout-container">
        <h1>Men's Fragrance Checkout</h1>
        <p style="text-align: center; color: #555;">Review your selected men's perfumes before proceeding with payment.</p>

        <?php $total = 0; ?>
        <?php foreach ($_SESSION['cart'] as $item): ?>
            <div class="item">
                <div>
                    <strong><?php echo htmlspecialchars($item['name']); ?></strong><br>
                    Quantity: <?php echo $item['quantity']; ?>
                </div>
                <div>
                    <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>">
                    <?php
                    $price = $item['price'] * $item['quantity'];
                    $total += $price;
                    ?>
                    <div><?php echo format_price($price); ?></div>
                </div>
            </div>
        <?php endforeach; ?>

        <div class="total">Total: <?php echo format_price($total); ?></div>

        <hr style="margin: 30px 0; border-color: #ccc;">

        <div style="text-align: center;">
            <h2 style="margin-bottom: 15px;">Payment Options</h2>

            <div class="payment-buttons">
                <button>
                    <img src="https://www.paypalobjects.com/webstatic/mktg/logo/pp_cc_mark_111x69.jpg" alt="PayPal">
                    Pay with PayPal
                </button>

                <button class="card">
                    <img src="https://img.icons8.com/color/48/000000/visa.png" alt="Visa">
                    Credit / Debit Card
                </button>
            </div>

            <div class="payment-icons">
                <img src="https://img.icons8.com/color/48/000000/visa.png"/>
                <img src="https://img.icons8.com/color/48/000000/mastercard-logo.png"/>
                <img src="https://img.icons8.com/color/48/000000/amex.png"/>
                <img src="https://img.icons8.com/color/48/000000/discover.png"/>
            </div>
        </div>
    </div>
</body>
</html>
