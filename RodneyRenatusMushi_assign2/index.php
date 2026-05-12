<?php
$site_name = "Cacti-Succulent Kuching";
$current_year = 2026;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Cacti-Succulent Kuching — home-based cactus and succulent business in Kuching, Sarawak.">
  <meta name="keywords" content="cactus, succulent, kuching, sarawak, plants">
  <meta name="author" content="Cacti-Succulent Kuching Team">
  <title>Home | <?php echo $site_name; ?></title>
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
        <a href="product1.php" class="dropbtn active">Products ▾</a>
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
      <a href="members.php">Members</a>
      <a href="dashboard.php">Dashboard</a>
    </nav>
  </header>

  <!-- Hero with background image -->
  <section class="hero hero-index">
    <div class="hero-container">
      <div class="hero-text">
        <span class="badge">Local · Hardy · Unique</span>
        <h1>Desert <span>Vibes</span><br>for Kuching Homes</h1>
        <p>We bring the resilient beauty of the desert into your living space with hand-picked,
           acclimatized succulents grown right here in Kuching.</p>
        <div class="action-group">
          <a href="product1.php" class="btn-solid">Browse Products</a>
          <a href="enquiry.php" class="btn-outline">Ask a Question →</a>
        </div>
      </div>
      <div class="hero-image">
        <img src="images/succulents.jpeg" alt="Collection of Cacti">
      </div>
    </div>
  </section>

  <!-- Featured Products overview linking to each product page -->
  <section class="product-showcase">
      <div class="section-header">
        <h2>Our Product Categories</h2>
        <p>From rare cacti to decorative pots — everything your indoor garden needs.</p>
      </div>

      <div class="product-grid">

        <article class="product-card">
          <figure>
            <img src="images/succulents.jpeg" alt="Ariocarpus Cactus">
          </figure>
          <div class="card-body">
            <h3>Cacti</h3>
            <p>Hardy, sculptural, and virtually maintenance-free. Our cacti collection
               spans beginner-friendly varieties to rare collector specimens like
               Ariocarpus and Astrophytum, all acclimatized to Sarawak's humidity.</p>
            <dl class="plant-specs">
              <dt>Care Level</dt><dd>Easy – Low maintenance</dd>
              <dt>Highlight</dt><dd>Rare & collector varieties</dd>
            </dl>
            <div class="card-footer">
              <span class="price">From RM 6</span>
              <a href="product1.php" class="buy-btn">View Cacti →</a>
            </div>
          </div>
        </article>

        <article class="product-card">
          <figure>
            <img src="images/succulent.webp" alt="Succulent">
          </figure>
          <div class="card-body">
            <h3>Succulents</h3>
            <p>Colourful, compact, and endlessly charming. Our succulents include
               Echeveria rosettes, Haworthia zebra stripes, and spreading Sedum —
               perfect for desktops, shelves, and windowsills.</p>
            <dl class="plant-specs">
              <dt>Care Level</dt><dd>Very Easy</dd>
              <dt>Highlight</dt><dd>Colourful rosette varieties</dd>
            </dl>
            <div class="card-footer">
              <span class="price">From RM 8</span>
              <a href="product2.php" class="buy-btn">View Succulents →</a>
            </div>
          </div>
        </article>

        <article class="product-card">
          <figure>
            <img src="images/potsnplanters.jpg" alt="Pots and Planters">
          </figure>
          <div class="card-body">
            <h3>Pots &amp; Planters</h3>
            <p>Terracotta classics, ceramic statement pieces, and space-saving hanging
               planters. Each pot is chosen to complement our plants and suit a range
               of interior styles from minimalist to boho.</p>
            <dl class="plant-specs">
              <dt>Materials</dt><dd>Terracotta, Ceramic</dd>
              <dt>Sizes</dt><dd>Small to Large</dd>
            </dl>
            <div class="card-footer">
              <span class="price">From RM 12</span>
              <a href="product3.php" class="buy-btn">View Pots →</a>
            </div>
          </div>
        </article>

        <article class="product-card">
          <figure>
            <img src="images/accessories.jfif" alt="Accessories">
          </figure>
          <div class="card-body">
            <h3>Accessories</h3>
            <p>Everything to keep your plants thriving — our specialised succulent soil
               mix, slow-release cactus fertiliser, mini watering cans, and curated
               gift bundles make the perfect present for any plant lover.</p>
            <dl class="plant-specs">
              <dt>Includes</dt><dd>Soil, Fertiliser, Tools</dd>
              <dt>Gift Sets</dt><dd>Available year-round</dd>
            </dl>
            <div class="card-footer">
              <span class="price">From RM 5</span>
              <a href="product4.php" class="buy-btn">View Accessories →</a>
            </div>
          </div>
        </article>

      </div>
  </section>

  <section class="info-band">
    <h2>Why Choose Us?</h2>
    <dl>
      <div>
        <dt>🌿 Locally Grown</dt>
        <dd>Acclimatized to Sarawak humidity for better survival in your home.</dd>
      </div>
      <div>
        <dt>💬 Expert Advice</dt>
        <dd>Free care consultation with every purchase at our Medan Satok stall.</dd>
      </div>
      <div>
        <dt>🌵 Rare Varieties</dt>
        <dd>Specializing in Ariocarpus and Astrophytum collector species.</dd>
      </div>
      <div>
        <dt>📦 Fast Delivery</dt>
        <dd>Home delivery within Kuching for only RM5. Processed in 1–2 days.</dd>
      </div>
    </dl>
  </section>

  <footer>
    <div class="footer-inner">

      <div class="footer-col">
        <h4><?php echo $site_name; ?></h4>
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
