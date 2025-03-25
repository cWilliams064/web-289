<?php 

require_once('../../private/initialize.php');

$currentPage = $_GET['page'] ?? 1;
$searchQuery = $_GET['search-query'] ?? '';
$perPage = 12;
$totalCount = Recipe::count_all();

if ($searchQuery) {
  $sql = "SELECT COUNT(*) FROM recipes WHERE recipe_name LIKE '%{$searchQuery}%'";
  $totalCount = Recipe::count_all($sql);
} else {
  $totalCount = Recipe::count_all();
}

$pagination = new Pagination($currentPage, $perPage, $totalCount);


if ($searchQuery) {
  $sql = "SELECT * FROM recipes WHERE recipe_name ";
  $sql .= "LIKE '%{$searchQuery}%' LIMIT {$perPage} ";
  $sql .= "OFFSET {$pagination->offset()}"; 
} else {
  $sql = "SELECT * FROM recipes ";
  $sql .= "LIMIT {$perPage} OFFSET {$pagination->offset()}";
}

$recipes = Recipe::find_by_sql($sql);

if (isset($_GET['search-query'])) {
  $sql = "SELECT * FROM recipes ";
  $sql .= "WHERE recipe_name LIKE '%{$searchQuery}%' ";
  $sql .= "LIMIT {$perPage} OFFSET {$pagination->offset()}";

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
          <li><a href="../index.php">Home</a></li>
          <li><a href="./index.php">Recipes</a></li>
          <li><a href="../about.php">About Us</a></li>
          <li><a href="#" id="open-sidebar"><?php echo !$session->is_logged_in() ? 'Log In' : 'View Profile'; ?></a></li>
          <li><a href="#" id="open-sidebar-icon"><img src="../assets/login-image.png" width="27" height="27" alt="User icon that links to login."></a></li>
        </ul>
      </nav>
      <form action="index.php" method="GET">
        <input type="text" name="search-query" value="<?= h($searchQuery); ?>" placeholder="Search a recipe">
        <button><img src="../assets/icons/search.svg" width="64" height="64" alt="Magnifying glass submit icon."></button>
      </form>
      <a href=""><img src="../assets/logo.png" width="500" height="500" alt="Pink and navy cupcake logo for Grandma's Pantry."></a>
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
          <section>
            <section>
              <h2>Filters</h2>
              <form>
              </form>
            </section>
          </section>
          <section>
            <section>
              <p>Become a member to post your recipe!</p>
              <a href="../sign-up.php">Sign Up for Free Now</a>
            </section>
          </section>
          <section id="recipes-grid">
            <?php foreach ($recipes as $recipe) : ?>
            <section class="recipe-card">
              <h3><?= h($recipe->recipeName); ?></h3>
              <img src="<?= h(url_for($recipe->get_recipe_photo())); ?>" alt="<?= h($recipe->recipeName); ?>">
              <div id="card-details">
                <p>Serving Size: <?= h($recipe->servings); ?></p>
                <a href="./show.php?id=<?= $recipe->id; ?>">View Recipe</a>
            </div>
            </section>
            <?php endforeach; ?>
            <?php 
              if($pagination->total_pages() > 1) {
                echo "<section id=\"pagination\">";
                
                echo $pagination->previous_link($url);

                echo "<section id=\"page-numbers\">";
                for($i=1; $i <= $pagination->total_pages(); $i++) {
                  if($i == $pagination->currentPage) {
                    echo "<span id=\"selected-link\">{$i}</span>";
                  } else {
                    echo "<a href=\"{$url}?page={$i}\">{$i}</a>";
                  }
                }
                echo "</section>";

                echo $pagination->next_link($url);

                echo "</section>";
              }
            ?>
          </section>
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
