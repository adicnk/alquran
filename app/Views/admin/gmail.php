<?php



/**

 * This example shows making an SMTP connection with authentication.

 */



//Import the PHPMailer class into the global namespace

require 'mail/src/Exception.php';

require 'mail/src/PHPMailer.php';

require 'mail/src/SMTP.php';



//SMTP needs accurate times, and the PHP time zone MUST be set

//This should be done in your php.ini, but this is how to do it if you don't have access to that

date_default_timezone_set('Etc/UTC');



//Create a new PHPMailer instance

$mail = new PHPMailer();

//Tell PHPMailer to use SMTP

$mail->isSMTP();

//Enable SMTP debugging

//SMTP::DEBUG_OFF = off (for production use)

//SMTP::DEBUG_CLIENT = client messages

//SMTP::DEBUG_SERVER = client and server messages

$mail->SMTPDebug = SMTP::DEBUG_SERVER;

//Set the hostname of the mail server

$mail->Host = 'keperawatan.devinc.website';

//Set the SMTP port number - likely to be 25, 465 or 587

$mail->Port = 25;

//Whether to use SMTP authentication

$mail->SMTPAuth = true;

//Username to use for SMTP authentication

$mail->Username = 'contact@keperawatan.devinc.website';

//Password to use for SMTP authentication

$mail->Password = 'kprwt2023';

//Set who the message is to be sent from

$mail->setFrom('contact@keperawatan.devinc.website', 'Daftar Latihan Soal');

//Set an alternative reply-to address

$mail->addReplyTo('contact@keperawatan.devinc.website', 'Daftar Latihan Soal');

//Set who the message is to be sent to

$mail->addAddress('adicoolnkeren@gmail.com', 'Adi');

//Set the subject line

$mail->Subject = 'PHPMailer SMTP test';

//Read an HTML message body from an external file, convert referenced images to embedded,

//convert HTML into a basic plain-text alternative body

$mail->msgHTML('This is The Message');

//Replace the plain text body with one created manually

$mail->AltBody = 'This is a plain-text message body';

//Attach an image file

$mail->addAttachment('logo/logo.png');



//send the message, check for errors

if (!$mail->send()) {

    echo 'Mailer Error: ' . $mail->ErrorInfo;

} else {

    echo 'Message sent!';

}



?>