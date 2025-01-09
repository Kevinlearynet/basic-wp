<?php

namespace BasicWP;

class Enqueue {
  /**
   * Initialize hooks to enqueue scripts and styles.
   */
  public function __construct() {
    add_action('wp_enqueue_scripts', [$this, 'enqueue_frontend_assets']);
    add_action('admin_enqueue_scripts', [$this, 'enqueue_backend_assets']);
  }

  /**
   * Enqueue frontend CSS and JS files.
   */
  public function enqueue_frontend_assets() {
    $theme_dir = get_stylesheet_directory();
    $theme_uri = get_stylesheet_directory_uri();

    // CSS
    $css_path = '/static/dist/theme.css';
    if (file_exists($theme_dir . $css_path)) {
      $version = filemtime($theme_dir . $css_path);
      wp_enqueue_style('basicwp-theme-css', $theme_uri . $css_path, [], $version);
    }

    // JS
    $js_path = '/static/dist/theme.js';
    if (file_exists($theme_dir . $js_path)) {
      $version = filemtime($theme_dir . $js_path);
      wp_enqueue_script('basicwp-theme-js', $theme_uri . $js_path, ['jquery'], $version, true);
    }
  }

  /**
   * Enqueue backend (admin/editor) CSS and JS files.
   *
   * @param string $hook the current admin page hook
   */
  public function enqueue_backend_assets($hook) {
    $theme_dir = get_stylesheet_directory();
    $theme_uri = get_stylesheet_directory_uri();

    // Editor CSS
    $editor_css_path = '/static/dist/editor.css';
    if (file_exists($theme_dir . $editor_css_path)) {
      $version = filemtime($theme_dir . $editor_css_path);
      wp_enqueue_style('basicwp-editor-css', $theme_uri . $editor_css_path, [], $version);
    }

    // Admin CSS
    $admin_css_path = '/static/dist/admin.css';
    if (file_exists($theme_dir . $admin_css_path)) {
      $version = filemtime($theme_dir . $admin_css_path);
      wp_enqueue_style('basicwp-admin-css', $theme_uri . $admin_css_path, [], $version);
    }

    // Admin JS
    $admin_js_path = '/static/dist/admin.js';
    if (file_exists($theme_dir . $admin_js_path)) {
      $version = filemtime($theme_dir . $admin_js_path);
      wp_enqueue_script('basicwp-admin-js', $theme_uri . $admin_js_path, ['jquery'], $version, true);
    }
  }
}

// Initialize the Enqueue class.
new Enqueue();
