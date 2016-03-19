<?php
/**
 * Custom metaboxes
 */

/**
 * Add the metabox
 */
function iewp_lug_meeting_add_metabox()
{
	add_meta_box(
		'iewp_lug_meeting_metabox_event_details', // id
		'LUG Meeting Details', // title
		'iewp_lug_meeting_metabox_event_details_callback', //callback function
		'lug_meeting', // post type
		'normal', // context - placement i.e. 'side', 'normal', 'advanced'
		'high' // priority - i.e. 'high', 'core', 'default', 'low'
		);
}
add_action( 'add_meta_boxes', 'iewp_lug_meeting_add_metabox' );

/**
 * Callbacks
 */
function iewp_lug_meeting_metabox_event_details_callback( $post )
{
	wp_nonce_field( basename( __FILE__ ), 'metabox_events_nonce' );
	$post_meta = get_post_meta( $post->ID );

	/**
	 * Default values
	 */

	if ( ! empty ( $post_meta['iewp_lug_meeting_startdate'] ) )
	{
		$startdate = esc_attr( $post_meta['iewp_lug_meeting_startdate'][0] );
	}
	else
	{
		$startdate = date( 'Y-m-d H:i' );
	}
	if ( ! empty ( $post_meta['iewp_lug_meeting_enddate'] ) )
	{
		$enddate = esc_attr( $post_meta['iewp_lug_meeting_enddate'][0] );
	}
	else
	{
		$enddate = date("Y-m-d H:i", strtotime('+1 hours'));
	}

	$venue_name = get_option( 'iewp_lug_meetings_default_venue_name' );
	$venue_website = get_option( 'iewp_lug_meetings_default_venue_website' );
	$venue_address_street = get_option( 'iewp_lug_meetings_default_venue_address_street' );
	$venue_address_city = get_option( 'iewp_lug_meetings_default_venue_address_city' );
	$venue_address_county = get_option( 'iewp_lug_meetings_default_venue_address_county' );
	$venue_address_postcode = get_option( 'iewp_lug_meetings_default_venue_address_postcode' );

	if ( ! empty ( $post_meta['iewp_lug_meeting_venue_name'] ) ) $venue_name = esc_attr( $post_meta['iewp_lug_meeting_venue_name'][0] );
	if ( ! empty ( $post_meta['iewp_lug_meeting_venue_website'] ) ) $venue_website = esc_attr( $post_meta['iewp_lug_meeting_venue_website'][0] );
	if ( ! empty ( $post_meta['iewp_lug_meeting_venue_address_street'] ) ) $venue_address_street = esc_attr( $post_meta['iewp_lug_meeting_venue_address_street'][0] );
	if ( ! empty ( $post_meta['iewp_lug_meeting_venue_address_city'] ) ) $venue_address_city = esc_attr( $post_meta['iewp_lug_meeting_venue_address_city'][0] );
	if ( ! empty ( $post_meta['iewp_lug_meeting_venue_address_county'] ) ) $venue_address_county = esc_attr( $post_meta['iewp_lug_meeting_venue_address_county'][0] );
	if ( ! empty ( $post_meta['iewp_lug_meeting_venue_address_postcode'] ) ) $venue_address_postcode = esc_attr( $post_meta['iewp_lug_meeting_venue_address_postcode'][0] );

	$ticket_name = get_option( 'iewp_lug_meetings_default_ticket_name' );
	$ticket_price = get_option( 'iewp_lug_meetings_default_ticket_price' );
	$ticket_url = get_option( 'iewp_lug_meetings_default_ticket_url' );

	if ( ! empty ( $post_meta['iewp_lug_meeting_ticket_name'] ) ) $ticket_name = esc_attr( $post_meta['iewp_lug_meeting_ticket_name'][0] );
	if ( ! empty ( $post_meta['iewp_lug_meeting_ticket_price'] ) ) $ticket_price = esc_attr( $post_meta['iewp_lug_meeting_ticket_price'][0] );
	if ( ! empty ( $post_meta['iewp_lug_meeting_ticket_url'] ) ) $ticket_url = esc_attr( $post_meta['iewp_lug_meeting_ticket_url'][0] );

	?>

	<div class="iewp-lug-meeting">
		
		<fieldset>
    		
    		<legend>Date &amp; Time</legend>

			<div class="meta-row">
				<label>Starts (YYYY-MM-DD HH:mm)</label>
				<input name="iewp_lug_meeting_startdate" id="iewp_lug_meeting_startdate" data-format="YYYY-MM-DD HH:mm" data-template="YYYY / MM / DD     HH : mm" value="<?php echo $startdate; ?>" type="text">
			</div>

			<div class="meta-row">
				<label>Finishes (YYYY-MM-DD HH:mm)</label>
				<input name="iewp_lug_meeting_enddate" id="iewp_lug_meeting_enddate" data-format="YYYY-MM-DD HH:mm" data-template="YYYY / MM / DD     HH : mm" value="<?php echo $enddate; ?>" type="text">
			</div>

		</fieldset>

		<fieldset>
    		
    		<legend>Tickets</legend>

			<div class="meta-row">
				<label>Ticket Name</label>
				<input class="fw" type="text" placeholder="Free Entry - No Ticket Required" name="iewp_lug_meeting_ticket_name" id="iewp_lug_meeting_ticket_name" value="<?php echo $ticket_name ?>">
			</div>

			<div class="meta-row">
				<label>Price</label>
				<input class="fw" type="text" placeholder="0.00" name="iewp_lug_meeting_ticket_price" id="iewp_lug_meeting_ticket_price" value="<?php echo $ticket_price ?>">
			</div>

			<div class="meta-row">
				<label>Ticket URL</label>
				<input class="fw" type="text" placeholder="http://www..." name="iewp_lug_meeting_ticket_url" id="iewp_lug_meeting_ticket_url" value="<?php echo $ticket_url ?>">
				<p class="description">E.g. Eventbrite URL, or leave blank to use the event's permalink</p>
			</div>

		</fieldset>
		
		<fieldset>
    		
    		<legend>The Venue</legend>
			
			<div class="meta-row">
				<label>Name</label>
				<input class="fw" type="text" placeholder="Name of venue ..." name="iewp_lug_meeting_venue_name" id="iewp_lug_meeting_venue_name" value="<?php echo $venue_name ?>">
			</div>

			<div class="meta-row">
				<label>Website</label>
				<input class="fw" type="text" placeholder="http://www..." name="iewp_lug_meeting_venue_website" id="iewp_lug_meeting_venue_website" value="<?php echo $venue_website ?>">
			</div>
			
			<div class="meta-row">
				<label>Street Address</label>
				<input class="fw" type="text" placeholder="1 Foo Street" name="iewp_lug_meeting_venue_address_street" id="iewp_lug_meeting_venue_address_street" value="<?php echo $venue_address_street ?>">
			</div>

			<div class="meta-row">
				<label>City</label>
				<input class="fw" type="text" placeholder="Foo City" name="iewp_lug_meeting_venue_address_city" id="iewp_lug_meeting_venue_address_city" value="<?php echo $venue_address_city ?>">
			</div>

			<div class="meta-row">
				<label>County</label>
				<input class="fw" type="text" placeholder="Foo County" name="iewp_lug_meeting_venue_address_county" id="iewp_lug_meeting_venue_address_county" value="<?php echo $venue_address_county ?>">
			</div>

			<div class="meta-row">
				<label>Postcode</label>
				<input class="fw" type="text" placeholder="F00 BAR" name="iewp_lug_meeting_venue_address_postcode" id="iewp_lug_meeting_venue_address_postcode" value="<?php echo $venue_address_postcode ?>">
			</div>

		</fieldset>

	</div>

	<?php
}

/**
 * Save custom values
 */
function iewp_lug_meeting_save_values( $post_id )
{
	$is_autosave = wp_is_post_autosave( $post_id );
	$is_revision = wp_is_post_revision( $post_id );
	$is_valid_nonce = ( isset( $_POST['metabox_events_nonce'] ) && wp_verify_nonce( $_POST['metabox_events_nonce'], basename( __FILE__ ) ) ) ? 'true' : 'false';
	// Exit script depending on save status
	if ($is_autosave || $is_revision || !$is_valid_nonce)
	{
		return;
	}
	$keys = array( 'iewp_lug_meeting_startdate',
				   'iewp_lug_meeting_enddate',
				   'iewp_lug_meeting_venue_name',
				   'iewp_lug_meeting_venue_website',
				   'iewp_lug_meeting_venue_address_street',
				   'iewp_lug_meeting_venue_address_city',
				   'iewp_lug_meeting_venue_address_county',
				   'iewp_lug_meeting_venue_address_postcode',
				   'iewp_lug_meeting_ticket_name',
				   'iewp_lug_meeting_ticket_price',
				   'iewp_lug_meeting_ticket_url'
				 );
	foreach ( $keys as $key )
	{
		if ( isset( $_POST[$key] ) )
		{
			update_post_meta( $post_id, $key, sanitize_text_field( $_POST[ $key ] ) );
			
			// Do timestamps for start and enddates
			if( $key == 'iewp_lug_meeting_startdate' )
			{
				update_post_meta( $post_id, 'iewp_lug_meeting_startdate_timestamp', strtotime( sanitize_text_field( $_POST[ $key ] ) ) );
			}

			if( $key == 'iewp_lug_meeting_enddate' )
			{
				update_post_meta( $post_id, 'iewp_lug_meeting_enddate_timestamp', strtotime( sanitize_text_field( $_POST[ $key ] ) ) );
			}
		}
	}
}
add_action( 'save_post', 'iewp_lug_meeting_save_values' );

/**
 * Enqueue CSS and JavaScript
 */
function iewp_lug_meeting_enqueue_scripts( $hook )
{
	
	if( 'post.php' == $hook || 'post-new.php' == $hook )
	{
		global $post_type;
    	if( 'lug_meeting' == $post_type )
    	{
			wp_register_style( 'iewp_lug_meeting_metabox_css', plugin_dir_url( __FILE__ ) . 'css/iewp_lug_meeting_metabox.css', array(), '0.0.1', 'all' );
			wp_enqueue_style( 'iewp_lug_meeting_metabox_css' );

			wp_register_script( 'iewp_lug_meeting_moment_js', plugin_dir_url( __FILE__ ) . 'js/vendor/moment.js', array('jquery'), '0.0.1', true );
			wp_enqueue_script( 'iewp_lug_meeting_moment_js' );

			wp_register_script( 'iewp_lug_meeting_combodate_js', plugin_dir_url( __FILE__ ) . 'js/vendor/combodate.js', array('jquery'), '0.0.1', true );
			wp_enqueue_script( 'iewp_lug_meeting_combodate_js' );

			wp_register_script( 'iewp_lug_meeting_js', plugin_dir_url( __FILE__ ) . 'js/iewp_lug_meeting.js', array('jquery'), '0.0.1', true );
			wp_enqueue_script( 'iewp_lug_meeting_js' );
		}
	}
}
add_action( 'admin_enqueue_scripts', 'iewp_lug_meeting_enqueue_scripts' );