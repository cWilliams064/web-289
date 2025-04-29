<?php 

class Recipe extends DatabaseObject {

  Static Protected $table_name = 'recipes';
  static protected $db_columns = ['recipe_id', 'user_id', 'recipe_name', 'recipe_description', 'servings', 'created_at'];

  public $id;
  public $userId;
  public $recipeName;
  public $recipeDescription;
  public $servings;
  public $createdAt;
  public $recipeTime;
  public $mealTypes;
  public $ethnicTypes;
  public $dietTypes;
  public $errors = [];

  public function __construct($args=[]) {
    $this->id = $args['recipe_id'] ?? null;
    $this->userId = $args['user_id'] ?? '';
    $this->recipeName = $args['recipe_name'] ?? '';
    $this->recipeDescription = $args['recipe_description'] ?? '';
    $this->servings = $args['servings'] ?? '';
    $this->createdAt = $args['created_at'] ?? date('Y-m-d H:i:s');
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

  public function create() {
    $this->validate();
    if (!empty($this->errors)) {
      return false;
    }

    $attributes = $this->sanitized_attributes();

    $sql = "INSERT INTO " . static::$table_name . " (" . join(', ', array_keys($attributes)) . ")";
    $sql .= " VALUES (" . join(', ', array_fill(0, count($attributes), '?')) . ")";

    if ($stmt = self::$database->prepare($sql)) {
      $param_types = str_repeat('s', count($attributes));
      $stmt->bind_param($param_types, ...array_values($attributes));

      $result = $stmt->execute();

      if ($result) {
        $this->id = self::$database->insert_id;
      } else {
        echo "Error executing query: " . $stmt->error;
      }

      $stmt->close();
      return $result;
    } else {
      echo "Error preparing statement: " . self::$database->error;
      return false;
    }
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

  public static function find_recipe_types_by_recipe_id($recipeId) {
    $escapedRecipeId = static::$database->escape_string($recipeId);

    $sql = "SELECT meal_types, ethnic_types, diet_types ";
    $sql .= "FROM recipe_categories WHERE recipe_id = '{$escapedRecipeId}'";

    return static::find_by_sql($sql);
    
  }

  public function get_username() {
    /** @var User $user */
    $user = User::find_by_id($this->userId);

    return $user ? $user->username : 'Unknown User';
  }

  public function get_prep_time() {
    $prep = PrepTime::find_by_recipe_id($this->id);

    if (!$prep || !isset($prep->timeSeconds)) {
      return "Time not provided";
    }

    $seconds = (int) $prep->timeSeconds;

    if ($seconds === 0) {
      return "Time not needed";
    }

    return $prep->formatted_time();
  }

  public function get_cook_time() {
    $cook = CookTime::find_by_recipe_id($this->id);

    if (!$cook || !isset($cook->timeSeconds)) {
      return "Time not provided";
    }

    $seconds = (int) $cook->timeSeconds;

    if ($seconds === 0) {
      return "Time not needed";
    }

    return $cook->formatted_time();
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
}