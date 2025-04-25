<?php 

require_once('../../private/initialize.php');

$searchKeyword = $_GET['search'] ?? '';
$selectedMealTypes = $_GET['meal_type'] ?? [];
$selectedEthnicTypes = $_GET['ethnic_type'] ?? [];
$selectedDietTypes = $_GET['diet_type'] ?? [];

$sortOptions = [];

if (isset($_GET['newest'])) {
  $sortOptions[] = 'newest';
}

if (isset($_GET['highest-rating'])) {
  $sortOptions[] = 'highest-rating';
}

$escapedSearchQuery = $database->escape_string($searchKeyword);
$searchFailed = false;

$newest = isset($_GET['newest']);
$highestRating = isset($_GET['highest-rating']);

if (empty($_GET['search']) && empty($selectedMealTypes) && empty($selectedEthnicTypes) && empty($selectedDietTypes)) {
  $totalCount= Recipe::count_all();
} else {
  $totalCount = Recipe::count_by_filters(
    $searchKeyword,
    $selectedMealTypes,
    $selectedEthnicTypes,
    $selectedDietTypes
  );
}

$currentPage = $_GET['page'] ?? 1;
$perPage = 12;

$pagination = new Pagination($currentPage, $perPage, $totalCount);

if ($recipe) {
  $recipe->loadTimes();
}

$recipes = Recipe::find_by_filters(
  $searchKeyword,
  $perPage,
  $pagination->offset(),
  $selectedMealTypes,
  $selectedEthnicTypes,
  $selectedDietTypes,
  $sortOptions
);

if (empty($recipes)) {
  $fallbackSql = "SELECT * FROM recipes ";
  $fallbackSql .= "LIMIT {$perPage} OFFSET {$pagination->offset()}";
  $recipes = Recipe::find_by_sql($fallbackSql);
  $searchFailed = true;
  $searchKeyword = '';
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
      <main role="main" id="recipes-page">
        <h1>Recipes</h1>

        <section>
          <div>
            <section>
              <section id="filters">
                <h2>Filters</h2>
                <form action="" id="filter-form" method="GET">
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
                <p>No recipes found. Try a different search or filter!</p>
                <button id="close-popup">
                  <img src="/web-289/public/assets/icons/x-icon.svg" width="14" height="14" alt="A X icon.">
                </button>
              </section>
            </div>
          <?php endif; ?>
          <section id="recipes-grid">
            <?php foreach ($recipes as $recipe) : ?>
              <?php $rating = $recipe->get_rating_info(); ?>
              <section class="recipe-card">
                <h3><?= h($recipe->recipeName); ?></h3>
                <img src="<?= $recipe->get_recipe_photo(); ?>" alt="Photo of <?= h($recipe->recipeName); ?>">
                <section>
                  <div>
                    <p>Prep: <span class="recipe-times"><?= h($recipe->get_prep_time()); ?></span></p>
                  </div>
                  <div>
                    <p>Cook: <span class="recipe-times"><?= h($recipe->get_cook_time()); ?></span></p>
                  </div>
                  <p><span><?= $rating['average']; ?>/5</span> Star(s)</p>
                  <p><span><?= $rating['total']; ?> </span>Rating(s)</p>
                </section>
                <section>
                  <div>
                    <i class="fa-regular fa-star fa-xl"></i>
                    <i class="fa-regular fa-star fa-xl"></i>
                    <i class="fa-regular fa-star fa-xl"></i>
                    <i class="fa-regular fa-star fa-xl"></i>
                    <i class="fa-regular fa-star fa-xl"></i>
                  </div>
                  <a href="./show.php?id=<?= $recipe->id; ?>">View Recipe</a>
                </section>
              </section>
            <?php endforeach; ?>
          </section>
          <?php 
            if ($pagination->total_pages() > 1) {
              echo "<section id=\"pagination\">";

              $url = url_for('/recipes/index.php');
              $queryParams = [];

              if (!empty($_GET['search'])) {
                $queryParams['search'] = $_GET['search'];
              }

              foreach (['meal_type', 'ethnic_type', 'diet_type'] as $filterName) {
                if (!empty($_GET[$filterName])) {
                  foreach ($_GET[$filterName] as $value) {
                    $queryParams[$filterName . '[]'][] = $value;
                  }
                }
              }

              if (isset($_GET['newest'])) {
                $queryParams['newest'] = 'on';
              }

              if (isset($_GET['highest-rating'])) {
                $queryParams['highest-rating'] = 'on';
              }

              $filterQueryString = http_build_query($queryParams);

              echo $pagination->previous_link("{$url}?page=" . ($pagination->currentPage - 1) . "&" . $filterQueryString);

              echo "<section id=\"page-numbers\">";
              for($i=1; $i <= $pagination->total_pages(); $i++) {
                if ($i == $pagination->currentPage) {
                  echo "<span id=\"selected-link\">{$i}</span>";
                } else {
                  echo "<a href=\"{$url}?page={$i}&{$filterQueryString}\">{$i}</a>";
                }
              }
              echo "</section>";

              echo $pagination->next_link("{$url}?page=" . ($pagination->currentPage + 1) . "&" . $filterQueryString);

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
          <a href="https://www.instagram.com/"><i class="fa-brands fa-instagram fa-xl"></i></a>
          <a href="https://x.com/?lang=en"><i class="fa-brands fa-x-twitter fa-xl"></i></a>
          <a href="https://www.facebook.com/"><i class="fa-brands fa-facebook fa-xl"></i></a>
        </section>
    </footer>
  </body>
  
</html>
