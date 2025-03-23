<?php 

require_once('../../private/initialize.php');

require_admin_or_super_admin();

if(is_post_request()) {
  $args = $_POST['user'];
  $user = new User($args);
  $errors = $user->validate();
  $result = $user->save();

  if($result === true) {
    $new_id = $user->id;
    redirect_to(url_for('../public/users/index.php'));
  } 
  else {

  }
} 
else {
  $user = new User;
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Create User</title>
    <script src="../js/app.js" defer></script>
    <link href="../favicon.ico" rel="icon">
    <link href="../css/styles.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>

  <body>
    <header role="banner">
      <nav>
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="../recipes/index.php">Recipes</a></li>
          <li><a href="../about.php">About Us</a></li>
          <li><a href="#" id="open-sidebar">Log In</a></li>
          <li><a href="#" id="open-sidebar-icon"><img src="../assets/login-image.png" width="27" height="27" alt="User icon that links to login."></a></li>
        </ul>
      </nav>
      <form>
        <input type="text" placeholder="Search a recipe">
        <button><img src="../public/assets/icons/search.svg" width="64" height="64" alt="Magnifying glass submit icon."></button>
      </form>
      <img src="../assets/logo.png" width="500" height="500" alt="Pink and navy cupcake logo for Grandma's Pantry.">
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
      <main role="main" id="create-user">
        <a class="back-link" href="../users/index.php">&laquo; Back to List</a>

        <h1>Create User</h1>

        <form action="new.php" method="POST">
          <section>
            <p>*</p>
            <p>= required</p>
          </section>
          <?php include('../users/form-fields.php') ?>
          <input type="submit" value="Create User">
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
