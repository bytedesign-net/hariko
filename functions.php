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
	load_theme_textdomain( 'hariko', get_theme_file_path( 'languages' ) );
	add_theme_support( 'editor-styles' );
	add_editor_style( 'editor-style.css' );
}

/**
 * Falls back to the languages/hariko-{locale}.mo language-pack naming when
 * looking for the theme's translation file.
 *
 * Since WordPress 6.7 the just-in-time translation loader resolves a theme's
 * custom languages directory to {locale}.mo (e.g. languages/ja.mo), while
 * the {textdomain}-{locale}.mo naming (e.g. languages/hariko-ja.mo) is what
 * translator tools such as PoEdit produce and what wordpress.org language
 * packs use. This filter lets both naming conventions work.
 *
 * @param string $mofile Path to the translation file WordPress tried to load.
 * @param string $domain Text domain.
 * @return string Filtered path to the translation file.
 */
add_filter( 'load_textdomain_mofile', 'hariko_load_textdomain_mofile', 10, 2 );
function hariko_load_textdomain_mofile( $mofile, $domain ) {
	if ( 'hariko' !== $domain || is_readable( $mofile ) ) {
		return $mofile;
	}

	$locale = determine_locale();
	$alt    = get_theme_file_path( 'languages/hariko-' . $locale . '.mo' );

	return is_readable( $alt ) ? $alt : $mofile;
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

/**
 * Translatable strings that are hard-coded in the theme's HTML templates
 * and template parts.
 *
 * Block template and template part files (templates/*.html, parts/*.html)
 * are resolved as static HTML by WordPress and are never translated at
 * render time, so the English strings shipped in those files are mapped to
 * their translations here instead. Language packs are loaded from the
 * languages/ directory as hariko-{locale}.mo files.
 *
 * @return array Array of English source strings keyed to translations.
 */
function hariko_get_translatable_strings() {
	return array(
		/* Translators: Label of the "read more" link below post excerpts. */
		'Read More'    => __( 'Read More', 'hariko' ),
		/* Translators: Label of the link to the previous posts page. */
		'Newer Posts'  => __( 'Newer Posts', 'hariko' ),
		/* Translators: Label of the link to the next posts page. */
		'Older Posts'  => __( 'Older Posts', 'hariko' ),
		'Search'       => __( 'Search', 'hariko' ),
		'Please try searching.' => __( 'Please try searching.', 'hariko' ),
		/* Translators: ARIA label of the header navigation area. */
		'Main menu'    => __( 'Main menu', 'hariko' ),
		'Page Not Found' => __( 'Page Not Found', 'hariko' ),
		'The page you are looking for does not exist, or it has been moved.' => __( 'The page you are looking for does not exist, or it has been moved.', 'hariko' ),
		'Sorry, but nothing matched your search terms. Please try again with some different keywords.' => __( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'hariko' ),
		'Latest Posts' => __( 'Latest Posts', 'hariko' ),
		'Categories'   => __( 'Categories', 'hariko' ),
		'Archives'     => __( 'Archives', 'hariko' ),
		'No posts found yet.' => __( 'No posts found yet.', 'hariko' ),
		'Get started'  => __( 'Get started', 'hariko' ),
	);
}

/**
 * Replaces translatable strings stored in block attributes (such as the
 * excerpt "Read More" link text or search button labels) with their
 * translations at render time.
 *
 * @param array $block The block being rendered.
 * @return array Filtered block.
 */
add_filter( 'render_block_data', 'hariko_translate_block_attributes' );
function hariko_translate_block_attributes( $block ) {
	if ( empty( $block['attrs'] ) || ! is_array( $block['attrs'] ) ) {
		return $block;
	}

	$strings = hariko_get_translatable_strings();

	foreach ( $block['attrs'] as $key => $value ) {
		if ( is_string( $value ) && isset( $strings[ $value ] ) ) {
			$block['attrs'][ $key ] = $strings[ $value ];
		}
	}

	return $block;
}

/**
 * Replaces translatable strings shipped as static text inside heading and
 * paragraph blocks (in HTML templates and template parts) with their
 * translations at render time.
 *
 * @param string $block_content The block content about to be appended.
 * @return string Filtered block content.
 */
function hariko_translate_block_content( $block_content ) {
	$strings = hariko_get_translatable_strings();

	foreach ( $strings as $source => $translation ) {
		if ( $source === $translation ) {
			continue;
		}
		$block_content = str_replace(
			array( '>' . $source . '<', '>' . $source . ' <' ),
			'>' . $translation . '<',
			$block_content
		);
	}

	return $block_content;
}
add_filter( 'render_block_core/heading', 'hariko_translate_block_content' );
add_filter( 'render_block_core/paragraph', 'hariko_translate_block_content' );

/**
 * Translates the footer credit paragraph shipped in parts/footer.html.
 *
 * The paragraph combines a site-title link with static text, so it is
 * matched with a regular expression and rewritten with a sprintf()-based
 * translation that keeps the site title and WordPress links.
 *
 * @param string $block_content The paragraph block content.
 * @return string Filtered block content.
 */
add_filter( 'render_block_core/paragraph', 'hariko_translate_footer_credit' );
function hariko_translate_footer_credit( $block_content ) {
	if ( ! preg_match( '#(<a\b[^>]*>.*?</a>)( theme by BYTE DESIGN\. Powered by WordPress\.)#s', $block_content, $matches ) ) {
		return $block_content;
	}

	$translated = sprintf(
		/* translators: 1: site title markup with a link to the site, 2: linked WordPress name. */
		__( '%1$s theme by BYTE DESIGN. Powered by %2$s.', 'hariko' ),
		$matches[1],
		'<a href="' . esc_url( __( 'https://wordpress.org/', 'hariko' ) ) . '">WordPress</a>'
	);

	return str_replace( $matches[0], $translated, $block_content );
}

