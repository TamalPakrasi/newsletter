<?php

session_start();

require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/../db/connect.php";
require_once __DIR__ . "/../utils/message.php";

use Dotenv\Dotenv;

if (isset($_SESSION["email_in_queue"]) && isset($_SESSION["verification_token"]) && isset($_GET["verify"])) {
  if (empty($dotenv)) {
    $dotenv = Dotenv::createImmutable(__DIR__ . "/../");
    $dotenv->load();
  }

  $cipher = $_ENV["ENC_CIPHER"];
  $verification_encryptionKey = hex2bin($_ENV["VERIFICATION_ENC_KEY"]);
  $verification_iv = hex2bin($_ENV["VERIFICATION_IV"]);

  $verification_token = $_SESSION["verification_token"];

  $verify = $_GET["verify"];

  $link_token = openssl_decrypt($verify, $cipher, $verification_encryptionKey, 0, $verification_iv);

  if (!hash_equals($verification_token, $link_token)) {
    die("Invalid Link");
  }

  $email = $_SESSION["email_in_queue"];

  $pass_encryptionKey = hex2bin($_ENV["PASS_ENC_KEY"]);
  $pass_iv = hex2bin($_ENV["PASS_IV"]);

  $randomPass = bin2hex(random_bytes(32));
  $encPass = openssl_encrypt($randomPass, $cipher, $pass_encryptionKey, 0, $pass_iv);

  $stmt = $conn->prepare("INSERT INTO `users` (`email`, `password`) VALUES (?, ?)");

  if (!$stmt) {
    set_message("Something went wrong, Try Again!");
    header("Location: /NewsLetter/subscribe.php");
    die();
  }

  $stmt->bind_param("ss", $email, $encPass);
  $stmt->execute();
  $stmt->store_result();

  if ($stmt->affected_rows === 0) {
    set_message("Something went wrong, Try Again!");
    header("Location: /NewsLetter/subscribe.php");
  } else {
    session_regenerate_id(true);
    unset($_SESSION["email_in_queue"]);
    unset($_SESSION["verification_token"]);
    $_SESSION["registered_email"] = $email;
    set_message("Subscribed and Signed in successfully");
    header("Location: /NewsLetter/index.php");
  }
  exit;
}
