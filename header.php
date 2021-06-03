<!DOCTYPE html>
<html <?php language_attributes(); ?> >
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
  <?php wp_head(); ?>
  <script>new WOW().init();</script>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header class="header">
  <div class="container">
    <div class="header-wrapper">
      <?php
        if(has_custom_logo()) {
          echo get_custom_logo();
        }else {
          echo '<p>Universal</p>';
        }
      ?>
      <div class="burger__button">
        <div class="burger__button__line"></div>
      </div>
      <div class="burger_menu">
        <div class="cross_burger"></div>
        <a href="<?php echo get_page_link(109); ?>" class="lab_link">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/images/lab_link.jpg" alt="">
        </a>
        <?php
          wp_nav_menu( [
            'theme_location'  => 'header_menu',
            'menu'            => '', 
            'container'       => 'nav', 
            'container_class' => 'header-nav-burger', 
            'menu_class'      => 'header-burger-menu', 
            'echo'            => true,
            'fallback_cb'     => 'wp_page_menu',
            'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
          ] );
        ?>
      </div>
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
      <a href="<?php echo get_page_link(109); ?>" class="lab_link">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/lab_link.jpg" alt="">
      </a>
      <?php echo get_search_form(); ?>
    </div>
    <!-- /.header-wrapper -->
  </div>
</header>