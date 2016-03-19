<?php
/**
 * Plugin Name: IEWP LUG Meetings
 * Plugin URI: https://github.com/corenominal/iewp-lug-meetings
 * Description: A WordPress plugin to provide a custom post type for creating LUG meeting events.
 * Author: Philip Newborough
 * Version: 0.0.1
 * Author URI: https://corenominal.org
 */

/**
 * Plugin settings link
 */
function iewp_lug_meetings_action_links( $actions, $plugin_file ) 
{
	static $plugin;
	if (!isset($plugin))
		$plugin = plugin_basename(__FILE__);
	if ($plugin == $plugin_file)
	{
		$settings = array('settings' => '<a href="edit.php?post_type=lug_meeting&page=settings_page.php">' . __('Settings', 'General') . '</a>');
	
		$actions = array_merge($settings, $actions);	
	}
	return $actions;
}
add_filter( 'plugin_action_links', 'iewp_lug_meetings_action_links', 10, 5 );

/**
 * Plugin activation functions
 */
function iewp_lug_meetings_activate()
{
	require_once( plugin_dir_path( __FILE__ ) . 'activation/set_defaults.php' );
}
register_activation_hook( __FILE__, 'iewp_lug_meetings_activate' );

/**
 * Include the custom post type
 */
require_once( plugin_dir_path( __FILE__ ) . 'custom-post-types/lug_meetings.php' );

/**
 * Create custom metabox for entering meeting details
 */
require_once( plugin_dir_path( __FILE__ ) . 'admin/metaboxes.php' );

/**
 * Settings page
 */
require_once( plugin_dir_path( __FILE__ ) . 'admin/settings_page.php' );

/**
 * Structured data
 */
require_once( plugin_dir_path( __FILE__ ) . 'templates/structured_data.php' );