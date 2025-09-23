<?php

require_once __DIR__ . "/../db/connect.php";

$conn->set_charset("utf8mb4"); // ensure proper decoding

$sql = $conn->query("SELECT `id`, `title`, `subtitle` FROM `newsletter`");


$contents = [];
if ($sql->num_rows > 0) {
  while ($row = $sql->fetch_assoc()) {
    $contents[] = $row;
  }
}
