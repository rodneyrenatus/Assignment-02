<?php
require_once "data_helper.php";
$site_name = "Cacti-Succulent Kuching";
$current_year = 2026;

// Check if the form was submitted
$submitted = false;
$fname = "";
$lname = "";
$email = "";
$phone = "";
$enquiry_type = "";
$comments = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $submitted = true;
    $fname        = htmlspecialchars($_POST["fname"]);
    $lname        = htmlspecialchars($_POST["lname"]);
    $email        = htmlspecialchars($_POST["user-email"]);
    $phone        = htmlspecialchars($_POST["phone"]);
    $enquiry_type = htmlspecialchars($_POST["enquiry-type"]);
    $comments     = htmlspecialchars($_POST["comments"]);

    save_submission("enquiries.json", [
        "fname"        => $fname,
        "lname"        => $lname,
        "email"        => $email,
        "phone"        => $phone,
        "enquiry_type" => $enquiry_type,
        "comments"     => $comments,
    ]);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Send an enquiry to Cacti-Succulent Kuching.">
  <meta name="keywords" content="enquiry, questions, contact, cacti kuching">
  <meta name="author" content="Cacti-Succulent Kuching Team">
  <title>Enquiry | <?php echo $site_name; ?></title>
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
      <a href="login.php">Login</a>
      <a href="enquiry.php" class="active">Enquiry</a>
      <a href="members.php">Members</a>
      <a href="dashboard.php">Dashboard</a>
    </nav>
  </header>

  <main>

    <div class="page-hero">
      <h1>Have Questions?</h1>
      <p>Ask away — we're happy to help with any plant queries. Fill in the form below and we will get back to you as soon as possible. Fields marked <span class="required-star">*</span> are required.</p>
    </div>

    <div class="form-page-wrap">

      <?php if ($submitted): ?>

        <!-- Confirmation shown after form is submitted -->
        <div class="success-box">
          <h2>Thank you, <?php echo $fname . " " . $lname; ?>!</h2>
          <p>We have received your enquiry and will get back to you shortly.</p>
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

          <div class="form-group">
            <label for="phone">Phone Number <span class="required-star">*</span></label>
            <input type="tel" id="phone" name="phone"
                   placeholder="012-3456789"
                   pattern="[0-9]{8,10}" maxlength="10"
                   title="8 to 10 digits only" required>
          </div>

          <div class="form-group">
            <label for="enquiry-type">Enquiry About <span class="required-star">*</span></label>
            <select id="enquiry-type" name="enquiry-type" required>
              <option value="">-- Select a topic --</option>
              <optgroup label="Products">
                <option value="cacti">Cacti</option>
                <option value="succulents">Succulents</option>
                <option value="pots">Pots &amp; Planters</option>
                <option value="accessories">Accessories &amp; Soil</option>
                <option value="gift-bundles">Gift Bundles</option>
              </optgroup>
              <optgroup label="Services">
                <option value="care-consult">Plant Care Consultation</option>
                <option value="delivery">Delivery &amp; Shipping</option>
                <option value="pickup">Medan Satok Pickup</option>
                <option value="wholesale">Wholesale / Bulk Orders</option>
              </optgroup>
              <optgroup label="Other">
                <option value="general">General Enquiry</option>
                <option value="feedback">Feedback</option>
              </optgroup>
            </select>
          </div>

          <div class="form-group">
            <label for="comments">Comments</label>
            <textarea id="comments" name="comments" rows="6"
                      placeholder="Write your message here..."></textarea>
          </div>

          <div class="form-actions">
            <button type="submit" class="btn-submit">Send Enquiry</button>
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
