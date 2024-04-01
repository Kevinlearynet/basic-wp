<?php
/**
 * Page Not Found.
 */
get_header();
$url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>

<section class="site-content">
  <div class="container">
    <h1>Page Not Found</h1>
    <article <?php post_class(); ?>>
      <p>Nothing exists at <strong><?php echo $url; ?></strong>, try another address or use the site search to find what you're looking for.</p>
    </article>
  </div>
</section>

<?php
get_footer();
