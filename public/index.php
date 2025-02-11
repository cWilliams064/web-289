<?php 

require_once('../private/initialize.php'); 
$recipes = Recipe::find_all();

?>

<div id='content'>
    <h1>Recipes</h1>

    <table class="list" border="1">
    <tr>
        <th>Recipe Name</th>
        <th>Recipe Description</th>
        <th>Servings</th>
        <th>Created At</th>
    </tr>
    <?php foreach($recipes as $recipe) { ?>
    <tr>
        <td><?= h($recipe->recipeName); ?></td>
        <td><?= h($recipe->recipeDescription); ?></td>
        <td><?= h($recipe->servings); ?></td>
        <td><?= h($recipe->createdAt); ?></td>
    <?php } ?>
    </table>
</div>