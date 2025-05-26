<?php

require_once 'auth.php';
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $old = trim($_POST['old_password']);
    $new = trim($_POST['new_password']);
    $confirm = trim($_POST['confirm_password']);

    if (empty($old) || empty($new) || empty($confirm)) {
        $message = "Ju lutem plotësoni të gjitha fushat.";
    } elseif ($new !== $confirm) {
        $message = "Fjalëkalimet e reja nuk përputhen.";
    } elseif (strlen($new) < 8) {
        $message = "Fjalëkalimi i ri duhet të jetë të paktën 8 karaktere.";
    } else {
        $sql = "SELECT password FROM users WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $_SESSION['user_id']);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);

        if ($user && password_verify($old, $user['password'])) {
            $hash = password_hash($new, PASSWORD_BCRYPT);
            $update = "UPDATE users SET password = ? WHERE id = ?";
            $stmt2 = mysqli_prepare($conn, $update);
            mysqli_stmt_bind_param($stmt2, "si", $hash, $_SESSION['user_id']);
            mysqli_stmt_execute($stmt2);
            $message = "Fjalëkalimi u ndryshua me sukses!";
        } else {
            $message = "Fjalëkalimi i vjetër nuk është i saktë.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <link rel="stylesheet" href="css/signup.css">
    <style>
        .form-container { max-width: 500px; margin-top: 50px; }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="form-container">
        <h1>Reset Password</h1>

        <?php if (!empty($message)): ?>
            <div class="success-message">
                <p><?= htmlspecialchars($message) ?></p>
            </div>
        <?php endif; ?>

        <form method="post">
            <div class="input-container">
                <input type="password" name="old_password" required>
                <label for="old_password">Old Password</label>
            </div>
            <div class="input-container">
                <input type="password" name="new_password" required>
                <label for="new_password">New Password</label>
            </div>
            <div class="input-container">
                <input type="password" name="confirm_password" required>
                <label for="confirm_password">Confirm Password</label>
            </div>
            <div class="button-container">
                <button type="submit" class="btn">Update</button>
                <a href="profile.php" class="btn">Back</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>
