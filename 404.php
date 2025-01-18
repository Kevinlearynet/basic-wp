<?php
/**
 * Page Not Found
 */

namespace BasicWP;

get_header();
the_post();
render_view('404', []);
get_footer();
