<?php

class Rating extends DatabaseObject {
  static protected $table_name = 'ratings';
  static protected $db_columns = ['rating_id', 'recipe_id', 'user_id', 'rating', 'created_at'];

  public $id;
  public $recipeId;
  public $userId;
  public $rating;
  public $createdAt;

  public function __construct($args = []) {
    $this->id = $args['rating_id'] ?? null;
    $this->recipeId = $args['recipe_id'] ?? '';
    $this->userId = $args['user_id'] ?? 0;
    $this->rating = $args['rating'] ?? '';
    $this->createdAt = date('Y-m-d H:i:s');
  }

  static protected function instantiate($record) {
    $object = new static;

    if (isset($record['rating_id'])) {
      $object->id = $record['rating_id']; 
    }

    foreach($record as $property => $value) {
      $camelCaseProperty = lcfirst(str_replace('_', '', ucwords($property, '_')));
      if(property_exists($object, $camelCaseProperty)) {
        $object->$camelCaseProperty = $value;
      }
    }
    return $object;
  }

  static public function find_by_user_and_recipe($userId, $recipeId) {
    $sql = "SELECT * FROM " . static::$table_name . " WHERE user_id = '$userId' AND recipe_id = '$recipeId'";
    $ratingArray = static::find_by_sql($sql);

    if (!empty($ratingArray)) {
      return array_shift($ratingArray);
    }
    return false;
  }

  protected function update() {
    $this->validate();
    if (!empty($this->errors)) {
      return false;
    }

    $attributes = $this->sanitized_attributes();
    $attribute_pairs = [];

    if (isset($attributes['rating'])) {
      $attribute_pairs[] = "rating='{$attributes['rating']}'";
    }

    $sql = "UPDATE " . static::$table_name . " SET ";
    $sql .= join(', ', $attribute_pairs);
    $sql .= " WHERE rating_id='" . static::$database->escape_string($this->id) . "'";
    $sql .= " LIMIT 1";

    $result = self::$database->query($sql);
    return $result;
  }

  public function save() {
    if ($this->rating < 1 || $this->rating > 5) {
      $this->errors[] = "Rating must be between 1 and 5.";
      return false;
    }

    $existingRating = self::find_by_user_and_recipe($this->userId, $this->recipeId);
    if ($existingRating) {
      $this->id = $existingRating->id;
      return $this->update();
    }
    
    return parent::save();
  }

  protected function sanitized_attributes() {
    $sanitized = [];
    foreach ($this->attributes() as $key => $value) {
      if ($key === 'rating_id') {
        continue;
      }
      
      $sanitized[$key] = self::$database->escape_string($value);
    }
    return $sanitized;
  }

}
