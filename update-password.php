<?php
session_start();
header('Content-Type: application/json');
require 'db.php'; 

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'Unauthorized']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newPassword = $_POST['password'] ?? '';

    if (strlen($newPassword) < 8) {
        echo json_encode(['error' => 'Password must be at least 8 characters long.']);
        exit();
    }

    $hashed = password_hash($newPassword, PASSWORD_BCRYPT);
    $id = $_SESSION['user_id'];

    $sql = "UPDATE users SET password = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "si", $hashed, $id);

    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(['success' => 'Password updated successfully.']);
    } else {
        echo json_encode(['error' => 'Failed to update password.']);
    }

    mysqli_stmt_close($stmt);
} else {
    echo json_encode(['error' => 'Invalid request method.']);
}
?>
