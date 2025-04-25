<?php

class Pagination {

  public $currentPage;
  public $perPage;
  public $totalCount;

  public function __construct($page=1, $perPage=12, $totalCount=0) {
    $this->currentPage = (int) $page;
    $this->perPage = (int) $perPage;
    $this->totalCount = (int) $totalCount;
  }

  public function offset() {
    return $this->perPage * ($this->currentPage - 1);
  }

  private function build_url($url, $page) {
    $queryParams = $_GET;
    $queryParams['page'] = $page;
    $baseUrl = strtok($url, '?');

    return $baseUrl . '?' . http_build_query($queryParams);
  }

  public function total_pages() {
    return ceil($this->totalCount / $this->perPage);
  }

  public function previous_page() {
    $prev = $this->currentPage - 1;
    return ($prev > 0) ? $prev : false;
  }

  public function next_page() {
    $next = $this->currentPage + 1;
    return ($next <= $this->total_pages()) ? $next : false;
  }

  public function previous_link($url="") {
    $link = "";
    $prevPage = $this->previous_page();
    
    if($prevPage) {
      $link = "<a href=\"" . $this->build_url($url, $prevPage) . "\" id=\"previous-link\">";
      $link .= "<span class=\"arrows\">&larr;</span> Previous</a>";
    }

    return $link;
  }
  
  public function next_link($url="") {
    $link = "";
    $nextPage = $this->next_page();

    if($nextPage) {
      $link = "<a href=\"" . $this->build_url($url, $nextPage) . "\" id=\"next-link\">";
      $link .= "Next <span class=\"arrows\">&rarr;</span></a>";
    }

    return $link;
  }

  public function number_links($url="") {
    $output = "";
    $totalPages = $this->total_pages();

    if ($totalPages <= 5) {
      for($i=1; $i <= $totalPages; $i++) {
        $output .= $this->number_page_link($url, $i);
      }
    } else {
      $start = max(1, $this->currentPage - 2);
      $end = min($totalPages, $this->currentPage + 2);

      for ($i = $start; $i <= $end; $i++) {
        $output .= $this->number_page_link($url, $i);
      }

      if ($this->currentPage > 5) {
        $output = "<span>...</span>" . $output;
      }

      if ($this->currentPage < $totalPages - 5) {
        $output .= "<span>...</span>";
      }
    }

    return $output;
  }

  private function number_page_link($url, $i) {
    if($i == $this->currentPage) {
      return "<span id=\"selected-link\">{$i}</span>";
    } else {
      return "<a href=\"" . $this->build_url($url, $i) . "\">{$i}</a>";
    }
  }

  public function all_page_links($url) {
    $output = "";
    if($this->total_pages() > 1) {
      $output .= "<div class=\"pagination\">";
      $output .= $this->previous_link($url);
      $output .= $this->number_links($url);
      $output .= $this->next_link($url);
      $output .= "</div>";
    }
    return $output;
  }
}
