<?php

session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$site_name    = "Cacti-Succulent Kuching";
$current_year = 2026;
$nav_active   = "dashboard";

require_once("connection.php");

// Ensure status column on orders
mysqli_query($conn, "ALTER TABLE orders ADD COLUMN IF NOT EXISTS `status` VARCHAR(20) NOT NULL DEFAULT 'pending'");

// Ensure products table exists
mysqli_query($conn, "CREATE TABLE IF NOT EXISTS products (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    category VARCHAR(30) NOT NULL,
    slug VARCHAR(50) NOT NULL UNIQUE,
    name VARCHAR(100) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    description TEXT,
    image VARCHAR(100)
)");

$categories   = ['cacti'=>'🌵 Cacti','succulents'=>'🌱 Succulents','pots'=>'🪴 Pots & Planters','accessories'=>'🧰 Accessories'];
$statuses     = ['pending','confirmed','delivering','delivered','rejected'];
$status_colors = [
    'pending'    => 'background:#fff3cd;color:#856404',
    'confirmed'  => 'background:#d4edda;color:#155724',
    'delivering' => 'background:#cce5ff;color:#004085',
    'delivered'  => 'background:#d1ecf1;color:#0c5460',
    'rejected'   => 'background:#f8d7da;color:#721c24',
];

$msg = "";

// ---- PRODUCT ACTIONS ----
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['prod_action'])) {
    $pa = $_POST['prod_action'];
    if ($pa === 'add' || $pa === 'edit') {
        $pname  = mysqli_real_escape_string($conn, trim($_POST['pname']  ?? ''));
        $pcat   = mysqli_real_escape_string($conn, trim($_POST['pcat']   ?? ''));
        $pprice = (float)($_POST['pprice'] ?? 0);
        $pdesc  = mysqli_real_escape_string($conn, trim($_POST['pdesc']  ?? ''));
        $pimg   = mysqli_real_escape_string($conn, trim($_POST['pimg']   ?? ''));
        if (empty($pname) || empty($pcat) || $pprice <= 0) {
            $msg = "error:Name, category and a valid price are required.";
        } elseif ($pa === 'add') {
            $slug = strtolower(preg_replace('/[^a-z0-9]+/i', '_', $pname));
            if (mysqli_fetch_assoc(mysqli_query($conn, "SELECT id FROM products WHERE slug='" . mysqli_real_escape_string($conn,$slug) . "'"))) { $slug .= '_' . time(); }
            $slug = mysqli_real_escape_string($conn, $slug);
            mysqli_query($conn, "INSERT INTO products(category,slug,name,price,description,image) VALUES('$pcat','$slug','$pname',$pprice,'$pdesc','$pimg')");
            $msg = "success:Product \"$pname\" added.";
        } else {
            $pid = (int)($_POST['pid'] ?? 0);
            mysqli_query($conn, "UPDATE products SET name='$pname',category='$pcat',price=$pprice,description='$pdesc',image='$pimg' WHERE id=$pid");
            $msg = "success:Product updated.";
        }
    } elseif ($pa === 'delete') {
        $pid  = (int)($_POST['pid'] ?? 0);
        $prow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT name FROM products WHERE id=$pid"));
        if ($prow) { mysqli_query($conn, "DELETE FROM products WHERE id=$pid"); $msg = "success:\"" . htmlspecialchars($prow['name']) . "\" deleted."; }
        else { $msg = "error:Product not found."; }
    }
}

// ---- ORDER STATUS UPDATE ----
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_status_id'])) {
    $osid  = (int)$_POST['order_status_id'];
    $ostat = mysqli_real_escape_string($conn, $_POST['order_status'] ?? 'pending');
    if (in_array($ostat, $statuses)) {
        mysqli_query($conn, "UPDATE orders SET `status`='$ostat' WHERE id=$osid");
        $msg = "success:Order #$osid updated to \"" . ucfirst($ostat) . "\".";
    }
}

// ---- USER DELETE ----
if (isset($_GET['delete_uid']) && is_numeric($_GET['delete_uid'])) {
    $duid = (int)$_GET['delete_uid'];
    $urow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT username,role FROM `user` WHERE id=$duid"));
    if ($urow && $urow['username'] === $_SESSION['username']) {
        $msg = "error:Cannot delete your own account.";
    } elseif ($urow && $urow['role'] === 'admin') {
        $ac = (int)mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM `user` WHERE role='admin'"))['c'];
        if ($ac <= 1) { $msg = "error:Cannot delete the last admin."; }
        else { mysqli_query($conn, "DELETE FROM `user` WHERE id=$duid"); $msg = "success:Admin user deleted."; }
    } elseif ($urow) {
        mysqli_query($conn, "DELETE FROM `user` WHERE id=$duid");
        $msg = "success:User deleted.";
    }
}

// ---- ACTIVE TAB ----
$active_tab = isset($_GET['tab']) ? htmlspecialchars($_GET['tab']) : 'enquiries';

// ---- PRODUCT FILTER ----
$pf_cat    = trim($_GET['pf_cat']    ?? 'all');
$pf_search = trim($_GET['pf_search'] ?? '');
$p_where   = [];
if ($pf_cat !== 'all' && $pf_cat !== '') { $sc = mysqli_real_escape_string($conn,$pf_cat); $p_where[] = "category='$sc'"; }
if ($pf_search !== '') { $ss = mysqli_real_escape_string($conn,$pf_search); $p_where[] = "(name LIKE '%$ss%' OR description LIKE '%$ss%')"; }
$p_where_sql = $p_where ? "WHERE " . implode(" AND ", $p_where) : "";

// ---- COUNTS ----
$total_enquiries = (int)mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM enquiry"))['c'];
$total_users     = (int)mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM `user`"))['c'];
$total_orders    = (int)mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM orders"))['c'];
$total_products  = (int)mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM products"))['c'];
$total_registers = $total_users;
$rev_row         = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(grand_total) AS t FROM orders"));
$total_revenue   = $rev_row['t'] ? (float)$rev_row['t'] : 0;

// ---- FETCH DATA ----
$enq_rows = $usr_rows = $ord_rows = $prod_rows = $reg_rows = [];
if ($active_tab === 'enquiries') {
    $r = mysqli_query($conn, "SELECT * FROM enquiry ORDER BY id DESC");
    while ($row = mysqli_fetch_assoc($r)) { $enq_rows[] = $row; }
}
if ($active_tab === 'users') {
    // Only show registered users (not admin accounts — those are in the admin table)
    $r = mysqli_query($conn, "SELECT * FROM `user` WHERE role='user' ORDER BY id DESC");
    while ($row = mysqli_fetch_assoc($r)) { $usr_rows[] = $row; }
}
if ($active_tab === 'orders') {
    $r = mysqli_query($conn, "SELECT * FROM orders ORDER BY id DESC");
    while ($row = mysqli_fetch_assoc($r)) { $ord_rows[] = $row; }
}
if ($active_tab === 'registers') {
    $r = mysqli_query($conn, "SELECT * FROM `user` ORDER BY id DESC");
    while ($row = mysqli_fetch_assoc($r)) { $reg_rows[] = $row; }
}
if ($active_tab === 'products') {
    $r = mysqli_query($conn, "SELECT * FROM products $p_where_sql ORDER BY category, name ASC");
    while ($row = mysqli_fetch_assoc($r)) { $prod_rows[] = $row; }
}

// Edit product target
$edit_prod = null;
if ($active_tab === 'products' && isset($_GET['edit_pid']) && is_numeric($_GET['edit_pid'])) {
    $edit_prod = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM products WHERE id=" . (int)$_GET['edit_pid']));
}

mysqli_close($conn);

$login_msg = "";
if (isset($_SESSION['login_success'])) { $login_msg = $_SESSION['login_success']; unset($_SESSION['login_success']); }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard | <?php echo $site_name; ?></title>
  <link rel="stylesheet" href="styles/style.css">
  <style>
    /* ── Tab overrides ── */
    .dash-tabs        { gap: 0; border-bottom: 2px solid var(--green-light); }
    .dash-tab         { font-size: 0.92rem; padding: 0.75rem 1.4rem; border-radius: 8px 8px 0 0; margin-bottom: -2px; }
    .dash-tab-active  { font-weight: 700; border-bottom: 2px solid #fff; background: #fff; }

    /* ── "View All" highlight ── */
    .view-all-link {
      font-size: 1.05rem;
      font-weight: 800;
      color: var(--green-dark);
      background: var(--green-light);
      padding: 5px 16px;
      border-radius: 20px;
      text-decoration: none;
      border: 2px solid var(--green);
      letter-spacing: 0.01em;
    }
    .view-all-link:hover { background: var(--green); color: #fff; }

    /* ── Product form ── */
    .prod-form-panel { background:#f5faf7;border:1.5px solid var(--green-light);border-radius:10px;padding:1.4rem 1.8rem;margin-bottom:1.5rem; }
    .prod-form-panel h3 { margin:0 0 1rem;color:var(--green-dark);font-size:1rem; }
    .pf-grid { display:grid;grid-template-columns:1fr 1fr 1fr;gap:0.8rem; }
    .pf-grid .full { grid-column:1/-1; }
    .pf-fg label { display:block;font-size:0.83rem;font-weight:600;margin-bottom:0.25rem;color:#333; }
    .pf-fg input,.pf-fg select,.pf-fg textarea {
      width:100%;padding:0.48rem 0.75rem;border:1px solid #ccc;border-radius:6px;
      font-size:0.88rem;box-sizing:border-box;font-family:'Jost',sans-serif; }
    .pf-fg textarea { height:65px;resize:vertical; }
    .pf-actions { display:flex;gap:0.7rem;margin-top:0.8rem;flex-wrap:wrap;align-items:center; }

    /* ── Filter bar ── */
    .filter-bar { display:flex;gap:0.7rem;flex-wrap:wrap;align-items:center;margin-bottom:1.2rem;
                  background:#f0f7f2;padding:0.8rem 1.2rem;border-radius:8px;border:1px solid var(--green-light); }
    .filter-bar input,.filter-bar select { padding:0.45rem 0.75rem;border:1px solid #ccc;border-radius:6px;font-size:0.88rem;font-family:'Jost',sans-serif; }
    .filter-bar input { flex:1;min-width:160px; }
    .filter-bar button { padding:0.45rem 1.1rem;background:var(--green-dark);color:#fff;border:none;border-radius:6px;cursor:pointer;font-size:0.88rem; }
    .filter-bar a.clear { font-size:0.82rem;color:#888;text-decoration:none; }
    .filter-bar a.clear:hover { color:#c0392b; }

    /* ── Order status dropdown ── */
    .status-form { display:flex;gap:4px;align-items:center; }
    .status-form select { padding:4px 7px;border:1px solid #ccc;border-radius:5px;font-size:0.78rem;font-family:'Jost',sans-serif; }
    .status-form button { padding:4px 9px;background:var(--green-dark);color:#fff;border:none;border-radius:5px;font-size:0.78rem;cursor:pointer; }
    .status-form button:hover { background:var(--green); }

    /* ── Items list line-by-line ── */
    .order-items { margin:0;padding:0;list-style:none;font-size:0.8rem;line-height:1; }
    .order-items li {
      display:flex;justify-content:space-between;gap:0.5rem;
      padding:4px 0;border-bottom:1px dotted #e0e0e0;
    }
    .order-items li:last-child { border:none; }
    .order-items .iname { color:var(--text-dark);font-weight:600; }
    .order-items .iqty  { color:#888; }
    .order-items .iprice { color:var(--green-dark);font-weight:600;white-space:nowrap; }

    /* ── Status badge ── */
    .sbadge { padding:3px 10px;border-radius:12px;font-size:0.75rem;font-weight:600;white-space:nowrap;display:inline-block; }

    /* ── Buttons ── */
    .btn-del-sm  { padding:3px 10px;background:#c0392b;color:#fff;border-radius:4px;text-decoration:none;font-size:0.76rem;border:none;cursor:pointer; }
    .btn-edit-sm { padding:3px 10px;background:#2980b9;color:#fff;border-radius:4px;text-decoration:none;font-size:0.76rem; }
    .btn-add-prod { padding:0.45rem 1.1rem;background:var(--green);color:#fff;border-radius:6px;text-decoration:none;font-size:0.88rem;font-weight:600; }
    .btn-add-prod:hover { background:var(--green-dark); }
    .dash-section h2 { font-size:1.25rem;display:flex;align-items:center;gap:0.9rem;flex-wrap:wrap; }

    /* ── Message ── */
    .dash-msg-ok  { background:#d4edda;border:1.5px solid #28a745;border-radius:6px;padding:0.7rem 1rem;margin-bottom:1rem;color:#155724;font-weight:600; }
    .dash-msg-err { background:#f8d7da;border:1.5px solid #c0392b;border-radius:6px;padding:0.7rem 1rem;margin-bottom:1rem;color:#721c24;font-weight:600; }

    @media(max-width:700px){ .pf-grid { grid-template-columns:1fr 1fr; } }
    @media(max-width:500px){ .pf-grid { grid-template-columns:1fr; } }
  </style>
</head>
<body>

  <div id="top"></div>

  <?php if ($login_msg): ?>
  <div style="background:#d4edda;border-bottom:2px solid #28a745;padding:0.85rem 2rem;text-align:center;font-weight:600;color:#155724;">
    ✅ <?php echo htmlspecialchars($login_msg); ?>
  </div>
  <?php endif; ?>

  <?php include('header.inc'); ?>

  <main>

    <!-- Hero -->
    <div class="page-hero" style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:1rem;">
      <div>
        <h1>Admin Dashboard</h1>
        <p>Logged in as <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong> &mdash; Manage all website data.</p>
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
        <div class="dash-card-icon">👥</div>
        <div class="dash-card-body">
          <span class="dash-card-label">Users</span>
          <span class="dash-card-number"><?php echo $total_users; ?></span>
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
        <div class="dash-card-icon">🌵</div>
        <div class="dash-card-body">
          <span class="dash-card-label">Products</span>
          <span class="dash-card-number"><?php echo $total_products; ?></span>
        </div>
      </div>
      <div class="dash-card" style="background:#0891b2;">
        <div class="dash-card-icon">💰</div>
        <div class="dash-card-body">
          <span class="dash-card-label">Revenue</span>
          <span class="dash-card-number">RM <?php echo number_format($total_revenue, 2); ?></span>
        </div>
      </div>
    </div>

    <!-- 5 Tabs -->
    <div class="dash-tabs">
      <?php
      $tabs = [
        'enquiries' => ['✉️', 'Enquiries',  $total_enquiries],
        'registers' => ['📋', 'Registers',  $total_registers],
        'orders'    => ['🛒', 'Orders',     $total_orders],
        'users'     => ['👥', 'Users',      $total_users],
        'products'  => ['🌵', 'Products',   $total_products],
      ];
      foreach ($tabs as $key => [$icon, $label, $count]):
      ?>
      <a href="dashboard.php?tab=<?php echo $key; ?>"
         class="dash-tab <?php echo $active_tab===$key?'dash-tab-active':''; ?>">
        <?php echo $icon; ?> <?php echo $label; ?> (<?php echo $count; ?>)
      </a>
      <?php endforeach; ?>
    </div>

    <!-- Global message -->
    <?php if ($msg): ?>
      <?php [$mt,$mx] = explode(':',$msg,2); ?>
      <div class="<?php echo $mt==='success'?'dash-msg-ok':'dash-msg-err'; ?>" style="margin:1rem 2rem 0;">
        <?php echo $mt==='success'?'✅':'⚠️'; ?> <?php echo htmlspecialchars($mx); ?>
      </div>
    <?php endif; ?>

    <!-- ENQUIRIES TAB -->
    <?php if ($active_tab === 'enquiries'): ?>
    <div class="dash-section">
      <h2>
        All Enquiries
        <a href="view_enquiry.php" class="view-all-link">View All →</a>
      </h2>
      <?php if (empty($enq_rows)): ?>
        <p class="dash-empty">No enquiries yet.</p>
      <?php else: ?>
        <div class="dash-table-wrap">
          <table class="dash-table">
            <thead><tr><th>#</th><th>Name</th><th>Email</th><th>Phone</th><th>Topic</th><th>Comments</th></tr></thead>
            <tbody>
              <?php foreach ($enq_rows as $row): ?>
              <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo htmlspecialchars($row['fname'].' '.$row['lname']); ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td><?php echo htmlspecialchars($row['phone']); ?></td>
                <td><?php echo htmlspecialchars($row['enquiry_type']); ?></td>
                <td><?php echo $row['comments'] ? htmlspecialchars($row['comments']) : '—'; ?></td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      <?php endif; ?>
    </div>

    <!--REGISTERS TAB-->
    <?php elseif ($active_tab === 'registers'): ?>
    <div class="dash-section">
      <h2>
        All Registers
        <a href="view_register.php" class="view-all-link">View All →</a>
      </h2>
      <?php if (empty($reg_rows)): ?>
        <p class="dash-empty">No registrations yet.</p>
      <?php else: ?>
        <div class="dash-table-wrap">
          <table class="dash-table">
            <thead><tr><th>#</th><th>Name</th><th>Email</th><th>Phone</th><th>Username</th><th>City</th><th>State</th><th>Role</th></tr></thead>
            <tbody>
              <?php foreach ($reg_rows as $row): ?>
              <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo htmlspecialchars($row['fname'].' '.$row['lname']); ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td><?php echo htmlspecialchars($row['phone']); ?></td>
                <td><?php echo htmlspecialchars($row['username']); ?></td>
                <td><?php echo htmlspecialchars($row['city']); ?></td>
                <td><?php echo htmlspecialchars($row['state']); ?></td>
                <td><span class="sbadge" style="<?php echo $row['role']==='admin'?'background:#fff3cd;color:#856404':'background:#e2e3e5;color:#383d41'; ?>"><?php echo ucfirst($row['role']); ?></span></td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      <?php endif; ?>
    </div>

    <!-- ORDERS TAB -->
    <?php elseif ($active_tab === 'orders'): ?>
    <div class="dash-section">
      <h2>
        All Orders
        <a href="view_order.php" class="view-all-link">View All →</a>
      </h2>
      <?php if (empty($ord_rows)): ?>
        <p class="dash-empty">No orders yet.</p>
      <?php else: ?>
        <div class="dash-table-wrap">
          <table class="dash-table">
            <thead>
              <tr>
                <th>#</th><th>Customer</th><th>Contact</th>
                <th>Items Ordered</th>
                <th>Delivery</th><th>Date</th><th>Payment</th>
                <th>Total (RM)</th><th>Notes</th>
                <th>Status</th><th>Update</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($ord_rows as $row):
                $items_arr  = json_decode($row['items'] ?? '[]', true);
                $cur_status = $row['status'] ?? 'pending';
                $sc         = $status_colors[$cur_status] ?? 'background:#e2e3e5;color:#333';
              ?>
              <tr>
                <td><?php echo $row['id']; ?></td>
                <td>
                  <strong><?php echo htmlspecialchars($row['fname'].' '.$row['lname']); ?></strong>
                </td>
                <td style="font-size:0.8rem;">
                  <?php echo htmlspecialchars($row['email']); ?><br>
                  <?php echo htmlspecialchars($row['phone']); ?>
                </td>
                <td>
                  <?php if (is_array($items_arr) && count($items_arr)): ?>
                    <ul class="order-items">
                      <?php foreach ($items_arr as $item): ?>
                        <li>
                          <span class="iname"><?php echo htmlspecialchars($item['name']); ?></span>
                          <span class="iqty">&times;<?php echo (int)$item['qty']; ?></span>
                          <span class="iprice">RM <?php echo number_format((float)$item['total'],2); ?></span>
                        </li>
                      <?php endforeach; ?>
                    </ul>
                  <?php else: ?><span style="color:#aaa;">—</span><?php endif; ?>
                </td>
                <td><?php echo htmlspecialchars($row['delivery_mode']); ?></td>
                <td style="white-space:nowrap;"><?php echo htmlspecialchars($row['preferred_date']); ?></td>
                <td><?php echo htmlspecialchars($row['payment_mode']); ?></td>
                <td><strong>RM <?php echo number_format((float)$row['grand_total'],2); ?></strong></td>
                <td style="font-size:0.8rem;color:#666;"><?php echo $row['special_notes'] ? htmlspecialchars($row['special_notes']) : '—'; ?></td>
                <td><span class="sbadge" style="<?php echo $sc; ?>"><?php echo ucfirst($cur_status); ?></span></td>
                <td>
                  <form method="post" action="dashboard.php?tab=orders" class="status-form">
                    <input type="hidden" name="order_status_id" value="<?php echo $row['id']; ?>">
                    <select name="order_status">
                      <?php foreach ($statuses as $s): ?>
                        <option value="<?php echo $s; ?>" <?php echo $cur_status===$s?'selected':''; ?>><?php echo ucfirst($s); ?></option>
                      <?php endforeach; ?>
                    </select>
                    <button type="submit">✓</button>
                  </form>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      <?php endif; ?>
    </div>

    <!--USERS TAB -->
    <?php elseif ($active_tab === 'users'): ?>
    <div class="dash-section">
      <h2>
        Registered Users
        <a href="view_register.php" class="view-all-link">View All →</a>
        <a href="registration.php" class="btn-add-prod">➕ Add User</a>
      </h2>
      <?php if (empty($usr_rows)): ?>
        <p class="dash-empty">No registered users yet.</p>
      <?php else: ?>
        <div class="dash-table-wrap">
          <table class="dash-table">
            <thead><tr><th>#</th><th>Name</th><th>Email</th><th>Phone</th><th>Username</th><th>City</th><th>Actions</th></tr></thead>
            <tbody>
              <?php foreach ($usr_rows as $row): ?>
              <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo htmlspecialchars($row['fname'].' '.$row['lname']); ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td><?php echo htmlspecialchars($row['phone']); ?></td>
                <td><?php echo htmlspecialchars($row['username']); ?></td>
                <td><?php echo htmlspecialchars($row['city']); ?></td>
                <td style="white-space:nowrap;">
                  <a href="view_register.php?edit_id=<?php echo $row['id']; ?>#edit-form" class="btn-edit-sm">Edit</a>
                  <a href="dashboard.php?tab=users&delete_uid=<?php echo $row['id']; ?>"
                     class="btn-del-sm" style="margin-left:4px;"
                     onclick="return confirm('Delete user \'<?php echo htmlspecialchars($row['username']); ?>\'?')">Delete</a>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      <?php endif; ?>
    </div>

    <!-- PRODUCTS TAB-->
    <?php elseif ($active_tab === 'products'): ?>
    <div class="dash-section">
      <h2>Product Management</h2>

      <!-- Add / Edit form -->
      <div class="prod-form-panel" id="prod-form">
        <h3><?php echo $edit_prod ? '✏️ Edit: ' . htmlspecialchars($edit_prod['name']) : '➕ Add New Product'; ?></h3>
        <form method="post" action="dashboard.php?tab=products#prod-form">
          <input type="hidden" name="prod_action" value="<?php echo $edit_prod ? 'edit' : 'add'; ?>">
          <?php if ($edit_prod): ?>
            <input type="hidden" name="pid" value="<?php echo $edit_prod['id']; ?>">
          <?php endif; ?>
          <div class="pf-grid">
            <div class="pf-fg">
              <label>Product Name *</label>
              <input type="text" name="pname" required maxlength="100" value="<?php echo htmlspecialchars($edit_prod['name'] ?? ''); ?>">
            </div>
            <div class="pf-fg">
              <label>Category *</label>
              <select name="pcat" required>
                <option value="">-- Select --</option>
                <?php foreach ($categories as $k => $v): ?>
                  <option value="<?php echo $k; ?>" <?php echo (($edit_prod['category'] ?? '') === $k) ? 'selected' : ''; ?>><?php echo $v; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="pf-fg">
              <label>Price (RM) *</label>
              <input type="number" name="pprice" min="0.01" step="0.01" required value="<?php echo htmlspecialchars($edit_prod['price'] ?? ''); ?>">
            </div>
            <div class="pf-fg">
              <label>Image filename</label>
              <input type="text" name="pimg" placeholder="e.g. aloe.jpg" value="<?php echo htmlspecialchars($edit_prod['image'] ?? ''); ?>">
            </div>
            <div class="pf-fg full">
              <label>Description</label>
              <textarea name="pdesc"><?php echo htmlspecialchars($edit_prod['description'] ?? ''); ?></textarea>
            </div>
          </div>
          <div class="pf-actions">
            <button type="submit" class="btn-submit" style="padding:0.5rem 1.4rem;">
              <?php echo $edit_prod ? '💾 Save Changes' : '➕ Add Product'; ?>
            </button>
            <?php if ($edit_prod): ?>
              <a href="dashboard.php?tab=products" class="btn-reset" style="text-decoration:none;padding:0.5rem 1rem;">✕ Cancel</a>
            <?php endif; ?>
          </div>
        </form>
      </div>

      <!-- Filter bar -->
      <form method="get" action="dashboard.php">
        <input type="hidden" name="tab" value="products">
        <div class="filter-bar">
          <input type="text" name="pf_search" placeholder="Search products…" value="<?php echo htmlspecialchars($pf_search); ?>">
          <select name="pf_cat">
            <option value="all" <?php echo $pf_cat==='all'?'selected':''; ?>>All Categories</option>
            <?php foreach ($categories as $k => $v): ?>
              <option value="<?php echo $k; ?>" <?php echo $pf_cat===$k?'selected':''; ?>><?php echo $v; ?></option>
            <?php endforeach; ?>
          </select>
          <button type="submit">Filter</button>
          <?php if ($pf_search !== '' || $pf_cat !== 'all'): ?>
            <a href="dashboard.php?tab=products" class="clear">✕ Clear</a>
          <?php endif; ?>
          <span style="font-size:0.83rem;color:#666;"><?php echo count($prod_rows); ?> product(s)</span>
        </div>
      </form>

      <!-- Products table -->
      <?php if (empty($prod_rows)): ?>
        <p class="dash-empty">No products found. Add one above.</p>
      <?php else: ?>
        <div class="dash-table-wrap">
          <table class="dash-table">
            <thead>
              <tr><th>#</th><th>Image</th><th>Name</th><th>Category</th><th>Price (RM)</th><th>Description</th><th>Actions</th></tr>
            </thead>
            <tbody>
              <?php foreach ($prod_rows as $p): ?>
              <tr>
                <td><?php echo $p['id']; ?></td>
                <td>
                  <?php if ($p['image']): ?>
                    <img src="images/<?php echo htmlspecialchars($p['image']); ?>"
                         style="width:48px;height:42px;object-fit:cover;border-radius:5px;"
                         onerror="this.style.display='none'" alt="">
                  <?php else: ?>—<?php endif; ?>
                </td>
                <td><strong><?php echo htmlspecialchars($p['name']); ?></strong></td>
                <td><span class="sbadge" style="background:#e0f0e8;color:#2c7a50;"><?php echo htmlspecialchars($categories[$p['category']] ?? $p['category']); ?></span></td>
                <td>RM <?php echo number_format((float)$p['price'], 2); ?></td>
                <td style="font-size:0.78rem;max-width:200px;color:#555;"><?php echo htmlspecialchars(substr($p['description'] ?? '', 0, 80)) . (strlen($p['description'] ?? '') > 80 ? '…' : ''); ?></td>
                <td style="white-space:nowrap;">
                  <a href="dashboard.php?tab=products&edit_pid=<?php echo $p['id']; ?>#prod-form" class="btn-edit-sm">Edit</a>
                  <form method="post" action="dashboard.php?tab=products" style="display:inline;"
                        onsubmit="return confirm('Delete \'<?php echo htmlspecialchars($p['name']); ?>\'?')">
                    <input type="hidden" name="prod_action" value="delete">
                    <input type="hidden" name="pid" value="<?php echo $p['id']; ?>">
                    <button type="submit" class="btn-del-sm" style="margin-left:4px;">Delete</button>
                  </form>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      <?php endif; ?>
    </div>
    <?php endif; ?>

  </main>
  <?php include('footer.inc'); ?>

</body>
</html>
