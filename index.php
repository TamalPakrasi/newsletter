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
      <section class="container-md py-5 text-center">
        <h1 class="display-3 fw-bold mb-3">Stay Curious. Stay Inspired.</h1>
        <p class="lead mb-4">Your weekly dose of insights, stories, and ideas delivered straight to your inbox.</p>
        <form action="./handlers/handleSubscribe.php" method="post" class="d-flex flex-column flex-sm-row justify-content-center gap-2 mx-auto">
          <input type="email" name="email" class="form-control form-control-lg bg-dark text-light border-light"
            placeholder="Enter your email">
          <button type="submit" class="btn btn-primary btn-lg px-4">Subscribe</button>
        </form>
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

      <section class="container-md py-5 text-center">
        <div class="p-5 bg-primary text-light rounded-3 shadow">
          <h2 class="fw-bold mb-3">Start Your Journey</h2>
          <p class="mb-4">Join thousands of readers exploring new ideas with DarkLetter.</p>
          <a href="issues.php" class="btn btn-light fs-6 px-5">See Latest Issues</a>
        </div>
      </section>
    </main>

    <?php include_once __DIR__ . "/components/footer.php"; ?>
  </div>

  <script src="./assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>