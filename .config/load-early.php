<?php
/**
 * If a local-config.php file is present, load it. (Runs before WordPress starts.)
 *
 * Use local-config.php to specify WP_DEBUG, SCRIPT_DEBUG, and so on.
 */

if ( is_readable( __DIR__ . '//local-config.php' ) ) {
	require_once __DIR__ . '//local-config.php';
}
