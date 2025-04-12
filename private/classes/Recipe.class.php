<?php 

class Recipe extends DatabaseObject {

  Static Protected $table_name = 'recipes';
  static protected $db_columns = ['recipe_id', 'user_id', 'recipe_name', 'last_name', 'username', 'email', 'profile_img', 'hash_password', 'role_id', 'created_at', 'active'];

  public $id;
  public $recipeName;
  public $recipeDescription;
  public $servings;
  public $createdAt;

  public function __construct($args=[]) {
    $this->id = $args['recipe_id'] ?? '';
    $this->recipeName = $args['recipe_name'] ?? '';
    $this->recipeDescription = $args['recipe_description'] ?? '';
    $this->servings = $args['servings'] ?? '';
    $this->createdAt = $args['created_at'] ?? '';
  }

  static protected function instantiate($record) {
    $object = new static;

    if (isset($record['recipe_id'])) {
      $object->id = $record['recipe_id'];
    }

    foreach($record as $property => $value) {
      $camelCaseProperty = lcfirst(str_replace('_', '', ucwords($property, '_')));

      if(property_exists($object, $camelCaseProperty) && $property !== 'recipe_id') {
        $object->$camelCaseProperty = $value;
      }
    }
    return $object;
  }

  static public function find_by_recipe_name($recipeName) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE recipe_name = '" . self::$database->escape_string($recipeName) . "' ";
    $sql .= "LIMIT 1";
    $result = static::find_by_sql($sql);
    return !empty($result) ? array_shift($result) : false;
  }

  public function get_recipe_photo() {
    $sql = "SELECT img_path FROM recipe_photos WHERE recipe_id = '" . $this->id . "' LIMIT 1";
    $result = self::$database->query($sql);
    $photo = $result->fetch_assoc();
    
    return $photo ? $photo['img_path'] : '/web-289/public/assets/recipe-images/default-recipe-image.jpg';
  }

  static public function count_all() {
    $sql = "SELECT COUNT(*) FROM " . static::$table_name;
    $resultSet = self::$database->query($sql);
    $row = $resultSet->fetch_array();
    return (int) array_shift($row);
  }

  static public function count_filtered($searchQuery) {
    global $database;
    $escapedSearchQuery = $database->escape_string($searchQuery);

    $sql = "SELECT COUNT(*) FROM " . static::$table_name . " ";
    $sql .= "WHERE recipe_name LIKE '%{$escapedSearchQuery}%'";

    $resultSet = self::$database->query($sql);
    $row = $resultSet->fetch_array();
    return (int) array_shift($row);
  }

  protected function validate_recipe() {
    $this->errors = [];
  
    if(is_blank($this->recipeName)) {
      $this->errors[] = "Recipe Name cannot be blank!";
    } 
    elseif (!has_length($this->recipeName, ['min' => 2, 'max' => 255])) {
      $this->errors[] = "Recipe Name must be between 2 and 255 characters.";
    }

    if(is_blank($this->recipeDescription)) {
      $this->errors[] = "Description cannot be blank!";
    } 
    elseif (!has_length($this->recipeDescription, ['max' => 255])) {
      $this->errors[] = "Description must be less than 255 characters.";
    }

    if($this->servings < 1) {
      $this->errors[] = "Servings must be at least 1.";
    }

    return $this->errors;
  }
}