<?php

require_once __DIR__ . "/../db/connect.php";

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
    while ($row = $res->fetch_assoc()) {
      $data = $row;
    }
  }
  $contents = json_decode($data["content"], true);
}
