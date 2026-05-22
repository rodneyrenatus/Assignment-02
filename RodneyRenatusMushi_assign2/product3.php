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
  <meta name="description" content="Pots and planters — terracotta, ceramic, and hanging planters.">
  <meta name="keywords" content="pots, planters, terracotta, ceramic, kuching">
  <meta name="author" content="Cacti-Succulent Kuching Team">
  <title>Pots &amp; Planters | Cacti-Succulent Kuching</title>
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
        <span class="badge">Home &amp; Garden</span>
        <h1>Pots &amp; <span>Planters</span></h1>
        <p>The right pot makes all the difference — both for your plant's health and for
           how it looks in your home. We stock terracotta classics that breathe and wick
           moisture, glazed ceramics for a splash of colour, and hanging planters for
           those who want to make the most of vertical space. All pots come with drainage
           holes to keep roots healthy.</p>
        <div class="action-group">
          <a href="#products" class="btn-solid">View Collection</a>
          <a href="order.php" class="btn-outline">Place an Order →</a>
        </div>
      </div>
      <div class="hero-image">
        <img src="images/potsnplanters.jpg" alt="Pots and Planters">
      </div>
    </div>
  </section>

  <main class="content-clearfix">

    <aside>
      <h2>Choosing a Pot</h2>

      <h3>Why Terracotta?</h3>
      <ul>
        <li>Porous walls allow roots to breathe</li>
        <li>Excess moisture evaporates through the sides</li>
        <li>Ideal for cacti and succulents</li>
      </ul>

      <h3>Why Ceramic?</h3>
      <ul>
        <li>Retains moisture longer — good for tropical plants</li>
        <li>Available in decorative glazes and colours</li>
        <li>Heavier — more stable for taller plants</li>
      </ul>

      <h3>Hanging Planters</h3>
      <ul>
        <li>Perfect for trailing succulents like Sedum</li>
        <li>Maximises vertical space in small rooms</li>
        <li>Ensure hooks are securely fastened to ceiling joists</li>
      </ul>

      <h3>Sizing Guide</h3>
      <ul>
        <li>Small (≤10cm): single cacti or rosettes</li>
        <li>Medium (11–20cm): aloe, haworthia clusters</li>
        <li>Large (21cm+): statement plants, groupings</li>
      </ul>

      <h3>Ceramic White Pot</h3>
      <ul>
        <li>Neutral white suits any plant or interior</li>
        <li>Drainage hole included — essential for succulents</li>
        <li>Wipe clean with a damp cloth</li>
      </ul>

      <h3>Concrete Pot</h3>
      <ul>
        <li>Heavy — stable for larger or taller plants</li>
        <li>Porous surface aids some aeration</li>
        <li>Avoid indoor use on polished surfaces without a saucer</li>
      </ul>

      <h3>Plastic Pot</h3>
      <ul>
        <li>Lightweight and easy to move</li>
        <li>Retains moisture longer — water less frequently</li>
        <li>Budget-friendly for growing collections</li>
      </ul>

      <h3>Self-Watering Pot</h3>
      <ul>
        <li>Reservoir waters plant from below via capillary action</li>
        <li>Check reservoir every 1–2 weeks</li>
        <li>Ideal for tropical plants; use with caution for succulents</li>
      </ul>

      <h3>Mini Decorative Pot</h3>
      <ul>
        <li>Perfect scale for mini succulents and cacti</li>
        <li>Pairs well with Lithops, Mini Echeveria, and Moon Cactus</li>
        <li>Group several together for a desktop display</li>
      </ul>

      <h3>Glass Pot Terrarium</h3>
      <ul>
        <li>Keep the lid off for succulents — they need airflow</li>
        <li>Layer gravel, charcoal, then soil for drainage</li>
        <li>Wipe glass interior monthly to prevent algae build-up</li>
      </ul>

      <h3>Wooden Planter Box</h3>
      <ul>
        <li>Line with plastic sheeting to protect wood from moisture</li>
        <li>Ideal for grouping multiple small plants together</li>
        <li>Treat exterior with outdoor wood oil annually</li>
      </ul>
    </aside>

    <section id="products" class="product-showcase">
      <div class="section-header">
        <h2>Our Pots &amp; Planters</h2>
        <p>Quality vessels that complement your plants and your interior style.</p>
      </div>

      <div class="product-grid">

        <article class="product-card">
          <figure>
            <img src="images/small_pot.jpg" alt="Terracotta Pot Small">
            <figcaption>Classic Terracotta</figcaption>
          </figure>
          <div class="card-body">
            <h3>Terracotta Pot (Small)</h3>
            <p>The classic unglazed terracotta pot — breathable, affordable, and
               perfectly suited to cacti and succulents. Comes with drainage hole
               and saucer. Diameter: 8–10 cm.</p>
            <dl class="plant-specs">
              <dt>Material</dt><dd>Unglazed Terracotta</dd>
              <dt>Size</dt><dd>Small (8–10 cm)</dd>
            </dl>
            <div class="card-footer">
              <span class="price">RM 5.00</span>
              <a href="order.php" class="buy-btn">Order Now</a>
            </div>
          </div>
        </article>

        <article class="product-card">
          <figure>
            <img src="images/large_pot.jpg" alt="Terracotta Pot Large">
            <figcaption>Large Terracotta</figcaption>
          </figure>
          <div class="card-body">
            <h3>Terracotta Pot (Large)</h3>
            <p>A larger version of our classic terracotta pot, ideal for aloe vera,
               larger cacti clusters, or statement succulents. Diameter: 18–22 cm.
               Deep drainage hole included.</p>
            <dl class="plant-specs">
              <dt>Material</dt><dd>Unglazed Terracotta</dd>
              <dt>Size</dt><dd>Large (18–22 cm)</dd>
            </dl>
            <div class="card-footer">
              <span class="price">RM 12.00</span>
              <a href="order.php" class="buy-btn">Order Now</a>
            </div>
          </div>
        </article>

        <article class="product-card">
          <figure>
            <img src="images/ceramic.webp" alt="Ceramic Decorative Pot">
            <figcaption>Glazed Ceramic</figcaption>
          </figure>
          <div class="card-body">
            <h3>Ceramic Decorative Pot</h3>
            <p>Hand-painted glazed ceramic pots in earth tones and muted greens that
               complement our succulent colour palette. Each pot is slightly unique.
               Diameter: 10–14 cm.</p>
            <dl class="plant-specs">
              <dt>Material</dt><dd>Glazed Ceramic</dd>
              <dt>Size</dt><dd>Medium (10–14 cm)</dd>
            </dl>
            <div class="card-footer">
              <span class="price">RM 18.00</span>
              <a href="order.php" class="buy-btn">Order Now</a>
            </div>
          </div>
        </article>

        <article class="product-card">
          <figure>
            <img src="images/hanging.jpg" alt="Hanging Planter">
            <figcaption>Hanging Planter</figcaption>
          </figure>
          <div class="card-body">
            <h3>Hanging Planter</h3>
            <p>Rope-hung terracotta planter perfect for trailing succulents and small
               cacti. Includes a coconut fibre liner to retain moisture. Comes with
               2m of natural jute rope.</p>
            <dl class="plant-specs">
              <dt>Material</dt><dd>Terracotta + Jute</dd>
              <dt>Diameter</dt><dd>12 cm</dd>
            </dl>
            <div class="card-footer">
              <span class="price">RM 22.00</span>
              <a href="order.php" class="buy-btn">Order Now</a>
            </div>
          </div>
        </article>

        <article class="product-card">
          <figure>
            <img src="images/p1.webp" alt="Ceramic White Pot">
            <figcaption>Ceramic White Pot</figcaption>
          </figure>
          <div class="card-body">
            <h3>Ceramic White Pot</h3>
            <p>A clean, minimal white ceramic pot that complements any plant style or
               interior decor. The neutral tone lets your plant take centre stage.
               Comes with a matching drainage hole and saucer. Diameter: 10–12 cm.</p>
            <dl class="plant-specs">
              <dt>Material</dt><dd>Glazed Ceramic</dd>
              <dt>Size</dt><dd>Medium (10–12 cm)</dd>
            </dl>
            <div class="card-footer">
              <span class="price">RM 14.00</span>
              <a href="order.php" class="buy-btn">Order Now</a>
            </div>
          </div>
        </article>

        <article class="product-card">
          <figure>
            <img src="images/p2.webp" alt="Terracotta Pot">
            <figcaption>Classic Terracotta</figcaption>
          </figure>
          <div class="card-body">
            <h3>Terracotta Pot (Medium)</h3>
            <p>Our mid-range unglazed terracotta pot — the ideal everyday pot for cacti
               and succulents of all kinds. Breathable walls encourage healthy roots and
               prevent waterlogging. Diameter: 12–14 cm with drainage hole.</p>
            <dl class="plant-specs">
              <dt>Material</dt><dd>Unglazed Terracotta</dd>
              <dt>Size</dt><dd>Medium (12–14 cm)</dd>
            </dl>
            <div class="card-footer">
              <span class="price">RM 10.00</span>
              <a href="order.php" class="buy-btn">Order Now</a>
            </div>
          </div>
        </article>

        <article class="product-card">
          <figure>
            <img src="images/p3.jpg" alt="Hanging Pot">
            <figcaption>Hanging Pot</figcaption>
          </figure>
          <div class="card-body">
            <h3>Hanging Pot</h3>
            <p>A lightweight plastic hanging pot with built-in rope for immediate
               suspension. Excellent for trailing succulents like String of Pearls,
               Burro's Tail, and Sedum. Includes a drip tray to protect ceilings
               and furniture. Diameter: 14 cm.</p>
            <dl class="plant-specs">
              <dt>Material</dt><dd>Lightweight Plastic</dd>
              <dt>Diameter</dt><dd>14 cm</dd>
            </dl>
            <div class="card-footer">
              <span class="price">RM 13.00</span>
              <a href="order.php" class="buy-btn">Order Now</a>
            </div>
          </div>
        </article>

        <article class="product-card">
          <figure>
            <img src="images/p4.jpg" alt="Concrete Pot">
            <figcaption>Industrial Concrete</figcaption>
          </figure>
          <div class="card-body">
            <h3>Concrete Pot</h3>
            <p>A solid, industrial-look concrete pot that provides exceptional stability
               for larger plants or specimens in breezy outdoor areas. Its grey texture
               creates a striking minimalist contrast with the greens and dusty colours
               of succulents and cacti. Diameter: 16 cm.</p>
            <dl class="plant-specs">
              <dt>Material</dt><dd>Cast Concrete</dd>
              <dt>Size</dt><dd>Large (16 cm)</dd>
            </dl>
            <div class="card-footer">
              <span class="price">RM 30.00</span>
              <a href="order.php" class="buy-btn">Order Now</a>
            </div>
          </div>
        </article>

        <article class="product-card">
          <figure>
            <img src="images/p5.webp" alt="Plastic Pot">
            <figcaption>Lightweight Plastic</figcaption>
          </figure>
          <div class="card-body">
            <h3>Plastic Pot</h3>
            <p>A no-fuss, budget-friendly plastic pot for the practical grower. Ideal
               for propagating cuttings, growing on seedlings, or housing plants you
               intend to repot later. Lightweight and stackable. Diameter: 10 cm with
               drainage holes.</p>
            <dl class="plant-specs">
              <dt>Material</dt><dd>Polypropylene</dd>
              <dt>Size</dt><dd>Small (10 cm)</dd>
            </dl>
            <div class="card-footer">
              <span class="price">RM 8.00</span>
              <a href="order.php" class="buy-btn">Order Now</a>
            </div>
          </div>
        </article>

        <article class="product-card">
          <figure>
            <img src="images/p6.webp" alt="Self Watering Pot">
            <figcaption>Self-Watering Reservoir</figcaption>
          </figure>
          <div class="card-body">
            <h3>Self-Watering Pot</h3>
            <p>Features a built-in water reservoir at the base that delivers moisture
               to the roots through a wicking system, maintaining consistent soil
               moisture without overwatering. Perfect for Aloe Vera, Jade Plants,
               and other moderate-water succulents. Diameter: 18 cm.</p>
            <dl class="plant-specs">
              <dt>Material</dt><dd>Polypropylene</dd>
              <dt>Size</dt><dd>Large (18 cm)</dd>
            </dl>
            <div class="card-footer">
              <span class="price">RM 43.00</span>
              <a href="order.php" class="buy-btn">Order Now</a>
            </div>
          </div>
        </article>

        <article class="product-card">
          <figure>
            <img src="images/p7.webp" alt="Mini Decorative Pot">
            <figcaption>Cute Desk Pot</figcaption>
          </figure>
          <div class="card-body">
            <h3>Mini Decorative Pot</h3>
            <p>A small, ornamental pot designed for mini succulents and desk cacti.
               Comes in assorted earth-tone glazes — terracotta, sage, and cream.
               Perfect for single specimens like Lithops, Moon Cactus, or Mini Echeveria.
               Diameter: 6–8 cm.</p>
            <dl class="plant-specs">
              <dt>Material</dt><dd>Glazed Ceramic</dd>
              <dt>Size</dt><dd>Small (6–8 cm)</dd>
            </dl>
            <div class="card-footer">
              <span class="price">RM 20.00</span>
              <a href="order.php" class="buy-btn">Order Now</a>
            </div>
          </div>
        </article>

        <article class="product-card">
          <figure>
            <img src="images/p8.jpg" alt="Glass Pot Terrarium">
            <figcaption>Glass Terrarium</figcaption>
          </figure>
          <div class="card-body">
            <h3>Glass Pot Terrarium</h3>
            <p>A geometric glass terrarium that showcases your succulents and cacti
               as living art. The open design allows good airflow, essential for
               preventing rot in desert plants. Layer the base with gravel, activated
               charcoal, and succulent soil for a self-contained miniature landscape.</p>
            <dl class="plant-specs">
              <dt>Material</dt><dd>Clear Borosilicate Glass</dd>
              <dt>Size</dt><dd>Medium (15 cm)</dd>
            </dl>
            <div class="card-footer">
              <span class="price">RM 60.00</span>
              <a href="order.php" class="buy-btn">Order Now</a>
            </div>
          </div>
        </article>

        <article class="product-card">
          <figure>
            <img src="images/p9.webp" alt="Wooden Planter Box">
            <figcaption>Rustic Planter Box</figcaption>
          </figure>
          <div class="card-body">
            <h3>Wooden Planter Box</h3>
            <p>A handcrafted wooden planter box with a natural, rustic finish — ideal
               for grouping several succulents or cacti together in a single display.
               Lined with a plastic tray insert to protect the wood. Dimensions:
               30 × 15 × 12 cm. Suits balconies and windowsills.</p>
            <dl class="plant-specs">
              <dt>Material</dt><dd>Natural Timber</dd>
              <dt>Size</dt><dd>Large (30 cm wide)</dd>
            </dl>
            <div class="card-footer">
              <span class="price">RM 54.00</span>
              <a href="order.php" class="buy-btn">Order Now</a>
            </div>
          </div>
        </article>

      </div>
    </section>

    <!-- Product detail descriptions -->
    <section id="product-details">
      <h2>Product Information</h2>

      <div class="detail-box" id="details-terra-small">
        <h3>Terracotta Pot (Small)</h3>
        <p>Our small terracotta pots are hand-selected for even wall thickness and
           consistent porosity. At 8–10 cm diameter they are perfectly sized for individual
           Mammillaria, Ariocarpus, Astrophytum, and Echeveria rosettes. The unglazed finish
           allows the pot walls to breathe — water evaporates through the sides, naturally
           helping to prevent root rot that often afflicts cacti in non-porous vessels.
           Each pot ships with a matching unglazed saucer.</p>
      </div>

      <div class="detail-box" id="details-terra-large">
        <h3>Terracotta Pot (Large)</h3>
        <p>The large terracotta pot (18–22 cm) is suited to statement specimens — mature
           Aloe Vera, large Golden Barrel Cacti, or sprawling Sedum arrangements. The same
           breathable, porous clay construction as the small version ensures excellent
           moisture regulation. Its weight provides stability for top-heavy plants and
           prevents tipping on windy balconies. A deep drainage hole prevents water
           pooling at the base.</p>
      </div>

      <div class="detail-box" id="details-ceramic">
        <h3>Ceramic Decorative Pot</h3>
        <p>Our glazed ceramic pots are sourced from local Sarawak potters who hand-paint
           each piece individually, meaning no two pots are identical. The earth-tone and
           muted green glazes were specifically chosen to complement the natural colours of
           succulent foliage. At 10–14 cm diameter they suit mid-sized succulents like
           Haworthia, Sedum, and Jade Plant. The glaze creates a partially water-retentive
           surface, so water slightly less frequently than with terracotta.</p>
      </div>

      <div class="detail-box" id="details-hanging">
        <h3>Hanging Planter</h3>
        <p>Our rope-hung hanging planter combines a small terracotta bowl with 2 metres
           of braided natural jute rope, finished with a macramé-style knot that distributes
           weight evenly. The coconut fibre liner sits inside the pot to help retain soil
           moisture without blocking drainage. It is perfectly suited to String of Pearls,
           Burro's Tail, trailing Sedum, and Hanging Pot varieties. The jute rope will
           gradually weather to a warm golden-brown with exposure to light and humidity.</p>
      </div>

      <div class="detail-box" id="details-ceramic-white">
        <h3>Ceramic White Pot</h3>
        <p>The Ceramic White Pot offers a fresh, contemporary look that works equally
           well in modern apartments, offices, and traditional homes. Its crisp white
           glaze provides a neutral canvas that allows the texture and colour of your
           plant to dominate. The smooth interior surface is easy to clean between
           repottings, and the glazed finish means it retains moisture slightly longer
           than unglazed terracotta — a benefit for succulents that prefer a slightly
           longer drying cycle between waterings.</p>
      </div>

      <div class="detail-box" id="details-terra-medium">
        <h3>Terracotta Pot (Medium)</h3>
        <p>Our medium terracotta pot bridges the gap between our small starter pots and
           the large statement pot. At 12–14 cm diameter it accommodates a wider range
           of plants including Haworthia clusters, maturing Echeveria, medium Aloe Vera,
           Opuntia, and most of our cactus collection. Like all our terracotta, it is
           kiln-fired and unglazed for maximum root breathability. The medium pot is
           our most popular size for a reason — it suits the vast majority of the plants
           in our catalogue.</p>
      </div>

      <div class="detail-box" id="details-hanging-plastic">
        <h3>Hanging Pot</h3>
        <p>The plastic Hanging Pot is a practical, lightweight alternative to our
           terracotta hanging planter. Its built-in rope attachment and integrated drip
           tray make it easy to install in any room without worrying about water damage
           to ceilings or furniture. The thicker plastic walls provide some insulation
           for roots and retain moisture longer than terracotta — which suits trailing
           succulents like String of Pearls and Burro's Tail that prefer slightly
           more frequent moisture than their desert relatives.</p>
      </div>

      <div class="detail-box" id="details-concrete">
        <h3>Concrete Pot</h3>
        <p>Our concrete pots are cast from a lightweight aggregate concrete that is
           significantly lighter than standard concrete while retaining the characteristic
           grey textural aesthetic. The matte, rough surface creates a striking industrial
           contrast with the soft forms of succulents and the neat geometry of cacti.
           Its weight makes it resistant to wind toppling on outdoor patios and balconies,
           and its mass helps moderate soil temperature fluctuations. Each pot has a
           pre-drilled drainage hole at the base.</p>
      </div>

      <div class="detail-box" id="details-plastic">
        <h3>Plastic Pot</h3>
        <p>Our standard plastic nursery pots are an honest, functional product for the
           practical grower. Made from food-grade polypropylene, they are UV-stabilised
           for outdoor use, flexible enough to squeeze for easy root-ball removal, and
           lightweight for easy repositioning. They retain moisture longer than terracotta,
           which means watering frequency should be reduced. Ideal for propagation trays,
           grow-on pots for cuttings and offsets, or as a cheap grow-out vessel before
           upgrading to a display pot.</p>
      </div>

      <div class="detail-box" id="details-self-watering">
        <h3>Self-Watering Pot</h3>
        <p>The self-watering pot uses a two-chamber design: the upper chamber holds
           the plant and potting mix, while the lower chamber acts as a water reservoir.
           A wick or porous insert draws water upward from the reservoir into the soil
           as the plant needs it, maintaining consistent moisture without the risk of
           waterlogging. This system works best for plants with moderate water needs
           like Jade Plants, Aloe Vera, and tropical succulents. For very dry-loving
           cacti, fill the reservoir sparingly and allow it to empty between refills.</p>
      </div>

      <div class="detail-box" id="details-mini-deco">
        <h3>Mini Decorative Pot</h3>
        <p>Sourced from the same local potters as our Ceramic Decorative Pot range, the
           Mini Decorative Pot brings the same hand-painted charm to a much smaller format.
           At 6–8 cm diameter, each pot is individually painted in rotating seasonal
           designs — no two batches are exactly alike. Group three or four together on a
           desk or shelf with different mini succulents for a charming, low-maintenance
           living display that changes character as the plants grow.</p>
      </div>

      <div class="detail-box" id="details-glass-terrarium">
        <h3>Glass Pot Terrarium</h3>
        <p>Our glass terrarium takes the concept of a plant container and turns it into
           a display piece. The geometric faceted glass panels catch and refract light
           beautifully, creating a constantly changing visual effect throughout the day.
           For succulents and cacti, always use the open-top configuration to ensure
           adequate airflow — trapped humidity is the primary cause of rot in glass
           enclosures. Layer the base with 2 cm of gravel for drainage, a thin layer of
           activated charcoal to prevent mould, and then fill with our Succulent Soil Mix
           for best results.</p>
      </div>

      <div class="detail-box" id="details-wooden-box">
        <h3>Wooden Planter Box</h3>
        <p>Handcrafted from locally sourced timber, our Wooden Planter Box brings a
           warm, natural aesthetic to balconies, window ledges, and outdoor tables. Its
           elongated format (30 × 15 × 12 cm) is ideal for creating a mixed desert
           landscape — arrange several cacti or succulents of varying heights and textures
           together for a striking, low-maintenance living centrepiece. Each box comes
           with a removable plastic liner tray that protects the wood from moisture and
           can be replaced if needed. Treat the exterior annually with outdoor wood oil
           to preserve the finish.</p>
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
            <tr><td>Terracotta Pot (Small)</td><td>RM 5.00</td><td>Small</td></tr>
            <tr><td>Terracotta Pot (Large)</td><td>RM 12.00</td><td>Large</td></tr>
            <tr><td>Ceramic Decorative Pot</td><td>RM 18.00</td><td>Medium</td></tr>
            <tr><td>Hanging Planter</td><td>RM 22.00</td><td>Medium</td></tr>
            <tr><td>Ceramic White Pot</td><td>RM 14.00</td><td>Medium</td></tr>
            <tr><td>Terracotta Pot (Medium)</td><td>RM 10.00</td><td>Medium</td></tr>
            <tr><td>Hanging Pot</td><td>RM 13.00</td><td>Medium</td></tr>
            <tr><td>Concrete Pot</td><td>RM 30.00</td><td>Large</td></tr>
            <tr><td>Plastic Pot</td><td>RM 8.00</td><td>Small</td></tr>
            <tr><td>Self-Watering Pot</td><td>RM 43.00</td><td>Large</td></tr>
            <tr><td>Mini Decorative Pot</td><td>RM 20.00</td><td>Small</td></tr>
            <tr><td>Glass Pot Terrarium</td><td>RM 60.00</td><td>Medium</td></tr>
            <tr><td>Wooden Planter Box</td><td>RM 54.00</td><td>Large</td></tr>
          </tbody>
        </table>
      </div>
    </section>

    <section id="ordering">
      <h2>How to Order</h2>
      <div class="list-container">
        <ol>
          <li>Pick your pot from the collection above.</li>
          <li>Head to the <a href="order.php">Order page</a>.</li>
          <li>Select your pot, delivery mode, and payment method.</li>
          <li>Submit the form and we will confirm within 24 hours.</li>
        </ol>
      </div>
    </section>

    <section id="definitions">
      <h2>Pottery Terms</h2>
      <div class="definition-box">
        <dl>
          <dt>Terracotta</dt>
          <dd>Italian for "baked earth" — an unglazed clay ceramic fired at low temperatures,
              known for its characteristic orange-brown colour and porous texture.</dd>
          <dt>Glaze</dt>
          <dd>A glass-like coating applied to ceramics before firing to create a smooth,
              waterproof surface in a wide range of colours and finishes.</dd>
          <dt>Drainage Hole</dt>
          <dd>A hole in the base of a pot that allows excess water to escape, preventing
              waterlogging and root rot — essential for cacti and succulents.</dd>
          <dt>Saucer</dt>
          <dd>A shallow dish placed under a pot to catch drainage water and protect
              surfaces from moisture damage.</dd>
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
