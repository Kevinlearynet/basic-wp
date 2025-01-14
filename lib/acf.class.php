<?php

namespace BasicWP;

/*
 * Local JSON for ACF Fields
 */
class ACF {
  public $path;

  /**
   * Hook into ACF.
   */
  public function __construct() {
    $this->path = get_stylesheet_directory() . '/config';
    add_filter('acf/settings/load_json', [$this, 'load_json']);
    add_filter('acf/settings/save_json', [$this, 'save_json']);
  }

  /**
   * Save JSON.
   *
   * @param mixed $path
   */
  public function save_json($path) {
    return $this->path;
  }

  /**
   * Load JSON.
   *
   * @param mixed $paths
   */
  public function load_json($paths) {
    return [$this->path];
  }
}

if (function_exists('get_fields')) {
  new ACF();
}
