<?php
/**
 * Plugin Name:     Random Quote Single Page Application
 * Plugin URI:      https://github.com/KokkieH/random-quote-spa
 * Description:     Random quote generator
 * Author:          KokkieH
 * Author URI:      https://kokkieh.blog/
 * Text Domain:     kokkieh-random-quote-spa
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Random_Quote_Spa
 */

// Register custom plugin settings
require_once __DIR__ . '/include/class-settings.php';
new KokkieH_Settings();