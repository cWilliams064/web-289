<?php

class Category extends DatabaseObject {
	public $id;
  public $name;
	public $category_type;
	public $errors = [];
	static protected $primary_key_column = "";
  static protected $table_name = "";
  static protected $db_columns = [];

	public function __construct($args = []) {
		if (isset($args['name'])) {
				$this->name = $args['name'];
		}
		if (isset($args['category_type'])) {
				$this->category_type = $args['category_type'];
		}
	}

  static protected function instantiate($record) {
		$object = new static;

		if (isset($record['meal_type_id'])) {
				$object->id = $record['meal_type_id'];
				$object->name = $record['meal_type_name'];
		} elseif (isset($record['ethnic_type_id'])) {
				$object->id = $record['ethnic_type_id'];
				$object->name = $record['ethnic_type_name'];
		} elseif (isset($record['diet_type_id'])) {
				$object->id = $record['diet_type_id'];
				$object->name = $record['diet_type_name'];
		}

		return $object;
	}
	
	static public function set_table($table) {
		static::$table_name = $table;

		switch ($table) {
			case 'meal_types':
				static::$db_columns = ['meal_type_id', 'meal_type_name'];
				static::$primary_key_column = 'meal_type_id';
				break;
			case 'ethnic_types':
				static::$db_columns = ['ethnic_type_id', 'ethnic_type_name'];
				static::$primary_key_column = 'ethnic_type_id';
				break;
			case 'diet_types':
				static::$db_columns = ['diet_type_id', 'diet_type_name'];
				static::$primary_key_column = 'diet_type_id';
				break;
		}
	}

	static public function find_category_by_id($id) {
		$id = (int) $id;

		if (empty(static::$table_name) || empty(static::$primary_key_column)) {
			throw new Exception("Table name or primary key column not set");
		}

		$sql = "SELECT * FROM " . static::$table_name;
		$sql .= " WHERE " . static::$primary_key_column . " = " . $id;
    $result_array = static::find_by_sql($sql);

    if (!empty($result_array)) {
      $category = array_shift($result_array);
      $category->category_type = static::$table_name;
      return $category;
    }
        
    return false;
  }

  public static function get_all_names($table) {
    static::set_table($table);

    $name_column = static::$db_columns[1];
    $sql = "SELECT {$name_column} FROM " . static::$table_name;
    $sql .= " ORDER BY {$name_column} ASC";

    $result = self::$database->query($sql);
    $names = [];

    if ($result) {
      while ($row = $result->fetch_assoc()) {
        $names[] = $row[$name_column];
      }
      $result->free();
    }

    return $names;
  }


	protected function create() {
		$this->validate_category();
    if(!empty($this->errors)) { return false; }

		static::set_table($this->category_type);
    $name = self::$database->escape_string($this->name);
		$name_column = static::$db_columns[1] ?? null;

    $sql = "INSERT INTO " . static::$table_name;
    $sql .= " ($name_column) VALUES ('$name')";

    $result = self::$database->query($sql);
    if ($result) {
      $this->id = self::$database->insert_id;
    }

    return $result;
	}

	protected function sanitized_attributes() {
    $sanitized = [];

    self::set_table($this->category_type);
    
    $sanitized['name'] = self::$database->escape_string($this->name);

    return $sanitized;
  }

	public function validate_category() {
    $this->errors = [];

    if (is_blank($this->name)) {
        $this->errors['name'] = "Category name cannot be blank.";
    } elseif (!has_length($this->name, ['min' => 2, 'max' => 255])) {
        $this->errors['name'] = "Category name must be between 2 and 255 characters.";
    }

    $valid_types = ['meal_types', 'ethnic_types', 'diet_types'];
    if (is_blank($this->category_type)) {
        $this->errors['category_type'] = "Category type cannot be blank.";
    } elseif (!in_array($this->category_type, $valid_types)) {
        $this->errors['category_type'] = "Invalid category type.";
    }

    if (empty($this->errors)) {
      static::set_table($this->category_type);
      $name_column = static::$db_columns[1];

      $safe_name = self::$database->escape_string($this->name);
      $sql = "SELECT COUNT(*) FROM " . static::$table_name;
      $sql .= " WHERE {$name_column} = '{$safe_name}'";

      $result = self::$database->query($sql);
      $row = $result->fetch_row();

      if ($row[0] > 0) {
        $this->errors['name'] = "This category name already exists.";
      }
    }

    return $this->errors;
	}

}
