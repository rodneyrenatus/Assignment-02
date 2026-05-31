<?php
session_start();

$site_name    = "Cacti-Succulent Kuching";
$current_year = 2026;
$error        = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $input_user = trim($_POST["username"] ?? "");
    $input_pass = trim($_POST["password"] ?? "");

    if (empty($input_user) || empty($input_pass)) {
        $error = "Please enter both username and password.";
    } else {
        $conn = mysqli_connect("localhost", "root", "", "cacti_succulent");

        if (!$conn) {
            $error = "Database connection failed. Please try again later.";
        } else {
            $sql    = "SELECT * FROM `user` WHERE username = '$input_user' AND password = '$input_pass'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) === 1) {
                $row = mysqli_fetch_assoc($result);
                $_SESSION['role']     = $row['role'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['name']     = $row['fname'] . ' ' . $row['lname'];
                mysqli_close($conn);
                header("Location: " . ($row['role'] === 'admin' ? "dashboard.php" : "index.php"));
                exit;
            }

            $error = "Invalid username or password. Please try again.";
            mysqli_close($conn);
        }
    }
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
      <?php if (isset($_SESSION['role'])): ?>
        <a href="logout.php" class="active">Logout</a>
      <?php else: ?>
        <a href="login.php" class="active">Login</a>
      <?php endif; ?>
      <a href="enquiry.php">Enquiry</a>
      <a href="members.php">Members</a>
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

        <h1>Member Login</h1>
        <p class="subtitle">Sign in to your <?php echo $site_name; ?> account.</p>

        <?php if ($error != ""): ?>
          <div style="background:#fff0f0;border:2px solid #c0392b;border-radius:6px;padding:0.8rem 1rem;margin-bottom:1rem;">
            <p style="color:#c0392b;margin:0;"><?php echo $error; ?></p>
          </div>
        <?php endif; ?>

        <form action="login.php" method="post">
          <fieldset>
            <legend>Login Credentials</legend>
            <div class="form-group">
              <label for="username">Username</label>
              <input type="text" id="username" name="username"
                     placeholder="Enter username" maxlength="50"
                     autocomplete="username" required>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" id="password" name="password"
                     placeholder="Enter password" maxlength="50"
                     autocomplete="current-password" required>
            </div>
          </fieldset>
          <button type="submit" class="btn-submit login-btn">Sign In</button>
        </form>

        <p class="login-switch">New here? <a href="registration.php">Create an account</a></p>

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