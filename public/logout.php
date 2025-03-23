<?php
require_once(dirname(__DIR__) . '/private/initialize.php');

$session->logout();

redirect_to(url_for('../public/index.php'));

?>