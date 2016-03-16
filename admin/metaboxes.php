<?php
/**
 * Custom metaboxes
 */

/**
 * Add the metabox
 */
function iewp_events_add_metabox()
{
	add_meta_box(
		'iewp_events_metabox_event_details', // id
		'Event Details', // title
		'iewp_events_metabox_event_details_callback', //callback function
		'event', // post type
		'normal', // context - placement i.e. 'side', 'normal', 'advanced'
		'high' // priority - i.e. 'high', 'core', 'default', 'low'
		);
}
add_action( 'add_meta_boxes', 'iewp_events_add_metabox' );

/**
 * Callbacks
 */
function iewp_events_metabox_event_details_callback( $post )
{
	wp_nonce_field( basename( __FILE__ ), 'metabox_events_nonce' );
	$post_meta = get_post_meta( $post->ID ); 
	?>

	<div class="iewp-events">
		<div class="meta-row">
			<label>Start Date &amp; Time (YYYY-MM-DD HH:mm)</label>
			<?php
			if ( ! empty ( $post_meta['iewp_events_startdate'] ) )
			{
				$startdate = esc_attr( $post_meta['iewp_events_startdate'][0] );
			}
			else
			{
				$startdate = date( 'Y-m-d H:i' );
			}
			?>
			<input name="iewp_events_startdate" id="iewp_events_startdate" data-format="YYYY-MM-DD HH:mm" data-template="YYYY / MM / DD     HH : mm" value="<?php echo $startdate; ?>" type="text">
		</div>

		<div class="meta-row">
			<label>End Date &amp; Time (YYYY-MM-DD HH:mm)</label>
			<?php
			if ( ! empty ( $post_meta['iewp_events_enddate'] ) )
			{
				$enddate = esc_attr( $post_meta['iewp_events_enddate'][0] );
			}
			else
			{
				$enddate = date("Y-m-d H:i", strtotime('+1 hours'));
			}
			?>
			<input name="iewp_events_enddate" id="iewp_events_enddate" data-format="YYYY-MM-DD HH:mm" data-template="YYYY / MM / DD     HH : mm" value="<?php echo $enddate; ?>" type="text">
		</div>
		
		<fieldset>
    		
    		<legend>The venue</legend>
			
			<div class="meta-row">
				<label>Name</label>
				<input class="fw" type="text" placeholder="Name of venue ..." name="iewp_events_venue_name" id="iewp_events_venue_name" value="<?php if ( ! empty ( $post_meta['iewp_events_venue_name'] ) ) echo esc_attr( $post_meta['iewp_events_venue_name'][0] ); ?>">
			</div>

			<div class="meta-row">
				<label>Website</label>
				<input class="fw" type="text" placeholder="http://www..." name="iewp_events_venue_website" id="iewp_events_venue_website" value="<?php if ( ! empty ( $post_meta['iewp_events_venue_website'] ) ) echo esc_attr( $post_meta['iewp_events_venue_website'][0] ); ?>">
			</div>
			
			<div class="meta-row">
				<label>Street Address</label>
				<input class="fw" type="text" placeholder="1 Foo Street" name="iewp_events_venue_address_street" id="iewp_events_venue_address_street" value="<?php if ( ! empty ( $post_meta['iewp_events_venue_address_street'] ) ) echo esc_attr( $post_meta['iewp_events_venue_address_street'][0] ); ?>">
			</div>

			<div class="meta-row">
				<label>City</label>
				<input class="fw" type="text" placeholder="Foo City" name="iewp_events_venue_address_city" id="iewp_events_venue_address_city" value="<?php if ( ! empty ( $post_meta['iewp_events_venue_address_city'] ) ) echo esc_attr( $post_meta['iewp_events_venue_address_city'][0] ); ?>">
			</div>

			<div class="meta-row">
				<label>County</label>
				<input class="fw" type="text" placeholder="Foo County" name="iewp_events_venue_address_county" id="iewp_events_venue_address_county" value="<?php if ( ! empty ( $post_meta['iewp_events_venue_address_county'] ) ) echo esc_attr( $post_meta['iewp_events_venue_address_county'][0] ); ?>">
			</div>

			<div class="meta-row">
				<label>Postcode</label>
				<input class="fw" type="text" placeholder="F00 BAR" name="iewp_events_venue_address_postcode" id="iewp_events_venue_address_postcode" value="<?php if ( ! empty ( $post_meta['iewp_events_venue_address_postcode'] ) ) echo esc_attr( $post_meta['iewp_events_venue_address_postcode'][0] ); ?>">
			</div>

		</fieldset>
	</div>

	<?php
}

/**
 * Save custom values
 */
function iewp_events_save_values( $post_id )
{
	$is_autosave = wp_is_post_autosave( $post_id );
	$is_revision = wp_is_post_revision( $post_id );
	$is_valid_nonce = ( isset( $_POST['metabox_events_nonce'] ) && wp_verify_nonce( $_POST['metabox_events_nonce'], basename( __FILE__ ) ) ) ? 'true' : 'false';
	// Exit script depending on save status
	if ($is_autosave || $is_revision || !$is_valid_nonce)
	{
		return;
	}
	$keys = array( 'iewp_events_startdate',
				   'iewp_events_enddate',
				   'iewp_events_venue_name',
				   'iewp_events_venue_website',
				   'iewp_events_venue_address_street',
				   'iewp_events_venue_address_city',
				   'iewp_events_venue_address_county',
				   'iewp_events_venue_address_postcode'
				 );
	foreach ( $keys as $key )
	{
		if ( isset( $_POST[$key] ) )
		{
			update_post_meta( $post_id, $key, sanitize_text_field( $_POST[ $key ] ) );
		}
	}
}
add_action( 'save_post', 'iewp_events_save_values' );

/**
 * Enqueue CSS and JavaScript
 */
function iewp_events_enqueue_scripts( $hook )
{
	
	if( 'post.php' == $hook || 'post-new.php' == $hook )
	{
		global $post_type;
    	if( 'event' == $post_type )
    	{
			wp_register_style( 'iewp_events_metabox_css', plugin_dir_url( __FILE__ ) . 'css/iewp_events_metabox.css', array(), '0.0.1', 'all' );
			wp_enqueue_style( 'iewp_events_metabox_css' );

			wp_register_script( 'iewp_events_moment_js', plugin_dir_url( __FILE__ ) . 'js/vendor/moment.js', array('jquery'), '0.0.1', true );
			wp_enqueue_script( 'iewp_events_moment_js' );

			wp_register_script( 'iewp_events_combodate_js', plugin_dir_url( __FILE__ ) . 'js/vendor/combodate.js', array('jquery'), '0.0.1', true );
			wp_enqueue_script( 'iewp_events_combodate_js' );

			wp_register_script( 'iewp_events_js', plugin_dir_url( __FILE__ ) . 'js/iewp-events.js', array('jquery'), '0.0.1', true );
			wp_enqueue_script( 'iewp_events_js' );
		}
	}
}
add_action( 'admin_enqueue_scripts', 'iewp_events_enqueue_scripts' );