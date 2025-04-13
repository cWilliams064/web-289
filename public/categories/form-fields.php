<label for="category-name">Category Name <span>*</span></label><br>
<input type="text" id="category-name" class="<?= isset($categoryErrors['name']) ? 'error-input' : ''; ?>" name="category[name]" <?php if (isset($category) && isset($category->name)) echo 'value="' . h($category->name) . '"'; ?> required><br>

<?php if (!empty($categoryErrors['name'])): ?>
  <?= '<p class="create-errors">' . $categoryErrors['name'] . '</p>'; ?>
<?php endif; ?>

<label for="category-type">Category Type:</label><br>
<select id="category-type"  class="<?= isset($categoryErrors['name']) ? 'error-input' : ''; ?>" name="category[category_type]">
  <option value="" disabled selected>Choose category type</option>
  <option value="meal_types" <?php if (isset($category) && $category->category_type == 'meal_types') { echo 'selected'; } ?>>Meal Type</option>
  <option value="ethnic_types" <?php if (isset($category) && $category->category_type == 'ethnic_types') { echo 'selected'; } ?>>Ethnic Type</option>
  <option value="diet_types" <?php if (isset($category) && $category->category_type == 'diet_types') { echo 'selected'; } ?>>Diet Type</option>
</select><br>

<?php if (!empty($categoryErrors['category_type'])): ?>
  <?= '<p class="create-errors">' . $categoryErrors['category_type'] . '</p>'; ?>
<?php endif; ?>