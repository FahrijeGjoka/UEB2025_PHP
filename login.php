<?php
session_start();
require 'db.php';

$error = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
        $error = "Ju lutem plotësoni të gjitha fushat.";
    } else {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['username'];
            header("Location: profile.php");
            exit();
        } else {
            $error = "Email ose fjalëkalim i pasaktë.";
        }
    }
}

include 'login-form.php';
