<?php
session_start();
require_once __DIR__ . "/utils/message.php";
require_once __DIR__ . "/handlers/fetchIssues.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="./assets/css/style.css">
  <title>NewsLetter - Issues</title>
</head>

<body>
  <div id="root" class="d-flex flex-column min-vh-100 position-relative">
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
        <h2 class="fw-bold text-center mb-5">Latest Issues</h2>
        <div class="row g-4">
          <?php
          $hasContent = false;
          foreach ($contents as $ind => $content) :
            $hasContent = true;
          ?>
            <div class="col-md-4">
              <div class="card bg-dark text-light border-secondary h-100">
                <div class="card-body">
                  <h5 class="card-title fw-bold">Issue #<?php echo $ind + 1; ?>: <?php echo htmlspecialchars($content["title"]); ?></h5>
                  <p class="card-text"><?php echo htmlspecialchars($content["subtitle"]); ?></p>
                  <a href="<?php echo "issue.php?id=" . htmlspecialchars($content["id"]); ?>" class="stretched-link text-primary">Read More</a>
                </div>
              </div>
            </div>
          <?php endforeach; ?>

          <?php if (!$hasContent) : ?>
            <div class="col-12 text-center fw-bold fs-5">
              No Issues
            </div>
          <?php endif; ?>
        </div>
      </section>

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
    </main>

    <?php include_once __DIR__ . "/components/footer.php"; ?>
    <?php get_message(); ?>
  </div>

  <script src="./assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>