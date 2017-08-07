<?php
/**
 * The template for displaying upcoming meetups
 *
 * Template Name: Upcoming Meetups
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Boston_WordPress
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<?php while ( have_posts() ) : the_post(); ?>

				<header class="page-header">
					<h1 class="page-title"><?php the_title(); ?></h1>
					<div class="archive-description"><?php the_content(); ?></div>
				</header><!-- .page-header -->

			<?php endwhile; ?>

			<article id="post-##" <?php post_class(); ?>>
				<header class="entry-header">
					<h2 class="entry-title">Event title</h2>
				</header><!-- .entry-header -->
				<div class="entry-content">
					<p>This is an event. Pulled from meetup.com?</p>
				</div>
			</article>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
