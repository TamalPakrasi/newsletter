<?php

session_start();
require_once __DIR__ . "/../utils/message.php";

if (isset($_SESSION["registered_email"])) {
  session_unset();
  session_destroy();
  session_start();
  set_message("Signed out successfully");

  header("Location: ../index.php");
  die();
}
