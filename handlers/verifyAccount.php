<?php

session_start();

require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/../db/connect.php";

use Dotenv\Dotenv;

if (isset($_SESSION["email_in_queue"])) {

  if (empty($dotenv)) {
    $dotenv = Dotenv::createImmutable(__DIR__ . "/../");
    $dotenv->load();
  }

  $email = $_SESSION["email_in_queue"];

  $cipher = $_ENV["ENC_CIPHER"];
  $encryptionKey = hex2bin($_ENV["ENC_KEY"]);
  $iv = hex2bin($_ENV["IV"]);

  $randomPass = bin2hex(random_bytes(32));
  $encPass = openssl_encrypt($randomPass, $cipher, $encryptionKey, 0, $iv);

  $stmt = $conn->prepare("INSERT INTO `users` (`email`, `password`) VALUES (?, ?)");

  if (!$stmt) {
    die("Something went wrong, Try Again!");
  }

  $stmt->bind_param("ss", $email, $encPass);
  $stmt->execute();
  $stmt->store_result();

  if ($stmt->affected_rows === 0) {
    die("Something went wrong, Try Again!");
  } else {
    session_regenerate_id(true);
    unset($_SESSION["email_in_queue"]);
    $_SESSION["registered_email"] = $email;
    header("Location: /NewsLetter/index.php");
    exit;
  }
}
