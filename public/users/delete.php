<?php

require_once('../../private/initialize.php');
require_admin_or_super_admin();

if(!isset($_GET['id'])) {
  redirect_to(url_for('../public/users/index.php'));
}

$id = $_GET['id'];
$viewUser = User::find_by_id($id);

if($viewUser == false) {
  redirect_to(url_for('../public/users/index.php'));
}

if(is_post_request()) {
  $result = $viewUser->delete();
  $session->message('The user was deleted successfully.');
  redirect_to(url_for('../public/users/index.php'));
} 
else {
  
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
        include("../logged-in.php");
      }

      if(!$session->is_logged_in()) {
        include("../login.php");
      }
      ?>
      <main role="main" id="delete-user-page">
        <div id="delete-user">
          <a class="back-link" href="<?php echo url_for('../public/users/index.php'); ?>">&laquo; Back to List</a>

          <h1>Delete Admin</h1>
          <p>Are you sure you want to delete this user?</p>
          <p class="item"><?php echo h($viewUser->full_name()); ?></p>

          <form action="<?php echo url_for('./users/delete.php?id=' . h(u($id))); ?>" method="post">
            <input type="submit" name="commit" value="Delete User">
          </form>
        </div>
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
