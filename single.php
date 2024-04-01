<?php
/**
 * Single.
 */
get_header();
the_post();
?>
<section class="site-hero">
  <div class="container">
    <h1><?php the_title(); ?></h1>
  </div>
</section>

<section class="site-content">
  <div class="container">
    <?php the_content(); ?>
  </div>
</section>

<?php
get_footer();
