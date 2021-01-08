/**
 * The entrypoint for the theme scripts & styles.
 *
 * Any other file in this directory can be renamed, but Webpack needs this one
 * to be here as expected :)
 */

import './scss/_index.scss';

// eslint-disable-next-line no-console
console.log( 'The theme frontend script bundle is loading' );

require( './js/tabbed' );
