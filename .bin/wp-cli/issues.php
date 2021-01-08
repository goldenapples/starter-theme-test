<?php
/**
 * Create starter issues in this repository.
 *
 * phpcs:disable PSR1.Files.SideEffects
 * phpcs:disable HM.Files.NamespaceDirectoryName
 */

namespace Starter_Theme\CLI\Issues;

use WP_CLI;
use WP_CLI\Utils;

/**
 * Create issues on a project.
 *
 * ## OPTIONS
 *
 * [--file=<file>]
 * : Path to a CSV file containing issues. Defaults to the starter-issues.csv file in parent directory.
 *
 * [--dry-run]
 * : Show commands that would have been run, without making any external requests.
 *
 * @when before_wp_load
 * @param [] $args Positional args (none available)
 * @param [] $assoc_args Keyword args passed as command-line options.
 */
function create_issues( $args, $assoc_args ) {

	// Check that `gh` utility is installed, and display the repository name for confirmation.
	confirm_repo();

	// Path to CSV containing list of starter issues.
	$file_path = $assoc_args['file'] ?? dirname( __DIR__ ) . '/starter-issues.csv';

	// If '--dry-run' flag is set, no remote calls will be made.
	$is_dry_running = Utils\get_flag_value( $assoc_args, 'dry-run' );

	$file = fopen( $file_path, 'r' );
	$headers = array_map( 'strtolower', fgetcsv( $file ) );

	// phpcs:ignore WordPress.CodeAnalysis
	while ( $line = fgetcsv( $file ) ) {
		$issue = array_combine( $headers, $line );

		WP_CLI::log(
			sprintf( 'Creating issue "%s".', $issue['title'] )
		);

		$cmd = 'gh issue create' .
			' --title ' . escapeshellarg( $issue['title'] ) .
			' --body ' . escapeshellarg( build_issue_body( $issue ) ) .
			( ! empty( $issue['tags'] ) ? ' --label ' . escapeshellarg( $issue['tags'] ) : '' ) .
			( ! empty( $issue['milestone'] ) ? ' --milestone ' . escapeshellarg( $issue['milestone'] ) : '' );

		// Unless "dry-run" is specified, create the issues now.
		if ( ! $is_dry_running ) {
			system( $cmd ); // phpcs:ignore WordPress.PHP.DiscouragedPHPFunctions
		}
	}
}

/**
 * Check that GH connection is valid, and prompt for confirmation.
 *
 * Exits early if the user doesn't have the `gh` command-line utility
 * installed, or the origin remote doesn't exist. Displays the name of the
 * remote configured and prompts for confirmation before creating issues in it
 * (this is mainly a safety check in case people clone the starter-theme repo
 * and try to run this command before updating the remote!).
 */
function confirm_repo() {
	// phpcs:ignore WordPress.PHP.DiscouragedPHPFunctions
	$remote = system( "gh repo view | head -n1 | awk '{print $2}'", $error );

	if ( $error || ! $remote ) {
		WP_CLI::error( 'The `gh` utility must be avilable on your system and a github remote must be connected.' );
		exit;
	}

	WP_CLI::confirm(
		sprintf(
			'Are you sure you want to create issues in the %s repository?',
			$remote
		)
	);
}

/**
 * Build the body of the issues to create.
 *
 * TODO: This should probably be replaced with an actual template at some point
 * for user configurability.
 *
 * @param [] $issue Issue, as read from csv input.
 */
function build_issue_body( $issue ) {

	$user_story = str_replace( PHP_EOL, PHP_EOL . '> ', $issue['user story'] );
	return <<<EOF

## User Story

> {$user_story}

## Description

{$issue['description']}

## Designs or screenshots

## Acceptance criteria

to come

EOF;
}

WP_CLI::add_command( 'scaffold issues', __NAMESPACE__ . '\\create_issues' );
