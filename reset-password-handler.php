<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['user_id'];
$oldPass = $_POST['old_password'] ?? '';
$newPass = $_POST['new_password'] ?? '';
$confirmPass = $_POST['confirm_password'] ?? '';

// Merr passwordin aktual nga databaza
$stmt = $conn->prepare("SELECT password FROM users WHERE id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user || !password_verify($oldPass, $user['password'])) {
    echo "<script>alert('Old password is incorrect.'); window.location.href='reset-password.php';</script>";
    exit;
}

if ($newPass !== $confirmPass) {
    echo "<script>alert('New passwords do not match.'); window.location.href='reset-password.php';</script>";
    exit;
}

// Update password
$newHashed = password_hash($newPass, PASSWORD_DEFAULT);
$updateStmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
$updateStmt->bind_param("si", $newHashed, $userId);
$updateStmt->execute();

echo "<script>alert('Password changed successfully!'); window.location.href='profile.php';</script>";
