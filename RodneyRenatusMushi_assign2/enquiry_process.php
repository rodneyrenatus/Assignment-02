<?php
session_start();
$site_name    = "Cacti-Succulent Kuching";
$current_year = 2026;

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: enquiry.php");
    exit;
}

$errors = [];

$fname        = htmlspecialchars(trim($_POST["fname"]          ?? ""));
$lname        = htmlspecialchars(trim($_POST["lname"]          ?? ""));
$email        = htmlspecialchars(trim($_POST["user-email"]     ?? ""));
$phone        = htmlspecialchars(trim($_POST["phone"]          ?? ""));
$enquiry_type = htmlspecialchars(trim($_POST["enquiry-type"]   ?? ""));
$comments     = htmlspecialchars(trim($_POST["comments"]       ?? ""));

if (empty($fname) || !preg_match('/^[a-zA-Z]+$/', $fname)) {
    $errors[] = "First name is required and must contain letters only (max 25 characters).";
}
if (empty($lname) || !preg_match('/^[a-zA-Z]+$/', $lname)) {
    $errors[] = "Last name is required and must contain letters only (max 25 characters).";
}
if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "A valid email address is required.";
}
if (empty($phone) || !preg_match('/^[0-9]{8,10}$/', $phone)) {
    $errors[] = "Phone number is required and must be 8 to 10 digits.";
}
if (empty($enquiry_type)) {
    $errors[] = "Please select an enquiry topic.";
}

if (empty($errors)) {
    $servername = "localhost";
    $username   = "root";
    $password   = "";
    $dbname     = "cacti_succulent";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        $errors[] = "Connection failed: " . mysqli_connect_error();
    } else {
        $sql = "INSERT INTO enquiry(fname, lname, email, phone, enquiry_type, comments)
                VALUES ('$fname', '$lname', '$email', '$phone', '$enquiry_type', '$comments')";

        if (!mysqli_query($conn, $sql)) {
            $errors[] = "Error saving enquiry: " . mysqli_error($conn);
        }
        mysqli_close($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Enquiry confirmation for Cacti-Succulent Kuching.">
  <title>Enquiry Confirmation | <?php echo $site_name; ?></title>
  <link rel="stylesheet" href="styles/style.css">
</head>
<body>

  <div id="top"></div>

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
      <?php if (isset($_SESSION['role'])): ?><a href="logout.php">Logout</a><?php else: ?><a href="login.php">Login</a><?php endif; ?>
      <a href="enquiry.php" class="active">Enquiry</a>
      <a href="members.php">Members</a>
      <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?><a href="dashboard.php">Dashboard</a><?php endif; ?>
    </nav>
  </header>

  <main>

    <div class="page-hero">
      <h1><?php echo empty($errors) ? "Enquiry Received!" : "Submission Error"; ?></h1>
    </div>

    <div class="form-page-wrap">

      <?php if (!empty($errors)): ?>

        <div style="background:#fff0f0;border:2px solid #c0392b;border-radius:8px;padding:1.5rem;max-width:600px;margin:2rem auto;">
          <h2 style="color:#c0392b;margin-top:0;">Please fix the following errors:</h2>
          <ul style="color:#c0392b;">
            <?php foreach ($errors as $err): ?>
              <li><?php echo $err; ?></li>
            <?php endforeach; ?>
          </ul>
          <a href="enquiry.php" class="btn-submit" style="display:inline-block;margin-top:1rem;">Go Back to Form</a>
        </div>

      <?php else: ?>

        <div class="success-box">
          <h2>Thank you, <?php echo $fname . " " . $lname; ?>!</h2>
          <p>Your enquiry has been successfully saved to our database. We will get back to you shortly.</p>
          <table class="confirm-table">
            <tr><th>Name</th><td><?php echo $fname . " " . $lname; ?></td></tr>
            <tr><th>Email</th><td><?php echo $email; ?></td></tr>
            <tr><th>Phone</th><td><?php echo $phone; ?></td></tr>
            <tr><th>Topic</th><td><?php echo $enquiry_type; ?></td></tr>
            <?php if ($comments != ""): ?>
            <tr><th>Comments</th><td><?php echo $comments; ?></td></tr>
            <?php endif; ?>
          </table>
          <a href="enquiry.php" class="btn-submit" style="display:inline-block;margin-top:1rem;">Send Another Enquiry</a>
        </div>

      <?php endif; ?>

    </div>
  </main>

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

  <a href="#top" class="top-btn">⬆ Top</a>

</body>
</html>
