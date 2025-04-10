<?php

namespace BasicWP;

use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;
use Twig\Markup;
use Twig\TwigFunction;

/**
 * Render a Twig template within a WordPress template file.
 *
 * @param string $template the Twig template file (relative to the views directory)
 * @param array  $context  context variables to pass to the Twig template
 */
function render_view($template, $context = []) {
  global $post;

  $views_dir = get_stylesheet_directory() . '/views';
  $loader = new FilesystemLoader($views_dir);
  $is_prod = (wp_get_environment_type() === 'production');

  $twig = new Environment($loader, [
    'cache' => false,
    'auto_reload' => true,
    'debug' => true,
  ]);

  // Extensions
  if (!$is_prod) {
    $twig->addExtension(new DebugExtension());
  }

  // Global context
  $twig->addGlobal('site_name', get_bloginfo('name'));
  $twig->addGlobal('site_description', get_bloginfo('description'));
  $twig->addGlobal('site_url', get_bloginfo('url'));
  $twig->addGlobal('theme_dir', get_stylesheet_directory());
  $twig->addGlobal('theme_url', get_stylesheet_directory_uri());
  $twig->addGlobal('primary_nav', wp_get_nav_menu_items('primary'));

  $title = is_singular() ? get_the_title() : get_the_archive_title();
  if ($title) {
    $twig->addGlobal('title', $title);
  }

  $thumbnail = get_the_post_thumbnail('full');
  if ($thumbnail) {
    $twig->addGlobal('thumbnail', $thumbnail);
  }

  $content = get_the_content();
  if ($content) {
    $twig->addGlobal('content', new Markup(apply_filters('the_content', $content), 'UTF-8'));
  }

  $date = get_the_date();
  if ($date) {
    $twig->addGlobal('date', $date);
  }

  // ACF
  if (function_exists('get_fields')) {
    $acf = get_fields();
    $twig->addGlobal('acf', $acf);
  }

  // Functions
  $twig->addFunction(new TwigFunction('the_title', function () {
    return get_the_title();
  }, ['is_safe' => ['html']]));

  $twig->addFunction(new TwigFunction('the_content', function () {
    ob_start();
    the_content();

    return ob_get_clean();
  }, ['is_safe' => ['html']]));

  // Load view and render
  if (!str_ends_with($template, '.twig')) {
    $template .= '.twig';
  }
  $view = $twig->load($template);

  echo $view->render($context);
}

/**
 * Remove From Array by Value
 */
function remove_from_array($value, &$array) {
  if (($key = array_search($value, $array)) !== false) {
    unset($array[$key]);
  }
}
