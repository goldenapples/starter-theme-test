/**
 * Block grouping for a tabbed layout block.
 */

import { InnerBlocks } from '@wordpress/block-editor';
import { __ } from '@wordpress/i18n';

export const name = 'starter-blocks/projects-standards';

/**
 * Base inner blocks template on block creation; can be edited on individual blocks.
 */
const INNER_BLOCKS_TEMPLATE = [
	[
		'core/heading',
		{
			align: 'center',
			content: __( 'Tabbed layout block', 'altis-starter-admin' ),
		},
	],
	[
		'core/list',
		{
			className: 'tabbed-nav-list',
			values:
				'<li><a href="#tab-1">Tab 1</a></li><li><a href="#tab-2">Tab 2</a></li>',
		},
	],
	[
		'core/group',
		{
			className: 'tabbed-content tab-1',
		},
		[
			[
				'core/heading',
				{
					align: 'center',
					className: 'section-heading',
					level: 3,
					content: __(
						'Tab 1 section heading',
						'altis-starter-admin'
					),
				},
			],
			[
				'core/paragraph',
				{
					align: 'center',
					content: __(
						'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi lacus ipsum, ullamcorper id nisi ut, fermentum eleifend nisl. Vivamus a pellentesque nibh.',
						'altis-starter-admin'
					),
				},
			],
			[
				'core/buttons',
				{
					align: 'center',
				},
				[
					[
						'core/button',
						{
							text: __( 'Read more', 'altis-starter-admin' ),
							url: '#',
						},
					],
				],
			],
		],
	],
	[
		'core/group',
		{
			className: 'tabbed-content tab-2',
		},
		[
			[
				'core/heading',
				{
					align: 'center',
					className: 'section-heading',
					level: 3,
					content: __(
						'Tab 2 section heading',
						'altis-starter-admin'
					),
				},
			],
			[
				'core/paragraph',
				{
					align: 'center',
					content: __(
						'Mauris vel quam nec purus convallis posuere. Vestibulum justo sem, sodales quis elit tempus, suscipit mattis arcu. Vivamus rhoncus urna vel consequat tempor.',
						'altis-starter-admin'
					),
				},
			],
			[
				'core/buttons',
				{
					align: 'center',
				},
				[
					[
						'core/button',
						{
							text: __( 'Read more', 'altis-starter-admin' ),
							url: '#',
						},
					],
				],
			],
		],
	],
];

export const settings = {
	title: __( 'Tabbed layout block', 'altis-starter-admin' ),

	description: __(
		'Preformatted block grouping for a tabbed layout block.',
		'altis-starter-admin'
	),

	icon: 'block-default',

	category: 'starter-blocks',

	/**
	 * Provide an interface for editing inner blocks.
	 *
	 * @returns {Element} Formatted blocks.
	 */
	edit: () => {
		return (
			<section className="tabbed-layout">
				<InnerBlocks template={ INNER_BLOCKS_TEMPLATE } />
			</section>
		);
	},

	/**
	 * Saves a basic wrapper block with a template of inner blocks
	 *
	 * @returns {Element} Formatted blocks.
	 */
	save: () => {
		return (
			<section className="tabbed-layout">
				<InnerBlocks.Content />
			</section>
		);
	},
};
