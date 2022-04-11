<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class KokkieH_Settings {
    private const SETTINGS_SECTION = 'kokkieh_quote_spa_main';
    private const PAGE_SLUG        = 'kokkieh_random_quote_spa';

    public function __construct() {
        // Register Settings
        add_action( 'admin_init', array( $this, 'kokkieh_quote_spa_register_settings' ) );

        // Add a menu item
        add_action('admin_menu', array( $this, 'kokkieh_quote_spa_create_menu' ), 100);
    }
    
    // Create Settings menu item

    public function kokkieh_quote_spa_create_menu() {
        add_options_page(
            __( 'Random Quote SPA Settings', 'kokkieh-random-quote-spa' ),
            __( 'Random Quote SPA', 'kokkieh-random-quote-spa' ),
            'manage_options',
            self::PAGE_SLUG,
            array( $this, 'kokkieh_quote_spa_settings_page' ),
        );
    }

    // Create Settings page

    public function kokkieh_quote_spa_settings_page() {
        ?>
        <div class="wrap">
            <h2><?php _e( 'Random Quote SPA', 'kokkieh-random-quote-spa' ) ?></h2>
            <form method="POST" action="options.php">
            <?php
                settings_fields( self::PAGE_SLUG );
                do_settings_sections( self::PAGE_SLUG );
                submit_button( __( 'Save Changes', 'kokkieh-random-quote-spa' ), 'primary' );
            ?>
            </form>
            <p><?php echo $this->kokkieh_quote_spa_attribution_link() ?></p>
        </div>
        <?php
    }

    // Add settings to page

    public function kokkieh_quote_spa_register_settings() {
        // Create a section
        add_settings_section(
            self::SETTINGS_SECTION,
            __( 'API Credentials', 'kokkieh-random-quote-spa' ),
            array( $this, 'kokkieh_quote_spa_section_text'),
            self::PAGE_SLUG
        );
    
        // Username
        add_settings_field(
            'kokkieh_quote_spa_username',
            __( 'Username', 'kokkieh-random-quote-spa' ),
            array( $this, 'kokkieh_quote_spa_render_username'),
            self::PAGE_SLUG,
            self::SETTINGS_SECTION
        );

        // API key
        add_settings_field(
            'kokkieh_quote_spa_api_key',
            __( 'API Key', 'kokkieh-random-quote-spa' ),
            array( $this, 'kokkieh_quote_spa_render_api_key'),
            self::PAGE_SLUG,
            self::SETTINGS_SECTION
        );

        register_setting( self::PAGE_SLUG, 'kokkieh_quote_spa_username' );
        register_setting( self::PAGE_SLUG, 'kokkieh_quote_spa_api_key' );
    }

    // Insert section description

    public function kokkieh_quote_spa_section_text() {
        echo '<p>' . __('Quotes.net API Credentials', 'kokkieh-random-quote-spa' ) . '</p>';
    }

    // Insert form values

    public function kokkieh_quote_spa_render_username() {
        $this->kokkieh_quote_spa_render_options( 'kokkieh_quote_spa_username' );
    }

    public function kokkieh_quote_spa_render_api_key() {
        $this->kokkieh_quote_spa_render_options( 'kokkieh_quote_spa_api_key' );
    }

    private function kokkieh_quote_spa_render_options( $option_name ) {
        $options = get_option( $option_name );
        $name = $options[ 'name' ];
        echo "<input id='name' 
            name='" . esc_attr( $option_name ) . "[name]'
            type='text' 
            value='" . esc_attr( $name ) . "'/>";
    }

    // Function to add API attribution text

    public function kokkieh_quote_spa_attribution_link() {
        $kokkieh_quote_spa_attr_url = 'http://www.quotes.net/quotes_api.php';
        return sprintf(
            esc_html__( 'Powered by the STANDS4 Web Services %s', 'kokkieh-random-quote-spa'),
            sprintf(
                '<a href="%s">%s</a>',
                $kokkieh_quote_spa_attr_url,
                esc_html__( 'Quotes API', 'kokkieh-random-quote-spa' )
            )
        );
    }

}