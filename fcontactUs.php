<?php
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$call = $_POST['call'];
$type = $_POST['type'];
$message = $_POST['message'];
$formcontent=" From: $name \n Phone: $phone \n Call Back: $call \n Type: $type \n Message: $message";
$recipient = "noor.jamal@metropolia.fi";
$subject = "Contact Form";
$mailheader = "From: $email \r\n";
mail($recipient, $subject, $formcontent, $mailheader) or die("Error!");
echo "Kiitos palautteesta, otetaan yhteyttä mahdollisimman pian!" . " -" . "<a href='info.php' style='text-decoration:none;color:#ff0099;'> Takaisin Info sivulle</a>";
?>
