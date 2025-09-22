<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
  <title>Newsletter - Verify Email</title>
</head>

<body class="bg-dark text-light">
  <div id="root" class="d-flex flex-column min-vh-100 positon-relative">

    <main class="flex-grow-1 bg-black text-light d-flex align-items-center">
      <section class="container-md py-5" style="max-width: 600px;">
        <div class="card bg-dark text-light border-secondary shadow rounded-3">
          <div class="card-body p-5 text-center">
            <h1 class="h3 fw-bold mb-3">Check Your Inbox</h1>
            <p class="mb-4">
              We’ve sent you a verification link to <?php echo $_SESSION["email_in_queue"]; ?>.
              Please verify your email to activate your account.
            </p>

            <p class="mt-4 mb-0">
              Didn’t receive the email?
              <a href="#" class="text-decoration-none text-primary">Resend verification link</a>
            </p>
          </div>
        </div>
      </section>
    </main>
  </div>
</body>

</html>