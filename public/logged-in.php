<?php

require_once(dirname(__DIR__) . '/private/initialize.php');
require_login();

?>

<div id="sidebar" class="<?= ($session->is_logged_in()) ? 'active' : ''; ?>" data-initial="<?= $session->is_logged_in() ? 'true' : 'false'; ?>">
  <div id="logged-in">
    <button id="close-sidebar" aria-label="Close Sidebar"><img src="/web-289/public/assets/icons/x-icon.svg" width="14" height="14" alt="A X icon."></button>

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

    <a href="/web-289/public/logout.php">Logout</a>
    <a href="/web-289/public/users/user-recipes.php">My Recipes</a>
    <a href="/web-289/public/recipes/new.php">Post Recipe</a>
    <?php if($session->is_super_admin_or_admin()): ?>
    <a href="/web-289/public/users/index.php">Manage Users</a>
    <a href="/web-289/public/categories/index.php">Manage Categories</a>
    <?php endif; ?>
  </div>
</div>