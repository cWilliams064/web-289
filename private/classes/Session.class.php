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
      session_regenerate_id();
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
    $current_user = User::find_by_id($this->userId);
    return $current_user && $current_user->roleLevel === 2;
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
