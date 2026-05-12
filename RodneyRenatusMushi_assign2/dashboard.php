<?php
require_once "data_helper.php";
$site_name    = "Cacti-Succulent Kuching";
$current_year = 2026;

$enquiries     = load_submissions("enquiries.json");
$registrations = load_submissions("registrations.json");
$orders        = load_submissions("orders.json");

$total_enquiries     = count($enquiries);
$total_registrations = count($registrations);
$total_orders        = count($orders);

// Calculate total revenue from all orders
$total_revenue = 0.00;
foreach ($orders as $order) {
    $total_revenue = $total_revenue + $order["grand_total"];
}

// Determine which tab to show (default: enquiries)
$active_tab = isset($_GET["tab"]) ? htmlspecialchars($_GET["tab"]) : "enquiries";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard | <?php echo $site_name; ?></title>
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
      <a href="enquiry.php">Enquiry</a>
      <a href="members.php">Members</a>
      <a href="dashboard.php" class="active">Dashboard</a>
    </nav>
  </header>

  <main>

    <div class="page-hero">
      <h1>Admin Dashboard</h1>
      <p>Overview of all form submissions received on the site.</p>
    </div>

    <!-- Summary cards -->
    <div class="dash-cards">

      <div class="dash-card dash-card-blue">
        <div class="dash-card-icon">✉️</div>
        <div class="dash-card-body">
          <span class="dash-card-label">Enquiries</span>
          <span class="dash-card-number"><?php echo $total_enquiries; ?></span>
        </div>
      </div>

      <div class="dash-card dash-card-green">
        <div class="dash-card-icon">📋</div>
        <div class="dash-card-body">
          <span class="dash-card-label">Registrations</span>
          <span class="dash-card-number"><?php echo $total_registrations; ?></span>
        </div>
      </div>

      <div class="dash-card dash-card-orange">
        <div class="dash-card-icon">🛒</div>
        <div class="dash-card-body">
          <span class="dash-card-label">Orders</span>
          <span class="dash-card-number"><?php echo $total_orders; ?></span>
        </div>
      </div>

      <div class="dash-card dash-card-purple">
        <div class="dash-card-icon">💰</div>
        <div class="dash-card-body">
          <span class="dash-card-label">Total Revenue</span>
          <span class="dash-card-number">RM <?php echo number_format($total_revenue, 2); ?></span>
        </div>
      </div>

    </div>

    <!-- Tab navigation -->
    <div class="dash-tabs">
      <a href="dashboard.php?tab=enquiries"
         class="dash-tab <?php echo $active_tab == "enquiries" ? "dash-tab-active" : ""; ?>">
        Enquiries (<?php echo $total_enquiries; ?>)
      </a>
      <a href="dashboard.php?tab=registrations"
         class="dash-tab <?php echo $active_tab == "registrations" ? "dash-tab-active" : ""; ?>">
        Registrations (<?php echo $total_registrations; ?>)
      </a>
      <a href="dashboard.php?tab=orders"
         class="dash-tab <?php echo $active_tab == "orders" ? "dash-tab-active" : ""; ?>">
        Orders (<?php echo $total_orders; ?>)
      </a>
    </div>

    <!-- Enquiries table -->
    <?php if ($active_tab == "enquiries"): ?>
    <div class="dash-section">
      <h2>Enquiry Submissions</h2>
      <?php if ($total_enquiries == 0): ?>
        <p class="dash-empty">No enquiries received yet.</p>
      <?php else: ?>
        <div class="dash-table-wrap">
          <table class="dash-table">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Topic</th>
                <th>Comments</th>
                <th>Received</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $row_number = 1;
              foreach ($enquiries as $row):
              ?>
              <tr>
                <td><?php echo $row_number; ?></td>
                <td><?php echo $row["fname"] . " " . $row["lname"]; ?></td>
                <td><?php echo $row["email"]; ?></td>
                <td><?php echo $row["phone"]; ?></td>
                <td><?php echo $row["enquiry_type"]; ?></td>
                <td><?php echo $row["comments"] != "" ? $row["comments"] : "—"; ?></td>
                <td><?php echo $row["timestamp"]; ?></td>
              </tr>
              <?php
              $row_number = $row_number + 1;
              endforeach;
              ?>
            </tbody>
          </table>
        </div>
      <?php endif; ?>
    </div>
    <?php endif; ?>

    <!-- Registrations table -->
    <?php if ($active_tab == "registrations"): ?>
    <div class="dash-section">
      <h2>Registration Submissions</h2>
      <?php if ($total_registrations == 0): ?>
        <p class="dash-empty">No registrations received yet.</p>
      <?php else: ?>
        <div class="dash-table-wrap">
          <table class="dash-table">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>City</th>
                <th>State</th>
                <th>Postcode</th>
                <th>Received</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $row_number = 1;
              foreach ($registrations as $row):
              ?>
              <tr>
                <td><?php echo $row_number; ?></td>
                <td><?php echo $row["fname"] . " " . $row["lname"]; ?></td>
                <td><?php echo $row["email"]; ?></td>
                <td><?php echo $row["phone"]; ?></td>
                <td><?php echo $row["city"]; ?></td>
                <td><?php echo $row["state"]; ?></td>
                <td><?php echo $row["postcode"]; ?></td>
                <td><?php echo $row["timestamp"]; ?></td>
              </tr>
              <?php
              $row_number = $row_number + 1;
              endforeach;
              ?>
            </tbody>
          </table>
        </div>
      <?php endif; ?>
    </div>
    <?php endif; ?>

    <!-- Orders table -->
    <?php if ($active_tab == "orders"): ?>
    <div class="dash-section">
      <h2>Order Submissions</h2>
      <?php if ($total_orders == 0): ?>
        <p class="dash-empty">No orders received yet.</p>
      <?php else: ?>
        <div class="dash-table-wrap">
          <table class="dash-table">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Items</th>
                <th>Delivery</th>
                <th>Date</th>
                <th>Payment</th>
                <th>Total (RM)</th>
                <th>Received</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $row_number = 1;
              foreach ($orders as $row):
                // Build a readable items list
                $items_list = "";
                foreach ($row["items"] as $item) {
                    $items_list = $items_list . $item["name"] . " x" . $item["qty"] . ", ";
                }
                $items_list = rtrim($items_list, ", ");
              ?>
              <tr>
                <td><?php echo $row_number; ?></td>
                <td><?php echo $row["fname"] . " " . $row["lname"]; ?></td>
                <td><?php echo $row["email"]; ?></td>
                <td><?php echo $row["phone"]; ?></td>
                <td class="items-cell"><?php echo $items_list != "" ? $items_list : "—"; ?></td>
                <td><?php echo $row["delivery_mode"]; ?></td>
                <td><?php echo $row["preferred_date"]; ?></td>
                <td><?php echo $row["payment_mode"]; ?></td>
                <td><strong><?php echo number_format($row["grand_total"], 2); ?></strong></td>
                <td><?php echo $row["timestamp"]; ?></td>
              </tr>
              <?php
              $row_number = $row_number + 1;
              endforeach;
              ?>
            </tbody>
          </table>
        </div>
      <?php endif; ?>
    </div>
    <?php endif; ?>

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
