<?php
session_start();
require 'db.php';

if (isset($_POST['username']) && isset($_POST['password']) &&
    isset($_POST['name']) && isset($_POST['re_password']) &&
    isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['address'])) {

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

    $check_username = "SELECT id FROM users WHERE username = '$username'";
    $check_email = "SELECT id FROM users WHERE email = '$email'";

    $result_username = mysqli_query($conn, $check_username);
    $result_email = mysqli_query($conn, $check_email);

    if (mysqli_num_rows($result_username) > 0) {
        header("Location: signup-form.php?error=Username already exists&$user_data");
        exit();
    }

    if (mysqli_num_rows($result_email) > 0) {
        header("Location: signup-form.php?error=Email already registered&$user_data");
        exit();
    }

    $hashed = password_hash($password, PASSWORD_BCRYPT);
    $sql = "INSERT INTO users (username, password, name, email, phone, address) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssssss", $username, $hashed, $name, $email, $phone, $address);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: login.php?success=Account created successfully");
        exit();
    } else {
        header("Location: signup-form.php?error=Something went wrong&$user_data");
        exit();
    }

} else {
    header("Location: signup-form.php");
    exit();
}
?>
