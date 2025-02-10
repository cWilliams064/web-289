<?php 

class Recipe extends DatabaseObject {
    Static Protected $table_name = 'recipes';

    public $recipeName;
    public $recipeDescription;
    public $servings;
    public $createdAt;

    public function __construct($args=[]) {
        $this->recipeName = $args['recipe_name'] ?? '';
        $this->recipeDescription = $args['recipe_description'] ?? '';
        $this->servings = $args['servings'] ?? '';
        $this->createdAt = $args['created_at'] ?? '';
    }
}