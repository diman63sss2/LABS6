<?php
/*
Template Name: Гошок с мёдом
*/
?>
<?php
get_header();
?>
<section>
  <div class="container">
    <div class="container__columns">
      <div class="container__column">
        <p>
          количество пчёл
        </p>
        <input value="2" type="number" class="fly__value">
        <p>
          Объём горшка
        </p>
        <input  value="10" type="number" class="gor__value">
        <div class="flys">
          
        </div>
        <button class="button_play">play</button>
        <div class="timer">
          <span>0</span> секунд
        </div>
      </div>
      <div class="container__column">
        <div class="gorshok">
          <span class="span">
          <span>0</span>%
          </span>
          <div class="after"></div>
        </div>
        <div class="party__vini">
          <div class="piatochok">
            <div class="piatochok__scale">
              <div class="piatochok__scale__value"></div>
            </div>
            <img  src="https://upload.wikimedia.org/wikipedia/ru/d/dd/Pigletdisney.jpg">
          </div>
          <div class="vinipuh">
            <div class="vinipuh__scale">
              <div class="vinipuh__scale__value"></div>
            </div>
            <img src="https://static.kupindoslike.com/Geco-art-dekorativna-nalepnica-VINI-PU_slika_XL_22224557.jpg">
          </div>
        </div>
        <button class="see__log">
          see log
        </button>
        <button class="savelog">
          savelog
        </button>
        <div class="log">

        </div>
        Последние 3 лога
        <?php
          $args = array(
            'number'  => 3,
            'orderby' => 'comment_date',
            'order'   => 'DESC',
            'status'  => 'approve',
            'type'    => 'comment',
          );

          if( $comments = get_comments( $args ) ){
            foreach( $comments as $comment ){
              echo '<textarea>' . $comment->comment_content .'</textarea>';
            }
          }

          /*
          Данные в объекте $comment
          stdClass Object
          (
            [comment_ID] => 9727
            [comment_post_ID] => 477
            [comment_author] => Andrew
            [comment_author_email] => mail@gmail.com
            [comment_author_url] => 
            [comment_author_IP] => 178.45.177.200
            [comment_date] => 2015-22-01 00:27:04
            [comment_date_gmt] => 2015-22-28 21:27:04
            [comment_content] => текст коммента
            [comment_karma] => 0
            [comment_approved] => 1
            [comment_agent] => Mozilla/5.0 (Windows NT 6.1; WOW64; rv:36.0) Gecko/20100101 Firefox/36.0
            [comment_type] => 
            [comment_parent] => 9724
            [user_id] => 313
          )
          */
        ?>
        <?php comment_form(); ?>
      </div>
    </div>
  </div>
</section>
<?php 
get_footer();
?>