<?php
session_start();
require_once __DIR__ .  "/utils/message.php";

if (!isset($_SESSION["registered_email"])) {
  set_message("Invalid Access");
  header("Location: index.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="./assets/css/style.css">
  <title>Newsletter - Profile</title>
</head>

<body class="bg-dark text-light">
  <div id="root" class="d-flex flex-column min-vh-100 positon-relative">

    <?php include_once __DIR__ . "/components/navbar.php"; ?>

    <main class="flex-grow-1 bg-black text-light">
      <section class="container-md py-5" style="max-width: 700px;">
        <h1 class="h3 fw-bold mb-4 text-center">Profile Dashboard</h1>
        <div class="card bg-dark text-light border-secondary shadow rounded-3 mb-4">
          <div class="card-body p-4">
            <h2 class="h5 fw-bold mb-3">Profile Summary</h2>
            <div>
              <label for="f_name" style="white-space: nowrap;">First Name</label>
              <input type="text" id="f_name" class="form-control bg-black text-light border-secondary mt-2" readonly value="<?php echo isset($_SESSION["username"]) ? explode(" ", $_SESSION["username"], 2)[0] : "NOT SET" ?>">
            </div>
            <div class="my-3">
              <label for="l_name" style="white-space: nowrap;">Last Name</label>
              <input type="text" id="l_name" class="form-control bg-black text-light border-secondary mt-2" readonly value="<?php echo isset($_SESSION["username"]) ? explode(" ", $_SESSION["username"], 2)[1] : "NOT SET" ?>">
            </div>
            <div>
              <label for="email" style="white-space: nowrap;">Email Address</label>
              <input type="email" id="email" class="form-control bg-black text-light border-secondary mt-2" readonly value="<?php echo $_SESSION["registered_email"]; ?>">
            </div>
          </div>
        </div>

        <div class="card bg-dark text-light border-secondary shadow rounded-3 mb-4">
          <div class="card-body p-4">
            <h2 class="h5 fw-bold mb-3">Update Name</h2>
            <form method="post" action="./handlers/updateProfile.php">
              <div class="row g-3">
                <div class="col-md-6">
                  <label for="firstName" class="form-label">First Name</label>
                  <input type="text" class="form-control bg-black text-light border-secondary"
                    id="firstName" name="first_name" placeholder="John" autocomplete="off" required>
                </div>
                <div class="col-md-6">
                  <label for="lastName" class="form-label">Last Name</label>
                  <input type="text" class="form-control bg-black text-light border-secondary"
                    id="lastName" name="last_name" placeholder="Doe" autocomplete="off" required>
                </div>
              </div>
              <button type="submit" class="btn btn-primary mt-3">Save Changes</button>
            </form>
          </div>
        </div>

        <div class="card bg-dark text-light border-secondary shadow rounded-3 mb-4">
          <div class="card-body p-4">
            <h2 class="h5 fw-bold mb-3">Update Password</h2>
            <form method="post" action="./handlers/updateProfile.php">
              <div class="mb-3">
                <label for="newPassword" class="form-label">New Password</label>
                <input type="password" class="form-control bg-black text-light border-secondary"
                  id="newPassword" name="new_password" autocomplete="off" required>
              </div>
              <div class="mb-3">
                <label for="confirmPassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control bg-black text-light border-secondary"
                  id="confirmPassword" name="confirm_password" autocomplete="off" required>
              </div>
              <button type="submit" class="btn btn-primary">Update Password</button>
            </form>
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