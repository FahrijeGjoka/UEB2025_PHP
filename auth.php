<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    // Ruaje faqen që po tenton ta shohë user-i
    $_SESSION['redirect_after_login'] = basename($_SERVER['PHP_SELF']);
    header("Location: login.php");
    exit();
}
?>
