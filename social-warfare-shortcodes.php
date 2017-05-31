<?php
/**
 * Plugin Name: Social Warfare-Shortcodes
 * Plugin URI:  http://warfareplugins.com
 * Description: A plugin that add cool and useful shortcodes for the Social Warfare plugin.
 * Version:     1.0.0
 * Author:      Warfare Plugins
 * Author URI:  http://warfareplugins.com
 * Text Domain: social-warfare
 */

defined( 'WPINC' ) || die;

/**
 * Define plugin constants for use throughout the plugin (Version and Directories)
 *
 */
define( 'SWPS_VERSION' , '1.0.0' );
define( 'SWPS_PLUGIN_FILE', __FILE__ );
define( 'SWPS_PLUGIN_URL', untrailingslashit( plugin_dir_url( __FILE__ ) ) );
define( 'SWPS_PLUGIN_DIR', dirname( __FILE__ ) );

/**
 * Include the plugin's necessary functions files.
 *
 */
add_action( 'plugins_loaded' , 'swps_initiate_plugin' , 25 );
function swps_initiate_plugin() {

}
