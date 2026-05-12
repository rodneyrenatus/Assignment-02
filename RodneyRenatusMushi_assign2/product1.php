<?php
$site_name = "Cacti-Succulent Kuching";
$current_year = 2026;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Our cacti collection — Mammillaria, Opuntia, Astrophytum, Ariocarpus.">
  <meta name="keywords" content="cactus, cacti, kuching, ariocarpus, astrophytum, mammillaria">
  <meta name="author" content="Cacti-Succulent Kuching Team">
  <title>Cacti | Cacti-Succulent Kuching</title>
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

  <section class="hero">
    <div class="hero-container">
      <div class="hero-text">
        <span class="badge">Our Collection</span>
        <h1>About Our <span>Cacti</span></h1>
        <p>Our cacti are popular among customers for their low-maintenance nature, adaptability
           to small urban spaces, and high resilience to heat. Our collection includes a wide
           range of species suitable for both beginners and dedicated collectors. Each plant is
           hand-picked and acclimatized to Sarawak's humidity before sale, ensuring better
           survival rates in local homes and offices.</p>
        <div class="action-group">
          <a href="#products" class="btn-solid">View Collection</a>
          <a href="order.php" class="btn-outline">Place an Order →</a>
        </div>
      </div>
      <div class="hero-image">
        <img src="images/succulents.jpeg" alt="Featured Cactus Collection">
      </div>
    </div>
  </section>

  <main class="content-clearfix">

    <aside id="care-tips">
      <h2>Expert Care Tips</h2>

      <h3>Ariocarpus</h3>
      <ul>
        <li>Bright, filtered light — avoid harsh afternoon sun</li>
        <li>Water sparingly; dormant in winter</li>
        <li>Pure mineral substrate protects taproots</li>
      </ul>

      <h3>Golden Barrel Cactus</h3>
      <ul>
        <li>Full sun, 6+ hours daily</li>
        <li>Water deeply but infrequently</li>
        <li>Gritty, fast-draining cactus mix</li>
      </ul>

      <h3>Bunny Ear Cactus</h3>
      <ul>
        <li>Full sun for 6+ hours daily</li>
        <li>Water only when completely dry</li>
        <li>Needs pumice/perlite for fast drainage</li>
      </ul>

      <h3>Moon Cactus</h3>
      <ul>
        <li>Bright indirect light — avoid harsh direct sun</li>
        <li>Water sparingly; let soil dry completely</li>
        <li>Keep warm; sensitive to cold drafts</li>
      </ul>

      <h3>Fairy Castle Cactus</h3>
      <ul>
        <li>Full sun to bright indirect light</li>
        <li>Water only when soil is bone dry</li>
        <li>Sandy, well-draining mix essential</li>
      </ul>

      <h3>Old Lady Cactus</h3>
      <ul>
        <li>Full sun, 4–6 hours daily</li>
        <li>Water sparingly — especially in winter</li>
        <li>Avoid wetting the white hair covering</li>
      </ul>

      <h3>Hedgehog Cactus</h3>
      <ul>
        <li>Full sun for best flowering</li>
        <li>Water when soil is completely dry</li>
        <li>Well-draining mineral soil mix</li>
      </ul>

      <h3>Bishop's Cap Cactus</h3>
      <ul>
        <li>Bright indirect to moderate direct light</li>
        <li>Water minimally — very rot prone</li>
        <li>Mineral-rich, near-zero organic substrate</li>
      </ul>

      <h3>Mini Saguaro Cactus</h3>
      <ul>
        <li>Full sun, 6+ hours daily</li>
        <li>Water deeply, then allow to dry fully</li>
        <li>Coarse sand and perlite mix</li>
      </ul>
    </aside>

    <!-- Products Section -->
    <section id="products" class="product-showcase">
      <div class="section-header">
        <h2>Our Featured <em>Cacti</em></h2>
        <p>Hand-picked from our Kuching garden to your home.</p>
      </div>

      <div class="product-grid">


        <article class="product-card">
          <figure>
            <img src="images/ariocarpus.jpeg" alt="Ariocarpus">
            <figcaption>The Living Rock</figcaption>
          </figure>
          <div class="card-body">
            <h3>Ariocarpus</h3>
            <p>The "Living Rock" blends seamlessly into the ground. A rare, slow-growing
               collector species that naturally fits its container and rarely needs repotting.</p>
            <dl class="plant-specs">
              <dt>Sunlight</dt><dd>Bright Filtered</dd>
              <dt>Water</dt><dd>Very Low</dd>
            </dl>
            <div class="card-footer">
              <span class="price">RM 29.10</span>
              <a href="order.php" class="buy-btn">Order Now</a>
            </div>
          </div>
        </article>


        <article class="product-card">
          <figure>
            <img src="images/c1.webp" alt="Golden Barrel Cactus">
            <figcaption>Golden Barrel</figcaption>
          </figure>
          <div class="card-body">
            <h3>Golden Barrel Cactus</h3>
            <p>A bold, globe-shaped cactus armoured with striking golden-yellow spines.
               Renowned for its symmetry and dramatic presence in both indoor and outdoor
               desert gardens. Very drought-tolerant and long-lived.</p>
            <dl class="plant-specs">
              <dt>Sunlight</dt><dd>6+ hrs Full Sun</dd>
              <dt>Water</dt><dd>Very Low</dd>
            </dl>
            <div class="card-footer">
              <span class="price">RM 35.00</span>
              <a href="order.php" class="buy-btn">Order Now</a>
            </div>
          </div>
        </article>

        <article class="product-card">
          <figure>
            <img src="images/Bunny-Ear-Cactus.jpg" alt="Bunny Ear Cactus">
            <figcaption>Bunny Ear Cactus</figcaption>
          </figure>
          <div class="card-body">
            <h3>Bunny Ear Cactus</h3>
            <p>A charming flat-padded Opuntia variety instantly recognised by its paired
               rounded pads that resemble rabbit ears. Covered in tiny golden glochids —
               cute-looking but handle with gloves. Extremely easy to grow.</p>
            <dl class="plant-specs">
              <dt>Sunlight</dt><dd>6+ hrs Full Sun</dd>
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
            <img src="images/c2.webp" alt="Moon Cactus">
            <figcaption>Moon Cactus</figcaption>
          </figure>
          <div class="card-body">
            <h3>Moon Cactus</h3>
            <p>A vibrant grafted cactus featuring a brilliantly coloured chlorophyll-free
               top — available in red, orange, and yellow — fused onto a hardy green
               Hylocereus base. A striking conversation piece for any desk or windowsill.</p>
            <dl class="plant-specs">
              <dt>Sunlight</dt><dd>Bright Indirect</dd>
              <dt>Water</dt><dd>Very Low</dd>
            </dl>
            <div class="card-footer">
              <span class="price">RM 22.00</span>
              <a href="order.php" class="buy-btn">Order Now</a>
            </div>
          </div>
        </article>

        <article class="product-card">
          <figure>
            <img src="images/c3.jpg" alt="Fairy Castle Cactus">
            <figcaption>Fairy Castle Cactus</figcaption>
          </figure>
          <div class="card-body">
            <h3>Fairy Castle Cactus</h3>
            <p>Grows as a cluster of tall, ribbed green columns of varying heights that
               resemble the turrets of a miniature castle. A slow grower with architectural
               appeal that suits small pots and terrarium arrangements beautifully.</p>
            <dl class="plant-specs">
              <dt>Sunlight</dt><dd>Full to Bright Indirect</dd>
              <dt>Water</dt><dd>Low</dd>
            </dl>
            <div class="card-footer">
              <span class="price">RM 40.00</span>
              <a href="order.php" class="buy-btn">Order Now</a>
            </div>
          </div>
        </article>

        <article class="product-card">
          <figure>
            <img src="images/c4.jpg" alt="Old Lady Cactus">
            <figcaption>Old Lady Cactus</figcaption>
          </figure>
          <div class="card-body">
            <h3>Old Lady Cactus</h3>
            <p>Mammillaria hahniana is blanketed in soft white hair-like spines that give
               it a distinctly fluffy, woolly appearance. In spring it produces a stunning
               crown of bright magenta-pink flowers encircling its top — a real show-stopper.</p>
            <dl class="plant-specs">
              <dt>Sunlight</dt><dd>Full Sun</dd>
              <dt>Water</dt><dd>Very Low</dd>
            </dl>
            <div class="card-footer">
              <span class="price">RM 30.00</span>
              <a href="order.php" class="buy-btn">Order Now</a>
            </div>
          </div>
        </article>

        <article class="product-card">
          <figure>
            <img src="images/c5.webp" alt="Star Cactus">
            <figcaption>Star Cactus</figcaption>
          </figure>
          <div class="card-body">
            <h3>Star Cactus</h3>
            <p>A small, smooth-skinned cactus with a perfect star-shaped cross-section when
               viewed from above. Its spineless, geometric form and silvery-white flecks
               make it one of the most photogenic species in any collection.</p>
            <dl class="plant-specs">
              <dt>Sunlight</dt><dd>Bright Indirect</dd>
              <dt>Water</dt><dd>Very Low</dd>
            </dl>
            <div class="card-footer">
              <span class="price">RM 38.00</span>
              <a href="order.php" class="buy-btn">Order Now</a>
            </div>
          </div>
        </article>

        <article class="product-card">
          <figure>
            <img src="images/c6.jpg" alt="Hedgehog Cactus">
            <figcaption>Hedgehog Cactus</figcaption>
          </figure>
          <div class="card-body">
            <h3>Hedgehog Cactus</h3>
            <p>Echinocereus produces cylindrical, ribbed stems clustered together like a
               hedgehog. Known for producing some of the most vivid flowers of any cactus —
               large magenta or orange blooms that emerge from the sides of the stems in season.</p>
            <dl class="plant-specs">
              <dt>Sunlight</dt><dd>Full Sun</dd>
              <dt>Water</dt><dd>Low</dd>
            </dl>
            <div class="card-footer">
              <span class="price">RM 33.00</span>
              <a href="order.php" class="buy-btn">Order Now</a>
            </div>
          </div>
        </article>

        <article class="product-card">
          <figure>
            <img src="images/c7.jpg" alt="Bishops Cap Cactus">
            <figcaption>Bishop's Cap Cactus</figcaption>
          </figure>
          <div class="card-body">
            <h3>Bishop's Cap Cactus</h3>
            <p>Astrophytum myriostigma is a completely spineless cactus with deep ribs and
               a powdery silver-white surface dotted with tiny white scales. Its clean geometric
               form and zero-spine handling make it ideal for display and safe for households
               with children.</p>
            <dl class="plant-specs">
              <dt>Sunlight</dt><dd>Bright Indirect</dd>
              <dt>Water</dt><dd>Very Low</dd>
            </dl>
            <div class="card-footer">
              <span class="price">RM 42.00</span>
              <a href="order.php" class="buy-btn">Order Now</a>
            </div>
          </div>
        </article>

        <article class="product-card">
          <figure>
            <img src="images/c8.webp" alt="Mini Saguaro Cactus">
            <figcaption>Mini Saguaro Cactus</figcaption>
          </figure>
          <div class="card-body">
            <h3>Mini Saguaro Cactus</h3>
            <p>A compact indoor-scale version of the iconic Saguaro silhouette — tall,
               multi-armed, and unmistakably "cactus". Slow-growing and long-lived, it
               gradually develops its characteristic branched arms over the years, becoming
               a true heirloom piece.</p>
            <dl class="plant-specs">
              <dt>Sunlight</dt><dd>6+ hrs Full Sun</dd>
              <dt>Water</dt><dd>Very Low</dd>
            </dl>
            <div class="card-footer">
              <span class="price">RM 50.00</span>
              <a href="order.php" class="buy-btn">Order Now</a>
            </div>
          </div>
        </article>

      </div>
    </section>

    <!-- Product detail descriptions -->
    <section id="product-details">
      <h2>Product Information</h2>


      <div class="detail-box" id="details-ariocarpus">
        <h3>Ariocarpus</h3>
        <p>One of the most unusual cacti available, the Ariocarpus (or "Living Rock") has
           tubercles that so closely resemble stones it can be nearly invisible in a rocky
           garden bed. It is slow-growing and long-lived, making it a worthy investment for
           the serious collector. Requires purely mineral substrate to protect its sensitive
           taproot system from rot.</p>
      </div>

      <div class="detail-box" id="details-golden-barrel">
        <h3>Golden Barrel Cactus</h3>
        <p>The Golden Barrel (Echinocactus grusonii) is one of the most iconic cacti in
           the world — a perfectly round globe densely covered in rigid golden-yellow spines
           that radiate from a flat, woolly crown. Native to central Mexico, it thrives in
           intense sunlight and near-desert conditions. In Kuching's warm climate it does
           exceptionally well on sunny balconies and open patios. Young plants grow
           relatively quickly but mature specimens can take decades to reach their full size,
           making each one a long-term living sculpture.</p>
      </div>

      <div class="detail-box" id="details-bunny-ear">
        <h3>Bunny Ear Cactus</h3>
        <p>The Bunny Ear Cactus (Opuntia microdasys var.) produces pairs of flat, oval
           pads covered in dense clusters of tiny golden or white glochids — hair-like
           barbed spines that are much more irritating than they look. Despite needing
           careful handling, it is one of the easiest cacti to grow and propagate: pads
           can be snapped off and rooted in dry soil within weeks. Produces pale yellow
           flowers and small reddish-purple fruit on mature plants grown in full sun.</p>
      </div>

      <div class="detail-box" id="details-moon-cactus">
        <h3>Moon Cactus</h3>
        <p>The Moon Cactus is a horticultural creation — a bright-coloured mutant cactus
           (Gymnocalycium mihanovichii) that lacks chlorophyll and cannot survive on its
           own. It is grafted onto a green Hylocereus rootstock that supplies it with water
           and nutrients. The vivid red, orange, or yellow crown is entirely stable and will
           not fade. Because it cannot photosynthesise, it prefers bright indirect light
           rather than harsh direct sun. With proper care, the graft union can remain
           healthy for many years.</p>
      </div>

      <div class="detail-box" id="details-fairy-castle">
        <h3>Fairy Castle Cactus</h3>
        <p>Acanthocereus tetragonus 'Fairy Castle' earned its name from the way it grows:
           multiple columnar stems of varying heights cluster together, each capped with
           small tufts of white hair-like spines, creating a skyline that genuinely
           resembles a miniature castle. It is a slow but steady grower and rarely needs
           repotting. Flowering is uncommon indoors but occasionally produces large white
           nocturnal blooms on plants that have matured for several years.</p>
      </div>

      <div class="detail-box" id="details-old-lady">
        <h3>Old Lady Cactus</h3>
        <p>Mammillaria hahniana earns its affectionate name from the dense covering of
           long, soft white hair-like spines that wrap the entire body of the plant,
           giving it a distinctly aged and woolly appearance. Beneath this fluffy coat,
           hidden sharp spines provide real protection — so handle with care. Each spring
           it reliably produces a complete ring of small, vivid magenta-pink flowers
           around its crown without requiring any special treatment, making it one of the
           most rewarding flowering cacti for beginners.</p>
      </div>

      <div class="detail-box" id="details-star-cactus-new">
        <h3>Star Cactus</h3>
        <p>This spineless, smooth-textured cactus takes its common name from its perfect
           star-shaped outline when viewed from above. Its pale green body is dusted with
           tiny white areole scales, giving a frosted, silvery appearance. Unlike most
           cacti it handles brief periods of cooler temperatures well, and its lack of
           spines means it can be safely placed where children or pets may brush against
           it. Produces bright yellow flowers with a red throat during the growing season
           on plants given ample light.</p>
      </div>

      <div class="detail-box" id="details-hedgehog">
        <h3>Hedgehog Cactus</h3>
        <p>Echinocereus is named for its spiny, rounded clusters of cylindrical stems
           that expand outward at the base like a hedgehog rolled into a ball. What
           distinguishes this genus above all else is its flowers: large, showy, and
           intensely coloured — most commonly brilliant magenta or deep orange — they
           open wide during the day and can last for several days. They emerge directly
           from the sides of the stems rather than the crown, making the flowering display
           especially dramatic. Relatively fast-growing for a cactus and tolerant of
           Kuching's humidity when planted in sharp-draining soil.</p>
      </div>

      <div class="detail-box" id="details-bishops-cap">
        <h3>Bishop's Cap Cactus</h3>
        <p>Astrophytum myriostigma is distinguished from its Astrophytum relatives by its
           complete lack of spines — its surface is smooth and covered entirely in minute
           white trichomes (tiny hair-like scales) that give the plant a dusty, silver-grey
           appearance. The name "Bishop's Cap" comes from the shape of a bishop's mitre,
           which the cactus resembles with its prominent vertical ribs and domed top.
           It is one of the cleanest and most elegant cacti available, perfectly safe to
           handle without gloves, and produces a cheerful yellow flower at its crown
           during the warm season.</p>
      </div>

      <div class="detail-box" id="details-mini-saguaro">
        <h3>Mini Saguaro Cactus</h3>
        <p>The Saguaro (Carnegiea gigantea) is the quintessential symbol of the American
           desert — the tall, many-armed silhouette printed on countless postcards and
           films. Our Mini Saguaro is a compact cultivated variety suited for pot culture,
           bringing that iconic form indoors without requiring a full desert garden. It is
           extremely slow-growing, which means the plant you receive is already several
           years old. As it matures it gradually develops its characteristic branching
           arms, becoming more impressive with each passing year. A genuine collector's
           item and a true conversation starter.</p>
      </div>
    </section>

    <!-- Pricing table -->
    <section id="pricing">
      <h2>Price List</h2>
      <div class="content-box">
        <table>
          <thead>
            <tr>
              <th>Product</th>
              <th>Price (RM)</th>
              <th>Size</th>
            </tr>
          </thead>
          <tbody>
            <tr><td>Ariocarpus</td><td>RM 29.10</td><td>Small</td></tr>
            <tr><td>Golden Barrel Cactus</td><td>RM 35.00</td><td>Medium</td></tr>
            <tr><td>Bunny Ear Cactus</td><td>RM 28.00</td><td>Medium</td></tr>
            <tr><td>Moon Cactus</td><td>RM 22.00</td><td>Small</td></tr>
            <tr><td>Fairy Castle Cactus</td><td>RM 40.00</td><td>Medium</td></tr>
            <tr><td>Old Lady Cactus</td><td>RM 30.00</td><td>Small</td></tr>
            <tr><td>Star Cactus</td><td>RM 38.00</td><td>Small</td></tr>
            <tr><td>Hedgehog Cactus</td><td>RM 33.00</td><td>Medium</td></tr>
            <tr><td>Bishop's Cap Cactus</td><td>RM 42.00</td><td>Small</td></tr>
            <tr><td>Mini Saguaro Cactus</td><td>RM 50.00</td><td>Large</td></tr>
          </tbody>
        </table>
      </div>
    </section>

    <!-- How to order -->
    <section id="ordering">
      <h2>How to Order</h2>
      <div class="list-container">
        <ol>
          <li>Choose your cactus from the collection above.</li>
          <li>Navigate to the <a href="order.php">Order page</a> via the menu.</li>
          <li>Select your product, delivery mode, and payment method.</li>
          <li>Submit the form — we will confirm your order within 24 hours.</li>
        </ol>
      </div>
    </section>

    <!-- Definition list -->
    <section id="definitions">
      <h2>Plant Terms</h2>
      <div class="definition-box">
        <dl>
          <dt>Cactus</dt>
          <dd>A flowering plant endemic to hot and dry areas like deserts, known for its
              thick succulent stem and sharp needle-like thorns that reduce water loss.</dd>
          <dt>Tubercle</dt>
          <dd>A rounded bump or projection on a cactus from which spines or flowers grow.</dd>
          <dt>Glochid</dt>
          <dd>Tiny, hair-like barbed spines found on Opuntia species that easily detach
              and embed in skin — handle with gloves.</dd>
          <dt>Areole</dt>
          <dd>A specialised pad-like structure unique to cacti from which spines, flowers,
              and new growth emerge.</dd>
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
