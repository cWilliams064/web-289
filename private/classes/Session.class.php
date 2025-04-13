<?php 

class Session {
  
  private $userId;
  public $username;
  private $lastLogin;

  public const MAX_LOGIN_AGE = 60*60*24;
  
  public function __construct() {
    session_start();
    $this->check_stored_login();
  }

  public function login($user) {
    if($user) {
      session_regenerate_id(true);
      $this->userId = $_SESSION['userId'] = $user->id;
      $this->username = $_SESSION['username'] = $user->username;
      $this->lastLogin = $_SESSION['lastLogin'] = time();
    }
    return true;
  }

  public function is_logged_in() {
    return isset($this->userId) && $this->last_login_is_recent(); 
  }
  
  public function is_admin() {
    if (!$this->is_logged_in()) {
        return false;
    }

    $currentUser = User::find_by_id($this->userId);

    if ($currentUser) {
      settype($currentUser->roleId, 'int');
    }

    return $currentUser && $currentUser->roleId === 2;
  }

  public function is_super_admin() {
    if (!$this->is_logged_in()) {
        return false;
    }

    $currentUser = User::find_by_id($this->userId);

    if ($currentUser) {
      settype($currentUser->roleId, 'int');
    }

    return $currentUser && $currentUser->roleId === 3;
  }

  public function is_super_admin_or_admin() {
    if (!$this->is_logged_in()) {
        return false;
    }

    $current_user = User::find_by_id($this->userId);

    if ($current_user) {
      settype($current_user->roleId, 'int');
    }

    return $current_user && ($current_user->roleId === 2 || $current_user->roleId === 3);
  }

  public function get_last_login() {
    return $this->lastLogin;
  }

  public function get_user() {
    return User::find_by_id($this->userId);
  }

  public function get_display_name($maxLength = 15, $trimLength = 12) {
    if (strlen($this->username) > $maxLength) {
      return substr($this->username, 0, $trimLength) . '…';
    }
    return $this->username;
  }

  public function logout() {
    unset($_SESSION['userId']);
    unset($_SESSION['username']);
    unset($_SESSION['lastLogin']);
    unset($this->userId);
    unset($this->username);
    unset($this->lastLogin);
    return true;
  }

  private function check_stored_login() {
    if(isset($_SESSION['userId'])) {
      $this->userId = $_SESSION['userId'];
      $this->username = $_SESSION['username'];
      $this->lastLogin = $_SESSION['lastLogin'];
    }
  }

  private function last_login_is_recent() {
    if(!isset($this->lastLogin)) {
      return false;
    }
    elseif(($this->lastLogin + self::MAX_LOGIN_AGE) < time()) {
      return false;
    }
    else {
      return true;
    }
  }

  public function message($msg="") {
    if(!empty($msg)) {
      $_SESSION['message'] = $msg;
      return true;
    }
    else {
      return $_SESSION['message'] ?? '';
    }
  }

  public function clear_message() {
    unset($_SESSION['message']);
  }
}
