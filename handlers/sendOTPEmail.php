<?php

//Load Composer's autoloader (created by composer, not included with PHPMailer)
require_once __DIR__ . '/../vendor/autoload.php';

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
  if ($_SERVER["REQUEST_METHOD"] !== "POST" && !isset($_POST["email"])) {
    throw new Exception("Invalid Credentials");
  }

  $to = $_POST["email"];

  if (!preg_match_all("/^[^\s@]+@[^\s@]+\.[^\s@]+$/", $to)) {
    throw new Exception("Invalid Email Format");
  }

  $otp = rand(100000, 999999);

  $body = file_get_contents(__DIR__ . "/../assets/mail_templates/otp.template.html");

  $body = str_replace("{{OTP}}", $otp, $body);

  //Server settings
  // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
  $mail->isSMTP();                                            //Send using SMTP
  $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
  $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
  $mail->Username   = $_ENV["PROVIDER_EMAIL"];                     //SMTP username
  $mail->Password   = $_ENV["PROVIDER_SECRET"];                               //SMTP password
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
  $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

  //Recipients
  $mail->setFrom($_ENV["PROVIDER_EMAIL"], "NewsLetter");
  $mail->addAddress($to, "User");     //Add a recipient

  //Content
  $mail->isHTML(true);                                  //Set email format to HTML
  $mail->Subject = 'ONE-TIME-PASSWORD';
  $mail->Body    = $body;
  $mail->AltBody = "ONE-TIME-PASSWORD: $otp";

  $mail->send();
  die();
} catch (Exception $e) {
  die($e->getMessage());
}
