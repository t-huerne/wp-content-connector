/**
 * WordPress dependencies
 */
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, RangeControl, TextControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';

/**
 * Editor component
 */
export default function Edit({ attributes, setAttributes }) {
	const { postsToShow, dateFormat } = attributes;
	const blockProps = useBlockProps();

	return (
		<>
			<InspectorControls>
				<PanelBody title={__('Settings', 'wp-content-connector')}>
					<RangeControl
						label={__('Number of posts to show', 'wp-content-connector')}
						value={postsToShow}
						onChange={(value) => setAttributes({ postsToShow: value })}
						min={1}
						max={6}
					/>
					<TextControl
						label={__('Date format', 'wp-content-connector')}
						value={dateFormat}
						onChange={(value) => setAttributes({ dateFormat: value })}
						help={__('PHP date format (e.g., F j, Y)', 'wp-content-connector')}
					/>
				</PanelBody>
			</InspectorControls>

			<div {...blockProps}>
				<div className="related-posts-preview">
					<h3>{__('Related Posts', 'wp-content-connector')}</h3>
					<p>
						{__(`Will display ${postsToShow} related posts on the frontend.`, 'wp-content-connector')}
					</p>
					<p className="description">
						{__('Preview will be available after publishing.', 'wp-content-connector')}
					</p>
				</div>
			</div>
		</>
	);
}