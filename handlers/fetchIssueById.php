<?php

require_once __DIR__ . "/../db/connect.php";

$conn->set_charset("utf8mb4"); // ensure proper decoding

if (isset($_GET["id"])) {
  $searchId = $_GET["id"];

  $stmt = $conn->prepare("SELECT * FROM `newsletter` WHERE `id` = ?");
  if (empty($stmt)) {
    die("Something wrong");
  }

  $stmt->bind_param("s", $searchId);
  $stmt->execute();
  $res = $stmt->get_result();

  if ($res->num_rows > 0) {
    $data = $res->fetch_assoc();
    $json = $data["content"];

    // debug if needed
    // var_dump($json, json_last_error_msg());

    $contents = json_decode($json, true);

    // fallback if escaped
    if ($contents === null) {
      $contents = json_decode(stripslashes($json), true);
    }
  }
}
