<?php 

require_once('../../private/initialize.php');
require_admin_or_super_admin();

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Manage Categories</title>
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
          <input type="text" name="search-query" placeholder="Search a recipe" value="<?php echo isset($_GET['search-query']) ? $escapedSearchQuery : ''; ?>">
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
        include("../logged-in.php");
      }

      if(!$session->is_logged_in()) {
        include("../login.php");
      }
      ?>
      <main role="main" id="manage-users">
        <h1>Manage Categories</h1>

        <a href="./new.php">Create Category</a>

        <h2>Meal Types</h2>
        <table>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>&nbsp;</th>
          </tr>
          <?php 
            Category::set_table('meal_types');
            $mealTypes = Category::find_all();
          ?>
          <?php foreach($mealTypes as $mealType) { ?>
            <tr>
              <td><?= $mealType->id; ?></td>
              <td><?= h($mealType->name); ?></td>
              <td><a class="action" href="<?= url_for('../public/categories/delete.php?category_type=meal_types&id=' . h(u($mealType->id))); ?>">Delete</a></td>
            </tr>
          <?php } ?>
        </table>

        <h2>Ethnic Types</h2>
        <table>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>&nbsp;</th>
          </tr>
          <?php 
            Category::set_table('ethnic_types');
            $ethnicTypes = Category::find_all();
          ?>
          <?php foreach($ethnicTypes as $ethnicType) { ?>
            <tr>
              <td><?= $ethnicType->id; ?></td>
              <td><?= h($ethnicType->name); ?></td>
              <td><a class="action" href="<?= url_for('../public/categories/delete.php?category_type=ethnic_types&id=' . h(u($ethnicType->id))); ?>">Delete</a></td>
            </tr>
          <?php } ?>
        </table>

        <h2>Diet Types</h2>
        <table>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>&nbsp;</th>
          </tr>
          <?php 
            Category::set_table('diet_types');
            $dietTypes = Category::find_all();
          ?>
          <?php foreach($dietTypes as $dietType) { ?>
            <tr>
              <td><?= $dietType->id; ?></td>
              <td><?= h($dietType->name); ?></td>
              <td><a class="action" href="<?= url_for('../public/categories/delete.php?category_type=diet_types&id=' . h(u($dietType->id))); ?>">Delete</a></td>
            </tr>
          <?php } ?>
        </table>
      </main>
    </div>

    <footer>
        <p>&copy; 2025 Grandma's Pantry. All Rights Reserved.</p>
        <nav>
          <ul>
            <li><a href="/web-289/public/index.php">Home</a></li>
            <li><a href="/web-289/recipes/index.php">Recipes</a></li>
            <li><a href="/web-289/public/about.html">About Us</a></li>
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
