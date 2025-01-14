<?php
/**
 * Page Not Found
 */
get_header();
the_post();
render_view('404', []);
get_footer();
