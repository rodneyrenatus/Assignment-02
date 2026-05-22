<?php
session_start();
$site_name    = "Cacti-Succulent Kuching";
$current_year = 2026;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Place an order with Cacti-Succulent Kuching.">
  <meta name="keywords" content="order, buy, cactus, succulent, kuching">
  <meta name="author" content="Cacti-Succulent Kuching Team">
  <title>Order | <?php echo $site_name; ?></title>
  <link rel="stylesheet" href="styles/style.css">
</head>
<body>

<?php include('connection.php'); ?>
<?php include('createtable.php'); ?>

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
      <a href="order.php" class="active">Order</a>
      <a href="registration.php">Register</a>
      <?php if (isset($_SESSION['role'])): ?><a href="logout.php">Logout</a><?php else: ?><a href="login.php">Login</a><?php endif; ?>
      <a href="enquiry.php">Enquiry</a>
      <a href="members.php">Members</a>
      <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?><a href="dashboard.php">Dashboard</a><?php endif; ?>
    </nav>
  </header>

  <main>

    <div class="page-hero">
      <h1>Place Your Order</h1>
      <p>Bring the beauty of the desert home. Fill in the form below and we will prepare
         your order with care. Fields marked <span class="required-star">*</span> are required.</p>
    </div>

    <div class="order-form-area content-clearfix">

      <aside>
        <h2>Order Tips</h2>
        <p>Not sure what to pick? A few quick guides:</p>
        <ul>
          <li><strong>Beginners:</strong> Try Echeveria, Mini Echeveria, or Haworthia — beautiful and forgiving.</li>
          <li><strong>Collectors:</strong> Ariocarpus, Lithops, and Bishop's Cap Cactus are rare conversation pieces.</li>
          <li><strong>Low-light spaces:</strong> Haworthia Limifolia and Jade Plant thrive away from windows.</li>
          <li><strong>Hanging displays:</strong> String of Pearls, Burro's Tail, and Hanging Pots make a stunning trio.</li>
          <li><strong>Bold statement:</strong> Golden Barrel Cactus or Mini Saguaro in a Concrete Pot turns heads.</li>
          <li><strong>Gifts:</strong> Our Gift Bundle Sets come pre-potted and beautifully wrapped.</li>
          <li><strong>Grow lights:</strong> Our LED Grow Light lets any room become a plant room.</li>
          <li><strong>Pickup:</strong> Available every weekend at Medan Satok market.</li>
          <li><strong>Delivery:</strong> We deliver within Kuching for RM5 flat fee.</li>
        </ul>
        <p>📦 Orders processed within 1–2 business days.</p>
      </aside>

      <form action="order_process.php" method="post">

        <!-- Personal Details -->
        <fieldset>
          <legend>Personal Details</legend>

          <div class="form-group">
            <label for="first_name">First Name <span class="required-star">*</span></label>
            <input type="text" id="first_name" name="first_name"
                   maxlength="25" pattern="[A-Za-z]+"
                   placeholder="e.g. James"
                   title="Alphabetical characters only, max 25" required>
          </div>

          <div class="form-group">
            <label for="last_name">Last Name <span class="required-star">*</span></label>
            <input type="text" id="last_name" name="last_name"
                   maxlength="25" pattern="[A-Za-z]+"
                   placeholder="e.g. Smith"
                   title="Alphabetical characters only, max 25" required>
          </div>

          <div class="form-group">
            <label for="email">Email Address <span class="required-star">*</span></label>
            <input type="email" id="email" name="email"
                   placeholder="e.g. james@email.com" required>
          </div>

          <div class="form-group">
            <label for="phone">Phone Number <span class="required-star">*</span></label>
            <input type="tel" id="phone" name="phone"
                   maxlength="10" pattern="[0-9]{8,10}"
                   placeholder="e.g. 0123456789"
                   title="8 to 10 digits only" required>
          </div>
        </fieldset>

        <!-- Product Selection -->
        <fieldset>
          <legend>Select Products <span class="required-star">*</span></legend>

          <div class="order-product-section">
            <h3>🌵 Cacti</h3>
            <div class="checkbox-group">
              <label>
                <input type="checkbox" name="product_ariocarpus" value="Ariocarpus">
                Ariocarpus — RM 29.10
                <span class="qty-label">Qty:</span> <input type="number" name="qty_ariocarpus" min="0" max="50" value="0" class="qty-input">
              </label>
              <label>
                <input type="checkbox" name="product_golden_barrel" value="Golden Barrel Cactus">
                Golden Barrel Cactus — RM 35.00
                <span class="qty-label">Qty:</span> <input type="number" name="qty_golden_barrel" min="0" max="50" value="0" class="qty-input">
              </label>
              <label>
                <input type="checkbox" name="product_bunny_ear" value="Bunny Ear Cactus">
                Bunny Ear Cactus — RM 28.00
                <span class="qty-label">Qty:</span> <input type="number" name="qty_bunny_ear" min="0" max="50" value="0" class="qty-input">
              </label>
              <label>
                <input type="checkbox" name="product_moon_cactus" value="Moon Cactus">
                Moon Cactus — RM 22.00
                <span class="qty-label">Qty:</span> <input type="number" name="qty_moon_cactus" min="0" max="50" value="0" class="qty-input">
              </label>
              <label>
                <input type="checkbox" name="product_fairy_castle" value="Fairy Castle Cactus">
                Fairy Castle Cactus — RM 40.00
                <span class="qty-label">Qty:</span> <input type="number" name="qty_fairy_castle" min="0" max="50" value="0" class="qty-input">
              </label>
              <label>
                <input type="checkbox" name="product_old_lady" value="Old Lady Cactus">
                Old Lady Cactus — RM 30.00
                <span class="qty-label">Qty:</span> <input type="number" name="qty_old_lady" min="0" max="50" value="0" class="qty-input">
              </label>
              <label>
                <input type="checkbox" name="product_star_cactus" value="Star Cactus">
                Star Cactus — RM 38.00
                <span class="qty-label">Qty:</span> <input type="number" name="qty_star_cactus" min="0" max="50" value="0" class="qty-input">
              </label>
              <label>
                <input type="checkbox" name="product_hedgehog" value="Hedgehog Cactus">
                Hedgehog Cactus — RM 33.00
                <span class="qty-label">Qty:</span> <input type="number" name="qty_hedgehog" min="0" max="50" value="0" class="qty-input">
              </label>
              <label>
                <input type="checkbox" name="product_bishops_cap" value="Bishop's Cap Cactus">
                Bishop's Cap Cactus — RM 42.00
                <span class="qty-label">Qty:</span> <input type="number" name="qty_bishops_cap" min="0" max="50" value="0" class="qty-input">
              </label>
              <label>
                <input type="checkbox" name="product_mini_saguaro" value="Mini Saguaro Cactus">
                Mini Saguaro Cactus — RM 50.00
                <span class="qty-label">Qty:</span> <input type="number" name="qty_mini_saguaro" min="0" max="50" value="0" class="qty-input">
              </label>
            </div>
          </div>

          <div class="order-product-section">
            <h3>🌱 Succulents</h3>
            <div class="checkbox-group">
              <label>
                <input type="checkbox" name="product_aloe" value="Aloe Vera">
                Aloe Vera — RM 10.00
                <span class="qty-label">Qty:</span> <input type="number" name="qty_aloe" min="0" max="50" value="0" class="qty-input">
              </label>
              <label>
                <input type="checkbox" name="product_sedum" value="Sedum">
                Sedum — RM 9.00
                <span class="qty-label">Qty:</span> <input type="number" name="qty_sedum" min="0" max="50" value="0" class="qty-input">
              </label>
              <label>
                <input type="checkbox" name="product_echeveria_raspberry" value="Echeveria Elegans Raspberry Ice">
                Echeveria Elegans Raspberry Ice — RM 25.00
                <span class="qty-label">Qty:</span> <input type="number" name="qty_echeveria_raspberry" min="0" max="50" value="0" class="qty-input">
              </label>
              <label>
                <input type="checkbox" name="product_jade" value="Jade Plant">
                Jade Plant — RM 30.00
                <span class="qty-label">Qty:</span> <input type="number" name="qty_jade" min="0" max="50" value="0" class="qty-input">
              </label>
              <label>
                <input type="checkbox" name="product_lithops" value="Lithops">
                Lithops — RM 22.00
                <span class="qty-label">Qty:</span> <input type="number" name="qty_lithops" min="0" max="50" value="0" class="qty-input">
              </label>
              <label>
                <input type="checkbox" name="product_string_pearls" value="String of Pearls">
                String of Pearls — RM 28.00
                <span class="qty-label">Qty:</span> <input type="number" name="qty_string_pearls" min="0" max="50" value="0" class="qty-input">
              </label>
              <label>
                <input type="checkbox" name="product_burros_tail" value="Burro's Tail">
                Burro's Tail — RM 35.00
                <span class="qty-label">Qty:</span> <input type="number" name="qty_burros_tail" min="0" max="50" value="0" class="qty-input">
              </label>
              <label>
                <input type="checkbox" name="product_haworthia_lim" value="Haworthia Limifolia">
                Haworthia Limifolia — RM 26.00
                <span class="qty-label">Qty:</span> <input type="number" name="qty_haworthia_lim" min="0" max="50" value="0" class="qty-input">
              </label>
              <label>
                <input type="checkbox" name="product_mini_echeveria" value="Mini Echeveria">
                Mini Echeveria — RM 15.00
                <span class="qty-label">Qty:</span> <input type="number" name="qty_mini_echeveria" min="0" max="50" value="0" class="qty-input">
              </label>
            </div>
          </div>

          <div class="order-product-section">
            <h3>🪴 Pots &amp; Planters</h3>
            <div class="checkbox-group">
              <label>
                <input type="checkbox" name="product_terra_s" value="Terracotta Pot (Small)">
                Terracotta Pot (Small) — RM 5.00
                <span class="qty-label">Qty:</span> <input type="number" name="qty_terra_s" min="0" max="50" value="0" class="qty-input">
              </label>
              <label>
                <input type="checkbox" name="product_terra_l" value="Terracotta Pot (Large)">
                Terracotta Pot (Large) — RM 12.00
                <span class="qty-label">Qty:</span> <input type="number" name="qty_terra_l" min="0" max="50" value="0" class="qty-input">
              </label>
              <label>
                <input type="checkbox" name="product_ceramic" value="Ceramic Decorative Pot">
                Ceramic Decorative Pot — RM 18.00
                <span class="qty-label">Qty:</span> <input type="number" name="qty_ceramic" min="0" max="50" value="0" class="qty-input">
              </label>
              <label>
                <input type="checkbox" name="product_hanging" value="Hanging Planter (Terracotta + Jute)">
                Hanging Planter (Terracotta + Jute) — RM 22.00
                <span class="qty-label">Qty:</span> <input type="number" name="qty_hanging" min="0" max="50" value="0" class="qty-input">
              </label>
              <label>
                <input type="checkbox" name="product_ceramic_white" value="Ceramic White Pot">
                Ceramic White Pot — RM 14.00
                <span class="qty-label">Qty:</span> <input type="number" name="qty_ceramic_white" min="0" max="50" value="0" class="qty-input">
              </label>
              <label>
                <input type="checkbox" name="product_terra_m" value="Terracotta Pot (Medium)">
                Terracotta Pot (Medium) — RM 10.00
                <span class="qty-label">Qty:</span> <input type="number" name="qty_terra_m" min="0" max="50" value="0" class="qty-input">
              </label>
              <label>
                <input type="checkbox" name="product_hanging_plastic" value="Hanging Pot (Plastic)">
                Hanging Pot (Plastic) — RM 13.00
                <span class="qty-label">Qty:</span> <input type="number" name="qty_hanging_plastic" min="0" max="50" value="0" class="qty-input">
              </label>
              <label>
                <input type="checkbox" name="product_concrete" value="Concrete Pot">
                Concrete Pot — RM 30.00
                <span class="qty-label">Qty:</span> <input type="number" name="qty_concrete" min="0" max="50" value="0" class="qty-input">
              </label>
              <label>
                <input type="checkbox" name="product_plastic" value="Plastic Pot">
                Plastic Pot — RM 8.00
                <span class="qty-label">Qty:</span> <input type="number" name="qty_plastic" min="0" max="50" value="0" class="qty-input">
              </label>
              <label>
                <input type="checkbox" name="product_self_water" value="Self-Watering Pot">
                Self-Watering Pot — RM 43.00
                <span class="qty-label">Qty:</span> <input type="number" name="qty_self_water" min="0" max="50" value="0" class="qty-input">
              </label>
              <label>
                <input type="checkbox" name="product_mini_deco" value="Mini Decorative Pot">
                Mini Decorative Pot — RM 20.00
                <span class="qty-label">Qty:</span> <input type="number" name="qty_mini_deco" min="0" max="50" value="0" class="qty-input">
              </label>
              <label>
                <input type="checkbox" name="product_glass_terr" value="Glass Pot Terrarium">
                Glass Pot Terrarium — RM 60.00
                <span class="qty-label">Qty:</span> <input type="number" name="qty_glass_terr" min="0" max="50" value="0" class="qty-input">
              </label>
              <label>
                <input type="checkbox" name="product_wooden_box" value="Wooden Planter Box">
                Wooden Planter Box — RM 54.00
                <span class="qty-label">Qty:</span> <input type="number" name="qty_wooden_box" min="0" max="50" value="0" class="qty-input">
              </label>
            </div>
          </div>

          <div class="order-product-section">
            <h3>🧰 Accessories</h3>
            <div class="checkbox-group">
              <label>
                <input type="checkbox" name="product_soil" value="Succulent Soil Mix (2kg)">
                Succulent Soil Mix (2kg) — RM 15.00
                <span class="qty-label">Qty:</span> <input type="number" name="qty_soil" min="0" max="50" value="0" class="qty-input">
              </label>
              <label>
                <input type="checkbox" name="product_fert" value="Cactus Fertiliser">
                Cactus Fertiliser — RM 12.00
                <span class="qty-label">Qty:</span> <input type="number" name="qty_fert" min="0" max="50" value="0" class="qty-input">
              </label>
              <label>
                <input type="checkbox" name="product_gift" value="Gift Bundle Set">
                Gift Bundle Set — RM 35.00
                <span class="qty-label">Qty:</span> <input type="number" name="qty_gift" min="0" max="50" value="0" class="qty-input">
              </label>
              <label>
                <input type="checkbox" name="product_watering_small" value="Watering Can (Small, 500ml)">
                Watering Can (Small, 500ml) — RM 6.00
                <span class="qty-label">Qty:</span> <input type="number" name="qty_watering_small" min="0" max="50" value="0" class="qty-input">
              </label>
              <label>
                <input type="checkbox" name="product_tool_set" value="Garden Tool Set (3-piece)">
                Garden Tool Set (3-piece) — RM 20.00
                <span class="qty-label">Qty:</span> <input type="number" name="qty_tool_set" min="0" max="50" value="0" class="qty-input">
              </label>
              <label>
                <input type="checkbox" name="product_spray" value="Spray Bottle (300ml)">
                Spray Bottle (300ml) — RM 4.00
                <span class="qty-label">Qty:</span> <input type="number" name="qty_spray" min="0" max="50" value="0" class="qty-input">
              </label>
              <label>
                <input type="checkbox" name="product_labels" value="Plant Labels (Pack of 20)">
                Plant Labels (Pack of 20) — RM 7.00
                <span class="qty-label">Qty:</span> <input type="number" name="qty_labels" min="0" max="50" value="0" class="qty-input">
              </label>
              <label>
                <input type="checkbox" name="product_grow_light" value="LED Grow Light">
                LED Grow Light — RM 56.00
                <span class="qty-label">Qty:</span> <input type="number" name="qty_grow_light" min="0" max="50" value="0" class="qty-input">
              </label>
              <label>
                <input type="checkbox" name="product_pebbles" value="Pebble Decoration (500g)">
                Pebble Decoration (500g) — RM 21.00
                <span class="qty-label">Qty:</span> <input type="number" name="qty_pebbles" min="0" max="50" value="0" class="qty-input">
              </label>
              <label>
                <input type="checkbox" name="product_stand" value="Plant Stand">
                Plant Stand — RM 25.00
                <span class="qty-label">Qty:</span> <input type="number" name="qty_stand" min="0" max="50" value="0" class="qty-input">
              </label>
            </div>
          </div>

        </fieldset>

        <!-- Delivery Mode -->
        <fieldset>
          <legend>Delivery Mode <span class="required-star">*</span></legend>
          <div class="radio-group">
            <label><input type="radio" name="delivery_mode" value="pickup" required>
              Self Pick-up — Medan Satok, weekends (Free)</label>
            <label><input type="radio" name="delivery_mode" value="delivery_kuching">
              Home Delivery — Kuching Area (RM 5)</label>
            <label><input type="radio" name="delivery_mode" value="delivery_sarawak">
              Home Delivery — Other Sarawak (RM 15)</label>
            <label><input type="radio" name="delivery_mode" value="courier">
              Courier — West Malaysia (RM 25)</label>
          </div>

          <div class="form-group">
            <label for="preferred_date">Preferred Date <span class="required-star">*</span></label>
            <input type="date" id="preferred_date" name="preferred_date"
                   min="2026-04-09" required>
          </div>

          <div class="form-group">
            <label for="delivery_address">Delivery Address</label>
            <input type="text" id="delivery_address" name="delivery_address"
                   maxlength="100"
                   placeholder="Required if choosing home delivery or courier">
          </div>
        </fieldset>

        <!-- Payment Method -->
        <fieldset>
          <legend>Payment Method <span class="required-star">*</span></legend>
          <div class="radio-group">
            <label><input type="radio" name="payment_mode" value="fpx" required>
              Online Banking (FPX)</label>
            <label><input type="radio" name="payment_mode" value="cash">
              Cash on Pickup / Delivery</label>
            <label><input type="radio" name="payment_mode" value="transfer">
              Bank Transfer</label>
          </div>

          <div class="form-group">
            <label for="special_notes">Special Notes / Requests</label>
            <textarea id="special_notes" name="special_notes" rows="4"
                      placeholder="Any special instructions..."></textarea>
          </div>

          <div class="form-group">
            <label class="checkbox-label">
              <input type="checkbox" id="checkbox" name="agree_terms" value="yes" required>
              I agree to that no refunds shall be granted upon purchase completion.
              <span class="required-star">*</span>
            </label>
          </div>
        </fieldset>

        <div class="form-actions">
          <button type="submit" class="btn-submit">Place Order 🌵</button>
          <button type="reset" class="btn-reset">Clear Form</button>
        </div>

      </form>

    </div><!-- /.order-form-area -->

  </main>

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
