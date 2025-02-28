<?php

require_once('../private/initialize.php');

$errors = [];
$username = '';
$password = '';

if(is_post_request()) {

  $username = $_POST['username'] ?? '';
  $password = $_POST['password'] ?? '';

  if(is_blank($username)) {
    $errors[] = "Username cannot be blank.";
  }
  if(is_blank($password)) {
    $errors[] = "Password cannot be blank.";
  }

  if(empty($errors)) {
    $user = User::find_by_username($username);

    if($user != false && $user->verify_password($password)) {
      $session->login($user);
      redirect_to(url_for('/index.php'));
    } 
    else {
      $errors[] = "Log in was unsuccessful.";
    }

  }

}

?>

<div id="sidebar">
  <button id="close-sidebar" aria-label="Close Sidebar"><img src="assets/icons/x-icon.svg" width="14" height="14" alt="A X icon."></button>

  <h2>Login</h2>
  <?php echo display_errors($errors) ?>
  <form action="index.php" method="post">
    <label for="login-username" value="<?php echo h($username); ?>">Username:</label><br>
    <input type="text" id="login-username" name="login-username" required><br>

    <label for="login-password">Password:</label><br>
    <input type="password" id="login-password" name="login-password" required><br>
    
    <input type="submit" name="submit" value="Login">
  </form>
  <a href="sign-up.php">Sign Up</a>
</div>