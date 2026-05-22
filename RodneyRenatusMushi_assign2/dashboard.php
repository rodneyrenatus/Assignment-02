<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$site_name    = "Cacti-Succulent Kuching";
$current_year = 2026;

$conn = mysqli_connect("localhost", "root", "", "cacti_succulent");
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Summary counts
$res_enq  = mysqli_query($conn, "SELECT COUNT(*) AS cnt FROM enquiry");
$res_usr  = mysqli_query($conn, "SELECT COUNT(*) AS cnt FROM `user`");
$res_ord  = mysqli_query($conn, "SELECT COUNT(*) AS cnt FROM orders");
$res_rev  = mysqli_query($conn, "SELECT SUM(grand_total) AS total FROM orders");

$total_enquiries     = (int)mysqli_fetch_assoc($res_enq)['cnt'];
$total_registrations = (int)mysqli_fetch_assoc($res_usr)['cnt'];
$total_orders        = (int)mysqli_fetch_assoc($res_ord)['cnt'];
$revenue_row         = mysqli_fetch_assoc($res_rev);
$total_revenue       = $revenue_row['total'] !== null ? (float)$revenue_row['total'] : 0.00;

// Recent enquiries (last 5)
$recent_enq = mysqli_query($conn, "SELECT * FROM enquiry ORDER BY id DESC LIMIT 5");

// Recent registrations (last 5)
$recent_usr = mysqli_query($conn, "SELECT * FROM `user` ORDER BY id DESC LIMIT 5");

// Recent orders (last 5)
$recent_ord = mysqli_query($conn, "SELECT * FROM orders ORDER BY id DESC LIMIT 5");

mysqli_close($conn);

$active_tab = isset($_GET["tab"]) ? htmlspecialchars($_GET["tab"]) : "enquiries";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard | <?php echo $site_name; ?></title>
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
      <a href="enquiry.php">Enquiry</a>
      <a href="members.php">Members</a>
      <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?><a href="dashboard.php" class="active">Dashboard</a><?php endif; ?>
    </nav>
  </header>

  <main>

    <div class="page-hero" style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:1rem;">
      <div>
        <h1>Admin Dashboard</h1>
        <p>Logged in as <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong> &mdash; Overview of all database submissions.</p>
      </div>
      <a href="logout.php" class="btn-reset" style="display:inline-block;text-decoration:none;padding:0.5rem 1.2rem;">Log Out</a>
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
          <span class="dash-card-label">Registered Users</span>
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
         class="dash-tab <?php echo $active_tab === "enquiries" ? "dash-tab-active" : ""; ?>">
        Enquiries (<?php echo $total_enquiries; ?>)
      </a>
      <a href="dashboard.php?tab=registrations"
         class="dash-tab <?php echo $active_tab === "registrations" ? "dash-tab-active" : ""; ?>">
        Registrations (<?php echo $total_registrations; ?>)
      </a>
      <a href="dashboard.php?tab=orders"
         class="dash-tab <?php echo $active_tab === "orders" ? "dash-tab-active" : ""; ?>">
        Orders (<?php echo $total_orders; ?>)
      </a>
    </div>

    <!-- Recent Enquiries -->
    <?php if ($active_tab === "enquiries"): ?>
    <div class="dash-section">
      <h2>Recent Enquiries <span style="font-size:0.85rem;font-weight:normal;">(showing latest 5 &mdash; <a href="view_enquiry.php">view all</a>)</span></h2>
      <?php if ($total_enquiries === 0): ?>
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
              </tr>
            </thead>
            <tbody>
              <?php while ($row = mysqli_fetch_assoc($recent_enq)): ?>
              <tr>
                <td><?php echo $row["id"]; ?></td>
                <td><?php echo $row["fname"] . " " . $row["lname"]; ?></td>
                <td><?php echo $row["email"]; ?></td>
                <td><?php echo $row["phone"]; ?></td>
                <td><?php echo $row["enquiry_type"]; ?></td>
                <td><?php echo $row["comments"] != "" ? $row["comments"] : "—"; ?></td>
              </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        </div>
      <?php endif; ?>
    </div>
    <?php endif; ?>

    <!-- Recent Registrations -->
    <?php if ($active_tab === "registrations"): ?>
    <div class="dash-section">
      <h2>Recent Registrations <span style="font-size:0.85rem;font-weight:normal;">(showing latest 5 &mdash; <a href="view_register.php">view all</a>)</span></h2>
      <?php if ($total_registrations === 0): ?>
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
                <th>Username</th>
                <th>City</th>
                <th>State</th>
              </tr>
            </thead>
            <tbody>
              <?php while ($row = mysqli_fetch_assoc($recent_usr)): ?>
              <tr>
                <td><?php echo $row["id"]; ?></td>
                <td><?php echo $row["fname"] . " " . $row["lname"]; ?></td>
                <td><?php echo $row["email"]; ?></td>
                <td><?php echo $row["phone"]; ?></td>
                <td><?php echo $row["username"]; ?></td>
                <td><?php echo $row["city"]; ?></td>
                <td><?php echo $row["state"]; ?></td>
              </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        </div>
      <?php endif; ?>
    </div>
    <?php endif; ?>

    <!-- Recent Orders -->
    <?php if ($active_tab === "orders"): ?>
    <div class="dash-section">
      <h2>Recent Orders <span style="font-size:0.85rem;font-weight:normal;">(showing latest 5 &mdash; <a href="view_order.php">view all</a>)</span></h2>
      <?php if ($total_orders === 0): ?>
        <p class="dash-empty">No orders received yet.</p>
      <?php else: ?>
        <div class="dash-table-wrap">
          <table class="dash-table">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Delivery</th>
                <th>Date</th>
                <th>Payment</th>
                <th>Total (RM)</th>
              </tr>
            </thead>
            <tbody>
              <?php while ($row = mysqli_fetch_assoc($recent_ord)): ?>
              <tr>
                <td><?php echo $row["id"]; ?></td>
                <td><?php echo $row["fname"] . " " . $row["lname"]; ?></td>
                <td><?php echo $row["email"]; ?></td>
                <td><?php echo $row["delivery_mode"]; ?></td>
                <td><?php echo $row["preferred_date"]; ?></td>
                <td><?php echo $row["payment_mode"]; ?></td>
                <td><strong><?php echo number_format((float)$row["grand_total"], 2); ?></strong></td>
              </tr>
              <?php endwhile; ?>
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
