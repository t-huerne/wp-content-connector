<?php
/**
 * REST API Custom Endpoints
 * 
 * Provides custom REST API endpoints for the WP Content Connector plugin.
 *
 * @package WP_Content_Connector
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register custom REST API routes.
 */
function wcc_register_rest_routes() {
    register_rest_route(
        'wcc/v1',
        '/related-posts',
        array(
            'methods'             => 'GET',
            'callback'            => 'wcc_get_related_posts',
            'permission_callback' => '__return_true',
			'args'                => array(
				'post_id' => array(
					'required'          => true,
					'validate_callback' => function( $param ) {
						return is_numeric( $param );
					},
					'sanitize_callback' => 'absint',
				),
				'limit' => array(
					'default'           => 6,
					'validate_callback' => function( $param ) {
						return is_numeric( $param ) && $param > 0 && $param <= 12;
					},
					'sanitize_callback' => 'absint',
				),
				'format' => array(
					'default'           => 'F j, Y',
					'sanitize_callback' => 'sanitize_text_field',
				),
			),
        )
    );
}
add_action( 'rest_api_init', 'wcc_register_rest_routes' );

/**
 * Get related posts based on categories.
 *
 * @param WP_REST_Request $request The REST request object.
 * @return WP_REST_Response|WP_Error Response object on success, or WP_Error on failure.
 */
function wcc_get_related_posts( $request ) {
	$post_id = $request->get_param( 'post_id' );
	$limit   = $request->get_param( 'limit' );
	$format  = $request->get_param( 'format' );
    
    // Verify the post exists
    $post = get_post( $post_id );
    if ( ! $post ) {
        return new WP_Error(
            'post_not_found',
            __( 'Post not found.', 'wp-content-connector' ),
            array( 'status' => 404 )
        );
    }
    
    $categories = wp_get_post_categories( $post_id );
    
    if ( empty( $categories ) ) {
        // No categories, return empty
        return new WP_REST_Response(
            array(
                'success'       => true,
                'related_posts' => array(),
                'message'       => __( 'No categories found for this post.', 'wp-content-connector' ),
            ),
            200
        );
    }
    
	$related_posts = get_posts(
		array(
			'category__in'   => $categories,
			'post__not_in'   => array( $post_id ),
			'posts_per_page' => $limit,
			'orderby'        => 'date',
			'order'          => 'DESC',
			'post_status'    => 'publish',
		)
	);
    
	// Format the response
	$formatted_posts = array_map(
		function( $post ) use ( $format ) {
			return array(
				'id'              => $post->ID,
				'title'           => get_the_title( $post ),
				'date'            => wp_date( $format, strtotime( $post->post_date ) ),
				'excerpt'         => get_the_excerpt( $post ),
				'url'             => get_permalink( $post ),
				'author'          => get_the_author_meta( 'display_name', $post->post_author ),
				'author_avatar'   => get_avatar_url( $post->post_author, array( 'size' => 80 ) ),
				'featured_image'  => get_the_post_thumbnail_url( $post, 'medium' ),
			);
		},
		$related_posts
	);
    
    return new WP_REST_Response(
        array(
            'success'       => true,
            'related_posts' => $formatted_posts,
            'count'         => count( $formatted_posts ),
        ),
        200
    );
}
