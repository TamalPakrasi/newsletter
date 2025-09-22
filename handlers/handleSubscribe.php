<?php

session_start();
require_once __DIR__ . "/../db/connect.php";
require_once __DIR__ . "/../utils/checkEmailExists.php";
require_once __DIR__ . "/../utils/sendSubscribeMail.php";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["email"])) {
  $email = $_POST["email"];

  if (!preg_match_all("/^[^\s@]+@[^\s@]+\.[^\s@]+$/", $email)) {
    die("Invalid Email");
  }

  if (checkEmailExists($conn, $email)) {
    die("Email Already Exists");
  }

  sendSubscibeMail($email);
}
