<?php
// Include PHPMailer library files
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'C:\xampp\htdocs\Capstone\src\Exception.php';
require 'C:\xampp\htdocs\Capstone\src\PHPMailer.php';
require 'C:\xampp\htdocs\Capstone\src\SMTP.php';

// Create a new PHPMailer object
$mail = new PHPMailer();

// Set PHPMailer to use SMTP
$mail->isSMTP();

// Configure SMTP settings
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;          // Enable SMTP authentication
$mail->Username = 'uphsgregistrar@gmail.com'; // SMTP username
$mail->Password = 'djoqjencqofcvauj'; // SMTP password
$mail->SMTPSecure = 'tls';       // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;               // TCP port to connect to

// Set email details
$mail->setFrom('uphsgregistrar@gmail.com', 'Alex');
$mail->addAddress('g19-0029-490@gma.uphsl.edu.ph');     // Add a recipient
$mail->Subject = 'HEHE BOI';
$mail->Body    = 'BAHOG BILAT.';

// Send the email and check for errors
if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo  'Message sent successfully!';

}

?>