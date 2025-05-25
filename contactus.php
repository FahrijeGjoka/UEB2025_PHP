<?php
$errors = [];
$successMessages = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $perfumeInterests = $_POST['perfume'] ?? []; 
    $experience = $_POST['perfumes'] ?? '';

    if (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/", $email)) {
        $errors[] = "Invalid email format.";
    } else {
        $successMessages[] = "Thank you! Your email is valid!";
    }

    if (!empty($perfumeInterests)) {
        $interests = implode(", ", $perfumeInterests);
        setcookie("interest", $interests, time() + 3600); 
        $successMessages[] = "You showed interest in: $interests.";
    }

    if ($experience) {
        setcookie("experience", $experience, time() + 3600); 
        $successMessages[] = "Your experience rating: $experience.";
    }
}

$html = <<<HTML
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Contact Page</title>
    <link rel="stylesheet" href="css/contactus.css?v=1.1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
<header>
    <div class="logo">Contact Us</div>
    <nav>
        <ul>
            <li><a href="website.php">Homepage</a></li>
            <li><a href="women.php">Women</a></li>
            <li><a href="men.php">Men</a></li>
            <li><a href="gallery.php">Gallery</a></li>
            <li><a href="aboutus.php">About Us</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
    </nav>
</header>

<section class="hero">
    <h1>Contact Us</h1>
    <p>We are here to help you find the perfect fragrance</p>
</section>

<main>
HTML;

if (!empty($errors)) {
    foreach ($errors as $error) {
        $html .= "<div class='error-message'>$error</div>";
    }
}

if (!empty($successMessages)) {
    foreach ($successMessages as $msg) {
        $html .= "<div class='success-message'>$msg</div>";
    }
}

$html .= <<<HTML
    <form id="contactForm" action="contactus.php" method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="message">Message:</label>
        <textarea id="message" name="message" required></textarea>

        <div class="chkbx">
            <div class="question">
                Are you interested in women or men perfumes?<br><br>
            </div>
            <div class="options">
                <label><input type="checkbox" name="perfume[]" value="women"> Women</label>
                <label><input type="checkbox" name="perfume[]" value="men"> Men</label>
            </div>
        </div>

        <div class="rdbtn">
            <div class="write">
                How was your experience?<br><br>
            </div>
            <div class="options">
                <label><input type="radio" name="perfumes" value="excellent"> Excellent</label>
                <label><input type="radio" name="perfumes" value="Verygood"> Very good</label>
                <label><input type="radio" name="perfumes" value="Good"> Good</label>
            </div>
        </div>

        <br>
        <input type="submit" value="Send">
    </form>

    <div class="ul">
        <ul>For more informations, visit our site in:<br>
            <li class="li"><a href="https://facebook.com"><i class="fab fa-facebook"></i> Facebook</a></li>
            <li class="li"><a href="https://instagram.com"><i class="fab fa-instagram"></i> Instagram</a></li>
            <li class="li"><a href="https://tiktok.com"><i class="fab fa-tiktok"></i> TikTok</a></li>
        </ul>
    </div>
</main>

<footer>
    <p>Rruga Adem Jashari, Prishtine Kosove</p>
    <p>Phone: +383 49 001 001</p>
</footer>

<script>
document.getElementById("contactForm").addEventListener("submit", function(event) {
    const name = document.getElementById("name").value.trim();
    const email = document.getElementById("email").value.trim();
    const message = document.getElementById("message").value.trim();

    if (!name || !email || !message) {
        alert("Please fill in all required fields.");
        event.preventDefault();
    } else {
        alert("Thank you! Your form has been submitted successfully.");
    }
});

document.addEventListener("DOMContentLoaded", function () {
    function getCookie(name) {
        const value = "; " + document.cookie;
        const parts = value.split("; " + name + "=");
        if (parts.length === 2) return parts.pop().split(";").shift();
    }

    const interest = getCookie("interest");
    const experience = getCookie("experience");

    if (experience === "excellent") {
        document.body.style.backgroundColor = "#e6ffe6"; // green
    } else if (interest && interest.includes("women")) {
        document.body.style.backgroundColor = "#fff0f5"; // pink
    } else if (interest && interest.includes("men")) {
        document.body.style.backgroundColor = "#f0f8ff"; // blue
    }
});
</script>
</body>
</html>
HTML;

echo $html;
?>
