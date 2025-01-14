<?php
/**
 * Single Pages
 */
get_header();
the_post();
render_view('page', []);
get_footer();
