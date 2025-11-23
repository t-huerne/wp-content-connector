<?php
/**
 * Full Site Editing Integration
 * 
 * Registers custom block templates located in the plugin.
 *
 * @package WP_Content_Connector
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register custom template types for the Site Editor.
 * This makes the template appear as a selectable option in the Template dropdown.
 *
 * @param array $template_types The existing default template types.
 * @return array Modified template types array.
 */
function wcc_register_template_types( $template_types ) {
	$template_types['single-wcc-sample'] = array(
		'title'       => __( 'WCC Single Post', 'wp-content-connector' ),
		'description' => __( 'Custom single post template with dynamic date and related posts.', 'wp-content-connector' ),
	);
	return $template_types;
}
add_filter( 'default_template_types', 'wcc_register_template_types' );

/**
 * Inject the custom template into the Block Template hierarchy.
 * This makes it appear in the Site Editor and Post Template selector.
 *
 * @param array  $query_result Array of template objects.
 * @param array  $query        Arguments for the query.
 * @param string $template_type Template type being queried.
 * @return array Modified templates array.
 */
function wcc_register_block_template( $query_result, $query, $template_type ) {
	// Only proceed if we are querying 'wp_template' (not template parts)
	if ( 'wp_template' !== $template_type ) {
		return $query_result;
	}

	// Define our custom template
	$template_slug = 'single-wcc-sample';
	$template_file = plugin_dir_path( __DIR__ ) . 'templates/single-wcc-sample.html';

	// Check if the file exists
	if ( ! file_exists( $template_file ) ) {
		return $query_result;
	}

	// Check if we are searching for this specific template or all templates
	// Also check if it's already in the result (theme override)
	$should_include = true;
	
	// If specific slug requested, check if it matches ours
	if ( ! empty( $query['slug__in'] ) && ! in_array( $template_slug, $query['slug__in'], true ) ) {
		$should_include = false;
	}

	// If it's already found (e.g. customized by user or provided by theme), don't override
	foreach ( $query_result as $template ) {
		if ( $template->slug === $template_slug ) {
			$should_include = false;
			break;
		}
	}

	if ( $should_include ) {
		$new_template = new WP_Block_Template();
		$new_template->id             = 'wp-content-connector//' . $template_slug;
		$new_template->theme          = get_stylesheet();
		$new_template->slug           = $template_slug;
		$new_template->source         = 'plugin';
		$new_template->origin         = 'plugin';
		$new_template->type           = 'wp_template';
		$new_template->title          = __( 'WCC Single Post', 'wp-content-connector' );
		$new_template->description    = __( 'Custom single post template with dynamic date.', 'wp-content-connector' );
		$new_template->content        = file_get_contents( $template_file );
		$new_template->status         = 'publish';
		$new_template->has_theme_file = false;
		$new_template->is_custom      = true;
		$new_template->post_types     = array( 'post' );
		$new_template->area           = 'uncategorized';

		$query_result[] = $new_template;
	}

	return $query_result;
}
add_filter( 'get_block_templates', 'wcc_register_block_template', 10, 3 );
