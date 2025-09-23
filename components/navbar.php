<?php
if (isset($_SESSION["username"])) {
  $username = $_SESSION["username"];
  list($f_name, $l_name) = explode(" ", $username, 2);
  $initial = $f_name[0] . $l_name[0];

  $bgs = ["success", "primary", "danger", "warning"];
  $color = $bgs[array_rand($bgs)];
}
?>
<nav class="navbar navbar-expand-md navbar-dark bg-black sticky-top border-bottom border-secondary">
  <div class="container">
    <a class="navbar-brand fw-bold" href="index.php">📰 NewsLetter</a>
    <div class="d-flex justify-content-center align-items-center">
      <?php if (!isset($_SESSION["registered_email"])) { ?>
        <a href="subscribe.php" class="btn btn-primary fs-6 d-inline-block d-md-none" role="button">Subscribe</a>
      <?php } else { ?>
        <div class="nav-item dropdown d-inline-block d-md-none">
          <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="profileDropdown"
            role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?php if (!isset($initial)) { ?>
              <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRU0a0iDtUPUzs0GFM6DSuovK0uOE4-Sc40Pg&s" alt="Profile"
                class="rounded-circle me-2" width="32" height="32">
            <?php } else { ?>
              <div class="bg-<?php echo $color; ?> rounded-circle p-2 d-flex justify-content-center align-items-center text-light fw-semibold" style="height: 2rem; width: 2rem"><?php echo htmlspecialchars(strtoupper($initial)); ?></div>
            <?php } ?>
          </a>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark shadow" aria-labelledby="profileDropdown">
            <li><a class="dropdown-item" href="dashboard.php">Dashboard</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item text-danger fw-semibold" href="./handlers/signoutHandler.php">Sign Out</a></li>
          </ul>
        </div>
      <?php } ?>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu"
        aria-controls="navMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
    <div class="collapse navbar-collapse" id="navMenu">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="issues.php">Issues</a></li>
        <?php if (!isset($_SESSION["registered_email"])) { ?>
          <li class="nav-item"><a class="nav-link" href="signin.php">Sign In</a></li>
          <li class="nav-item ms-2">
            <a href="subscribe.php" role="button" class="btn btn-primary fs-6 d-none d-md-block">Subscribe</a>
          </li>
        <?php } else { ?>
          <li class="nav-item dropdown d-none d-md-block">
            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="profileDropdown"
              role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <?php if (!isset($initial)) { ?>
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRU0a0iDtUPUzs0GFM6DSuovK0uOE4-Sc40Pg&s" alt="Profile"
                  class="rounded-circle me-2" width="32" height="32">
              <?php } else { ?>
                <div class="bg-<?php echo $color; ?> rounded-circle p-2 d-flex justify-content-center align-items-center text-light fw-semibold" style="height: 2rem; width: 2rem"><?php echo htmlspecialchars(strtoupper($initial)); ?></div>
              <?php } ?>
            </a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark shadow" aria-labelledby="profileDropdown">
              <li><a class="dropdown-item" href="dashboard.php">Dashboard</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item text-danger fw-semibold" href="./handlers/signoutHandler.php">Sign Out</a></li>
            </ul>
          </li>
        <?php } ?>
    </div>
  </div>
</nav>