<?php
	$name = $_POST['name'];
	$email = $_POST['email'];
	$message = $_POST['message'];

	$formcontent = "From: $name \nEmail: $email \n\n$message";
	$recipient = "josh@politeinpublic.com.au,nick@politeinpublic.com.au";
	$subject = "Pixta - Campaign Enquiry";
	$header = "From: Pixta Contact Form";
	$mailheader = "From: Pixta Contact Form";

	mail($recipient, $subject, $formcontent, $mailheader) or die("Error!");
?>