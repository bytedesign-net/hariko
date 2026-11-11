<?php
/**
 * Hariko theme functions.
 *
 * The root style.css is reserved for end-user custom CSS and is
 * intentionally not enqueued. The theme's own stylesheet lives in
 * assets/css/theme.css.
 *
 * @package Hariko
 */

add_action( 'after_setup_theme', 'hariko_setup' );
function hariko_setup() {
	add_theme_support( 'editor-styles' );
	add_editor_style( 'editor-style.css' );
}

add_action( 'wp_enqueue_scripts', 'hariko_enqueue_styles' );
function hariko_enqueue_styles() {
	wp_enqueue_style(
		'hariko-theme',
		get_theme_file_uri( 'assets/css/theme.css' ),
		array(),
		wp_get_theme()->get( 'Version' )
	);
}
