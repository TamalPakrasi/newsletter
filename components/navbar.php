<?php
function isActive(string $url): string
{
  $base = "/NewsLetter";
  $currUrl = rtrim(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH), "/");
  if ($url === "/index.php") {
    $url = "";
    $currUrl = rtrim($currUrl, "/index.php");
  }
  return $currUrl === $base . $url ? " active" : "";
}
?>
<nav class="navbar navbar-expand-md navbar-dark bg-black sticky-top border-bottom border-secondary">
  <div class="container">
    <a class="navbar-brand fw-bold" href="index.php">📰 NewsLetter</a>
    <div>
      <a href="subscribe.php" class="btn btn-primary fs-6 d-inline-block d-md-none" role="button">Subscribe</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu"
        aria-controls="navMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
    <div class="collapse navbar-collapse" id="navMenu">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link<?php echo isActive("/index.php"); ?>" href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link<?php echo isActive("/issues.php"); ?>" href="issues.php">Issues</a></li>
        <li class="nav-item"><a class="nav-link<?php echo isActive("/signin.php"); ?>" href="signin.php">Sign In</a></li>
        <li class="nav-item ms-2">
          <a href="subscribe.php" role="button" class="btn btn-primary fs-6 d-none d-md-block">Subscribe</a>
        </li>
    </div>
  </div>
</nav>