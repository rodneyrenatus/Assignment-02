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
  <meta name="description" content="Our succulent collection — Echeveria, Haworthia, Aloe Vera, Sedum.">
  <meta name="keywords" content="succulents, echeveria, haworthia, aloe vera, kuching">
  <meta name="author" content="Cacti-Succulent Kuching Team">
  <title>Succulents | Cacti-Succulent Kuching</title>
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
      <?php if (isset($_SESSION['role'])): ?><a href="logout.php">Logout</a><?php else: ?><a href="login.php">Login</a><?php endif; ?>
      <a href="enquiry.php">Enquiry</a>
      <a href="members.php">Members</a>
      <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?><a href="dashboard.php">Dashboard</a><?php endif; ?>
    </nav>
  </header>

  <section class="hero">
    <div class="hero-container">
      <div class="hero-text">
        <span class="badge">Colour &amp; Charm</span>
        <h1>Our <span>Succulents</span></h1>
        <p>Succulents are the perfect plant for busy people and small spaces. Their compact
           rosette forms, vivid colours, and near-zero maintenance needs make them ideal for
           desks, shelves, and window ledges. We stock a carefully chosen selection of
           varieties that thrive in Kuching's warm, humid climate without any fuss.</p>
        <div class="action-group">
          <a href="#products" class="btn-solid">View Collection</a>
          <a href="order.php" class="btn-outline">Place an Order →</a>
        </div>
      </div>
      <div class="hero-image">
        <img src="images/succulent.webp" alt="Succulent Collection">
      </div>
    </div>
  </section>

  <main class="content-clearfix">

    <aside>
      <h2>Care Tips</h2>

      <h3>Aloe Vera</h3>
      <ul>
        <li>Bright light, tolerates full sun</li>
        <li>Water deeply but infrequently</li>
        <li>Gel inside leaves soothes skin burns</li>
      </ul>

      <h3>Sedum</h3>
      <ul>
        <li>Full sun to partial shade</li>
        <li>Drought-tolerant once established</li>
        <li>Great for hanging baskets and borders</li>
      </ul>

      <h3>Echeveria Elegans Raspberry Ice</h3>
      <ul>
        <li>Bright indirect light, 4–6 hrs daily</li>
        <li>Water when top inch of soil is dry</li>
        <li>Avoid overhead watering — causes rot</li>
      </ul>

      <h3>Jade Plant</h3>
      <ul>
        <li>Bright indirect to moderate direct light</li>
        <li>Water every 2–3 weeks; less in winter</li>
        <li>Well-draining succulent mix</li>
      </ul>

      <h3>Lithops</h3>
      <ul>
        <li>Full sun to very bright indirect light</li>
        <li>Water only during active growth season</li>
        <li>Pure mineral substrate — no organic soil</li>
      </ul>

      <h3>String of Pearls</h3>
      <ul>
        <li>Bright indirect light — harsh sun burns pearls</li>
        <li>Water every 2 weeks; even less in winter</li>
        <li>Ideal in hanging pots for trailing display</li>
      </ul>

      <h3>Burro's Tail</h3>
      <ul>
        <li>Bright indirect to gentle direct light</li>
        <li>Water sparingly — leaves hold reserves</li>
        <li>Handle carefully — leaves detach easily</li>
      </ul>

      <h3>Haworthia Limifolia</h3>
      <ul>
        <li>Low to bright indirect light</li>
        <li>Water every 2–3 weeks, less in winter</li>
        <li>Well-draining succulent or cactus mix</li>
      </ul>

      <h3>Mini Echeveria</h3>
      <ul>
        <li>Bright indirect light, 4–5 hrs daily</li>
        <li>Water when soil is dry to the touch</li>
        <li>Perfect for small pots and terrariums</li>
      </ul>
    </aside>

    <section id="products" class="product-showcase">
      <div class="section-header">
        <h2>Our Featured <em>Succulents</em></h2>
        <p>Compact, colourful, and effortless to care for.</p>
      </div>

      <div class="product-grid">

        <article class="product-card">
          <figure>
            <img src="images/aloe.jpg" alt="Aloe Vera">
            <figcaption>Medicinal Aloe</figcaption>
          </figure>
          <div class="card-body">
            <h3>Aloe Vera</h3>
            <p>The classic household succulent with dual purpose — an attractive plant
               with fleshy spear-like leaves and a natural gel inside that soothes
               sunburn and minor skin irritations.</p>
            <dl class="plant-specs">
              <dt>Sunlight</dt><dd>Bright to Full Sun</dd>
              <dt>Water</dt><dd>Low</dd>
            </dl>
            <div class="card-footer">
              <span class="price">RM 10.00</span>
              <a href="order.php" class="buy-btn">Order Now</a>
            </div>
          </div>
        </article>

        <article class="product-card">
          <figure>
            <img src="images/sedum.webp" alt="Sedum">
            <figcaption>Stonecrop</figcaption>
          </figure>
          <div class="card-body">
            <h3>Sedum</h3>
            <p>A versatile spreading succulent perfect for ground cover, hanging baskets,
               and border planting. Its tiny star-shaped flowers attract pollinators in
               season and it requires almost no upkeep.</p>
            <dl class="plant-specs">
              <dt>Sunlight</dt><dd>Full Sun to Partial</dd>
              <dt>Water</dt><dd>Very Low</dd>
            </dl>
            <div class="card-footer">
              <span class="price">RM 9.00</span>
              <a href="order.php" class="buy-btn">Order Now</a>
            </div>
          </div>
        </article>


        <article class="product-card">
          <figure>
            <img src="images/s111.jpg" alt="Echeveria Elegans Raspberry Ice">
            <figcaption>Raspberry Ice Rosette</figcaption>
          </figure>
          <div class="card-body">
            <h3>Echeveria Elegans Raspberry Ice</h3>
            <p>A stunning cultivar of the classic Echeveria with silvery-blue leaves
               edged in vivid raspberry-pink. Forms tight, perfectly symmetrical rosettes
               that intensify in colour with more light. Produces offsets freely around
               the base for easy propagation.</p>
            <dl class="plant-specs">
              <dt>Sunlight</dt><dd>Bright Indirect</dd>
              <dt>Water</dt><dd>Moderate</dd>
            </dl>
            <div class="card-footer">
              <span class="price">RM 25.00</span>
              <a href="order.php" class="buy-btn">Order Now</a>
            </div>
          </div>
        </article>

        <article class="product-card">
          <figure>
            <img src="images/s12.avif" alt="Jade Plant">
            <figcaption>Money Plant</figcaption>
          </figure>
          <div class="card-body">
            <h3>Jade Plant</h3>
            <p>Crassula ovata, the beloved "Money Plant" of Southeast Asian homes. Its
               thick, glossy, oval leaves and woody trunk give it the appearance of a
               miniature tree. Believed to attract good fortune, it grows well indoors
               and can live for decades with minimal care.</p>
            <dl class="plant-specs">
              <dt>Sunlight</dt><dd>Bright Indirect</dd>
              <dt>Water</dt><dd>Low</dd>
            </dl>
            <div class="card-footer">
              <span class="price">RM 30.00</span>
              <a href="order.php" class="buy-btn">Order Now</a>
            </div>
          </div>
        </article>

        <article class="product-card">
          <figure>
            <img src="images/s14.jpg" alt="Lithops">
            <figcaption>Living Stones</figcaption>
          </figure>
          <div class="card-body">
            <h3>Lithops</h3>
            <p>Among the most remarkable plants on Earth — Lithops have evolved to
               mimic the surrounding pebbles and stones so perfectly that they are nearly
               invisible in the wild. Each "stone" is actually a pair of thick, fleshy
               leaves. They produce surprisingly large, daisy-like flowers from between
               the leaves in season.</p>
            <dl class="plant-specs">
              <dt>Sunlight</dt><dd>Full Sun</dd>
              <dt>Water</dt><dd>Extremely Low</dd>
            </dl>
            <div class="card-footer">
              <span class="price">RM 22.00</span>
              <a href="order.php" class="buy-btn">Order Now</a>
            </div>
          </div>
        </article>

        <article class="product-card">
          <figure>
            <img src="images/s15.jpg" alt="String of Pearls">
            <figcaption>Bead Chain Succulent</figcaption>
          </figure>
          <div class="card-body">
            <h3>String of Pearls</h3>
            <p>Senecio rowleyanus produces long trailing stems lined with perfectly round,
               pea-sized leaves that genuinely resemble a string of green pearls. Ideal in
               a hanging pot where its cascading tendrils can drape dramatically. Each
               "pearl" stores water, making it very drought-tolerant once established.</p>
            <dl class="plant-specs">
              <dt>Sunlight</dt><dd>Bright Indirect</dd>
              <dt>Water</dt><dd>Very Low</dd>
            </dl>
            <div class="card-footer">
              <span class="price">RM 28.00</span>
              <a href="order.php" class="buy-btn">Order Now</a>
            </div>
          </div>
        </article>

        <article class="product-card">
          <figure>
            <img src="images/s16.avif" alt="Burro's Tail">
            <figcaption>Donkey's Tail</figcaption>
          </figure>
          <div class="card-body">
            <h3>Burro's Tail</h3>
            <p>Sedum morganianum produces thick, rope-like stems densely packed with
               plump, blue-green teardrop-shaped leaves that overlap like fish scales.
               The stems cascade downward up to 60 cm, making it one of the most dramatic
               hanging succulents available. Handle gently — leaves detach at the slightest
               touch but root readily if placed on dry soil.</p>
            <dl class="plant-specs">
              <dt>Sunlight</dt><dd>Bright Indirect</dd>
              <dt>Water</dt><dd>Low</dd>
            </dl>
            <div class="card-footer">
              <span class="price">RM 35.00</span>
              <a href="order.php" class="buy-btn">Order Now</a>
            </div>
          </div>
        </article>

        <article class="product-card">
          <figure>
            <img src="images/s17.jpg" alt="Haworthia Limifolia">
            <figcaption>File-Leaf Haworthia</figcaption>
          </figure>
          <div class="card-body">
            <h3>Haworthia Limifolia</h3>
            <p>Distinguished from the common Zebra Haworthia by its uniquely textured
               leaves — horizontal ridged bands cover the dark green surface, giving each
               leaf the look of a tiny file or washboard. Forms a compact rosette that
               stays manageable in small pots and tolerates low-light environments
               exceptionally well.</p>
            <dl class="plant-specs">
              <dt>Sunlight</dt><dd>Low to Indirect</dd>
              <dt>Water</dt><dd>Low</dd>
            </dl>
            <div class="card-footer">
              <span class="price">RM 26.00</span>
              <a href="order.php" class="buy-btn">Order Now</a>
            </div>
          </div>
        </article>

        <article class="product-card">
          <figure>
            <img src="images/s19.webp" alt="Mini Echeveria">
            <figcaption>Compact Rosette</figcaption>
          </figure>
          <div class="card-body">
            <h3>Mini Echeveria</h3>
            <p>A petite Echeveria variety that stays small and compact — ideal for
               desk arrangements, terrariums, fairy gardens, and gift pots. Despite its
               small size it produces the same eye-catching rosette form and rich colours
               as its larger relatives. Multiplies readily into charming clusters.</p>
            <dl class="plant-specs">
              <dt>Sunlight</dt><dd>Bright Indirect</dd>
              <dt>Water</dt><dd>Low</dd>
            </dl>
            <div class="card-footer">
              <span class="price">RM 15.00</span>
              <a href="order.php" class="buy-btn">Order Now</a>
            </div>
          </div>
        </article>

      </div>
    </section>

    <!-- Product detail descriptions -->
    <section id="product-details">
      <h2>Product Information</h2>

      <div class="detail-box" id="details-aloe">
        <h3>Aloe Vera</h3>
        <p>Aloe barbadensis miller is one of the most widely cultivated plants in the world,
           prized both as an ornamental and for the cooling, antiseptic gel contained within
           its thick spear-like leaves. The gel can be applied directly from a freshly cut
           leaf to soothe sunburn, minor cuts, and dry skin. It grows quickly in bright light,
           producing offsets freely from the base, and tolerates some neglect well. In
           Kuching's warm climate it can be grown indoors or outdoors and benefits from
           a deep pot that accommodates its fibrous root system.</p>
      </div>

      <div class="detail-box" id="details-sedum">
        <h3>Sedum (Stonecrop)</h3>
        <p>Sedum is a vast genus of succulents ranging from mat-forming ground covers to
           upright clumping varieties. All store water in their small, fleshy leaves and
           are remarkably drought-tolerant once established. The trailing varieties are
           especially suited to hanging pots and window boxes where their dense foliage
           creates a lush, waterfall effect. Tiny star-shaped flowers — typically yellow,
           white, or pink — appear in dense clusters during the growing season and are
           highly attractive to bees and butterflies.</p>
      </div>

      <div class="detail-box" id="details-echeveria-raspberry">
        <h3>Echeveria Elegans Raspberry Ice</h3>
        <p>This sought-after cultivar takes the classic pale-blue Echeveria elegans and
           adds vivid raspberry-pink tips and margins that deepen in intensity with
           increased light exposure. The colouration is entirely stable and will not
           revert as long as the plant receives adequate brightness. It stays compact
           with tight, formal rosettes and is an excellent choice for arrangements and
           mixed succulent bowls where its distinctive two-tone colouring contrasts
           beautifully with greener neighbours.</p>
      </div>

      <div class="detail-box" id="details-jade">
        <h3>Jade Plant</h3>
        <p>Crassula ovata is one of Southeast Asia's most beloved houseplants and is
           considered a symbol of good fortune, prosperity, and friendship across many
           cultures. With age its stem becomes woody and trunk-like, giving it the
           appearance of a miniature bonsai tree. It is extraordinarily long-lived —
           specimens passed down through generations are common. It requires very little
           water (monthly in winter), tolerates some neglect, and grows well in the
           warm, humid conditions typical of Malaysian homes. Pink-white star-shaped
           flowers appear on mature plants during the cooler months.</p>
      </div>

      <div class="detail-box" id="details-lithops">
        <h3>Lithops (Living Stones)</h3>
        <p>Lithops are the masters of camouflage in the plant world. Native to the stony
           plains and deserts of southern Africa, each plant consists of just two thick,
           paired leaves that have evolved in shape, colour, and pattern to match the
           local rocks and gravel precisely. The top surface is translucent, allowing
           light through to the photosynthetic tissue inside. Watering must be carefully
           timed to the plant's growth cycle — water during active growth and flowering,
           then withhold completely while the old leaves split open to reveal a new pair
           forming inside. With the right regime, they are surprisingly rewarding and
           long-lived.</p>
      </div>

      <div class="detail-box" id="details-string-of-pearls">
        <h3>String of Pearls</h3>
        <p>Senecio rowleyanus (now reclassified as Curio rowleyanus) is one of the most
           visually distinctive succulents in existence. Each nearly perfect spherical
           leaf reduces surface area to minimise water loss while the translucent window
           on each "pearl" allows sunlight to reach the interior for photosynthesis. The
           long, slender stems trail freely and can reach 60–90 cm in a hanging pot.
           Tiny white, cinnamon-scented flowers appear on upright stalks during the
           cooler months. It is somewhat fussier than other succulents — it dislikes
           direct midday sun and overwatering — but in the right conditions is absolutely
           stunning.</p>
      </div>

      <div class="detail-box" id="details-burros-tail">
        <h3>Burro's Tail</h3>
        <p>Sedum morganianum is one of the most dramatic hanging succulents available.
           Each thick stem is densely packed with overlapping, plump, blue-green leaves
           arranged in a spiral pattern, creating a rope-like structure that eventually
           cascades 40–60 cm. The common name refers to the resemblance to a donkey's
           tail. Individual leaves detach very easily with the slightest touch, which
           makes the plant fragile to move but also allows effortless propagation —
           simply lay detached leaves on dry succulent mix and they will root and
           produce new plants within weeks.</p>
      </div>

      <div class="detail-box" id="details-haworthia-limifolia">
        <h3>Haworthia Limifolia</h3>
        <p>Haworthia limifolia, known as the "File Haworthia", is named for the
           distinctive transverse ridges that cross each leaf — resembling the teeth
           of a file or rasp. The dark green rosettes are stiffer and more architectural
           than the common Zebra Haworthia, giving them a bold presence despite their
           small size. Like all Haworthias they thrive in low light conditions, making
           them ideal for interior spots far from windows. A choice plant for terrariums
           and desktop arrangements, it grows slowly and stays tidy in the same small
           pot for many years.</p>
      </div>

      <div class="detail-box" id="details-mini-echeveria">
        <h3>Mini Echeveria</h3>
        <p>Mini Echeveria varieties are specifically selected or bred to remain small and
           compact — typically under 5 cm across — while retaining all the charm and colour
           of their full-sized counterparts. They are perfectly proportioned for small
           terracotta pots, terrarium arrangements, fairy gardens, and succulent bowls.
           They propagate readily from offsets and leaf cuttings, making them excellent
           plants for sharing. Their small size and low water needs also make them one of
           the most popular choices for desk plants and low-maintenance gifts.</p>
      </div>
    </section>

    <section id="pricing">
      <h2>Price List</h2>
      <div class="content-box">
        <table>
          <thead>
            <tr><th>Product</th><th>Price (RM)</th><th>Size</th></tr>
          </thead>
          <tbody>
            <tr><td>Aloe Vera</td><td>RM 10.00</td><td>Medium</td></tr>
            <tr><td>Sedum</td><td>RM 9.00</td><td>Small</td></tr>
            <tr><td>Echeveria Elegans Raspberry Ice</td><td>RM 25.00</td><td>Small</td></tr>
            <tr><td>Jade Plant</td><td>RM 30.00</td><td>Medium</td></tr>
            <tr><td>Lithops</td><td>RM 22.00</td><td>Small</td></tr>
            <tr><td>String of Pearls</td><td>RM 28.00</td><td>Medium</td></tr>
            <tr><td>Burro's Tail</td><td>RM 35.00</td><td>Medium</td></tr>
            <tr><td>Haworthia Limifolia</td><td>RM 26.00</td><td>Small</td></tr>
            <tr><td>Mini Echeveria</td><td>RM 15.00</td><td>Small</td></tr>
          </tbody>
        </table>
      </div>
    </section>

    <section id="ordering">
      <h2>How to Order</h2>
      <div class="list-container">
        <ol>
          <li>Choose your succulent from the collection above.</li>
          <li>Go to the <a href="order.php">Order page</a> via the navigation menu.</li>
          <li>Fill in your details and preferred delivery option.</li>
          <li>Submit — we will confirm within 24 hours.</li>
        </ol>
      </div>
    </section>

    <section id="definitions">
      <h2>Succulent Terms</h2>
      <div class="definition-box">
        <dl>
          <dt>Succulent</dt>
          <dd>A plant that stores water in thick, fleshy leaves or stems, allowing it to
              survive long dry periods with minimal watering.</dd>
          <dt>Rosette</dt>
          <dd>A circular arrangement of leaves radiating out from a central growing point,
              typical of Echeveria and Haworthia species.</dd>
          <dt>Offset (Pup)</dt>
          <dd>A small plantlet that grows from the base of the parent plant and can be
              separated to propagate a new individual.</dd>
          <dt>Etiolation</dt>
          <dd>The stretching of a succulent caused by insufficient light — the plant reaches
              toward the light source, losing its compact shape.</dd>
        </dl>
      </div>
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
