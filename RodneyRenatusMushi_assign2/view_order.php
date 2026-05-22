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

$result = mysqli_query($conn, "SELECT * FROM orders ORDER BY id ASC");
$total  = mysqli_num_rows($result);

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>All Orders | <?php echo $site_name; ?> Admin</title>
  <link rel="stylesheet" href="styles/style.css">
  <style>
    .admin-bar {
      background: #2c3e50;
      color: #fff;
      padding: 0.7rem 2rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-size: 0.9rem;
    }
    .admin-bar a { color: #aee6d8; text-decoration: none; margin-left: 1.2rem; }
    .admin-bar a:hover { text-decoration: underline; }
    .items-list { font-size: 0.8rem; line-height: 1.5; max-width: 220px; }
  </style>
</head>
<body>

  <div class="admin-bar">
    <span>&#128274; Admin Panel &mdash; <?php echo htmlspecialchars($_SESSION['username']); ?></span>
    <span>
      <a href="dashboard.php">&#8592; Dashboard</a>
      <a href="view_enquiry.php">Enquiries</a>
      <a href="view_register.php">Registrations</a>
      <a href="logout.php">Log Out</a>
    </span>
  </div>

  <main style="padding: 2rem;">

    <div class="page-hero">
      <h1>All Order Submissions</h1>
      <p>Total records in database: <strong><?php echo $total; ?></strong></p>
    </div>

    <?php if ($total === 0): ?>
      <p class="dash-empty">No orders in the database yet.</p>
    <?php else: ?>
      <div class="dash-table-wrap">
        <table class="dash-table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Items Ordered</th>
              <th>Delivery Mode</th>
              <th>Preferred Date</th>
              <th>Delivery Address</th>
              <th>Payment</th>
              <th>Subtotal (RM)</th>
              <th>Delivery Fee (RM)</th>
              <th>Grand Total (RM)</th>
              <th>Special Notes</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)):
                $items_arr  = json_decode($row["items"], true);
                $items_text = "";
                if (is_array($items_arr)) {
                    foreach ($items_arr as $item) {
                        $items_text .= $item["name"] . " &times;" . $item["qty"] . " (RM " . number_format($item["total"], 2) . ")<br>";
                    }
                }
                if ($items_text === "") { $items_text = "&mdash;"; }
            ?>
            <tr>
              <td><?php echo $row["id"]; ?></td>
              <td><?php echo $row["fname"] . " " . $row["lname"]; ?></td>
              <td><?php echo $row["email"]; ?></td>
              <td><?php echo $row["phone"]; ?></td>
              <td class="items-list"><?php echo $items_text; ?></td>
              <td><?php echo $row["delivery_mode"]; ?></td>
              <td><?php echo $row["preferred_date"]; ?></td>
              <td><?php echo $row["delivery_address"] != "" ? $row["delivery_address"] : "&mdash;"; ?></td>
              <td><?php echo $row["payment_mode"]; ?></td>
              <td><?php echo number_format((float)$row["subtotal"], 2); ?></td>
              <td><?php echo number_format((float)$row["delivery_fee"], 2); ?></td>
              <td><strong><?php echo number_format((float)$row["grand_total"], 2); ?></strong></td>
              <td><?php echo $row["special_notes"] != "" ? $row["special_notes"] : "&mdash;"; ?></td>
            </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    <?php endif; ?>

  </main>

  <footer>
    <div class="footer-bottom" style="text-align:center;padding:1rem;">
      <p>&copy; <?php echo $current_year; ?> <?php echo $site_name; ?>. Admin Panel &mdash; <a href="logout.php">Log Out</a></p>
    </div>
  </footer>

</body>
</html>
