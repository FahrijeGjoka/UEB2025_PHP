<?php
require 'db.php';

if (!isset($_GET['token'])) {
    echo "Token mungon.";
    exit();
}

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

    echo "<h2>Llogaria u aktivizua me sukses! Tani mund të kyçesh në platformë.</h2>";
} else {
    echo "<h2>Linku i aktivizimit është i pavlefshëm ose llogaria është tashmë aktive.</h2>";
}
?>
