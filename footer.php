</div>
</main>

<footer class="site-footer">
  <div class="site-footer__inner">
    <nav class="site-footer__nav" role="navigation" aria-label="Sitemap Navigation">
      <?php
      wp_nav_menu( [
        'theme_location' => 'footer',
        'container' => false,
        'depth' => 1,
        'menu' => false,
        'container_class' => false,
        'container_id' => false,
        'container_aria_label' => false,
        'menu_class' => false,
        'menu_id' => false,
        'before' => false,
        'after' => false,
        'link_before' => false,
        'link_after' => false,
        'items_wrap' => '<ul>%3$s</ul>',
      ] );
      ?>
    </nav>
    <p class="site-footer__copyright">&copy; <?php echo date( 'Y' ); ?> <?php bloginfo( 'name' ); ?>, All Rights Reserved.</p>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>