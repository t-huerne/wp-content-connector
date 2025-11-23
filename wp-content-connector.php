<?php
/**
 * Plugin Name:       WP Content Connector
 * Description:       A robust system to connect related content via REST API, React Blocks, and FSE Templates.
 * Version:           1.0.0
 * Author:            Timothée Huerne
 * Text Domain:       wp-content-connector
 * Requires PHP:      7.4
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Define plugin constants
define( 'WCC_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'WCC_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

// Include required files
require_once WCC_PLUGIN_PATH . 'includes/shortcodes.php';
require_once WCC_PLUGIN_PATH . 'includes/related_posts_rest_api.php';
require_once WCC_PLUGIN_PATH . 'includes/filters.php';
require_once WCC_PLUGIN_PATH . 'includes/block-registration.php';
require_once WCC_PLUGIN_PATH . 'includes/fse-integration.php';
