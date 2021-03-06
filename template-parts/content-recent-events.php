<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Boston_WordPress
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php the_post_thumbnail( '3up-thumbnail' ); ?>
	<header class="entry-header">
		<?php
			the_title(
				'<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">',
				'</a></h3>'
			);
		?>

		<div class="entry-meta">
			<?php bostonwp_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_excerpt(); ?>
	</div><!-- .entry-content -->

	<div class="entry-link">
		<?php bostonwp_view_post_link(); ?> &rarr;
	</div><!-- .entry-link -->
</article><!-- #post-<?php the_ID(); ?> -->
