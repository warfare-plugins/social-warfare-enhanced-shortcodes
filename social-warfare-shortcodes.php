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

/**
 * swps_sitewide_twitter_shares() - A function to output the total number of twitter shares sitewide.
 *
 * @param  array $atts An array of parameters parsed from the shortcode attributes
 * @return string The total number of sitewide shares.
 *
 */
add_shortcode( 'sitewide_twitter_shares', 'swps_sitewide_twitter_shares()' );
function swps_sitewide_twitter_shares( $atts ) {
	global $wpdb;
	$sum = $wpdb->get_results( "SELECT SUM(meta_value) AS total FROM $wpdb->postmeta WHERE meta_key = '_twitter_shares'" );
	return swp_kilomega( $sum[0]->total );
}

/**
 * swps_post_facebook_shares() - A function to output the number of facebook shares on a given post.
 *
 * @since  1.0.0
 * @param  array $atts An array of parameters parsed from the shortcode.
 * @return string The number of facebook shares formatted accordingly
 *
 */
add_shortcode( 'facebook_shares', 'swps_post_facebook_shares' );
function swps_post_facebook_shares( $atts ) {
$shares = get_post_meta( get_the_ID() , '_facebook_shares', true );
    if( false == $shares ){
        return 0;
    } else {
	$shares = swp_kilomega( $shares );
	return $shares;
    }
}

/**
 * swps_sitewide_facebook_shares() - A function to output the total number of facebook shares sitewide.
 *
 * @param  array $atts An array of parameters parsed from the shortcode attributes
 * @return string The total number of sitewide shares.
 *
 */
add_shortcode( 'sitewide_facebook_shares', 'swps_sitewide_facebook_shares()' );
echo "after shortcode added"
function swps_sitewide_facebook_shares( $atts ) {
    echo "I am called."
	global $wpdb;
	$sum = $wpdb->get_results( "SELECT SUM(meta_value) AS total FROM $wpdb->postmeta WHERE meta_key = '_facebook_shares'" );
	return swp_kilomega( $sum[0]->total );
}

/**
 * swps_post_pinterest_shares() - A function to output the number of pinterest shares on a given post.
 *
 * @since  1.0.0
 * @param  array $atts An array of parameters parsed from the shortcode.
 * @return string The number of pinterest shares formatted accordingly
 *
 */
add_shortcode( 'pinterest_shares', 'swps_post_pinterest_shares' );
function swps_post_pinterest_shares( $atts ) {
    $shares = get_post_meta( get_the_ID() , '_pinterest_shares', true );
    if( false == $shares ){
        return 0;
    } else {
        $shares = swp_kilomega( $shares );
        return $shares;
    }
}

/**
 * swps_sitewide_pinterest_shares() - A function to output the total number of pinterest shares sitewide.
 *
 * @param  array $atts An array of parameters parsed from the shortcode attributes
 * @return string The total number of sitewide shares.
 *
 */
add_shortcode( 'sitewide_pinterest_shares', 'swps_sitewide_pinterest_shares()' );
function swps_sitewide_pinterest_shares( $atts ) {
    global $wpdb;
    $sum = $wpdb->get_results( "SELECT SUM(meta_value) AS total FROM $wpdb->postmeta WHERE meta_key '_pinterest_shares'" );
    return swp_kilomega( $sum[0]->total );
}

/**
 * swps_post_googlePlus_shares() - A function to output the number of googlePlus shares on a given post.
 *
 * @since  1.0.0
 * @param  array $atts An array of parameters parsed from the shortcode.
 * @return string The number of googlePlus shares formatted accordingly
 *
 */
add_shortcode( 'googlePlus_shares', 'swps_post_googlePlus_shares' );
function swps_post_googlePlus_shares( $atts ) {
$shares = get_post_meta( get_the_ID() , '_googlePlus_shares', true );
    if( false == $shares ){
        return 0;
    } else {
	$shares = swp_kilomega( $shares );
	return $shares;
    }
}

/**
 * swps_sitewide_googlePlus_shares() - A function to output the total number of googlePlus shares sitewide.
 *
 * @param  array $atts An array of parameters parsed from the shortcode attributes
 * @return string The total number of sitewide shares.
 *
 */
add_shortcode( 'sitewide_googlePlus_shares', 'swps_sitewide_googlePlus_shares()' );
function swps_sitewide_googlePlus_shares( $atts ) {
	global $wpdb;
	$sum = $wpdb->get_results( "SELECT SUM(meta_value) AS total FROM $wpdb->postmeta WHERE meta_key = '_googlePlus_shares'" );
	return swp_kilomega( $sum[0]->total );
}

/**
 * swps_post_linkedIn_shares() - A function to output the number of linkedIn shares on a given post.
 *
 * @since  1.0.0
 * @param  array $atts An array of parameters parsed from the shortcode.
 * @return string The number of linkedIn shares formatted accordingly
 *
 */
add_shortcode( 'linkedIn_shares', 'swps_post_linkedIn_shares' );
function swps_post_linkedIn_shares( $atts ) {
    $shares = get_post_meta( get_the_ID() , '_linkedIn_shares', true );
    if( false == $shares ){
        return 0;
    } else {
        $shares = swp_kilomega( $shares );
        return $shares;
    }
}

/**
 * swps_sitewide_linkedIn_shares() - A function to output the total number of twitter shares sitewide.
 *
 * @param  array $atts An array of parameters parsed from the shortcode attributes
 * @return string The total number of sitewide shares.
 *
 */
add_shortcode( 'sitewide_linkedIn_shares', 'swps_sitewide_linkedIn_shares()' );
function swps_sitewide_linkedIn_shares( $atts ) {
    global $wpdb;
    $sum = $wpdb->get_results( "SELECT SUM(meta_value) AS total FROM $wpdb->postmeta WHERE meta_key = '_linkedIn_shares'" );
    return swp_kilomega( $sum[0]->total );
}

/**
 * swps_post_stumbleupon_shares() - A function to output the number of stumbleupon shares on a given post.
 *
 * @since  1.0.0
 * @param  array $atts An array of parameters parsed from the shortcode.
 * @return string The number of stumbleupon shares formatted accordingly
 *
 */
add_shortcode( 'stumbleupon_shares', 'swps_post_stumbleupon_shares' );
function swps_post_stumbleupon_shares( $atts ) {
    $shares = get_post_meta( get_the_ID() , '_stumbleupon_shares', true );
    if( false == $shares ){
        return 0;
    } else {
        $shares = swp_kilomega( $shares );
        return $shares;
    }
}

/**
 * swps_sitewide_stumbleupon_shares() - A function to output the total number of stumbleupon shares sitewide.
 *
 * @param  array $atts An array of parameters parsed from the shortcode attributes
 * @return string The total number of sitewide shares.
 *
 */
add_shortcode( 'sitewide_stumbleupon_shares', 'swps_sitewide_stumbleupon_shares()' );
function swps_sitewide_stumbleupon_shares( $atts ) {
    global $wpdb;
    $sum = $wpdb->get_results( "SELECT SUM(meta_value) AS total FROM $wpdb->postmeta WHERE meta_key = '_stumbleupon_shares'" );
    return swp_kilomega( $sum[0]->total );
}

/**
 * swps_post_buffer_shares() - A function to output the number of buffer shares on a given post.
 *
 * @since  1.0.0
 * @param  array $atts An array of parameters parsed from the shortcode.
 * @return string The number of buffer shares formatted accordingly
 *
 */
add_shortcode( 'buffer_shares', 'swps_post_buffer_shares' );
function swps_post_buffer_shares( $atts ) {
    $shares = get_post_meta( get_the_ID() , '_buffer_shares', true );
    if( false == $shares ){
        return 0;
    } else {
        $shares = swp_kilomega( $shares );
        return $shares;
    }
}

/**
 * swps_sitewide_buffer_shares() - A function to output the total number of buffer shares sitewide.
 *
 * @param  array $atts An array of parameters parsed from the shortcode attributes
 * @return string The total number of sitewide shares.
 *
 */
add_shortcode( 'sitewide_buffer_shares', 'swps_sitewide_buffer_shares()' );
function swps_sitewide_buffer_shares( $atts ) {
    global $wpdb;
    $sum = $wpdb->get_results( "SELECT SUM(meta_value) AS total FROM $wpdb->postmeta WHERE meta_key = '_buffer_shares'" );
    return swp_kilomega( $sum[0]->total );
}

/**
 * swps_post_hacker_news_shares() - A function to output the number of hacker_news shares on a given post.
 *
 * @since  1.0.0
 * @param  array $atts An array of parameters parsed from the shortcode.
 * @return string The number of buffer shares formatted accordingly
 *
 */
add_shortcode( 'hacker_news_shares', 'swps_post_hacker_news_shares' );
function swps_post_hacker_news_shares( $atts ) {
    $shares = get_post_meta( get_the_ID() , '_hacker_news_shares', true );
    if( false == $shares ){
        return 0;
    } else {
        $shares = swp_kilomega( $shares );
        return $shares;
    }
}

/**
 * swps_sitewide_hacker_news_shares() - A function to output the total number of hacker_news shares sitewide.
 *
 * @param  array $atts An array of parameters parsed from the shortcode attributes
 * @return string The total number of sitewide shares.
 *
 */
add_shortcode( 'sitewide_hacker_news_shares', 'swps_sitewide_hacker_news_shares()' );
function swps_sitewide_hacker_news_shares( $atts ) {
    global $wpdb;
    $sum = $wpdb->get_results( "SELECT SUM(meta_value) AS total FROM $wpdb->postmeta WHERE meta_key = '_hacker_news_shares'" );
    return swp_kilomega( $sum[0]->total );
}

/**
 * swps_post_reddit_shares() - A function to output the number of reddit shares on a given post.
 *
 * @since  1.0.0
 * @param  array $atts An array of parameters parsed from the shortcode.
 * @return string The number of reddit shares formatted accordingly
 *
 */
add_shortcode( 'reddit_shares', 'swps_post_reddit_shares' );
function swps_post_reddit_shares( $atts ) {
    $shares = get_post_meta( get_the_ID() , '_reddit_shares', true );
    if( false == $shares ){
        return 0;
    } else {
        $shares = swp_kilomega( $shares );
        return $shares;
    }
}

/**
 * swps_sitewide_reddit_shares() - A function to output the total number of reddit shares sitewide.
 *
 * @param  array $atts An array of parameters parsed from the shortcode attributes
 * @return string The total number of sitewide shares.
 *
 */
add_shortcode( 'sitewide_reddit_shares', 'swps_sitewide_reddit_shares()' );
function swps_sitewide_reddit_shares( $atts ) {
    global $wpdb;
    $sum = $wpdb->get_results( "SELECT SUM(meta_value) AS total FROM $wpdb->postmeta WHERE meta_key = '_reddit_shares'" );
    return swp_kilomega( $sum[0]->total );
}

/**
 * swps_post_tumblr_shares() - A function to output the number of tumblr shares on a given post.
 *
 * @since  1.0.0
 * @param  array $atts An array of parameters parsed from the shortcode.
 * @return string The number of tumblr shares formatted accordingly
 *
 */
add_shortcode( 'tumblr_shares', 'swps_post_tumblr_shares' );
function swps_post_tumblr_shares( $atts ) {
    $shares = get_post_meta( get_the_ID() , '_tumblr_shares', true );
    if( false == $shares ){
        return 0;
    } else {
        $shares = swp_kilomega( $shares );
        return $shares;
    }
}

/**
 * swps_sitewide_tumblr_shares() - A function to output the total number of tumblr shares sitewide.
 *
 * @param  array $atts An array of parameters parsed from the shortcode attributes
 * @return string The total number of sitewide shares.
 *
 */
   add_shortcode( 'sitewide_tumblr_shares', 'swps_sitewide_tumblr_shares()' );
   function swps_sitewide_tumblr_shares( $atts ) {
   	global $wpdb;
   	$sum = $wpdb->get_results( "SELECT SUM(meta_value) AS total FROM $wpdb->postmeta WHERE meta_key = '_tumblr_shares'" );
   	return swp_kilomega( $sum[0]->total );
   }

/**
 * swps_post_yummly_shares() - A function to output the number of yummly shares on a given post.
 *
 * @since  1.0.0
 * @param  array $atts An array of parameters parsed from the shortcode.
 * @return string The number of yummly shares formatted accordingly
 *
 */
add_shortcode( 'yummly_shares', 'swps_post_yummly_shares' );
function swps_post_yummly_shares( $atts ) {
    $shares = get_post_meta( get_the_ID() , '_yummly_shares', true );
    if( false == $shares ){
        return 0;
    } else {
        $shares = swp_kilomega( $shares );
        return $shares;
    }
}
