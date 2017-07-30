<?php
/**
 * The sidebar containing the bottom front page widgets
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Boston_WordPress
 */

if ( ! is_active_sidebar( 'sidebar-front-2' ) ) {
	return;
}
?>

<aside id="sidebar-front-2" class="widget-area">
	<?php dynamic_sidebar( 'sidebar-front-2' ); ?>
</aside><!-- #sidebar-front-2 -->
