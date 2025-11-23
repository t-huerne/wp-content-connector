<?php
/**
 * Block Registration
 * 
 * Registers custom Gutenberg blocks.
 *
 * @package WP_Content_Connector
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register all custom blocks.
 */
function wcc_register_blocks() {
	register_block_type( 
		plugin_dir_path( __FILE__ ) . '../blocks/related-posts/block.json',
		array(
			'render_callback' => 'wcc_render_related_posts_block',
		)
	);
}
add_action( 'init', 'wcc_register_blocks' );

/**
 * Render callback for the Related Posts block.
 *
 * Instead of rendering HTML directly, this creates a container div
 * that React will hydrate on the frontend.
 *
 * @param array $attributes Block attributes.
 * @return string HTML container with data attributes.
 */
function wcc_render_related_posts_block( $attributes ) {
	$posts_to_show = isset( $attributes['postsToShow'] ) ? absint( $attributes['postsToShow'] ) : 6;
	$date_format   = isset( $attributes['dateFormat'] ) ? sanitize_text_field( $attributes['dateFormat'] ) : 'F j, Y';
	
	// Get current post ID
	$post_id = get_the_ID();
	
	if ( ! $post_id ) {
		return '';
	}
	
	// Return a container div with data attributes
	// React will hydrate this container with the actual content
	return sprintf(
		'<div class="wp-block-wcc-related-posts" data-post-id="%d" data-posts-to-show="%d" data-date-format="%s"></div>',
		esc_attr( $post_id ),
		esc_attr( $posts_to_show ),
		esc_attr( $date_format )
	);
}
