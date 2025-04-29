<?php

require_once('../../private/initialize.php');

$user = $session->get_user();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $recipeId = $_POST['recipe_id'] ?? null;

  if ($recipeId && is_numeric($recipeId) && $user) {
    $userId = $user->id ?? null;

    if (SaveRecipe::is_recipe_saved($userId, $recipeId)) {
      echo 'already_saved';
    } else {
      $saveRecipe = new SaveRecipe();
      $saveRecipe->recipeId = $recipeId;
      $saveRecipe->userId = $userId;

      if ($saveRecipe->save()) {
        echo 'success';
      } else {
        echo 'error';
      }
    }
  } else {
    echo 'error';
  }
} else {
  echo 'error';
}
