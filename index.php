<?php
/**
 * Home (blog posts list)
 */

namespace BasicWP;

get_header();

// Posts loop
$_posts = [];

if (have_posts()) {
  while (have_posts()) {
    the_post();

    $category = [];
    $terms = wp_get_post_categories(get_the_ID(), ['fields' => 'all']);
    foreach ($terms as &$cat) {
      $category = [
        'name' => $cat->name,
        'slug' => $cat->slug,
        'url' => get_category_link($cat->term_id),
      ];
      break;
    }

    $thumbnail_id = get_post_thumbnail_id(get_the_ID());
    $img_alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
    $img_alt = $img_alt ? $img_alt : get_the_title();

    $_posts[] = [
      'title' => get_the_title(),
      'url' => get_permalink(),
      'excerpt' => wp_strip_all_tags(get_the_excerpt(), true),
      'img' => [
        'url' => get_the_post_thumbnail_url(get_the_ID(), 'full'),
        'alt' => $img_alt,
      ],
      'author' => [
        'name' => get_the_author(),
        'url' => get_author_posts_url(get_the_author_meta('ID')),
      ],
      'date' => [
        'published' => get_the_date(),
        'modified' => get_the_modified_date(),
      ],
      'category' => $category,
    ];
  }
}

if (isset($_GET['dump'])) {
  echo '<pre>';
  print_r($_posts);
  echo '</pre>';
}

// Output the result (you can remove this if you don't want it displayed)
render_view('index', [
  'posts' => $_posts,
]);
get_footer();
