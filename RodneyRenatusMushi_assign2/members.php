<?php
$site_name = "Cacti-Succulent Kuching";
$current_year = 2026;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Meet the team behind Cacti-Succulent Kuching.">
  <meta name="keywords" content="team, members, profile, cacti kuching">
  <meta name="author" content="Cacti-Succulent Kuching Team">
  <title>Members | Cacti-Succulent Kuching</title>
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
      <a href="members.php" class="active">Members</a>
      <a href="dashboard.php">Dashboard</a>
    </nav>
  </header>

  <main>

    <div class="section-header">
      <h1>Our Team</h1>
      <p>The people behind Cacti-Succulent Kuching — click a card to view their full profile.</p>
    </div>

    <div class="members-grid">

      <a href="member1.php" class="member-card-link">
        <div class="member-card">
          <img src="images/amirun.jpeg" alt="Mohd Amirunhisyam" class="profile-photo">
          <p class="member-name">Mohd Amirunhisyam</p>
        </div>
      </a>

      <a href="member2.php" class="member-card-link">
        <div class="member-card">
          <img src="images/helitha.jpeg" alt="Maduwa Guruge Savindu Helitha Jayasinghe" class="profile-photo">
          <p class="member-name">Helitha Jayasinghe</p>
        </div>
      </a>

      <a href="member3.php" class="member-card-link">
        <div class="member-card">
          <img src="images/avash.jpeg" alt="Aavash Sherchan" class="profile-photo">
          <p class="member-name">Aavash Sherchan</p>
        </div>
      </a>

      <a href="member4.php" class="member-card-link">
        <div class="member-card">
          <img src="images/rodney.jpg" alt="Rodney Renatus Mushi" class="profile-photo">
          <p class="member-name">Rodney Renatus Mushi</p>
        </div>
      </a>

    </div><!-- /.members-grid -->

  </main>

  <footer>
    <div class="footer-inner">

      <div class="footer-col">
        <h4>Cacti-Succulent Kuching</h4>
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
