<?php
/**
 * The sidebar containing the main widget area for full-width pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Boston_WordPress
 */

if ( ! is_active_sidebar( 'sidebar-full-width' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area content-widget-area">
	<?php dynamic_sidebar( 'sidebar-full-width' ); ?>
</aside><!-- #secondary -->
