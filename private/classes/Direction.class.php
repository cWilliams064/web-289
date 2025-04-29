<?php 

class Direction extends DatabaseObject {
  static protected $table_name = 'directions';
  static protected $db_columns = ['direction_id', 'recipe_id', 'step_number', 'instruction'];

  public $id;
  public $recipeId;
  public $stepNumber;
  public $instruction;

  public function __construct($args = []) {
    $this->id = $args['direction_id'] ?? NULL;
    $this->recipeId = $args['recipe_id'] ?? null;
    $this->stepNumber = $args['step_number'] ?? 0;
    $this->instruction = $args['instruction'] ?? '';
  }

  public static function find_directions($recipeId) {
    $sql = "SELECT * FROM " . static::$table_name;
    $sql .= " WHERE recipe_id = '{$recipeId}'";
    $sql .= " ORDER BY step_number ASC";

    return static::find_by_sql($sql);
  }
}