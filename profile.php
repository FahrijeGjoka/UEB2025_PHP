<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
    <link rel="stylesheet" href="css/profile.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<header>
    <div class="logo">Welcome, <span id="username-display"></span>!</div>
    <nav class="nav-links">
        <a href="men.php">Men</a>
        <a href="women.php">Women</a>
        <a href="contactus.php">Contact</a>
        <a href="aboutus.php">About</a>
        <a href="logout.php">Logout</a>
    </nav>
</header>

<div class="container">
    <div class="profile-section">
        <h2>My Profile</h2>

        <div id="quote-box" class="success-message">
            <em>Loading inspirational quote...</em>
        </div>

        <div id="response-message"></div>

        <div class="input-group">
            <label for="username">Username</label>
            <input type="text" id="username" disabled>
        </div>

        <div class="input-group">
            <label for="email">Email</label>
            <input type="email" id="email" disabled>
        </div>

        <div class="input-group">
            <label for="phone">Phone</label>
            <input type="text" id="phone" disabled>
        </div>

        <div class="input-group">
            <label for="address">Address</label>
            <input type="text" id="address" disabled>
        </div>

        <a href="reset-password.php" class="btn">Change Password</a>

        <div class="password-section" id="passwordFields" style="display:none;">
            <div class="input-group">
                <label for="new_password">New Password</label>
                <input type="password" id="new_password">
            </div>
            <div class="input-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password">
            </div>
        </div>

        <button class="btn" id="submit-btn">Submit</button>
    </div>
</div>

<script>
$(document).ready(function () {
    // Merr të dhënat e userit
    $.get("get-user.php", function (user) {
        if (user.username) {
            $("#username").val(user.username);
            $("#username-display").text(user.username);
            $("#email").val(user.email);
            $("#phone").val(user.phone);
            $("#address").val(user.address);
        } else {
            $("#username-display").text("Guest");
        }
    });

fetch("https://api.quotable.io/random?tags=beauty|nature")
  .then(res => res.json())
  .then(data => {
    $("#quote-box").html(`<q>${data.content}</q><br>— ${data.author}`);
  })
  .catch(() => {
    $("#quote-box").html(`<q>The scent of a flower is the soul of the plant.</q><br>— Unknown`);
  });




    // Shfaq ose fshih fushat për ndryshimin e passwordit me buton
    $('#toggle-password-fields').click(function () {
        $('#passwordFields').slideToggle();
    });

    // Funksion për mesazhe
    function showMessage(msg, type) {
        $('#response-message').html(`<div class="${type}-message">${msg}</div>`);
    }

    // Klikimi i Submit
    $('#submit-btn').click(function () {
        const newPass = $('#new_password').val();
        const confirmPass = $('#confirm_password').val();

        if ($('#passwordFields').is(':visible')) {
            if (!newPass || !confirmPass) {
                showMessage('Please fill in both password fields.', 'error');
                return;
            }
            if (newPass !== confirmPass) {
                showMessage('Passwords do not match.', 'error');
                return;
            }

            $.post('update-password.php', { password: newPass })
                .done(function (res) {
                    console.log("✅ Raw response:", res);
                    if (res.success) {
                        showMessage(res.success, 'success');
                    } else if (res.error) {
                        showMessage(res.error, 'error');
                    }
                }).fail(function () {
                    showMessage("Something went wrong while updating the password.", 'error');
                });
        } else {
            showMessage('Profile saved successfully (no password changes).', 'success');
        }
    });
});
</script>
</body>
</html>
