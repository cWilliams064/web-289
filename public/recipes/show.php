<?php 

require_once('../../private/initialize.php');

$recipeId = $_GET['id'] ?? null;

if (!is_numeric($recipeId)) {
  redirect_to('/web-289/public/recipes/index.php');
}

/** @var Recipe $recipe */
$recipe = Recipe::find_by_id($recipeId);

$videos = RecipeVideo::get_videos($recipeId);
$video = !empty($videos) ? $videos[0] : null;

$directions = Direction::find_directions($recipeId);
$ingredients = Ingredient::find_ingredients($recipeId);

$rating = $recipe->get_rating_info();

$user = $session->get_user();
$userId = $user->id ?? null;

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?= $recipe->recipeName; ?></title>
    <link href="../favicon.ico" rel="icon">
    <link href="../css/styles.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/3f0ab9bbdb.js" crossorigin="3f0ab9bbdb"></script>
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <script src="../js/app.js" defer></script>
  </head>

  <body>
    <input type="hidden" id="isLoggedIn" value="<?= $session->is_logged_in() ? '1' : '0'; ?>">
    <div id="login-alert"></div>
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
        <a href="<?= 'index.php'; ?>">&laquo; Back to recipes</a>

        <section>
          <h1><?= h($recipe->recipeName); ?></h1>
          <p><strong>Categories:</strong> 
            <?php
              $recipeTypes = Recipe::find_recipe_types_by_recipe_id($recipeId);

              $categories = [];

              if ($recipeTypes) {
                $mealTypes = $recipeTypes[0]->mealTypes;
                $ethnicTypes = $recipeTypes[0]->ethnicTypes;
                $dietTypes = $recipeTypes[0]->dietTypes;

                if (!empty($mealTypes)) {
                  $categories = array_merge($categories, explode(',', $mealTypes));
                }
                if (!empty($ethnicTypes)) {
                  $categories = array_merge($categories, explode(',', $ethnicTypes));
                }
                if (!empty($dietTypes)) {
                  $categories = array_merge($categories, explode(',', $dietTypes));
                }
              }

              $categories = array_unique(array_map('trim', $categories));

              if (empty($categories)) {
                echo "No categories found";
              } else {
                echo implode(", ", $categories);
              }
            ?>
          </p>
          <section>
            <p>By: <?= $recipe->get_username(); ?></p>
            <div id="save-popup">
              <div>
                <p id="popup-message"></p>
                <div id="popup-buttons">
                  <button id="confirm-save">Yes</button>
                  <button id="cancel-save">Cancel</button>
                </div>
              </div>
            </div>
            <a href="javascript:void(0);" id="save-for-later" data-recipe-name="<?= h($recipe->recipeName); ?>" data-recipe-id="<?= $recipe->id; ?>">Save for later</a>
            <div id="rating-stars">
              <?php
                $averageRating = $rating['average'];
                for ($i = 1; $i <= 5; $i++) {
                  if ($averageRating >= $i) {
                    echo '<i class="fa-solid fa-star fa-xl"></i>';
                  } elseif ($averageRating >= ($i - 0.5)) {
                    echo '<i class="fa-solid fa-star-half-stroke fa-xl"></i>';
                  } else {
                    echo '<i class="fa-regular fa-star fa-xl"></i>';
                  }
                }
              ?>
            </div>
            <?php $rating = $recipe->get_rating_info(); ?>
            <p><span><?= $rating['total']; ?> </span>Rating(s)</p>
          </section>
          <p><strong>Prep:</strong> <span class="recipe-times"><?= h($recipe->get_prep_time()); ?></span></p>
          <p><strong>Cook:</strong> <span class="recipe-times"><?= h($recipe->get_cook_time()); ?></span></p>
          <p><?= $recipe->recipeDescription; ?></p>
        </section>
        <img src="<?= $recipe->get_recipe_photo(); ?>" alt="Photo of <?= h($recipe->recipeName); ?>">
        <section>
          <p id="servings">Servings: <?= h($recipe->servings)?></p>
          <section>
            <button id="multiplier-half" data-multiplier="0.5">1/2</button>
            <button id="multiplier-double" data-multiplier="2">2X</button>
            <button id="multiplier-triple" data-multiplier="3">3X</button>
            <button id="reset-servings" data-reset="true"><i class="fas fa-undo"></i></button>
          </section>
        </section>
        <section>
          <section>
            <a href="javascript:void(0);" id="print-recipe" data-recipe-id="<?= $recipe->id ?>"><i class="fa-solid fa-print fa-xl"></i></a>
            <a href="javascript:void(0);" id="print-recipe-text" data-recipe-id="<?= $recipe->id ?>">Print Recipe</a>
          </section>
          <section>
            <div id="rating-popup">
              <div class="popup-content">
                <h3>Rate Recipe</h3>
                <form id="rating-form">
                  <input type="hidden" name="rating" id="rating-input">
                  <input type="hidden" name="recipe_id" value="<?= $recipe->id; ?>">
                  <input type="hidden" name="user_id" id="user-id" value="<?= $userId ?>">

                  <p>Rating:</p>
                  <div id="stars">
                    <i class="fa-regular fa-star fa-xl" data-value="1"></i>
                    <i class="fa-regular fa-star fa-xl" data-value="2"></i>
                    <i class="fa-regular fa-star fa-xl" data-value="3"></i>
                    <i class="fa-regular fa-star fa-xl" data-value="4"></i>
                    <i class="fa-regular fa-star fa-xl" data-value="5"></i>
                  </div>
                  <button type="submit">Submit Rating</button>
                </form>
                <button id="close-popup">Close</button>
              </div>
            </div>
            <a href="javascript:void(0);" id="rate-star"><i class="fa-regular fa-star fa-xl"></i></a>
            <a href="javascript:void(0);" id="rate-recipe-link">Rate Recipe</a>
          </section>
        </section>
        <section id="ingredients-directions">
          <table>
            <thead>
              <tr>
                <th>Ingredients</th>
                <th>Directions</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <ul>
                    <?php foreach ($ingredients as $ingredient) : ?>
                      <li>
                        <?php 
                          $formattedQuantity = $ingredient->formatted_quantity();
                          $ingredientName = strtolower($ingredient->ingredientName);

                          $unitName = ($ingredient->quantity != 1) ? $ingredient->unitName . 's' : $ingredient->unitName;

                          if ($ingredientName === 'egg' || $ingredientName === 'eggs') {
                            echo $formattedQuantity . ' ' . $ingredient->ingredientName;
                          } else {
                            echo $formattedQuantity . ' ' . $unitName . ' ' . $ingredient->ingredientName;
                          }
                        ?>
                      </li>
                    <?php endforeach; ?>
                  </ul>
                </td>
                <td>
                  <ol>
                    <?php foreach ($directions as $direction) : ?>
                      <li><?= h($direction->instruction); ?></li>
                    <?php endforeach; ?>
                  </ol>
                </td>
              </tr>
            </tbody>
          </table>
        </section>
        <section>
          <?php if (!empty($video)): ?>
            <h2>Watch how to make <a href="https://www.youtube.com/embed/<?= h($video->youtubeId) ?>"><?= $recipe->recipeName; ?></a></h2>
            <iframe
              src="https://www.youtube.com/embed/<?= h($video->youtubeId) ?>"
              title="YouTube video player" frameborder="0"
              allowfullscreen>
            </iframe>
            <p><?= nl2br(h($video->creditParagraph)) ?></p>
          <?php endif; ?>
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
