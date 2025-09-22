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
  <title>NewsLetter - Home</title>
</head>

<body class="bg-dark text-light">
  <div id="root" class="d-flex flex-column min-vh-100 positon-relative">

    <?php include_once __DIR__ . "/components/navbar.php"; ?>

    <main class="flex-grow-1 bg-black text-light">

      <?php
      if (!isset($_SESSION["registered_email"])) {
        include __DIR__ . "/components/subscribeForm.php";
      } else {
        echo "<div class='mt-5 text-center fw-bold fs-1'>Welcome Subscriber 😊</div>";
      }
      ?>

      <section class="container-md py-5">
        <h2 class="text-center fw-bold mb-5">What Readers Are Saying</h2>
        <div class="row g-4">
          <div class="col-md-4">
            <figure class="p-4 bg-dark rounded shadow h-100 border border-secondary">
              <blockquote class="blockquote mb-3">
                <p>“Each issue feels like a spark of inspiration in my inbox.”</p>
              </blockquote>
              <figcaption class="blockquote-footer text-light">
                Sarah, Designer
              </figcaption>
            </figure>
          </div>
          <div class="col-md-4">
            <figure class="p-4 bg-dark rounded shadow h-100 border border-secondary">
              <blockquote class="blockquote mb-3">
                <p>“Finally, a newsletter worth reading every week.”</p>
              </blockquote>
              <figcaption class="blockquote-footer text-light">
                James, Developer
              </figcaption>
            </figure>
          </div>
          <div class="col-md-4">
            <figure class="p-4 bg-dark rounded shadow h-100 border border-secondary">
              <blockquote class="blockquote mb-3">
                <p>“It’s like having a mentor send me fresh ideas every Friday.”</p>
              </blockquote>
              <figcaption class="blockquote-footer text-light">
                Aisha, Entrepreneur
              </figcaption>
            </figure>
          </div>
        </div>
      </section>

      <section class="container-md py-5 text-center">
        <div class="p-5 bg-primary text-light rounded-3 shadow">
          <h2 class="fw-bold mb-3">Start Your Journey</h2>
          <p class="mb-4">Join thousands of readers exploring new ideas with DarkLetter.</p>
          <a href="issues.php" class="btn btn-light fs-6 px-5">See Latest Issues</a>
        </div>
      </section>
    </main>

    <?php include_once __DIR__ . "/components/footer.php"; ?>
    <?php get_message(); ?>
  </div>

  <script src="./assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>