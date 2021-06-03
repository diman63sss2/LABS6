<?php
/*
Template Name: Портфол
Template Post Type: portfolio
*/
?>
<?php
get_header();
?>
<section class="portfolio slider">
  <div class="container">
    <h1><?php the_title(); ?></h1>
    <div class="portfolio__preview">
      <img src="<?php echo get_field('изображение_портфолио'); ?>" alt="image" class="portfolio__preview__image">
      <div class="portfolio__preview__content">
        <?php echo get_field('описание_проекта'); ?>
        <a class="portfolio__preview__link" href="<?php echo get_field('ссылка_на_проект'); ?>">Посмотреть</a>
      </div>
    </div>
    <div class="slider-1">
    <?php
      if( have_rows('галерея') ):
          while ( have_rows('галерея') ) : the_row();
              ?>
              <a class="slider__item"><img src="<?php the_sub_field('изображение'); ?>" alt="image"></a>
              <?php
          endwhile;
      endif;
      ?>
    </div>
  </div>
</section>
<?php
get_footer();
?>