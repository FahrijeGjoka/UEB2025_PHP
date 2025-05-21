<?php
$allPerfumes = ["Dior", "Chanel", "Gucci", "Tom Ford", "Prada", "YSL", "Good Girl", "Versace", "Armani", "Valentino"];

// Kontrollo nëse përdoruesi i ka pranuar cookies
$cookieConsentAccepted = isset($_COOKIE['cookie_consent']) && $_COOKIE['cookie_consent'] === 'accepted';

// Ruaj parfumin vetëm nëse është dhënë leja për cookies
if ($cookieConsentAccepted && isset($_POST['selected_perfume'])) {
    $selectedPerfume = $_POST['selected_perfume'];
    setcookie("favorite_perfume", $selectedPerfume, time() + (86400 * 7), "/");
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Mesazhi në bazë të cookies (nëse ekziston)
$cookieMessage = isset($_COOKIE['favorite_perfume'])
    ? "Your favorite perfume is: <strong>{$_COOKIE['favorite_perfume']}</strong>"
    : "No favorite perfume selected yet.";

// Fshij parfumin vetëm nëse cookies janë lejuar
$cookieDeleteStatus = "";
if ($cookieConsentAccepted && isset($_GET['delete_cookie'])) {
    setcookie("favorite_perfume", "", time() - 3600, "/");
    $cookieDeleteStatus = "Favorite perfume has been deleted.";
}

// Vendos fotografinë vetëm nëse është pranuar përdorimi i cookies
if ($cookieConsentAccepted && isset($_POST['setPhoto'])) {
    $selectedPhoto = $_POST['mainPhoto'];
    $imagePath = "images/" . $selectedPhoto;
    setcookie("main_image", $imagePath, time() + (86400 * 7), "/");
    $_COOKIE['main_image'] = $imagePath; // vetëm për përdorim të menjëhershëm
}

// Vendosja e vlerave për foto, nëse ekziston cookie ose shfaq foton default
$imageSrc = isset($_COOKIE['main_image']) ? $_COOKIE['main_image'] : "images/img_0107.jpg";
$imageAlt = isset($_COOKIE['main_image']) ? pathinfo($_COOKIE['main_image'], PATHINFO_FILENAME) : "Default";
?>
