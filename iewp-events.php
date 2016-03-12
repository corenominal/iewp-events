<?php
/**
 * Plugin Name: IEWP Events
 * Plugin URI: https://github.com/corenominal/iewp-events
 * Description: A WordPress plugin to provide a custom post type for events.
 * Author: Philip Newborough
 * Version: 0.0.1
 * Author URI: https://corenominal.org
 */

/**
 * Include the custom post type
 */
require_once( plugin_dir_path( __FILE__ ) . 'custom-post-types/events.php' );

/**
 * Include the admin pages
 */
require_once( plugin_dir_path( __FILE__ ) . 'admin/events.php' );
