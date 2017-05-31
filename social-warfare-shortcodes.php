<?php
/**
 * Plugin Name: Social Warfare - Shortcodes
 * Plugin URI:  http://warfareplugins.com
 * Description: A plugin that adds fun and useful shortcodes for the Social Warfare plugin.
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
 * swps_post_twitter_shares() - A function to output the number of twitter shares on a given post.
 *
 * @since  1.0.0
 * @param  array $atts An array of parameters parsed from the shortcode.
 * @return string The number of twitter shares formatted accordingly
 *
 */
add_shortcode( 'twitter_shares', 'swps_post_twitter_shares' );
function swps_post_twitter_shares( $atts ) {
	$shares = get_post_meta( get_the_ID() , '_twitter_shares', true );
    if( false == $shares ){
        return 0;
    } else {

	$shares = swp_kilomega( $shares );
	return $shares;
    }
}
