<?php
/**
* A Simple Category Template
*/

get_header(); ?> 

<section id="primary" class="site-content category-title">
	<div class="container">
		<h2>
			<?php
			// если мы на странице категории
				if( is_category() )
					echo get_queried_object()->name;
			?>
		</h2>
		<div id="content" role="main">
		<?php if ( have_posts() ) : ?>
		<?php
		while ( have_posts() ) : the_post();
		?>
		<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
		<small><?php the_time('F jS, Y') ?> by <?php the_author_posts_link() ?></small>
		<div class="entry">
		<?php the_excerpt(); ?>
		</div>
		<?php endwhile; 
		else: ?>
		<p>Sorry, no posts matched your criteria.</p>
		<?php endif; ?>
		</div>
	</div>
</section>

<?php get_footer(); ?>