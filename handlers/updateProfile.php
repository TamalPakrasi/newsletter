<?php

session_start();
require_once __DIR__ . "/../db/connect.php";
require_once __DIR__ . "/../utils/message.php";
require_once __DIR__ . "/../vendor/autoload.php";

use Dotenv\Dotenv;

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_SESSION["registered_email"])) {
  $email = $_SESSION["registered_email"];

  if (isset($_POST["first_name"]) && isset($_POST["last_name"])) {
    $firstName = $_POST["first_name"];
    $lastName = $_POST["last_name"];

    if (empty($firstName) || empty($lastName)) {
      set_message("names cannot be empty");
      header("Location: " . $_SERVER["HTTP_REFERER"]);
      exit;
    }

    $stmt = $conn->prepare("UPDATE `users` SET `first_name`= ?,`last_name`= ? WHERE `email` = ?");

    if (!$stmt) {
      set_message("Something went wrong! try again");
      header("Location: " . $_SERVER["HTTP_REFERER"]);
      exit;
    }

    $stmt->bind_param("sss", $firstName, $lastName, $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->affected_rows > 0) {
      set_message("profile updated successfully");
      $_SESSION["username"] = $firstName . " " . $lastName;
      header("Location: ../index.php");
    } else {
      set_message("Something went wrong! try again");
      header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
    exit;
  }

  if (isset($_POST["new_password"]) && isset($_POST["confirm_password"])) {
    $newPass = $_POST["new_password"];
    $confirmPass = $_POST["confirm_password"];


    if ($newPass !== $confirmPass || empty($newPass)) {
      set_message("Passwords must be same");
      header("Location: " . $_SERVER["HTTP_REFERER"]);
      exit;
    }

    if (empty($dotenv)) {
      $dotenv = Dotenv::createImmutable(__DIR__ . "/../");
      $dotenv->load();
    }

    $cipher = $_ENV["ENC_CIPHER"];
    $pass_encryptionKey = hex2bin($_ENV["PASS_ENC_KEY"]);
    $pass_iv = hex2bin($_ENV["PASS_IV"]);

    $hashedPass = openssl_encrypt($newPass, $cipher, $pass_encryptionKey, 0, $pass_iv);

    $stmt = $conn->prepare("UPDATE `users` SET `password` = ? WHERE `email` = ?");

    if (!$stmt) {
      set_message("Something went wrong! try again");
      header("Location: " . $_SERVER["HTTP_REFERER"]);
      exit;
    }

    $stmt->bind_param("ss", $hashedPass, $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->affected_rows > 0) {
      set_message("profile updated successfully");
      header("Location: ../index.php");
    } else {
      set_message("Something went wrong! try again");
      header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
    exit;
  }
}
