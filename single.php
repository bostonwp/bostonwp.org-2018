<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Boston_WordPress
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', get_post_type() );

			if ( 'job_listing' === get_post_type() ) {
				?><div class="navigation post-navigation" role="navigation">
					<div class="nav-links">
						<div class="nav-previous">
							<a href="<?php echo home_url( '/jobs/' )?>">Return to jobs listings</a>
						</div>
					</div>
				</div>
				<?php
			} else {
				the_post_navigation();
			}

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
