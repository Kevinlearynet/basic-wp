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
  $views_dir = get_stylesheet_directory() . '/views';
  $loader = new FilesystemLoader($views_dir);
  $is_prod = (wp_get_environment_type() === 'production');

  $twig = new Environment($loader, [
    'cache' => $is_prod ? WP_CONTENT_DIR . '/cache/twig' : false,
    'debug' => !$is_prod,
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
  $twig->addGlobal('charset', new Markup(get_bloginfo('charset'), 'UTF-8'));
  $twig->addGlobal('language_attributes', new Markup(get_language_attributes('html'), 'UTF-8'));
  $twig->addGlobal('primary_nav', wp_get_nav_menu_items('primary'));

  // Functions
  $twig->addFunction(new TwigFunction('the_title', function () {
    return get_the_title();
  }, ['is_safe' => ['html']]));

  $twig->addFunction(new TwigFunction('the_content', function () {
    ob_start();
    the_content();

    return ob_get_clean();
  }, ['is_safe' => ['html']]));

  $twig->addFunction(new TwigFunction('get_header', function ($input) {
    ob_start();
    get_header();

    return ob_get_clean();
  }, ['is_safe' => ['html']]));

  $twig->addFunction(new TwigFunction('wp_title', function ($sep = '&raquo;') {
    return wp_title($sep, false);
  }, ['is_safe' => ['html']]));

  $twig->addFunction(new TwigFunction('wp_head', function ($sep = '&raquo;') {
    ob_start();
    wp_head();

    return ob_get_clean();
  }, ['is_safe' => ['html']]));

  $twig->addFunction(new TwigFunction('body_class', function ($css_class = '') {
    $body_class = get_body_class($css_class);

    remove_from_array('no-customize-support', $body_class);

    return implode(' ', $body_class);
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
