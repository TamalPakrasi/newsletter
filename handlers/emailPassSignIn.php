<?php

session_start();
date_default_timezone_set("Asia/Kolkata");

require_once __DIR__ . "/../db/connect.php";
require_once __DIR__ . "/../utils/checkEmailExists.php";
require_once __DIR__ . "/../utils/message.php";
require_once __DIR__ . "/../utils/getPass.php";
require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/../utils/sendSuccessMail.php";

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

    $body = file_get_contents(__DIR__ . "/../assets/mail_templates/signin.template.html");

    $body = str_replace("{{LOGIN_TIME}}", date("h:i:s A"), $body);
    $body = str_replace("{{IP_ADDRESS}}", $_SERVER["REMOTE_ADDR"], $body);

    sendSuccessMail("Signed in successfully", $body, $email);

    $username = getUserName($conn, $email);

    session_regenerate_id(true);
    $_SESSION["registered_email"] = $email;
    if (!empty($username)) {
      $_SESSION["username"] = $username;
    }

    header("Location: ../index.php");
    exit;
  } catch (Exception $e) {
    if (isset($_SESSION["registered_email"])) {
      unset($_SESSION["registered_email"]);
    }

    if (isset($_SESSION["username"])) {
      unset($_SESSION["username"]);
    }
    set_message($e->getMessage());
    header("Location: " . $_SERVER["HTTP_REFERER"]);
    exit;
  }
}
