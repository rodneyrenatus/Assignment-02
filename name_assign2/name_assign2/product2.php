<?php
session_start();
$site_name    = "Cacti-Succulent Kuching";
$current_year = 2026;
$nav_active   = "products";

// Succulents products 
$products = [
  ['name'=>'Aloe Vera',                        'price'=>10.00, 'description'=>'The classic household succulent with dual purpose — an attractive plant with fleshy spear-like leaves and a natural gel inside that soothes sunburn and minor skin irritations.',              'image'=>'aloe.jpg',         'sunlight'=>'Bright to Full Sun',  'water'=>'Low',          'figcaption'=>'Medicinal Aloe'],
  ['name'=>'Sedum',                            'price'=>9.00,  'description'=>'A versatile spreading succulent perfect for ground cover, hanging baskets, and border planting. Its tiny star-shaped flowers attract pollinators in season and it requires almost no upkeep.', 'image'=>'sedum.webp',       'sunlight'=>'Full Sun to Partial', 'water'=>'Very Low',     'figcaption'=>'Stonecrop'],
  ['name'=>'Echeveria Elegans Raspberry Ice',  'price'=>25.00, 'description'=>'A stunning cultivar of the classic Echeveria with silvery-blue leaves edged in vivid raspberry-pink. Forms tight, perfectly symmetrical rosettes that intensify in colour with more light.',  'image'=>'s111.jpg',         'sunlight'=>'Bright Indirect',     'water'=>'Moderate',     'figcaption'=>'Raspberry Ice Rosette'],
  ['name'=>'Jade Plant',                       'price'=>30.00, 'description'=>'Crassula ovata, the beloved "Money Plant" of Southeast Asian homes. Its thick, glossy, oval leaves and woody trunk give it the appearance of a miniature tree. Can live for decades.',          'image'=>'s12.avif',         'sunlight'=>'Bright Indirect',     'water'=>'Low',          'figcaption'=>'Money Plant'],
  ['name'=>'Lithops',                          'price'=>22.00, 'description'=>'Among the most remarkable plants on Earth — Lithops have evolved to mimic surrounding pebbles so perfectly they are nearly invisible in the wild. Produce large daisy-like flowers in season.', 'image'=>'s14.jpg',          'sunlight'=>'Full Sun',            'water'=>'Extremely Low','figcaption'=>'Living Stones'],
  ['name'=>'String of Pearls',                 'price'=>28.00, 'description'=>'Senecio rowleyanus produces long trailing stems lined with perfectly round, pea-sized leaves that genuinely resemble a string of green pearls. Ideal in a hanging pot.',                       'image'=>'s15.jpg',          'sunlight'=>'Bright Indirect',     'water'=>'Very Low',     'figcaption'=>'Bead Chain Succulent'],
  ['name'=>"Burro's Tail",                     'price'=>35.00, 'description'=>'Sedum morganianum produces thick, rope-like stems densely packed with plump, blue-green teardrop-shaped leaves. The stems cascade downward up to 60 cm — a dramatic hanging succulent.',          'image'=>'s16.avif',         'sunlight'=>'Bright Indirect',     'water'=>'Low',          'figcaption'=>"Donkey's Tail"],
  ['name'=>'Haworthia Limifolia',              'price'=>26.00, 'description'=>'Distinguished by uniquely textured leaves — horizontal ridged bands cover the dark green surface, giving each leaf the look of a tiny file. Forms a compact rosette that tolerates low-light.',  'image'=>'s17.jpg',          'sunlight'=>'Low to Indirect',     'water'=>'Low',          'figcaption'=>'File-Leaf Haworthia'],
  ['name'=>'Mini Echeveria',                   'price'=>15.00, 'description'=>'A petite Echeveria variety that stays small and compact — ideal for desk arrangements, terrariums, fairy gardens, and gift pots. Multiplies readily into charming clusters.',                   'image'=>'s19.webp',         'sunlight'=>'Bright Indirect',     'water'=>'Low',          'figcaption'=>'Compact Rosette'],
];

// Append products added via Admin Dashboard (category = 'succulents')
require_once("connection.php");
$_db_res = mysqli_query($conn, "SELECT * FROM products WHERE category='succulents' ORDER BY name ASC");
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
  <meta name="description" content="Our succulent collection — Echeveria, Haworthia, Aloe Vera, Sedum.">
  <meta name="keywords" content="succulents, echeveria, haworthia, aloe vera, kuching">
  <meta name="author" content="Cacti-Succulent Kuching Team">
  <title>Succulents | Cacti-Succulent Kuching</title>
  <link rel="stylesheet" href="styles/style.css">

</head>
<body>

  <div id="top"></div>
  <?php include('header.inc'); ?>

  <section class="hero">
    <div class="hero-container">
      <div class="hero-text">
        <span class="badge">Colour &amp; Charm</span>
        <h1>Our <span>Succulents</span></h1>
        <p>Succulents are the perfect plant for busy people and small spaces. Their compact
           rosette forms, vivid colours, and near-zero maintenance needs make them ideal for
           desks, shelves, and window ledges.</p>
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
      <ul><li>Bright light, tolerates full sun</li><li>Water deeply but infrequently</li><li>Gel inside leaves soothes skin burns</li></ul>
      <h3>Sedum</h3>
      <ul><li>Full sun to partial shade</li><li>Drought-tolerant once established</li><li>Great for hanging baskets and borders</li></ul>
      <h3>Echeveria Elegans</h3>
      <ul><li>Bright indirect light, 4–6 hrs daily</li><li>Water when top inch of soil is dry</li><li>Avoid overhead watering — causes rot</li></ul>
      <h3>Jade Plant</h3>
      <ul><li>Bright indirect to moderate direct light</li><li>Water every 2–3 weeks; less in winter</li><li>Well-draining succulent mix</li></ul>
      <h3>Lithops</h3>
      <ul><li>Full sun to very bright indirect light</li><li>Water only during active growth season</li><li>Pure mineral substrate — no organic soil</li></ul>
      <h3>String of Pearls</h3>
      <ul><li>Bright indirect light — harsh sun burns pearls</li><li>Water every 2 weeks; even less in winter</li><li>Ideal in hanging pots for trailing display</li></ul>
      <h3>Burro's Tail</h3>
      <ul><li>Bright indirect to gentle direct light</li><li>Water sparingly — leaves hold reserves</li><li>Handle carefully — leaves detach easily</li></ul>
      <h3>Haworthia Limifolia</h3>
      <ul><li>Low to bright indirect light</li><li>Water every 2–3 weeks, less in winter</li><li>Well-draining succulent or cactus mix</li></ul>
      <h3>Mini Echeveria</h3>
      <ul><li>Bright indirect light, 4–5 hrs daily</li><li>Water when soil is dry to the touch</li><li>Perfect for small pots and terrariums</li></ul>
    </aside>

    <section id="products" class="product-showcase">
      <div class="section-header">
        <h2>Our Featured <em>Succulents</em></h2>
        <p>Compact, colourful, and effortless to care for.</p>
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

    <section id="pricing">
      <h2>Price List</h2>
      <div class="content-box">
        <table>
          <thead><tr><th>Product</th><th>Price (RM)</th></tr></thead>
          <tbody>
            <?php foreach ($products as $p): ?>
            <tr><td><?php echo htmlspecialchars($p['name']); ?></td><td>RM <?php echo number_format((float)$p['price'],2); ?></td></tr>
            <?php endforeach; ?>
          </tbody>
        </table>
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
           warm, humid conditions typical of Malaysian homes.</p>
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
           forming inside.</p>
      </div>

      <div class="detail-box" id="details-string-of-pearls">
        <h3>String of Pearls</h3>
        <p>Senecio rowleyanus produces long trailing stems lined with perfectly round,
           pea-sized leaves that genuinely resemble a string of green pearls. Each nearly
           perfect spherical leaf reduces surface area to minimise water loss while the
           translucent window on each "pearl" allows sunlight to reach the interior for
           photosynthesis. The long, slender stems trail freely and can reach 60–90 cm
           in a hanging pot. Tiny white, cinnamon-scented flowers appear on upright stalks
           during the cooler months.</p>
      </div>

      <div class="detail-box" id="details-burros-tail">
        <h3>Burro's Tail</h3>
        <p>Sedum morganianum is one of the most dramatic hanging succulents available.
           Each thick stem is densely packed with overlapping, plump, blue-green leaves
           arranged in a spiral pattern, creating a rope-like structure that eventually
           cascades 40–60 cm. Individual leaves detach very easily with the slightest
           touch, which makes the plant fragile to move but also allows effortless
           propagation — simply lay detached leaves on dry succulent mix and they will
           root and produce new plants within weeks.</p>
      </div>

      <div class="detail-box" id="details-haworthia-limifolia">
        <h3>Haworthia Limifolia</h3>
        <p>Haworthia limifolia, known as the "File Haworthia", is named for the
           distinctive transverse ridges that cross each leaf — resembling the teeth
           of a file or rasp. The dark green rosettes are stiffer and more architectural
           than the common Zebra Haworthia, giving them a bold presence despite their
           small size. Like all Haworthias they thrive in low light conditions, making
           them ideal for interior spots far from windows.</p>
      </div>

      <div class="detail-box" id="details-mini-echeveria">
        <h3>Mini Echeveria</h3>
        <p>Mini Echeveria varieties are specifically selected or bred to remain small and
           compact — typically under 5 cm across — while retaining all the charm and colour
           of their full-sized counterparts. They are perfectly proportioned for small
           terracotta pots, terrarium arrangements, fairy gardens, and succulent bowls.
           They propagate readily from offsets and leaf cuttings, making them excellent
           plants for sharing.</p>
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
  <?php include('footer.inc'); ?>

</body>
</html>
