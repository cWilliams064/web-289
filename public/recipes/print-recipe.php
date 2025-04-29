<?php 

require_once('../../private/initialize.php');

$recipeId = $_GET['id'] ?? null;

if (!is_numeric($recipeId)) {
  redirect_to($_SERVER['HTTP_REFERER'] ?? 'index.php');
}

/** @var Recipe $recipe */
$recipe = Recipe::find_by_id($recipeId);

$directions = Direction::find_directions($recipeId);
$ingredients = Ingredient::find_ingredients($recipeId);

if ($recipe) {
  $recipe->loadTimes();
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Recipes</title>
    <link href="../favicon.ico" rel="icon">
    <link href="../css/styles.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/3f0ab9bbdb.js" crossorigin="3f0ab9bbdb"></script>
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <script src="../js/app.js" defer></script>
  </head>

  <body>
    <main role="main" id="print-recipe-page">
      <a href="<?= $_SERVER['HTTP_REFERER']; ?>">&laquo; Back to recipe</a>

      <section>
        <h1><?= h($recipe->recipeName); ?></h1>
        <p><strong>Categories:</strong> 
          <?php
            $recipeTypes = Recipe::find_recipe_types_by_recipe_id($recipeId);

            $categories = [];

            if ($recipeTypes) {
              $mealTypes = $recipeTypes[0]->mealTypes;
              $ethnicTypes = $recipeTypes[0]->ethnicTypes;
              $dietTypes = $recipeTypes[0]->dietTypes;

              if (!empty($mealTypes)) {
                $categories = array_merge($categories, explode(',', $mealTypes));
              }
              if (!empty($ethnicTypes)) {
                $categories = array_merge($categories, explode(',', $ethnicTypes));
              }
              if (!empty($dietTypes)) {
                $categories = array_merge($categories, explode(',', $dietTypes));
              }
            }

            $categories = array_unique(array_map('trim', $categories));

            if (empty($categories)) {
              echo "No categories found";
            } else {
              echo implode(", ", $categories);
            }
          ?>
        </p>
        <section>
          <p>By: <?= $recipe->get_username(); ?></p>
          <div>
            <i class="fa-regular fa-star fa-xl"></i>
            <i class="fa-regular fa-star fa-xl"></i>
            <i class="fa-regular fa-star fa-xl"></i>
            <i class="fa-regular fa-star fa-xl"></i>
            <i class="fa-regular fa-star fa-xl"></i>
          </div>
          <?php $rating = $recipe->get_rating_info(); ?>
          <p><span><?= $rating['total']; ?> </span>Rating(s)</p>
        </section>
        <p><strong>Prep:</strong> <span class="recipe-times"><?= h($recipe->get_prep_time()); ?></span></p>
        <p><strong>Cook:</strong> <span class="recipe-times"><?= h($recipe->get_cook_time()); ?></span></p>
        <p>Servings: <?= h($recipe->servings)?></p>
        <p><?= $recipe->recipeDescription; ?></p>
      </section>
      <img src="<?= $recipe->get_recipe_photo(); ?>" alt="Photo of <?= h($recipe->recipeName); ?>">
      <section id="ingredients-directions">
        <table>
          <thead>
            <tr>
              <th>Ingredients</th>
              <th>Directions</th>
            </tr>
          </thead>
          <tbody>
            <td>
              <ul>
                <?php foreach ($ingredients as $ingredient) : ?>
                  <li>
                    <?php 
                      $formattedQuantity = $ingredient->formatted_quantity();
                      $ingredientName = strtolower($ingredient->ingredientName);

                      $unitName = ($ingredient->quantity != 1) ? $ingredient->unitName . 's' : $ingredient->unitName;

                      if ($ingredientName === 'egg' || $ingredientName === 'eggs') {
                        echo $formattedQuantity . ' ' . $ingredient->ingredientName;
                      } else {
                        echo $formattedQuantity . ' ' . $unitName . ' ' . $ingredient->ingredientName;
                      }
                    ?>
                  </li>
                <?php endforeach; ?>
              </ul>
            </td>
            <td>
              <ol>
                <?php foreach ($directions as $direction) : ?>
                  <li><?= h($direction->instruction); ?></li>
                <?php endforeach; ?>
              </ol>
            </td>
          </tbody>
        </table>
      </section>
    </main>
  </body>

</html>
