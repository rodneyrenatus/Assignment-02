<?php

session_start();

$site_name    = "Cacti-Succulent Kuching";
$current_year = 2026;
$nav_active   = "";

// ALL PRODUCTS
$all_products_raw = [
  ['id'=>1,  'category'=>'cacti',       'name'=>'Ariocarpus Cactus',               'price'=>29.10, 'description'=>'The "Living Rock" blends seamlessly into the ground. A rare, slow-growing collector species that naturally fits its container and rarely needs repotting.', 'image'=>'ariocarpus.jpeg'],
  ['id'=>2,  'category'=>'cacti',       'name'=>'Golden Barrel Cactus',            'price'=>35.00, 'description'=>'A bold, globe-shaped cactus armoured with striking golden-yellow spines. Renowned for its symmetry and dramatic presence in both indoor and outdoor desert gardens.', 'image'=>'c1.webp'],
  ['id'=>3,  'category'=>'cacti',       'name'=>'Bunny Ear Cactus',               'price'=>28.00, 'description'=>'A charming flat-padded Opuntia variety instantly recognised by its paired rounded pads that resemble rabbit ears. Handle with gloves — covered in tiny golden glochids.', 'image'=>'Bunny-Ear-Cactus.jpg'],
  ['id'=>4,  'category'=>'cacti',       'name'=>'Moon Cactus',                    'price'=>22.00, 'description'=>'A vibrant grafted cactus featuring a brilliantly coloured top fused onto a hardy Hylocereus base. A striking conversation piece for any desk or windowsill.', 'image'=>'c2.webp'],
  ['id'=>5,  'category'=>'cacti',       'name'=>'Fairy Castle Cactus',            'price'=>40.00, 'description'=>'A slow-growing columnar cactus with multiple branching arms that create a miniature castle skyline. Each column develops slightly different heights over time.', 'image'=>'c3.jpg'],
  ['id'=>6,  'category'=>'cacti',       'name'=>'Old Lady Cactus',                'price'=>30.00, 'description'=>'Covered entirely in a dense coat of white hair and fine spines. Blooms with a ring of vivid pink-magenta flowers in season.', 'image'=>'c4.jpg'],
  ['id'=>7,  'category'=>'cacti',       'name'=>'Star Cactus',                    'price'=>38.00, 'description'=>'Highly sought after for its geometric symmetry and woolly white speckles. Adds a sculptural touch to any collection. Very slow-growing.', 'image'=>'c5.webp'],
  ['id'=>8,  'category'=>'cacti',       'name'=>'Hedgehog Cactus',                'price'=>33.00, 'description'=>'Small clumping cactus with vivid flowers. Produces large, brilliantly coloured blooms in spring and is one of the earliest cacti to flower each season.', 'image'=>'c6.jpg'],
  ['id'=>9,  'category'=>'cacti',       'name'=>"Bishop's Cap Cactus",            'price'=>42.00, 'description'=>"A five-ribbed cactus resembling a bishop's mitre, covered in a dusting of silvery-white wool and scales. Produces yellow flowers from the crown in summer.", 'image'=>'c7.jpg'],
  ['id'=>10, 'category'=>'cacti',       'name'=>'Mini Saguaro Cactus',            'price'=>50.00, 'description'=>'Classic desert cactus in miniature form. The iconic silhouette of the American Southwest in a pot-sized package. Slow-growing and very long-lived.', 'image'=>'c8.webp'],
  ['id'=>11, 'category'=>'succulents',  'name'=>'Aloe Vera',                      'price'=>10.00, 'description'=>'The classic household succulent with dual purpose — an attractive plant with fleshy spear-like leaves and a natural gel inside that soothes sunburn.', 'image'=>'aloe.jpg'],
  ['id'=>12, 'category'=>'succulents',  'name'=>'Sedum',                          'price'=>9.00,  'description'=>'A versatile spreading succulent perfect for ground cover, hanging baskets, and border planting. Tiny star-shaped flowers attract pollinators in season.', 'image'=>'sedum.webp'],
  ['id'=>13, 'category'=>'succulents',  'name'=>'Echeveria Elegans Raspberry Ice','price'=>25.00, 'description'=>'A stunning cultivar of Echeveria with silvery-blue leaves edged in vivid raspberry-pink. Forms tight, symmetrical rosettes that intensify in colour with more light.', 'image'=>'s111.jpg'],
  ['id'=>14, 'category'=>'succulents',  'name'=>'Jade Plant',                     'price'=>30.00, 'description'=>'Crassula ovata — the beloved "Money Plant" of Southeast Asian homes. Thick glossy leaves and woody trunk give it the look of a miniature tree. Lives for decades.', 'image'=>'s12.avif'],
  ['id'=>15, 'category'=>'succulents',  'name'=>'Lithops',                        'price'=>22.00, 'description'=>'Among the most remarkable plants on Earth — evolved to mimic surrounding pebbles. Produce surprisingly large daisy-like flowers between their leaves in season.', 'image'=>'s14.jpg'],
  ['id'=>16, 'category'=>'succulents',  'name'=>'String of Pearls',               'price'=>28.00, 'description'=>'Senecio rowleyanus produces long trailing stems lined with perfectly round, pea-sized leaves that genuinely resemble a string of green pearls. Ideal in a hanging pot.', 'image'=>'s15.jpg'],
  ['id'=>17, 'category'=>'succulents',  'name'=>"Burro's Tail",                   'price'=>35.00, 'description'=>'Sedum morganianum produces thick rope-like stems densely packed with plump blue-green teardrop-shaped leaves. Cascades downward up to 60 cm.', 'image'=>'s16.avif'],
  ['id'=>18, 'category'=>'succulents',  'name'=>'Haworthia Limifolia',             'price'=>26.00, 'description'=>'Distinguished by uniquely textured leaves — horizontal ridged bands give each leaf the look of a tiny file. Compact rosette tolerates low-light environments.', 'image'=>'s17.jpg'],
  ['id'=>19, 'category'=>'succulents',  'name'=>'Mini Echeveria',                 'price'=>15.00, 'description'=>'A petite Echeveria variety that stays small and compact — ideal for desk arrangements, terrariums, fairy gardens, and gift pots. Multiplies readily.', 'image'=>'s19.webp'],
  ['id'=>20, 'category'=>'pots',        'name'=>'Terracotta Pot (Small)',          'price'=>5.00,  'description'=>'Classic unglazed terracotta pot — breathable, affordable, and perfectly suited to cacti and succulents. Comes with drainage hole and saucer. Diameter: 8–10 cm.', 'image'=>'small_pot.jpg'],
  ['id'=>21, 'category'=>'pots',        'name'=>'Terracotta Pot (Large)',          'price'=>12.00, 'description'=>'Larger version of our classic terracotta pot, ideal for aloe vera, larger cacti clusters, or statement succulents. Diameter: 18–22 cm. Deep drainage hole included.', 'image'=>'large_pot.jpg'],
  ['id'=>22, 'category'=>'pots',        'name'=>'Ceramic Decorative Pot',         'price'=>18.00, 'description'=>'Hand-painted glazed ceramic pots in earth tones and muted greens. Each pot is slightly unique. Diameter: 10–14 cm.', 'image'=>'ceramic.webp'],
  ['id'=>23, 'category'=>'pots',        'name'=>'Hanging Planter',                'price'=>22.00, 'description'=>'Rope-hung terracotta planter perfect for trailing succulents. Includes a coconut fibre liner to retain moisture. Comes with 2m of natural jute rope.', 'image'=>'hanging.jpg'],
  ['id'=>24, 'category'=>'pots',        'name'=>'Ceramic White Pot',              'price'=>14.00, 'description'=>'Clean, minimal white ceramic pot that complements any plant style or interior decor. The neutral tone lets your plant take centre stage. Diameter: 10–12 cm.', 'image'=>'p1.webp'],
  ['id'=>25, 'category'=>'pots',        'name'=>'Terracotta Pot (Medium)',         'price'=>10.00, 'description'=>'Mid-range unglazed terracotta pot — the ideal everyday pot for cacti and succulents. Breathable walls encourage healthy roots. Diameter: 12–14 cm.', 'image'=>'p2.webp'],
  ['id'=>26, 'category'=>'pots',        'name'=>'Hanging Pot',                    'price'=>13.00, 'description'=>'Lightweight plastic hanging pot with built-in rope. Excellent for trailing succulents. Includes a drip tray to protect ceilings and furniture. Diameter: 14 cm.', 'image'=>'p3.jpg'],
  ['id'=>27, 'category'=>'pots',        'name'=>'Concrete Pot',                   'price'=>30.00, 'description'=>'Solid industrial-look concrete pot providing exceptional stability for larger plants in breezy outdoor areas. Grey texture creates a striking minimalist contrast. Diameter: 16 cm.', 'image'=>'p4.jpg'],
  ['id'=>28, 'category'=>'pots',        'name'=>'Plastic Pot',                    'price'=>8.00,  'description'=>'No-fuss, budget-friendly plastic pot for the practical grower. Ideal for propagating cuttings, growing on seedlings, or housing plants you intend to repot later. Diameter: 10 cm.', 'image'=>'p5.webp'],
  ['id'=>29, 'category'=>'pots',        'name'=>'Self-Watering Pot',              'price'=>43.00, 'description'=>'Features a built-in water reservoir at the base that delivers moisture to the roots through a wicking system, maintaining consistent soil moisture. Diameter: 18 cm.', 'image'=>'p6.webp'],
  ['id'=>30, 'category'=>'pots',        'name'=>'Mini Decorative Pot',            'price'=>20.00, 'description'=>'Small ornamental pot designed for mini succulents and desk cacti. Comes in assorted earth-tone glazes. Perfect for single specimens. Diameter: 6–8 cm.', 'image'=>'p7.webp'],
  ['id'=>31, 'category'=>'pots',        'name'=>'Glass Pot Terrarium',            'price'=>60.00, 'description'=>'Geometric glass terrarium that showcases your succulents and cacti as living art. The open design allows good airflow, essential for preventing rot in desert plants.', 'image'=>'p8.jpg'],
  ['id'=>32, 'category'=>'pots',        'name'=>'Wooden Planter Box',             'price'=>54.00, 'description'=>'Handcrafted wooden planter box with a natural rustic finish — ideal for grouping several succulents together. Dimensions: 30 × 15 × 12 cm.', 'image'=>'p9.webp'],
  ['id'=>33, 'category'=>'accessories', 'name'=>'Succulent Soil Mix (2kg)',        'price'=>15.00, 'description'=>'Our own blend of 50% organic matter and 50% inorganic grit (perlite + coarse sand). Fast-draining and pH-balanced. Enough for 6–8 small pots.', 'image'=>'succ_mix.jpg'],
  ['id'=>34, 'category'=>'accessories', 'name'=>'Cactus Fertiliser',              'price'=>12.00, 'description'=>'Slow-release granular fertiliser formulated with a low nitrogen ratio suitable for cacti and succulents. Lasts up to 3 months per application. 100g pouch.', 'image'=>'fertilizer.jfif'],
  ['id'=>35, 'category'=>'accessories', 'name'=>'Gift Bundle Set',                'price'=>35.00, 'description'=>'A curated bundle containing one hand-picked succulent, a matching terracotta pot, a small bag of soil mix, and a printed care guide card. Wrapped and ready to give.', 'image'=>'gift_bundle.webp'],
  ['id'=>36, 'category'=>'accessories', 'name'=>'Watering Can (Small)',           'price'=>6.00,  'description'=>'Compact lightweight plastic watering can with a gentle rose-head spout. Distributes water evenly without disturbing soil or splashing leaves. Capacity: 500 ml.', 'image'=>'a1.avif'],
  ['id'=>37, 'category'=>'accessories', 'name'=>'Garden Tool Set',                'price'=>20.00, 'description'=>'Compact 3-piece stainless steel tool set: narrow trowel, transplanting fork, and soil cultivator. Sized for small pots and indoor use. Ergonomic handles.', 'image'=>'a2.webp'],
  ['id'=>38, 'category'=>'accessories', 'name'=>'Spray Bottle',                   'price'=>4.00,  'description'=>'Fine-mist pump spray bottle ideal for lightly moistening propagation trays and misting cuttings. Adjustable nozzle switches between fine mist and direct stream. 300 ml.', 'image'=>'a3.webp'],
  ['id'=>39, 'category'=>'accessories', 'name'=>'Plant Labels (Pack)',             'price'=>7.00,  'description'=>'Pack of 20 reusable white plastic plant labels with waterproof surface. Accepts pencil and permanent marker. UV-resistant for outdoor use.', 'image'=>'a6.jpg'],
  ['id'=>40, 'category'=>'accessories', 'name'=>'LED Grow Light',                 'price'=>56.00, 'description'=>'Full-spectrum LED grow light panel that supplements or replaces natural sunlight. Balanced blue and red wavelengths. Energy-efficient, low heat, adjustable clamp mount.', 'image'=>'a7.webp'],
  ['id'=>41, 'category'=>'accessories', 'name'=>'Pebble Decoration',              'price'=>21.00, 'description'=>'Bag of smooth mixed-size decorative pebbles for top-dressing plant pots. Reduces moisture evaporation, prevents soil splash, deters fungus gnats. 500g bag.', 'image'=>'a8.webp'],
  ['id'=>42, 'category'=>'accessories', 'name'=>'Plant Stand',                    'price'=>25.00, 'description'=>'Simple elegant metal plant stand that elevates your pot off the floor, improving air circulation around the drainage hole. Fits pots 10–18 cm diameter. Height: 15 cm.', 'image'=>'a9.webp'],
];

$categories = ['cacti'=>'🌵 Cacti','succulents'=>'🌱 Succulents','pots'=>'🪴 Pots & Planters','accessories'=>'🧰 Accessories'];

// PRODUCT SEARCH 
$search_query = trim($_GET['search'] ?? '');
$search_cat   = trim($_GET['cat']    ?? '');

$all_products = array_filter($all_products_raw, function($p) use ($search_query, $search_cat) {
    $matchKw = $search_query === '' ||
               stripos($p['name'], $search_query) !== false ||
               stripos($p['description'], $search_query) !== false;
    $matchCat = $search_cat === '' || $search_cat === 'all' || $p['category'] === $search_cat;
    return $matchKw && $matchCat;
});
$all_products = array_values($all_products);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Enhancements 2 — Product Management Module and Product Search Feature.">
  <title>Enhancements 2 | <?php echo $site_name; ?></title>
  <link rel="stylesheet" href="styles/style.css">
  <style>
    .enh-section    { max-width:1100px;margin:2rem auto;padding:0 1.5rem; }
    .enh-card       { background:#fff;border:1px solid #e0ece5;border-radius:10px;padding:1.8rem 2rem;margin-bottom:2.5rem;box-shadow:0 2px 8px rgba(0,0,0,0.06); }
    .enh-card h2    { color:#2c7a50;margin-top:0;border-bottom:2px solid #e0ece5;padding-bottom:0.6rem; }
    .enh-meta       { background:#f5faf7;border-left:4px solid #2c7a50;padding:0.9rem 1.2rem;border-radius:0 6px 6px 0;margin:1rem 0; }
    .enh-meta h4    { margin:0 0 0.4rem;color:#1e5c3a;font-size:0.95rem; }
    .enh-meta p     { margin:0;font-size:0.88rem;color:#444;line-height:1.6; }
    .enh-meta ol    { margin:0.4rem 0 0 1.2rem;font-size:0.88rem;color:#444;line-height:1.8; }
    .search-bar     { display:flex;gap:0.7rem;flex-wrap:wrap;align-items:center;margin:1rem 0; }
    .search-bar input[type=text] { flex:1;min-width:180px;padding:0.55rem 0.9rem;border:1px solid #ccc;border-radius:6px;font-size:0.95rem; }
    .search-bar select { padding:0.55rem 0.9rem;border:1px solid #ccc;border-radius:6px;font-size:0.95rem; }
    .search-bar button { padding:0.55rem 1.2rem;background:#2c7a50;color:#fff;border:none;border-radius:6px;cursor:pointer;font-size:0.95rem; }
    .search-bar button:hover { background:#1e5c3a; }
    .clear-btn  { padding:0.55rem 1rem;background:#e0e0e0;color:#333;border-radius:6px;text-decoration:none;font-size:0.9rem; }
    .prod-grid  { display:grid;grid-template-columns:repeat(auto-fill,minmax(190px,1fr));gap:1rem;margin-top:1rem; }
    .prod-card  { border:1px solid #dde;border-radius:8px;overflow:hidden;background:#fafffe; }
    .prod-card img { width:100%;height:130px;object-fit:cover; }
    .prod-body  { padding:0.7rem; }
    .prod-body h4 { margin:0 0 0.3rem;font-size:0.88rem;color:#2c3e50; }
    .prod-price { color:#2c7a50;font-weight:700;font-size:0.93rem; }
    .cat-tag    { font-size:0.73rem;background:#e0f0e8;color:#2c7a50;border-radius:4px;padding:1px 6px;display:inline-block;margin-bottom:0.25rem; }
    .prod-desc  { font-size:0.76rem;color:#666;margin:0.3rem 0 0; }
    .result-info { font-size:0.87rem;color:#666;margin-bottom:0.5rem; }
    .no-results { text-align:center;color:#888;padding:2rem;font-size:1rem; }
    @media(max-width:600px){ .search-bar select { display:none; } }
  </style>
</head>
<body>

  <div id="top"></div>

  <?php include('header.inc'); ?>

  <main>
    <div class="page-hero">
      <h1>Enhancements 2</h1>
      <p>This page documents and demonstrates the PHP enhancements implemented beyond the
         basic assignment requirements. Each section explains what the feature does, how it goes
         beyond the requirements, and what a programmer needs to implement it.</p>
    </div>

    <div class="enh-section">

      <!-- ENHANCEMENT 1 — PRODUCT MANAGEMENT MODULE -->
      <div class="enh-card" id="manage">
        <h2>Enhancement 1 — Product Management Module
          <span style="font-size:0.65rem;background:#fff3cd;color:#856404;padding:2px 8px;border-radius:4px;vertical-align:middle;margin-left:0.5rem;">Admin Only</span>
        </h2>

        <div class="enh-meta">
          <h4>How it goes beyond the specified requirements:</h4>
          <p>The basic requirements only require storing and displaying order, registration, and enquiry
             data. This module adds a fully interactive product catalogue backed by a dedicated
             <code>products</code> MySQL table — separate from the hardcoded price list in
             <code>order_process.php</code>. Admins can add new products, edit existing product details
             (name, category, price, description, image), and delete discontinued products in real time
             without touching any PHP source code. All changes are reflected immediately in the Product
             Search feature below.</p>
        </div>

        <div class="enh-meta">
          <h4>What a programmer needs to implement this feature:</h4>
          <ol>
            <li>Create a <code>products</code> table in MySQL with columns:
              <code>id</code>, <code>category</code>, <code>slug</code>, <code>name</code>,
              <code>price</code>, <code>description</code>, <code>image</code>.</li>
            <li>Seed the table with initial product data on first load (check
              <code>COUNT(*)</code> before inserting).</li>
            <li>Build an HTML form with fields for each product attribute. Use
              <code>action="add"</code> (POST) for new products and <code>action="edit"</code>
              with a hidden <code>edit_id</code> for updates.</li>
            <li>Handle a <code>action="delete"</code> POST request that removes the row by
              <code>id</code>.</li>
            <li>Guard the add/edit/delete code with a session role check
              (<code>$_SESSION['role'] === 'admin'</code>) so only admins can mutate data.</li>
            <li>Generate a URL-safe <code>slug</code> from the product name using
              <code>preg_replace</code> and check for duplicates before inserting.</li>
          </ol>
        </div>

        <p style="color:#888;">&#128274; Product management requires a MySQL database connection. This demo uses hardcoded product data — see the Product Search section below to browse all products.</p>
      </div>

      <!-- ENHANCEMENT 2 — PRODUCT SEARCH FEATURE -->
      <div class="enh-card" id="search">
        <h2>Enhancement 2 — Product Search Feature</h2>

        <div class="enh-meta">
          <h4>How it goes beyond the specified requirements:</h4>
          <p>The specified requirements only require displaying product information on static product
             pages (product1–4.php). This enhancement adds a dynamic search interface that filters the
             entire product catalogue by keyword (matching product name and description) and by category
             simultaneously — without navigating between four separate product pages. Results are
             displayed as a responsive image card grid, providing a far superior browsing experience.</p>
        </div>

        <div class="enh-meta">
          <h4>What a programmer needs to implement this feature:</h4>
          <ol>
            <li>Read <code>$_GET['search']</code> and <code>$_GET['cat']</code> from the URL
              (submitted by a GET form).</li>
            <li>Filter the product list: use <code>stripos()</code> to match keyword against
              name and description, and compare category string for the category filter.</li>
            <li>Sanitise all GET values with <code>htmlspecialchars()</code> before outputting
              to prevent XSS.</li>
            <li>Loop the filtered results into a product card grid using CSS Grid.</li>
            <li>Display the result count and a "Clear" link when filters are active, so users can
              reset easily.</li>
          </ol>
        </div>

        <form method="get" action="enchancement2.php#search">
          <div class="search-bar">
            <input type="text" name="search" placeholder="Search products by name or description…"
                   value="<?php echo htmlspecialchars($search_query); ?>">
            <select name="cat">
              <option value="all" <?php echo ($search_cat===''||$search_cat==='all')?'selected':''; ?>>All Categories</option>
              <?php foreach ($categories as $key => $label): ?>
              <option value="<?php echo $key; ?>" <?php echo $search_cat===$key?'selected':''; ?>>
                <?php echo $label; ?>
              </option>
              <?php endforeach; ?>
            </select>
            <button type="submit">Search</button>
            <?php if ($search_query !== '' || ($search_cat !== '' && $search_cat !== 'all')): ?>
              <a href="enchancement2.php#search" class="clear-btn">✕ Clear</a>
            <?php endif; ?>
          </div>
        </form>

        <?php if ($search_query !== '' || ($search_cat !== '' && $search_cat !== 'all')): ?>
          <p class="result-info"><?php echo count($all_products); ?> result(s)
            <?php if ($search_query): ?> for "<strong><?php echo htmlspecialchars($search_query); ?></strong>"<?php endif; ?>
            <?php if ($search_cat && $search_cat !== 'all'): ?> in <strong><?php echo htmlspecialchars($categories[$search_cat] ?? $search_cat); ?></strong><?php endif; ?>
          </p>
        <?php endif; ?>

        <?php if (count($all_products) === 0): ?>
          <p class="no-results">No products found. Try different keywords or clear the filter.</p>
        <?php else: ?>
          <div class="prod-grid">
            <?php foreach ($all_products as $p): ?>
              <div class="prod-card">
                <?php if ($p['image']): ?>
                  <img src="images/<?php echo htmlspecialchars($p['image']); ?>"
                       alt="<?php echo htmlspecialchars($p['name']); ?>"
                       onerror="this.style.display='none'">
                <?php endif; ?>
                <div class="prod-body">
                  <span class="cat-tag"><?php echo htmlspecialchars($categories[$p['category']] ?? $p['category']); ?></span>
                  <h4><?php echo htmlspecialchars($p['name']); ?></h4>
                  <div class="prod-price">RM <?php echo number_format((float)$p['price'],2); ?></div>
                  <?php if ($p['description']): ?>
                    <p class="prod-desc"><?php echo htmlspecialchars($p['description']); ?></p>
                  <?php endif; ?>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </div>

      <!-- ENHANCEMENT 3 — ANTI-SPAM FEATURE -->
      <div class="enh-card" id="antispam">
        <h2>Enhancement 3 — Anti-Spam Feature</h2>

        <div class="enh-meta">
          <h4>How it goes beyond the specified requirements:</h4>
          <p>The basic enquiry form has no protection against repeated automated or deliberate
             mass submissions that could flood the database. This enhancement adds a session-based
             rate limiter in <code>enquiry_process.php</code>: after <strong>3 submissions within
             any 5-minute window</strong>, the user's session is locked out for <strong>10
             minutes</strong>. During a lockout the form submission is rejected and a clear
             user-friendly error message is displayed explaining the wait time remaining. This goes
             beyond the assignment requirements by protecting the integrity of the enquiry data and
             preventing database abuse, a real-world concern not covered in lecture exercises.</p>
        </div>

        <div class="enh-meta">
          <h4>What a programmer needs to implement this feature:</h4>
          <ol>
            <li>At the top of <code>enquiry_process.php</code>, define constants:
              <code>$SPAM_MAX = 3</code>, <code>$SPAM_WINDOW = 300</code> (5 min),
              <code>$SPAM_LOCKOUT = 600</code> (10 min).</li>
            <li>Initialise two session variables: <code>$_SESSION['enq_times']</code> (array of
              Unix timestamps of past submissions) and <code>$_SESSION['enq_lockout']</code>
              (Unix timestamp when lockout expires).</li>
            <li>On each POST, first check if <code>time() &lt; $_SESSION['enq_lockout']</code>. If
              so, block the submission and show a message with the remaining minutes.</li>
            <li>Otherwise, filter <code>enq_times</code> to remove entries older than
              <code>$SPAM_WINDOW</code> seconds. If the count is still &ge;
              <code>$SPAM_MAX</code>, set the lockout timestamp and clear the array.</li>
            <li>After a <em>successful</em> DB insert, append <code>time()</code> to
              <code>$_SESSION['enq_times']</code>.</li>
            <li>If spam is detected, skip all other form validation to prevent partial-error
              messages and show only the lockout notice.</li>
          </ol>
        </div>

        <p>
          <strong>Live demo:</strong> Visit <a href="enquiry.php">enquiry.php</a> and submit the
          form more than 3 times within 5 minutes to trigger the lockout.
        </p>
      </div>

    </div><!-- /enh-section -->

    <div class="enh-section" style="margin-top:0;">
      <!-- ENHANCEMENT 4: User Dashboard -->
      <div class="enh-card" id="userdash">
        <h2>Enhancement 4 — User Dashboard</h2>
        <div class="enh-meta">
          <h4>How it goes beyond the specified requirements:</h4>
          <p>The basic requirements only provide a login and registration page for users. This enhancement adds a full personalised account dashboard (<code>user_dashboard.php</code>) accessible after login. Users can view and edit their profile details, view their order history with live status badges, and change their password — none of which are required by the core specification. This mirrors the admin dashboard in quality but is tailored to the customer experience.</p>
        </div>
        <div class="enh-meta">
          <h4>What a programmer needs to implement this feature:</h4>
          <ol>
            <li>Create <code>user_dashboard.php</code> with a session check redirecting non-users (guests go to login, admins go to admin dashboard).</li>
            <li>Store <code>$_SESSION['uid']</code> at login time so the dashboard can load the correct user row.</li>
            <li>Build three sections via a <code>?section=</code> GET parameter: Profile (edit form with full validation), Orders (load from <code>orders</code> table by matching email), and Change Password (verify current, validate new, update DB).</li>
            <li>Add a sidebar navigation using CSS Grid and the existing design tokens (font, colours, border-radius) to keep visual consistency.</li>
            <li>Update <code>header.inc</code> to show a "My Account" link for logged-in non-admin users.</li>
          </ol>
        </div>
        <p><strong>Live demo:</strong> <a href="login.php">Log in</a> as a regular user and click "My Account" in the navigation bar.</p>
      </div>

      <!-- ENHANCEMENT 5: Global Search Bar -->
      <div class="enh-card" id="globalsearch">
        <h2>Enhancement 5 — Global Search Bar on Every Page</h2>
        <div class="enh-meta">
          <h4>How it goes beyond the specified requirements:</h4>
          <p>The Product Search Feature (Enhancement 2) was a standalone page. This enhancement goes further by embedding a persistent search bar on <em>every page</em> of the website via <code>header.inc</code>. The green search bar appears directly below the navigation header on all pages — product pages, the homepage, the order page, member pages, and more — meaning users can search at any time without navigating to a dedicated search page first. A category dropdown and keyword field submit directly to <code>product_search.php</code>.</p>
        </div>
        <div class="enh-meta">
          <h4>What a programmer needs to implement this feature:</h4>
          <ol>
            <li>Add a <code>&lt;div class="global-search-bar"&gt;</code> block at the bottom of <code>header.inc</code> so it appears on every page that includes the header.</li>
            <li>Style it with a dark green background (<code>var(--green-dark)</code>) using the site's CSS variables to stay consistent with the design system.</li>
            <li>Include a text input (<code>name="search"</code>), a category <code>&lt;select&gt;</code> (<code>name="cat"</code>), and a submit button — all pointing to <code>product_search.php</code> via GET.</li>
            <li>Pre-populate <code>value</code> attributes from <code>$_GET</code> so the search bar shows the current query when viewing search results.</li>
            <li>Add a responsive media query to hide the category dropdown on small screens to keep the bar usable on mobile.</li>
          </ol>
        </div>
        <p><strong>Live demo:</strong> The search bar is visible at the top of this page and every other page on the site. Try searching "aloe" or filtering by "🌵 Cacti".</p>
      </div>
    </div>
  </main>

  <?php include('footer.inc'); ?>

</body>
</html>
