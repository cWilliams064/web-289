<?php

class RecipeMealType extends DatabaseObject {

    public $id;
    public $recipe_id;
    public $meal_type_id;

    static protected $table_name = "recipe_meal_types";
    static protected $db_columns = ['id', 'recipe_id', 'meal_type_id']; 
    static protected $primary_key_column = "id";

  public function __construct($args = []) {
    $this->recipe_id = $args['recipe_id'] ?? '';
    $this->meal_type_id = $args['meal_type_id'] ?? '';
  }

  public function create() {
    $sql = "INSERT INTO " . static::$table_name . " (recipe_id, meal_type_id) ";
    $sql .= "VALUES (?, ?)";

    if ($stmt = self::$database->prepare($sql)) {
      $stmt->bind_param("ii", $this->recipe_id, $this->meal_type_id); 

      $result = $stmt->execute();
      $stmt->close();
      return $result;
    } else {
      echo "Error preparing statement: " . self::$database->error;
      return false;
    }
  }
}
