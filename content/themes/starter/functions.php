<?php
/**
 * Starter Theme functions.php: require in the other theme PHP files, and kick
 * off the bootstrapping process.
 */

namespace Starter_Theme;

require_once __DIR__ . '/inc/assets.php';
require_once __DIR__ . '/inc/theme-support.php';

Assets\bootstrap();
Theme_Support\bootstrap();
