<?php
$site_name = "Cacti-Succulent Kuching";
$current_year = 2026;

$submitted = false;
$username  = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $submitted = true;
    $username  = htmlspecialchars($_POST["username"]);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Login to your Cacti-Succulent Kuching account.">
  <meta name="keywords" content="login, member, cacti kuching">
  <meta name="author" content="Cacti-Succulent Kuching Team">
  <title>Login | <?php echo $site_name; ?></title>
  <link rel="stylesheet" href="styles/style.css">
</head>
<body>

  <header>
    <div class="logo-area">
      <a href="index.php">
        <img src="images/cacti succulent 2.png" alt="Cacti Succulent Kuching Logo">
      </a>
    </div>
    <nav>
      <div class="dropdown">
        <a href="product1.php" class="dropbtn">Products ▾</a>
        <div class="dropdown-content">
          <a href="product1.php">🌵 Cacti</a>
          <a href="product2.php">🌱 Succulents</a>
          <a href="product3.php">🪴 Pots &amp; Planters</a>
          <a href="product4.php">🧰 Accessories</a>
        </div>
      </div>
      <a href="order.php">Order</a>
      <a href="registration.php">Register</a>
      <a href="login.php" class="active">Login</a>
      <a href="enquiry.php">Enquiry</a>
      <a href="members.php">Members</a>
      <a href="dashboard.php">Dashboard</a>
    </nav>
  </header>

  <div class="login-wrap">
    <div class="login-card">

      <div class="login-hero">
        <div class="login-icon">🪴</div>
        <h2>Welcome Back,<br><em>Plant Lover!</em></h2>
        <p>Your little green companions are waiting. Sign in to browse our curated
           succulents and book a care consultation at Medan Satok.</p>
        <p>
          Don't have an account yet?<br>
          <a href="registration.php">Register here →</a>
        </p>
      </div>

      <div class="login-form-side">

        <?php if ($submitted): ?>

          <div class="success-box">
            <h2>Hello, <?php echo $username; ?>!</h2>
            <p>You have successfully signed in to <?php echo $site_name; ?>.</p>
            <a href="index.php" class="btn-submit" style="display:inline-block;margin-top:1rem;">Go to Home</a>
          </div>

        <?php else: ?>

          <h1>Member Login</h1>
          <p class="subtitle">Sign in to your <?php echo $site_name; ?> account.</p>

          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <fieldset>
              <legend>Login Credentials</legend>
              <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username"
                       placeholder="Enter username" maxlength="10"
                       pattern="[a-zA-Z]+" title="Alphabetical only, max 10"
                       autocomplete="username" required>
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password"
                       placeholder="Enter password" maxlength="25"
                       pattern="[a-zA-Z]+" title="Alphabetical only, max 25"
                       autocomplete="current-password" required>
              </div>
            </fieldset>
            <a href="#" class="forgot">Forgot password?</a>
            <button type="submit" class="btn-submit login-btn">Sign In</button>
          </form>

          <div class="divider">or continue with</div>
          <div class="social-row">
            <button class="btn-social"><span class="brand-dot brand-google"></span> Google</button>
            <button class="btn-social"><span class="brand-dot brand-microsoft"></span> Microsoft</button>
          </div>
          <p class="login-switch">New here? <a href="registration.php">Create an account</a></p>

        <?php endif; ?>

      </div>

    </div>
  </div>

  <footer>
    <div class="footer-inner">
      <div class="footer-col">
        <h4><?php echo $site_name; ?></h4>
        <p>Medan Satok Market, Kuching, Sarawak<br>Open every weekend</p>
        <p><a href="mailto:yourstudentID@student.swinburne.edu.my">&#9993; Email Support</a></p>
        <a href="https://www.youtube.com/watch?v=C0bQQmIXoFA" class="yt-link" target="_blank" rel="noopener">&#9654; YouTube Channel</a>
      </div>
      <div class="footer-col">
        <h4>Explore</h4>
        <ul>
          <li><a href="product1.php">🌵 Cacti</a></li>
          <li><a href="product2.php">🌱 Succulents</a></li>
          <li><a href="product3.php">🪴 Pots &amp; Planters</a></li>
          <li><a href="product4.php">🧰 Accessories</a></li>
          <li><a href="order.php">Order</a></li>
          <li><a href="enquiry.php">Enquiry</a></li>
          <li><a href="enhancements.php">Enhancements</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h4>Our Team</h4>
        <ul>
          <li><a href="member1.php">Mohd Amirunhisyam</a></li>
          <li><a href="member2.php">Maduwa Guruge Savindu Helitha Jayasinghe</a></li>
          <li><a href="member3.php">Aavash Sherchan</a></li>
          <li><a href="member4.php">Rodney Renatus Mushi</a></li>
        </ul>
      </div>
    </div>
    <div class="footer-bottom">
      <p>&copy; <?php echo $current_year; ?> <?php echo $site_name; ?>. All Rights Reserved.</p>
    </div>
  </footer>

</body>
</html>
