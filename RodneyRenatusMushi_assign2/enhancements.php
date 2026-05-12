<?php
$site_name = "Cacti-Succulent Kuching";
$current_year = 2026;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Enhancements — extra HTML and CSS features implemented on the Cacti-Succulent Kuching website.">
  <meta name="keywords" content="enhancements, features, HTML, CSS, cacti kuching">
  <meta name="author" content="Cacti-Succulent Kuching Team">
  <title>Enhancements | Cacti-Succulent Kuching</title>
  <link rel="stylesheet" href="styles/style.css">
  <style>
    /* Code sample blocks — enhancement page only */
    pre.code-block {
      background: #f0f7f2;
      border: 1px solid #d0e8d8;
      border-radius: 8px;
      padding: 14px 18px;
      margin: 10px 0 14px;
      overflow-x: auto;
      font-size: 0.83rem;
      line-height: 1.6;
      color: #2a3d2e;
    }
    pre.code-block code {
      background: none;
      border: none;
      padding: 0;
      font-family: 'Courier New', Courier, monospace;
    }
  </style>
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
        <a href="product1.php" class="dropbtn">Products ▾</a>
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

  <main>

    <div class="page-hero">
      <h1>Enhancements</h1>
      <p>This page lists and describes the extra HTML and CSS features we implemented that go
         beyond the basic assignment requirements. Each entry links directly to where the
         feature is applied on the website.</p>
    </div>

    <!-- Enhancement 1 -->
    <div class="enhancement-item">
      <h3>Enhancement 1 — CSS Sticky Navigation Header</h3>

      <p><strong>What it does:</strong> The site's navigation header remains fixed at the top
         of the viewport as the user scrolls down any page. This improves usability by keeping
         all navigation links constantly accessible without requiring the user to scroll back to
         the top.</p>

      <p><strong>How it goes beyond the basics:</strong> The lab exercises only covered static
         page layouts. A sticky header requires knowledge of CSS positioning properties
         (<code>position: sticky</code>, <code>top: 0</code>, and <code>z-index</code>) that
         were not covered in the tutorial sheets. It also requires careful use of
         <code>z-index</code> to ensure the header overlaps all other page content correctly
         without JavaScript.</p>

      <p><strong>Code used (in style.css):</strong></p>
      <pre class="code-block">
        <code>header {
          position: sticky;
          top: 0;
          z-index: 100;
        }
        </code>
      </pre>

      <p><strong>Where to see it:</strong>
         <a href="index.php">index.html</a> — scroll down the homepage and the green header
         stays visible at the top. The same behaviour is present on every page of the site.</p>
    </div>

    <!-- Enhancement 2 -->
    <div class="enhancement-item">
      <h3>Enhancement 2 — Pure CSS Dropdown Navigation Menu</h3>

      <p><strong>What it does:</strong> The <em>Products</em> navigation link reveals a
         dropdown sub-menu listing all four product category pages when the user hovers over
         it. This is achieved entirely with CSS using the <code>:hover</code> pseudo-class
         and a sibling <code>div</code> — no JavaScript is used.</p>

      <p><strong>How it goes beyond the basics:</strong> Lab exercises introduced basic
         navigation links. Building a dropdown menu requires understanding of
         <code>position: absolute</code> inside a <code>position: relative</code> parent,
         the CSS <code>display</code> toggle pattern using <code>:hover</code>, and
         careful layering with <code>z-index</code>. The contextual CSS selector
         <code>.dropdown:hover .dropdown-content</code> demonstrates the use of a
         <em>descendant</em> combinator with a pseudo-class — beyond basic selector usage
         taught in labs.</p>

      <p><strong>Code used (in style.css):</strong></p>
      <pre class="code-block">
        <code>.dropdown-content {
          display: none;
          position: absolute;
          top: calc(100% + 6px);
          left: 0;
          z-index: 200;
        }

        .dropdown:hover .dropdown-content {
          display: block;
        }
        </code>
      </pre>

      <p><strong>Where to see it:</strong>
         <a href="product1.html#care-tips">product1.html</a> — hover over the
         <em>Products ▾</em> link in the navigation bar to reveal the dropdown with links
         to all four product pages.</p>
    </div>

    <!-- Enhancement 3 -->
    <div class="enhancement-item">
      <h3>Enhancement 3 — Embedded Google Maps (iFrame) on Member Profile Pages</h3>

      <p><strong>What it does:</strong> Each team member's individual profile page includes
         an embedded Google Maps widget that shows the location of their hometown. The map
         is interactive — users can zoom, pan, and switch to satellite view directly on the
         page without leaving the site.</p>

      <p><strong>How it goes beyond the basics:</strong> The assignment spec explicitly lists
         "Embedding External Content — Google Maps (about.html)" as an example of a
         higher-mark enhancement. Embedding an external map requires use of the
         <code>&lt;iframe&gt;</code> element with a correctly formed Google Maps embed URL,
         as well as the <code>allowfullscreen</code> and <code>loading="lazy"</code>
         attributes for performance and accessibility. CSS is then used to make the map
         frame responsive (100% width, fixed height, rounded corners).</p>

      <p><strong>Code used (in member1.html):</strong></p>
      <pre class="code-block">
        <code>&lt;iframe
          class="map-embed"
          src="https://maps.google.com/maps?q=Petra+Jaya,+Kuching,+Sarawak&amp;output=embed&amp;z=14"
          allowfullscreen=""
          loading="lazy"
          title="Petra Jaya, Kuching"&gt;
        &lt;/iframe&gt;
        </code>
      </pre>

      <p><strong>CSS (in style.css):</strong></p>
      <pre class="code-block">
        <code>.map-embed {
            width: 100%;
            height: 300px;
            border: none;
            border-radius: 10px;
            display: block;
          }
        </code>
      </pre>

      <p><strong>Where to see it:</strong>
         <a href="member1.html#map">member1.html</a> — scroll to the
         <em>Where I Live</em> section on Mohd Amirunhisyam's profile page to see the
         interactive map of Petra Jaya, Kuching. The same feature is also present on
         <a href="member2.php">member2.html</a>,
         <a href="member3.php">member3.html</a>, and
         <a href="member4.php">member4.html</a>.</p>
    </div>

    <!-- Enhancement 4 -->
    <div class="enhancement-item">
      <h3>Enhancement 4 — CSS Hover Transitions and Card Lift Effect on Product Cards</h3>

      <p><strong>What it does:</strong> Every product card across all four product pages and
         the homepage animates smoothly when the user hovers over it — the card lifts upward
         with a subtle vertical translate and the box shadow deepens, giving a tactile,
         depth-of-field effect. The same lift animation is applied to member cards on the
         Members page.</p>

      <p><strong>How it goes beyond the basics:</strong> The lab tutorials did not cover CSS
         transitions or the <code>transform</code> property. This enhancement uses
         <code>transition</code> to smoothly animate both <code>transform: translateY()</code>
         and <code>box-shadow</code> on <code>:hover</code>, creating a polished interactive
         experience without any JavaScript. The technique requires understanding of CSS
         transition timing, the transform origin, and layered shadow values — all of which
         are beyond the scope of the lab sheets.</p>

      <p><strong>Code used (in style.css):</strong></p>
      <pre class="code-block">
        <code>.product-card {
          transition: transform 0.25s, box-shadow 0.25s;
        }

        .product-card:hover {
          transform: translateY(-6px);
          box-shadow: 0 12px 40px rgba(40,70,50,0.18);
        }
        </code>
      </pre>

      <p><strong>Where to see it:</strong>
         <a href="product1.html#products">product1.html</a> — hover over any cactus product
         card in the grid to see the lift animation. The effect is present on all product
         pages (<a href="product2.php">product2.html</a>,
         <a href="product3.php">product3.html</a>,
         <a href="product4.php">product4.html</a>) and on the
         <a href="members.php">members.html</a> team cards.</p>
    </div>

    <!-- Enhancement 5 -->
    <div class="enhancement-item">
      <h3>Enhancement 5 — Fixed "Back to Top" Button</h3>

      <p><strong>What it does:</strong> A small floating button labelled <em>⬆ Top</em> is
         fixed to the bottom-right corner of every page. Clicking it instantly scrolls the
         user back to the top of the page without requiring any JavaScript — it uses a plain
         anchor link targeting a hidden <code>div#top</code> placed at the very start of the
         <code>&lt;body&gt;</code>.</p>

      <p><strong>How it goes beyond the basics:</strong> The lab exercises only covered static
         inline and block-level elements. This enhancement uses <code>position: fixed</code>
         to pin an element to the viewport regardless of scroll position, combined with
         <code>border-radius</code>, <code>box-shadow</code>, and a <code>transition</code>
         on the hover state to produce a polished pill-shaped button — none of which were
         introduced in the tutorial sheets.</p>

      <p><strong>HTML used:</strong></p>
      <pre class="code-block">
        <code>&lt;div id="top"&gt;&lt;/div&gt;

&lt;a href="#top" class="top-btn"&gt;⬆ Top&lt;/a&gt;
        </code>
      </pre>

      <p><strong>CSS used:</strong></p>
      <pre class="code-block">
        <code>.top-btn {
          position: fixed;
          bottom: 20px;
          right: 20px;
          background: #2f4f4f;
          color: white;
          padding: 10px 14px;
          border-radius: 50px;
          text-decoration: none;
          font-size: 14px;
          box-shadow: 0 4px 10px rgba(0,0,0,0.2);
          transition: 0.3s;
        }

        .top-btn:hover {
          background: #1e3a3a;
          transform: translateY(-3px);
        }
        </code>
      </pre>

      <p><strong>Where to see it:</strong> The button is visible on this page — scroll down
         and look for the dark pill-shaped <em>⬆ Top</em> button in the bottom-right corner.
         Clicking it returns you to the top instantly.</p>
    </div>

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
