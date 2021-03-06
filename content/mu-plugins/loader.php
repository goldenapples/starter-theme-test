<?php
/**
 * Plugin Name: HM MU Plugin Loader
 * Description: Loads the MU plugins required to run the site
 * Author: Human Made Limited
 * Author URI: http://hmn.md/
 * Version: 1.0
 */

if ( defined( 'WP_INITIAL_INSTALL' ) && WP_INITIAL_INSTALL ) {
	return;
}

// Load the Composer autoloader.
require_once Altis\ROOT_DIR . '/vendor/autoload.php';

// Plugins to be loaded for any site.
$global_mu_plugins = [
	'asset-loader/asset-loader.php',
	'starter-blocks/plugin.php',
];

// Load the plugin files.
foreach ( $global_mu_plugins as $file ) {
	// phpcs:disable PHPCS_SecurityAudit.BadFunctions.FilesystemFunctions.WarnFilesystem
	if ( file_exists( WPMU_PLUGIN_DIR . '/' . $file ) ) {
		// phpcs:disable PHPCS_SecurityAudit.Misc.IncludeMismatch.ErrMiscIncludeMismatchNoExt
		require_once WPMU_PLUGIN_DIR . '/' . $file;
		// phpcs:enable
	}
}
