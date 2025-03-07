<?php

require_once(dirname(__DIR__) . '/private/initialize.php');
require_login();

?>

<div id="sidebar">

  <div id="logged-in">
    <?php
    $scriptPath = $_SERVER['SCRIPT_NAME'];
    if (strpos($scriptPath, '/users/') !== false) {
      $closeIconPath = '../assets/icons/x-icon.svg';
      $logoutPath = '../logout.php';
    }
    else {
      $closeIconPath = '../public/assets/icons/x-icon.svg';
      $logoutPath = '../public/logout.php';
    }
    ?>

    <button id="close-sidebar" aria-label="Close Sidebar"><img src="<?= $closeIconPath ?>" width="14" height="14" alt="A X icon."></button>

    <?php
      $user = $session->get_user();
      if ($user) {
        echo "<h2 id='user-login'>Welcome,<br>" . $user->full_name() . "!</h2>";
      }
      else {
        echo "<h2>User not found.</h2>";
      }
    ?>

    <section>
      <p>Username: <?= $user->username; ?></p>
      <p>Email: <?= $user->email; ?></p>
    </section>

    <a href="<?= $logoutPath ?>">Logout</a>
    <a href="#">My Recipes</a>
    <a href="#">Post Recipe</a>
    <a href="../public/users/index.php">Manage Users</a>
    <a href="#">Manage Categories</a>
  </div>
</div>