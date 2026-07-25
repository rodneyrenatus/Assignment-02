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
if (!$conn) {
}

$action_msg = "";

// EDIT USER (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_id'])) {
    $edit_id  = (int)$_POST['edit_id'];
    $fname    = mysqli_real_escape_string($conn, trim($_POST['fname']    ?? ''));
    $lname    = mysqli_real_escape_string($conn, trim($_POST['lname']    ?? ''));
    $email    = mysqli_real_escape_string($conn, trim($_POST['email']    ?? ''));
    $phone    = mysqli_real_escape_string($conn, trim($_POST['phone']    ?? ''));
    $street   = mysqli_real_escape_string($conn, trim($_POST['street']   ?? ''));
    $city     = mysqli_real_escape_string($conn, trim($_POST['city']     ?? ''));
    $state    = mysqli_real_escape_string($conn, trim($_POST['state']    ?? ''));
    $postcode = mysqli_real_escape_string($conn, trim($_POST['postcode'] ?? ''));
    $role     = in_array($_POST['role'] ?? '', ['admin','user']) ? $_POST['role'] : 'user';

    $errors = [];
    if (empty($fname)) $errors[] = "First name is required.";
    if (empty($lname)) $errors[] = "Last name is required.";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Valid email required.";
    if (!preg_match('/^[0-9]{8,10}$/', $phone)) $errors[] = "Phone must be 8–10 digits.";
    if (empty($street)) $errors[] = "Street is required.";
    if (empty($city))   $errors[] = "City is required.";
    if (empty($state))  $errors[] = "State is required.";
    if (!preg_match('/^\d{5}$/', $postcode)) $errors[] = "Postcode must be 5 digits.";

    // Prevent revoking the last admin
    if ($role === 'user') {
        $cur = mysqli_fetch_assoc(mysqli_query($conn, "SELECT role FROM `user` WHERE id=$edit_id"));
        if ($cur && $cur['role'] === 'admin') {
            $cnt = (int)mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM `user` WHERE role='admin'"))['c'];
            if ($cnt <= 1) $errors[] = "Cannot demote the last admin account.";
        }
    }

    if (empty($errors)) {
        mysqli_query($conn, "UPDATE `user` SET fname='$fname',lname='$lname',email='$email',
            phone='$phone',street='$street',city='$city',state='$state',postcode='$postcode',role='$role'
            WHERE id=$edit_id");
        $action_msg = "success:User updated successfully.";
    } else {
        $action_msg = "error:" . implode(' ', $errors);
    }
}

// DELETE USER
if (isset($_GET['delete_id']) && is_numeric($_GET['delete_id'])) {
    $del_id    = (int)$_GET['delete_id'];
    $self_chk  = mysqli_fetch_assoc(mysqli_query($conn, "SELECT username, role FROM `user` WHERE id=$del_id"));
    if ($self_chk && $self_chk['username'] === $_SESSION['username']) {
        $action_msg = "error:You cannot delete your own account.";
    } elseif ($self_chk && $self_chk['role'] === 'admin') {
        $cnt = (int)mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM `user` WHERE role='admin'"))['c'];
        if ($cnt <= 1) {
            $action_msg = "error:Cannot delete the last admin account.";
        } else {
            mysqli_query($conn, "DELETE FROM `user` WHERE id=$del_id");
            $action_msg = "success:Admin user deleted.";
        }
    } elseif ($self_chk) {
        mysqli_query($conn, "DELETE FROM `user` WHERE id=$del_id");
        $action_msg = "success:User #$del_id deleted.";
    } else {
        $action_msg = "error:User not found.";
    }
}

// LOAD EDIT TARGET
$edit_row = null;
if (isset($_GET['edit_id']) && is_numeric($_GET['edit_id'])) {
    $edit_row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `user` WHERE id=" . (int)$_GET['edit_id']));
}

// Sorting
$sort_col = isset($_GET['sort']) ? $_GET['sort'] : 'id';
$sort_dir = isset($_GET['dir']) && $_GET['dir'] === 'desc' ? 'DESC' : 'ASC';
$allowed_sort = ['id', 'fname', 'lname', 'city', 'state', 'role'];
if (!in_array($sort_col, $allowed_sort)) { $sort_col = 'id'; }

// Summary counts
$total_users  = (int)mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM `user`"))['c'];
$total_admins = (int)mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM `user` WHERE role='admin'"))['c'];
$total_reg    = $total_users - $total_admins;
$states_res   = mysqli_query($conn, "SELECT state, COUNT(*) AS c FROM `user` GROUP BY state ORDER BY c DESC LIMIT 1");
$top_state    = $states_res ? (mysqli_fetch_assoc($states_res)['state'] ?? '—') : '—';

$result = mysqli_query($conn, "SELECT * FROM `user` ORDER BY $sort_col $sort_dir");
$total  = mysqli_num_rows($result);

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Management | <?php echo $site_name; ?> Admin</title>
  <link rel="stylesheet" href="styles/style.css">
  <style>
    .admin-bar { background:#2c3e50;color:#fff;padding:0.7rem 2rem;display:flex;justify-content:space-between;align-items:center;font-size:0.9rem; }
    .admin-bar a { color:#aee6d8;text-decoration:none;margin-left:1.2rem; }
    .admin-bar a:hover { text-decoration:underline; }
    .edit-panel { background:#f0f7f2;border:2px solid #2c7a50;border-radius:10px;padding:1.5rem 2rem;margin-bottom:2rem; }
    .edit-panel h2 { margin-top:0;color:#2c7a50; }
    .edit-grid { display:grid;grid-template-columns:1fr 1fr 1fr;gap:0.8rem; }
    .edit-grid .span2 { grid-column:span 2; }
    .edit-grid label { display:block;font-size:0.85rem;font-weight:600;margin-bottom:0.25rem; }
    .edit-grid input,.edit-grid select { width:100%;padding:0.45rem 0.7rem;border:1px solid #ccc;border-radius:5px;box-sizing:border-box;font-size:0.9rem; }
    .btn-update { background:#2c7a50;color:#fff;border:none;padding:0.55rem 1.4rem;border-radius:6px;cursor:pointer;font-size:0.9rem; }
    .btn-update:hover { background:#1e5c3a; }
    .btn-cancel-edit { background:#7f8c8d;color:#fff;text-decoration:none;padding:0.55rem 1.2rem;border-radius:6px;font-size:0.9rem; }
    .action-btns { display:flex;gap:0.4rem;flex-wrap:wrap; }
    .btn-edit-link { background:#2980b9;color:#fff;padding:3px 10px;border-radius:4px;text-decoration:none;font-size:0.78rem; }
    .btn-del-link  { background:#c0392b;color:#fff;padding:3px 10px;border-radius:4px;text-decoration:none;font-size:0.78rem; }
    @media(max-width:700px){ .edit-grid { grid-template-columns:1fr 1fr; } }
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

  <main style="padding:2rem;">

    <div class="page-hero" style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:1rem;">
      <div>
        <h1>User Management</h1>
        <p>Total users in database: <strong><?php echo $total; ?></strong> &mdash; Create, View, Edit and Delete users.</p>
      </div>
      <a href="registration.php" class="btn-submit" style="text-decoration:none;padding:0.55rem 1.4rem;">➕ Create New User</a>
    </div>



    <?php if ($action_msg): ?>
      <?php [$mtype, $mtext] = explode(':', $action_msg, 2); ?>
      <div style="background:<?php echo $mtype==='success'?'#d4edda':'#f8d7da'; ?>;border:2px solid <?php echo $mtype==='success'?'#28a745':'#c0392b'; ?>;border-radius:6px;padding:0.8rem 1rem;margin-bottom:1rem;color:<?php echo $mtype==='success'?'#155724':'#721c24'; ?>;font-weight:600;">
        <?php echo $mtype==='success'?'✅':'⚠️'; ?> <?php echo htmlspecialchars($mtext); ?>
      </div>
    <?php endif; ?>

    <!-- EDIT FORM -->
    <?php if ($edit_row): ?>
    <div class="edit-panel" id="edit-form">
      <h2>✏️ Edit User: <?php echo htmlspecialchars($edit_row['username']); ?></h2>
      <form method="post" action="view_register.php#edit-form">
        <input type="hidden" name="edit_id" value="<?php echo $edit_row['id']; ?>">
        <div class="edit-grid">
          <div>
            <label>First Name</label>
            <input type="text" name="fname" value="<?php echo htmlspecialchars($edit_row['fname']); ?>" required>
          </div>
          <div>
            <label>Last Name</label>
            <input type="text" name="lname" value="<?php echo htmlspecialchars($edit_row['lname']); ?>" required>
          </div>
          <div>
            <label>Role</label>
            <select name="role">
              <option value="user"  <?php echo $edit_row['role']==='user'?'selected':''; ?>>User</option>
              <option value="admin" <?php echo $edit_row['role']==='admin'?'selected':''; ?>>Admin</option>
            </select>
          </div>
          <div class="span2">
            <label>Email</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($edit_row['email']); ?>" required>
          </div>
          <div>
            <label>Phone</label>
            <input type="text" name="phone" value="<?php echo htmlspecialchars($edit_row['phone']); ?>" required>
          </div>
          <div class="span2">
            <label>Street</label>
            <input type="text" name="street" value="<?php echo htmlspecialchars($edit_row['street']); ?>" required>
          </div>
          <div>
            <label>City</label>
            <input type="text" name="city" value="<?php echo htmlspecialchars($edit_row['city']); ?>" required>
          </div>
          <div>
            <label>State</label>
            <input type="text" name="state" value="<?php echo htmlspecialchars($edit_row['state']); ?>" required>
          </div>
          <div>
            <label>Postcode</label>
            <input type="text" name="postcode" maxlength="5" value="<?php echo htmlspecialchars($edit_row['postcode']); ?>" required>
          </div>
        </div>
        <div style="margin-top:1rem;display:flex;gap:0.8rem;align-items:center;">
          <button type="submit" class="btn-update">💾 Save Changes</button>
          <a href="view_register.php" class="btn-cancel-edit">✕ Cancel</a>
        </div>
      </form>
    </div>
    <?php endif; ?>

    <!-- USER TABLE -->
    <?php if ($total === 0): ?>
      <p class="dash-empty">No registered users in the database yet.</p>
    <?php else: ?>
      <div class="dash-table-wrap">
        <table class="dash-table">
          <thead>
            <tr>
              <th><a href="view_register.php?sort=id&dir=<?php echo ($sort_col==='id'&&$sort_dir==='ASC')?'desc':'asc'; ?>" style="color:inherit;text-decoration:none;">ID</a></th>
              <th><a href="view_register.php?sort=fname&dir=<?php echo ($sort_col==='fname'&&$sort_dir==='ASC')?'desc':'asc'; ?>" style="color:inherit;text-decoration:none;">First Name</a></th>
              <th><a href="view_register.php?sort=lname&dir=<?php echo ($sort_col==='lname'&&$sort_dir==='ASC')?'desc':'asc'; ?>" style="color:inherit;text-decoration:none;">Last Name</a></th>
              <th>Email</th>
              <th>Phone</th>
              <th>Street</th>
              <th><a href="view_register.php?sort=city&dir=<?php echo ($sort_col==='city'&&$sort_dir==='ASC')?'desc':'asc'; ?>" style="color:inherit;text-decoration:none;">City</a></th>
              <th><a href="view_register.php?sort=state&dir=<?php echo ($sort_col==='state'&&$sort_dir==='ASC')?'desc':'asc'; ?>" style="color:inherit;text-decoration:none;">State</a></th>
              <th>Postcode</th>
              <th>Username</th>
              <th><a href="view_register.php?sort=role&dir=<?php echo ($sort_col==='role'&&$sort_dir==='ASC')?'desc':'asc'; ?>" style="color:inherit;text-decoration:none;">Role</a></th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
              <td><?php echo $row['id']; ?></td>
              <td><?php echo htmlspecialchars($row['fname']); ?></td>
              <td><?php echo htmlspecialchars($row['lname']); ?></td>
              <td><?php echo htmlspecialchars($row['email']); ?></td>
              <td><?php echo htmlspecialchars($row['phone']); ?></td>
              <td><?php echo htmlspecialchars($row['street']); ?></td>
              <td><?php echo htmlspecialchars($row['city']); ?></td>
              <td><?php echo htmlspecialchars($row['state']); ?></td>
              <td><?php echo htmlspecialchars($row['postcode']); ?></td>
              <td><?php echo htmlspecialchars($row['username']); ?></td>
              <td>
                <?php
                  $role = $row['role'] ?? 'user';
                  $rbadge = $role === 'admin'
                    ? 'background:#fff3cd;color:#856404;padding:2px 8px;border-radius:4px;font-size:0.78rem;font-weight:600;'
                    : 'background:#e2e3e5;color:#383d41;padding:2px 8px;border-radius:4px;font-size:0.78rem;';
                  echo "<span style=\"$rbadge\">" . ucfirst(htmlspecialchars($role)) . "</span>";
                ?>
              </td>
              <td>
                <div class="action-btns">
                  <a href="view_register.php?edit_id=<?php echo $row['id']; ?>#edit-form" class="btn-edit-link">Edit</a>
                  <?php if ($row['username'] !== $_SESSION['username']): ?>
                    <a href="view_register.php?delete_id=<?php echo $row['id']; ?>"
                       class="btn-del-link"
                       onclick="return confirm('Delete user \'<?php echo htmlspecialchars($row['username']); ?>\'? This cannot be undone.');">
                      Delete
                    </a>
                  <?php else: ?>
                    <span style="color:#aaa;font-size:0.78rem;">You</span>
                  <?php endif; ?>
                </div>
              </td>
            </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    <?php endif; ?>

  </main>

  <?php include('footer.inc'); ?>

</body>
</html>
