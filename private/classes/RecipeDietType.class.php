<?php

class RecipeDietType extends DatabaseObject {

  public $id;
  public $recipe_id;
  public $diet_type_id;

  static protected $table_name = "recipe_diet_types";
  static protected $db_columns = ['id', 'recipe_id', 'diet_type_id'];
  static protected $primary_key_column = "id";

  public function __construct($args = []) {
    $this->recipe_id = $args['recipe_id'] ?? '';
    $this->diet_type_id = $args['diet_type_id'] ?? '';
  }

}
