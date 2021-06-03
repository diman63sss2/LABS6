
<?php wp_footer(); ?>
<footer class="footer">
  <?php
        if(has_custom_logo()) {
          echo get_custom_logo();
        }else {
          echo '<p>Universal</p>';
        }
      ?>
  <?php
        wp_nav_menu( [
        'theme_location'  => 'header_menu',
        'menu'            => '', 
        'container'       => 'nav', 
        'container_class' => 'header-nav', 
        'menu_class'      => 'header-menu', 
        'echo'            => true,
        'fallback_cb'     => 'wp_page_menu',
        'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
      ] );
      ?>
</footer>
</body>
</html>