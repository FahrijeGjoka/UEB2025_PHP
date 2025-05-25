<?php
$error = $error ?? '';
$success = $success ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
<div class="container">
    <div class="box">
        <div class="overlay"></div>
        <div class="content">
            <h1>Login</h1>

            <?php if (!empty($error)): ?>
                <p class="error-message"><?= $error ?></p>
            <?php endif; ?>

            <?php if (!empty($success)): ?>
                <p class="success-message"><?= htmlspecialchars($success) ?></p>
            <?php endif; ?>

            <form action="login.php" method="post">
                <div class="input-field">
                    <input type="email" name="email" id="email" required>
                    <label for="email">Email</label>
                </div>

                <div class="input-field">
                    <input type="password" name="password" id="password" required>
                    <label for="password">Password</label>
                </div>

                <button type="submit" class="btn">Login</button>
                <input type="reset" value="Reset">
            </form>

            <?php if (isset($_SESSION['pending_email'])): ?>
                <form action="resend-activation.php" method="post" style="margin-top: 15px;">
                    <input type="hidden" name="email" value="<?= htmlspecialchars($_SESSION['pending_email']) ?>">
                    <button type="submit" class="btn">Ridergo Emailin e Aktivizimit</button>
                </form>
            <?php endif; ?>
        </div>
    </div>
</div>
</body>
</html>
