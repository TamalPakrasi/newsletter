<?php

require_once __DIR__ . "/../db/connect.php";

$sql = $conn->query("SELECT `id`, `title`, `subtitle` FROM `newsletter`");


$contents = [];
if ($sql->num_rows > 0) {
  while ($row = $sql->fetch_assoc()) {
    $contents[] = $row;
  }
}
