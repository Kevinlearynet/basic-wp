<?php
/**
 * Category List
 *
 * For posts in specific category
 */
get_header();

if (have_posts()) {
  ?>
<section>
  <h1><?php single_cat_title(); ?> Posts</h1>
  <?php while (have_posts()) {
    the_post(); ?>
  <article>
    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <div><?php the_excerpt(); ?></div>
  </article>
  <?php
  the_posts_pagination([
    'mid_size' => 2,
    'prev_text' => 'Previous',
    'next_text' => 'Next',
  ]);
    ?>
  <?php } ?>
</section>
<?php } else { ?>
<p>Sorry, no posts were found.</p>
<?php } ?>
<?php get_footer();
