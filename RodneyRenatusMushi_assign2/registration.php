<?php
require_once "data_helper.php";
$site_name = "Cacti-Succulent Kuching";
$current_year = 2026;

$submitted = false;
$fname    = "";
$lname    = "";
$email    = "";
$street   = "";
$city     = "";
$state    = "";
$postcode = "";
$phone    = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $submitted = true;
    $fname    = htmlspecialchars($_POST["fname"]);
    $lname    = htmlspecialchars($_POST["lname"]);
    $email    = htmlspecialchars($_POST["user-email"]);
    $street   = htmlspecialchars($_POST["street"]);
    $city     = htmlspecialchars($_POST["city"]);
    $state    = htmlspecialchars($_POST["state"]);
    $postcode = htmlspecialchars($_POST["postcode"]);
    $phone    = htmlspecialchars($_POST["phone"]);
    $full_address = $street . ", " . $city . ", " . $state . " " . $postcode;

    save_submission("registrations.json", [
        "fname"    => $fname,
        "lname"    => $lname,
        "email"    => $email,
        "phone"    => $phone,
        "street"   => $street,
        "city"     => $city,
        "state"    => $state,
        "postcode" => $postcode,
    ]);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Register a new account with Cacti-Succulent Kuching.">
  <meta name="keywords" content="register, sign up, cacti kuching">
  <meta name="author" content="Cacti-Succulent Kuching Team">
  <title>Register | <?php echo $site_name; ?></title>
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
      <a href="login.php">Login</a>
      <a href="enquiry.php">Enquiry</a>
      <a href="members.php">Members</a>
      <a href="dashboard.php">Dashboard</a>
    </nav>
  </header>

  <main>

    <div class="page-hero">
      <h1>Create an Account</h1>
      <p>Join Cacti-Succulent Kuching and start your plant journey today. Fill in the form below to get started. Fields marked <span class="required-star">*</span> are required.</p>
    </div>

    <div class="form-page-wrap">

      <?php if ($submitted): ?>

        <div class="success-box">
          <h2>Welcome, <?php echo $fname . " " . $lname; ?>!</h2>
          <p>Your account has been created successfully. Here are your registration details:</p>
          <table class="confirm-table">
            <tr><th>Name</th><td><?php echo $fname . " " . $lname; ?></td></tr>
            <tr><th>Email</th><td><?php echo $email; ?></td></tr>
            <tr><th>Phone</th><td><?php echo $phone; ?></td></tr>
            <tr><th>Address</th><td><?php echo $full_address; ?></td></tr>
          </table>
          <a href="login.php" class="btn-submit" style="display:inline-block;margin-top:1rem;">Go to Login</a>
        </div>

      <?php else: ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

          <div class="form-group">
            <label for="fname">First Name <span class="required-star">*</span></label>
            <input type="text" id="fname" name="fname"
                   placeholder="Enter your First Name"
                   maxlength="25" pattern="[a-zA-Z]+"
                   title="Alphabetical characters only, max 25" required>
          </div>

          <div class="form-group">
            <label for="lname">Last Name <span class="required-star">*</span></label>
            <input type="text" id="lname" name="lname"
                   placeholder="Enter your Last Name"
                   maxlength="25" pattern="[a-zA-Z]+"
                   title="Alphabetical characters only, max 25" required>
          </div>

          <div class="form-group">
            <label for="email">Email Address <span class="required-star">*</span></label>
            <input type="email" id="email" name="user-email"
                   placeholder="example@gmail.com" required>
          </div>

          <fieldset>
            <legend>Address</legend>

            <div class="form-group">
              <label for="street">Street Address <span class="required-star">*</span></label>
              <input type="text" id="street" name="street" maxlength="40" required>
            </div>

            <div class="form-group">
              <label for="city">City / Town <span class="required-star">*</span></label>
              <input type="text" id="city" name="city" maxlength="20" required>
            </div>

            <div class="form-group">
              <label for="state">State <span class="required-star">*</span></label>
              <select id="state" name="state" required>
                <option value="">-- Select State --</option>
                <option value="Johor">Johor</option>
                <option value="Kedah">Kedah</option>
                <option value="Kelantan">Kelantan</option>
                <option value="Melaka">Melaka</option>
                <option value="Negeri Sembilan">Negeri Sembilan</option>
                <option value="Pahang">Pahang</option>
                <option value="Perak">Perak</option>
                <option value="Perlis">Perlis</option>
                <option value="Pulau Pinang">Pulau Pinang</option>
                <option value="Sabah">Sabah</option>
                <option value="Sarawak">Sarawak</option>
                <option value="Selangor">Selangor</option>
                <option value="Terengganu">Terengganu</option>
                <option value="Kuala Lumpur">W.P. Kuala Lumpur</option>
                <option value="Labuan">W.P. Labuan</option>
                <option value="Putrajaya">W.P. Putrajaya</option>
              </select>
            </div>

            <div class="form-group">
              <label for="postcode">Postcode <span class="required-star">*</span></label>
              <input type="text" id="postcode" name="postcode"
                     pattern="\d{5}" title="Exactly 5 digits"
                     maxlength="5" placeholder="e.g. 93000" required>
            </div>
          </fieldset>

          <div class="form-group">
            <label for="phone">Phone Number <span class="required-star">*</span></label>
            <input type="tel" id="phone" name="phone"
                   placeholder="012-3456789"
                   pattern="[0-9]{8,10}" maxlength="10"
                   title="8 to 10 digits only" required>
          </div>

          <div class="form-actions">
            <button type="submit" class="btn-submit">Create Account</button>
            <button type="reset" class="btn-reset">Clear Form</button>
          </div>

        </form>

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
