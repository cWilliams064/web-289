<?php

require_once(dirname(__DIR__) . '/private/initialize.php');

$username = '';
$password = '';
$loginErrors = [];

if(is_post_request() && isset($_POST['login'])) {
  $username = $_POST['username'] ?? '';
  $password = $_POST['password'] ?? '';
  
  if (is_blank($username)) {
    $loginErrors['username'] = "Username cannot be blank!";
  } else {
    $user = User::find_by_username($username);
    if (!$user) {
      $loginErrors['username'] = "Invalid username!";
    }
  }

  if (is_blank($password)) {
    $loginErrors['password'] = "Password cannot be blank!";
  } elseif (!isset($loginErrors['username']) && !$user->verify_password($password)) {
    $loginErrors['password'] = "Invalid password!";
  }

  if (empty($loginErrors)) {
    if($user->verify_password($password)) {
      $session->login($user);

      $current_page = basename($_SERVER['PHP_SELF']);
      redirect_to(url_for($current_page));
    }
  }
}

?>

<div id="sidebar" class="<?php if (!empty($loginErrors)) {echo 'active';} ?>">
  <div id="login">
    <button id="close-sidebar" aria-label="Close Sidebar"><img src="/web-289/public/assets/icons/x-icon.svg" width="14" height="14" alt="A X icon."></button>
    <h2>Login</h2>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
      <section>
        <label for="login-username">Username:</label><br>
        <input type="text" id="login-username" class="<?= isset($loginErrors['username']) ? 'error-input' : ''; ?>" name="username" value="<?= $username ?>" required><br>
        <?php if (!empty($loginErrors['username'])): ?>
          <?= '<p class="user-errors">' . $loginErrors['username'] . '</p>'; ?>
        <?php endif; ?>
      </section>
      <section>
        <label for="login-password" id="password-label">Password:</label><br>
        <input type="password" id="login-password" class="<?= isset($loginErrors['password']) ? 'error-input' : ''; ?>" name="password" required><br>
        <?php if (!empty($loginErrors['password'])): ?>
          <?= '<p class="user-errors">' . $loginErrors['password'] . '</p>'; ?>
        <?php endif; ?>
      </section>
      <input type="submit" name="login" value="Login">
    </form>
    <a href="/web-289/public/sign-up.php">Sign Up</a>
  </div>
</div>