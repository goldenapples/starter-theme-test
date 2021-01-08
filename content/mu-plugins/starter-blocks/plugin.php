<?php
/**
 * Starter Theme Blocks.
 *
 * Register and define behavior for custom blocks on this site. This file
 * requires all other plugin files, then kicks off the bootstrap process.
 *
 * @author    Human Made
 * @license   GPL-2.0+
 * @copyright 2021 Human Made and Contributors
 *
 * @wordpress-plugin
 * Plugin Name: Starter Theme Blocks
 * Description: Register and define behavior for custom blocks on this site
 * License:     GPL-2.0+
 */

namespace Starter_Blocks;

require_once __DIR__ . '/inc/assets.php';
require_once __DIR__ . '/inc/namespace.php';

bootstrap();
