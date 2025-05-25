<?php
$emri = "ParfumSpot";
$adresa = "Rruga B, Prishtinë 10000, Kosovë";
$email = "kontakt@parfumspot.com";

$teksti = "Emri i kompanisë: $emri\nAdresa: $adresa\nEmaili: $email\n\n";

$file = fopen("te_dhenat_kompanise.txt", "w"); 
fwrite($file, $teksti);
fclose($file);

echo "Të dhënat për kompaninë u ruajtën me sukses!";
?>
