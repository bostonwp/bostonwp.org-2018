<?php
/**
 * The sidebar containing the top front page widgets
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Boston_WordPress
 */

if ( ! is_active_sidebar( 'sidebar-front-1' ) ) {
	return;
}
?>

<aside id="sidebar-front-1" class="widget-area front-page-widget-area">
	<div class="container">
		<?php dynamic_sidebar( 'sidebar-front-1' ); ?>
	</div>
</aside><!-- #sidebar-front-1 -->
