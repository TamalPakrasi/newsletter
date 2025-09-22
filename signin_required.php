<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="./assets/css/style.css">
  <title>Newsletter - signin Required</title>
</head>

<body class="bg-dark text-light">
  <div id="root" class="d-flex flex-column min-vh-100 positon-relative">

    <?php include_once __DIR__ . "/components/navbar.php"; ?>

    <main class="flex-grow-1 bg-black text-light d-flex align-items-center">
      <section class="container-md py-5 text-center" style="max-width: 600px;">
        <div class="card bg-dark text-light border-secondary shadow rounded-3">
          <div class="card-body p-5">
            <h1 class="h3 fw-bold mb-3">Sign In Required</h1>
            <p class="mb-4">
              You must be a signed in subscriber to access this content.
              Please sign in to continue.
            </p>

            <a href="signin.php" class="btn btn-primary btn-lg px-5">Sign In</a>
            <p class="mt-4 mb-0 text-secondary small">
              Haven't subscribed yet? <a href="subscribe.php" class="text-decoration-none text-primary">Subscribe</a>
            </p>
          </div>
        </div>
      </section>
    </main>

    <?php include_once __DIR__ . "/components/footer.php"; ?>
  </div>

  <script src="./assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>