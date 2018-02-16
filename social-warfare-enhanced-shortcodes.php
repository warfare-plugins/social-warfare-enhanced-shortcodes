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

/**
 * Define plugin constants for use throughout the plugin (Version and Directories)
 *
 */
define( 'SWES_VERSION' , '1.0.0' );
define( 'SWES_PLUGIN_FILE', __FILE__ );
define( 'SWES_PLUGIN_URL', untrailingslashit( plugin_dir_url( __FILE__ ) ) );
define( 'SWES_PLUGIN_DIR', dirname( __FILE__ ) );
define( 'SWES_CORE_VERSION_REQUIRED' , '2.3.2' );
define( 'SWES_ITEM_ID' , 114492 );
if ( !defined( 'SWP_ACTIVATE_REGISTRATION_TAB' )) :
    define( 'SWP_ACTIVATE_REGISTRATION_TAB', true );
endif;


/**
 * Add a registration key for the registration functions
 *
 * @param Array An array of registrations for each paid addon
 * @return Array An array modified to add this new registration key
 *
 */
add_filter('swp_registrations' , 'social_warfare_enhanced_shortcodes_registration_key' , 20);
function social_warfare_enhanced_shortcodes_registration_key($array) {

    // Make sure core is on a version that contains our dependancies
    if (defined('SWP_VERSION') && version_compare(SWP_VERSION , SWAD_CORE_VERSION_REQUIRED) >= 0){

        // Add this plugin to the registrations array
        $array['enhanced_shortcodes'] = array(
            'plugin_name' => 'Social Warfare - Enhanced Shortcodes',
            'key' => 'enhanced_shortcodes',
            'product_id' => SWAD_ITEM_ID
        );
    }

    // Return the modified or unmodified array
    return $array;
}

/**
 * The Plugin Update Checker
 *
 *
 * @since 2.0.0 | Created | Update checker added when the plugin was split into core and pro.
 * @since 2.3.3 | 13 SEP 2017 | Updated to use EDD's update checker built into core.
 * @access public
 *
 */
add_action( 'plugins_loaded' , 'swes_update_checker' , 20 );
function swes_update_checker() {

    // Make sure core is on a version that contains our dependancies
    if (defined('SWP_VERSION') && version_compare(SWP_VERSION , SWES_CORE_VERSION_REQUIRED) >= 0){

        // Check if the plugin is registered
        if( is_swp_addon_registered( 'enhanced_shortcodes' ) ) {

            // retrieve our license key from the DB
            $license_key = swp_get_license_key('enhanced_shortcodes');
            $website_url = swp_get_site_url();

            // setup the updater
            $swed_updater = new SW_EDD_SL_Plugin_Updater( SWP_STORE_URL , __FILE__ , array(
            	'version'   => SWES_VERSION,		// current version number
            	'license'   => $license_key,	// license key
            	'item_id'   => SWES_ITEM_ID,	// id of this plugin
            	'author'    => 'Warfare Plugins',	// author of this plugin
            	'url'       => $website_url,
                'beta'      => false // set to true if you wish customers to receive update notifications of beta releases
                )
            );
        }
    }
}

add_action( 'plugins_loaded' , 'swes_initiate_plugin' , 30 );
function swes_initiate_plugin() {
    if(defined('SWP_VERSION')){
        add_shortcode( 'twitter_shares', 'swes_post_twitter_shares' );
        add_shortcode( 'sitewide_twitter_shares', 'swes_sitewide_twitter_shares' );
        add_shortcode( 'facebook_shares', 'swes_post_facebook_shares' );
        add_shortcode( 'sitewide_facebook_shares', 'swes_sitewide_facebook_shares' );
        add_shortcode( 'pinterest_shares', 'swes_post_pinterest_shares' );
        add_shortcode( 'sitewide_pinterest_shares', 'swes_sitewide_pinterest_shares' );
        add_shortcode( 'googlePlus_shares', 'swes_post_googlePlus_shares' );
        add_shortcode( 'sitewide_googlePlus_shares', 'swes_sitewide_googlePlus_shares' );
        add_shortcode( 'linkedIn_shares', 'swes_post_linkedIn_shares' );
        add_shortcode( 'sitewide_linkedIn_shares', 'swes_sitewide_linkedIn_shares' );
        add_shortcode( 'stumbleupon_shares', 'swes_post_stumbleupon_shares' );
        add_shortcode( 'sitewide_stumbleupon_shares', 'swes_sitewide_stumbleupon_shares' );
    }
    if(defined('SWPP_VERSION')){
        add_shortcode( 'buffer_shares', 'swes_post_buffer_shares' );
        add_shortcode( 'sitewide_buffer_shares', 'swes_sitewide_buffer_shares' );
        add_shortcode( 'hacker_news_shares', 'swes_post_hacker_news_shares' );
        add_shortcode( 'sitewide_hacker_news_shares', 'swes_sitewide_hacker_news_shares' );
        add_shortcode( 'reddit_shares', 'swes_post_reddit_shares' );
        add_shortcode( 'sitewide_reddit_shares', 'swes_sitewide_reddit_shares' );
        add_shortcode( 'tumblr_shares', 'swes_post_tumblr_shares' );
        add_shortcode( 'sitewide_tumblr_shares', 'swes_sitewide_tumblr_shares' );
        add_shortcode( 'yummly_shares', 'swes_post_yummly_shares' );
        add_shortcode( 'sitewide_yummly_shares', 'swes_sitewide_yummly_shares' );
    }
}

/**
 * swes_post_twitter_shares() - A function to output the number of twitter shares on a given post.
 *
 * @since  1.0.0
 * @param  array $atts An array of parameters parsed from the shortcode.
 * @return string The number of twitter shares formatted accordingly
 *
 */
function swes_post_twitter_shares( $atts ) {
    $shares = get_post_meta( get_the_ID() , '_twitter_shares', true );
    if( false == $shares ){
        return 0;
    } else {
	$shares = swp_kilomega( $shares );
	return $shares;
    }
}

/**
 * swes_sitewide_twitter_shares() - A function to output the total number of twitter shares sitewide.
 *
 * @param  array $atts An array of parameters parsed from the shortcode attributes
 * @return string The total number of sitewide shares.
 *
 */

function swes_sitewide_twitter_shares( $atts ) {
	global $wpdb;
	$sum = $wpdb->get_results( "SELECT SUM(meta_value) AS total FROM $wpdb->postmeta WHERE meta_key = '_twitter_shares'" );
	return swp_kilomega( $sum[0]->total );
}

/**
 * swes_post_facebook_shares() - A function to output the number of facebook shares on a given post.
 *
 * @since  1.0.0
 * @param  array $atts An array of parameters parsed from the shortcode.
 * @return string The number of facebook shares formatted accordingly
 *
 */

function swes_post_facebook_shares( $atts ) {
$shares = get_post_meta( get_the_ID() , '_facebook_shares', true );
    if( false == $shares ){
        return 0;
    } else {
	$shares = swp_kilomega( $shares );
	return $shares;
    }
}

/**
 * swes_sitewide_facebook_shares() - A function to output the total number of facebook shares sitewide.
 *
 * @param  array $atts An array of parameters parsed from the shortcode attributes
 * @return string The total number of sitewide shares.
 *
 */

function swes_sitewide_facebook_shares( $atts ) {
	global $wpdb;
	$sum = $wpdb->get_results( "SELECT SUM(meta_value) AS total FROM $wpdb->postmeta WHERE meta_key = '_facebook_shares'" );
	return swp_kilomega( $sum[0]->total );
}

/**
 * swes_post_pinterest_shares() - A function to output the number of pinterest shares on a given post.
 *
 * @since  1.0.0
 * @param  array $atts An array of parameters parsed from the shortcode.
 * @return string The number of pinterest shares formatted accordingly
 *
 */

function swes_post_pinterest_shares( $atts ) {
    $shares = get_post_meta( get_the_ID() , '_pinterest_shares', true );
    if( false == $shares ){
        return 0;
    } else {
        $shares = swp_kilomega( $shares );
        return $shares;
    }
}

/**
 * swes_sitewide_pinterest_shares() - A function to output the total number of pinterest shares sitewide.
 *
 * @param  array $atts An array of parameters parsed from the shortcode attributes
 * @return string The total number of sitewide shares.
 *
 */

function swes_sitewide_pinterest_shares( $atts ) {
    global $wpdb;
    $sum = $wpdb->get_results( "SELECT SUM(meta_value) AS total FROM $wpdb->postmeta WHERE meta_key '_pinterest_shares'" );
    return swp_kilomega( $sum[0]->total );
}

/**
 * swes_post_googlePlus_shares() - A function to output the number of googlePlus shares on a given post.
 *
 * @since  1.0.0
 * @param  array $atts An array of parameters parsed from the shortcode.
 * @return string The number of googlePlus shares formatted accordingly
 *
 */

function swes_post_googlePlus_shares( $atts ) {
$shares = get_post_meta( get_the_ID() , '_googlePlus_shares', true );
    if( false == $shares ){
        return 0;
    } else {
	$shares = swp_kilomega( $shares );
	return $shares;
    }
}

/**
 * swes_sitewide_googlePlus_shares() - A function to output the total number of googlePlus shares sitewide.
 *
 * @param  array $atts An array of parameters parsed from the shortcode attributes
 * @return string The total number of sitewide shares.
 *
 */

function swes_sitewide_googlePlus_shares( $atts ) {
	global $wpdb;
	$sum = $wpdb->get_results( "SELECT SUM(meta_value) AS total FROM $wpdb->postmeta WHERE meta_key = '_googlePlus_shares'" );
	return swp_kilomega( $sum[0]->total );
}

/**
 * swes_post_linkedIn_shares() - A function to output the number of linkedIn shares on a given post.
 *
 * @since  1.0.0
 * @param  array $atts An array of parameters parsed from the shortcode.
 * @return string The number of linkedIn shares formatted accordingly
 *
 */

function swes_post_linkedIn_shares( $atts ) {
    $shares = get_post_meta( get_the_ID() , '_linkedIn_shares', true );
    if( false == $shares ){
        return 0;
    } else {
        $shares = swp_kilomega( $shares );
        return $shares;
    }
}

/**
 * swes_sitewide_linkedIn_shares() - A function to output the total number of twitter shares sitewide.
 *
 * @param  array $atts An array of parameters parsed from the shortcode attributes
 * @return string The total number of sitewide shares.
 *
 */

function swes_sitewide_linkedIn_shares( $atts ) {
    global $wpdb;
    $sum = $wpdb->get_results( "SELECT SUM(meta_value) AS total FROM $wpdb->postmeta WHERE meta_key = '_linkedIn_shares'" );
    return swp_kilomega( $sum[0]->total );
}

/**
 * swes_post_stumbleupon_shares() - A function to output the number of stumbleupon shares on a given post.
 *
 * @since  1.0.0
 * @param  array $atts An array of parameters parsed from the shortcode.
 * @return string The number of stumbleupon shares formatted accordingly
 *
 */

function swes_post_stumbleupon_shares( $atts ) {
    $shares = get_post_meta( get_the_ID() , '_stumbleupon_shares', true );
    if( false == $shares ){
        return 0;
    } else {
        $shares = swp_kilomega( $shares );
        return $shares;
    }
}

/**
 * swes_sitewide_stumbleupon_shares() - A function to output the total number of stumbleupon shares sitewide.
 *
 * @param  array $atts An array of parameters parsed from the shortcode attributes
 * @return string The total number of sitewide shares.
 *
 */

function swes_sitewide_stumbleupon_shares( $atts ) {
    global $wpdb;
    $sum = $wpdb->get_results( "SELECT SUM(meta_value) AS total FROM $wpdb->postmeta WHERE meta_key = '_stumbleupon_shares'" );
    return swp_kilomega( $sum[0]->total );
}

/**
 * swes_post_buffer_shares() - A function to output the number of buffer shares on a given post.
 *
 * @since  1.0.0
 * @param  array $atts An array of parameters parsed from the shortcode.
 * @return string The number of buffer shares formatted accordingly
 *
 */

function swes_post_buffer_shares( $atts ) {
    $shares = get_post_meta( get_the_ID() , '_buffer_shares', true );
    if( false == $shares ){
        return 0;
    } else {
        $shares = swp_kilomega( $shares );
        return $shares;
    }
}

/**
 * swes_sitewide_buffer_shares() - A function to output the total number of buffer shares sitewide.
 *
 * @param  array $atts An array of parameters parsed from the shortcode attributes
 * @return string The total number of sitewide shares.
 *
 */

function swes_sitewide_buffer_shares( $atts ) {
    global $wpdb;
    $sum = $wpdb->get_results( "SELECT SUM(meta_value) AS total FROM $wpdb->postmeta WHERE meta_key = '_buffer_shares'" );
    return swp_kilomega( $sum[0]->total );
}

/**
 * swes_post_hacker_news_shares() - A function to output the number of hacker_news shares on a given post.
 *
 * @since  1.0.0
 * @param  array $atts An array of parameters parsed from the shortcode.
 * @return string The number of buffer shares formatted accordingly
 *
 */

function swes_post_hacker_news_shares( $atts ) {
    $shares = get_post_meta( get_the_ID() , '_hacker_news_shares', true );
    if( false == $shares ){
        return 0;
    } else {
        $shares = swp_kilomega( $shares );
        return $shares;
    }
}

/**
 * swes_sitewide_hacker_news_shares() - A function to output the total number of hacker_news shares sitewide.
 *
 * @param  array $atts An array of parameters parsed from the shortcode attributes
 * @return string The total number of sitewide shares.
 *
 */

function swes_sitewide_hacker_news_shares( $atts ) {
    global $wpdb;
    $sum = $wpdb->get_results( "SELECT SUM(meta_value) AS total FROM $wpdb->postmeta WHERE meta_key = '_hacker_news_shares'" );
    return swp_kilomega( $sum[0]->total );
}

/**
 * swes_post_reddit_shares() - A function to output the number of reddit shares on a given post.
 *
 * @since  1.0.0
 * @param  array $atts An array of parameters parsed from the shortcode.
 * @return string The number of reddit shares formatted accordingly
 *
 */

function swes_post_reddit_shares( $atts ) {
    $shares = get_post_meta( get_the_ID() , '_reddit_shares', true );
    if( false == $shares ){
        return 0;
    } else {
        $shares = swp_kilomega( $shares );
        return $shares;
    }
}

/**
 * swes_sitewide_reddit_shares() - A function to output the total number of reddit shares sitewide.
 *
 * @param  array $atts An array of parameters parsed from the shortcode attributes
 * @return string The total number of sitewide shares.
 *
 */

function swes_sitewide_reddit_shares( $atts ) {
    global $wpdb;
    $sum = $wpdb->get_results( "SELECT SUM(meta_value) AS total FROM $wpdb->postmeta WHERE meta_key = '_reddit_shares'" );
    return swp_kilomega( $sum[0]->total );
}

/**
 * swes_post_tumblr_shares() - A function to output the number of tumblr shares on a given post.
 *
 * @since  1.0.0
 * @param  array $atts An array of parameters parsed from the shortcode.
 * @return string The number of tumblr shares formatted accordingly
 *
 */

function swes_post_tumblr_shares( $atts ) {
    $shares = get_post_meta( get_the_ID() , '_tumblr_shares', true );
    if( false == $shares ){
        return 0;
    } else {
        $shares = swp_kilomega( $shares );
        return $shares;
    }
}

/**
 * swes_sitewide_tumblr_shares() - A function to output the total number of tumblr shares sitewide.
 *
 * @param  array $atts An array of parameters parsed from the shortcode attributes
 * @return string The total number of sitewide shares.
 *
 */

function swes_sitewide_tumblr_shares( $atts ) {
   	global $wpdb;
   	$sum = $wpdb->get_results( "SELECT SUM(meta_value) AS total FROM $wpdb->postmeta WHERE meta_key = '_tumblr_shares'" );
   	return swp_kilomega( $sum[0]->total );
   }

/**
 * swes_post_yummly_shares() - A function to output the number of yummly shares on a given post.
 *
 * @since  1.0.0
 * @param  array $atts An array of parameters parsed from the shortcode.
 * @return string The number of yummly shares formatted accordingly
 *
 */

function swes_post_yummly_shares( $atts ) {
    $shares = get_post_meta( get_the_ID() , '_yummly_shares', true );
    if( false == $shares ){
        return 0;
    } else {
        $shares = swp_kilomega( $shares );
        return $shares;
    }
}

/**
 * swes_sitewide_yummly_shares() - A function to output the total number of tumblr shares sitewide.
 *
 * @param  array $atts An array of parameters parsed from the shortcode attributes
 * @return string The total number of sitewide shares.
 *
 */

function swes_sitewide_yummly_shares( $atts ) {
    global $wpdb;
    $sum = $wpdb->get_results( "SELECT SUM(meta_value) AS total FROM $wpdb->postmeta WHERE meta_key = '_yummly_shares'" );
    return swp_kilomega( $sum[0]->total );
}
