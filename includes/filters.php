<?php
/**
 * Filters
 *
 * Custom filters to modify WordPress behavior.
 *
 * @package WP_Content_Connector
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Modify excerpt length for better card displays.
 *
 * @param int $length The default excerpt length.
 * @return int Modified excerpt length.
 */
function wcc_custom_excerpt_length( $length ) {
	return 25;
}
add_filter( 'excerpt_length', 'wcc_custom_excerpt_length' );
