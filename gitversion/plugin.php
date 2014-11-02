<?php
/*
Plugin Name: Git Version
Plugin URI: http://github.com/chtaube/YOURLS-plugin-gitversion
Description: Plugin to add the git version string (from git describe --long) to the footer within the admin area.
Version: 0.1
Author: chtaube
Author URI: http://chtaube.eu/
*/

// No direct call
if( !defined( 'YOURLS_ABSPATH' ) ) die();

yourls_add_filter( 'html_footer_text', 'chtaube_add_git_version' );


function chtaube_add_git_version( $value ) {
	/*
	* Check if we are really under git version control. Otherwise exit silently.
	*/
	if ( ! file_exists( YOURLS_ABSPATH . '/.git' ) ) {
		return $value;
	}

	/*
	* Look for the version string within the .git/version file.
	* Please note that you have to add git hooks for this to work!
	*/
	if ( file_exists( YOURLS_ABSPATH . '/.git/version' ) ) {

		$filestring = file_get_contents( YOURLS_ABSPATH . '/.git/version', false, NULL, -1, 200);
		if ( $filestring === false ) {
			$value = $value . "<br>Git repository detected, but failed reading <tt>version</tt> file.";
			return $value;
		}

		$line= explode( "\n", $filestring, 3 );

		$gitversion = preg_filter( '/^(.+)-([0-9]+)-g([0-9a-f]+)$/', 'v $1-git-$2.$3', $line[0]);
		// Check if preg_filter() failed
		if ( is_null( $gitversion ) ) {
			$value = $value . '<br>Git repository detected, but did not understand version information.';
			return $value;
		}
		$value = $value . "<br>" . $gitversion;
		// Do we have a git ref to add?
		if ( ( count( $line) >= 2 ) and ( $line[1] != "" ) ) {
			$gitrefs = $line[1];
			$value = $value . " on " . $gitrefs;
		}
	} else {
		// No version file -> fail gracefully.
		// TODO: Try to exec `git describe` as a last resort.
		$value = $value . '<br>Git repository detected, but no <tt>version</tt> file was found.';
	}
	return $value;
}

/* vim: set ts=4 sw=4 tw=0 ft=php noet :*/
