<?php
/**
 * Custom Post Types & Taxonomies
 */

namespace BasicWP;

class Resources {
  public function __construct() {
    add_action('init', [$this, 'register_post_type']);
    add_action('init', [$this, 'register_taxonomy']);
    add_filter('post_type_link', [$this, 'post_type_link'], 10, 2);
  }

  public function register_post_type() {
    register_post_type('resources', [
      'labels' => [
        'name' => 'Resources',
        'singular_name' => 'Resource',
        'menu_name' => 'Resources',
        'name_admin_bar' => 'Resource',
        'add_new' => 'Add New Resource',
        'add_new_item' => 'Add New Resource',
        'edit_item' => 'Edit Resource',
        'new_item' => 'New Resource',
        'view_item' => 'View Resource',
        'search_items' => 'Search Resources',
        'not_found' => 'No resources found',
        'not_found_in_trash' => 'No resources found in Trash',
      ],
      'public' => true,
      'has_archive' => true,
      'rewrite' => ['slug' => 'resources'],
      'supports' => ['title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'custom-fields'],
      'menu_position' => 20,
      'menu_icon' => 'dashicons-hammer',
      'show_in_rest' => true,
    ]);
  }

  public function register_taxonomy() {
    register_taxonomy('resource_type', ['resources'], [
      'labels' => [
        'name' => 'Resource Types',
        'singular_name' => 'Resource Type',
        'search_items' => 'Search Resource Types',
        'all_items' => 'All Resource Types',
        'parent_item' => 'Parent Resource Type',
        'parent_item_colon' => 'Parent Resource Type:',
        'edit_item' => 'Edit Resource Type',
        'update_item' => 'Update Resource Type',
        'add_new_item' => 'Add New Resource Type',
        'new_item_name' => 'New Resource Type Name',
        'menu_name' => 'Resource Types',
      ],
      'public' => true,
      'hierarchical' => true,
      'show_admin_column' => true,
      'rewrite' => [
        'slug' => 'resources',
        'with_front' => false,
        'hierarchical' => true,
      ],
      'show_in_rest' => true,
    ]);
  }

  public function post_type_link($post_link, $post) {
    if ($post->post_type === 'resources') {
      $terms = get_the_terms($post->ID, 'resource_type');
      if ($terms && !is_wp_error($terms)) {
        $term_slug = $terms[0]->slug;

        return home_url("resources/{$term_slug}/{$post->post_name}");
      }
    }

    return $post_link;
  }
}

new Resources();
