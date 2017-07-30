<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Boston_WordPress
 */

$events_query = new WP_Query( array (
	'posts_per_page' => 3,
	'category_name' => 'meeting-minutes',
) );

if ( $events_query->have_posts() ) : ?>

<div class="container site-events">
	<h2 class="page-title">Catch Up on Recent Events</h2>
	<div class="site-events-list">
		<?php while( $events_query->have_posts() ) {
			$events_query->the_post();
			get_template_part( 'template-parts/content', 'recent-events' );
		} ?>
	</div>
</div>

<?php
endif;
wp_reset_postdata();
