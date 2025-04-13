<?php

require_once('../../private/initialize.php');
require_admin_or_super_admin();

if(!isset($_GET['id'])) {
  redirect_to(url_for('./user/index.php'));
}

$id = $_GET['id'];
$viewUser = User::find_by_id($id);
if ($viewUser == false) {
  redirect_to(url_for('/index.php'));
}

if(is_post_request()) {
  $args = $_POST['user'];
  $viewUser->merge_attributes($args);
  $result = $viewUser->save();

  if($result === true) {
    redirect_to(url_for('./users/show.php?id=' . $id));
  } else {

  }

} 
else {
  
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Edit User</title>
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
      <main role="main" id="edit-user">
        <a class="back-link" href="<?php echo url_for('./users/index.php'); ?>">&laquo; Back to List</a>

        <h1>Edit User</h1>

          <form action="<?php echo url_for('./users/edit.php?id=' . h(u($id))); ?>" method="POST">
            <?php include('./form-fields.php'); ?>
            <input type="submit" id="edit-submit" value="Edit User">
          </form>
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
