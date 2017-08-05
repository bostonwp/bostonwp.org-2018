<?php if ( $apply = get_the_job_application_method() ) : ?>
	<div class="job_application application">
		<?php do_action( 'job_application_start', $apply ); ?>
		<div class="application_details">
			<?php
				/**
				 * job_manager_application_details_email or job_manager_application_details_url hook
				 */
				do_action( 'job_manager_application_details_' . $apply->type, $apply );
			?>
		</div>
		<?php do_action( 'job_application_end', $apply ); ?>
	</div>
<?php endif; ?>
