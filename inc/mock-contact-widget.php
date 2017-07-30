<?php
/**
 * Mock_Subscriptions_Widget
 *
 * The Jetpack Subscriptions widget requires a connection, so this creates a 'Mock'
 * Subscription widget to let us style it correctly.
 */
class Mock_Subscriptions_Widget extends WP_Widget {
	function __construct() {
		parent::__construct(
			'mock_subscription_widget',
			'Mock Subscription',
			array(
				'classname' => 'mock_subscription_widget',
				'description' => 'Mock of an email signup form to style.',
			)
		);
	}

	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		echo $args['before_title'] . 'Keep Up with WordPress in the Greater Boston Area' . $args['after_title']; ?>

		<form class="description" id="theform" name="theform">
			<div class="primary-group email-group forms-builder-group ui-sortable">
				<div class="row mandatory-email">
					<label for="sub-email">Enter your email address to subscribe.</label>
					<input id="sub-email" name="email" type="text" value="" />
				</div>
				<div class="row">
					<label for="sub-name">Name</label>
					<input id="sub-name" name="name" type="text" value="" />
				</div>
			</div><!-- end of primary -->
			<div class="byline">
				<button class="button" type="submit">Subscribe</button>
			</div>
		</form>
		<?php echo $args['after_widget'];
	}
}

function mock_subscription_widget_init() {
	register_widget( 'Mock_Subscriptions_Widget' );
}
add_action( 'widgets_init', 'mock_subscription_widget_init' );
