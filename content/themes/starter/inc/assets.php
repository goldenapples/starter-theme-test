<?php
/**
 * Main file for Starter Theme namespace.
 */

namespace Starter_Theme\Assets;

use Asset_Loader;

/**
 * Connect namespace methods to hooks and filters.
 *
 * @return void
 */
function bootstrap() : void {
	add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\\enqueue_frontend_assets' );
	add_action( 'enqueue_block_editor_assets', __NAMESPACE__ . '\\enqueue_editor_assets' );
}

/**
 * Enqueue frontend assets.
 */
function enqueue_frontend_assets() : void {
	Asset_Loader\enqueue_asset(
		dirname( __DIR__ ) . '/build/asset-manifest.json',
		'starter-theme.js',
		[
			'handle'       => 'starter-theme',
			'dependencies' => [],
		]
	);
	Asset_Loader\enqueue_asset(
		dirname( __DIR__ ) . '/build/asset-manifest.json',
		'starter-theme.css',
		[
			'handle' => 'starter-theme',
		]
	);
}

/**
 * Enqueue editor style
 */
function enqueue_editor_assets(): void {
	Asset_Loader\enqueue_asset(
		dirname( __DIR__ ) . '/build/asset-manifest.json',
		'starter-editor-styles.js',
		[
			'handle' => 'starter-editor-styles',
		]
	);
	Asset_Loader\enqueue_asset(
		dirname( __DIR__ ) . '/build/asset-manifest.json',
		'starter-editor-styles.css',
		[
			'handle' => 'starter-editor-styles',
		]
	);
}
