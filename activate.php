<?php
require 'db.php';

if (!isset($_GET['token'])) {
    $message = "Token mungon.";
} else {
    $token = $_GET['token'];

    $sql = "SELECT id FROM users WHERE activation_token = ? AND is_active = 0";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $token);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($user = mysqli_fetch_assoc($result)) {
        $update_sql = "UPDATE users SET is_active = 1, activation_token = NULL WHERE id = ?";
        $update_stmt = mysqli_prepare($conn, $update_sql);
        mysqli_stmt_bind_param($update_stmt, "i", $user['id']);
        mysqli_stmt_execute($update_stmt);

        $message = "<span style='color:green;'>Llogaria u aktivizua me sukses! Tani mund të kyçesh. <a href='login.php'>Kyçu këtu</a>.</span>";
    } else {
        $message = "<span style='color:red;'>Linku i aktivizimit është i pavlefshëm ose llogaria është tashmë aktive.</span>";
    }
}
?>

<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <title>Aktivizimi i Llogarisë</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding-top: 100px;
            background-color: #f5f5f5;
        }
        .message-box {
            display: inline-block;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="message-box">
        <?= $message ?>
    </div>
</body>
</html>
