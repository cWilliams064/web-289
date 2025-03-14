<?php

require_once(dirname(__DIR__) . '/private/initialize.php');

$errors = [];
$username = '';
$password = '';

if(is_post_request()) {
  $username = $_POST['username'] ?? '';
  $password = $_POST['password'] ?? '';

  if (is_post_request()) {
    $user = new User(['username' => $username, 'password' => $password]);
    $errors = $user->validate_login();

    if (empty($errors)) {
        $foundUser = User::find_by_username($username);
        $session->login($foundUser);
        redirect_to(url_for('./index.php'));
    }
  }
}

?>

<div id="sidebar">
  <div id="login">
    <button id="close-sidebar" aria-label="Close Sidebar"><img src="/web-289/public/assets/icons/x-icon.svg" width="14" height="14" alt="A X icon."></button>
    <h2>Login</h2>
    <form action="index.php" method="POST">
      <section>
        <label for="login-username">Username:</label><br>
        <input type="text" id="login-username" class="<?= isset($errors['username']) ? 'error-input' : ''; ?>" name="username" value="<?= $username ?>" required><br>
        <?php if (!empty($errors['username'])): ?>
          <?= '<p class="user-errors">' . $errors['username'] . '</p>'; ?>
        <?php endif; ?>
      </section>
      <section>
        <label for="login-password" id="password-label">Password:</label><br>
        <input type="password" id="login-password" class="<?= isset($errors['password']) ? 'error-input' : ''; ?>" name="password" required><br>
        <?php if (!empty($errors['password'])): ?>
          <?= '<p class="user-errors">' . $errors['password'] . '</p>'; ?>
        <?php endif; ?>
      </section>
      <input type="submit" name="submit" value="Login">
    </form>
    <a href="sign-up.php">Sign Up</a>
  </div>
</div>