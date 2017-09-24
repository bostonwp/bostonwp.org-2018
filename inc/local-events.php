<?php
/**
 * Functions for the Upcoming Local Events template
 */

/**
 * Container class to handle fetch+cache of meetup.com data.
 */
class BostonWP_LocalEvents {
	private $base_url = 'http://api.meetup.com/:name:/events/';
	private $groups = array(
		'WordpressDevSeacoast',
		'boston-wordpress-meetup',
		'Big-Media-Enterprise-WordPress-Meetup-Boston',
		'WordPressRI',
		'Southern-Maine-WordPress-Meetup',
		'Southcoast-WordPress-Meetup',
		'Brattleboro-WordPress-Meetup',
		'WordPressDevNH',
	);

	function __construct( $groups = false ) {
		if ( $groups ) {
			$this->groups = $groups;
		}

		$options = get_option( 'vs_meet_options' );
		$this->api_key = $options['vs_meetup_api_key'];
	}

	/**
	 * Get list of events for each group, merged into one, sorted by upcoming date.
	 *
	 * @param  $force       boolean  Whether to bypass caching when fetching data
	 * @return  array  Event data
	 */
	public function get_all_events( $force = false ) {
		$all_events = [];
		foreach ( $this->groups as $group ) {
			$events = $this->get_group_list( $group, $force );
			if ( $events ) {
				$all_events = array_merge( $all_events, $events );
			}
		}

		usort( $all_events, function( $a, $b ) {
			$a_time = intval( $a->time / 1000 + $a->utc_offset / 1000 );
			$b_time = intval( $b->time / 1000 + $b->utc_offset / 1000 );
			return $a_time > $b_time;
		} );

		return array_filter( $all_events, function( $e ) {
			$month_ago = time() - MONTH_IN_SECONDS;
			$event_time = intval( $e->time / 1000 + $e->utc_offset / 1000 );
			return $event_time > $month_ago;
		} );
	}

	/**
	 * Given a group name, grab upcoming or past events from the meetup.com API
	 *
	 * @param  $group_name  string   The group name pulled from the URL
	 * @param  $force       boolean  Whether to bypass caching when fetching data
	 * @return  array  Event data
	 */
	public function get_group_list( $group_name, $force = false ) {
		// Enforce a max-length of 45 characters
		$transient = 'events_' . substr( $group_name, 0, 38 );
		if ( ! $force && $events = get_transient( $transient ) ) {
			return $events;
		}

		$args = array(
			'key'    => $this->api_key,
			'page'   => 5,
			'scroll' => 'future_or_past',
			'fields' => 'simple_html_description',
		);
		$url = str_replace( ':name:', $group_name, $this->base_url );
		$url = add_query_arg( $args, $url );

		$event_response = wp_remote_get( $url );
		if ( is_wp_error( $event_response ) ) {
			if ( WP_DEBUG ) {
				echo 'Something went wrong!';
				var_dump( $event_response );
			}
			return false;
		}
		$code = wp_remote_retrieve_response_code( $event_response );
		if ( 200 !== $code ) {
			if ( WP_DEBUG ) {
				echo 'Something went wrong!';
				var_dump( wp_remote_retrieve_response_message( $event_response ) );
			}
			return false;
		}

		$events = json_decode( wp_remote_retrieve_body( $event_response ) );
		if ( $events ) {
			set_transient( $transient, $events, 2 * HOUR_IN_SECONDS );
		}

		return $events;
	}

	/**
	 * Parse an event for the event group name + title
	 *
	 * @param  $event   object  The event as returned from the API
	 * @return  string  Human-readable group name
	 */
	public function the_event_fullname( $event ) {
		$title = $event->name;
		if ( $event->group ) {
			$title = $event->group->name . ': ' . $title;
		}
		echo apply_filters( 'the_title', $title );
	}

	/**
	 * Parse an event for the event time
	 *
	 * @param  $event   object  The event as returned from the API
	 * @param  $format  string  Optional date format string
	 * @return  string  Human-readable event date + time
	 */
	public function the_event_time( $event, $format = 'F d, Y @ g:i a' ) {
		$event_time = intval( $event->time / 1000 + $event->utc_offset / 1000 );
		echo date( $format, $event_time );
	}

	/**
	 * Parse an event for the event description
	 *
	 * @param  $event   object  The event as returned from the API
	 * @return  string  Human-readable event description
	 */
	public function the_event_description( $event ) {
		if ( isset( $event->description ) ) {
			echo apply_filters( 'the_content', wp_trim_words( $event->description, 50 ) );
		}
	}

	/**
	 * Parse an event for the event link
	 *
	 * @param  $event   object  The event as returned from the API
	 * @return  string  Human-readable event link
	 */
	public function the_event_link( $event ) {
		printf(
			'<a href="%1$s">More details <span class="screen-reader-text">for %2$s</span></a>',
			$event->link,
			$event->name
		);
	}
}
