<?php
/**
 * Single Posts
 */

namespace BasicWP;

get_header();
the_post();
render_view('single', []);
get_footer();
