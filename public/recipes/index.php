<?php 

require_once('../../private/initialize.php');

$searchKeyword = $_GET['search'];
$escapedSearchQuery = $database->escape_string($searchKeyword);
$searchFailed = false;

if (!empty($searchKeyword)) {
  $totalCount = Recipe::count_filtered($_GET['search']);
} else {
  $totalCount = Recipe::count_all();
}

$currentPage = $_GET['page'] ?? 1;
$perPage = 12;
$pagination = new Pagination($currentPage, $perPage, $totalCount);

if (!empty($searchKeyword)) {
  $searchSql = "SELECT * FROM recipes ";
  $searchSql .= "WHERE recipe_name LIKE '%{$escapedSearchQuery}%' ";
  $searchSql .= "LIMIT {$perPage} OFFSET {$pagination->offset()}";

  $recipes = Recipe::find_by_sql($searchSql);

  if (empty($recipes)) {
    $fallbackSql = "SELECT * FROM recipes ";
    $fallbackSql .= "LIMIT {$perPage} OFFSET {$pagination->offset()}";
    $recipes = Recipe::find_by_sql($fallbackSql);
    $searchFailed = true;
    $searchKeyword = '';
  }
} else {
  $sql = "SELECT * FROM recipes ";
  $sql .= "LIMIT {$perPage} OFFSET {$pagination->offset()}";
  $recipes = Recipe::find_by_sql($sql);
}

$mealTypes = Category::get_all_names('meal_types');
$ethnicTypes = Category::get_all_names('ethnic_types');
$dietTypes = Category::get_all_names('diet_types');

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
        if ($session->is_logged_in()) {
          include("../logged-in.php");
        }

        if (!$session->is_logged_in()) {
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
                <form id="filter-form" method="GET">
                  <?php include('filter-form-fields.php'); ?>
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
          <?php if ($searchFailed) : ?>
            <div id="recipe-overlay">
              <section id="fail-search-popup">
                <p>No recipes found. Try a different search!</p>
                <button id="close-popup">
                  <img src="/web-289/public/assets/icons/x-icon.svg" width="14" height="14" alt="A X icon.">
                </button>
              </section>
            </div>
          <?php endif; ?>
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
              if ($pagination->total_pages() > 1) {
                echo "<section id=\"pagination\">";

                $url = url_for('/recipes/index.php');
                $searchString = isset($_GET['search']) ? "&search=" . urlencode($_GET['search']) : '';

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
