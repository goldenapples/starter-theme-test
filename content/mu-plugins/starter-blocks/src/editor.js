/**
 * Dynamically locate, load & register all Editor Blocks & Plugins.
 *
 * Entry point for the "editor.js" bundle.
 */
import { autoloadBlocks, autoloadPlugins } from 'block-editor-hmr';

import './editor.scss';

// eslint-disable-next-line no-console
console.log( 'The admin-side editor script bundle is loading.' );

/**
 * Callback function for hot module updates.
 *
 * @param {Function} context module context function.
 * @param {Function} loadModules load module function.
 */
const acceptContextModules = ( context, loadModules ) => {
	if ( module.hot ) {
		module.hot.accept( context.id, loadModules );
	}
};

// Load all block index files.
autoloadBlocks(
	{
		/**
		 * Execute and return a `require.context()` call.
		 *
		 * @returns {Function} block module context function.
		 */
		getContext: () => require.context( './blocks', true, /index\.js$/ ),
	},
	acceptContextModules
);

// Load all plugin files.
autoloadPlugins(
	{
		/**
		 * Execute and return a `require.context()` call.
		 *
		 * @returns {Function} plugin module context function.
		 */
		getContext: () => require.context( './plugins', true, /index\.js$/ ),
	},
	acceptContextModules
);
