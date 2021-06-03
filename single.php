<?php
/*
Template Name: траница записи
*/
?>
<?php get_header(); ?>
<section class="post-page">
  <div class="post-page-preview">
    <h1 class="post-page-title">
        <?php the_title(); ?>
    </h1>	
    <?php
      the_post_thumbnail();
    ?>
  </div>
  <div class="container container-post">
   
    <?php
      the_content();
    ?>
    <?php get_sidebar('main-sidebar-2'); ?>
  </div>
</section>	
<div class="container">
  <?php comments_template(); ?>
</div>


<?php
get_footer();