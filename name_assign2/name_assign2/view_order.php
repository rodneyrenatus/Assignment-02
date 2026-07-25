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

mysqli_query($conn, "ALTER TABLE orders ADD COLUMN IF NOT EXISTS `status` VARCHAR(20) NOT NULL DEFAULT 'pending'");

$action_msg = "";

// DELETE ORDER
if (isset($_GET['delete_id']) && is_numeric($_GET['delete_id'])) {
    $del_id = (int)$_GET['delete_id'];
    $chk = mysqli_query($conn, "SELECT id FROM orders WHERE id=$del_id");
    if (mysqli_num_rows($chk) > 0) {
        mysqli_query($conn, "DELETE FROM orders WHERE id=$del_id");
        $action_msg = "success:Order #$del_id has been deleted.";
    } else {
        $action_msg = "error:Order not found.";
    }
}

// CANCEL ORDER
if (isset($_GET['cancel_id']) && is_numeric($_GET['cancel_id'])) {
    $cancel_id = (int)$_GET['cancel_id'];
    $upd = mysqli_query($conn, "UPDATE orders SET `status`='cancelled' WHERE id=$cancel_id AND `status` != 'cancelled'");
    if ($upd && mysqli_affected_rows($conn) > 0) {
        $action_msg = "success:Order #$cancel_id has been cancelled.";
    } else {
        $action_msg = "error:Could not cancel Order #$cancel_id.";
    }
}

// Sorting
$sort_col = isset($_GET['sort']) ? $_GET['sort'] : 'id';
$sort_dir = isset($_GET['dir']) && $_GET['dir'] === 'desc' ? 'DESC' : 'ASC';
$allowed_sort = ['id', 'fname', 'preferred_date', 'grand_total', 'status'];
if (!in_array($sort_col, $allowed_sort)) { $sort_col = 'id'; }

$result = mysqli_query($conn, "SELECT * FROM orders ORDER BY $sort_col $sort_dir");
$total  = mysqli_num_rows($result);

// Group by status
$grouped = [];
$status_totals = [];
$grand_revenue = 0;
while ($row = mysqli_fetch_assoc($result)) {
    $st = $row['status'] ?? 'pending';
    $grouped[$st][] = $row;
    $status_totals[$st] = ($status_totals[$st] ?? 0) + 1;
    $grand_revenue += (float)$row['grand_total'];
}

$status_colors = [
    'pending'    => 'background:#fff3cd;color:#856404',
    'confirmed'  => 'background:#d4edda;color:#155724',
    'delivering' => 'background:#cce5ff;color:#004085',
    'delivered'  => 'background:#d1ecf1;color:#0c5460',
    'rejected'   => 'background:#f8d7da;color:#721c24',
    'cancelled'  => 'background:#f8d7da;color:#721c24',
];

mysqli_close($conn);

// Sort helper
function sort_url($col) {
    $cur_col = $_GET['sort'] ?? 'id';
    $cur_dir = $_GET['dir'] ?? 'asc';
    $new_dir = ($cur_col === $col && $cur_dir === 'asc') ? 'desc' : 'asc';
    return "view_order.php?sort=$col&dir=$new_dir";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Admin view of all order submissions.">
  <meta name="keywords" content="admin, orders, manage">
  <meta name="author" content="Cacti-Succulent Kuching Team">
  <title>All Orders | <?php echo $site_name; ?> Admin</title>
  <link rel="stylesheet" href="styles/style.css">
  <style>
    .admin-bar { background:#2c3e50;color:#fff;padding:0.7rem 2rem;display:flex;justify-content:space-between;align-items:center;font-size:0.9rem; }
    .admin-bar a { color:#aee6d8;text-decoration:none;margin-left:1.2rem; }
    .admin-bar a:hover { text-decoration:underline; }
    .summary-cards { display:flex;flex-wrap:wrap;gap:0.8rem;margin:1.5rem 0 2rem; }
    .summary-card { background:#f0f7f2;border:1.5px solid #aee6d8;border-radius:8px;padding:0.6rem 1.2rem;font-size:0.88rem;color:#2c7a50;font-weight:600; }
    .summary-card span { font-size:1.2rem;font-weight:800;margin-left:0.4rem; }
    .revenue-card { background:#2c3e50;color:#fff;border-radius:8px;padding:0.6rem 1.4rem;font-size:0.88rem;font-weight:600; }
    .revenue-card span { font-size:1.2rem;font-weight:800;margin-left:0.4rem;color:#aee6d8; }
    .group-heading { background:#2c3e50;color:#fff;padding:0.5rem 1rem;border-radius:6px 6px 0 0;font-size:0.95rem;font-weight:700;margin-top:1.5rem;display:flex;justify-content:space-between;align-items:center; }
    .group-heading .group-count { background:#aee6d8;color:#1a4a35;border-radius:12px;padding:2px 10px;font-size:0.82rem; }
    .items-list { font-size:0.78rem;line-height:1.6;max-width:200px; }
    .sbadge { padding:2px 8px;border-radius:4px;font-size:0.78rem;font-weight:600; }
    .btn-del-link { background:#c0392b;color:#fff;padding:3px 10px;border-radius:4px;text-decoration:none;font-size:0.78rem; }
    .btn-cancel-link { background:#e67e22;color:#fff;padding:3px 10px;border-radius:4px;text-decoration:none;font-size:0.78rem; }
    .btn-del-link:hover { background:#a93226; }
    .btn-cancel-link:hover { background:#ca6f1e; }
    .msg-ok  { background:#d4edda;border:2px solid #28a745;border-radius:6px;padding:0.8rem 1rem;margin-bottom:1rem;color:#155724;font-weight:600; }
    .msg-err { background:#f8d7da;border:2px solid #c0392b;border-radius:6px;padding:0.8rem 1rem;margin-bottom:1rem;color:#721c24;font-weight:600; }
    .sort-link { color:inherit;text-decoration:none;display:flex;align-items:center;gap:4px;white-space:nowrap; }
    .sort-link:hover { text-decoration:underline; }
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

  <main style="padding:2rem;">

    <div class="page-hero">
      <h1>All Order Submissions</h1>
      <p>Total records: <strong><?php echo $total; ?></strong> &mdash; grouped by status, sorted by <?php echo htmlspecialchars($sort_col); ?>.</p>
    </div>

    <?php if ($action_msg): ?>
      <?php [$mt, $mx] = explode(':', $action_msg, 2); ?>
      <div class="<?php echo $mt === 'success' ? 'msg-ok' : 'msg-err'; ?>">
        <?php echo $mt === 'success' ? '✅' : '⚠️'; ?> <?php echo htmlspecialchars($mx); ?>
      </div>
    <?php endif; ?>

    <?php if ($total === 0): ?>
      <p class="dash-empty">No orders in the database yet.</p>
    <?php else: ?>

      <!-- Summary -->
      <div class="summary-cards">
        <?php foreach ($status_totals as $st => $cnt): ?>
          <div class="summary-card"><?php echo ucfirst(htmlspecialchars($st)); ?><span><?php echo $cnt; ?></span></div>
        <?php endforeach; ?>
        <div class="revenue-card">Total Revenue<span>RM <?php echo number_format($grand_revenue, 2); ?></span></div>
      </div>

      <!-- Grouped by status -->
      <?php foreach ($grouped as $status => $rows): ?>
        <div class="group-heading">
          <span>🛒 <?php echo ucfirst(htmlspecialchars($status)); ?></span>
          <span class="group-count"><?php echo count($rows); ?> order<?php echo count($rows) === 1 ? '' : 's'; ?></span>
        </div>
        <div class="dash-table-wrap" style="margin-bottom:0.5rem;">
          <table class="dash-table">
            <thead>
              <tr>
                <th><a href="<?php echo sort_url('id'); ?>" class="sort-link">#</a></th>
                <th><a href="<?php echo sort_url('fname'); ?>" class="sort-link">Name</a></th>
                <th>Email</th>
                <th>Phone</th>
                <th>Items</th>
                <th>Delivery</th>
                <th><a href="<?php echo sort_url('preferred_date'); ?>" class="sort-link">Date</a></th>
                <th>Address</th>
                <th>Payment</th>
                <th><a href="<?php echo sort_url('grand_total'); ?>" class="sort-link">Total (RM)</a></th>
                <th>Notes</th>
                <th><a href="<?php echo sort_url('status'); ?>" class="sort-link">Status</a></th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($rows as $row):
                $items_arr = json_decode($row['items'] ?? '[]', true);
                $items_text = '';
                if (is_array($items_arr)) {
                    foreach ($items_arr as $item) {
                        $items_text .= htmlspecialchars($item['name']) . ' &times;' . (int)$item['qty'] . ' (RM ' . number_format((float)$item['total'], 2) . ')<br>';
                    }
                }
                $st = $row['status'] ?? 'pending';
                $sc = $status_colors[$st] ?? 'background:#e2e3e5;color:#333';
              ?>
              <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo htmlspecialchars($row['fname'] . ' ' . $row['lname']); ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td><?php echo htmlspecialchars($row['phone']); ?></td>
                <td class="items-list"><?php echo $items_text ?: '&mdash;'; ?></td>
                <td><?php echo htmlspecialchars($row['delivery_mode']); ?></td>
                <td style="white-space:nowrap;"><?php echo htmlspecialchars($row['preferred_date']); ?></td>
                <td><?php echo $row['delivery_address'] ? htmlspecialchars($row['delivery_address']) : '&mdash;'; ?></td>
                <td><?php echo htmlspecialchars($row['payment_mode']); ?></td>
                <td><strong>RM <?php echo number_format((float)$row['grand_total'], 2); ?></strong></td>
                <td style="font-size:0.78rem;"><?php echo $row['special_notes'] ? htmlspecialchars($row['special_notes']) : '&mdash;'; ?></td>
                <td><span class="sbadge" style="<?php echo $sc; ?>"><?php echo ucfirst(htmlspecialchars($st)); ?></span></td>
                <td style="white-space:nowrap;display:flex;gap:4px;flex-wrap:wrap;">
                  <?php if ($st !== 'cancelled'): ?>
                    <a href="view_order.php?cancel_id=<?php echo $row['id']; ?>&sort=<?php echo $sort_col; ?>&dir=<?php echo $sort_dir === 'DESC' ? 'desc' : 'asc'; ?>"
                       class="btn-cancel-link"
                       onclick="return confirm('Cancel Order #<?php echo $row['id']; ?>?');">Cancel</a>
                  <?php endif; ?>
                  <a href="view_order.php?delete_id=<?php echo $row['id']; ?>&sort=<?php echo $sort_col; ?>&dir=<?php echo $sort_dir === 'DESC' ? 'desc' : 'asc'; ?>"
                     class="btn-del-link"
                     onclick="return confirm('Permanently delete Order #<?php echo $row['id']; ?>? This cannot be undone.');">Delete</a>
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
