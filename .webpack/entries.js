/**
 * Define the separate Webpack build targets for the theme and plugin folders.
 */

const { externals, helpers, plugins } = require( '@humanmade/webpack-helpers' );

const { filePath } = helpers;

/**
 * filePath wrapper that accepts paths relative to mu-plugins/starter-blocks
 *
 * @param {...string} parts One or more path components relative to the plugin.
 * @returns {string} Full absolute path string.
 */
const blockPluginPath = ( ...parts ) => filePath( 'content', 'mu-plugins', 'starter-blocks', ...parts );

/**
 * filePath wrapper that accepts paths relative to themes/starter
 *
 * @param {...string} parts One or more path components relative to the plugin.
 * @returns {string} Full absolute path string.
 */
const themePath = ( ...parts ) => filePath( 'content', 'themes', 'starter', ...parts );

/**
 * Configuration for the Starter Blocks plugin, which exposes several bundles
 * for use on the frontend and/or within the editor.
 */
const blocksPlugin = {
	name: 'blocks',
	context: blockPluginPath( 'src' ),
	externals,
	entry: {
		'starter-blocks-editor': blockPluginPath( 'src', 'editor.js' ),
		'starter-blocks-frontend': blockPluginPath( 'src', 'frontend.js' ),
	},
	output: {
		path: blockPluginPath( 'build' ),
	},
	plugins: [
		plugins.manifest(),
	],
};

/**
 * Configuration for the Starter theme, which exposes a style and a script bundle.
 */
const theme = {
	name: 'theme',
	context: themePath( 'src' ),
	// Externals are NOT declared here yet, because the theme may not need to
	// load any bundled WP dependency (whereas the editor bundle certainly does).
	entry: {
		'starter-theme': themePath( 'src', 'index.js' ),
		'starter-editor-styles': themePath( 'src', 'editor-styles.js' )
	},
	output: {
		path: themePath( 'build' ),
	},
};

module.exports = [
	blocksPlugin,
	theme,
];
