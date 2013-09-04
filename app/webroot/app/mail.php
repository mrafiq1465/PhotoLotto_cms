<?php
$to      = 'htbordin@gmail.com';
$subject = 'the subject';
$message = 'hello';
$headers = 'From: contact@platinumremovals.com.au' . "\r\n" .
    'Reply-To: contact@platinumremovals.com.au' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);
?>