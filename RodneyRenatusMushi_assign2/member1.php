<?php
$site_name = "Cacti-Succulent Kuching";
$current_year = 2026;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Profile of Mohd Amirunhisyam — Cacti-Succulent Kuching team member." />
  <meta name="keywords" content="team, member, profile, Amirunhisyam, cacti kuching" />
  <meta name="author" content="Cacti-Succulent Kuching Team" />
  <title>Mohd Amirunhisyam | Cacti Succulent Kuching</title>
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

  <main class="amirun-main">

    <section>
      <div class="photo-frame">
        <img src="images/amirun.jpeg" alt="Student Photo">
      </div>
      <div class="identity">
        <h1><strong>Mohd Amirunhisyam bin Ali Rahman</strong></h1>
        <p class="id">Student ID: 105804799</p>
        <p class="course">Bachelor of Data Science</p>
      </div>
    </section>

    <section>
      <table class="amirun-table">

        <tr>
          <th colspan="2">Personal Profile</th>
        </tr>

        <tr>
          <td>Hobby</td>
          <td>Playing Football, Chess, Reading</td>
        </tr>

        <tr>
          <td>Favourite Movie</td>
          <td>Insterstellar, Kingsman, The Nice Guys</td>
        </tr>

        <tr>
          <td>Favourite Food</td>
          <td>Pizza,sushi,pasta,dumplings</td>
        </tr>

        <tr>
          <td>Music</td>
          <td>Pop</td>
        </tr>

        <tr>
          <td>Goals</td>
          <td>Visit foreign places, learn new language</td>
        </tr>

        <tr>
          <td>Favourite Book</td>
          <td>Atomic Habit</td>
        </tr>

      </table>

      <p>
        <a href="mailto:105804799@students.swinburne.edu.my">
          <img src="images/email-me.jpeg" alt="email me" class="amirun-email-img">
        </a>
      </p>
      <p class="back-link"><a href="members.php">&larr; Back to Members</a></p>
    </section>

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
