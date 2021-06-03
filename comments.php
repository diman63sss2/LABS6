<?php
if ( post_password_required() ) {
	return;
}
?>
<div id="comments" class="comments-area">
	<?php
	if ( have_comments() ) :
		?>
		<h2 class="comments-title">
			<?php
			$universal_comment_count = get_comments_number();
			if ( '1' === $universal_comment_count ) {
				printf(
					esc_html__( '&ldquo;%1$s&rdquo;', 'universal' ),
					'<span>' . wp_kses_post( get_the_title() ) . '</span>'
				);
			} else {
				printf( 
					esc_html( _nx( '%1$s коментария &ldquo;%2$s&rdquo;', '%1$s коментария &ldquo;%2$s&rdquo;', $universal_comment_count, 'comments title', 'universal' ) ),
					number_format_i18n( $universal_comment_count ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					'<span>' . wp_kses_post( get_the_title() ) . '</span>'
				);
			}
			?>
		</h2><!-- .comments-title -->

		<?php the_comments_navigation(); ?>

		<ul class="comment-list">
			<?php
			wp_list_comments(
				array(
					'style'      => 'ul',
					'short_ping' => true,
				)
			);
			?>
		</ul><!-- .comment-list -->

		<?php
		the_comments_navigation();
		if ( ! comments_open() ) :
			?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'universal' ); ?></p>
			<?php
		endif;

	endif; 
	comment_form();
	?>

</div><!-- #comments -->
