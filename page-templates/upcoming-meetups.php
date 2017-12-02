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

				<?php
					$local_events = new BostonWP_LocalEvents();
					$events = $local_events->get_all_events();
				?>

				<?php foreach ( $events as $event ) : ?>
					<article class="<?php echo $local_events->get_event_classes( $event ) ?>">
						<header class="entry-header">
							<h2 class="entry-title"><?php $local_events->the_event_fullname( $event ); ?></h2>
							<div class="entry-meta"><?php $local_events->the_event_time( $event ); ?></div>
						</header><!-- .entry-header -->
						<div class="entry-content">
							<?php $local_events->the_event_description( $event ); ?>
							<p><?php $local_events->the_event_link( $event ); ?></p>
						</div>
					</article>
				<?php endforeach; ?>

			<?php endwhile; ?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
