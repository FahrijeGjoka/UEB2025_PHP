<?php
if (isset($_POST['submit'])) {
    require_once 'db.php';

    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Pastrimi për siguri minimale
    $name = mysqli_real_escape_string($conn, $name);
    $email = mysqli_real_escape_string($conn, $email);
    $subject = mysqli_real_escape_string($conn, $subject);
    $message = mysqli_real_escape_string($conn, $message);

    // Ruajtja në databazë
    $sql = "INSERT INTO sugjerimet (name, email, subject, message)
            VALUES ('$name', '$email', '$subject', '$message')";

    if (mysqli_query($conn, $sql)) {
        echo "<p id='success-msg' style='background-color:#2c3e50; color:#eacaca; font-weight:bold; font-style:italic; font-family:Georgia, serif; padding:10px 20px; border-radius:8px; display:inline-block; margin-top:20px;'>Sugjerimi u ruajt me sukses!</p>";
    } else {
        echo "<p style='color: red;'>Gabim gjatë ruajtjes në databazë: " . mysqli_error($conn) . "</p>";
    }

    mysqli_close($conn);
}
