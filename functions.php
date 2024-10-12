<?php
/**
 * General stuff not in templates
 */

/**
 * Nav Menus
 */
function kevinlearynet_nav_menu() {
  register_nav_menu('primary', 'Primary Menu');
}
add_action('after_setup_theme', 'kevinlearynet_nav_menu');

/**
 * Frontend CSS/JS
 */
function bs_frontend_scripts() {
  wp_dequeue_style('style');

  $version = filemtime(get_stylesheet_directory() . '/theme.css');
  wp_enqueue_style('kevinlearynet-theme-css', get_stylesheet_directory_uri() . '/theme.css', [], $version);

  // JS
  $version = filemtime(get_stylesheet_directory() . '/theme.js');
  wp_enqueue_script('kevinlearynet-theme-js', get_stylesheet_directory_uri() . '/theme.js', ['jquery'], $version, true);
}
add_action('wp_enqueue_scripts', 'bs_frontend_scripts', 0);
