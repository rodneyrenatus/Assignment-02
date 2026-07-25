<?php
// header.inc — shared site header, navigation, and global search bar
if (!isset($nav_active)) { $nav_active = ''; }
?>
  <header>
    <div class="logo-area">
      <a href="index.php">
        <img src="images/cacti succulent 2.png" alt="Cacti Succulent Kuching Logo">
      </a>
    </div>
    <nav>
      <div class="dropdown">
        <a href="product1.php" class="dropbtn <?php echo ($nav_active === 'products') ? 'active' : ''; ?>">Products ▾</a>
        <div class="dropdown-content">
          <a href="product1.php">🌵 Cacti</a>
          <a href="product2.php">🌱 Succulents</a>
          <a href="product3.php">🪴 Pots &amp; Planters</a>
          <a href="product4.php">🧰 Accessories</a>
        </div>
      </div>
      <a href="order.php"        <?php echo $nav_active==='order'    ?'class="active"':''; ?>>Order</a>
      <a href="registration.php" <?php echo $nav_active==='register' ?'class="active"':''; ?>>Register</a>
      <?php if (isset($_SESSION['role'])): ?>
        <?php if ($_SESSION['role'] === 'admin'): ?>
          <a href="dashboard.php"    <?php echo $nav_active==='dashboard'?'class="active"':''; ?>>Dashboard</a>
        <?php else: ?>
          <a href="user_dashboard.php" <?php echo $nav_active==='user_dashboard'?'class="active"':''; ?>>My Account</a>
        <?php endif; ?>
        <a href="logout.php">Logout</a>
      <?php else: ?>
        <a href="login.php" <?php echo $nav_active==='login'?'class="active"':''; ?>>Login</a>
      <?php endif; ?>
      <a href="enquiry.php" <?php echo $nav_active==='enquiry'?'class="active"':''; ?>>Enquiry</a>
      <a href="members.php" <?php echo $nav_active==='members'?'class="active"':''; ?>>Members</a>
    </nav>
  </header>

  <!-- Global Search Bar — visible on every page -->
  <div class="global-search-bar">
    <form method="get" action="product_search.php">
      <div class="gsb-inner">
        <span class="gsb-icon">🔍</span>
        <input type="text" name="search"
               placeholder="Search products — cacti, succulents, pots, accessories…"
               value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
        <select name="cat">
          <option value="all">All</option>
          <option value="cacti"        <?php echo (($_GET['cat'] ?? '')==='cacti')       ?'selected':''; ?>>🌵 Cacti</option>
          <option value="succulents"   <?php echo (($_GET['cat'] ?? '')==='succulents')  ?'selected':''; ?>>🌱 Succulents</option>
          <option value="pots"         <?php echo (($_GET['cat'] ?? '')==='pots')        ?'selected':''; ?>>🪴 Pots</option>
          <option value="accessories"  <?php echo (($_GET['cat'] ?? '')==='accessories') ?'selected':''; ?>>🧰 Accessories</option>
        </select>
        <button type="submit">Search</button>
      </div>
    </form>
  </div>
