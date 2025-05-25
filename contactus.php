<?php
include 'db.php';  

$errors = [];
$successMessages = [];

$name = '';
$email = '';
$message = '';
$perfumeInterests = [];
$experience = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $message = isset($_POST['message']) ? trim($_POST['message']) : '';
    $perfumeInterests = isset($_POST['perfume']) && is_array($_POST['perfume']) ? $_POST['perfume'] : [];
    $experience = isset($_POST['perfumes']) ? $_POST['perfumes'] : '';

    if (empty($name)) {
        $errors[] = "Ju lutem shkruani emrin tuaj.";
    }
    if (empty($email)) {
        $errors[] = "Ju lutem shkruani email-in tuaj.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email-i është në format të gabuar.";
    }
    if (empty($message)) {
        $errors[] = "Ju lutem shkruani mesazhin tuaj.";
    }
    if (empty($perfumeInterests)) {
        $errors[] = "Ju lutem zgjidhni interesat për parfume.";
    }
    if (empty($experience)) {
        $errors[] = "Ju lutem tregoni eksperiencën tuaj.";
    }

    if (empty($errors)) {
        // Sigurohemi që emaili është i sigurt për query
        $email_safe = mysqli_real_escape_string($conn, $email);

        $sql_check_user = "SELECT id FROM users WHERE email = '$email_safe'";
        $result = mysqli_query($conn, $sql_check_user);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $userId = $row['id'];

            $name_db = mysqli_real_escape_string($conn, $name);
            $message_db = mysqli_real_escape_string($conn, $message);
            $interests_db = mysqli_real_escape_string($conn, implode(", ", $perfumeInterests));
            $experience_db = mysqli_real_escape_string($conn, $experience);

            $sql_insert = "INSERT INTO contact (userId, name, email, message, interest, experience)
                           VALUES ('$userId', '$name_db', '$email_safe', '$message_db', '$interests_db', '$experience_db')";

            if (mysqli_query($conn, $sql_insert)) {
                $successMessages[] = "Faleminderit! Forma u dërgua me sukses.";

                // Pastrimi i vlerave pas dërgimit të suksesshëm
                $name = $email = $message = '';
                $perfumeInterests = [];
                $experience = '';
            } else {
                $errors[] = "Gabim gjatë dërgimit të formës: " . mysqli_error($conn);
            }
        } else {
            $errors[] = "Email-i nuk është i regjistruar. Ju lutem krijoni një llogari para se të dërgoni formularin.";
            $errors[] = "<a href='signup.php'>Regjistrohu këtu</a>";
        }
    }
}
?>

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

<?php
if (!empty($errors)) {
    foreach ($errors as $error) {
        echo "<div class='error-message'>$error</div>";
    }
}
if (!empty($successMessages)) {
    foreach ($successMessages as $msg) {
        echo "<div class='success-message'>$msg</div>";
    }
}
?>

<form id="contactForm" action="contactus.php" method="POST">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>">

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>">

    <label for="message">Message:</label>
    <textarea id="message" name="message"><?php echo htmlspecialchars($message); ?></textarea>

    <div class="chkbx">
        <div class="question">
            Are you interested in women or men perfumes?<br><br>
        </div>
        <div class="options">
            <label><input type="checkbox" name="perfume[]" value="women" <?php if(in_array("women", $perfumeInterests)) echo "checked"; ?>> Women</label>
            <label><input type="checkbox" name="perfume[]" value="men" <?php if(in_array("men", $perfumeInterests)) echo "checked"; ?>> Men</label>
        </div>
    </div>

    <div class="rdbtn">
        <div class="write">
            How was your experience?<br><br>
        </div>
        <div class="options">
            <label><input type="radio" name="perfumes" value="excellent" <?php if($experience === "excellent") echo "checked"; ?>> Excellent</label>
            <label><input type="radio" name="perfumes" value="Verygood" <?php if($experience === "Verygood") echo "checked"; ?>> Very good</label>
            <label><input type="radio" name="perfumes" value="Good" <?php if($experience === "Good") echo "checked"; ?>> Good</label>
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
document.addEventListener("DOMContentLoaded", function () {
    const body = document.body;
    const womenCheckbox = document.querySelector('input[name="perfume[]"][value="women"]');
    const menCheckbox = document.querySelector('input[name="perfume[]"][value="men"]');

    function updateBackground() {
        if (womenCheckbox.checked) {
            body.style.backgroundColor = "#fff0f5"; 
        } else if (menCheckbox.checked) {
            body.style.backgroundColor = "#f0f8ff";
        } else {
            body.style.backgroundColor = "#e6ffe6"; 
        }
    }

    womenCheckbox.addEventListener('change', updateBackground);
    menCheckbox.addEventListener('change', updateBackground);

    updateBackground();
});
</script>

</body>
</html>
