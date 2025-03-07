<?php

function require_login() {
  global $session;

  if(!$session->is_logged_in()) {
    redirect_to(url_for('/index.php'));
  }
  else {
  
  }
}

function require_admin() {
  global $session;

  if(!$session->is_admin()) {
    redirect_to(url_for('/index.php'));
  }
  else {

  }
}

function require_super_admin() {
  global $session;

  if(!$session->is_super_admin()) {
    redirect_to(url_for('/index.php'));
  }
  else {

  }
}


function display_errors($errors=array()) {
  $output = '';
  if(!empty($errors)) {
    $output .= "<div id=\"errors\">";
    $output .= "<p>Please fix the following errors:<p>";
    $output .= "<ul>";
    foreach($errors as $error) {
      $output .= "<li>" . h($error) . "</li>";
    }
    $output .= "</ul>";
    $output .= "</div>";
  }
  return $output;
}

function display_session_message() {
  global $session; 
  $msg = $session->message();
  if(isset($msg) && $msg != '') {
    $session->clear_message();
    return '<div id="message">' . h($msg) . '</div>';
  }
}
