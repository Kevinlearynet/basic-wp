<?php
/**
 * Assets
 */

/**
 * Frontend CSS/JS
 */
function bs_frontend_scripts() {

  // Autoversioned CSS
  wp_dequeue_style( 'style' );
  $version = filemtime( get_stylesheet_directory() . '/assets/dist/theme.css' );
  wp_enqueue_style( 'bs-theme', get_stylesheet_directory_uri() . '/assets/dist/theme.css', [], $version );

  // Autoversioned JS
  $version = filemtime( get_stylesheet_directory() . '/assets/js/theme.js' );
  wp_enqueue_script( 'bs-theme', get_stylesheet_directory_uri() . '/assets/js/theme.js', ['jquery'], $version, true );
}
add_action( 'wp_enqueue_scripts', 'bs_frontend_scripts', 0 );

/**
 * Admin CSS/JS
 */
function bs_backend_scripts() {
  $version = filemtime( get_stylesheet_directory() . '/assets/dist/admin.css' );
  wp_enqueue_style( 'bs-admin', get_stylesheet_directory_uri() . '/assets/dist/admin.css', [], $version );
}
add_action( 'admin_enqueue_scripts', 'bs_backend_scripts', 0 );
