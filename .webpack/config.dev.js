/**
 * Promote configurations in entries.js into full development config objects,
 * and export an array of Webpack build configurations.
 */

const { helpers, presets } = require( '@humanmade/webpack-helpers' );

const entries = require( './entries' );

const { choosePort, cleanOnExit, filePath } = helpers;

// Clean up dev manifest on exit. Assume each build folder has a manifest, and
// schedule all manifests to be removed. This will remove production manifests
// too, so a production build will need to be run after stopping the dev server.
cleanOnExit( entries.map( ( config ) => {
	return `${ config.output.path }/asset-manifest.json`;
} ) );

// Promote partial configurations into full config objects. ALL per-build
// customization should be done within the entries.js file, do not add any
// conditionals into this build.
module.exports = choosePort( 9090 ).then( ( port ) => entries.map( ( config )  => {
	// Inject port information into each configuration.
	config.devServer = {
		...config.devServer,
		https: true,
		port,
	};
	config.output.publicPath = `https://localhost:${ port }${ config.output.path.replace( filePath(), '' ) }/`;

	// Create full-fledged configuration objects.
	return presets.development( config );
} ) );
