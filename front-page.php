<?php

namespace BasicWP;

get_header();
the_post();
render_view('front_page', []);
get_footer();
