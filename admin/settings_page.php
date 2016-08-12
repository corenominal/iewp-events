<?php
if ( ! defined( 'WPINC' ) ) { die('Direct access prohibited!'); }
/**
 * Settings page for entering default meeting details
 */

/**
 * Add settings menu item
 */
function iewp_lug_meetings_settings_menu()
{
    add_submenu_page(
    	'edit.php?post_type=lug_meeting',
    	'LUG Meeting Default Settings',
    	'Default Settings',
    	'edit_posts', basename(__FILE__), 'iewp_lug_meetings_settings_page_callback'
    	);

    // Activate custom settings
	add_action( 'admin_init', 'iewp_lug_meetings_register' );

}
add_action('admin_menu' , 'iewp_lug_meetings_settings_menu');

/**
 * Register custom settings
 */
function iewp_lug_meetings_register()
{
	/**
	 * Register the settings fields
	 */
	register_setting(
		'iewp_lug_meetings_group', // option group
		'iewp_lug_meetings_default_venue_name' // option name
		);
	register_setting(
		'iewp_lug_meetings_group', // option group
		'iewp_lug_meetings_default_venue_website' // option name
		);
	register_setting(
		'iewp_lug_meetings_group', // option group
		'iewp_lug_meetings_default_venue_address_street' // option name
		);
	register_setting(
		'iewp_lug_meetings_group', // option group
		'iewp_lug_meetings_default_venue_address_city' // option name
		);
	register_setting(
		'iewp_lug_meetings_group', // option group
		'iewp_lug_meetings_default_venue_address_county' // option name
		);
	register_setting(
		'iewp_lug_meetings_group', // option group
		'iewp_lug_meetings_default_venue_address_postcode' // option name
		);

	register_setting(
		'iewp_lug_meetings_group', // option group
		'iewp_lug_meetings_default_ticket_name' // option name
		);
	register_setting(
		'iewp_lug_meetings_group', // option group
		'iewp_lug_meetings_default_ticket_price' // option name
		);
	register_setting(
		'iewp_lug_meetings_group', // option group
		'iewp_lug_meetings_default_ticket_url' // option name
		);

	/**
	 * Create the settings section for this group of settings
	 */
	add_settings_section(
		'iewp-lug-meetings-options', // id
		'', // title
		'iewp_lug_meetings_options', // callback
		'iewp_lug_meetings_options' // page
		);

	/**
	 * Add the settings fields
	 */
	add_settings_field(
		'iewp-lug-meetings-default-venue-name', // id
		'Venue Name', // title/label
		'iewp_lug_meetings_default_venue_name', // callback
		'iewp_lug_meetings_options', // page
		'iewp-lug-meetings-options' // settings section
		);
	add_settings_field(
		'iewp-lug-meetings-default-venue-website', // id
		'Venue Website', // title/label
		'iewp_lug_meetings_default_venue_website', // callback
		'iewp_lug_meetings_options', // page
		'iewp-lug-meetings-options' // settings section
		);
	add_settings_field(
		'iewp-lug-meetings-default-venue-address-street', // id
		'Venue Street Address', // title/label
		'iewp_lug_meetings_default_venue_address_street', // callback
		'iewp_lug_meetings_options', // page
		'iewp-lug-meetings-options' // settings section
		);
	add_settings_field(
		'iewp-lug-meetings-default-venue-address-city', // id
		'Venue City', // title/label
		'iewp_lug_meetings_default_venue_address_city', // callback
		'iewp_lug_meetings_options', // page
		'iewp-lug-meetings-options' // settings section
		);
	add_settings_field(
		'iewp-lug-meetings-default-venue-address-county', // id
		'Venue County', // title/label
		'iewp_lug_meetings_default_venue_address_county', // callback
		'iewp_lug_meetings_options', // page
		'iewp-lug-meetings-options' // settings section
		);
	add_settings_field(
		'iewp-lug-meetings-default-venue-address-postcode', // id
		'Venue Postcode', // title/label
		'iewp_lug_meetings_default_venue_address_postcode', // callback
		'iewp_lug_meetings_options', // page
		'iewp-lug-meetings-options' // settings section
		);

	add_settings_field(
		'iewp-lug-meetings-default-ticket-name', // id
		'Ticket Name', // title/label
		'iewp_lug_meetings_default_ticket_name', // callback
		'iewp_lug_meetings_options', // page
		'iewp-lug-meetings-options' // settings section
		);
	add_settings_field(
		'iewp-lug-meetings-default-ticket-price', // id
		'Ticket Price', // title/label
		'iewp_lug_meetings_default_ticket_price', // callback
		'iewp_lug_meetings_options', // page
		'iewp-lug-meetings-options' // settings section
		);
	add_settings_field(
		'iewp-lug-meetings-default-ticket-url', // id
		'Ticket URL', // title/label
		'iewp_lug_meetings_default_ticket_url', // callback
		'iewp_lug_meetings_options', // page
		'iewp-lug-meetings-options' // settings section
		);
}

/**
 * Call back function for settings section. Do nothing.
 */
function iewp_lug_meetings_options()
{
	return;
}

/**
 * Produce the form elements/input fields
 */
function iewp_lug_meetings_default_venue_name()
{
	$setting = get_option( 'iewp_lug_meetings_default_venue_name' );
	echo '<input type="text" class="regular-text" name="iewp_lug_meetings_default_venue_name" value="'.$setting.'" placeholder="Venue name ...">';
}

function iewp_lug_meetings_default_venue_website()
{
	$setting = get_option( 'iewp_lug_meetings_default_venue_website' );
	echo '<input type="text" class="regular-text" name="iewp_lug_meetings_default_venue_website" value="'.$setting.'" placeholder="http:// ...">';
}

function iewp_lug_meetings_default_venue_address_street()
{
	$setting = get_option( 'iewp_lug_meetings_default_venue_address_street' );
	echo '<input type="text" class="regular-text" name="iewp_lug_meetings_default_venue_address_street" value="'.$setting.'" placeholder="...">';
}

function iewp_lug_meetings_default_venue_address_city()
{
	$setting = get_option( 'iewp_lug_meetings_default_venue_address_city' );
	echo '<input type="text" class="regular-text" name="iewp_lug_meetings_default_venue_address_city" value="'.$setting.'" placeholder="...">';
}

function iewp_lug_meetings_default_venue_address_county()
{
	$setting = get_option( 'iewp_lug_meetings_default_venue_address_county' );
	echo '<input type="text" class="regular-text" name="iewp_lug_meetings_default_venue_address_county" value="'.$setting.'" placeholder="...">';
}

function iewp_lug_meetings_default_venue_address_postcode()
{
	$setting = get_option( 'iewp_lug_meetings_default_venue_address_postcode' );
	echo '<input type="text" class="regular-text" name="iewp_lug_meetings_default_venue_address_postcode" value="'.$setting.'" placeholder="...">';
}

function iewp_lug_meetings_default_ticket_name()
{
	$setting = get_option( 'iewp_lug_meetings_default_ticket_name' );
	echo '<input type="text" class="regular-text" name="iewp_lug_meetings_default_ticket_name" value="'.$setting.'" placeholder="...">';
}

function iewp_lug_meetings_default_ticket_price()
{
	$setting = get_option( 'iewp_lug_meetings_default_ticket_price' );
	echo '<input type="text" class="regular-text" name="iewp_lug_meetings_default_ticket_price" value="'.$setting.'" placeholder="...">';
}

function iewp_lug_meetings_default_ticket_url()
{
	$setting = get_option( 'iewp_lug_meetings_default_ticket_url' );
	echo '<input type="text" class="regular-text" name="iewp_lug_meetings_default_ticket_url" value="'.$setting.'" placeholder="...">';
	echo '<p class="description">E.g. Eventbrite URL, or leave blank to use the event\'s permalink</p>';
}

/**
 * Settings page callback
 */
function iewp_lug_meetings_settings_page_callback()
{
	?>
	<div class="wrap">

		<h1>LUG Meetings - Defaults</h1>

		<p>If you hold your LUG meetings at a regular venue, populate the form below with details of the venue and ticket info.</p>

		<hr>

		<?php settings_errors(); ?>
		<form method="POST" action="options.php">

			<?php settings_fields( 'iewp_lug_meetings_group' ); ?>
			<?php do_settings_sections( 'iewp_lug_meetings_options' ); ?>
			<?php submit_button(); ?>

		</form>

	</div>
	<?php
}
