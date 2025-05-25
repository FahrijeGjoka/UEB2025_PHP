<?php
if (isset($_POST['submit'])) {
    require_once 'db.php';

    $name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $subject = filter_var(trim($_POST['subject']), FILTER_SANITIZE_STRING);
    $message = filter_var(trim($_POST['message']), FILTER_SANITIZE_STRING);

    $name = mysqli_real_escape_string($conn, $name);
    $email = mysqli_real_escape_string($conn, $email);
    $subject = mysqli_real_escape_string($conn, $subject);
    $message = mysqli_real_escape_string($conn, $message);

    $sql = "INSERT INTO sugjerimet (name, email, subject, message)
            VALUES ('$name', '$email', '$subject', '$message')";

    if (mysqli_query($conn, $sql)) {
        echo "<p id='success-msg' style='background-color:#2c3e50; color:#eacaca; font-weight:bold; font-style:italic; font-family:Georgia, serif; padding:10px 20px; border-radius:8px; display:inline-block; margin-top:20px;'>Sugjerimi u ruajt me sukses!</p>";
    } else {
        echo "<p style='color: red;'>Gabim gjatë ruajtjes në databazë: " . mysqli_error($conn) . "</p>";
    }

    $to = "elsa.krasniqi12@student.uni-pr.edu";
    $email_subject = "Sugjerim nga $name: $subject";
    $email_body = "Emri: $name\nEmail: $email\n\nMesazhi:\n$message";
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";

    //mail($to, $email_subject, $email_body, $headers);

    mysqli_close($conn);
}
?>
