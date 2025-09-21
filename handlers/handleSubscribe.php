<?php

require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/../db/connect.php";
require_once __DIR__ . "/../utils/checkEmailExists.php";

use Dotenv\Dotenv;

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["email"])) {

  if (empty($dotenv)) {
    $dotenv = Dotenv::createImmutable(__DIR__ . "/../");
    $dotenv->load();
  }

  $email = $_POST["email"];

  if (!preg_match_all("/^[^\s@]+@[^\s@]+\.[^\s@]+$/", $email)) {
    die("Invalid Email");
  }

  if (checkEmailExists($conn, $email)) {
    die("Email Already Exists");
  }

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
    header("Location: /NewsLetter/subscribe.php");
    exit;
  }
}
