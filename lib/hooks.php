<?php
/**
 * Hooks
 *
 * Action and filter hooks
 */

/**
 * Nav Menus
 *
 * Setup two basic menus to manage with the Appearance > Menus UI
 */
function bs_nav_menus() {
  register_nav_menu( 'primary', 'Primary Menu' );
  register_nav_menu( 'footer', 'Footer Menu' );
}
add_action( 'after_setup_theme', 'bs_nav_menus' );
