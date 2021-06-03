<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Universal
 */

if ( ! is_active_sidebar( 'main-sidebar' ) ) {
	return;
}
?>

<aside id="secondary" class="sidebar-front-page bounceInRight wow" data-wow-delay="1s">
	<?php dynamic_sidebar( 'main-sidebar' ); ?>
	<script type="text/javascript" src="https://vk.com/js/api/openapi.js?168"></script>

	<!-- VK Widget -->
	<div id="vk_groups"></div>
	<script type="text/javascript">
	VK.Widgets.Group("vk_groups", {mode: 1}, 171303905);
	</script>
</aside><!-- #secondary -->