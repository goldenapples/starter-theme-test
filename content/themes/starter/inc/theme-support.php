<?php
/**
 * Theme support functions.
 */

namespace Starter_Theme\Theme_Support;

/**
 * Bootstrap all the theme functions.
 *
 * @return void
 */
function bootstrap() {
	// Add actions and filters.
	add_action( 'after_setup_theme', __NAMESPACE__ . '\\set_theme_support' );
	add_action( 'after_setup_theme', __NAMESPACE__ . '\\content_width', 0 );
	add_filter( 'image_size_names_choose', __NAMESPACE__ . '\\register_custom_img_sizes' );
}

/**
 * Setup theme supports.
 *
 * @return void
 */
function set_theme_support() {
	// Add theme support for featured images.
	add_theme_support( 'post-thumbnails' );

	// Add custom image sizes.
	add_image_size( 'header-full', 1440, 350, true );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		[
			'height'      => 150,
			'width'       => 500,
			'flex-width'  => true,
			'flex-height' => true,
		]
	);

	// Add theme support for altis's design system colors.
	add_theme_support(
		'editor-color-palette',
		[
			[
				'name' => __( 'Cobalt', 'altis-starter-admin' ),
				'slug' => 'cobalt',
				'color' => '#4667de',
			],
			[
				'name' => __( 'Deep Blue', 'altis-starter-admin' ),
				'slug' => 'deep-blue',
				'color' => '#152a4e',
			],
		]
	);

	// Add theme support for font size selection matching theme typography.
	add_theme_support(
		'editor-font-sizes',
		[
			[
				'name' => __( 'X-Small', 'altis-starter-admin' ),
				'shortName' => __( 'XS', 'altis-starter-admin' ),
				'size' => 12,
				'slug' => 'xsmall',
			],
			[
				'name' => __( 'Small', 'altis-starter-admin' ),
				'shortName' => __( 'XS', 'altis-starter-admin' ),
				'size' => 14,
				'slug' => 'small',
			],
			[
				'name' => __( 'Normal', 'altis-starter-admin' ),
				'shortName' => __( 'N', 'altis-starter-admin' ),
				'size' => 16,
				'slug' => 'normal',
			],
			[
				'name' => __( 'Medium', 'altis-starter-admin' ),
				'shortName' => __( 'M', 'altis-starter-admin' ),
				'size' => 20,
				'slug' => 'medium',
			],
			[
				'name' => __( 'Large', 'altis-starter-admin' ),
				'shortName' => __( 'L', 'altis-starter-admin' ),
				'size' => 26,
				'slug' => 'large',
			],
			[
				'name' => __( 'Jumbo', 'altis-starter-admin' ),
				'shortName' => __( 'J', 'altis-starter-admin' ),
				'size' => 60,
				'slug' => 'jumbo',
			],
		]
	);

	// Allow for "wide" and "full" alignment options on blocks that support them.
	add_theme_support( 'align-wide' );

	// Block editor - maintain embed aspect ratios.
	add_theme_support( 'responsive-embeds' );

	// Register theme styles for the editor.
	add_theme_support( 'editor-styles' );
	add_editor_style( 'build/starter-editor-styles.css' );

	// Disable custom colors and gradients.
	add_theme_support( 'disable-custom-colors' );
	add_theme_support( 'disable-custom-gradients' );

	// Block editor - disable setting font sizes by pixel size.
	add_theme_support( 'disable-custom-font-sizes' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// This theme uses wp_nav_menu() in a few locations.
	register_nav_menus(
		[
			'primary-nav'  => esc_html__( 'Primary', 'altis-starter-admin' ),
		]
	);

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5',
		[
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		]
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function content_width() {
	$GLOBALS['content_width'] = apply_filters( 'altis_content_width', 1140 );
}

/**
 * Add custom image sizes to admin selectors.
 *
 * @param array $sizes Existing image sizes.
 * @return array $sizes New array of image sizes.
 */
function register_custom_img_sizes( $sizes ) {
	$custom_sizes = [
		'header-full' => esc_html__( 'Full width header', 'altis-starter-admin' ),
	];
	return array_merge( $sizes, $custom_sizes );
}
