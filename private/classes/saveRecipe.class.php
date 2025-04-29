<?php

class SaveRecipe extends DatabaseObject {
  static protected $table_name = "saved_recipes";
  static protected $db_columns = ['saved_recipe_id', 'user_id', 'recipe_id'];

  public $id;
  public $userId;
  public $recipeId;

  public function __construct($args = []) {
    $this->id = $args['saved_recipe_id'] ?? null;
    $this->userId = $args['user_id'] ?? null;
    $this->recipeId = $args['recipe_id'] ?? null;
  }

  public static function is_recipe_saved($userId, $recipeId) {
    $sql = "SELECT * FROM saved_recipes WHERE user_id = {$userId} AND recipe_id = {$recipeId}";
    $result = static::find_by_sql($sql);

    return !empty($result);
  }
}
