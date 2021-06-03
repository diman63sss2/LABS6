<?php
/*
Template Name: Страница портфолио
*/
?>
<?php
get_header();
?>
<section class="portfolio slider">
  <div class="container">
    <h1><?php the_title(); ?></h1>
    <div class="portfolio_items">
      <?php		
      global $post;

      $query = new WP_Query( [
        'posts_per_page' => -1,
        'post_type' => 'portfolio',
      ] );

      if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
          $query->the_post();
          ?>
          <a href="<?php echo get_the_permalink(); ?>" class="portfolio_item">
            <h3><?php the_title(); ?></h3>
            <img src="<?php echo get_field('изображение_портфолио'); ?>" alt="image">
          </a>
          <!-- Вывода постов, функции цикла: the_title() и т.д. -->
          <?php 
        }
      } else {
        // Постов не найдено
      }

      wp_reset_postdata(); // Сбрасываем $post
      ?>
    </div>
  </div>
</section>
<?php
get_footer();
?>