<?php

class User extends DatabaseObject {
  
  static protected $table_name = 'users';
  static protected $db_columns = ['user_id', 'first_name', 'last_name', 'username', 'email', 'hashed_password', 'role_id', 'created_at', 'activity'];

  public $id;
  public $firstName;
  public $lastName;
  public $username;
  public $email;
  public $roleId;
  public $createdAt;
  public $activity;
  public $password;
  public $confirmPassword;
  protected $hashedPassword;
  protected $passwordRequired = true;

  public const USER_LEVEL_OPTIONS = [
    1 => 'Member',
    2 => 'Admin',
    3 => 'Super Admin'
  ];

  public function role_level() {
    settype($this->roleId, 'int');
    if ($this->roleId === 1 || $this->roleId === 2 || $this->roleId === 3) {
      return self::USER_LEVEL_OPTIONS[$this->roleId];
    } else {
      return "Unknown";
    }
  }

  public function __construct($args=[]) {
    $this->id = $args['user_id'] ?? '';
    $this->firstName = $args['first_name'] ?? '';
    $this->lastName = $args['last_name'] ?? '';
    $this->username = $args['username'] ?? '';
    $this->email = $args['email'] ?? '';
    $this->roleId = $args['role_id'] ?? 1;
    $this->createdAt = $args['created_at'] ?? '';
    $this->activity = $args['activity'] ?? 1;
    $this->password = $args['password'] ?? '';
    $this->confirmPassword = $args['confirm_password'] ?? '';
  }

  public function full_name() {
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
    $this->createdAt = date('Y-m-d H:i:s');
    $this->check_activity_status();
    
    return parent::create();
  }

  protected function update() {
    if($this->password != '') {
      $this->set_hashed_password();
    }
    else {
      $this->passwordRequired = false;
    }

    $this->check_activity_status();

    return parent::update();
  }

  public function check_activity_status() {
    global $session;
    $lastLogin = $session->get_last_login();
    if ($lastLogin && strtotime($lastLogin) < strtotime('-30 days')) {
      $this->activity = 0;
    }
  }

  public static function find_by_id($id) {
    return parent::find_by_id($id);
  }

  public static function find_by_username($username) {
    $sql = "SELECT * FROM " . static::$table_name;
    $sql .= " WHERE username = '" . static::$database->escape_string($username) . "'";
    $obj_array = static::find_by_sql($sql);

    if(!empty($obj_array)) {
      return array_shift($obj_array);
    }
    else {
      return false;
    }
  } 

  public function validate() {
    $this->errors = [];
  
    if(is_blank($this->firstName)) {
      $this->errors['firstName'] = "First name cannot be blank.";
    } elseif (!has_length($this->firstName, array('min' => 2, 'max' => 255))) {
      $this->errors['firstName'] = "First name must be between 2 and 255 characters.";
    }
  
    if(is_blank($this->lastName)) {
      $this->errors['lastName'] = "Last name cannot be blank.";
    } elseif (!has_length($this->lastName, array('min' => 2, 'max' => 255))) {
      $this->errors['lastName'] = "Last name must be between 2 and 255 characters.";
    }
  
    if(is_blank($this->email)) {
      $this->errors['email'] = "Email cannot be blank.";
    } elseif (!has_length($this->email, array('max' => 255))) {
      $this->errors['email'] = "Email must be less than 255 characters.";
    } elseif (!has_valid_email_format($this->email)) {
      $this->errors['email'] = "Email must be a valid format.";
    }
  
    if(is_blank($this->username)) {
      $this->errors['username'] = "Username cannot be blank.";
    } elseif (!has_length($this->username, array('min' => 8, 'max' => 255))) {
      $this->errors['username'] = "Username must be between 8 and 255 characters.";
    } elseif (!has_unique_username($this->username, $this->id ?? 0)) {
      $this->errors['username'] = "Username not allowed. Try another.";
    }
  
    if($this->passwordRequired) {
      if(is_blank($this->password)) {
        $this->errors['password'] = "Password cannot be blank.";
      } elseif (!has_length($this->password, array('min' => 8))) {
        $this->errors['password'] = "Password must contain 8 or more characters";
      } elseif (!preg_match('/[A-Z]/', $this->password)) {
        $this->errors['password'] = "Password must contain at least 1 uppercase letter";
      } elseif (!preg_match('/[a-z]/', $this->password)) {
        $this->errors['password'] = "Password must contain at least 1 lowercase letter";
      } elseif (!preg_match('/[0-9]/', $this->password)) {
        $this->errors['password'] = "Password must contain at least 1 number";
      } elseif (!preg_match('/[^A-Za-z0-9\s]/', $this->password)) {
        $this->errors['password'] = "Password must contain at least 1 symbol";
      }

      if(is_blank($this->confirmPassword)) {
        $this->errors['confirmPassword'] = "Confirm password cannot be blank.";
      } elseif ($this->password !== $this->confirmPassword) {
        $this->errors['confirmPassword'] = "Password and confirm password must match.";
      }
    }

    return $this->errors;
  }  

  public function validate_login() {
    $this->errors = [];

    if (is_blank($this->username)) {
        $this->errors['username'] = "Username cannot be blank!";
    } else {
        $user = self::find_by_username($this->username);

        if (!$user) {
            $this->errors['username'] = "Invalid username!";
        } else {
            if (is_blank($this->password)) {
                $this->errors['password'] = "Password cannot be blank!";
            } elseif (!$user->verify_password($this->password)) {
                $this->errors['password'] = "Invalid password!";
            }
        }
    }

    return $this->errors;
  }
}
