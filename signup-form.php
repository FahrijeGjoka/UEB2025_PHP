<?php
$error = $_GET['error'] ?? '';
$success = $_GET['success'] ?? '';
$username = $_GET['username'] ?? '';
$name = $_GET['name'] ?? '';
$email = $_GET['email'] ?? '';
$phone = $_GET['phone'] ?? '';
$address = $_GET['address'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Signup</title>
    <link rel="stylesheet" href="css/signup.css?v=1.1">
</head>
<body>
    <h2>Regjistrohu</h2>

    <?php if ($error): ?><p style="color: red;"><?= htmlspecialchars($error) ?></p><?php endif; ?>
    <?php if ($success): ?><p style="color: green;"><?= htmlspecialchars($success) ?></p><?php endif; ?>

    <form action="signup.php" method="post">
        <input type="text" name="name" placeholder="Full Name" value="<?= htmlspecialchars($name) ?>"><br>
        <input type="text" name="username" placeholder="Username" value="<?= htmlspecialchars($username) ?>"><br>
        <input type="email" name="email" placeholder="Email" value="<?= htmlspecialchars($email) ?>"><br>
        <input type="password" name="password" placeholder="Password"><br>
        <input type="password" name="re_password" placeholder="Repeat Password"><br>
        <input type="text" name="phone" placeholder="Phone" value="<?= htmlspecialchars($phone) ?>"><br>
        <input type="text" name="address" placeholder="Address" value="<?= htmlspecialchars($address) ?>"><br>
        <button type="submit">Register</button>
    </form>
</body>
</html>
