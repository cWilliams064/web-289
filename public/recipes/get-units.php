<?php

require_once('../../private/initialize.php');

$units = Unit::get_all_units();

header('Content-Type: application/json');

echo json_encode($units);
