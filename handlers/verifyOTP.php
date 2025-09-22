<?php

session_start();

require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/../utils/message.php";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_SESSION["email_in_queue"]) && isset($_SESSION["otp"]) && isset($_POST["otp"])) {
  $savedOTP = (int) $_SESSION["otp"];
  $otp = (int) $_POST["otp"];

  if ($savedOTP !== $otp) {
    set_message("Invalid OTP");
    header("Location: ../signin.php");
    exit;
  }

  $email = $_SESSION["email_in_queue"];
  unset($_SESSION["email_in_queue"]);

  session_regenerate_id(true);
  $_SESSION["registered_email"] = $email;
  set_message("Signed In Successfully");
  header("Location: ../index.php");
  exit;
}
