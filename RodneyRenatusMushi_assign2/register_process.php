<?php
session_start();
$site_name    = "Cacti-Succulent Kuching";
$current_year = 2026;

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: registration.php");
    exit;
}

$errors = [];

$fname     = htmlspecialchars(trim($_POST["fname"]      ?? ""));
$lname     = htmlspecialchars(trim($_POST["lname"]      ?? ""));
$email     = htmlspecialchars(trim($_POST["user-email"] ?? ""));
$phone     = htmlspecialchars(trim($_POST["phone"]      ?? ""));
$street    = htmlspecialchars(trim($_POST["street"]     ?? ""));
$city      = htmlspecialchars(trim($_POST["city"]       ?? ""));
$state     = htmlspecialchars(trim($_POST["state"]      ?? ""));
$postcode  = htmlspecialchars(trim($_POST["postcode"]   ?? ""));
$reg_user  = htmlspecialchars(trim($_POST["username"]   ?? ""));
$reg_pass  = htmlspecialchars(trim($_POST["password"]   ?? ""));

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
if (empty($street)) {
    $errors[] = "Street address is required.";
}
if (empty($city)) {
    $errors[] = "City / Town is required.";
}
if (empty($state)) {
    $errors[] = "Please select a state.";
}
if (empty($postcode) || !preg_match('/^\d{5}$/', $postcode)) {
    $errors[] = "Postcode is required and must be exactly 5 digits.";
}
if (empty($reg_user) || !preg_match('/^[a-zA-Z0-9]+$/', $reg_user)) {
    $errors[] = "Username is required and must contain letters or numbers only.";
}
if (empty($reg_pass)) {
    $errors[] = "Password is required.";
}

$full_address = $street . ", " . $city . ", " . $state . " " . $postcode;

if (empty($errors)) {
    $conn = mysqli_connect("localhost", "root", "", "cacti_succulent");

    if (!$conn) {
        $errors[] = "Connection failed: " . mysqli_connect_error();
    } else {
        // Check for duplicate username
        $check = mysqli_query($conn, "SELECT id FROM `user` WHERE username = '$reg_user'");
        if (mysqli_num_rows($check) > 0) {
            $errors[] = "That username is already taken. Please choose a different one.";
        } else {
            $sql = "INSERT INTO `user`(fname, lname, email, phone, street, city, state, postcode, username, password)
                    VALUES ('$fname', '$lname', '$email', '$phone', '$street', '$city', '$state', '$postcode', '$reg_user', '$reg_pass')";

            if (!mysqli_query($conn, $sql)) {
                $errors[] = "Error saving registration: " . mysqli_error($conn);
            }
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
  <meta name="description" content="Registration confirmation for Cacti-Succulent Kuching.">
  <title>Registration Confirmation | <?php echo $site_name; ?></title>
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
      <a href="registration.php" class="active">Register</a>
      <?php if (isset($_SESSION['role'])): ?><a href="logout.php">Logout</a><?php else: ?><a href="login.php">Login</a><?php endif; ?>
      <a href="enquiry.php">Enquiry</a>
      <a href="members.php">Members</a>
    </nav>
  </header>

  <main>

    <div class="page-hero">
      <h1><?php echo empty($errors) ? "Registration Successful!" : "Submission Error"; ?></h1>
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
          <a href="registration.php" class="btn-submit" style="display:inline-block;margin-top:1rem;">Go Back to Form</a>
        </div>

      <?php else: ?>

        <div class="success-box">
          <h2>Welcome, <?php echo $fname . " " . $lname; ?>!</h2>
          <p>Your account has been successfully saved to our database. Here are your registration details:</p>
          <table class="confirm-table">
            <tr><th>Name</th><td><?php echo $fname . " " . $lname; ?></td></tr>
            <tr><th>Email</th><td><?php echo $email; ?></td></tr>
            <tr><th>Phone</th><td><?php echo $phone; ?></td></tr>
            <tr><th>Address</th><td><?php echo $full_address; ?></td></tr>
            <tr><th>Username</th><td><?php echo $reg_user; ?></td></tr>
          </table>
          <a href="login.php" class="btn-submit" style="display:inline-block;margin-top:1rem;">Go to Login</a>
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
