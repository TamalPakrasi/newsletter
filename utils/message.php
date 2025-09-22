<?php

function set_message($msg): void
{
  if (isset($_SESSION["msg"])) unset($_SESSION["msg"]);
  $_SESSION["msg"] = $msg;
}

function get_message(): void
{
  if (isset($_SESSION["msg"])) {
    $msg = $_SESSION["msg"];
    unset($_SESSION["msg"]);
    echo "<div id='alert_message'><div>"
      . $msg .
      "</div></div>";
  }
}
