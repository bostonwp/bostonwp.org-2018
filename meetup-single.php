<?php
global $event;
if ( isset( $event->time ) ) {
	$date = date( 'F d, Y @ g:i a', intval( $event->time / 1000 + $event->utc_offset / 1000 ) );
} else {
	$date = apply_filters( 'vsm_no_date_text', '' );
}
?>

<h3 class="event-title"><a href="<?php echo esc_url( $event->event_url ); ?>"><?php echo strip_tags( $event->name ); ?></a></h3>
<?php if ( ! empty( $date ) ) : ?>
<p class="event-date"><?php echo $date; ?></p>
<?php endif; ?>

<?php if ( isset( $event->venue ) ) :
	$venue = $event->venue->name . ' ' . $event->venue->address_1 . ', ' . $event->venue->city . ', ' . $event->venue->state;
	$name = $event->venue->name;
	$map_url = "http://maps.google.com/maps?q=$venue+%28$name%29&z=17";
	?>
	<p class='event-location'>Location: <a href="<?php echo $map_url; ?>"><?php echo $venue; ?></a></p>
<?php endif; ?>

<p class="event-rsvp">
	<?php echo absint( $event->yes_rsvp_count ) .' '. _n( 'attendee', 'attendees', $event->yes_rsvp_count ); ?>
</p>

<p class="event-rsvp">
	<?php
	if ( ! empty( $options['vs_meetup_key'] ) && ! empty( $options['vs_meetup_secret'] ) && class_exists( 'OAuth' ) ) {
		echo "<button href='#' onclick='javascript:window.open(\"{$event->callback_url}&event=$id\",\"authenticate\",\"width=400,height=600\");'>RSVP?</button>";
	} else {
		echo '<a class="cta-button" href="'.$event->event_url.'">Join us!</a>';
	} ?>
</p>
