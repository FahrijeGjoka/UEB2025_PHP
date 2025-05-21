<?php
session_start();
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    function validate($data) {
        return htmlspecialchars(stripslashes(trim($data)));
    }

    $username = validate($_POST['username']);
    $password = validate($_POST['password']);
    $re_password = validate($_POST['re_password']);
    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $phone = validate($_POST['phone']);
    $address = validate($_POST['address']);

    $user_data = "username=" . urlencode($username) . "&name=" . urlencode($name) . "&email=" . urlencode($email) . "&phone=" . urlencode($phone) . "&address=" . urlencode($address);

    if (empty($email)) {
        header("Location: signup-form.php?error=Email is required&$user_data");
        exit();
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: signup-form.php?error=Invalid email format&$user_data");
        exit();
    } elseif (empty($username)) {
        header("Location: signup-form.php?error=Username is required&$user_data");
        exit();
    } elseif (empty($password)) {
        header("Location: signup-form.php?error=Password is required&$user_data");
        exit();
    } elseif (empty($re_password)) {
        header("Location: signup-form.php?error=Please confirm your password&$user_data");
        exit();
    } elseif ($password !== $re_password) {
        header("Location: signup-form.php?error=Passwords do not match&$user_data");
        exit();
    } elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^a-zA-Z0-9]).{8,}$/', $password)) {
        header("Location: signup-form.php?error=Password must be strong (8+ chars, upper, lower, number, symbol)&$user_data");
        exit();
    }

    // Kontrollo nëse username apo email ekziston
    $stmt1 = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt1->execute([$username]);
    if ($stmt1->rowCount() > 0) {
        header("Location: signup-form.php?error=Username already exists&$user_data");
        exit();
    }

    $stmt2 = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt2->execute([$email]);
    if ($stmt2->rowCount() > 0) {
        header("Location: signup-form.php?error=Email already in use&$user_data");
        exit();
    }

    // Hash fjalëkalimin
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // INSERT përdoruesin
    $stmt = $pdo->prepare("INSERT INTO users (username, password, name, email, phone, address) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$username, $hashed_password, $name, $email, $phone, $address]);

    header("Location: login.php?success=Account created successfully");
    exit();
} else {
    header("Location: signup-form.php");
    exit();
}
