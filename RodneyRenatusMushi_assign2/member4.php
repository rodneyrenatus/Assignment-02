<?php
session_start();
$site_name = "Cacti-Succulent Kuching";
$current_year = 2026;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Profile of Rodney Renatus Mushi — Cacti-Succulent Kuching team member.">
  <meta name="keywords" content="team, member, profile, Rodney Renatus Mushi, cacti kuching">
  <meta name="author" content="Cacti-Succulent Kuching Team">
  <title>Rodney Renatus Mushi | Cacti-Succulent Kuching</title>
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
      <a href="members.php" class="active">Members</a>
      <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?><a href="dashboard.php">Dashboard</a><?php endif; ?>
    </nav>
  </header>

  <main>
    <div class="profile-page-wrap">

        <img src="images/rodney.jpg" alt="Rodney Renatus Mushi" class="profile-float-photo">
      
        <p class="member-name-large">Rodney Renatus Mushi</p>
        <p class="member-id-text">104402794</p>
        <p class="member-course-text">Bachelor of Engineering (Robotics and Mechatronics)(Hons)/ Bachelor of Computer Science</p>
      
      <div class="clearfix"></div>

      <table class="profile-table">
        <tr><th>Category</th><th>Details</th></tr>
        <tr><td>Hometown</td><td>Dar es Salaam, Tanzania</td></tr>
        <tr><td>About Hometown</td><td>Edge of the city town, home to the Indian Ocean. Known for peace and a whole lot of bussiness on the roadside</td></tr>
        <tr><td>Nationality</td><td>Tanzanian</td></tr>
        <tr><td>Age</td><td>21</td></tr>
        <tr><td>Hobbies</td><td>Coding, Music, Drawing</td></tr>
        <tr><td>Fav Movie</td><td>Interstellar, Spiderman Into the Spiderverse</td></tr>
        <tr><td>Fav Food</td><td>Mtori, Pork</td></tr>
        <tr><td>Music</td><td>R&B, Hip-hop</td></tr>
        <tr><td>Goals</td><td>Start my own Software Company</td></tr>
        <tr><td>Fav Book</td><td>The Darkest Minds -Alexandra Bracken</td></tr>
      </table>

      <div class="mailto-center">
        <a href="mailto:104402794@students.swinburne.edu.my" class="email-link">&#9993; Email Me</a>
      </div>

      <!-- Where I Live map section -->
      <h2 class="map-heading">Where I Live</h2>
      <p class="map-location">Kinzudi, Dar es Salaam, Tanzania</p>
      <iframe
        class="map-embed"
        src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d9115.542944866063!2d39.17329589001731!3d-6.722133903082473!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2smy!4v1776100592077!5m2!1sen!2smy"
        allowfullscreen=""
        loading="lazy"
        title="Kinzudi, Dar es Salaam, Tanzania">
      </iframe>
      

      <p class="back-link"><a href="members.php">&larr; Back to Members</a></p>

    </div>
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
