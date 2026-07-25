<?php

session_start();

$site_name    = "Cacti-Succulent Kuching";
$current_year = 2026;
$nav_active   = "login";
$error        = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $input_user = trim($_POST["username"] ?? "");
    $input_pass = trim($_POST["password"] ?? "");

    if (empty($input_user) || empty($input_pass)) {
        $error = "Please enter both username and password.";
    } else {
        require_once("connection.php");
        {
            // Case-insensitive comparison per spec
            $input_user_lower = strtolower($input_user);
            $input_pass_lower = strtolower($input_pass);

            // 1. Check admin table first (spec: admin credentials stored in admin table)
            $admin_result = mysqli_query($conn,
                "SELECT * FROM admin WHERE LOWER(username)='$input_user_lower' AND LOWER(password)='$input_pass_lower'"
            );
            if ($admin_result && mysqli_num_rows($admin_result) === 1) {
                $arow = mysqli_fetch_assoc($admin_result);
                $_SESSION['role']          = 'admin';
                $_SESSION['username']      = $arow['username'];
                $_SESSION['name']          = 'Administrator';
                $_SESSION['uid']           = $arow['id'];
                $_SESSION['login_success'] = "Welcome back, Administrator! You have successfully logged in.";
                mysqli_close($conn);
                header("Location: dashboard.php");
                exit;
            }

            // 2. Check user table for regular users
            $user_result = mysqli_query($conn,
                "SELECT * FROM `user` WHERE LOWER(username)='$input_user_lower' AND LOWER(password)='$input_pass_lower'"
            );
            if ($user_result && mysqli_num_rows($user_result) === 1) {
                $row = mysqli_fetch_assoc($user_result);
                $_SESSION['role']          = $row['role'];
                $_SESSION['username']      = $row['username'];
                $_SESSION['name']          = $row['fname'] . ' ' . $row['lname'];
                $_SESSION['uid']           = $row['id'];
                $_SESSION['login_success'] = "Welcome back, " . $row['fname'] . "! You have successfully logged in.";
                mysqli_close($conn);
                // Admin users in user table also go to dashboard
                header("Location: " . ($row['role'] === 'admin' ? "dashboard.php" : "user_dashboard.php"));
                exit;
            }

            $error = "Invalid username or password. Please try again.";
            mysqli_close($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Login to your Cacti-Succulent Kuching account.">
  <meta name="keywords" content="login, member, cacti kuching">
  <meta name="author" content="Cacti-Succulent Kuching Team">
  <title>Login | <?php echo $site_name; ?></title>
  <link rel="stylesheet" href="styles/style.css">
</head>
<body>
  <?php include('header.inc'); ?>

  <div class="login-wrap">
    <div class="login-card">

      <div class="login-hero">
        <div class="login-icon">🪴</div>
        <h2>Welcome Back,<br><em>Plant Lover!</em></h2>
        <p>Your little green companions are waiting. Sign in to browse our curated
           succulents and book a care consultation at Medan Satok.</p>
        <p>
          Don't have an account yet?<br>
          <a href="registration.php">Register here →</a>
        </p>
      </div>

      <div class="login-form-side">

        <h1>Member Login</h1>
        <p class="subtitle">Sign in to your <?php echo $site_name; ?> account.</p>

        <?php if ($error != ""): ?>
          <div class="form-error-box">
            <p><?php echo htmlspecialchars($error); ?></p>
          </div>
        <?php endif; ?>

        <form action="login.php" method="post">
          <fieldset>
            <legend>Login Credentials</legend>
            <div class="form-group">
              <label for="username">Username</label>
              <input type="text" id="username" name="username"
                     placeholder="Enter username" maxlength="50"
                     autocomplete="username" required>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" id="password" name="password"
                     placeholder="Enter password" maxlength="50"
                     autocomplete="current-password" required>
            </div>
          </fieldset>
          <button type="submit" class="btn-submit login-btn">Sign In</button>
        </form>

        <p class="login-switch">New here? <a href="registration.php">Create an account</a></p>

      </div>

    </div>
  </div>
  <?php include('footer.inc'); ?>

</body>
</html>
