<?php 

require_once('../../private/initialize.php');

$currentPage = $_GET['page'] ?? 1;
$perPage = 12;

$mealTypes = Category::get_all_names('meal_types');
$ethnicTypes = Category::get_all_names('ethnic_types');
$dietTypes = Category::get_all_names('diet_types');

if (!empty($_GET['search-query'])) {
  $totalCount = Recipe::count_filtered($_GET['search-query']);
} else {
  $totalCount = Recipe::count_all();
}

$pagination = new Pagination($currentPage, $perPage, $totalCount);

if (isset($_GET['search-query'])) {
  $searchQuery = $_GET['search-query'];
  $escapedSearchQuery = $database->escape_string($searchQuery);

  $sql = "SELECT * FROM recipes ";
  $sql .= "WHERE recipe_name LIKE '%{$escapedSearchQuery}%' ";
  $sql .= "LIMIT {$perPage} OFFSET {$pagination->offset()}";

  $recipes = Recipe::find_by_sql($sql);
} else {
  $sql = "SELECT * FROM recipes ";
  $sql .= "LIMIT {$perPage} ";
  $sql .= "OFFSET {$pagination->offset()}";

  $recipes = Recipe::find_by_sql($sql);
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Recipes</title>
    <script src="../js/app.js" defer></script>
    <link href="../favicon.ico" rel="icon">
    <link href="../css/styles.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                <span>Log In</span>
              <?php else: ?>
                <div>
                  <span class="text-flip"><?= $session->get_display_name() ?></span>
                  <span class="text-flip">View Profile</span>
                </div>
              <?php endif; ?>
            </a>
          </li>
          <li><a href="#"><img src="/web-289/public/assets/login-image.png" width="27" height="27" alt="User icon that links to login."></a></li>
        </ul>
      </nav>
      <form  action="<?= $_SERVER['PHP_SELF'] ?>" method="GET">
        <section>
          <input type="text" name="search-query" placeholder="Search a recipe" value="<?php echo isset($_GET['search-query']) ? $escapedSearchQuery : ''; ?>">
          <button>
            <img src="/web-289/public/assets/icons/search.svg" width="64" height="64" alt="Magnifying glass submit icon.">
          </button>
        </section>
      </form>
      <a href=""><img src="/web-289/public/assets/logo.png" width="500" height="500" alt="Pink and navy cupcake logo for Grandma's Pantry."></a>
    </header>

    <div id="wrapper">
      <?php 
      if($session->is_logged_in()) {
        include("../logged-in.php");
      }

      if(!$session->is_logged_in()) {
        include("../login.php");
      }
      ?>
      <main role="main" id="recipes-page">
        <h1>Recipes</h1>

        <section>
          <div>
            <section>
              <section id="filters">
                <h2>Filters</h2>
                <form>
                  <label for="meal-type">Type:</label><br>
                  <select id="meal-type" name="meal-type">
                    <option value="" selected disabled>All</option>
                    <?php foreach($mealTypes as $type): ?>
                      <option><?= h($type) ?></option>
                    <?php endforeach; ?>
                  </select><br>
                  <label for="style-type">Style:</label><br>
                  <select id="style-type" name="style-type">
                    <option value="" selected disabled>All</option>
                    <?php foreach($ethnicTypes as $type): ?>
                      <option><?= h($type) ?></option>
                    <?php endforeach; ?>
                  </select><br>
                  <label for="diet-type">Diet:</label><br>
                  <select id="diet-type" name="diet-type">
                    <option value="" selected disabled>All</option>
                    <?php foreach($dietTypes as $type): ?>
                      <option><?= h($type) ?></option>
                    <?php endforeach; ?>
                  </select>
                  <section>
                    <label for="newest">Newest:</label>
                    <input type="checkbox" id="newest" name="newest">
                  </section>
                  <section>
                    <label for="highest-rating">Highest Rating:</label>
                    <input type="checkbox" id="highest-rating" name="highest-rating">
                  </section>
                  <input type="submit" name="fliters" value="Apply Filters">
                </form>
              </section>
            </section>
            <section>
              <section>
                <h2>Become a member to post your recipe!</h2>
                <a href="../sign-up.php">Sign Up for Free Now</a>
              </section>
            </section>
          </div>
          <section id="recipes-grid">
            <?php foreach ($recipes as $recipe) : ?>
            <section class="recipe-card">
              <h3><?= h($recipe->recipeName); ?></h3>
              <img src="<?= h($recipe->get_recipe_photo()); ?>" alt="Recipe final product food image.">
              <p><?= h($recipe->recipeDescription); ?></p>
              <a href="./show.php?id=<?= $recipe->id; ?>">View Recipe</a>
            </section>
            <?php endforeach; ?>
          </section>
          <?php 
              if($pagination->total_pages() > 1) {
                echo "<section id=\"pagination\">";

                $url = url_for('/recipes/index.php');
                $searchString = isset($_GET['search-query']) ? "&search-query=" . urlencode($_GET['search-query']) : '';

                echo $pagination->previous_link("{$url}?page=" . ($pagination->currentPage - 1) . $searchString);

                echo "<section id=\"page-numbers\">";
                for($i=1; $i <= $pagination->total_pages(); $i++) {
                  $link = "{$url}?page={$i}{$searchString}";
                  
                  if ($i == $pagination->currentPage) {
                    echo "<span id=\"selected-link\">{$i}</span>";
                  } else {
                    echo "<a href=\"{$link}\">{$i}</a>";
                  }
                }
                echo "</section>";

                echo $pagination->next_link("{$url}?page=" . ($pagination->currentPage + 1) . $searchString);

                echo "</section>";
              }
            ?>
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
          <img src="../assets/icons/instagram.png" width="31" height="31" alt="The social media Instagram logo.">
          <img src="../assets/icons/x-social-media.png" width="31" height="31" alt="The social media X logo">
          <img src="../assets/icons/facebook.png" width="31" height="31" alt="The social media Facebook logo.">
        </section>
    </footer>
  </body>
  
</html>
