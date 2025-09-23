<?php

function getPass(mysqli $conn, string $email): string|null
{
  $stmt = $conn->prepare("SELECT `password` FROM `users` WHERE `email` = ?");

  if (!$stmt) {
    return null;
  }

  $stmt->bind_param("s", $email);
  $stmt->execute();

  $stmt->bind_result($pass);
  $stmt->fetch();

  return $pass;
}

function getUserName(mysqli $conn, string $email): string|null
{
  $stmt = $conn->prepare("SELECT `first_name`, `last_name` FROM `users` WHERE `email` = ?");

  if (!$stmt) {
    return null;
  }

  $stmt->bind_param("s", $email);
  $stmt->execute();

  $stmt->bind_result($firstName, $lastName);
  $stmt->fetch();

  if (empty($firstName) || empty($lastName)) {
    return "";
  } else {
    return $firstName . " " . $lastName;
  }
}
