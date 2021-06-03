<?php
/*
Template Name: Главная
*/
?>
<?php
get_header();
?>
<main class="front-page-header">
  <div class="container">
    <div class="hero">
      <div class="left">
        <?php
        global $post;

        $myposts = get_posts([ 
          'numberposts' => 1,
          'post__in' => [111]
        ]);
        if( $myposts ){
          foreach( $myposts as $post ){
            setup_postdata( $post );
	    	?>
        <?php $author_id = get_the_author_meta('ID'); ?>
        <img src="<?php the_post_thumbnail_url();?>" alt="<?php echo mb_strimwidth(get_the_title(), 0, 60, "...") ; ?>" class="post-thumb">
        <a href="<?php echo get_author_posts_url($author_id); ?>" class="authore">
          <img src="<?php echo get_avatar_url($author_id); ?>" alt="<?php echo get_the_author(); ?>" class="avatar">
          <div class="authore-bio">
              <span class="authore-name"><?php echo get_the_author(); ?></span>
              <span class="authore-rank">Разработчик</span>
          </div>
        </a>
        <div class="post-text">
          <?php
            foreach(get_the_category() as $category) {
              echo '<ul class="post-categories"><li><a href="'. esc_url(get_category_link($category)) .'" style="color:' . get_field('цвет') .'">' . esc_html($category -> name) .'</a></li></ul>';
            }
          ?>
          <h2 class="post-title">
            <?php echo mb_strimwidth(get_the_title(), 0, 60, "...") ; ?>
          </h2>
          <a href="<?php echo get_the_permalink(); ?>" class="more">
            Читать далее
          </a>
        </div>
        <?php 
        }
      } else {
        // Постов не найдено
      }
      wp_reset_postdata(); // Сбрасываем $post
      ?>
      </div>
      <!-- /.left -->
      <div class="right">
        <h3 class="recommend">
          Рекомендуем
        </h3>
        <ul class="posts-list">
          <?php
          global $post;

          $myposts = get_posts([ 
            'numberposts' => 5,
            'offset' => 1,
            'category_name' => 'css, html, javascript, web-design',
            'category__not_in' => 26
          ]);

          if( $myposts ){
            foreach( $myposts as $post ){
              setup_postdata( $post );
          ?>
          <li class="post">
            <?php
            foreach(get_the_category() as $category) {
              echo '<ul class="post-categories"><li><a href="'. esc_url(get_category_link($category)) .'" style="color:' . get_field('цвет') .'">' . esc_html($category -> name) .'</a></li></ul>';
            }
            ?>
            <h4 class="post-title">
              <a href="<?php echo get_the_permalink(); ?>">
                <?php echo mb_strimwidth(get_the_title(), 0, 60, "...") ; ?>
              </a>
            </h4>
          </li>
          <?php 
            }
          } else {
            // Постов не найдено
          }
          wp_reset_postdata(); // Сбрасываем $post
          ?>
        </ul>
      </div>
      <!-- /.right -->
    </div>
    <!-- /.hero -->
  </div>
  <!-- /.container -->
</main>

<div class="container">  
  <div class="main-grid">
    <ul class="article-grid">
      <?php		
        global $post;
        // Формируем запрос в базу данных
        $query = new WP_Query( [
          //Получаем 7 постов
          'posts_per_page' => 7,
          'orderby'        => 'comment_count',
          'category__not_in' => 26
        ] );
        // Проверяем есть ли посты
        if ( $query->have_posts() ) {
          //Создаём переменную-счётчик постов
          $cnt = 0;
          // Если посты есть выводим их
          while ( $query->have_posts() ) {
            $query->the_post();
            $cnt++;
            switch ($cnt) {
              case 1 :
                ?>
                <li class="article-grid-item article-grid-item-1 bounceInLeft wow" data-wow-delay="0.5s">
                  <a href="<?php the_permalink(); ?>" class="article-grid-permalink">
                    <div class="content">
                      <span class="article-category-name">
                      <?php 
                      $category = get_the_category();
                        echo $category[0]->name; 
                      ?>
                      </span>
                      <h4 class="article-grid-title">
                        <?php echo mb_strimwidth(get_the_title(), 0, 80, "...") ; ?>
                      </h4>
                      <p class="article-grid-excerpt">
                        <?php echo mb_strimwidth( get_the_excerpt(), 0, 130, "..."); ?>
                      </p>
                    </div>
                    <?php $author_id = get_the_author_meta('ID'); ?>
                    <div class="article-gride-info">
                      <img src="<?php echo get_avatar_url($author_id); ?>" alt="<?php echo get_the_author(); ?>" class="authore-avatar">
                      <span class="authore-name"> <strong><?php echo get_the_author(); ?></strong>: <?php echo mb_strimwidth(get_the_author_meta( 'description'), 0, 34, "..."); ?> </span>
                      <div class="comments">
                        <img src="<?php echo get_template_directory_uri() . '/assets/images/Comment.png' ?>" alt="icon: comment" class="comments-icon">
                        <span class="comments-counter">
                          <?php comments_number('0', '1', '%'); ?>
                        </span>
                      </div>
                    </div>
                  </a>
                </li>
                <?php
              break;
              case 2 :
                ?>
                <li class="article-grid-item article-grid-item-2  bounceInLeft wow" data-wow-delay="0.5s">
                  <img class="article_thumnail" src="<?php the_post_thumbnail_url();?>" alt="<?php echo mb_strimwidth(get_the_title(), 0, 50, "...") ; ?>">
                  <a href="<?php the_permalink(); ?>" class="article-grid-permalink">
                    <span class="teg">
                      <?php $posttags = get_the_tags();
                      if($posttags) {
                        echo $posttags[0]->name . ' ';
                      }
                      ?>
                    </span>
                    <div class="content">
                      <span class="category-name">
                        <?php $category = get_the_category();
                          echo $category[0]->name;
                        ?>
                      </span>
                      <h4 class="article-grid-title">
                        <?php echo mb_strimwidth(get_the_title(), 0, 80, "...") ; ?>
                      </h4>
                      <?php $author_id = get_the_author_meta('ID'); ?>
                      <div class="article-grid-info">
                        <img src="<?php echo get_avatar_url($author_id); ?>" alt="<?php echo get_the_author(); ?>" class="authore-avatar">
                        <div class="comments">
                          <span class="authore-name"><?php echo get_the_author(); ?></span>
                          <span class="article-date"><?php the_time('j F') ?></span>
                          <img src="<?php echo get_template_directory_uri() . '/assets/images/comment-white.png' ?>" alt="icon: comment" class="comments-icon">
                          <span class="comments-counter">
                            <?php comments_number('0', '1', '%'); ?>
                          </span>
                          <img src="<?php echo get_template_directory_uri() . '/assets/images/Heart.png' ?>" alt="icon: comment" class="like-icon">
                          <span class="like-counter">
                            <?php comments_number('0', '1', '%'); ?>
                          </span>
                        </div>
                      </div>
                      
                    </div>
                  </a>
                </li>
                <?php
              break;
              case 3 :
                ?>
                <li class="article-grid-item article-grid-item-3  bounceInLeft wow" data-wow-delay="0.5s">
                  <a href="<?php the_permalink(); ?>" class="article-grid-permalink">
                    <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="article img" class="article-thumb">
                    <h4 class="article-grid-title">
                      <?php echo mb_strimwidth(get_the_title(), 0, 42, '...') ?>
                    </h4>
                  </a>
                </li>
                <?php
              break;
              default:
                ?>
                
                <li class="article-grid-item article-grid-item-default  bounceInLeft wow" data-wow-delay="0.5s">
                  <a href="<?php the_permalink(); ?>" class="article-grid-permalink">
                    <h4 class="article-grid-title">
                      <?php echo mb_strimwidth(get_the_title(), 0, 22, '...') ?>
                    </h4>
                    <p class="article-grid-excerpt">
                      <?php echo mb_strimwidth(get_the_excerpt(), 0, 80, '...'); ?>
                    </p>
                    <span class="article-date"><?php the_time('j F') ?></span>
                  </a>
                </li>
                <?php
              break;

            }
            ?>
            <!-- Вывода постов, функции цикла: the_title() и т.д. -->
            <?php 
          }
        } else {
          // Постов не найдено
        }
        wp_reset_postdata(); // Сбрасываем $post
      ?>
    </ul>
    <?php get_sidebar('main-sidebar'); ?>
  </div>
</div>
<!-- /.container -->

<section class="slider">
  <div class="container slider-1  bounceInLeft wow" data-wow-delay="0.5s">
    <?php
        global $post;

        $myposts = get_posts([ 
          'numberposts' => 3,
          'category_name' => 'css, html, javascript, web-design',
          'category__not_in' => 26
        ]);
        if( $myposts ){
          foreach( $myposts as $post ){
            setup_postdata( $post );
	    	?>
    <a class="slider__item" href="<?php echo get_permalink(); ?>">
      <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="image">

    </a>
    <?php 
      }
    } else {
      // Постов не найдено
    }
    wp_reset_postdata(); // Сбрасываем $post
    ?>
  </div>
</section>


		
<?php
get_footer();
