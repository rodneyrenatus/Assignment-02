<?php
session_start();
$site_name    = "Cacti-Succulent Kuching";
$current_year = 2026;
$nav_active   = "products";

// Pots & planters products 
$products = [
  ['name'=>'Terracotta Pot (Small)',   'price'=>5.00,  'description'=>'The classic unglazed terracotta pot — breathable, affordable, and perfectly suited to cacti and succulents. Comes with drainage hole and saucer. Diameter: 8–10 cm.',                                                   'image'=>'small_pot.jpg', 'spec1_label'=>'Material', 'spec1_val'=>'Unglazed Terracotta', 'spec2_label'=>'Size', 'spec2_val'=>'Small (8–10 cm)',    'figcaption'=>'Classic Terracotta'],
  ['name'=>'Terracotta Pot (Large)',   'price'=>12.00, 'description'=>'A larger version of our classic terracotta pot, ideal for aloe vera, larger cacti clusters, or statement succulents. Diameter: 18–22 cm. Deep drainage hole included.',                                                  'image'=>'large_pot.jpg', 'spec1_label'=>'Material', 'spec1_val'=>'Unglazed Terracotta', 'spec2_label'=>'Size', 'spec2_val'=>'Large (18–22 cm)',   'figcaption'=>'Large Terracotta'],
  ['name'=>'Ceramic Decorative Pot',  'price'=>18.00, 'description'=>'Hand-painted glazed ceramic pots in earth tones and muted greens that complement our succulent colour palette. Each pot is slightly unique. Diameter: 10–14 cm.',                                                          'image'=>'ceramic.webp',  'spec1_label'=>'Material', 'spec1_val'=>'Glazed Ceramic',    'spec2_label'=>'Size', 'spec2_val'=>'Medium (10–14 cm)', 'figcaption'=>'Glazed Ceramic'],
  ['name'=>'Hanging Planter',         'price'=>22.00, 'description'=>'Rope-hung terracotta planter perfect for trailing succulents and small cacti. Includes a coconut fibre liner to retain moisture. Comes with 2m of natural jute rope.',                                                      'image'=>'hanging.jpg',   'spec1_label'=>'Material', 'spec1_val'=>'Terracotta + Jute', 'spec2_label'=>'Diameter', 'spec2_val'=>'12 cm',             'figcaption'=>'Hanging Planter'],
  ['name'=>'Ceramic White Pot',       'price'=>14.00, 'description'=>'A clean, minimal white ceramic pot that complements any plant style or interior decor. The neutral tone lets your plant take centre stage. Comes with a matching drainage hole and saucer. Diameter: 10–12 cm.',          'image'=>'p1.webp',       'spec1_label'=>'Material', 'spec1_val'=>'Glazed Ceramic',    'spec2_label'=>'Size', 'spec2_val'=>'Medium (10–12 cm)', 'figcaption'=>'Ceramic White Pot'],
  ['name'=>'Terracotta Pot (Medium)', 'price'=>10.00, 'description'=>'Our mid-range unglazed terracotta pot — the ideal everyday pot for cacti and succulents of all kinds. Breathable walls encourage healthy roots and prevent waterlogging. Diameter: 12–14 cm.',                            'image'=>'p2.webp',       'spec1_label'=>'Material', 'spec1_val'=>'Unglazed Terracotta', 'spec2_label'=>'Size', 'spec2_val'=>'Medium (12–14 cm)', 'figcaption'=>'Classic Terracotta'],
  ['name'=>'Hanging Pot',             'price'=>13.00, 'description'=>'A lightweight plastic hanging pot with built-in rope for immediate suspension. Excellent for trailing succulents. Includes a drip tray to protect ceilings and furniture. Diameter: 14 cm.',                              'image'=>'p3.jpg',        'spec1_label'=>'Material', 'spec1_val'=>'Lightweight Plastic', 'spec2_label'=>'Diameter', 'spec2_val'=>'14 cm',             'figcaption'=>'Hanging Pot'],
  ['name'=>'Concrete Pot',            'price'=>30.00, 'description'=>'A solid, industrial-look concrete pot that provides exceptional stability for larger plants or specimens in breezy outdoor areas. Grey texture creates a striking minimalist contrast. Diameter: 16 cm.',                  'image'=>'p4.jpg',        'spec1_label'=>'Material', 'spec1_val'=>'Cast Concrete',    'spec2_label'=>'Size', 'spec2_val'=>'Large (16 cm)',      'figcaption'=>'Industrial Concrete'],
  ['name'=>'Plastic Pot',             'price'=>8.00,  'description'=>'A no-fuss, budget-friendly plastic pot for the practical grower. Ideal for propagating cuttings, growing on seedlings, or housing plants you intend to repot later. Lightweight and stackable. Diameter: 10 cm.',        'image'=>'p5.webp',       'spec1_label'=>'Material', 'spec1_val'=>'Polypropylene',    'spec2_label'=>'Size', 'spec2_val'=>'Small (10 cm)',      'figcaption'=>'Lightweight Plastic'],
  ['name'=>'Self-Watering Pot',       'price'=>43.00, 'description'=>'Features a built-in water reservoir at the base that delivers moisture to the roots through a wicking system, maintaining consistent soil moisture without overwatering. Diameter: 18 cm.',                               'image'=>'p6.webp',       'spec1_label'=>'Material', 'spec1_val'=>'Polypropylene',    'spec2_label'=>'Size', 'spec2_val'=>'Large (18 cm)',      'figcaption'=>'Self-Watering Reservoir'],
  ['name'=>'Mini Decorative Pot',     'price'=>20.00, 'description'=>'A small, ornamental pot designed for mini succulents and desk cacti. Comes in assorted earth-tone glazes — terracotta, sage, and cream. Perfect for single specimens. Diameter: 6–8 cm.',                                'image'=>'p7.webp',       'spec1_label'=>'Material', 'spec1_val'=>'Glazed Ceramic',    'spec2_label'=>'Size', 'spec2_val'=>'Small (6–8 cm)',     'figcaption'=>'Cute Desk Pot'],
  ['name'=>'Glass Pot Terrarium',     'price'=>60.00, 'description'=>'A geometric glass terrarium that showcases your succulents and cacti as living art. The open design allows good airflow, essential for preventing rot in desert plants.',                                                  'image'=>'p8.jpg',        'spec1_label'=>'Material', 'spec1_val'=>'Clear Borosilicate Glass', 'spec2_label'=>'Size', 'spec2_val'=>'Medium (15 cm)',  'figcaption'=>'Glass Terrarium'],
  ['name'=>'Wooden Planter Box',      'price'=>54.00, 'description'=>'A handcrafted wooden planter box with a natural, rustic finish — ideal for grouping several succulents or cacti together in a single display. Dimensions: 30 × 15 × 12 cm.',                                            'image'=>'p9.webp',       'spec1_label'=>'Material', 'spec1_val'=>'Natural Timber',   'spec2_label'=>'Size', 'spec2_val'=>'Large (30 cm wide)', 'figcaption'=>'Rustic Planter Box'],
];

// Append products added via Admin Dashboard (category = 'pots')
require_once("connection.php");
$_db_res = mysqli_query($conn, "SELECT * FROM products WHERE category='pots' ORDER BY name ASC");
if ($_db_res) {
    $_hardcoded_names = array_map(fn($p) => strtolower($p['name']), $products);
    while ($_db_row = mysqli_fetch_assoc($_db_res)) {
        if (!in_array(strtolower($_db_row['name']), $_hardcoded_names)) {
            $products[] = [
                'name'         => $_db_row['name'],
                'price'        => (float)$_db_row['price'],
                'description'  => $_db_row['description'] ?? '',
                'image'        => $_db_row['image'] ?? '',
                'spec1_label'  => 'Details',
                'spec1_val'    => 'See description',
                'spec2_label'  => '',
                'spec2_val'    => '',
                'figcaption'   => $_db_row['name'],
            ];
        }
    }
}
mysqli_close($conn);
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
  <?php include('header.inc'); ?>
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
        <h2>Our Pots &amp; <em>Planters</em></h2>
        <p>Quality vessels that complement your plants and your interior style.</p>
      </div>

      <div class="product-grid">
        <?php foreach ($products as $p): ?>
        <article class="product-card">
          <figure>
            <img src="images/<?php echo htmlspecialchars($p['image']); ?>"
                 alt="<?php echo htmlspecialchars($p['name']); ?>"
                 onerror="this.src='images/cacti succulent 2.png'">
            <figcaption><?php echo htmlspecialchars($p['figcaption']); ?></figcaption>
          </figure>
          <div class="card-body">
            <h3><?php echo htmlspecialchars($p['name']); ?></h3>
            <p><?php echo htmlspecialchars($p['description']); ?></p>
            <dl class="plant-specs">
              <dt><?php echo htmlspecialchars($p['spec1_label']); ?></dt><dd><?php echo htmlspecialchars($p['spec1_val']); ?></dd>
              <dt><?php echo htmlspecialchars($p['spec2_label']); ?></dt><dd><?php echo htmlspecialchars($p['spec2_val']); ?></dd>
            </dl>
            <div class="card-footer">
              <span class="price">RM <?php echo number_format((float)$p['price'], 2); ?></span>
              <a href="order.php" class="buy-btn">Order Now</a>
            </div>
          </div>
        </article>
        <?php endforeach; ?>
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
          <thead><tr><th>Product</th><th>Price (RM)</th></tr></thead>
          <tbody>
            <?php foreach ($products as $p): ?>
            <tr>
              <td><?php echo htmlspecialchars($p['name']); ?></td>
              <td>RM <?php echo number_format((float)$p['price'], 2); ?></td>
            </tr>
            <?php endforeach; ?>
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
  <?php include('footer.inc'); ?>

</body>
</html>
