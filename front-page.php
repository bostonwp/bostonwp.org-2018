<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Boston_WordPress
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<?php get_sidebar( 'front-top' ); ?>

			<?php get_template_part( 'template-parts/list', 'recent-events' ); ?>

			<?php while ( have_posts() ) : the_post(); ?>
			<div class="site-main-callout">
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'container' ); ?>>
					<div class="entry-content">
						<?php the_content(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-<?php the_ID(); ?> -->
			</div>
			<?php endwhile; ?>

			<?php get_sidebar( 'front-footer' ); ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
