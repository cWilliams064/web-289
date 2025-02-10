<?php 

class DatabaseObject {

  static protected $database;
  static protected $table_name = "";
  static protected $columns = [];
  public $errors = [];

  static public function set_database($database) {
    self::$database = $database;
  }

  static public function find_all() {
    $sql = "SELECT * FROM " . static::$table_name;
    return static::find_by_sql($sql);
  }
  
  static public function find_by_sql($sql) {
    $result = self::$database->query($sql);
    if(!$result) {
      exit("Database query failed.");
    }
    
    $object_array = [];
    while($record = $result->fetch_assoc()) {
      $object_array[] = static::instantiate($record);
    }
    $result->free();
    
    return $object_array;
  }

  static protected function instantiate($record) {
    $object = new static;

    foreach($record as $property => $value) {
      $camelCaseProperty = lcfirst(str_replace('_', '', ucwords($property, '_')));
      if(property_exists($object, $camelCaseProperty)) {
        $object->$camelCaseProperty = $value;
      }
    }
    return $object;
  }
}
