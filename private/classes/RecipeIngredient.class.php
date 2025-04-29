<?php

class RecipeIngredient extends DatabaseObject {

  public $recipe_id;
  public $ingredient_id;
  public $quantity;
  public $unitId;

  static protected $table_name = "recipe_ingredients";
  static protected $db_columns = ['recipe_id', 'ingredient_id', 'quantity', 'unit_id']; // Adjust column names if needed
  static protected $primary_key_column = "id";

  public function __construct($args = []) {
    $this->recipe_id = $args['recipe_id'] ?? '';
    $this->ingredient_id = $args['ingredient_id'] ?? '';
    $this->quantity = $args['quantity'] ?? '';
    $this->unitId = $args['unit_id'] ?? '';
  }

  public function create() {
    $sql = "INSERT INTO " . static::$table_name . " (recipe_id, ingredient_id, quantity, unit) ";
    $sql .= "VALUES (?, ?, ?, ?)";

    if ($stmt = self::$database->prepare($sql)) {
      $stmt->bind_param("iiss", $this->recipe_id, $this->ingredient_id, $this->quantity, $this->unitId);

      $result = $stmt->execute();
      $stmt->close();
       return $result;
    } else {
      echo "Error preparing statement: " . self::$database->error;
      return false;
    }
  }
}
