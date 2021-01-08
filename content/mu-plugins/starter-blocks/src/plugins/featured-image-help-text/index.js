import { select } from '@wordpress/data';
import { addFilter } from '@wordpress/hooks';
import { __ } from '@wordpress/i18n';

/**
 * Wrap the featured image uploader to add help text.
 *
 * @param {Element} originalComponent The original component.
 *
 * @returns {Element} The component to render.
 */
function wrapPostFeaturedImage( originalComponent ) {
	const postType = select( 'core/editor' ).getCurrentPostType();
	const postTypesArr = [ 'page', 'post' ];

	return ( props ) => {
		// If we're not in a post type we want text for, return early.
		if ( ! postTypesArr.includes( postType ) ) {
			return originalComponent( props );
		}

		// Otherwise, let's output some help text.
		return (
			<>
				{ originalComponent( props ) }
				<div className="components-panel__body-help">
					<p>
						{ __(
							'WordPress will crop or scale the image to the right size. If you need to pre-crop for positioning, the size is:',
							'altis-starter-admin'
						) }
						<br />
						{ postType === 'page' && (
							<>
								{ __(
									'Full width header: 1440 x 350',
									'altis-starter-admin'
								) }
							</>
						) }
						{ postType === 'post' && (
							<>
								{ __(
									'Content width image: 750 x 500',
									'altis-starter-admin'
								) }
							</>
						) }
					</p>
				</div>
			</>
		);
	};
}

addFilter(
	'editor.PostFeaturedImage',
	'featured-image/wrap-post-featured-image',
	wrapPostFeaturedImage
);
