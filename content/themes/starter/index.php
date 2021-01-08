<?php
/**
 * The base theme template.
 */

?>

<?php get_header(); ?>

<?php
if ( have_posts() ) :
	// phpcs:ignore Squiz.ControlStructures.ControlSignature.NewlineAfterOpenBrace
	while ( have_posts() ) : the_post();
		the_title();
		the_content();
	endwhile;
endif;
?>

<?php
get_footer();
