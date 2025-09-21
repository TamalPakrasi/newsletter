<?php

function checkEmailExists(mysqli $conn, string $email): bool
{
  $stmt = $conn->prepare("SELECT `email` from `users` WHERE `email` = ?");

  if (!$stmt) {
    die("Something went wrong");
  }

  $stmt->bind_param("s", $email);
  $stmt->execute();
  $stmt->store_result();

  return $stmt->num_rows > 0;
}
