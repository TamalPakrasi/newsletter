<?php

session_start();
require_once __DIR__ . "/../db/connect.php";
require_once __DIR__ . "/../utils/checkEmailExists.php";
require_once __DIR__ . "/../utils/sendSubscribeMail.php";
require_once __DIR__ . "/../utils/message.php";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["email"])) {
  $email = $_POST["email"];

  if (!preg_match_all("/^[^\s@]+@[^\s@]+\.[^\s@]+$/", $email)) {
    set_message("Invalid Email");
    header("Location: " . $_SERVER["HTTP_REFERER"]);
    die();
  }

  if (checkEmailExists($conn, $email)) {
    set_message("Email Already Exists");
    header("Location: " . $_SERVER["HTTP_REFERER"]);
    die();
  }

  sendSubscibeMail($email);
} elseif ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_SESSION["email_in_queue"])) {
  $email = $_SESSION["email_in_queue"];
  sendSubscibeMail($email);
}
