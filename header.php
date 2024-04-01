<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <title><?php wp_title(); ?></title>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header class="site-header" role="banner">
  <div class="container">
    <a href="<?php echo site_url( '/' ); ?>" class="site-header__logo" aria-label="Link to OSAC Homepage">
      <img src="<?php echo get_stylesheet_directory_uri() . '/assets/img/logo.svg?v=3'; ?>" alt="BASIC SH*T">
    </a>
    <nav class="site-header__nav" role="navigation" aria-label="Main Navigation">
      <?php
      wp_nav_menu( [
        'theme_location' => 'primary',
        'container' => false,
        'depth' => 1,
        'menu' => false,
        'container_class' => false,
        'container_id' => false,
        'container_aria_label' => false,
        'menu_class' => false,
        'menu_id' => false,
        'before' => false,
        'after' => false,
        'link_before' => false,
        'link_after' => false,
        'items_wrap' => '<ul>%3$s</ul>',
      ] );
?>
    </nav>
  </div>
</header>

<main class="site-main">