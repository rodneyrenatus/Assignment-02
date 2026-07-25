<?php

session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$site_name    = "Cacti-Succulent Kuching";
$current_year = 2026;
$nav_active   = 'dashboard';

require_once("connection.php");

$action_msg = "";

// DELETE ENQUIRY
if (isset($_GET['delete_id']) && is_numeric($_GET['delete_id'])) {
    $del_id = (int)$_GET['delete_id'];
    $chk = mysqli_query($conn, "SELECT id FROM enquiry WHERE id=$del_id");
    if (mysqli_num_rows($chk) > 0) {
        mysqli_query($conn, "DELETE FROM enquiry WHERE id=$del_id");
        $action_msg = "success:Enquiry #$del_id has been deleted.";
    } else {
        $action_msg = "error:Enquiry not found.";
    }
}

// Fetch all, grouped by enquiry_type then sorted by id
$result = mysqli_query($conn, "SELECT * FROM enquiry ORDER BY enquiry_type ASC, id ASC");
$total  = mysqli_num_rows($result);

// Group rows by enquiry_type
$grouped = [];
while ($row = mysqli_fetch_assoc($result)) {
    $grouped[$row['enquiry_type']][] = $row;
}

// Summary counts per topic
$summary = [];
foreach ($grouped as $type => $rows) {
    $summary[$type] = count($rows);
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Admin view of all enquiry submissions.">
  <meta name="keywords" content="admin, enquiries, manage">
  <meta name="author" content="Cacti-Succulent Kuching Team">
  <title>All Enquiries | <?php echo $site_name; ?> Admin</title>
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
    .summary-cards { display: flex; flex-wrap: wrap; gap: 0.8rem; margin: 1.5rem 0 2rem; }
    .summary-card {
      background: #f0f7f2;
      border: 1.5px solid #aee6d8;
      border-radius: 8px;
      padding: 0.6rem 1.2rem;
      font-size: 0.88rem;
      color: #2c7a50;
      font-weight: 600;
    }
    .summary-card span { font-size: 1.2rem; font-weight: 800; margin-left: 0.4rem; }
    .group-heading {
      background: #2c3e50;
      color: #fff;
      padding: 0.5rem 1rem;
      border-radius: 6px 6px 0 0;
      font-size: 0.95rem;
      font-weight: 700;
      margin-top: 1.5rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .group-heading .group-count {
      background: #aee6d8;
      color: #1a4a35;
      border-radius: 12px;
      padding: 2px 10px;
      font-size: 0.82rem;
    }
    .group-table-wrap { margin-bottom: 0.5rem; }
    .btn-del-link {
      background: #c0392b;
      color: #fff;
      padding: 3px 10px;
      border-radius: 4px;
      text-decoration: none;
      font-size: 0.78rem;
    }
    .btn-del-link:hover { background: #a93226; }
    .msg-ok  { background:#d4edda;border:2px solid #28a745;border-radius:6px;padding:0.8rem 1rem;margin-bottom:1rem;color:#155724;font-weight:600; }
    .msg-err { background:#f8d7da;border:2px solid #c0392b;border-radius:6px;padding:0.8rem 1rem;margin-bottom:1rem;color:#721c24;font-weight:600; }
    .toggle-btn {
      background: none;
      border: none;
      color: #aee6d8;
      cursor: pointer;
      font-size: 0.85rem;
      margin-left: 1rem;
    }
  </style>
</head>
<body>

  <div class="admin-bar">
    <span>&#128274; Admin Panel &mdash; <?php echo htmlspecialchars($_SESSION['username']); ?></span>
    <span>
      <a href="dashboard.php">&#8592; Dashboard</a>
      <a href="view_register.php">Registrations</a>
      <a href="view_order.php">Orders</a>
      <a href="logout.php">Log Out</a>
    </span>
  </div>

  <main style="padding: 2rem;">

    <div class="page-hero">
      <h1>All Enquiry Submissions</h1>
      <p>Total records in database: <strong><?php echo $total; ?></strong> &mdash; grouped by topic, sorted by ID.</p>
    </div>

    <?php if ($action_msg): ?>
      <?php [$mt, $mx] = explode(':', $action_msg, 2); ?>
      <div class="<?php echo $mt === 'success' ? 'msg-ok' : 'msg-err'; ?>">
        <?php echo $mt === 'success' ? '✅' : '⚠️'; ?> <?php echo htmlspecialchars($mx); ?>
      </div>
    <?php endif; ?>

    <?php if ($total === 0): ?>
      <p class="dash-empty">No enquiries in the database yet.</p>
    <?php else: ?>

      <!-- Summary by topic -->
      <div class="summary-cards">
        <?php foreach ($summary as $type => $count): ?>
          <div class="summary-card"><?php echo htmlspecialchars($type); ?><span><?php echo $count; ?></span></div>
        <?php endforeach; ?>
      </div>

      <!-- Grouped tables -->
      <?php foreach ($grouped as $type => $rows): ?>
        <div class="group-heading">
          <span>📋 <?php echo htmlspecialchars($type); ?></span>
          <span class="group-count"><?php echo count($rows); ?> enquir<?php echo count($rows) === 1 ? 'y' : 'ies'; ?></span>
        </div>
        <div class="group-table-wrap dash-table-wrap">
          <table class="dash-table">
            <thead>
              <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Comments</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($rows as $row): ?>
              <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo htmlspecialchars($row['fname']); ?></td>
                <td><?php echo htmlspecialchars($row['lname']); ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td><?php echo htmlspecialchars($row['phone']); ?></td>
                <td><?php echo $row['comments'] !== '' ? htmlspecialchars($row['comments']) : '&mdash;'; ?></td>
                <td>
                  <a href="view_enquiry.php?delete_id=<?php echo $row['id']; ?>"
                     class="btn-del-link"
                     onclick="return confirm('Delete enquiry #<?php echo $row['id']; ?> from <?php echo htmlspecialchars($row['fname'].' '.$row['lname']); ?>?');">
                    Delete
                  </a>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      <?php endforeach; ?>

    <?php endif; ?>

  </main>
  <?php include('footer.inc'); ?>

</body>
</html>
