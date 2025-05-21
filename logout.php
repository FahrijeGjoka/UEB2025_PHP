<?php
session_start();
session_unset();     
session_destroy();   


if (isset($_COOKIE['PHPSESSID'])) {
    setcookie('PHPSESSID', '', time() - 3600, '/');
}


header("Location: login.php");
exit();
?>