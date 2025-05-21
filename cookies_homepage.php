<?php
$allPerfumes = ["Dior", "Chanel", "Gucci", "Tom Ford", "Prada", "YSL", "Good Girl", "Versace", "Armani", "Valentino"];

if (isset($_POST['selected_perfume'])) {
    $selectedPerfume = $_POST['selected_perfume'];
    setcookie("favorite_perfume", $selectedPerfume, time() + (86400 * 7), "/");
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
$cookieMessage = isset($_COOKIE['favorite_perfume'])
    ? "Your favorite perfume is: <strong>{$_COOKIE['favorite_perfume']}</strong>"
    : "No favorite perfume selected yet.";

$cookieDeleteStatus = "";
if (isset($_GET['delete_cookie'])) {
    setcookie("favorite_perfume", "", time() - 3600, "/");
    $cookieDeleteStatus = "Favorite perfume has been deleted.";
}
if (isset($_POST['setPhoto'])) {
    $selectedPhoto = $_POST['mainPhoto'];
    $imagePath = "images/" . $selectedPhoto;
    setcookie("main_image", $imagePath, time() + (86400 * 7), "/");
    $_COOKIE['main_image'] = $imagePath;
}

// Vendosja e vlerave për foto
$imageSrc = isset($_COOKIE['main_image']) ? $_COOKIE['main_image'] : "images/img_0107.jpg";
$imageAlt = isset($_COOKIE['main_image']) ? pathinfo($_COOKIE['main_image'], PATHINFO_FILENAME) : "Default";

