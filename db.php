<?php
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "arome";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("<p style='color: red;'> Gabim në lidhje me databazën: " . mysqli_connect_error() . "</p>");
} else {
   // echo "<p style='color: green;'> Lidhja me databazën 'ushtrime' u realizua me sukses!</p>";
}


?>
