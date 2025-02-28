<?php

class User extends DatabaseObject {
  
  static protected $table_name = 'users';
  static protected $db_columns = ['user_id', 'first_name', 'last_name', 'username', 'email', 'profile_img', 'hash_password', 'role_id', 'created_at', 'active'];

  public $id;
  public $firstName;
  public $lastName;
  public $username;
  public $profileImage;
  public $email;
  protected $hashedPassword;
  public $roleLevel;
  public $createdTimestamp;
  public $activity;
  public $password;
  public $confirmPassword;
  protected $passwordRequired = true;

  public const USER_LEVEL_OPTIONS = [
    1 => 'Member',
    2 => 'Admin',
    3 => 'Super Admin'
  ];

  public function role_level() {
    if($this->roleLevel === 2 || $this->roleLevel === 3) {
      return self::USER_LEVEL_OPTIONS[$this->roleLevel];
    }
    else {
      return "Unknown";
    }
  }

  public function __construct($args=[]) {
    $this->id = $args['user_id'] ?? '';
    $this->firstName = $args['first_name'] ?? '';
    $this->lastName = $args['last_name'] ?? '';
    $this->username = $args['username'] ?? '';
    $this->email = $args['email'] ?? '';
    $this->profileImage = $args['profile_img'] ?? '/assets/default-profile.png';
    $this->roleLevel = $args['role_id'] ?? 1;
    $this->createdTimestamp = $args['created_at'] ?? '';
    $this->activity = $args['activity'] ?? '';
    $this->password = $args['password'] ?? '';
    $this->confirmPassword = $args['confirm_password'] ?? '';
  }

  public function fullName() {
    return "{$this->firstName} {$this->lastName}";
  }

  protected function set_hashed_password() {
    $this->hashedPassword = password_hash($this->password, PASSWORD_BCRYPT);
  }

  public function verify_password($password) {
    return password_verify($password, $this->hashedPassword);
  }

  protected function create() {
    $this->set_hashed_password();
    return parent::create();
  }

  protected function update() {
    if($this->password != '') {
      $this->set_hashed_password();
    }
    else {
      $this->passwordRequired = false;
    }
    return parent::update();
  }

  protected function validate() {
    $this->errors = [];
  
    if(is_blank($this->firstName)) {
      $this->errors[] = "First name cannot be blank.";
    } elseif (!has_length($this->firstName, array('min' => 2, 'max' => 255))) {
      $this->errors[] = "First name must be between 2 and 255 characters.";
    }
  
    if(is_blank($this->lastName)) {
      $this->errors[] = "Last name cannot be blank.";
    } elseif (!has_length($this->lastName, array('min' => 2, 'max' => 255))) {
      $this->errors[] = "Last name must be between 2 and 255 characters.";
    }
  
    if(is_blank($this->email)) {
      $this->errors[] = "Email cannot be blank.";
    } elseif (!has_length($this->email, array('max' => 255))) {
      $this->errors[] = "Last name must be less than 255 characters.";
    } elseif (!has_valid_email_format($this->email)) {
      $this->errors[] = "Email must be a valid format.";
    }
  
    if(is_blank($this->username)) {
      $this->errors[] = "Username cannot be blank.";
    } elseif (!has_length($this->username, array('min' => 8, 'max' => 255))) {
      $this->errors[] = "Username must be between 8 and 255 characters.";
    } elseif (!has_unique_username($this->username, $this->id ?? 0)) {
      $this->errors[] = "Username not allowed. Try another.";
    }
  
    if($this->passwordRequired) {
      if(is_blank($this->password)) {
        $this->errors[] = "Password cannot be blank.";
      } elseif (!has_length($this->password, array('min' => 12))) {
        $this->errors[] = "Password must contain 12 or more characters";
      } elseif (!preg_match('/[A-Z]/', $this->password)) {
        $this->errors[] = "Password must contain at least 1 uppercase letter";
      } elseif (!preg_match('/[a-z]/', $this->password)) {
        $this->errors[] = "Password must contain at least 1 lowercase letter";
      } elseif (!preg_match('/[0-9]/', $this->password)) {
        $this->errors[] = "Password must contain at least 1 number";
      } elseif (!preg_match('/[^A-Za-z0-9\s]/', $this->password)) {
        $this->errors[] = "Password must contain at least 1 symbol";
      }
    }
  
    if(is_blank($this->confirmPassword)) {
      $this->errors[] = "Confirm password cannot be blank.";
    } elseif ($this->password !== $this->confirmPassword) {
      $this->errors[] = "Password and confirm password must match.";
    }
  
    return $this->errors;
  }  

  static public function find_by_username($username) {
    $sql = "SELECT * FROM " . static::$table_name;
    $sql .= " WHERE username='" . self::$database->escape_string($username) . "'";
    $obj_array = static::find_by_sql($sql);
    if(!empty($obj_array)) {
      return array_shift($obj_array);
    }
    else {
      return false;
    }
  } 
}
