<?php
/**
 * Main file for Starter_Blocks namespace.
 */

namespace Starter_Blocks;

/**
 * Connect namespace methods to hooks and filters.
 *
 * @return void
 */
function bootstrap() : void {
	// Initialize sub-namespaces.
	Assets\bootstrap();
}
