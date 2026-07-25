<?php

session_start();
$site_name    = "Cacti-Succulent Kuching";
$current_year = 2026;
$nav_active   = "products";

require_once("connection.php");

// SEARCH / FILTER
$search_query = trim($_GET['search'] ?? '');
$search_cat   = trim($_GET['cat']    ?? 'all');
$sort         = in_array($_GET['sort'] ?? '', ['name','price_asc','price_desc']) ? $_GET['sort'] : 'name';

$where_parts = [];
if ($search_query !== '') {
    $sq = mysqli_real_escape_string($conn, $search_query);
    $where_parts[] = "(name LIKE '%$sq%' OR description LIKE '%$sq%')";
}
if ($search_cat !== '' && $search_cat !== 'all') {
    $sc = mysqli_real_escape_string($conn, $search_cat);
    $where_parts[] = "category='$sc'";
}
$where_sql = count($where_parts) ? "WHERE " . implode(" AND ", $where_parts) : "";

$order_sql = match($sort) {
    'price_asc'  => "ORDER BY price ASC",
    'price_desc' => "ORDER BY price DESC",
    default      => "ORDER BY name ASC",
};

$result      = mysqli_query($conn, "SELECT * FROM products $where_sql $order_sql");
$all_products = [];
while ($r = mysqli_fetch_assoc($result)) { $all_products[] = $r; }

// Price range for display
$price_row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT MIN(price) AS minp, MAX(price) AS maxp FROM products $where_sql"));

mysqli_close($conn);

$categories = [
    'all'         => 'All Categories',
    'cacti'       => '🌵 Cacti',
    'succulents'  => '🌱 Succulents',
    'pots'        => '🪴 Pots & Planters',
    'accessories' => '🧰 Accessories',
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Search all products at Cacti-Succulent Kuching.">
  <title>Product Search | <?php echo $site_name; ?></title>
  <link rel="stylesheet" href="styles/style.css">
  <style>
    .search-page-wrap  { max-width:1100px;margin:2rem auto;padding:0 1.5rem; }
    .search-form-card  { background:#f0f7f2;border:1px solid #d0e8d8;border-radius:10px;padding:1.4rem 1.8rem;margin-bottom:2rem; }
    .search-form-card h2 { margin:0 0 1rem;color:#2c7a50;font-size:1.1rem; }
    .sf-row  { display:flex;gap:0.8rem;flex-wrap:wrap;align-items:flex-end; }
    .sf-group { display:flex;flex-direction:column;gap:0.3rem;flex:1;min-width:160px; }
    .sf-group label { font-size:0.85rem;font-weight:600;color:#444; }
    .sf-group input[type=text],
    .sf-group select { padding:0.55rem 0.8rem;border:1px solid #ccc;border-radius:6px;font-size:0.9rem; }
    .sf-btn  { padding:0.55rem 1.4rem;background:#2c7a50;color:#fff;border:none;border-radius:6px;font-size:0.9rem;cursor:pointer;align-self:flex-end; }
    .sf-btn:hover { background:#1e5c3a; }
    .clear-link { font-size:0.85rem;color:#888;text-decoration:none;align-self:flex-end;padding-bottom:0.1rem; }
    .clear-link:hover { color:#c0392b; }
    .result-bar { display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:0.5rem;margin-bottom:1rem; }
    .result-bar p { margin:0;color:#555;font-size:0.9rem; }
    .prod-grid  { display:grid;grid-template-columns:repeat(auto-fill,minmax(210px,1fr));gap:1.2rem; }
    .prod-card  { border:1px solid #dde;border-radius:10px;overflow:hidden;background:#fff;
                  transition:transform 0.22s,box-shadow 0.22s; }
    .prod-card:hover { transform:translateY(-5px);box-shadow:0 10px 30px rgba(40,70,50,0.14); }
    .prod-card img { width:100%;height:150px;object-fit:cover; }
    .prod-body  { padding:0.85rem; }
    .cat-tag    { font-size:0.72rem;background:#e0f0e8;color:#2c7a50;border-radius:4px;
                  padding:2px 7px;display:inline-block;margin-bottom:0.35rem; }
    .prod-body h3 { margin:0 0 0.3rem;font-size:0.95rem;color:#2c3e50; }
    .prod-body p  { font-size:0.8rem;color:#666;margin:0 0 0.6rem;line-height:1.5; }
    .prod-foot  { display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:0.4rem; }
    .prod-price { color:#2c7a50;font-weight:700;font-size:1rem; }
    .buy-btn    { padding:5px 14px;background:#2c7a50;color:#fff;border-radius:5px;text-decoration:none;font-size:0.82rem; }
    .buy-btn:hover { background:#1e5c3a; }
    .admin-edit-btn { display:block;margin-top:0.4rem;padding:3px 10px;background:#2980b9;
                      color:#fff;border-radius:4px;text-decoration:none;font-size:0.75rem;text-align:center; }
    .no-results { text-align:center;padding:3rem;color:#888;font-size:1rem; }
    @media(max-width:600px){ .sf-row { flex-direction:column; } }
  </style>
</head>
<body>

  <div id="top"></div>
  <?php include('header.inc'); ?>

  <main>
    <div class="page-hero">
      <h1>🔍 Product Search</h1>
      <p>Search across all <?php echo count($all_products); ?> product<?php echo count($all_products) !== 1 ? 's' : ''; ?> in our catalogue by keyword, category, or sort by price.</p>
    </div>

    <div class="search-page-wrap">

      <!-- Search Form -->
      <div class="search-form-card">
        <h2>Find a Product</h2>
        <form method="get" action="product_search.php">
          <div class="sf-row">
            <div class="sf-group">
              <label for="s_kw">Keyword</label>
              <input type="text" id="s_kw" name="search"
                     placeholder="e.g. aloe, ceramic, soil…"
                     value="<?php echo htmlspecialchars($search_query); ?>">
            </div>
            <div class="sf-group">
              <label for="s_cat">Category</label>
              <select id="s_cat" name="cat">
                <?php foreach ($categories as $key => $label): ?>
                  <option value="<?php echo $key; ?>" <?php echo $search_cat === $key ? 'selected' : ''; ?>>
                    <?php echo $label; ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="sf-group">
              <label for="s_sort">Sort By</label>
              <select id="s_sort" name="sort">
                <option value="name"       <?php echo $sort === 'name'       ? 'selected' : ''; ?>>Name (A–Z)</option>
                <option value="price_asc"  <?php echo $sort === 'price_asc'  ? 'selected' : ''; ?>>Price (Low → High)</option>
                <option value="price_desc" <?php echo $sort === 'price_desc' ? 'selected' : ''; ?>>Price (High → Low)</option>
              </select>
            </div>
            <button type="submit" class="sf-btn">Search</button>
            <?php if ($search_query !== '' || ($search_cat !== 'all' && $search_cat !== '')): ?>
              <a href="product_search.php" class="clear-link">✕ Clear filters</a>
            <?php endif; ?>
          </div>
        </form>
      </div>

      <!-- Results bar -->
      <div class="result-bar">
        <p>
          <?php if ($search_query !== '' || ($search_cat !== 'all' && $search_cat !== '')): ?>
            <strong><?php echo count($all_products); ?></strong> result(s)
            <?php if ($search_query !== ''): ?>
              for "<strong><?php echo htmlspecialchars($search_query); ?></strong>"
            <?php endif; ?>
            <?php if ($search_cat !== 'all' && $search_cat !== ''): ?>
              in <strong><?php echo htmlspecialchars($categories[$search_cat] ?? $search_cat); ?></strong>
            <?php endif; ?>
          <?php else: ?>
            Showing all <strong><?php echo count($all_products); ?></strong> products
          <?php endif; ?>
        </p>
        <?php if (!empty($all_products)): ?>
          <p style="font-size:0.85rem;color:#888;">
            Price range: RM <?php echo number_format((float)$price_row['minp'], 2); ?>
            – RM <?php echo number_format((float)$price_row['maxp'], 2); ?>
          </p>
        <?php endif; ?>
      </div>

      <!-- Product Grid -->
      <?php if (empty($all_products)): ?>
        <div class="no-results">
          <p>😔 No products match your search.</p>
          <p><a href="product_search.php">Clear filters and view all products</a></p>
        </div>
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
                <h3><?php echo htmlspecialchars($p['name']); ?></h3>
                <?php if ($p['description']): ?>
                  <p><?php echo htmlspecialchars($p['description']); ?></p>
                <?php endif; ?>
                <div class="prod-foot">
                  <span class="prod-price">RM <?php echo number_format((float)$p['price'], 2); ?></span>
                  <a href="order.php" class="buy-btn">Order Now</a>
                </div>
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                  <a href="enhancements2.php?edit_id=<?php echo $p['id']; ?>#manage" class="admin-edit-btn">✏️ Edit Product</a>
                <?php endif; ?>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>

    </div><!-- /search-page-wrap -->
  </main>

  <?php include('footer.inc'); ?>

</body>
</html>
