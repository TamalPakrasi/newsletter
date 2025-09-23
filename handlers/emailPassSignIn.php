<?php

session_start();
require_once __DIR__ . "/../db/connect.php";
require_once __DIR__ . "/../utils/checkEmailExists.php";
require_once __DIR__ . "/../utils/message.php";
require_once __DIR__ . "/../utils/getPass.php";
require_once __DIR__ . "/../vendor/autoload.php";

use Dotenv\Dotenv;

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["email"]) && isset($_POST["pass"])) {
  try {
    $email = $_POST["email"];
    $pass = $_POST["pass"];

    if (!preg_match_all("/^[^\s@]+@[^\s@]+\.[^\s@]+$/", $email) || empty($pass)) {
      throw new Exception("Email and Password must not be empty");
    }

    if (!checkEmailExists($conn, $email)) {
      throw new Exception("You must subscribe before trying to sign in");
    }

    if (empty($dotenv)) {
      $dotenv = Dotenv::createImmutable(__DIR__ . "/../");
      $dotenv->load();
    }

    $savedPass = getPass($conn, $email);
    if (empty($savedPass)) {
      throw new Exception("Something went wrong");
    }

    $cipher = $_ENV["ENC_CIPHER"];
    $pass_encryptionKey = hex2bin($_ENV["PASS_ENC_KEY"]);
    $pass_iv = hex2bin($_ENV["PASS_IV"]);

    $decrypted = openssl_decrypt($savedPass, $cipher, $pass_encryptionKey, 0, $pass_iv);

    if (!hash_equals($decrypted, $pass)) {
      throw new Exception("Invalid Password");
    }

    $username = getUserName($conn, $email);

    session_regenerate_id(true);
    $_SESSION["registered_email"] = $email;
    if (!empty($username)) {
      $_SESSION["username"] = $username;
    }

    header("Location: ../index.php");
    exit;
  } catch (Exception $e) {
    set_message($e->getMessage());
    header("Location: " . $_SERVER["HTTP_REFERER"]);
    exit;
  }
}
