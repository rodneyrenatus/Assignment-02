<?php

session_start();
$site_name = "Cacti-Succulent Kuching";
$current_year = 2026;
$nav_active   = "members";
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
  <?php include('header.inc'); ?>

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
  <?php include('footer.inc'); ?>

</body>
</html>
