<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="./assets/css/otp.css">
  <title>Newsletter - Enter OTP</title>
</head>

<body class="bg-dark text-light">
  <div id="root" class="d-flex flex-column min-vh-100 positon-relative">

    <main class="flex-grow-1 bg-black text-light d-flex align-items-center">
      <section class="container-md py-5" style="max-width: 500px;">
        <div class="card bg-dark text-light border-secondary shadow rounded-3">
          <div class="card-body p-4 text-center">
            <h1 class="h4 fw-bold mb-3">Verify Your Account</h1>
            <p class="mb-4">
              Please enter the 6-digit OTP sent to your email.
            </p>

            <form method="post" action="./handlers/verifyOTP.php">
              <div class="d-flex justify-content-center gap-2">
                <input type="text" maxlength="1" class="form-control bg-black text-light border-secondary otp-input" required>
                <input type="text" maxlength="1" class="form-control bg-black text-light border-secondary otp-input" required>
                <input type="text" maxlength="1" class="form-control bg-black text-light border-secondary otp-input" required>
                <input type="text" maxlength="1" class="form-control bg-black text-light border-secondary otp-input" required>
                <input type="text" maxlength="1" class="form-control bg-black text-light border-secondary otp-input" required>
                <input type="text" maxlength="1" class="form-control bg-black text-light border-secondary otp-input" required>
                <input type="hidden" name="otp" id="otp" maxlength="6">
              </div>

              <button type="submit" class="btn btn-primary w-100 mt-4">Verify</button>
            </form>

            <form class="mt-4 mb-0" action="./handlers/sendOTPEmail.php" method="POST">
              Didn’t get the code?
              <input type="hidden" name="email" value="<?php echo $_SESSION["email_in_queue"]; ?>">
              <button type="submit" class="text-decoration-none text-primary bg-transparent border-0">
                Resend OTP
              </button>
            </form>
          </div>
        </div>
      </section>
    </main>
  </div>

  <script src="./assets/js/bootstrap.bundle.min.js"></script>
  <script src="./assets/js/otp.js"></script>
</body>

</html>