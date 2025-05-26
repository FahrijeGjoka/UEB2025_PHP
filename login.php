<?php
session_start();
require 'db.php';

$error = '';
$message = '';

// Nëse përdoruesi është dërguar këtu nga një faqe e mbrojtur
if (isset($_SESSION['redirect_after_login'])) {
    $page = $_SESSION['redirect_after_login'];
    $friendlyName = ucfirst(basename($page, ".php")); // p.sh. Women
    $message = "Për të parë faqen <strong>$friendlyName</strong>, ju lutemi kyçuni ose regjistrohuni.";
}

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

        if ($user) {
            if ($user['is_active'] == 0) {
                $error = "Llogaria nuk është aktivizuar. Kontrolloni emailin.";
            } elseif (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['username'];

                if (isset($_SESSION['redirect_after_login'])) {
                    $redirect = $_SESSION['redirect_after_login'];
                    unset($_SESSION['redirect_after_login']);
                    header("Location: $redirect");
                } else {
                    header("Location: profile.php");
                }
                exit();
            } else {
                $error = "Email ose fjalëkalim i pasaktë.";
            }
        } else {
            $error = "Email ose fjalëkalim i pasaktë.";
        }
    }
}

include 'login-form.php';
