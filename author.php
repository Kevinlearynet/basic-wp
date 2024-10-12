<?php
/**
 * Author List
 *
 * List of posts by author
 */
get_header();

if (have_posts()) {
  ?>
<section>
  <h1><?php echo get_the_author(); ?>'s Posts</h1>
  <?php while (have_posts()) {
    the_post(); ?>
  <article>
    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <div><?php the_excerpt(); ?></div>
  </article>
  <?php } ?>
  <?php
  the_posts_pagination([
    'mid_size' => 2,
    'prev_text' => 'Previous',
    'next_text' => 'Next',
  ]);
  ?>
</section>
<?php } else { ?>
<p>Sorry, no posts were found.</p>
<?php } ?>
<?php get_footer();
