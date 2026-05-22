<?php
session_start();
$site_name    = "Cacti-Succulent Kuching";
$current_year = 2026;

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: order.php");
    exit;
}

$errors = [];

$fname            = htmlspecialchars(trim($_POST["first_name"]        ?? ""));
$lname            = htmlspecialchars(trim($_POST["last_name"]         ?? ""));
$email            = htmlspecialchars(trim($_POST["email"]             ?? ""));
$phone            = htmlspecialchars(trim($_POST["phone"]             ?? ""));
$delivery_mode    = htmlspecialchars(trim($_POST["delivery_mode"]     ?? ""));
$preferred_date   = htmlspecialchars(trim($_POST["preferred_date"]    ?? ""));
$delivery_address = htmlspecialchars(trim($_POST["delivery_address"]  ?? ""));
$payment_mode     = htmlspecialchars(trim($_POST["payment_mode"]      ?? ""));
$special_notes    = htmlspecialchars(trim($_POST["special_notes"]     ?? ""));

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
if (empty($delivery_mode)) {
    $errors[] = "Please select a delivery mode.";
}
if (empty($preferred_date)) {
    $errors[] = "Please select a preferred date.";
}
if (empty($payment_mode)) {
    $errors[] = "Please select a payment method.";
}
if (!isset($_POST["agree_terms"])) {
    $errors[] = "You must agree to the terms before placing an order.";
}

$prices = [
    "ariocarpus"      => 29.10,
    "golden_barrel"   => 35.00,
    "bunny_ear"       => 28.00,
    "moon_cactus"     => 22.00,
    "fairy_castle"    => 40.00,
    "old_lady"        => 30.00,
    "star_cactus"     => 38.00,
    "hedgehog"        => 33.00,
    "bishops_cap"     => 42.00,
    "mini_saguaro"    => 50.00,
    "aloe"            => 10.00,
    "sedum"           => 9.00,
    "echeveria_raspberry" => 25.00,
    "jade"            => 30.00,
    "lithops"         => 22.00,
    "string_pearls"   => 28.00,
    "burros_tail"     => 35.00,
    "haworthia_lim"   => 26.00,
    "mini_echeveria"  => 15.00,
    "terra_s"         => 5.00,
    "terra_l"         => 12.00,
    "ceramic"         => 18.00,
    "hanging"         => 22.00,
    "ceramic_white"   => 14.00,
    "terra_m"         => 10.00,
    "hanging_plastic" => 13.00,
    "concrete"        => 30.00,
    "plastic"         => 8.00,
    "self_water"      => 43.00,
    "mini_deco"       => 20.00,
    "glass_terr"      => 60.00,
    "wooden_box"      => 54.00,
    "soil"            => 15.00,
    "fert"            => 12.00,
    "gift"            => 35.00,
    "watering_small"  => 6.00,
    "tool_set"        => 20.00,
    "spray"           => 4.00,
    "labels"          => 7.00,
    "grow_light"      => 56.00,
    "pebbles"         => 21.00,
    "stand"           => 25.00,
];

$delivery_fees = [
    "pickup"           => 0.00,
    "delivery_kuching" => 5.00,
    "delivery_sarawak" => 15.00,
    "courier"          => 25.00,
];

$ordered_items = [];
$subtotal = 0.00;

foreach ($prices as $key => $unit_price) {
    $checkbox_name = "product_" . $key;
    $qty_name      = "qty_" . $key;
    if (isset($_POST[$checkbox_name]) && isset($_POST[$qty_name])) {
        $qty = (int)$_POST[$qty_name];
        if ($qty > 0) {
            $line_total = $qty * $unit_price;
            $subtotal  += $line_total;
            $ordered_items[] = [
                "name"  => htmlspecialchars($_POST[$checkbox_name]),
                "qty"   => $qty,
                "price" => $unit_price,
                "total" => $line_total,
            ];
        }
    }
}

if (empty($ordered_items)) {
    $errors[] = "Please select at least one product before placing an order.";
}

$delivery_fee = isset($delivery_fees[$delivery_mode]) ? $delivery_fees[$delivery_mode] : 0.00;
$grand_total  = $subtotal + $delivery_fee;
$items_json   = json_encode($ordered_items);

if (empty($errors)) {
    $servername = "localhost";
    $username   = "root";
    $password   = "";
    $dbname     = "cacti_succulent";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        $errors[] = "Connection failed: " . mysqli_connect_error();
    } else {
        $sql = "INSERT INTO orders(fname, lname, email, phone, delivery_mode, preferred_date,
                    delivery_address, payment_mode, special_notes, items, subtotal, delivery_fee, grand_total)
                VALUES ('$fname', '$lname', '$email', '$phone', '$delivery_mode', '$preferred_date',
                    '$delivery_address', '$payment_mode', '$special_notes', '$items_json',
                    '$subtotal', '$delivery_fee', '$grand_total')";

        if (!mysqli_query($conn, $sql)) {
            $errors[] = "Error saving order: " . mysqli_error($conn);
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
  <meta name="description" content="Order confirmation for Cacti-Succulent Kuching.">
  <title>Order Confirmation | <?php echo $site_name; ?></title>
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
      <a href="order.php" class="active">Order</a>
      <a href="registration.php">Register</a>
      <?php if (isset($_SESSION['role'])): ?><a href="logout.php">Logout</a><?php else: ?><a href="login.php">Login</a><?php endif; ?>
      <a href="enquiry.php">Enquiry</a>
      <a href="members.php">Members</a>
      <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?><a href="dashboard.php">Dashboard</a><?php endif; ?>
    </nav>
  </header>

  <main>

    <div class="page-hero">
      <h1><?php echo empty($errors) ? "Order Confirmed!" : "Submission Error"; ?></h1>
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
          <a href="order.php" class="btn-submit" style="display:inline-block;margin-top:1rem;">Go Back to Form</a>
        </div>

      <?php else: ?>

        <div class="success-box">
          <h2>Order Received, <?php echo $fname . " " . $lname; ?>!</h2>
          <p>Thank you for your order. Your order has been successfully saved to our database. We will contact you at <strong><?php echo $email; ?></strong> to confirm.</p>

          <table class="confirm-table">
            <tr><th>Name</th><td><?php echo $fname . " " . $lname; ?></td></tr>
            <tr><th>Phone</th><td><?php echo $phone; ?></td></tr>
            <tr><th>Delivery</th><td><?php echo $delivery_mode; ?></td></tr>
            <tr><th>Preferred Date</th><td><?php echo $preferred_date; ?></td></tr>
            <?php if ($delivery_address != ""): ?>
            <tr><th>Address</th><td><?php echo $delivery_address; ?></td></tr>
            <?php endif; ?>
            <tr><th>Payment</th><td><?php echo $payment_mode; ?></td></tr>
          </table>

          <?php if (count($ordered_items) > 0): ?>
          <h3 style="margin-top:1.5rem;">Items Ordered</h3>
          <table class="confirm-table">
            <tr><th>Product</th><th>Qty</th><th>Unit (RM)</th><th>Total (RM)</th></tr>
            <?php foreach ($ordered_items as $item): ?>
            <tr>
              <td><?php echo $item["name"]; ?></td>
              <td><?php echo $item["qty"]; ?></td>
              <td><?php echo number_format($item["price"], 2); ?></td>
              <td><?php echo number_format($item["total"], 2); ?></td>
            </tr>
            <?php endforeach; ?>
            <tr><th colspan="3">Subtotal</th><td>RM <?php echo number_format($subtotal, 2); ?></td></tr>
            <tr><th colspan="3">Delivery Fee</th><td>RM <?php echo number_format($delivery_fee, 2); ?></td></tr>
            <tr><th colspan="3">Grand Total</th><td><strong>RM <?php echo number_format($grand_total, 2); ?></strong></td></tr>
          </table>
          <?php endif; ?>

          <?php if ($special_notes != ""): ?>
          <p style="margin-top:1rem;"><strong>Notes:</strong> <?php echo $special_notes; ?></p>
          <?php endif; ?>

          <a href="order.php" class="btn-submit" style="display:inline-block;margin-top:1.5rem;">Place Another Order</a>
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
