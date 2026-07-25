<?php
session_start();
$site_name    = "Cacti-Succulent Kuching";
$current_year = 2026;
$nav_active   = "products";

// Cacti products — hardcoded catalogue
$products = [
  ['name'=>'Ariocarpus Cactus',      'price'=>29.10, 'description'=>'The "Living Rock" blends seamlessly into the ground. A rare, slow-growing collector species that naturally fits its container and rarely needs repotting.', 'image'=>'ariocarpus.jpeg',       'sunlight'=>'Bright Filtered', 'water'=>'Very Low',  'figcaption'=>'The Living Rock'],
  ['name'=>'Golden Barrel Cactus',   'price'=>35.00, 'description'=>'A bold, globe-shaped cactus armoured with striking golden-yellow spines. Renowned for its symmetry and dramatic presence in both indoor and outdoor desert gardens.', 'image'=>'c1.webp',               'sunlight'=>'6+ hrs Full Sun', 'water'=>'Very Low',  'figcaption'=>'Golden Barrel'],
  ['name'=>'Bunny Ear Cactus',       'price'=>28.00, 'description'=>'A charming flat-padded Opuntia variety instantly recognised by its paired rounded pads that resemble rabbit ears. Covered in tiny golden glochids — handle with gloves.', 'image'=>'Bunny-Ear-Cactus.jpg', 'sunlight'=>'6+ hrs Full Sun', 'water'=>'Very Low',  'figcaption'=>'Bunny Ear Cactus'],
  ['name'=>'Moon Cactus',            'price'=>22.00, 'description'=>'A vibrant grafted cactus featuring a brilliantly coloured chlorophyll-free top — available in red, orange, and yellow — fused onto a hardy green Hylocereus base.', 'image'=>'c2.webp',               'sunlight'=>'Bright Indirect', 'water'=>'Very Low',  'figcaption'=>'Moon Cactus'],
  ['name'=>'Fairy Castle Cactus',    'price'=>40.00, 'description'=>'A slow-growing columnar cactus with multiple branching arms that create a miniature castle skyline. Each column develops slightly different heights over time.', 'image'=>'c3.jpg',                'sunlight'=>'Full Sun',        'water'=>'Very Low',  'figcaption'=>'Fairy Castle Cactus'],
  ['name'=>'Old Lady Cactus',        'price'=>30.00, 'description'=>'Covered entirely in a dense coat of white hair and fine spines that protect it from intense desert sun. Blooms with a ring of vivid pink-magenta flowers in season.', 'image'=>'c4.jpg',                'sunlight'=>'Full Sun',        'water'=>'Very Low',  'figcaption'=>'Old Lady Cactus'],
  ['name'=>'Star Cactus',            'price'=>38.00, 'description'=>'Highly sought after for its geometric symmetry and woolly white speckles. Adds a sculptural touch to any collection. Very slow-growing.', 'image'=>'c5.webp',               'sunlight'=>'Bright Indirect', 'water'=>'Very Low',  'figcaption'=>'Star Cactus'],
  ['name'=>'Hedgehog Cactus',        'price'=>33.00, 'description'=>'Small clumping cactus with vivid flowers. Produces large, brilliantly coloured blooms in spring and is one of the earliest cacti to flower each season.', 'image'=>'c6.jpg',                'sunlight'=>'Full Sun',        'water'=>'Very Low',  'figcaption'=>'Hedgehog Cactus'],
  ['name'=>"Bishop's Cap Cactus",    'price'=>42.00, 'description'=>"A five-ribbed cactus resembling a bishop's mitre, covered in a dusting of silvery-white wool and scales. Produces yellow flowers from the crown in summer.", 'image'=>'c7.jpg',                'sunlight'=>'Bright Indirect', 'water'=>'Very Low',  'figcaption'=>"Bishop's Cap"],
  ['name'=>'Mini Saguaro Cactus',    'price'=>50.00, 'description'=>'Classic desert cactus in miniature form. The iconic silhouette of the American Southwest in a pot-sized package. Slow-growing and very long-lived.', 'image'=>'c8.webp',               'sunlight'=>'6+ hrs Full Sun', 'water'=>'Very Low',  'figcaption'=>'Mini Saguaro'],
];

// Append products added via Admin Dashboard (category = 'cacti')
require_once("connection.php");
$_db_res = mysqli_query($conn, "SELECT * FROM products WHERE category='cacti' ORDER BY name ASC");
if ($_db_res) {
    $_hardcoded_names = array_map(fn($p) => strtolower($p['name']), $products);
    while ($_db_row = mysqli_fetch_assoc($_db_res)) {
        if (!in_array(strtolower($_db_row['name']), $_hardcoded_names)) {
            $products[] = [
                'name'        => $_db_row['name'],
                'price'       => (float)$_db_row['price'],
                'description' => $_db_row['description'] ?? '',
                'image'       => $_db_row['image'] ?? '',
                'sunlight'    => 'See description',
                'water'       => 'See description',
                'figcaption'  => $_db_row['name'],
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
  <meta name="description" content="Our cacti collection — Mammillaria, Opuntia, Astrophytum, Ariocarpus.">
  <meta name="keywords" content="cactus, cacti, kuching, ariocarpus, astrophytum, mammillaria">
  <meta name="author" content="Cacti-Succulent Kuching Team">
  <title>Cacti | Cacti-Succulent Kuching</title>
  <link rel="stylesheet" href="styles/style.css">

</head>
<body>

  <div id="top"></div>
  <?php include('header.inc'); ?>
  <section class="hero">
    <div class="hero-container">
      <div class="hero-text">
        <span class="badge">Our Collection</span>
        <h1>About Our <span>Cacti</span></h1>
        <p>Our cacti are popular among customers for their low-maintenance nature, adaptability
           to small urban spaces, and high resilience to heat. Each plant is hand-picked and
           acclimatized to Sarawak's humidity before sale.</p>
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
      <ul><li>Bright, filtered light — avoid harsh afternoon sun</li><li>Water sparingly; dormant in winter</li><li>Pure mineral substrate protects taproots</li></ul>
      <h3>Golden Barrel Cactus</h3>
      <ul><li>Full sun, 6+ hours daily</li><li>Water deeply but infrequently</li><li>Gritty, fast-draining cactus mix</li></ul>
      <h3>Bunny Ear Cactus</h3>
      <ul><li>Full sun for 6+ hours daily</li><li>Water only when completely dry</li><li>Needs pumice/perlite for fast drainage</li></ul>
      <h3>Moon Cactus</h3>
      <ul><li>Bright indirect light — avoid harsh direct sun</li><li>Water sparingly; let soil dry completely</li><li>Keep warm; sensitive to cold drafts</li></ul>
      <h3>Fairy Castle Cactus</h3>
      <ul><li>Full sun to bright indirect light</li><li>Water only when soil is bone dry</li><li>Sandy, well-draining mix essential</li></ul>
      <h3>Old Lady Cactus</h3>
      <ul><li>Full sun, 4–6 hours daily</li><li>Water sparingly — especially in winter</li><li>Avoid wetting the white hair covering</li></ul>
      <h3>Hedgehog Cactus</h3>
      <ul><li>Full sun for best flowering</li><li>Water when soil is completely dry</li><li>Well-draining mineral soil mix</li></ul>
      <h3>Bishop's Cap Cactus</h3>
      <ul><li>Bright indirect to moderate direct light</li><li>Water minimally — very rot prone</li><li>Mineral-rich, near-zero organic substrate</li></ul>
      <h3>Mini Saguaro Cactus</h3>
      <ul><li>Full sun, 6+ hours daily</li><li>Water deeply, then allow to dry fully</li><li>Coarse sand and perlite mix</li></ul>
    </aside>

    <!-- Products Section -->
    <section id="products" class="product-showcase">
      <div class="section-header">
        <h2>Our Featured <em>Cacti</em></h2>
        <p>Hand-picked from our Kuching garden to your home.</p>
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
              <dt>Sunlight</dt><dd><?php echo htmlspecialchars($p['sunlight']); ?></dd>
              <dt>Water</dt><dd><?php echo htmlspecialchars($p['water']); ?></dd>
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

    <!-- Pricing table -->
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
           exceptionally well on sunny balconies and open patios.</p>
      </div>

      <div class="detail-box" id="details-bunny-ear">
        <h3>Bunny Ear Cactus</h3>
        <p>The Bunny Ear Cactus (Opuntia microdasys var.) produces pairs of flat, oval
           pads covered in dense clusters of tiny golden or white glochids — hair-like
           barbed spines that are much more irritating than they look. Despite needing
           careful handling, it is one of the easiest cacti to grow and propagate: pads
           can be snapped off and rooted in dry soil within weeks.</p>
      </div>

      <div class="detail-box" id="details-moon-cactus">
        <h3>Moon Cactus</h3>
        <p>The Moon Cactus is a horticultural creation — a bright-coloured mutant cactus
           (Gymnocalycium mihanovichii) that lacks chlorophyll and cannot survive on its
           own. It is grafted onto a green Hylocereus rootstock that supplies it with water
           and nutrients. The vivid red, orange, or yellow crown is entirely stable and will
           not fade. Because it cannot photosynthesise, it prefers bright indirect light
           rather than harsh direct sun.</p>
      </div>

      <div class="detail-box" id="details-fairy-castle">
        <h3>Fairy Castle Cactus</h3>
        <p>Acanthocereus tetragonus 'Fairy Castle' earned its name from the way it grows:
           multiple columnar stems of varying heights cluster together, each capped with
           small tufts of white hair-like spines, creating a skyline that genuinely
           resembles a miniature castle. It is a slow but steady grower and rarely needs
           repotting.</p>
      </div>

      <div class="detail-box" id="details-old-lady">
        <h3>Old Lady Cactus</h3>
        <p>Mammillaria hahniana earns its affectionate name from the dense covering of
           long, soft white hair-like spines that wrap the entire body of the plant,
           giving it a distinctly aged and woolly appearance. Each spring it reliably
           produces a complete ring of small, vivid magenta-pink flowers around its crown
           without requiring any special treatment.</p>
      </div>

      <div class="detail-box" id="details-star-cactus">
        <h3>Star Cactus</h3>
        <p>This spineless, smooth-textured cactus takes its common name from its perfect
           star-shaped outline when viewed from above. Its pale green body is dusted with
           tiny white areole scales, giving a frosted, silvery appearance. Unlike most
           cacti it handles brief periods of cooler temperatures well, and its lack of
           spines means it can be safely placed where children or pets may brush against it.</p>
      </div>

      <div class="detail-box" id="details-hedgehog">
        <h3>Hedgehog Cactus</h3>
        <p>Echinocereus is named for its spiny, rounded clusters of cylindrical stems
           that expand outward at the base. What distinguishes this genus above all else
           is its flowers: large, showy, and intensely coloured — most commonly brilliant
           magenta or deep orange — they open wide during the day and can last for several
           days. They emerge directly from the sides of the stems rather than the crown,
           making the flowering display especially dramatic.</p>
      </div>

      <div class="detail-box" id="details-bishops-cap">
        <h3>Bishop's Cap Cactus</h3>
        <p>Astrophytum myriostigma is distinguished by its complete lack of spines — its
           surface is smooth and covered entirely in minute white trichomes that give the
           plant a dusty, silver-grey appearance. The name "Bishop's Cap" comes from the
           shape of a bishop's mitre. It is one of the cleanest and most elegant cacti
           available, perfectly safe to handle without gloves.</p>
      </div>

      <div class="detail-box" id="details-mini-saguaro">
        <h3>Mini Saguaro Cactus</h3>
        <p>The Saguaro (Carnegiea gigantea) is the quintessential symbol of the American
           desert. Our Mini Saguaro is a compact cultivated variety suited for pot culture,
           bringing that iconic form indoors without requiring a full desert garden. It is
           extremely slow-growing, which means the plant you receive is already several
           years old. As it matures it gradually develops its characteristic branching arms.</p>
      </div>
    </section>

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

    <section id="definitions">
      <h2>Plant Terms</h2>
      <div class="definition-box">
        <dl>
          <dt>Cactus</dt><dd>A flowering plant endemic to hot and dry areas, known for its thick succulent stem and sharp needle-like thorns that reduce water loss.</dd>
          <dt>Tubercle</dt><dd>A rounded bump or projection on a cactus from which spines or flowers grow.</dd>
          <dt>Glochid</dt><dd>Tiny, hair-like barbed spines found on Opuntia species that easily detach and embed in skin — handle with gloves.</dd>
          <dt>Areole</dt><dd>A specialised pad-like structure unique to cacti from which spines, flowers, and new growth emerge.</dd>
        </dl>
      </div>
    </section>

  </main>
  <?php include('footer.inc'); ?>

</body>
</html>
