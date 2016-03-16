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
 * Include the custom post type
 */
require_once( plugin_dir_path( __FILE__ ) . 'custom-post-types/lug_meetings.php' );

/**
 * Create custom metabox for entering meeting details
 */
require_once( plugin_dir_path( __FILE__ ) . 'admin/metaboxes.php' );
