<?php
session_start();
?>

<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8" />
    <title>Shporta e Blerjeve</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background-color: #f8f8f8;
        }
        h2 {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }
        .cart-container {
            max-width: 700px;
            margin: 0 auto;
            background-color: #fff;
            padding: 25px 30px;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th {
            background-color: #f0f0f0;
            padding: 15px 10px;
            font-weight: 600;
            color: #444;
        }
        td {
            padding: 12px 10px;
            text-align: center;
            color: #555;
        }
        .total {
            font-weight: bold;
            color: #222;
            background-color: #fafafa;
        }
        .empty {
            color: #888;
            font-style: italic;
            text-align: center;
            padding: 40px 0;
            font-size: 1.2em;
        }
    </style>
</head>
<body>

<div class="cart-container">
    <h2>Shporta e Blerjeve</h2>

    <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
        <table>
            <tr>
                <th>Emri i Produktit</th>
                <th>Çmimi</th>
                <th>Sasia</th>
                <th>Totali</th>
            </tr>
            <?php
            $total = 0;
            foreach ($_SESSION['cart'] as $product):
                $subtotal = $product['price'] * $product['quantity'];
                $total += $subtotal;
            ?>
                <tr>
                    <td><?= htmlspecialchars($product['name']) ?></td>
                    <td><?= number_format($product['price'], 2) ?> €</td>
                    <td><?= $product['quantity'] ?></td>
                    <td><?= number_format($subtotal, 2) ?> €</td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="3" class="total">Totali:</td>
                <td class="total"><?= number_format($total, 2) ?> €</td>
            </tr>
        </table>
    <?php else: ?>
        <p class="empty">Shporta është bosh.</p>
    <?php endif; ?>
</div>

</body>
</html>
