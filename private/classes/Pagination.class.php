<?php

class Pagination {

  public $currentPage;
  public $perPage;
  public $totalCount;

  public function __construct($page=1, $perPage=20, $totalCount=0) {
    $this->currentPage = (int) $page;
    $this->perPage = (int) $perPage;
    $this->totalCount = (int) $totalCount;
  }

  public function offset() {
    return $this->perPage * ($this->currentPage - 1);
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
    if($this->previous_page() != false) {
      $link = "<a href=\"{$url}?page={$this->previous_page()}\" id=\"previous-link\">";
      $link .= "<span class=\"arrows\">&larr;</span> Previous</a>";
    }

    return $link;
  }
  
  public function next_link($url="") {
    $link = "";
    if($this->next_page() != false) {
      $link = "<a href=\"{$url}?page={$this->next_page()}\" id=\"next-link\">";
      $link .= "Next <span class=\"arrows\">&rarr;</span></a>";
    }

    return $link;
  }

  public function number_links($url="") {
    $output = "";
    for($i=1; $i <= $this->total_pages(); $i++) {
      if($i == $this->currentPage) {
        $output .= "<span id=\"selected-link\">{$i}</span>";
      } else {
        $output .= "<a href=\"{$url}?page={$i}\">{$i}</a>";
      }
    }
    return $output;
  }

  public function page_links($url) {
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
