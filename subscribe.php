<?php
session_start();
require_once __DIR__ . "/utils/message.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="./assets/css/style.css">
  <title>NewsLetter - Subscribe</title>
</head>

<body>
  <div id="root" class="d-flex flex-column min-vh-100 bg-black">

    <?php include_once __DIR__ . "/components/navbar.php"; ?>

    <main class="flex-grow-1 bg-black text-light">
      <section class="container-md py-5 text-center">
        <p class="lead fw-semibold">Sign Up for</p>
        <h2 class="display-6 fw-bold mb-5">NewsLetter</h2>
        <h1 class="display-3 fw-bold pt-3 mb-3">Stay Curious. Stay Inspired.</h1>
        <p class="lead mb-4">Your weekly dose of insights, stories, and ideas delivered straight to your inbox.</p>
        <form action="./handlers/handleSubscribe.php" method="post" class="d-flex flex-column flex-sm-row justify-content-center gap-2 mx-auto">
          <input type="email" name="email" class="form-control form-control-lg bg-dark text-light border-light"
            placeholder="Enter your email" autocomplete="off">
          <button type="submit" class="btn btn-primary btn-lg px-4">Subscribe</button>
        </form>
      </section>
    </main>

    <?php include_once __DIR__ . "/components/footer.php"; ?>
    <?php get_message(); ?>
  </div>

  <script src="./assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>