<?php
session_start();
$site_name    = "Cacti-Succulent Kuching";
$current_year = 2026;
$nav_active   = "enquiry";

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: enquiry.php");
    exit;
}

// ANTI-SPAM: rate limit enquiry submissions
// Allow max 3 submissions per 5-minute window per session.
// On exceeding the limit, the user is locked out for 10 minutes.
$SPAM_MAX       = 3;   // max submissions allowed
$SPAM_WINDOW    = 300; // 5-minute rolling window (seconds)
$SPAM_LOCKOUT   = 600; // 10-minute lockout (seconds)

$now = time();

// Initialise session tracking arrays
if (!isset($_SESSION['enq_times']))   { $_SESSION['enq_times']   = []; }
if (!isset($_SESSION['enq_lockout'])) { $_SESSION['enq_lockout'] = 0;  }

$spam_blocked = false;
$spam_message = "";

if ($now < $_SESSION['enq_lockout']) {
    // Currently locked out
    $remaining    = ceil(($_SESSION['enq_lockout'] - $now) / 60);
    $spam_blocked = true;
    $spam_message = "Too many enquiry submissions. You are locked out for approximately $remaining more minute(s). Please try again later.";
} else {
    // Remove timestamps outside the rolling window
    $_SESSION['enq_times'] = array_filter($_SESSION['enq_times'], fn($t) => ($now - $t) < $SPAM_WINDOW);

    if (count($_SESSION['enq_times']) >= $SPAM_MAX) {
        // Trigger lockout
        $_SESSION['enq_lockout'] = $now + $SPAM_LOCKOUT;
        $_SESSION['enq_times']   = [];
        $spam_blocked = true;
        $spam_message = "Spam detected: too many submissions in a short period. Your access has been disabled for 10 minutes.";
    }
}

$errors = [];
if ($spam_blocked) {
    $errors[] = $spam_message;
}

$fname        = htmlspecialchars(trim($_POST["fname"]          ?? ""));
$lname        = htmlspecialchars(trim($_POST["lname"]          ?? ""));
$email        = htmlspecialchars(trim($_POST["user-email"]     ?? ""));
$phone        = htmlspecialchars(trim($_POST["phone"]          ?? ""));
$enquiry_type = htmlspecialchars(trim($_POST["enquiry-type"]   ?? ""));
$comments     = htmlspecialchars(trim($_POST["comments"]       ?? ""));

if (empty($fname) || !preg_match('/^[a-zA-Z]+$/', $fname)) {
    if (!$spam_blocked) $errors[] = "First name is required and must contain letters only (max 25 characters).";
}
if (empty($lname) || !preg_match('/^[a-zA-Z]+$/', $lname)) {
    if (!$spam_blocked) $errors[] = "Last name is required and must contain letters only (max 25 characters).";
}
if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    if (!$spam_blocked) $errors[] = "A valid email address is required.";
}
if (empty($phone) || !preg_match('/^[0-9]{8,10}$/', $phone)) {
    if (!$spam_blocked) $errors[] = "Phone number is required and must be 8 to 10 digits.";
}
if (empty($enquiry_type)) {
    if (!$spam_blocked) $errors[] = "Please select an enquiry topic.";
}

if (empty($errors)) {
    require_once("connection.php");


    {
        $sql = "INSERT INTO enquiry(fname, lname, email, phone, enquiry_type, comments)
                VALUES ('$fname', '$lname', '$email', '$phone', '$enquiry_type', '$comments')";

        if (!mysqli_query($conn, $sql)) {
            $errors[] = "Error saving enquiry: " . mysqli_error($conn);
        } else {
            // Anti-spam: record this submission timestamp
            $_SESSION['enq_times'][] = time();
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
  <?php include('header.inc'); ?>

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
  <?php include('footer.inc'); ?>

</body>
</html>
