<?php
/**
 * WP-CLI utilities required by default.
 *
 * To add utility commands to this repo, add files to the wp-cli directory.
 */

foreach ( glob( __DIR__ . '/wp-cli/*.php' ) as $file ) {
	require $file;
}
