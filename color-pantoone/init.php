<?php
/**
 * Plugin Name:WP Color Pantone
 * Plugin URI: https://themesbyte.com
 * Description: Color pantone for garment's.
 * Version: 1.0
 * Author: B.M. Rafiul Alam
 * Author URI: https://themesbyte.com
 * Requires at least: 5.2
 * Tested up to: 5.5
 * Requires PHP: 7.0
 * Text Domain: wcp
 * Domain Path: /languages/
 * License: GPL2+
 *
 * @package wpc
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Define constants

define( 'WCP_VERSION', '1.0' );
define( 'WCP_DIR', untrailingslashit( plugin_dir_path( __FILE__ ) ) );
define( 'WCP_PATH', untrailingslashit( plugins_url( basename( plugin_dir_path( __FILE__ ) ), basename( __FILE__ ) ) ) );
define( 'WCP_BASE', plugin_basename( __FILE__ ) );


function wcp_load_scripts() {
	wp_enqueue_script('jquery');
    wp_enqueue_style( 'animate_css', WCP_PATH . '/assets/css/animate.min.css', WCP_VERSION);
    wp_enqueue_style( 'wcp_style', WCP_PATH . '/assets/css/wpc-style.css', WCP_VERSION);
    wp_enqueue_style ( 'wpc_css' );
}
add_action('wp_enqueue_scripts', 'wcp_load_scripts');

require_once WCP_DIR .'/wcp-backend.php';












