<?php

session_start();

// Redirect to login if not logged in, redirect to admin dashboard if admin
if (!isset($_SESSION['role'])) {
    header("Location: login.php");
    exit;
}
if ($_SESSION['role'] === 'admin') {
    header("Location: dashboard.php");
    exit;
}

$site_name    = "Cacti-Succulent Kuching";
$current_year = 2026;
$nav_active   = "user_dashboard";

require_once("connection.php");

// Make sure status column exists on orders
mysqli_query($conn, "ALTER TABLE orders ADD COLUMN IF NOT EXISTS `status` VARCHAR(20) NOT NULL DEFAULT 'pending'");

$msg = "";
$active_section = $_GET['section'] ?? 'profile';

// UPDATE PROFILE 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update_profile') {
    $uid      = (int)$_SESSION['uid'];
    $fname    = mysqli_real_escape_string($conn, trim($_POST['fname']    ?? ''));
    $lname    = mysqli_real_escape_string($conn, trim($_POST['lname']    ?? ''));
    $email    = mysqli_real_escape_string($conn, trim($_POST['email']    ?? ''));
    $phone    = mysqli_real_escape_string($conn, trim($_POST['phone']    ?? ''));
    $street   = mysqli_real_escape_string($conn, trim($_POST['street']   ?? ''));
    $city     = mysqli_real_escape_string($conn, trim($_POST['city']     ?? ''));
    $state    = mysqli_real_escape_string($conn, trim($_POST['state']    ?? ''));
    $postcode = mysqli_real_escape_string($conn, trim($_POST['postcode'] ?? ''));

    $errs = [];
    if (empty($fname)) $errs[] = "First name required.";
    if (empty($lname)) $errs[] = "Last name required.";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errs[] = "Valid email required.";
    if (!preg_match('/^[0-9]{8,10}$/', $phone)) $errs[] = "Phone must be 8–10 digits.";
    if (empty($street)) $errs[] = "Street required.";
    if (empty($city))   $errs[] = "City required.";
    if (empty($state))  $errs[] = "State required.";
    if (!preg_match('/^\d{5}$/', $postcode)) $errs[] = "Postcode must be 5 digits.";

    if (empty($errs)) {
        mysqli_query($conn, "UPDATE `user` SET fname='$fname',lname='$lname',email='$email',
            phone='$phone',street='$street',city='$city',state='$state',postcode='$postcode'
            WHERE id=$uid");
        $_SESSION['name'] = $fname . ' ' . $lname;
        $msg = "ok:Profile updated successfully.";
    } else {
        $msg = "err:" . implode(' ', $errs);
    }
    $active_section = 'profile';
}

// CHANGE PASSWORD
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'change_password') {
    $uid       = (int)$_SESSION['uid'];
    $curr_pass = trim($_POST['current_password'] ?? '');
    $new_pass  = trim($_POST['new_password']     ?? '');
    $conf_pass = trim($_POST['confirm_password'] ?? '');

    // Verify current password
    $prow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT password FROM `user` WHERE id=$uid"));
    $errs = [];

    if (strtolower($prow['password'] ?? '') !== strtolower($curr_pass)) {
        $errs[] = "Current password is incorrect.";
    }
    if (strlen($new_pass) < 6) {
        $errs[] = "New password must be at least 6 characters.";
    }
    if ($new_pass !== $conf_pass) {
        $errs[] = "New passwords do not match.";
    }

    if (empty($errs)) {
        $safe_pass = mysqli_real_escape_string($conn, $new_pass);
        mysqli_query($conn, "UPDATE `user` SET password='$safe_pass' WHERE id=$uid");
        $msg = "ok:Password changed successfully.";
    } else {
        $msg = "err:" . implode(' ', $errs);
    }
    $active_section = 'password';
}

// LOAD USER DATA 
// Store uid in session on login — gracefully handle if not set
if (!isset($_SESSION['uid'])) {
    $urow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `user` WHERE username='" . mysqli_real_escape_string($conn, $_SESSION['username']) . "'"));
    if ($urow) { $_SESSION['uid'] = $urow['id']; }
}
$uid  = (int)($_SESSION['uid'] ?? 0);
$user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `user` WHERE id=$uid"));

// LOAD ORDERS
$orders = [];
if ($active_section === 'orders' && $user) {
    $email_safe = mysqli_real_escape_string($conn, $user['email']);
    $ord_res = mysqli_query($conn, "SELECT * FROM orders WHERE email='$email_safe' ORDER BY id DESC");
    while ($r = mysqli_fetch_assoc($ord_res)) { $orders[] = $r; }
}

mysqli_close($conn);

$status_colors = [
    'pending'    => 'background:#fff3cd;color:#856404',
    'confirmed'  => 'background:#d4edda;color:#155724',
    'delivering' => 'background:#cce5ff;color:#004085',
    'delivered'  => 'background:#d1ecf1;color:#0c5460',
    'rejected'   => 'background:#f8d7da;color:#721c24',
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Account | <?php echo $site_name; ?></title>
  <link rel="stylesheet" href="styles/style.css">
</head>
<body>

  <div id="top"></div>
  <?php include('header.inc'); ?>

  <main>
    <div class="page-hero">
      <h1>My Account</h1>
      <p>Welcome back, <strong><?php echo htmlspecialchars($user['fname'] ?? $_SESSION['username']); ?></strong>! Manage your profile and view your orders.</p>
    </div>

    <div class="udash-wrap">
      <div class="udash-grid">

        <!-- Sidebar -->
        <aside class="udash-sidebar">
          <div class="udash-profile-top">
            <div class="avatar">🌵</div>
            <div class="udash-fname"><?php echo htmlspecialchars(($user['fname'] ?? '') . ' ' . ($user['lname'] ?? '')); ?></div>
            <div class="udash-uname">@<?php echo htmlspecialchars($user['username'] ?? ''); ?></div>
          </div>
          <ul class="udash-nav">
            <li><a href="user_dashboard.php?section=profile"  class="<?php echo $active_section==='profile' ?'active':''; ?>">My<br>Profile</a></li>
            <li><a href="user_dashboard.php?section=orders"   class="<?php echo $active_section==='orders'  ?'active':''; ?>">My<br>Orders</a></li>
            <li><a href="user_dashboard.php?section=password" class="<?php echo $active_section==='password'?'active':''; ?>">Change<br>Password</a></li>
            <li><a href="logout.php">Log<br>Out</a></li>
          </ul>
        </aside>

        <!-- Main panel -->
        <div class="udash-panel">

          <?php if ($msg): ?>
            <?php [$mtype, $mtext] = explode(':', $msg, 2); ?>
            <div class="<?php echo $mtype==='ok' ? 'udash-msg-ok' : 'udash-msg-err'; ?>">
              <?php echo $mtype==='ok' ? '✅' : '⚠️'; ?> <?php echo htmlspecialchars($mtext); ?>
            </div>
          <?php endif; ?>

          <!-- ── PROFILE SECTION ── -->
          <?php if ($active_section === 'profile'): ?>
            <h2>👤 My Profile</h2>
            <form method="post" action="user_dashboard.php?section=profile">
              <input type="hidden" name="action" value="update_profile">
              <div class="udash-2col">
                <div class="udash-field">
                  <label>First Name</label>
                  <input type="text" name="fname" value="<?php echo htmlspecialchars($user['fname'] ?? ''); ?>" required>
                </div>
                <div class="udash-field">
                  <label>Last Name</label>
                  <input type="text" name="lname" value="<?php echo htmlspecialchars($user['lname'] ?? ''); ?>" required>
                </div>
              </div>
              <div class="udash-field">
                <label>Email Address</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($user['email'] ?? ''); ?>" required>
              </div>
              <div class="udash-field">
                <label>Phone Number</label>
                <input type="text" name="phone" value="<?php echo htmlspecialchars($user['phone'] ?? ''); ?>" required>
              </div>
              <div class="udash-field">
                <label>Street Address</label>
                <input type="text" name="street" value="<?php echo htmlspecialchars($user['street'] ?? ''); ?>" required>
              </div>
              <div class="udash-2col">
                <div class="udash-field">
                  <label>City</label>
                  <input type="text" name="city" value="<?php echo htmlspecialchars($user['city'] ?? ''); ?>" required>
                </div>
                <div class="udash-field">
                  <label>State</label>
                  <input type="text" name="state" value="<?php echo htmlspecialchars($user['state'] ?? ''); ?>" required>
                </div>
              </div>
              <div class="udash-field" style="max-width:180px;">
                <label>Postcode</label>
                <input type="text" name="postcode" maxlength="5" value="<?php echo htmlspecialchars($user['postcode'] ?? ''); ?>" required>
              </div>
              <div class="udash-field" style="margin-top:0.5rem;">
                <label>Username <span style="font-size:0.78rem;color:#999;">(cannot be changed)</span></label>
                <input type="text" value="<?php echo htmlspecialchars($user['username'] ?? ''); ?>" disabled style="background:#f5f5f5;color:#999;">
              </div>
              <button type="submit" class="btn-submit" style="margin-top:0.5rem;padding:0.55rem 1.6rem;">💾 Save Changes</button>
            </form>

          <!-- ── ORDERS SECTION ── -->
          <?php elseif ($active_section === 'orders'): ?>
            <h2>🛒 My Orders</h2>
            <?php if (empty($orders)): ?>
              <p style="color:#888;">You haven't placed any orders yet. <a href="order.php" style="color:var(--green-dark);">Place your first order →</a></p>
            <?php else: ?>
              <?php foreach ($orders as $ord):
                $items_arr  = json_decode($ord['items'] ?? '[]', true);
                $cur_status = $ord['status'] ?? 'pending';
                $sc         = $status_colors[$cur_status] ?? 'background:#e2e3e5;color:#333';
              ?>
              <div style="border:1px solid var(--green-light);border-radius:8px;padding:1rem 1.2rem;margin-bottom:1.2rem;">
                <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:0.5rem;margin-bottom:0.7rem;">
                  <strong style="color:var(--green-dark);">Order #<?php echo $ord['id']; ?></strong>
                  <span style="<?php echo $sc; ?>;padding:3px 12px;border-radius:12px;font-size:0.8rem;font-weight:600;">
                    <?php echo ucfirst($cur_status); ?>
                  </span>
                </div>
                <div style="font-size:0.85rem;color:#666;margin-bottom:0.6rem;">
                  📅 <?php echo htmlspecialchars($ord['preferred_date']); ?> &nbsp;|&nbsp;
                  🚚 <?php echo htmlspecialchars($ord['delivery_mode']); ?> &nbsp;|&nbsp;
                  💳 <?php echo htmlspecialchars($ord['payment_mode']); ?>
                </div>
                <?php if (is_array($items_arr) && count($items_arr)): ?>
                  <ul style="margin:0 0 0.6rem;padding-left:1.2rem;font-size:0.88rem;line-height:1.9;">
                    <?php foreach ($items_arr as $item): ?>
                      <li>
                        <strong><?php echo htmlspecialchars($item['name']); ?></strong>
                        &times;<?php echo (int)$item['qty']; ?>
                        <span style="color:var(--green-dark);">— RM <?php echo number_format((float)$item['total'], 2); ?></span>
                      </li>
                    <?php endforeach; ?>
                  </ul>
                <?php endif; ?>
                <div style="text-align:right;font-weight:700;color:var(--green-dark);">
                  Total: RM <?php echo number_format((float)$ord['grand_total'], 2); ?>
                </div>
              </div>
              <?php endforeach; ?>
            <?php endif; ?>

          <!-- ── CHANGE PASSWORD SECTION ── -->
          <?php elseif ($active_section === 'password'): ?>
            <h2>🔒 Change Password</h2>
            <form method="post" action="user_dashboard.php?section=password" style="max-width:420px;">
              <input type="hidden" name="action" value="change_password">
              <div class="udash-field">
                <label>Current Password</label>
                <input type="password" name="current_password" required autocomplete="current-password">
              </div>
              <div class="udash-field">
                <label>New Password <span style="font-size:0.78rem;color:#999;">(min 6 characters)</span></label>
                <input type="password" name="new_password" required minlength="6" autocomplete="new-password">
              </div>
              <div class="udash-field">
                <label>Confirm New Password</label>
                <input type="password" name="confirm_password" required autocomplete="new-password">
              </div>
              <button type="submit" class="btn-submit" style="margin-top:0.5rem;padding:0.55rem 1.6rem;">🔒 Update Password</button>
            </form>
          <?php endif; ?>

        </div><!-- /udash-panel -->
      </div><!-- /udash-grid -->
    </div><!-- /udash-wrap -->
  </main>

  <?php include('footer.inc'); ?>
</body>
</html>
