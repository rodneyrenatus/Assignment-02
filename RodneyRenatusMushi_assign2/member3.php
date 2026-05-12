<?php
$site_name = "Cacti-Succulent Kuching";
$current_year = 2026;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Profile of Aavash Sherchan — Cacti-Succulent Kuching team member.">
  <meta name="keywords" content="team, member, profile, Nur Aisyah, cacti kuching">
  <meta name="author" content="Cacti-Succulent Kuching Team">
  <title>Aavash Sherchan | Cacti-Succulent Kuching</title>
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
    <div class="profile-page-wrap">

      <img src="images/avash.jpeg" alt="Aavash Sherchan" class="profile-float-photo">

      <p class="member-name-large">Aavash Sherchan</p>
      <p class="member-id-text">105812345</p>
      <p class="member-course-text">Bachelor of Computer Science</p>

      <div class="clearfix"></div>

      <table class="profile-table">
        <tr>
          <th>Category</th>
          <th>Details</th>
        </tr>
        <tr>
          <td>Hometown</td>
          <td>Kathmandu, Nepal</td>
        </tr>
        <tr>
          <td>About Hometown</td>
          <td>Kathmandu is a vibrant, historic capital where ancient temples, bustling markets, and rich cultural
            traditions blend with the energy of modern city life.
          </td>
        </tr>
        <tr>
          <td>Nationality</td>
          <td>Nepali</td>
        </tr>
        <tr>
          <td>Age</td>
          <td>18</td>
        </tr>
        <tr>
          <td>Hobbies</td>
          <td>Running, Cooking, Hiking</td>
        </tr>
        <tr>
          <td>Fav Movie</td>
          <td>Ye Jawani He Diwani, Inglourious Basterds, White Chicks, Silent Voice</td>
        </tr>
        <tr>
          <td>Fav Food</td>
          <td>Thakali khana, momo, biryani, pasta, samgyeopsal</td>
        </tr>
        <tr>
          <td>Music</td>
          <td>Hip Hop, Pop, R&B</td>
        </tr>
        <tr>
          <td>Goals</td>
          <td>Live a disciplined life with good habits and clear purpose.</td>
        </tr>
        <tr>
          <td>Fav Book</td>
          <td>One piece</td>
        </tr>
      </table>

      <div class="mailto-center">
        <a href="mailto:105807691@students.swinburne.edu.my" class="email-link">&#9993; Email Me</a>
      </div>

      <!-- Where I Live map section -->
      <h2 class="map-heading">My Hometown</h2>
      <p class="map-location">Kathmandu, Nepal</p>

      <iframe
        class="map-embed"
        src="https://www.google.com/maps/embed?pb=!4v1776185653880!6m8!1m7!1sCAoSF0NJSE0wb2dLRUlDQWdJQzd4WmFaamdF!2m2!1d27.72146935964517!2d85.36203496812574!3f355.95!4f-17.709999999999994!5f0.586850556981025"
        allowfullscreen=""
        loading="lazy"
        title="Kathmandu, Nepal">
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
          <li><a href="profile.php">Mohd Amirunhisyam</a></li>
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