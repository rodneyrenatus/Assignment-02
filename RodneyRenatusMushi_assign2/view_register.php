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

$result = mysqli_query($conn, "SELECT * FROM `user` ORDER BY id ASC");
$total  = mysqli_num_rows($result);

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>All Registrations | <?php echo $site_name; ?> Admin</title>
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
  </style>
</head>
<body>

  <div class="admin-bar">
    <span>&#128274; Admin Panel &mdash; <?php echo htmlspecialchars($_SESSION['username']); ?></span>
    <span>
      <a href="dashboard.php">&#8592; Dashboard</a>
      <a href="view_enquiry.php">Enquiries</a>
      <a href="view_order.php">Orders</a>
      <a href="logout.php">Log Out</a>
    </span>
  </div>

  <main style="padding: 2rem;">

    <div class="page-hero">
      <h1>All Registered Users</h1>
      <p>Total records in database: <strong><?php echo $total; ?></strong></p>
    </div>

    <?php if ($total === 0): ?>
      <p class="dash-empty">No registered users in the database yet.</p>
    <?php else: ?>
      <div class="dash-table-wrap">
        <table class="dash-table">
          <thead>
            <tr>
              <th>ID</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Street</th>
              <th>City</th>
              <th>State</th>
              <th>Postcode</th>
              <th>Username</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
              <td><?php echo $row["id"]; ?></td>
              <td><?php echo $row["fname"]; ?></td>
              <td><?php echo $row["lname"]; ?></td>
              <td><?php echo $row["email"]; ?></td>
              <td><?php echo $row["phone"]; ?></td>
              <td><?php echo $row["street"]; ?></td>
              <td><?php echo $row["city"]; ?></td>
              <td><?php echo $row["state"]; ?></td>
              <td><?php echo $row["postcode"]; ?></td>
              <td><?php echo $row["username"]; ?></td>
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
