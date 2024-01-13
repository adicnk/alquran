<?php
$to = $email;
$subject = "This is a test";
$message = "This is a PHP plain text email example.";
$headers = "From: contact@keperawatan.devinc.website" ."\r\n" ."Reply-To: contact@keperawatan.devinc.website" ."\r\n";
mail($to, $subject, $message, $headers);
?>