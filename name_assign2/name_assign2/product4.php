<?php
session_start();
$site_name    = "Cacti-Succulent Kuching";
$current_year = 2026;
$nav_active   = "products";

// Accessories products 
$products = [
  ['name'=>'Succulent Soil Mix (2kg)', 'price'=>15.00, 'description'=>'Our own blend of 50% organic matter and 50% inorganic grit (perlite + coarse sand). Fast-draining and pH-balanced to keep cacti and succulents healthy. Enough for 6–8 small pots.',                                 'image'=>'succ_mix.jpg',      'spec1_label'=>'Weight',   'spec1_val'=>'2 kg bag',                    'spec2_label'=>'Covers',   'spec2_val'=>'6–8 small pots',         'figcaption'=>'Premium Soil Blend'],
  ['name'=>'Cactus Fertiliser',        'price'=>12.00, 'description'=>'Slow-release granular fertiliser formulated with a low nitrogen ratio suitable for cacti and succulents. Sprinkle on soil surface — lasts up to 3 months per application. 100g pouch.',                                      'image'=>'fertilizer.jfif',   'spec1_label'=>'Format',   'spec1_val'=>'Slow-release granules',       'spec2_label'=>'Duration', 'spec2_val'=>'Up to 3 months',         'figcaption'=>'Slow-Release Granules'],
  ['name'=>'Gift Bundle Set',          'price'=>35.00, 'description'=>'A curated bundle containing one hand-picked succulent, a matching terracotta pot, a small bag of soil mix, and a printed care guide card. Wrapped in kraft paper with jute twine — ready to give.',                         'image'=>'gift_bundle.webp',  'spec1_label'=>'Includes', 'spec1_val'=>'Plant, pot, soil, care card', 'spec2_label'=>'Wrapping', 'spec2_val'=>'Kraft paper + jute',    'figcaption'=>'Ready to Gift'],
  ['name'=>'Watering Can (Small)',     'price'=>6.00,  'description'=>'A compact, lightweight plastic watering can perfect for everyday plant care. Its gentle rose-head spout distributes water evenly without disturbing soil or splashing leaves. Capacity: 500 ml.',                            'image'=>'a1.avif',           'spec1_label'=>'Capacity', 'spec1_val'=>'500 ml',                      'spec2_label'=>'Spout',    'spec2_val'=>'Rose-head spray',        'figcaption'=>'Gentle Watering'],
  ['name'=>'Garden Tool Set',          'price'=>20.00, 'description'=>'A compact 3-piece stainless steel tool set including a narrow trowel, a transplanting fork, and a soil cultivator. Sized for small pots and indoor use. Ergonomic handles reduce hand fatigue.',                           'image'=>'a2.webp',           'spec1_label'=>'Pieces',   'spec1_val'=>'3 (trowel, fork, cultivator)','spec2_label'=>'Material', 'spec2_val'=>'Stainless steel',        'figcaption'=>'3-Piece Tool Set'],
  ['name'=>'Spray Bottle',             'price'=>4.00,  'description'=>'A fine-mist pump spray bottle ideal for lightly moistening propagation trays, misting cuttings, and cleaning dust from smooth-leaved succulents. Adjustable nozzle. Capacity: 300 ml.',                                    'image'=>'a3.webp',           'spec1_label'=>'Capacity', 'spec1_val'=>'300 ml',                      'spec2_label'=>'Nozzle',   'spec2_val'=>'Adjustable mist / stream','figcaption'=>'Fine Mist Sprayer'],
  ['name'=>'Plant Labels (Pack)',      'price'=>7.00,  'description'=>'A pack of 20 reusable white plastic plant labels with a waterproof surface that accepts both pencil and permanent marker. UV-resistant for outdoor use. Essential for tracking species names and dates.',                    'image'=>'a6.jpg',            'spec1_label'=>'Quantity', 'spec1_val'=>'20 labels per pack',          'spec2_label'=>'Surface',  'spec2_val'=>'Waterproof, UV-resistant','figcaption'=>'Identification Labels'],
  ['name'=>'LED Grow Light',           'price'=>56.00, 'description'=>'A full-spectrum LED grow light panel that supplements or replaces natural sunlight for indoor plants. Produces balanced blue and red wavelengths. Energy-efficient, low heat, adjustable clamp mount.',                      'image'=>'a7.webp',           'spec1_label'=>'Spectrum', 'spec1_val'=>'Full spectrum (blue + red)', 'spec2_label'=>'Mount',    'spec2_val'=>'Adjustable clamp',       'figcaption'=>'Full-Spectrum Grow Light'],
  ['name'=>'Pebble Decoration',        'price'=>21.00, 'description'=>'A bag of smooth, mixed-size decorative pebbles for top-dressing your plant pots. A 1–2 cm layer reduces moisture evaporation, prevents soil splash, deters fungus gnats, and gives a clean finish. 500g bag.',             'image'=>'a8.webp',           'spec1_label'=>'Weight',   'spec1_val'=>'500g bag',                    'spec2_label'=>'Colour',   'spec2_val'=>'Mixed natural tones',    'figcaption'=>'Decorative Top Dressing'],
  ['name'=>'Plant Stand',              'price'=>25.00, 'description'=>'A simple, elegant metal plant stand that elevates your pot off the floor, improving air circulation around the drainage hole and preventing moisture damage to surfaces. Fits pots 10–18 cm diameter. Height: 15 cm.',      'image'=>'a9.webp',           'spec1_label'=>'Fits Pots','spec1_val'=>'10–18 cm diameter',           'spec2_label'=>'Finish',   'spec2_val'=>'Matte black / gold',     'figcaption'=>'Display Stand'],
];

// Append products added via Admin Dashboard (category = 'accessories')
require_once("connection.php");
$_db_res = mysqli_query($conn, "SELECT * FROM products WHERE category='accessories' ORDER BY name ASC");
if ($_db_res) {
    $_hardcoded_names = array_map(fn($p) => strtolower($p['name']), $products);
    while ($_db_row = mysqli_fetch_assoc($_db_res)) {
        if (!in_array(strtolower($_db_row['name']), $_hardcoded_names)) {
            $products[] = [
                'name'        => $_db_row['name'],
                'price'       => (float)$_db_row['price'],
                'description' => $_db_row['description'] ?? '',
                'image'       => $_db_row['image'] ?? '',
                'spec1_label' => 'Details',
                'spec1_val'   => 'See description',
                'spec2_label' => '',
                'spec2_val'   => '',
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
  <meta name="description" content="Plant accessories — soil mix, fertiliser, watering cans, gift bundles.">
  <meta name="keywords" content="succulent soil, cactus fertiliser, watering can, gift bundle, kuching">
  <meta name="author" content="Cacti-Succulent Kuching Team">
  <title>Accessories | Cacti-Succulent Kuching</title>
  <link rel="stylesheet" href="styles/style.css">

</head>
<body>

  <div id="top"></div>
  <?php include('header.inc'); ?>
  <section class="hero">
    <div class="hero-container">
      <div class="hero-text">
        <span class="badge">Everything You Need</span>
        <h1>Plant <span>Accessories</span></h1>
        <p>Give your plants the best start with our range of care accessories. From our
           specially blended succulent soil mix to slow-release cactus fertiliser and
           compact watering cans — everything is chosen to keep your desert plants
           thriving. Looking for a gift? Our pre-wrapped gift bundles are the perfect
           present for any plant enthusiast.</p>
        <div class="action-group">
          <a href="#products" class="btn-solid">View Accessories</a>
          <a href="order.php" class="btn-outline">Place an Order →</a>
        </div>
      </div>
      <div class="hero-image">
        <img src="images/accessories.jfif" alt="Plant Accessories">
      </div>
    </div>
  </section>

  <main class="content-clearfix">

    <aside>
      <h2>Product Tips</h2>

      <h3>Soil Mix</h3>
      <ul>
        <li>Use our mix straight from the bag — no amendments needed</li>
        <li>50% inorganic grit for fast drainage</li>
        <li>Re-pot cacti every 2–3 years</li>
      </ul>

      <h3>Fertiliser</h3>
      <ul>
        <li>Apply during the growing season (Mar–Sep)</li>
        <li>Do not fertilise in winter — plants are dormant</li>
        <li>One application lasts up to 3 months</li>
      </ul>

      <h3>Watering Can</h3>
      <ul>
        <li>Long narrow spout reaches base of plant</li>
        <li>Avoids wetting leaves — reduces rot risk</li>
        <li>250ml capacity — perfect for small pots</li>
      </ul>

      <h3>Gift Bundles</h3>
      <ul>
        <li>Includes one plant, pot, soil, and care card</li>
        <li>Comes pre-wrapped with kraft paper and twine</li>
        <li>Personalised message cards available</li>
      </ul>

      <h3>Garden Tool Set</h3>
      <ul>
        <li>Stainless steel heads resist rust and soil buildup</li>
        <li>Ideal for repotting and propagating succulents</li>
        <li>Clean after each use to extend lifespan</li>
      </ul>

      <h3>Spray Bottle</h3>
      <ul>
        <li>Use for misting cuttings and seedlings only</li>
        <li>Do not mist mature succulents — causes rot spots</li>
        <li>Also great for cleaning dust off smooth-leaf plants</li>
      </ul>

      <h3>Plant Labels</h3>
      <ul>
        <li>Write species name and purchase date on each label</li>
        <li>Waterproof and UV-resistant — suitable for outdoor use</li>
        <li>Great for organised collections and propagation trays</li>
      </ul>

      <h3>LED Grow Light</h3>
      <ul>
        <li>Run for 12–14 hours daily to simulate natural daylight</li>
        <li>Keep 15–30 cm above plant canopy for best results</li>
        <li>Full-spectrum output supports both growth and flowering</li>
      </ul>

      <h3>Pebble Decoration</h3>
      <ul>
        <li>Layer 1–2 cm over soil surface to reduce moisture loss</li>
        <li>Keeps soil from splashing during watering</li>
        <li>Rinse before use to remove dust</li>
      </ul>

      <h3>Plant Stand</h3>
      <ul>
        <li>Elevate plants for better air circulation around the pot</li>
        <li>Check weight rating before placing large heavy pots</li>
        <li>Ideal for displaying hanging varieties at eye level</li>
      </ul>
    </aside>

    <section id="products" class="product-showcase">
      <div class="section-header">
        <h2>Our <em>Accessories</em></h2>
        <p>Everything your plants need to thrive — and thoughtful gifts too.</p>
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

      <div class="detail-box" id="details-soil">
        <h3>Succulent Soil Mix (2kg)</h3>
        <p>Our house-blend soil mix is formulated specifically for the growing conditions
           of Kuching — warm year-round temperatures and high humidity that can cause rot
           in standard potting mixes. The blend consists of 50% organic matter (composted
           bark and coco peat) and 50% inorganic grit (coarse perlite and horticultural
           sand), achieving fast drainage while retaining just enough moisture for healthy
           root activity. Pre-mixed and pH-balanced to 6.2–6.8, it is ready to use
           straight from the bag without any additional amendments.</p>
      </div>

      <div class="detail-box" id="details-fert">
        <h3>Cactus Fertiliser</h3>
        <p>Our slow-release granular fertiliser is formulated with a low nitrogen ratio
           (NPK approximately 5-10-10) that encourages strong root development and
           flowering without causing the excessive, weak leaf growth that high-nitrogen
           fertilisers produce in succulents. A single application of granules sprinkled
           on the soil surface lasts up to three months as they gradually dissolve with
           each watering. Apply only during the active growing season (March–September)
           and withhold completely during winter dormancy. The 100g pouch treats
           approximately 10–15 small pots.</p>
      </div>

      <div class="detail-box" id="details-gift">
        <h3>Gift Bundle Set</h3>
        <p>Our gift bundle is designed to give a plant enthusiast everything they need
           to get started with a new plant — or to give a non-gardener a complete,
           foolproof setup. Each bundle is assembled by hand and includes one plant
           selected for ease of care (typically Echeveria, Haworthia, or Aloe Vera),
           a matching terracotta pot appropriate to the plant's size, a small portion
           of our Succulent Soil Mix, and a printed care guide card with watering
           frequency and light requirements specific to the included plant. The entire
           bundle is wrapped in natural kraft paper and tied with jute twine. Personalised
           message cards are available at no additional charge — just include your message
           in the special notes field on the order form.</p>
      </div>

      <div class="detail-box" id="details-watering-small">
        <h3>Watering Can (Small)</h3>
        <p>The small plastic watering can is the everyday workhorse for growers with
           a modest collection. Its 500ml capacity is enough to water a full tray of
           small pots in one go, and the gentle rose-head distributes water in a fine,
           even spray that mimics light rain — ideal for seedling trays and propagation
           cuttings that need surface moisture without soil disturbance. The lightweight
           plastic body is easy to handle for extended watering sessions and is
           dishwasher-safe for easy cleaning.</p>
      </div>

      <div class="detail-box" id="details-tool-set">
        <h3>Garden Tool Set</h3>
        <p>Repotting and propagating succulents requires more precision than standard
           garden tools allow. Our compact 3-piece set is scaled for small pots and
           indoor use: the narrow trowel fits into tight pot spaces to lift plants without
           damaging roots; the transplanting fork loosens compacted soil and separates
           tangled root balls; and the soil cultivator aerates and mixes soil in the pot.
           All three tools have stainless steel heads that resist rust and do not react
           with soil amendments, and their short handles give precise control for
           close-up pot work.</p>
      </div>

      <div class="detail-box" id="details-spray-bottle">
        <h3>Spray Bottle</h3>
        <p>While mature succulents and cacti should never be misted (wet foliage causes
           rot and fungal issues), a fine-mist spray bottle is an essential tool for
           propagation. Freshly detached leaves and stem cuttings root best when the
           soil surface is kept lightly moist but not saturated — a task the spray bottle
           handles perfectly. It is also excellent for cleaning smooth-leaved succulents
           like Aloe Vera and Haworthia of dust, which can block light penetration through
           the leaf surface. The adjustable nozzle provides either a fine mist or a
           concentrated stream depending on the task.</p>
      </div>

      <div class="detail-box" id="details-labels">
        <h3>Plant Labels</h3>
        <p>As a collection grows, it becomes increasingly difficult to remember which
           plant is which — especially among similar-looking Echeveria cultivars or
           Mammillaria species. Our plant labels solve this problem with a simple,
           reusable format. Each label can be written on with a standard pencil (which
           can be erased and reused) or with a permanent marker for a permanent record.
           The UV-resistant surface prevents fading in direct sunlight, and the pointed
           stake end pushes cleanly into any soil mix. A pack of 20 is enough to label
           an entire modest collection with several labels to spare for propagation trays.</p>
      </div>

      <div class="detail-box" id="details-grow-light">
        <h3>LED Grow Light</h3>
        <p>Many of Kuching's apartments and offices have limited natural light — deep
           rooms, north-facing windows, or heavily tinted glazing that blocks the full
           spectrum plants need. Our full-spectrum LED grow light compensates for this
           by delivering a balanced mix of blue and red wavelengths that support all
           stages of plant growth. Unlike older HID or fluorescent grow lights, it
           runs cool enough to position within 15–30 cm of plant canopies without
           heat stress, and its low power draw (approximately 20W) means running costs
           are negligible. The adjustable clamp mount fits shelves, desks, and pot stands.</p>
      </div>

      <div class="detail-box" id="details-pebbles">
        <h3>Pebble Decoration</h3>
        <p>Top-dressing with decorative pebbles is one of the most effective and
           underrated techniques for healthy succulent growing. A layer of inorganic
           pebbles over the soil surface slows moisture evaporation from the top of the
           pot (which is where water enters and where excess sits), prevents soil from
           splashing during watering, and significantly reduces the humid conditions
           that attract fungus gnats. For Lithops in particular, a pebble top-dressing
           that matches the body colour of the plant can create a strikingly authentic
           habitat display. Our mixed natural-tone pebbles (grey, tan, and cream) suit
           almost any species or pot style.</p>
      </div>

      <div class="detail-box" id="details-plant-stand">
        <h3>Plant Stand</h3>
        <p>Elevating a pot on a plant stand does more than just look good — it provides
           practical benefits for plant health. The gap beneath the pot allows air to
           circulate around the drainage hole, which speeds drying of the soil base after
           watering and prevents the pot from sitting in standing water on a saucer.
           This is particularly valuable for cacti and succulents, where root rot from
           waterlogged bases is a common cause of decline. The ring design accommodates
           a range of pot diameters (10–18 cm) and the powder-coated steel finish is
           rust-resistant and easy to wipe clean. Available in matte black for a modern
           look and gold for a warmer, decorative aesthetic.</p>
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
          <li>Choose your accessory from the list above.</li>
          <li>Visit the <a href="order.php">Order page</a>.</li>
          <li>Select your item, delivery option, and payment method.</li>
          <li>Submit — we will contact you to confirm within 24 hours.</li>
        </ol>
      </div>
    </section>

    <section id="definitions">
      <h2>Gardening Terms</h2>
      <div class="definition-box">
        <dl>
          <dt>Perlite</dt>
          <dd>A volcanic glass material that is expanded by heat into lightweight white
              granules. Widely used to improve drainage and aeration in potting mixes.</dd>
          <dt>Slow-Release Fertiliser</dt>
          <dd>A type of fertiliser coated to gradually release nutrients over weeks or
              months, reducing the risk of over-fertilising and root burn.</dd>
          <dt>pH (Potential of Hydrogen)</dt>
          <dd>A scale measuring the acidity or alkalinity of soil. Cacti and succulents
              generally prefer a slightly acidic to neutral pH of 6.0–7.0.</dd>
          <dt>Propagation</dt>
          <dd>The process of creating new plants from an existing one — through offsets,
              leaf cuttings, or seeds — without purchasing new stock.</dd>
        </dl>
      </div>
    </section>

  </main>
  <?php include('footer.inc'); ?>

</body>
</html>
