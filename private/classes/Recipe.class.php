<?php 

class Recipe extends DatabaseObject {
    Static Protected $table_name = 'recipes';
    static protected $db_columns = ['user_id', 'recipe_name', 'last_name', 'username', 'email', 'profile_img', 'hash_password', 'role_id', 'created_at', 'active'];

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

    protected function validate() {
        $this->errors = [];
    
        if(is_blank($this->recipeName)) {
          $this->errors[] = "Recipe Name cannot be blank!";
        }
        
        return $this->errors;
      }
}