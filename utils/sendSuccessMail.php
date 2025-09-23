<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader (created by composer, not included with PHPMailer)
require __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

if (empty($dotenv)) {
  $dotenv = Dotenv::createImmutable(__DIR__  . "/../");
  $dotenv->load();
}

function sendSuccessMail(string $subject, string $body, string $to): void
{
  $mail = new PHPMailer(true);

  try {
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = $_ENV["PROVIDER_EMAIL"];                     //SMTP username
    $mail->Password   = $_ENV["PROVIDER_SECRET"];                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom($_ENV["PROVIDER_EMAIL"], 'newsLetter');
    $mail->addAddress($to, 'User');     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $body;
    $mail->AltBody = $subject;

    $mail->send();
    return;
  } catch (Exception $e) {
    return;
  }
}
