<?php

abstract class RecipeTime extends DatabaseObject {
  protected static $table_name;
  protected static $db_fields = ['recipe_id', 'time_seconds'];

  public $id;
  public $recipeId;
  public $timeSeconds;

  public function __construct($recipeId = null, $timeSeconds = null) {
    $this->recipeId = $recipeId;
    $this->timeSeconds = $timeSeconds;
  }

  public static function find_by_recipe_id($recipeId) {
    $sql = "SELECT * FROM " . static::$table_name . " WHERE recipe_id = ?";
    $result_set = self::find_by_sql($sql, [$recipeId]);
    return !empty($result_set) ? array_shift($result_set) : false;
  }

  public function formatted_time() {
    if ($this->timeSeconds === null || $this->timeSeconds == 0) {
      return "Time not needed";
    }

    $hours = floor($this->timeSeconds / 3600);
    $minutes = floor(($this->timeSeconds % 3600) / 60);

    $parts = [];
    if ($hours > 0) {
        $parts[] = $hours . ' hr' . ($hours > 1 ? 's' : '');
    }
    if ($minutes > 0 || empty($parts)) {
        $parts[] = $minutes . ' min' . ($minutes > 1 ? 's' : '');
    }

    return implode(' ', $parts);
  }

}
