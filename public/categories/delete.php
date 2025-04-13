<?php 

require_once('../../private/initialize.php');
require_admin_or_super_admin();

if(!isset($_GET['id'])) {
  redirect_to(url_for('../public/categories/index.php'));
}

$id = $_GET['id'];
$category_type = $_GET['category_type'];

Category::set_table($category_type);

$category = Category::find_category_by_id($id);

if (!isset($category)) {
    redirect_to(url_for('../public/categories/index.php'));
}

if (is_post_request()) {
    $result = $category->delete();
    $session->message('The category was deleted successfully.');
    redirect_to(url_for('../public/categories/index.php'));
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Delete Category</title>
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
      <main role="main" id="delete-category">
        <a class="back-link" href="<?php echo url_for('../public/categories/index.php'); ?>">&laquo; Back to List</a>

        <h1>Delete Category</h1>
        
        <p>Are you sure you want to delete the category: </p>
        <p class="item"><?php echo h($category->name); ?></p>

        <form action="<?php echo url_for('../public/categories/delete.php?category_type=' . h(u($category->category_type)) . '&id=' . h(u($category->id))); ?>" method="post">
          <input type="submit" name="commit" value="Delete Category">
        </form>
      </main>
    </div>
    
    <footer>
        <p>&copy; 2025 Grandma's Pantry. All Rights Reserved.</p>
        <nav>
          <ul>
            <li><a href="/web-289/public/index.php">Home</a></li>
            <li><a href="../recipes/index.php">Recipes</a></li>
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
