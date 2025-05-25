<?php
session_start();
require 'db.php';
require 'config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
    $email = trim($_POST['email']);

    $sql = "SELECT name, username, activation_token, is_active FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($user = mysqli_fetch_assoc($result)) {
        if ($user['is_active'] == 1) {
            echo "<h3>Llogaria është tashmë aktive. Mund të kyçesh.</h3>";
            exit();
        }

        $name = $user['name'];
        $username = $user['username'];
        $token = $user['activation_token'];

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = MAIL_USERNAME;
            $mail->Password = MAIL_PASSWORD;
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom(MAIL_USERNAME, 'Parfumeria');
            $mail->addAddress($email, $name);

            $activation_link = "http://localhost/UEB2025_PHP/activate.php?token=$token";

            $mail->isHTML(true);
            $mail->Subject = 'Ridergim i emailit të aktivizimit';
            $mail->Body = "
                <h2>Përshëndetje $name!</h2>
                <p>Ky është një ridergim i linkut të aktivizimit për llogarinë me emrin <strong>$username</strong>.</p>
                <p>Aktivizo llogarinë tënde duke klikuar më poshtë:</p>
                <a href='$activation_link'>$activation_link</a>
            ";
            $mail->AltBody = "Aktivizo llogarinë tënde: $activation_link";

            $mail->send();
            echo "<h3>Emaili i aktivizimit u dërgua sërish! Kontrollo inbox-in.</h3>";
        } catch (Exception $e) {
            echo "<h3>Dërgimi i emailit dështoi. Gabim: {$mail->ErrorInfo}</h3>";
        }
    } else {
        echo "<h3>Nuk u gjet asnjë llogari me këtë email.</h3>";
    }
} else {
    echo "<h3>Emaili mungon në kërkesë.</h3>";
}
?>
