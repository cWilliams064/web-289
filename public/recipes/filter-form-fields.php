<label for="meal-type">Type:</label><br>
<select id="meal-type" name="meal-type">
  <option value="" selected>All</option>
  <?php foreach($mealTypes as $type): ?>
    <option value="<?= h($type); ?>" <?= ($_GET['meal_type'] ?? '') === $type ? 'selected' : ''; ?>>
      <?= h($type) ?>
    </option>
  <?php endforeach; ?>
</select><br>

<label for="ethnic-type">Style:</label><br>
<select id="ethnic-type" name="ethnic-type">
  <option value="" selected>All</option>
  <?php foreach($ethnicTypes as $type): ?>
    <option  value="<?= h($type); ?>" <?= ($_GET['ethnic_type'] ?? '') === $type ? 'selected' : ''; ?>>
      <?= h($type) ?>
    </option>
  <?php endforeach; ?>
</select><br>
                  
<label for="diet-type">Diet:</label><br>
<select id="diet-type" name="diet-type">
  <option value="" selected>All</option>
  <?php foreach($dietTypes as $type): ?>
    <option  value="<?= h($type); ?>" <?= ($_GET['diet_type'] ?? '') === $type ? 'selected' : ''; ?>>
      <?= h($type) ?>
    </option>
  <?php endforeach; ?>
</select>

<section>
  <label for="newest">Newest:</label>
  <input type="checkbox" id="newest" name="newest">
</section>
<section>
  <label for="highest-rating">Highest Rating:</label>
  <input type="checkbox" id="highest-rating" name="highest-rating">
</section>

<input type="submit" name="fliters" value="Apply Filters">