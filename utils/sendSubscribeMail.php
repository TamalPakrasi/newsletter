<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader (created by composer, not included with PHPMailer)
require __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;


function sendSubscibeMail(string $email)
{
  $mail = new PHPMailer(true);

  try {

    session_regenerate_id(true);
    if (empty($dotenv)) {
      $dotenv = Dotenv::createImmutable(__DIR__ . "/../");
      $dotenv->load();
    }

    $body = file_get_contents(__DIR__ . "/../assets/mail_templates/subscribe.template.html");

    $cipher = $_ENV["ENC_CIPHER"];
    $token = bin2hex(random_bytes(32));
    $_SESSION["verification_token"] = $token;

    $verification_encryptionKey = hex2bin($_ENV["VERIFICATION_ENC_KEY"]);
    $verification_iv = hex2bin($_ENV["VERIFICATION_IV"]);

    $token = openssl_encrypt($token, $cipher, $verification_encryptionKey, 0, $verification_iv);

    $token = urlencode($token);

    $body = str_replace("{{VERIFY_LINK}}", "http://localhost/newsLetter/handlers/verifyAccount.php?verify=$token", $body);

    //Server settingsoutput
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = $_ENV["PROVIDER_EMAIL"];                     //SMTP username
    $mail->Password   = $_ENV["PROVIDER_SECRET"];                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom($_ENV["PROVIDER_EMAIL"], 'NewsLetter');
    $mail->addAddress($email, "User");     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Use the link to subscribe to NewsLetter';
    $mail->Body    = $body;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $_SESSION["email_in_queue"] = $email;
    $mail->send();

    header("Location: /newsLetter/wait.php");
    die();
  } catch (Exception $e) {
    if (isset($_SESSION["verification_token"])) {
      unset($_SESSION["verification_token"]);
    }
    if (isset($_SESSION["email_in_queue"])) {
      unset($_SESSION["email_in_queue"]);
    }
    die($e->getMessage());
  }
}
