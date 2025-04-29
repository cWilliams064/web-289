<?php

class CookTime extends RecipeTime {
  protected static $table_name = 'cook_times';
  protected static $db_fields = ['cook_time_id', 'recipe_id', 'time_seconds'];

  public $id;
  public $recipeId;
  public $timeSeconds;

  public function __construct($args=[]) {
    $this->recipeId = $args['recipe_id'] ?? '';
    $this->timeSeconds =  $args['time_seconds'] ?? '';
  }

  public static function find_by_recipe_id($recipeId) {
    $recipeId = (int) $recipeId; 
    $sql = "SELECT * FROM " . self::$table_name . " WHERE recipe_id = {$recipeId}";

    $result = self::find_by_sql($sql);

    return !empty($result) ? array_shift($result) : false;
}

}
