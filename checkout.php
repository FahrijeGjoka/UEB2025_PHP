<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header("Location: women.php");
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
    <title>Checkout</title>
    <style>
        body { font-family: Arial; padding: 20px; background-color: #f9f9f9; }
        .checkout-container { background: white; padding: 20px; border-radius: 10px; width: 80%; margin: auto; }
        .item { display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #ccc; }
        .total { font-weight: bold; font-size: 18px; padding-top: 15px; }
        .confirm-btn { margin-top: 20px; background: green; color: white; padding: 10px 20px; border: none; cursor: pointer; }
        img { max-height: 50px; }
    </style>
</head>
<body>
    <div class="checkout-container">
        <h1>Checkout Summary</h1>
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

       <hr style="margin: 30px 0;">

<div style="text-align: center;">
    <h2 style="margin-bottom: 15px;">Payment Options</h2>
    
    <button style="background-color: #ffc439; padding: 10px 20px; border: none; border-radius: 5px; font-size: 16px; margin: 10px;">
        <img src="https://www.paypalobjects.com/webstatic/mktg/logo/pp_cc_mark_111x69.jpg" alt="PayPal" style="height: 30px; vertical-align: middle;">
        &nbsp;Pay with PayPal
    </button>

    <button style="background-color: #00457C; color: white; padding: 10px 20px; border: none; border-radius: 5px; font-size: 16px; margin: 10px;">
        <img src="https://img.icons8.com/color/48/000000/visa.png" alt="Visa" style="height: 24px; vertical-align: middle;">
        &nbsp;Credit / Debit Card
    </button>

    <div style="margin-top: 20px;">
        <img src="https://img.icons8.com/color/48/000000/visa.png"/>
        <img src="https://img.icons8.com/color/48/000000/mastercard-logo.png"/>
        <img src="https://img.icons8.com/color/48/000000/amex.png"/>
        <img src="https://img.icons8.com/color/48/000000/discover.png"/>
    </div>
</div>

    </div>
</body>
</html>
