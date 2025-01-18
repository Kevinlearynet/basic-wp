<?php
/**
 * Search results
 */

namespace BasicWP;

get_header();
the_post();
render_view('search', []);
get_footer();
