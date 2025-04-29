<?php

class RecipeVideo extends DatabaseObject {
  static protected $table_name = 'recipe_videos';
  static protected $db_columns = ['video_id', 'recipe_id', 'youtube_id', 'credit_paragraph'];

  public $videoId;
  public $recipeId;
  public $youtubeId;
  public $creditParagraph;
  public $youtube_link;

  public function __construct($args=[]) {
    $this->videoId = $args['video_id'] ?? '';
    $this->recipeId = $args['recipe_id'] ?? '';
    $this->youtubeId = $args['youtube_id'] ?? '';
    $this->creditParagraph = $args['credit_paragraph'] ?? '';
    $this->youtube_link = $args['youtube_link'] ?? '';
  }

  public static function get_videos($recipeId) {
    $sql = "SELECT * FROM recipe_videos WHERE recipe_id = '" . self::$database->real_escape_string($recipeId) . "'";
    return RecipeVideo::find_by_sql($sql);
  }

  protected function extract_youtube_id($url) {
    $pattern = '#^(?:https?://)?(?:www\.)?(?:youtu\.be/|youtube\.com/(?:embed/|v/|watch\?v=|watch\?.+&v=))([\w-]{11})(?:.+)?$#x';
    preg_match($pattern, $url, $matches);
    return $matches[1] ?? '';
}

  public function create() {
    if (!empty($this->youtube_link)) {
      $this->youtubeId = $this->extract_youtube_id($this->youtube_link);

      if (empty($this->youtubeId)) {
        $this->errors[] = "Invalid YouTube link.";
        return false;
      }
    }

    $sql = "INSERT INTO " . static::$table_name . " (recipe_id, youtube_id, credit_paragraph) ";
    $sql .= "VALUES (?, ?, ?)";

    if ($stmt = self::$database->prepare($sql)) {
        $stmt->bind_param("iss", $this->recipeId, $this->youtubeId, $this->creditParagraph);

        $result = $stmt->execute();
        $stmt->close();
        return $result;
    } else {
        echo "Error preparing statement: " . self::$database->error;
        return false;
    }
  }
}