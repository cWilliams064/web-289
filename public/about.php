<?php require_once('../private/initialize.php'); ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>About Us</title>
    <script src="js/app.js" defer></script>
    <link href=favicon.ico rel="icon">
    <link href="css/styles.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>

  <body>
    <header role="banner">
      <nav>
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="recipes/index.php">Recipes</a></li>
          <li><a href="about.php">About Us</a></li>
          <li>
            <a href="#" id="open-sidebar">
              <?php if (!$session->is_logged_in()): ?>
                <span>Log In</span>
              <?php else: ?>
                <div>
                  <span class="text-flip"><?= $session->get_display_name() ?></span>
                  <span class="text-flip">View Profile</span>
                </div>
              <?php endif; ?>
            </a>
          </li>
          <li><a href="#"><img src="../public/assets/login-image.png" width="27" height="27" alt="User icon that links to login."></a></li>
        </ul>
      </nav>
      <form  action="<?= $_SERVER['PHP_SELF'] ?>" method="GET">
        <section>
          <input type="text" name="search-query" placeholder="Search a recipe" value="<?php echo isset($_GET['search-query']) ? $escapedSearchQuery : ''; ?>">
          <button>
            <img src="assets/icons/search.svg" width="64" height="64" alt="Magnifying glass submit icon.">
          </button>
          <section id="search-dropdown"></section>
        </section>
      </form>
      <a href=""><img src="assets/logo.png" width="500" height="500" alt="Pink and navy cupcake logo for Grandma's Pantry."></a>
    </header>

    <div id="wrapper">
      <?php 
      if($session->is_logged_in()) {
        include("./logged-in.php");
      }
        
      if(!$session->is_logged_in()) {
        include("./login.php");
      }
      ?>
      <main role="main" id="about-page">
        <h1>About Us</h1>
        <section>
          <h2>Our Story</h2>
          <p>At Grandma's Pantry, we believe that the kitchen is the heart of every home. Our journey began with a simple idea: to preserve the warmth and love that comes from sharing recipes passed down through generations.</p>
        </section>
        <section>
          <h2>Our Passion</h2>
          <p>Food has a special way of bringing people together, and that's what drives everything we do. At Grandma's Pantry, we're passionate about sharing recipes that spark memories, create new traditions, and make every meal feel like home.</p>
          <p>From timeless classics to fresh new favorites, our growing collection is here to inspire every cook—no matter your skill level. We believe that a well-loved recipe is a story worth passing on, and we’re honored to be part of your kitchen journey.</p>
        </section>
        <section>
          <h2>Contact Us</h2>
          <p>We'd love to hear from you! Whether you have a question about a recipe, a suggestion for new content, or just want to share your cooking success stories, we're here to connect. </p>
          <p>Drop us an email at <a href="mailto:contact@Grandmaspantry.com">contact@Grandmaspantry.com</a>, and we'll get back to you as soon as possible.</p>
        </section>
        <img src="assets/about-page-photo.png" width="1000" height="1000" alt="Macaroons and various candy on a long table in front of a window.">
      </main>
    </div>
    <footer>
        <p>&copy; 2025 Grandma's Pantry. All Rights Reserved.</p>
        <nav>
          <ul>
            <li><a href="/web-289/public/index.php">Home</a></li>
            <li><a href="/web-289/public/recipes/index.php">Recipes</a></li>
            <li><a href="/web-289/public/about.php">About Us</a></li>
          </ul>
        </nav>
        <section>
          <img src="assets/icons/instagram.png" width="31" height="31" alt="The social media Instagram logo.">
          <img src="assets/icons/x-social-media.png" width="31" height="31" alt="The social media X logo">
          <img src="assets/icons/facebook.png" width="31" height="31" alt="The social media Facebook logo.">
        </section>
    </footer>
  </body>

</html>
