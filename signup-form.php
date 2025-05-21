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
    <title>Sign Up</title>    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

</head>
<body>
<div class="wrapper">
    <div class="form-container">
        <h1>Sign Up</h1>

        <?php if ($error): ?>
            <div class="error-container">
                <p class="error-message"><?= htmlspecialchars($error) ?></p>
            </div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="success-message">
                <p><?= htmlspecialchars($success) ?></p>
            </div>
        <?php endif; ?>

        <form action="signup.php" method="post">
            <div class="input-container">
                <i class="fas fa-user"></i>
                <input type="text" name="name" id="name" value="<?= htmlspecialchars($name) ?>" required>
                <label for="name">Full Name</label>
            </div>

            <div class="input-container">
                <i class="fas fa-user-tag"></i>
                <input type="text" name="username" id="username" value="<?= htmlspecialchars($username) ?>" required>
                <label for="username">Username</label>
            </div>

            <div class="input-container">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" id="email" value="<?= htmlspecialchars($email) ?>" required>
                <label for="email">Email</label>
            </div>

            <div class="input-container">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" id="password" required>
                <label for="password">Password</label>
            </div>

            <div class="input-container">
                <i class="fas fa-lock"></i>
                <input type="password" name="re_password" id="re_password" required>
                <label for="re_password">Confirm Password</label>
            </div>

            <div class="input-container">
                <i class="fas fa-phone"></i>
                <input type="text" name="phone" id="phone" value="<?= htmlspecialchars($phone) ?>" required>
                <label for="phone">Phone</label>
            </div>

            <div class="input-container">
                <i class="fas fa-map-marker-alt"></i>
                <input type="text" name="address" id="address" value="<?= htmlspecialchars($address) ?>" required>
                <label for="address">Address</label>
            </div>

            <div class="button-container">
                <button type="submit" class="btn">Sign Up</button>
                <button type="reset" class="btn" style="background: linear-gradient(135deg, #e74c3c, #c0392b);">Reset</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
