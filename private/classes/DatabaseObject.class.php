<?php 

class DatabaseObject {

  static protected $database;
  static protected $table_name = "";
  static protected $db_columns = [];
  public $errors = [];
  public $id;

  static public function set_database($database) {
    self::$database = $database;
  }

  static public function find_all() {
    $primary_key_column = rtrim(static::$table_name, 's') . '_id';

    $sql = "SELECT * FROM " . static::$table_name;
    $sql .= " ORDER BY $primary_key_column ASC";
    return static::find_by_sql($sql);
  }
  
  static public function find_by_sql($sql) {
    $result = self::$database->query($sql);
    if(!$result) {
      exit("Database query failed.");
    }
    
    $obj_array = [];  
    while($record = $result->fetch_assoc()) {
      $obj_array[] = static::instantiate($record);
    }
    $result->free();
    
    return $obj_array;
  }

  static public function find_by_id($id) {
    $primary_key_column = rtrim(static::$table_name, 's') . '_id';

    $sql = "SELECT * FROM " . static::$table_name;
    $sql .= " WHERE " . $primary_key_column . "='" . self::$database->escape_string($id) . "'";
    $obj_array = static::find_by_sql($sql);
    
    if(!empty($obj_array)) {
      return array_shift($obj_array);
    }
    else {
      return false;
    }
  }

  static public function get_role_id($id) {
    $sql = "SELECT role_id FROM users";
    $sql .= " WHERE user_id = '" . self::$database->escape_string($id) . "'";
    $result = self::$database->query($sql);

    if ($result) {
      $row = $result->fetch_assoc();
      if ($row) {
          settype($row['role_id'], 'int');
          return $row['role_id'];
      }
    }
    return false;
  }

  static protected function instantiate($record) {
    $object = new static;

    if (isset($record['user_id'])) {
      $object->id = $record['user_id'];
    }
    
    foreach($record as $property => $value) {
      $camelCaseProperty = lcfirst(str_replace('_', '', ucwords($property, '_')));

      if(property_exists($object, $camelCaseProperty) && $property !== 'user_id') {
        $object->$camelCaseProperty = $value;
      }
    }
    return $object;
  }

  protected function validate() {
    $this->errors = [];
    return $this->errors;
  }

  protected function create() {
    $this->validate();
    if(!empty($this->errors)) {return false; }

    $attributes = $this->sanitized_attributes();
    $sql = "INSERT INTO " . static::$table_name . " (";
    $sql .= join(', ', array_keys($attributes));
    $sql .= ") VALUES ('";
    $sql .= join("', '", array_values($attributes));
    $sql .= "')";

    $result = self::$database->query($sql);
    if ($result) {
      $this->id = self::$database->insert_id;
    }
    return $result;
  }

  protected function update() {
    $this->validate();
    if(!empty($this->errors)) {return false; }

    $attributes = $this->sanitized_attributes();
    $attribute_pairs = [];

    foreach($attributes as $key => $value) {
      $attribute_pairs[] = "{$key}='{$value}'";
    }

    $primary_key_column = rtrim(static::$table_name, 's') . '_id';
    
    $sql = "UPDATE " . static::$table_name . " SET ";
    $sql .= join(', ', $attribute_pairs);
    $sql .= " WHERE " . $primary_key_column . "='" . self::$database->escape_string($this->id) . "'";
    $sql .= " LIMIT 1";

    $result = self::$database->query($sql);
    return $result;
  }

  public function delete() {
    $primary_key_column = rtrim(static::$table_name, 's') . '_id';

    $sql = "DELETE FROM " . static::$table_name;
    $sql .= " WHERE " . $primary_key_column . "='" . self::$database->escape_string($this->id) . "'";
    $sql .= " LIMIT 1";

    $result = self::$database->query($sql);
    return $result;
  }

  public function save() {
    if (isset($this->id) && !empty($this->id)) {
      return $this->update();
    }
    else {
      return $this->create();
    }
  }

  public function merge_attributes($args = []) {
    foreach ($args as $key => $value) {
        $camelCaseKey = lcfirst(str_replace('_', '', ucwords($key, '_')));
        
        if (property_exists($this, $camelCaseKey) && !is_null($value)) {
            $this->$camelCaseKey = $value;
        }
    }
  }

  public function attributes() {
    $attributes = [];

    foreach(static::$db_columns as $column) {
      $camelCaseProperty = lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $column))));

      if (property_exists($this, $camelCaseProperty)) {
          $attributes[$column] = $this->$camelCaseProperty;
      }
    }

    return $attributes;
  }

  protected function sanitized_attributes() {
    $sanitized = [];
    foreach($this->attributes() as $key => $value) {
      $sanitized[$key] = self::$database->escape_string($value);
    }
    return $sanitized;
  }
}
