<?php

session_start();

require_once __DIR__ . "/../db/connect.php";
require_once __DIR__ . "/../utils/message.php";
require_once __DIR__ . "/../utils/getPass.php";
require_once __DIR__ . "/../vendor/autoload.php";

use Dotenv\Dotenv;

if (empty($dotenv)) {
  $dotenv = Dotenv::createImmutable(__DIR__ . "/../");
  $dotenv->load();
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_SESSION["email_in_queue"]) && isset($_COOKIE["one-time-password"]) && isset($_POST["otp"])) {
  $cipher = $_ENV["ENC_CIPHER"];
  $otp_encryptionKey = hex2bin($_ENV["OTP_ENC_KEY"]);
  $otp_iv = hex2bin($_ENV["OTP_IV"]);

  $otpStr = $_COOKIE["one-time-password"];
  $savedOTP = openssl_decrypt($otpStr, $cipher, $otp_encryptionKey, 0, $otp_iv);

  $otp = (string) $_POST["otp"];

  if (!hash_equals($savedOTP, $otp)) {
    set_message("Invalid OTP");
    header("Location: ../signin.php");
    exit;
  }
  setcookie("one-time-password", "", time() - 3600, "/");

  $email = $_SESSION["email_in_queue"];

  $username = getUserName($conn, $email);

  unset($_SESSION["email_in_queue"]);

  session_regenerate_id(true);
  $_SESSION["registered_email"] = $email;
  if (!empty($username)) {
    $_SESSION["username"] = $username;
  }
  set_message("Signed In Successfully");
  header("Location: ../index.php");
  exit;
}
