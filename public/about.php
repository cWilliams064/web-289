<?php require_once('../private/initialize.php'); ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Recipes</title>
    <link href="./favicon.ico" rel="icon">
    <link href="./css/styles.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/3f0ab9bbdb.js" crossorigin="3f0ab9bbdb"></script>
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <script src="./js/app.js" defer></script>
  </head>

  <body>
    <header role="banner">
      <nav>
        <ul>
          <li><a href="/web-289/public/index.php">Home</a></li>
          <li><a href="/web-289/public/recipes/index.php">Recipes</a></li>
          <li><a href="/web-289/public/about.php">About Us</a></li>
          <li>
            <a href="#" id="open-sidebar">
              <?php if (!$session->is_logged_in()): ?>
                <span>Log In/Sign up</span>
              <?php else: ?>
                <div>
                  <span class="text-flip"><?= $session->get_display_name() ?></span>
                  <span class="text-flip">View Profile</span>
                </div>
              <?php endif; ?>
            </a>
          </li>
          <li><a href="#" id="open-sidebar-icon"><img src="/web-289/public/assets/login-image.png" width="27" height="27" alt="User icon that links to login."></a></li>
        </ul>
      </nav>
      <form  action="<?= $_SERVER['PHP_SELF'] ?>" method="GET">
        <section>
          <input type="text" name="search" placeholder="Search a recipe" value="<?php echo isset($_GET['search']) ? $escapedSearchQuery : ''; ?>">
          <button>
            <img src="/web-289/public/assets/icons/search.svg" width="64" height="64" alt="Magnifying glass submit icon.">
          </button>
        </section>
      </form>
      <a href="/web-289/public/index.php"><img src="/web-289/public/assets/logo.png" width="500" height="500" alt="Pink and navy cupcake logo for Grandma's Pantry."></a>
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
          <a href="https://www.instagram.com/"><i class="fa-brands fa-instagram fa-xl"></i></a>
          <a href="https://x.com/?lang=en"><i class="fa-brands fa-x-twitter fa-xl"></i></a>
          <a href="https://www.facebook.com/"><i class="fa-brands fa-facebook fa-xl"></i></a>
        </section>
    </footer>
  </body>

</html>
