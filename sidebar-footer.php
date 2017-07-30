<?php
/**
 * The sidebar containing the bottom widgets (on all pages)
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Boston_WordPress
 */

if ( ! is_active_sidebar( 'sidebar-footer' ) ) {
	return;
}
?>

<aside id="sidebar-footer" class="widget-area footer-widget-area">
	<div class="container">
		<?php dynamic_sidebar( 'sidebar-footer' ); ?>
	</div>
</aside><!-- #sidebar-footer -->
