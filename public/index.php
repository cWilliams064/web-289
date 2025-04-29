<?php require_once('../private/initialize.php'); ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Home</title>
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
      <form action="/web-289/public/recipes/index.php" method="GET">
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
      <main role="main" id="home-page">
        <section>
          <section>
            <h1>Grandma's Pantry</h1>
            <p>We inspire flavor, you create magic!</p>
            <a href="./recipes/index.php">View Our Recipes</a>
          </section>
          <img src="assets/h1-image.jpeg" width="1084" height="427" alt="Picnic foods with a juice pitcher on top of a wooden counter in a kitchen with the sun shining in.">
        </section>
        <section id="popular-categories">
          <h2>Popular Categories</h2>
          <section>
            <a href="./recipes/index.php"><h3>Breakfast</h3></a>
            <img src="assets/home-category/breakfast-category.png" width="322" height="395" alt="An egg croissant layered breakfast meal.">
          </section>
          <section>
            <a href="./recipes/index.php"><h3>Vegan</h3></a>
            <img src="assets/home-category/vegan-category.png" width="322" height="395" alt="Vegan meal with avocado slices and egg on whole wheat bread.">
          </section>
          <section>
            <a href="./recipes/index.php"><h3>Italian</h3></a>
            <img src="assets/home-category/italian-category.png" width="322" height="395" alt="Italian pasta with spaghetti noodles with tomatoes and herbs.">
          </section>
        </section>
        <section>
          <article>
            <h2>The Heart of Grandma's Pantry</h2>
            <p>Welcome to Grandma's Pantry, a place where recipes feel like home. Every dish you find here has a story. Some come from old family cookbooks, and others were made from fun experiments in the kitchen. No matter where they started, all our recipes are meant to be shared and enjoyed with the people you love.</p>
            <p>Here, cooking is about more than just food. It's about memories, laughter, and time spent together. Whether you're learning to cook or have been doing it for years, Grandma's Pantry is here to help you have fun in the kitchen and try something new.</p>
            <p>Life gets busy, and we know that cooking isn't always easy. That's why we've made it simple to search by ingredients or type of meal. So if you only have a few things in your kitchen, we can help you turn them into something delicious.</p>
            <p>So come on in and take a look around. Try a recipe, share your own, or just get inspired for your next meal. Grandma’s Pantry is more than a website—it's a cozy place where good food and good memories come together.</p>
          </article>
          <img src="assets/pancake-skillet.png" width="478" height="615" alt="A black skillet with pancakes and mixed berries.">
        </section>
      </main>
    </div>
    
    <footer>
        <p>&copy; 2025 Grandma's Pantry. All Rights Reserved.</p>
        <nav>
          <ul>
            <li><a href="./index.php">Home</a></li>
            <li><a href="recipes/index.php">Recipes</a></li>
            <li><a href="./about.php">About Us</a></li>
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
