/**
 * Promote configurations in entries.js into full production config objects,
 * and export an array of Webpack build configurations.
 */

const { plugins, presets } = require( '@humanmade/webpack-helpers' );

const entries = require( './entries' );

// Promote partial configurations into full config objects. ALL per-build
// customization should be done within the entries.js file, do not add any
// conditionals into this build.
module.exports = entries.map( ( config ) => {

	// Hash production bundle filenames.
	config.output.filename = '[name].[contenthash].js';

	// Add production-mode plugins to all configurations.
	config.plugins = ( config.plugins || [] ).concat( [
		plugins.fixStyleOnlyEntries(),
		plugins.clean(),
		plugins.manifest(),
		// miniCssExtract would be present regardless, but we want to hash the filename.
		plugins.miniCssExtract( {
			filename: '[name].[contenthash].css',
		} ),
	] );

	// Create full-fledged configuration object.
	return presets.production( config );
} );
