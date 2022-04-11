<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class KokkieH_quote_spa_REST_API {

    public function __construct() {
        add_action( 'rest_api_init', array( $this, 'kokkieh_quote_spa_register_endpoints' ) );
    }

    // Register new route
    public function kokkieh_quote_spa_register_endpoints() {
        register_rest_route(
            'kokkieh/v1', 
            '/quote', 
            array(
                'methods' => 'GET',
                'callback' => array( $this, 'kokkieh_quote_spa_get_quote' ),
            )
        );
    }

    // API call to fetch remote data
    public function kokkieh_quote_spa_get_quote() {
        $quotes_url = $this->kokkieh_quote_spa_get_url();
        if ( is_wp_error( $quotes_url ) ) {
            return false;
        }
        $quotes_request = wp_remote_get( $quotes_url );
        if ( is_wp_error( $quotes_request ) ) {
            return false;
        }
        $quotes_content = wp_remote_retrieve_body( $quotes_request );
        return json_decode( $quotes_content, true );
    }

    // Construct URL for fetching remote data
    private function kokkieh_quote_spa_get_url() {
        $user_id  = get_option( 'kokkieh_quote_spa_user_id' );
        $api_key = get_option( 'kokkieh_quote_spa_api_key' );

        if ( empty( $user_id ) || empty( $api_key ) ) {
            return new WP_Error( 'Cannot retrieve user ID or API key. Please visit the plugin\'s settings page.' );
        }

        return "https://www.stands4.com/services/v2/quotes.php?uid={$user_id}&tokenid={$api_key}&searchtype=AUTHOR&query=William+Shakespeare&format=json";
    }
}