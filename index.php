<?php
/**
 * Catch-all View Handler
 */
get_header();
the_post();
render_view('index', []);
get_footer();
