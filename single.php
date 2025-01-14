<?php
/**
 * Single Posts
 */
get_header();
the_post();
render_view('single', []);
get_footer();
