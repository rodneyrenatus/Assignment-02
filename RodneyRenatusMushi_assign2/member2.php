<?php
$site_name = "Cacti-Succulent Kuching";
$current_year = 2026;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta name="description" content="Profile of Maduwa Guruge Savindu Helitha Jayasinghe — Cacti-Succulent Kuching team member." />
  <meta name="keywords" content="team, member, profile, Helitha, cacti kuching" />
  <meta name="author" content="Cacti-Succulent Kuching Team" />
  <title>Maduwa Guruge Savindu Helitha Jayasinghe | Cacti-Succulent Kuching</title>
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
    <div class="helitha-content-wrap">

      <div class="helitha-photo-wrap">
        <img src="images/helitha.jpeg" alt="Student Photo" />
      </div>

      <div class="helitha-identity">
        <div class="helitha-name">Maduwa Guruge Savindu Helitha Jayasinghe</div>
        <div class="helitha-student-id">Student ID: 105807361</div>
        <div class="helitha-course">Bachelor of Computer Science</div>
      </div>

      <table class="helitha-profile-table">
        <thead>
          <tr>
            <th colspan="2">Personal Profile</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Age</td>
            <td>22 years old</td>
          </tr>
          <tr>
            <td>Hometown</td>
            <td>Battaramulla, Sri Lanka</td>
          </tr>
          <tr>
            <td>Hobbies</td>
            <td>Playing basketball, Chess, Hiking</td>
          </tr>
          <tr>
            <td>Languages</td>
            <td>English, Sinhala</td>
          </tr>
          <tr>
            <td>Career Goal</td>
            <td>Cyber Security Professional</td>
          </tr>
          <tr>
            <td>Fun Fact</td>
            <td>A tall, calm guy</td>
          </tr>
        </tbody>
      </table>

      <div class="helitha-email-wrap">
        <a class="helitha-email-btn" href="mailto:105807361@students.swinburne.edu.my">Email Me</a>
      </div>
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
