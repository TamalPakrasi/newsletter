<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="./assets/css/style.css">
  <title>NewsLetter - Sign In</title>
</head>

<body>
  <div id="root" class="d-flex flex-column min-vh-100 positon-relative">

    <?php include_once __DIR__ . "/components/navbar.php"; ?>

    <main class="flex-grow-1 bg-black text-light d-flex justify-content-center align-items-center">
      <section class="container-md" style="max-width: 500px;">
        <div class="card bg-dark text-light border-secondary shadow rounded-3">
          <div class="card-body p-4">
            <h1 class="h3 fw-bold text-center mb-4">Sign In To NewsLetter</h1>

            <form method="post" class="d-flex flex-column gap-3" id="sign_in_form">
              <div>
                <label for="email" class="form-label">Email address</label>
                <input type="email"
                  class="form-control bg-black text-light border-secondary"
                  id="email"
                  name="email"
                  placeholder="you@example.com">
              </div>

              <div class="d-none by_pass">
                <label for="pass" class="form-label">Password</label>
                <input type="password"
                  class="form-control bg-black text-light border-secondary"
                  id="pass"
                  name="pass"
                  placeholder="*******">
              </div>

              <div class="d-flex justify-content-between align-items-center d-none by_pass">
                <a href="" class="text-decoration-none text-primary">Set New Password</a>
                <button id="sign_in_otp" class="bg-transparent border-0 text-decoration-none text-primary">Sign In using OTP instead</button>
              </div>

              <div class="by_otp">
                <button id="sign_in_pass" class="bg-transparent border-0 text-decoration-none text-primary float-end">Sign In using Password instead</button>
              </div>

              <button id="send_otp" type="submit" class="btn btn-primary w-100 by_otp">Send One-Time-Password To Registered Email</button>

              <button id="email_pass_sign_in" type="submit" class="btn btn-primary w-100 d-none by_pass">Sign In</button>
            </form>

            <p class="text-center mt-4 mb-0">
              Don’t have an account?
              <a href="subscribe.php" class="text-decoration-none text-primary">Sign Up</a>
            </p>
          </div>
        </div>
      </section>
    </main>

    <?php include_once __DIR__ . "/components/footer.php"; ?>
  </div>

  <script src="./assets/js/bootstrap.bundle.min.js"></script>
  <script src="./assets/js/signin.js"></script>
</body>

</html>