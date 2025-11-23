/**
 * WordPress dependencies
 */
import { registerBlockType } from '@wordpress/blocks';

/**
 * Internal dependencies
 */
import Edit from './edit';
import metadata from '../../blocks/related-posts/block.json';

/**
 * Register the Related Posts block
 */
registerBlockType( metadata.name, {
	edit: Edit,
	// Dynamic block - no save function needed (rendered by PHP)
} );