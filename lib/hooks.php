<?php

namespace BasicWP;

/**
 * Navigation
 */
function after_setup_theme() {
  add_theme_support('title-tag');
  add_theme_support('menus');
  add_theme_support('editor-styles');
  remove_theme_support('customize-selective-refresh-widgets');
}
add_action('after_setup_theme', __NAMESPACE__ . '\\after_setup_theme');

/**
 * Basic SEO
 *
 * {Site URL}: {Title}
 */
add_filter('wp_title', function ($title) {
  $site_name = get_bloginfo('name');

  return "{$site_name}: {$title}";
});

/**
 * Disable Emoji's
 */
function init() {
  remove_action('wp_head', 'print_emoji_detection_script', 7);
  remove_action('wp_print_styles', 'print_emoji_styles');
  remove_action('admin_print_styles', 'print_emoji_styles');
  remove_action('admin_print_scripts', 'print_emoji_detection_script');
  remove_filter('the_content_feed', 'wp_staticize_emoji');
  remove_filter('comment_text_rss', 'wp_staticize_emoji');
  remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
  wp_dequeue_style('wp-block-library'); // Core block styles
  wp_dequeue_style('wp-block-library-theme'); // Block theme styles
  wp_dequeue_style('global-styles'); // Global styles
  remove_action('wp_enqueue_scripts', 'wp_enqueue_global_styles', 1);
  remove_action('wp_enqueue_scripts', 'wp_enqueue_classic_theme_styles', 1);
  remove_action('wp_head', 'wp_print_styles', 8);
  remove_action('wp_head', 'wp_print_head_scripts', 9);
  remove_action('wp_head', 'wp_generator'); // WordPress version
  remove_action('wp_head', 'rsd_link'); // RSD link
  remove_action('wp_head', 'wlwmanifest_link'); // Windows Live Writer
  remove_action('wp_head', 'wp_shortlink_wp_head'); // Shortlink
  remove_action('wp_head', 'rest_output_link_wp_head'); // REST API link
  remove_action('wp_head', 'wp_oembed_add_discovery_links'); // oEmbed discovery links
  remove_action('wp_head', 'rel_canonical'); // Canonical URL
  remove_action('wp_head', 'wp_resource_hints', 2); // DNS Prefetch
  add_filter('wp_img_tag_add_width_and_height_attr', '__return_false'); // Disable intrinsic image size

  register_nav_menus([
    'header' => 'Header Menu',
    'footer' => 'Footer Menu',
  ]);
}
add_action('init', __NAMESPACE__ . '\\init', 100);

/**
 * Avoiding Assumptions
 */
add_filter('wp_img_tag_add_auto_sizes', '__return_false');
