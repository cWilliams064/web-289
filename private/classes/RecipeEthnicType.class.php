<?php

class RecipeEthnicType extends DatabaseObject {

  public $id; // Optional
  public $recipe_id;
  public $ethnic_type_id;

  static protected $table_name = "recipe_ethnic_types";
  static protected $db_columns = ['id', 'recipe_id', 'ethnic_type_id'];
  static protected $primary_key_column = "id";

  public function __construct($args = []) {
    $this->recipe_id = $args['recipe_id'] ?? '';
    $this->ethnic_type_id = $args['ethnic_type_id'] ?? '';
  }
}
