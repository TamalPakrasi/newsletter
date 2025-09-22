<?php
session_start();
if (!isset($_SESSION["registered_email"])) {
  session_regenerate_id(true);
  header("Location: /newsLetter/signin_required.php");
  exit;
}
?>

<?php require_once __DIR__ . "/handlers/fetchIssueById.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
  <title>NewsLetter - <?php echo htmlspecialchars($data["title"]); ?></title>
</head>

<body>
  <div id="root" class="d-flex flex-column min-vh-100 position-relative">
    <nav class="navbar navbar-dark bg-black sticky-top border-bottom border-secondary">
      <div class="container-md d-flex justify-content-between align-items-center">
        <a class="navbar-brand fw-bold" href="index.php">📰 NewsLetter</a>
        <a class="navbar-brand" href="issues.php">Back</a>
      </div>
    </nav>

    <main class="flex-grow-1 bg-black text-light">
      <section class="container-md py-5">
        <h1 class="display-4 fw-bold mb-3"><?php echo htmlspecialchars($data["title"]); ?></h1>
        <h4 class="text-white-50 mb-4"><?php echo htmlspecialchars($data["subtitle"]); ?></h4>

        <div class="mb-4 text-white-50 small">
          <span>By <strong><?php echo htmlspecialchars($data["author"]); ?></strong></span> ·
          <span><?php echo htmlspecialchars($data["publish_date"]); ?></span>
        </div>

        <article class="fs-5 lh-lg">
          <?php foreach ($contents as $content) : ?>
            <p>
              <?php echo htmlspecialchars($content); ?>
            </p>
          <?php endforeach; ?>
        </article>
      </section>
    </main>

    <?php include_once __DIR__ . "/components/footer.php"; ?>
  </div>
</body>

</html>