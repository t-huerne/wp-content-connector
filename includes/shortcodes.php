<?php
/**
 * Shortcodes
 *
 * Custom shortcodes for the WP Content Connector plugin.
 *
 * @package WP_Content_Connector
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Displays the current date with customizable format.
 *
 * @param array $atts Shortcode attributes.
 * @return string Formatted current date.
 */
function wcc_display_current_date( $atts ) {
	$atts = shortcode_atts(
		array(
			'format' => get_option( 'date_format' ),
		),
		$atts,
		'current_date'
	);
	
	$format = $atts['format'];
	$date   = wp_date( $format );
	
	return esc_html( $date );
}
add_shortcode( 'current_date', 'wcc_display_current_date' );
