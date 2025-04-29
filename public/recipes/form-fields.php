<section>
  <label for="recipe-name">Recipe Name<span>*</span></label><br>
  <input type="text" id="recipe-name" name="recipe[recipe_name]" value="<?php echo isset($_POST['recipe-name']) ? htmlspecialchars($_POST['recipe-name']) : ''; ?>" required>
</section>

<section>
  <label for="recipe-description">Recipe Description (max 255 characters)<span>*</span></label><br>
  <input type="text" id="recipe-description" name="recipe[recipe_description]" maxlength="255" value="<?php echo isset($_POST['recipe-description']) ? htmlspecialchars($_POST['recipe-description']) : ''; ?>" required>
</section>

<section>
  <label for="recipe-servings">Number of Servings<span>*</span></label><br>
  <input type="number" id="recipe-servings" name="recipe[servings]" value="<?php echo isset($_POST['recipe-servings']) ? (int)$_POST['recipe-servings'] : ''; ?>" required>
</section>

<p>You can enter 0 or leave the field empty if no time is needed.</p>

<section class="times">
  <label>Prep Time</label>
  <div>
    <section class="create-time">
      <input type="number" id="prep-time-hours" name="recipe[prep_time_hours]" min="0" value="<?php echo isset($_POST['prep_time_hours']) ? (int)$_POST['prep_time_hours'] : ''; ?>" placeholder="0">
      <span>hours</span>
    </section>
    <section class="create-time">
      <input type="number" id="prep-time-minutes" name="recipe[prep_time_minutes]" min="0" value="<?php echo isset($_POST['prep_time_minutes']) ? (int)$_POST['prep_time_minutes'] : ''; ?>" placeholder="0">
      <span>minutes</span>
    </section>
  </div>
</section>

<section class="times">
  <label>Cook Time</label>
  <section>
    <section class="create-time">
      <input type="number" id="cook-time-hours" name="recipe[cook_time_hours]" min="0" value="<?php echo isset($_POST['cook_time_hours']) ? (int)$_POST['cook_time_hours'] : ''; ?>" placeholder="0">
      <span>hours</span>
    </section>
    <section class="create-time">
      <input type="number" id="cook-time-minutes" name="recipe[cook_time_minutes]" min="0" value="<?php echo isset($_POST['cook_time_minutes']) ? (int)$_POST['cook_time_minutes'] : ''; ?>" placeholder="0">
      <span>minutes</span>
    </section>
  </section>
</section>

<section>
  <label>Ingredients<span>*</span></label><br>
  <ul id="ingredients-container">
    <li>
      <span class="custom-marker"><i class="fas fa-circle fa-2xs"></i></span>
      <input type="text" name="recipe[ingredient_name][]" placeholder="Ingredient Name" required>
      <input type="number" name="recipe[ingredient_quantity][]" min="0.01" step="0.01" placeholder="Quantity" required>
      <select name="recipe[ingredient_unit][]" required>
        <option value="" disabled selected>Select Unit</option>
        <?php foreach ($units as $unit): ?>
          <option value="<?php echo h($unit); ?>"><?php echo h($unit); ?></option>
        <?php endforeach; ?>
      </select>
      </li>
    </ul>
    <button type="button" id="add-ingredient-btn" class="add-btn" aria-label="Add ingredient">
      <i class="fas fa-plus"></i> Add Ingredient
    </button>
</section>

<section>
  <label for="directions">Directions<span>*</span></label><br>
  <ol id="directions-container">
    <li>
      <span class="custom-marker">1.</span>
      <input type="text" id="directions" name="recipe[directions][]" required></input>
    </li>
  </ol>
  <button type="button" id="add-direction-btn" class="add-btn" aria-label="Add direction">
    <i class="fas fa-plus"></i> Add Direction
  </button>
</section>

<section>
  <label>Categories</label>
  <section class="category-options">
    <label>Meal Types:</label>
    <section>
      <?php foreach ($meal_types as $meal_type): ?>
        <label>
          <input type="checkbox" name="recipe[meal_types][]" value="<?php echo h($meal_type->id); ?>">
          <?php echo h($meal_type->name); ?>
        </label>
      <?php endforeach; ?>
    </section>
  </section>
</section>

<section class="category-options">
  <label>Ethnic Types:</label>
  <section>
    <?php foreach ($ethnic_types as $ethnic_type): ?>
      <label>
        <input type="checkbox" name="recipe[ethnic_types][]" value="<?php echo h($ethnic_type->id); ?>">
        <?php echo h($ethnic_type->name); ?>
      </label>
    <?php endforeach; ?>
  </section>
</section>

<section class="category-options">
  <label>Diet Types:</label>
   <section>
    <?php foreach ($diet_types as $diet_type): ?>
      <label>
        <input type="checkbox" name="recipe[diet_types][]" value="<?php echo h($diet_type->id); ?>">
        <?php echo h($diet_type->name); ?>
      </label>
    <?php endforeach; ?>
    </section>
  </section>
</section>

<section>
  <label for="recipe-photo">Upload Recipe Photo:</label><br>
  <input type="file" id="recipe-photo" name="recipe-photo" accept="image/*">
</section>

<section>
  <label for="youtube-link">YouTube Recipe Video Link:</label><br>
  <p>Please ensure that the YouTube video link you provide is for a video licensed under Creative Commons.</p>
  <input type="url" id="youtube-link" name="recipe[youtube_link]">
</section>
