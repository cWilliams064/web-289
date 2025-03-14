<?php

function require_login() {
  global $session;

  if (!$session->is_logged_in()) {
    $session->message("Access Denied. You must be logged in.");
    redirect_to(url_for('/index.php'));
  }
}

function require_admin() {
  global $session;

  if (!$session->is_admin()) {
    $session->message("Access Denied. Page requires Admin access.");
    redirect_to(url_for('/index.php'));
  }
}

function require_super_admin() {
  global $session;

  if (!$session->is_super_admin()) {
    $session->message("Access Denied. Page requires Super Admin access.");
    redirect_to(url_for('/index.php'));
  } 
}

function require_admin_or_super_admin() {
  global $session;

  if (!$session->is_admin() && !$session->is_super_admin()) {
    $session->message("Access Denied. Page requires Admin or Super Admin access.");
    redirect_to(url_for('/index.php'));
  }
}

function display_session_message() {
  global $session; 
  $msg = $session->message();
  if(isset($msg) && $msg != '') {
    $session->clear_message();
    return '<div id="message">' . h($msg) . '</div>';
  }
}
