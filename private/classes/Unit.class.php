<?php

class Unit extends DatabaseObject {
  static protected $table_name = 'units';
  static protected $db_columns = ['unit_id', 'unit_name'];

  public $unitId;
  public $unitName;

  public function __construct($args = []) {
    $this->unitId = $args['unit_id'] ?? null;
    $this->unitName = $args['unit_name'] ?? '';
  }

  public static function get_all_units() {
    $sql = "SELECT unit_name FROM " . static::$table_name . " ORDER BY unit_name ASC";
    $result = static::$database->query($sql);
    $units = [];

    while ($row = $result->fetch_assoc()) {
      $units[] = $row['unit_name'];
    }

    $result->free();

    return $units;
    }
}