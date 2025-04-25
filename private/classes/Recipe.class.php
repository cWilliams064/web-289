<?php 

class Recipe extends DatabaseObject {

  Static Protected $table_name = 'recipes';
  static protected $db_columns = ['recipe_id', 'user_id', 'recipe_name', 'recipe_description', 'servings', 'created_at'];

  public $id;
  public $recipeName;
  public $recipeDescription;
  public $servings;
  public $createdAt;
  public $prepTimeSeconds;
  public $cookTimeSeconds;
  public $errors = [];

  public function __construct($args=[]) {
    $this->id = $args['recipe_id'] ?? '';
    $this->recipeName = $args['recipe_name'] ?? '';
    $this->recipeDescription = $args['recipe_description'] ?? '';
    $this->servings = $args['servings'] ?? '';
    $this->createdAt = $args['created_at'] ?? '';
    $this->prepTimeSeconds = null;
    $this->cookTimeSeconds = null;
  }

  static protected function instantiate($record) {
    $object = new static;

    if (isset($record['recipe_id'])) {
      $object->id = $record['recipe_id'];
    }

    foreach($record as $property => $value) {
      if (property_exists($object, $property) && $property !== 'recipe_id') {
        $object->$property = $value;
        continue;
      }

      $camelCaseProperty = lcfirst(str_replace('_', '', ucwords($property, '_')));
      if(property_exists($object, $camelCaseProperty) && $property !== 'recipe_id') {
        $object->$camelCaseProperty = $value;
      }
    }

    return $object;
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

  static public function count_search($searchQuery) {
    $escapedSearchQuery = self::$database->escape_string($searchQuery);

    $sql = "SELECT COUNT(*) FROM " . static::$table_name . " ";
    $sql .= "WHERE recipe_name LIKE '%{$escapedSearchQuery}%'";

    $resultSet = self::$database->query($sql);
    $row = $resultSet->fetch_array();
    return (int) array_shift($row);
  }

  private static function build_filter_group($tableAlias, $junctionTable, $columnName, $filterArray) {
    $joins = '';
  
    if (!empty($filterArray)) {
      $escapedValues = array_map(fn($id) => (int)$id, $filterArray);
      $count = count($escapedValues);
  
      $joins .= "INNER JOIN (
        SELECT recipe_id
        FROM {$junctionTable}
        WHERE {$columnName} IN (" . implode(',', $escapedValues) . ")
        GROUP BY recipe_id
        HAVING COUNT(DISTINCT {$columnName}) = {$count}
      ) {$tableAlias} ON r.recipe_id = {$tableAlias}.recipe_id ";
    }
  
    return ['joins' => $joins];
  }  
  
  private static function build_filter_joins_and_conditions($mealTypes, $ethnicTypes, $dietTypes) {
    $joins = '';
  
    if (!empty($mealTypes)) {
      ['joins' => $mealJoins] = self::build_filter_group('mt', 'recipe_meal_types', 'meal_type_id', $mealTypes);
      $joins .= $mealJoins;
    }
  
    if (!empty($ethnicTypes)) {
      ['joins' => $ethnicJoins] = self::build_filter_group('et', 'recipe_ethnic_types', 'ethnic_type_id', $ethnicTypes);
      $joins .= $ethnicJoins;
    }
  
    if (!empty($dietTypes)) {
      ['joins' => $dietJoins] = self::build_filter_group('dt', 'recipe_diet_types', 'diet_type_id', $dietTypes);
      $joins .= $dietJoins;
    }
  
    return ['joins' => $joins];
  }  
  

  private static function build_sort_clause($sortOptions) {
    if (in_array('highest-rating', $sortOptions) && in_array('newest', $sortOptions)) {
      return " ORDER BY average_rating DESC, r.created_at DESC ";
    } elseif (in_array('highest-rating', $sortOptions)) {
      return " ORDER BY average_rating DESC ";
    } elseif (in_array('newest', $sortOptions)) {
      return " ORDER BY r.created_at DESC ";
    } else {
      return " ORDER BY MD5(r.recipe_id) ";
    }
  }    

  static public function find_by_filters($searchKeyword, $perPage, $offset, $mealTypes = [], $ethnicTypes = [], $dietTypes = [], $sortOptions = []) {
    $escapedSearch = static::$database->escape_string($searchKeyword);

    $mealTypes = array_filter((array)$mealTypes, fn($id) => (int)$id !== 0);
    $ethnicTypes = array_filter((array)$ethnicTypes, fn($id) => (int)$id !== 0);
    $dietTypes = array_filter((array)$dietTypes, fn($id) => (int)$id !== 0);

    ['joins' => $joins] = static::build_filter_joins_and_conditions($mealTypes, $ethnicTypes, $dietTypes);
    $sortClause = static::build_sort_clause($sortOptions);

    $sql  = "SELECT DISTINCT r.*, pt.time_seconds AS prepTimeSeconds, ct.time_seconds AS cookTimeSeconds, ";
    $sql .= "AVG(rt.rating) AS average_rating ";
    $sql .= "FROM recipes r ";
    $sql .= "LEFT JOIN prep_times pt ON r.recipe_id = pt.recipe_id ";
    $sql .= "LEFT JOIN cook_times ct ON r.recipe_id = ct.recipe_id ";
    $sql .= "LEFT JOIN ratings rt ON r.recipe_id = rt.recipe_id ";
    $sql .= $joins;
    $sql .= "WHERE 1=1 ";

    if (!empty($escapedSearch)) {
      $sql .= "AND r.recipe_name LIKE '%{$escapedSearch}%' ";
    }
    
    $sql .= "GROUP BY r.recipe_id,  pt.time_seconds, ct.time_seconds ";
    $sql .= $sortClause;
    $sql .= "LIMIT {$perPage} OFFSET {$offset}";

    

    return static::find_by_sql($sql);
  }
  
  static public function count_by_filters($searchKeyword, $mealTypes = [], $ethnicTypes = [], $dietTypes = []) {
    $escapedSearch = static::$database->escape_string($searchKeyword);

    $mealTypes = array_filter((array)$mealTypes, fn($id) => (int)$id !== 0);
    $ethnicTypes = array_filter((array)$ethnicTypes, fn($id) => (int)$id !== 0);
    $dietTypes = array_filter((array)$dietTypes, fn($id) => (int)$id !== 0);

    ['joins' => $joins] = self::build_filter_joins_and_conditions($mealTypes, $ethnicTypes, $dietTypes);

    $sql  = "SELECT COUNT(DISTINCT r.recipe_id) AS total FROM recipes r ";
    $sql .= $joins;
    $sql .= "WHERE 1=1 ";

    if (!empty($escapedSearch)) {
      $sql .= "AND r.recipe_name LIKE '%{$escapedSearch}%' ";
    }

    $result = static::$database->query($sql);
    $row = $result->fetch_assoc();
    return (int) $row['total'];
  }

  public static function find_recipe_times($recipeId) {
    $escapedRecipeId = static::$database->escape_string($recipeId);

    $sql = "SELECT r.recipe_id, pt.time_seconds AS prepTimeSeconds, ct.time_seconds AS cookTimeSeconds ";
    $sql .= "FROM recipes r LEFT JOIN prep_times pt ON r.recipe_id = pt.recipe_id ";
    $sql .= "LEFT JOIN cook_times ct ON r.recipe_id = ct.recipe_id ";
    $sql .= "WHERE r.recipe_id = '{$escapedRecipeId}' LIMIT 1";

    $result = static::find_by_sql($sql);

    if (!empty($result)) {
      $recipe = $result[0];
      return [
        'prepTimeSeconds' => $recipe->prepTimeSeconds,
        'cookTimeSeconds' => $recipe->cookTimeSeconds
      ];
    }
  
    return [
      'prepTimeSeconds' => null,
      'cookTimeSeconds' => null
    ];
  }

  public function is_time_missing() {
    return ($this->prepTimeSeconds === 0 && $this->cookTimeSeconds === 0);
  }  

  public function format_seconds($seconds) {
    if ($seconds === null) {
      return "Time not provided.";
    }

    $seconds = (int)$seconds;

    if ($seconds === 0) {
      return "Doesn't require";
    }

    $hours = floor($seconds / 3600);
    $minutes = floor(($seconds % 3600) / 60);

    return "{$hours}h {$minutes}m";
  }

  public function get_prep_time() {
    return $this->format_seconds($this->prepTimeSeconds);
  }
  
  public function get_cook_time() {
    return $this->format_seconds($this->cookTimeSeconds);
  }

  public function loadTimes() {
    $times = self::find_recipe_times($this->id);
    $this->prepTimeSeconds = $times['prepTimeSeconds'];
    $this->cookTimeSeconds = $times['cookTimeSeconds'];
  }
 
  public function get_rating_info() {
    $sql = "SELECT AVG(rating) AS average_rating, COUNT(*) ";
    $sql .= "AS total_ratings FROM ratings ";
    $sql .= "WHERE recipe_id = '" . self::$database->escape_string($this->id) . "'";
  
    $result = self::$database->query($sql);
    $row = $result->fetch_assoc();
  
    return [
      'average' => $row['average_rating'] ? round($row['average_rating'], 1) : 0,
      'total' => $row['total_ratings'] ?? 0
    ];
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
      $this->errors[] = "Servings must be a number greater than 0.";
    }

    return $this->errors;
  }
}