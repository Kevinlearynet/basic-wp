<?php
/**
 * Single Pages
 */

namespace BasicWP;

get_header();
the_post();
render_view('page', []);
get_footer();
