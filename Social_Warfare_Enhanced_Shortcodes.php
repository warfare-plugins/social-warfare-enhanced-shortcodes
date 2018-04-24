<?php
class Social_Warfare_Enhanced_Shortcodes extends SWP_Addon {
    public function __construct() {
        parent::__construct();
        $this->name = __( 'Social Warfare - Enhanced Shortcodes', 'social-warfare' );
        $this->key = 'enhanced_shortcodes';
        $this->product_id = 114492;
        $this->version = '1.0.0';
        $this->core_required = '3.0.0';

        if ( $this->is_registered() ) {
            if (version_compare($this->core_version, $this->core_required) >= 0 ) {
                if ( false === get_option( 'social_warfare_enhanced_shortcode', false) ) {
                    $this->init_database();
                }
                $this->add_shortcodes();
            } else {
                throw( "This addon requires Social Warfare version " . $this->core_required . " or higher. Please update our core plugin before activating this one." );
            }
        }
    }

    public function add_shortcodes() {
        global $swp_social_networks;

        foreach($swp_social_networks as $network_key => $object ) {
            //* We can't pass an argument to the callback, so save it as an object property.
            $this->network_key = "${$network}_shares";

            add_shortcode( "${network}_shares", [ $this, 'display_post_shares' ] );
            add_shortcode( "sitewide_${network}_shares", [ $this, 'display_sitewide_shares' ] );
        }

        unset($this->network_key);
    }

    public function display_sitewide_shares() {
        return swp_kilomega( $this->get_total_shares() );
    }

    protected function display_post_shares() {
        global $post;
        get_post_meta( $post->ID, $this->network_key, true );

        return $shares ? swp_kilomega( $shares ) : 0;
    }

    /**
     * Gets the total shares updated within the past 24 hours.
     *
     * If the total shares exist for the requested network and are less than
     * a day old, the total is returned.
     * Otherwise, a new total count is created, then returned.
     *
     * @return integer The total share counts for network.
     */
    protected function fetch_sitewide_shares() {
        $network_shares = get_option( 'social_warfare_enhanced_shortcode' );

        if ( !empty( $network_shares[$this->network_key] ) ) {
            $then = $network_shares[$this->network_key]['timestamp'];
            $now = time();

            if ( 24 * 60 * 60 < ($now - $then) ) {
                return $network_shares[$this->network]['total_shares'];
            }
        }

        //* The total count has not been updated in 24 hours.
        $updated_total = $this->get_total_shares();
        $network_shares[$this->network_key] = [
            'timestamp'     => time(),
            'total_shares'  => $updated_total
        ];

        update_option( 'social_warfare_enhanced_shortcode', $network_shares );

        return $updated_total;
    }


    /**
     * Fetches total share counts for all currently registred networks.
     *
     * If they add networks later, they will not be in here. Instead,
     * the shortcode will check to see if the network has data. If not
     * it will be created and saved at that time.
     *
     * @return bool True if successfully created, false otherwise.
     *
     */
    protected function init_database() {
        global $swp_social_networks;
        $share_data = [];

        foreach ($swp_social_networks as $network_key => $object) {
            $total = $this->get_total_shares( $network );
            $share_data[$this->network_key] = [
                'timestamp'     => time(),
                'total_shares'  => $this->get_total_shares( $network_key )
            ];
        }

        return add_option( 'social_warfare_enhanced_shortcode', $share_data );
    }

    /**
     * Counts the total share data aggregated across posts.
     *
     * This reads all post meta for a given network, sums it,
     * and returns it as an integer.
     *
     *
     * @return integer The total share counts for a given network.
     *
     */
    protected function get_total_shares( $network_key = null ) {
        if ( null === $network_key ) {
            $network_key = $this->network_key;
        }

        $query = "SELECT
                SUM(meta_values)
                AS total
                FROM $wpdb->postmeta
                WHERE meta_key = $network_key";

        $sum = $wpdb->get_results( $total );
        return $sum[0]->total;
    }
}
