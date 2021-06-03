<?php
get_header();
?>

	<main id="primary" class="site-main">
	<section class="page-header">
	<div class="container">
		<?php if ( have_posts() ) : ?>
					<h1 class="page-title">
						<?php
						printf( esc_html__( 'Поиск: %s', 'qwe' ), '<span>' . get_search_query() . '</span>' );
						?>
					</h1>
			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				?>
				<div class="search__item">
				<h2><?php the_title(); ?></h2>
				<?php
				the_post();
				?>
				<p>
				<?php
        the_excerpt();
				?>
				</p>
				<a href="<?php the_permalink(); ?>">Перейти</a>
				</div>
				<?php
			endwhile;
		else :
      ?>
      <section class="page-header">
				<div class="container">
					<h1 class="page-title">
						<?php
						printf( esc_html__( 'По запросу ' ));
						echo esc_html__(get_search_query());
						//echo get_search_query(); Не правильно, могут возникнуть проблеммы в защите
						echo " ничего не найдено";
						?>
					</h1>
				</div>
			</section>
			<?php
		endif;
		?>
		</div>
		</section>
	</main><!-- #main -->

<?php
get_footer();
