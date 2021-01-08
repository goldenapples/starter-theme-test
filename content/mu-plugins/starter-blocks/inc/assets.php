<?php
/**
 * Main file for Starter_Blocks namespace.
 */

namespace Starter_Blocks\Assets;

use Asset_Loader;

/**
 * Connect namespace methods to hooks and filters.
 *
 * @return void
 */
function bootstrap() : void {
	add_action( 'enqueue_block_editor_assets', __NAMESPACE__ . '\\enqueue_editor_assets' );
	add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\\enqueue_frontend_assets' );
	add_filter( 'block_categories', __NAMESPACE__ . '\\add_block_category', 10, 1 );
}

/**
 * Enqueue editor assets.
 */
function enqueue_editor_assets() {
	Asset_Loader\enqueue_asset(
		dirname( __DIR__ ) . '/build/asset-manifest.json',
		'starter-blocks-editor.js',
		[
			'handle'       => 'starter-blocks-editor',
			'dependencies' => [
				'wp-block-editor',
				'wp-blocks',
				'wp-compose',
				'wp-components',
				'wp-data',
				'wp-editor',
				'wp-hooks',
				'wp-i18n',
			],
		]
	);

	Asset_Loader\enqueue_asset(
		dirname( __DIR__ ) . '/build/asset-manifest.json',
		'starter-blocks-editor.css',
		[
			'handle'       => 'starter-blocks-editor',
			'dependencies' => [
				'wp-block-editor',
			],
		]
	);
}

/**
 * Enqueue frontend assets.
 */
function enqueue_frontend_assets() : void {
	Asset_Loader\enqueue_asset(
		dirname( __DIR__ ) . '/build/asset-manifest.json',
		'starter-blocks-frontend.js',
		[
			'handle'       => 'starter-blocks-frontend',
			'dependencies' => [],
		]
	);
	Asset_Loader\enqueue_asset(
		dirname( __DIR__ ) . '/build/asset-manifest.json',
		'starter-blocks-frontend.css',
		[
			'handle' => 'starter-blocks-frontend',
		]
	);
}

/**
 * Register a custom block category for this plugin.
 *
 * @param array $categories The list of available block categories.
 * @return array The filtered categories list.
 */
function add_block_category( array $categories ) {
	return array_merge( $categories, [
		[
			'slug'  => 'starter-blocks',
			'title' => 'Starter Blocks',
		],
	] );
}
