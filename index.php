<?php
/**
 * Catch-all View Handler
 */

namespace BasicWP;

get_header();
the_post();
render_view('index', []);
get_footer();
