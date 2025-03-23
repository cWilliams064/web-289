<?php

require_once(dirname(__DIR__) . '/private/initialize.php');

$username = '';
$password = '';

if(is_post_request() && isset($_POST['login'])) {
  $username = $_POST['username'] ?? '';
  $password = $_POST['password'] ?? '';

  $user = new User(['username' => $username, 'password' => $password]);
  $loginErrors = $user->validate_login();

  if (empty($loginErrors)) {
    $foundUser = User::find_by_username($username);
    $session->login($foundUser);
    $_SESSION['sidebar_open'] = true;
    redirect_to(url_for('./index.php'));
  }
}

?>

<div id="sidebar">
  <div id="login">
    <button id="close-sidebar" aria-label="Close Sidebar"><img src="/web-289/public/assets/icons/x-icon.svg" width="14" height="14" alt="A X icon."></button>
    <h2>Login</h2>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
      <section>
        <label for="login-username">Username:</label><br>
        <input type="text" id="login-username" class="<?= isset($LoginErrors['username']) ? 'error-input' : ''; ?>" name="username" value="<?= $username ?>" required><br>
        <?php if (!empty($LoginErrors['username'])): ?>
          <?= '<p class="user-errors">' . $LoginErrors['username'] . '</p>'; ?>
        <?php endif; ?>
      </section>
      <section>
        <label for="login-password" id="password-label">Password:</label><br>
        <input type="password" id="login-password" class="<?= isset($LoginErrors['password']) ? 'error-input' : ''; ?>" name="password" required><br>
        <?php if (!empty($LoginErrors['password'])): ?>
          <?= '<p class="user-errors">' . $LoginErrors['password'] . '</p>'; ?>
        <?php endif; ?>
      </section>
      <input type="submit" name="login" value="Login">
    </form>
    <a href="/web-289/public/sign-up.php">Sign Up</a>
  </div>
</div>