<?php 

class Ingredient extends DatabaseObject {
  static protected $table_name = 'recipe_ingredients';
  static protected $db_columns = ['recipe_id', 'ingredient_id', 'quantity', 'unit_id'];

  public $id;
  public $recipeId;
  public $ingredientId;
  public $quantity;
  public $unitId;
  public $ingredientName;
  public $unitName;

  public function __construct($args = []) {
    $this->id = $args['ingredient_id'] ?? null;
    $this->recipeId = $args['recipe_id'] ?? null;
    $this->ingredientId = $args['ingredient_id'] ?? null;
    $this->quantity = $args['quantity'] ?? 0;
    $this->unitId = $args['unit_id'] ?? null;
    $this->ingredientName = $args['ingredient_name'] ?? '';
    $this->unitName = $args['unit_name'] ?? '';
  }

  public static function find_ingredients($recipeId) {
    $sql = "SELECT ri.quantity, u.unit_name, i.ingredient_name ";
    $sql .= "FROM " . static::$table_name . " ri ";
    $sql .= "JOIN ingredients i ON ri.ingredient_id = i.ingredient_id ";
    $sql .= "JOIN units u ON ri.unit_id = u.unit_id ";
    $sql .= "WHERE ri.recipe_id = '{$recipeId}'";

    return static::find_by_sql($sql);
  }

  public function gcd($a, $b) {
    while ($b != 0) {
      $temp = $b;
      $b = $a % $b;
      $a = $temp;
    }

    return $a;
  }

  public function formatted_quantity() {
    $quantity = (float)$this->quantity;

    if (floor($quantity) == $quantity) {
      return (int)$quantity;
    }

    $denominator = 1000;
    $numerator = round($quantity * $denominator);

    $gcd = $this->gcd($numerator, $denominator);

    $numerator /= $gcd;
    $denominator /= $gcd;

    return $numerator . '/' . $denominator;
  }

  public static function check_ingredient_name($input) {
    $input_lower = strtolower($input);
    $escaped_input = self::$database->escape_string($input);
  
    $sql = "SELECT ingredient_id, ingredient_name FROM ingredients ";
    $sql .= "WHERE LOWER(ingredient_name) = LOWER('$escaped_input') LIMIT 1";
  
    $result = self::$database->query($sql);
    if ($row = $result->fetch_assoc()) {
      return [
        'exists' => true,
        'ingredient_id' => $row['ingredient_id'],
        'ingredient_name' => $row['ingredient_name'],
        'suggestions' => []
      ];
    }
  
    $sql_all = "SELECT ingredient_id, ingredient_name FROM ingredients";
    $all_result = self::$database->query($sql_all);
  
    $suggestions = [];
    while ($row = $all_result->fetch_assoc()) {
      $distance = levenshtein($input_lower, strtolower($row['ingredient_name']));
      if ($distance <= 3) {
        $suggestions[] = $row['ingredient_name'];
      }
    }
  
    return [
      'exists' => false,
      'ingredient_id' => null,
      'ingredient_name' => $input,
      'suggestions' => $suggestions
    ];
  }  

  public static function find_by_name($ingredientName) {
    global $database;

    $ingredientName = $database->escape_string($ingredientName);

    $sql = "SELECT * FROM ingredients WHERE ingredient_name = '{$ingredientName}' LIMIT 1";

    $result = self::find_by_sql($sql);

    if (count($result) > 0) {
      return array_shift($result);
    } else {
      return null;
    }
  }
}