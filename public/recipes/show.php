<?php 

require_once('../../private/initialize.php');

$recipeId = $_GET['id'] ?? null;

if (!is_numeric($recipeId)) {
  redirect_to('/web-289/public/recipes/index.php');
}

$recipe = Recipe::find_by_id($recipeId);
if ($recipe) {
  $recipe->loadTimes();
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Recipes</title>
    <link href="../favicon.ico" rel="icon">
    <link href="../css/styles.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/3f0ab9bbdb.js" crossorigin="3f0ab9bbdb"></script>
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <script src="../js/app.js" defer></script>
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
          <input type="text" name="search" placeholder="Search a recipe" value="<?= h($_GET['search'] ?? '') ?>">
          <button>
            <img src="/web-289/public/assets/icons/search.svg" width="64" height="64" alt="Magnifying glass submit icon.">
          </button>
        </section>
      </form>
      <a href="/web-289/public/index.php"><img src="/web-289/public/assets/logo.png" width="500" height="500" alt="Pink and navy cupcake logo for Grandma's Pantry."></a>
    </header>

    <div id="wrapper">
      <?php 
        if ($session->is_logged_in()) {
          include("../logged-in.php");
        }

        if (!$session->is_logged_in()) {
          include("../login.php");
        }
      ?>
      <main role="main" id="show-recipe">
      <a class="back-link" href="<?= url_for('./birds/index.php'); ?>">&laquo; Back to List</a>

        <section>
          <h1><?= h($recipe->recipeName); ?></h1>
          <p>Categories: </p>
          <section>
            <p>By: </p>
            <a>Save for later</a>
            <div>
              <i class="fa-regular fa-star fa-xl"></i>
              <i class="fa-regular fa-star fa-xl"></i>
              <i class="fa-regular fa-star fa-xl"></i>
              <i class="fa-regular fa-star fa-xl"></i>
              <i class="fa-regular fa-star fa-xl"></i>
            </div>
            <?php $rating = $recipe->get_rating_info(); ?>
            <p><span><?= $rating['total']; ?> </span>Rating(s)</p>
          </section>
          <p>Prep: <span class="recipe-times"><?= h($recipe->get_prep_time()); ?></span></p>
          <p>Cook: <span class="recipe-times"><?= h($recipe->get_cook_time()); ?></span></p>
          <p><?= $recipe->recipeDescription; ?></p>
        </section>
        <img src="<?= $recipe->get_recipe_photo(); ?>" alt="Photo of <?= h($recipe->recipeName); ?>">
        <section>
          <p>Servings: <?= h($recipe->servings)?></p>
        </section>
        <section>
          <a href=""><i class="fa-solid fa-print"></i></a>
          <a href="#">Print Recipe</a>
          <a href="#"><i class="fa-regular fa-star"></i></a>
          <a href="#">Rate Recipe</a>
        </section>
        <section>
          
        </section>
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
