<?php 

$mealTypesNames = Category::get_all_names('meal_types');
$ethnicTypesNames = Category::get_all_names('ethnic_types');
$dietTypesNames = Category::get_all_names('diet_types'); 

?>

<label for="meal-type">Type:</label><br>
<select id="meal-type" name="meal_type[]" multiple>
  <option value="all">All</option>
  <?php foreach($mealTypesNames as $typeName): ?>
    <option value="<?= h($typeName->id); ?>" <?= in_array($typeName->id, $_GET['meal_type'] ?? []) ? 'selected' : ''; ?>>
      <?= h($typeName->name) ?>
    </option>
  <?php endforeach; ?>
</select><br>

<label for="ethnic-type">Style:</label><br>
<select id="ethnic-type" name="ethnic_type[]" multiple>
  <option value="all">All</option>
  <?php foreach($ethnicTypesNames as $typeName): ?>
    <option  value="<?= h($typeName->id); ?>" <?= in_array($typeName->id, $_GET['ethnic_type'] ?? []) ? 'selected' : ''; ?>>
      <?= h($typeName->name) ?>
    </option>
  <?php endforeach; ?>
</select><br>
                  
<label for="diet-type">Diet:</label><br>
<select id="diet-type" name="diet_type[]"multiple>
  <option value="all">All</option>
  <?php foreach($dietTypesNames as $typeName): ?>
    <option  value="<?= h($typeName->id); ?>" <?= in_array($typeName->id, $_GET['diet_type'] ?? []) ? 'selected' : ''; ?>>
      <?= h($typeName->name) ?>
    </option>
  <?php endforeach; ?>
</select>

<section>
  <label for="newest">Newest:</label>
  <input type="checkbox" id="newest" name="newest" <?= isset($_GET['newest']) ? 'checked' : ''; ?>>
</section>
<section>
  <label for="highest-rating">Highest Rating:</label>
  <input type="checkbox" id="highest-rating" name="highest-rating" <?= isset($_GET['highest-rating']) ? 'checked' : ''; ?>>
</section>

<input type="submit" name="filters" value="Apply Filters">