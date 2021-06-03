<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Universal
 */

if ( ! is_active_sidebar( 'main-sidebar-2' ) ) {
	return;
}
?>

<aside id="secondary-2" class="sidebar-2 bounceInRight wow" data-wow-delay="1s">
	<?php dynamic_sidebar( 'main-sidebar-2' ); ?>
</aside><!-- #secondary -->