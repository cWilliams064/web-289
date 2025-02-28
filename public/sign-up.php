<?php 

require_once('../private/initialize.php'); 

if(is_post_request()) {

  $args = $_POST['user'];
  $user = new User($args);
  $result = $user->save();

  if($result === true) {
    $new_id = $user->id;
    $session->login($user);
    $session->message('The user was created and logged in successfully.');
    redirect_to(url_for('index.php'));
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
    <title>Sign Up</title>
    <script src="js/app.js" defer></script>
    <link href=favicon.ico rel="icon">
    <link href="css/styles.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>

  <body>
    <header role="banner">
      <nav>
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="#">Recipes</a></li>
          <li><a href="about.html">About Us</a></li>
          <li><a href="#" id="open-sidebar">Log In</a></li>
          <li><a href="#" id="open-sidebar-icon"><img src="assets/login-image.png" width="27" height="27" alt="User icon that links to login."></a></li>
        </ul>
      </nav>
      <section>
        <input type="text" placeholder="Search a recipe">
        <img src="assets/icons/search.svg" width="64" height="64" alt="Magnifying glass search icon.">
      </section>
      <img src="assets/logo.png" width="500" height="500" alt="Pink and navy cupcake logo for Grandma's Pantry.">
    </header>

    <div id="wrapper">
      <?php include(PUBLIC_PATH . "/login.php") ?>
      <main role="main" id="signup-page">
        <h1>Sign Up</h1>

        <?php echo display_errors($user->errors); ?>

        <form action="sign-up.php" method="post">
          <?php include('users/form-fields.php') ?>
          <input type="submit" value="Sign up">
        </form>
        <p>Already have an account? <a href="login.php">Log in</a></p>
      </main>
    </div>
    
    <footer>
        <p>&copy; 2025 Grandma's Pantry. All Rights Reserved.</p>
        <nav>
          <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="recipes/index.php">Recipes</a></li>
            <li><a href="about.html">About Us</a></li>
          </ul>
        </nav>
        <section>
          <img src="assets/icons/instagram.png" width="31" height="31" alt="The social media Instagram logo.">
          <img src="assets/icons/x-social-media.png" width="31" height="31" alt="The social media X logo">
          <img src="assets/icons/facebook.png" width="31" height="31" alt="The social media Facebook logo.">
        </section>
    </footer>
  </body>

</html>
