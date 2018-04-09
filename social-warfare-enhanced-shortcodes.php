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

add_action( 'plugins_loaded', function() {
    class SWP_Enhanced_Shortcodes extends SWP_Addon {
        public function __construct() {
            $this->name = __( 'Social Warfare - Enhanced Shortcodes', 'social-warfare' );
            $this->key = 'enhanced_shortcodes';
            $this->product_id = 114492;
            $this->version = '1.0.0';
            $this->core_required = '3.0.0';

            if ( $this->is_registerd() ) {
                if (version_compare(SWP_VERSION, $this->core_required) >= 0 ) {
                    $this->add_shortcodes();
                } else {
                    throw( "This addon requires Social Warfare version " . $this->core_required . " or higher. Please update our core plugin before activating this one." );
                }
            }
        }

        public function add_shortcodes() {
            global $Pro_Options_Page;

            $networks = [ 'twitter', 'facebook', 'pinterest', 'google_plus', 'linkedin', 'stumbleupon' ];

            if ( !empty( $Pro_Options_Page) ) {
                array_push( $networks, 'buffer', 'hacker_news', 'reddit', 'tumblr', 'yummly' );
            }

            foreach($networks as $network ) {

                //* We can't pass an argument to the callback, so save it as an object property.
                $this->network_key = "${$network}_shares";

                add_shortcode( "${network}_shares", [ $this, 'fetch_post_shares' ]);
                add_shortcode( "sitewide_${network}_shares", [ $this, 'fetch_sitewide_shares' ]);
            }

            unset $this->network_key;
        }

        protected function fetch_post_shares() {
            global $post;
            get_post_meta( $post->ID, $this->network_key, true );

            return $shares ? swp_kilomega( $shares ) : 0;
        }

        protected function fetch_sitewide_shares() {
            global $wpdb;
            $query = "SELECT
                    SUM(meta_values)
                    AS total
                    FROM $wpdb->postmeta
                    WHERE meta_key = $this->network_key";

            $total = $wpdb->get_results( $total );
            return swp_kilomega( $sum[0]->total );
        }
    }

    new SWP_Enhanced_Shortcodes();
});
