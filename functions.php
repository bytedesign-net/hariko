<?php

add_action( 'after_setup_theme', 'hariko_support' );
function hariko_support() {
	add_theme_support( 'wp-block-styles' );
	add_editor_style('style.css');
}

add_action( 'wp_enqueue_scripts', 'hariko_enqueue' );
function hariko_enqueue() {
    $style_css_path = get_theme_file_path('style.css');
    $style_css_uri = get_stylesheet_uri();
    wp_enqueue_style('hariko-style', $style_css_uri, [], filemtime($style_css_path));

    $global_css_path = get_theme_file_path('assets/css/style.css');
    $global_css_uri = get_theme_file_uri('assets/css/style.css');
    wp_enqueue_style('hariko-global-style', $global_css_uri, [], filemtime($global_css_path));
}

add_action( 'after_setup_theme', 'hariko_add_editor_styles' );
function hariko_add_editor_styles() {
	add_theme_support( 'editor-styles' );
	add_editor_style( array( 'style.css', 'editor-style.css' ) );
}

register_block_style( 'core/navigation', [
    'name' => 'navigation-space',
    'label' => __( 'Navigation Space', 'hariko' ),
    'inline_style' => '.wp-block-navigation__responsive-container.is-menu-open { padding: 20px; }',
]);

//更新の確認
require get_template_directory() . '/plugin-update-checker/plugin-update-checker.php';
use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

$myUpdateChecker = PucFactory::buildUpdateChecker(
	'https://download.bytedesign.net/hariko.json', //Full path to the main plugin file or functions.php.
	__FILE__,
	'hariko'
);