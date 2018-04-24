<?php
/**
 * Plugin Name: Social Warfare - Enhanced Shortcodes
 * Plugin URI:  http://warfareplugins.com
 * Description: A plugin that adds fun and useful shortcodes for the Social Warfare plugin.
 * Version:     1.0.0
 * Author:      Warfare Plugins
 * Author URI:  http://warfareplugins.com
 * Text Domain: social-warfare
*/

defined( 'WPINC' ) || die;
defined( 'WPINC' ) || die;
define( 'SWES_CORE_VERSION_REQUIRED', '3.0.0' );
define( 'SWES_PLUGIN_FILE', __FILE__ );
define( 'SWES_PLUGIN_URL', untrailingslashit( plugin_dir_url( __FILE__ ) ) );
define( 'SWES_PLUGIN_DIR', dirname( __FILE__ ) );

add_action('plugins_loaded' , 'initialize_social_warfare_enahnced_shortcodes' , 20 );

function initialize_social_warfare_enahnced_shortcodes() {
	if( defined('SWP_VERSION') && version_compare( SWP_VERSION, SWES_CORE_VERSION_REQUIRED ) >= 0 ):
		require_once SWES_PLUGIN_DIR . '/Social_Warfare_Enhanced_Shortcodes.php';
        $addon = new Social_Warfare_Enhanced_Shortcodes();
        add_filter( 'swp_registrations', [$addon, 'add_self'] );
	endif;
}
